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

class HoaDonTienVeMayBayController extends Controller
{
    //
    public function index(){
        $nghiepdoan = NghiepDoan::orderBy('id','asc')->where('flag','0')->get();
        $nganhang = NganHang::orderBy('id','asc')->where('flag','0')->get();
        return view('admin.template.hoadontienvemaybay.index',['nghiepdoan'=>$nghiepdoan,'nganhang'=>$nganhang]);
    }
    public function getdata($id_ndoan){
        $nghiepdoan = NghiepDoan::orderBy('id','asc')->where('flag','0')->get();
        $nganhang = NganHang::orderBy('id','asc')->where('flag','0')->get();
        $congty = CongTy::orderBy('id','asc')->where('flag','0')->get();
        $hocvien = DB::table('hocvien')
        ->select(DB::raw('COUNT(*) as sohocvien'),'id_congty','ngay_xc')
        ->where([['id_ndoan',$id_ndoan],['flag_tienve',0],['flag',0]])
        ->groupBy('id_congty','ngay_xc')
        ->get();
        if(count($hocvien)==0){
            return view('admin.template.hoadontiendaotao.null');
        }
        else{
            //tinh tong
            $tong = DB::table('hocvien')
            ->select(DB::raw('COUNT(*) as tong'))
            ->where([['id_ndoan',$id_ndoan],['flag_tienve',0],['flag',0]])
            ->get();
            $tong = $tong[0];

            return view('admin.template.hoadontienvemaybay.data',[
                'hocvien'=>$hocvien,
                'nghiepdoan'=>$nghiepdoan,
                'nganhang'=>$nganhang,
                'congty'=>$congty,
                'id_ndoan'=>$id_ndoan,
                'tong'=>$tong->tong
                ]);
        }
    }
    public function print(Request $request,$id_ndoan){
        $nghiepdoan = NghiepDoan::find($id_ndoan);
        $nganhang = NganHang::find($request->nganhang);
        $congty = CongTy::orderBy('id','asc')->where('flag','0')->get();
        $hocvien = DB::table('hocvien')
        ->select(DB::raw('COUNT(*) as sohocvien'),'id_congty','ngay_xc')
        ->where([['id_ndoan',$id_ndoan],['flag_tienve',0],['flag',0]])
        ->groupBy('id_congty','ngay_xc')
        ->get();
        for($i = 0; $i<count($request->sohocvien);$i++){
            $hocvien[$i]->sohocvien = $request->sohocvien[$i];
        }
        $tong = 0;
        foreach($hocvien as $item){
            $tong += $item->sohocvien;
        }
        //lay ngay hien tai
        $date_created=date("Y/m/d");
        //insert du lieu vao bang seikyudaotao
        json_decode($hocvien);
        //ma seikyu
        $getidmax= XacNhanSeiKyu::orderBy('id', 'DESC')->first();
        $getYear= date('Y');
        $cutYear=substr($getYear,2,2);
        if ($getidmax==null) {
            $ma_seikyu='MR'.$cutYear.'001';
        }
        else{
            if ($getidmax==null) {
                $ma_seikyu='MR'.$cutYear.'001';
            }
            else{
                if ($cutYear>substr($getidmax->ma_seikyu,2,2)) {
                    $ma_seikyu='MR'.$cutYear.'000';
                }
                else{
                    $getmax=substr($getidmax->ma_seikyu,4,3);
                    $year=substr($getidmax->ma_seikyu,2,2);
                    $stt = (int)$getmax;
                    $stt++;
                    if ($stt<100&&$stt>9) {
                        $stt = '0'.$stt;
                    }
                    if ($stt<=9) {
                        $stt = '00'.$stt;
                    }
                    $ma_seikyu='MR'.$year.$stt;
                }
            }
        }
          //set trang thai dong tien= 1
        $trangthai = DB::table('hocvien')->where([['id_ndoan',$id_ndoan],['flag_tienve',0],['flag',0]])->update(['flag_tienve' => 1]);
        $ma_seikyu_vemaybay = DB::table('hocvien')->where([['id_ndoan',$id_ndoan],['flag_tienve',1],['flag',0]])->update(['ma_seikyu_vemaybay' => $ma_seikyu]);
        //
        for ($i=0; $i < count($hocvien); $i++) {
            $seikyu= new SeikyuDaoTao;
            $seikyu->songuoi =$hocvien[$i]->sohocvien;
            $seikyu->id_ndoan =$id_ndoan;
            $seikyu->ma_seikyu =$ma_seikyu;
            $seikyu->id_congty =$hocvien[$i]->id_congty;
            $seikyu->ngay_nhapquoc =$hocvien[$i]->ngay_xc;
            $seikyu->dongia_usd =$hocvien[$i]->sohocvien*536;
            $seikyu->dongia_yen =$hocvien[$i]->sohocvien*15000;
            $seikyu->sotien =$hocvien[$i]->sohocvien*15000;
            $seikyu->creator = Auth::user()->name;
            $seikyu->flag = 0;
            $seikyu->updated_at = null;
            $seikyu->save();
        }
        //insert du lieu vao bang xac nhan seikyu
            $xacnhanseikyu = new XacNhanSeikyu;
            $xacnhanseikyu->ma_seikyu = $ma_seikyu;
            $xacnhanseikyu->nghiepdoan_id = $id_ndoan;
            $xacnhanseikyu->loai_seikyu = 'Tiền vé máy bay';
            $xacnhanseikyu->tongtien= $tong*15000;
            $xacnhanseikyu->tinhtrang=0;
            $xacnhanseikyu->tknhan= $nganhang->tentk;
            $xacnhanseikyu->khoangthoigian=date("Y-m-d").' to '.date("Y-m-d",strtotime("+1 month",strtotime($date_created)));
            $xacnhanseikyu->creator = Auth::user()->name;
            $xacnhanseikyu->flag =0;
            $xacnhanseikyu->updated_at=null;
            $xacnhanseikyu->save();
        return view('admin.template.hoadontienvemaybay.inhoadonvemaybay',[
            'hocvien'=>$hocvien,
            'nghiepdoan'=>$nghiepdoan,
            'nganhang'=>$nganhang,
            'congty'=>$congty,
            'id_ndoan'=>$id_ndoan,
            'tong'=>$tong,
            'date_created'=>$date_created,
            'ma_seikyu'=>$ma_seikyu,
            ]);
    }
}
