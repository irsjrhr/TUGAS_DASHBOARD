<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDO;

class PBTDashboardController extends Controller
{
    public function index(Request $request)
    {
        $sdndwh    = DB::connection('sqlsrv-sdndwh');
        $reportSDN = DB::connection('sqlsrv-reportsdn');

        /* -------------------- Filters -------------------- */
        $filters = [
            'month'    => $request->input('month'),
            'branch'   => $request->input('branch'),
            'location' => $request->input('location'),
            'viewBy'   => $request->input('viewBy', 'idr'),
        ];

        // Extract region code safely
        $regionParts = explode(' ', $request->input('region', ''));
        $filters['region'] = $regionParts[1] ?? null;

        /* -------------------- Dropdown Data -------------------- */
        $months = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
        $selectedMonth = $filters['month'] ?? null;

        $branches = $sdndwh->table('mst_branches')
            ->select('territory_code', 'branch_name')
            ->orderBy('branch_name')
            ->get();

        $locations = $sdndwh->table('mst_branches')
            ->distinct()
            ->orderBy('location')
            ->get();

        $regions = $sdndwh->table('mst_branches')
            ->select('region')
            ->distinct()
            ->orderBy('region')
            ->get();

        /* -------------------- Report Data -------------------- */
        $pdo = $reportSDN->getPdo();

        $stmt = $pdo->prepare("
            EXEC sp_Finance_Report
                @month    = :month,
                @region   = :region,
                @location = :location,
                @branch   = :branch
        ");

        $stmt->execute([
            'month'    => $filters['month'],
            'region'   => $filters['region'],
            'location' => $filters['location'],
            'branch'   => $filters['branch'],
        ]);

        $rawData = $stmt->fetchAll(PDO::FETCH_ASSOC);

        /* -------------------- Targets -------------------- */
        $targets = collect();
        $normalizedTargets = [];

        if ($filters['month']) {
            $period = now()->year . Carbon::parse($filters['month'])->format('m');

            $targets = $reportSDN->table('Finance_Target')
                ->where('Periode', $period)
                ->get();

            $normalizedTargets = $targets->mapWithKeys(function ($t) {
                $key = strtolower(
                    preg_replace('/[^a-z0-9]/', '', $t->Type)
                );

                return [
                    $key => [
                        'value'    => (float) $t->Value,
                        'operator' => $t->Operator,
                    ]
                ];
            })->toArray();
        }

        /* -------------------- Column Selection -------------------- */
        $headers = collect($rawData[0] ?? [])
            ->keys()
            ->filter(fn ($key) =>
                $key === 'Branch' ||
                ($filters['viewBy'] === 'percent' && str_contains($key, '(%)')) ||
                ($filters['viewBy'] === 'idr' && str_contains($key, '(in Mio)'))
            )
            ->values();

        /* -------------------- Row Normalization -------------------- */
        $rows = collect($rawData)->map(function ($row) use ($headers, $normalizedTargets) {
            return $headers->mapWithKeys(function ($col) use ($row, $normalizedTargets) {

                $value     = $row[$col] ?? null;
                $isNumeric = is_numeric($value);
                $status    = null;

                if ($isNumeric) {
                    // 🔥 MUST normalize exactly the same way as targets
                    $normalizedCol = strtolower(
                        preg_replace('/[^a-z0-9]/', '', $col)
                    );

                    $target = $normalizedTargets[$normalizedCol] ?? null;

                    if ($target) {
                        $actual = (float) $value;
                        $targetValue = $target['value'];
                        $op = $target['operator'];

                        $pass =
                            ($op === '>'  && $actual >  $targetValue) ||
                            ($op === '>=' && $actual >= $targetValue) ||
                            ($op === '<'  && $actual <  $targetValue) ||
                            ($op === '<=' && $actual <= $targetValue) ||
                            ($op === '='  && $actual == $targetValue);

                        $status = $pass ? 'pass' : 'fail';
                    }
                }

                return [
                    $col => [
                        'value'      => $value,
                        'is_numeric' => $isNumeric,
                        'status'     => $status,
                    ]
                ];
            });
        });

        // dd($rows);


        return view('monitoring-dashboard.finance.pbt.pbt_index', compact(
            'months',
            'selectedMonth',
            'branches',
            'locations',
            'regions',
            'filters',
            'headers',
            'rows',
            'targets',
            'normalizedTargets'
        ));
    }
}
