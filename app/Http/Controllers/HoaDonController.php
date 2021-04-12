<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\SeikyuDaoTao;
use App\Models\HoaDonTienQuanLy;
use App\Models\NghiepDoan;
use App\Models\CongTy;
use App\Models\XacNhanSeiKyu;

class HoaDonController extends Controller
{
    //
    public function index(){
        $nghiepdoan = NghiepDoan::orderBy('id','asc')->where('flag','0')->get();
        $congty = CongTy::orderBy('id','asc')->where('flag','0')->get();
        $tiendaotaovavemaybay = SeikyuDaoTao::where('flag',0)->orderBy('id','desc')->get();
        $tienquanly = HoaDonTienQuanLy::where('flag',0)->orderBy('id','desc')->get();
        $mahoadon = XacNhanSeiKyu::where('flag',0)->orderBy('id','desc')->get();
        return view('admin.template.hoadon.index',['tiendaotaovavemaybay'=>$tiendaotaovavemaybay,'tienquanly'=>$tienquanly,'nghiepdoan'=>$nghiepdoan,'congty'=>$congty,'mahoadon'=>$mahoadon]);
    }
    public function getEditQuanly($id){
        $nghiepdoan = NghiepDoan::orderBy('id','asc')->where('flag','0')->get();
        $congty = CongTy::orderBy('id','asc')->where('flag','0')->get();
        $quanly = HoaDonTienQuanLy::find($id);
        return view('admin.template.hoadon.editquanly',['quanly'=>$quanly,'nghiepdoan'=>$nghiepdoan,'congty'=>$congty]);
    }
    public function postEditQuanly(Request $request,$id){
        $quanly = HoaDonTienQuanLy::find($id);
        $quanly->id_ndoan = $request->id_ndoan;
        $quanly->ma_seikyu = $request->ma_seikyu;
        $quanly->id_congty = $request->id_congty;
        $quanly->ngay_nhapquoc = $request->ngay_nhapquoc;
        $quanly->solan = $request->solan;
        $quanly->songuoi = $request->songuoi;
        $quanly->dongia = $request->dongia;
        $quanly->sothang = $request->sothang;
        $quanly->tg_from = $request->tg_from;
        $quanly->tg_to = $request->tg_to;
        $quanly->sotien = $request->sotien;
        $quanly->ghichu = $request->ghichu;
        $quanly->updated_at = date("Y-m-d H:i:s");
        $quanly->save();
        return redirect('hoadon')->with('addsuccess', 'Đã sửa thành công!');
    }
    public function getEditDTVMB($id){
        $nghiepdoan = NghiepDoan::orderBy('id','asc')->where('flag','0')->get();
        $congty = CongTy::orderBy('id','asc')->where('flag','0')->get();
        $tiendaotaovavemaybay = SeikyuDaoTao::find($id);
        return view('admin.template.hoadon.editdaotaovavemaybay',['tiendaotaovavemaybay'=>$tiendaotaovavemaybay,'nghiepdoan'=>$nghiepdoan,'congty'=>$congty]);
    }
    public function postEditDTVMB(Request $request,$id){
        $tiendaotaovavemaybay = SeikyuDaoTao::find($id);
        $tiendaotaovavemaybay->id_ndoan = $request->id_ndoan;
        $tiendaotaovavemaybay->ma_seikyu = $request->ma_seikyu;
        $tiendaotaovavemaybay->id_congty = $request->id_congty;
        $tiendaotaovavemaybay->ngay_nhapquoc = $request->ngay_nhapquoc;
        $tiendaotaovavemaybay->songuoi = $request->songuoi;
        $tiendaotaovavemaybay->dongia_usd = $request->dongia_usd;
        $tiendaotaovavemaybay->dongia_yen = $request->dongia_yen;
        $tiendaotaovavemaybay->sotien = $request->sotien;
        $tiendaotaovavemaybay->ghichu = $request->ghichu;
        $tiendaotaovavemaybay->updated_at = date("Y-m-d H:i:s");
        $tiendaotaovavemaybay->save();
        return redirect('hoadon')->with('addsuccess', 'Đã sửa thành công!');
    }
    public function deleteQuanly($id){
        $item = HoaDonTienQuanLy::find($id);
        $item->flag=1;
        $item->save();
        return redirect('hoadon')->with('addsuccess', 'Đã xóa thành công!');
    }
    public function deleteDTVMB($id){
        $item = SeikyuDaoTao::find($id);
        $item->flag=1;
        $item->save();
        return redirect('hoadon')->with('addsuccess', 'Đã xóa thành công!');
    }
    public function view($ma_seikyu){
        $nghiepdoan = NghiepDoan::orderBy('id','asc')->where('flag','0')->get();
        $congty = CongTy::orderBy('id','asc')->where('flag','0')->get();
        $mahoadon = XacNhanSeiKyu::where('ma_seikyu',$ma_seikyu)->first();
        if ($mahoadon->loai_seikyu == 'Tiền quản lý') {
            $hoadontienquanly = HoaDonTienQuanLy::where([['ma_seikyu',$ma_seikyu],['flag',0]])->get();
            return view('admin.template.hoadon.viewtienquanly',[
                'nghiepdoan'=>$nghiepdoan,
                'congty'=>$congty,
                'hoadontienquanly'=>$hoadontienquanly
            ]);
        }
        else{
            $tiendaotaovavemaybay = SeikyuDaoTao::where([['ma_seikyu',$ma_seikyu],['flag',0]])->get();
            return view('admin.template.hoadon.viewvemaybayvadaotao',[
                'nghiepdoan'=>$nghiepdoan,
                'congty'=>$congty,
                'tiendaotaovavemaybay'=>$tiendaotaovavemaybay
            ]);
        }
    }
}
