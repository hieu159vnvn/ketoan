<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\HocVien;
use App\Models\NghiepDoan;
use App\Models\NganHang;
use App\Models\CongTy;
use App\Models\SeikyuDaoTao;
use App\Models\XacNhanSeiKyu;
use Illuminate\Support\Str;

use Auth;

class ThongKeTienThuDuocController extends Controller
{
    //
    public function index(){
        $now=date('Y');
        $month = DB::table('xacnhanseikyu')
        ->select(DB::raw('month(ngaynhan) as getMonth'), DB::raw('SUM(sotiennhan) as value'))
        ->where('tinhtrang',1)
        ->whereYear('ngaynhan',$now)
        ->groupBy('getMonth')
        ->orderBy('getMonth', 'ASC')
        ->get();

        $sortmonth = [];
        $orderMonth = [];
        foreach ($month as $key => $value) {
            $sortmonth[$value->getMonth] = $value;
        }
        for($i = 1; $i <= 12; $i++){
            if(!empty($sortmonth[$i])){
                $orderMonth[$i] = $sortmonth[$i]->value;
            }else{
                $orderMonth[$i] = 0;
            }
        }
        $orderMonth=json_encode($orderMonth);

        //theo nam
        $year = DB::table('xacnhanseikyu')
        ->select(DB::raw('year(ngaynhan) as getYear'), DB::raw('SUM(sotiennhan) as value'))
        ->where('tinhtrang',1)
        ->groupBy('getYear')
        ->orderBy('getYear', 'ASC')
        ->get();
        return view('admin.template.thongketienthuduoc.index',['month'=>$orderMonth,'year'=>$year]);
    }
}
