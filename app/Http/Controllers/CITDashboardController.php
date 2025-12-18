<?php
namespace App\Http\Controllers;

use App\Charts\JeniskelaminkaryawanChart;
use App\Charts\PendidikankaryawanChart;
use App\Charts\StatusKaryawanChart;
use App\Models\Cabang;
use App\Models\Departemen;
use App\Models\Karyawan;
use App\Models\Lembur;
use App\Models\Presensi;
use App\Models\User;
use App\Models\Userkaryawan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Jenssegers\Agent\Agent;
use PDO;


class CITDashboardController extends Controller
{
    public function index(StatusKaryawanChart $chart, JeniskelaminkaryawanChart $jkchart, PendidikankaryawanChart $pddchart, Request $request){

        $db = DB::connection('sqlsrv-sdndwh');

        $pdo = $db->getPdo();
        $stmt = $pdo->prepare("EXEC sp_PortalSDN_GetCITSummaryData");
        $stmt->execute();

        // Fetch all datasets
        $datasets = [];
        do {
            $datasets[] = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        } while ($stmt->nextRowset());


        $data_transaksi = $datasets[7];
        // echo '<pre>';
        // print_r($data_transaksi);
        // echo '</pre>';
        // // die;
        // for ($i=0; $i < 5; $i++) { 

        //     $row_data = $data_transaksi[$i];
        //     // echo "<pr>";
        //     // var_dump($row_data);
        //     // echo "</pr>";

        //     foreach ($row_data as $key => $value) {
        //         echo $row_data[$key];
        //     }


        // }
        // die;
        return view('monitoring-dashboard.finance.cit.cit_index', compact(
            'datasets',
        ));
        
    }
}
