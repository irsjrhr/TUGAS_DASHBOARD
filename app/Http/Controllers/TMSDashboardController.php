<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDO;

class TMSDashboardController extends Controller
{
    public function podReturnIndex()
    {
        $sdndwh = DB::connection('sqlsrv-sdndwh');
        $pdo = $sdndwh->getPdo();


        // Filters 
        $startDate = request()->input('startDate', null) ?? Carbon::now()->startOfMonth()->toDateString();;
        $endDate = request()->input('endDate', null) ?? Carbon::now()->endOfMonth()->toDateString();

        $branches = $sdndwh->table('mst_branches')
            ->select('territory_code', 'branch_name')
            ->orderBy('branch_name', 'ASC')
            ->get();

        $regions = $sdndwh->table('mst_branches')
            ->select('region')
            ->distinct()
            ->orderBy('region', 'ASC')
            ->get();

        $params = [
            'startDate'           => $filters['startDate'] ?? null,
            'endDate'             => $filters['endDate'] ?? null,
        ];

        $stmt = $pdo->prepare("
            EXEC sp_PortalSDN_GetSummaryPODDashboard
                @startDate           = :startDate,
                @endDate             = :endDate;
        ");

        $stmt->execute($params);

        // Read ALL result sets
        $datasets = [];
        do {
            $datasets[] = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } while ($stmt->nextRowset());

        $summaryData = $datasets[0][0] ?? [];
        
        return view('monitoring-dashboard.tms.pod_return_index', compact(
            'summaryData',
            'startDate',
            'endDate',
            'branches',
            'regions'
        ));
    }
}
