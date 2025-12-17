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


class CITDashboardController extends Controller
{
    public function index(StatusKaryawanChart $chart, JeniskelaminkaryawanChart $jkchart, PendidikankaryawanChart $pddchart, Request $request){

        // $db = DB::connection('sqlsrv-sdndwh');
        // $data = $db->select('EXEC sp_PortalSDN_GetCITSummaryData');
        // var_dump($data);
        $data = [];
        return view('monitoring-dashboard.finance.cit.cit_index', $data);
        
    }
}
