<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\HocVien;
use App\Models\NghiepDoan;
use App\Models\NganHang;
use App\Models\CongTy;
use App\Models\HoaDonTienQuanLy;
use App\Models\XacNhanSeiKyu;
use Illuminate\Support\Str;

use Auth;

class HoaDonTienQuanLyController extends Controller
{
    public function index(){
        $nghiepdoan = NghiepDoan::orderBy('id','asc')->where('flag','0')->get();
        return view('admin.template.hoadontienquanly.index',['nghiepdoan'=>$nghiepdoan]);
    }
    public function getdata(Request $request){
        $id_ndoan=$request->id_ndoan;
        $sothang=$request->sothang;
        $nghiepdoan = NghiepDoan::orderBy('id','asc')->where('flag','0')->get();
        $nganhang = NganHang::orderBy('id','asc')->where('flag','0')->get();
        $congty = CongTy::orderBy('id','asc')->where('flag','0')->get();
        $hocvien = DB::table('hocvien')
        ->select(DB::raw('COUNT(*) as sohocvien'),'id_congty','ngay_xc','solan','ngay_seikyu')
        ->where([['id_ndoan',$id_ndoan],['flag',0],['solan','<',36]])
        ->groupBy('id_congty','ngay_xc')
        ->get();
        if(count($hocvien)==0){
            return view('admin.template.hoadontiendaotao.null');
        }
        else{
            // tính tổng nha má
            $tong=0;
            foreach ($hocvien as $item) {
                if (($item->solan+$sothang)>36) {
                    $tong+=$item->sohocvien * 5000 * (36-$item->solan);
                }
                else{
                    $tong+=$item->sohocvien * 5000 * $sothang;
                }
            }
            return view('admin.template.hoadontienquanly.data',[
                'nghiepdoan'=>$nghiepdoan,
                'id_ndoan'=>$id_ndoan,
                'sothang'=>$sothang,
                'nganhang'=>$nganhang,
                'congty'=>$congty,
                'hocvien'=>$hocvien,
                'tong'=>$tong,
            ]);
        }
    }
    public function inhoadonquanly(Request $request){
        $id_ndoan=$request->id_ndoan;
        $sothang=$request->sothang;
        //Lưu data solan + tháng
        $hocviensolan = DB::table('hocvien')
        ->select(DB::raw('COUNT(*) as sohocvien'),'id_congty','ngay_xc','solan','ngay_seikyu')
        ->where([['id_ndoan',$id_ndoan],['flag',0],['solan','<',36]])
        ->groupBy('id_congty','ngay_xc')
        ->get();
        // foreach ($hocviensolan as $key => $item) {
        //     $luusolan = DB::table('hocvien')->where([['id_ndoan',$id_ndoan],['id_congty',$item->id_congty],['ngay_xc',$item->ngay_xc],['flag',0]])->update(['solan' => $request->solan[$key]]);
        //     $luusothang = DB::table('hocvien')->where([['id_ndoan',$id_ndoan],['id_congty',$item->id_congty],['ngay_xc',$item->ngay_xc],['flag',0]])->update(['ngay_seikyu' => date('Y-m-d',strtotime($request->ngay_seikyu[$key]))]);
        // }
        $nghiepdoan = NghiepDoan::find($id_ndoan);
        $nganhang = NganHang::find($request->nganhang);
        $congty = CongTy::orderBy('id','asc')->where('flag','0')->get();
        $hocvien = DB::table('hocvien')
        ->select(DB::raw('COUNT(*) as sohocvien'),'id_congty','ngay_xc','solan','ngay_seikyu')
        ->where([['id_ndoan',$id_ndoan],['flag',0],['solan','<',36]])
        ->groupBy('id_congty','ngay_xc')
        ->get();
        for($i = 0; $i<count($request->sohocvien);$i++){
            $hocvien[$i]->sohocvien = $request->sohocvien[$i];
        }
        // tính tổng nha má
        $tong=0;
        foreach ($hocvien as $item) {
            if (($item->solan+$sothang)>36) {
                $tong+=$item->sohocvien * 5000 * (36-$item->solan);
            }
            else{
                $tong+=$item->sohocvien * 5000 * $sothang;
            }
        }
        $date_created=date("Y/m/d");
        $tonghocvien = 0;
        foreach($hocvien as $item){
            $tonghocvien += $item->sohocvien;
        }
        //Cong so thang
        foreach ($hocvien as $item ) {
            if($item->solan+$sothang>36){
                $congsothang = DB::table('hocvien')->where([['id_ndoan',$id_ndoan],['id_congty',$item->id_congty],['ngay_xc',$item->ngay_xc],['flag',0],['solan','<',36]])->increment('solan',36 - $item->solan);
            }
            else{
                $congsothang = DB::table('hocvien')->where([['id_ndoan',$id_ndoan],['id_congty',$item->id_congty],['ngay_xc',$item->ngay_xc],['flag',0],['solan','<',36]])->increment('solan',$sothang);
            }
        }

        //insert du lieu vao bang hoadontienquanly
        json_decode($hocvien);
        //ma seikyu
        $getidmax= XacNhanSeiKyu::orderBy('id', 'DESC')->first();
        $getYear= date('Y');
        $cutYear=substr($getYear,2,2);
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
        //
        for ($i=0; $i < count($hocvien); $i++) {
            $hoadon= new HoaDonTienQuanLy;
            $hoadon->id_ndoan =$id_ndoan;
            $hoadon->ma_seikyu =$ma_seikyu;
            $hoadon->id_congty =$hocvien[$i]->id_congty;
            $hoadon->ngay_nhapquoc =$hocvien[$i]->ngay_xc;
            $hoadon->solan =$hocvien[$i]->solan;
            $hoadon->songuoi =$hocvien[$i]->sohocvien;
            $hoadon->dongia =5000;
            if($hocvien[$i]->solan+$sothang>36){
                $hoadon->sothang =36-$hocvien[$i]->solan;
                $thang=36-$hocvien[$i]->solan;
                if($hocvien[$i]->ngay_seikyu==null){
                    $hoadon->tg_to =date('Y-m-d',strtotime("+$thang month",strtotime($date_created)));
                }
                else{
                    $hoadon->tg_to =date('Y-m-d',strtotime("+$thang month",strtotime($hocvien[$i]->ngay_seikyu)));
                }
            }
            else{
                $hoadon->sothang =$sothang;
                $thang=$sothang;
                if($hocvien[$i]->ngay_seikyu==null){
                    $hoadon->tg_to =date('Y-m-d',strtotime("+$thang month",strtotime($date_created)));
                }
                else{
                    $hoadon->tg_to =date('Y-m-d',strtotime("+$thang month",strtotime($hocvien[$i]->ngay_seikyu)));
                }
            }
            if($hocvien[$i]->ngay_seikyu==null){
                $hoadon->tg_from =$date_created;
            }
            else{
                $hoadon->tg_from =$hocvien[$i]->ngay_seikyu;
            }

            if($hocvien[$i]->solan+$sothang>36){
                $hoadon->sotien =$hocvien[$i]->sohocvien*5000*(36-$hocvien[$i]->solan);
            }
            else{
                $hoadon->sotien =$hocvien[$i]->sohocvien*5000*$sothang;
            }
            $hoadon->creator = Auth::user()->name;
            $hoadon->flag = 0;
            $hoadon->updated_at = null;
            $hoadon->save();
        }
        //insert du lieu vao bang xac nhan seikyu
        $xacnhanseikyu = new XacNhanSeikyu;
        $xacnhanseikyu->ma_seikyu = $ma_seikyu;
        $xacnhanseikyu->loai_seikyu = 'Tiền quản lý';
        $xacnhanseikyu->nghiepdoan_id = $id_ndoan;
        $xacnhanseikyu->tongtien= $tong;
        $xacnhanseikyu->tinhtrang=0;
        $xacnhanseikyu->tknhan= $nganhang->tentk;
        $xacnhanseikyu->khoangthoigian=date("Y-m-d").' to '.date("Y-m-d",strtotime("+1 month",strtotime($date_created)));
        $xacnhanseikyu->creator = Auth::user()->name;
        $xacnhanseikyu->flag =0;
        $xacnhanseikyu->updated_at=null;
        $xacnhanseikyu->save();
        return view('admin.template.hoadontienquanly.inhoadonquanly',[
            'nghiepdoan'=>$nghiepdoan,
            'id_ndoan'=>$id_ndoan,
            'sothang'=>$sothang,
            'nganhang'=>$nganhang,
            'congty'=>$congty,
            'hocvien'=>$hocvien,
            'date_created'=>$date_created,
            'tonghocvien'=>$tonghocvien,
            'ma_seikyu'=>$ma_seikyu,
            'tong'=>$tong,
        ]);
    }
}
