<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\XacNhanSeiKyu;
use App\Models\HocVien;
use App\Models\HoaDonTienQuanLy;
use App\Models\NghiepDoan;
use Illuminate\Support\Facades\Log;
class XacNhanSeiKyuController extends Controller
{
    //
    public function index(){
        $hoadon = XacNhanSeiKyu::where('flag',0)->orderBy('id','desc')->get();
        $nghiepdoan = NghiepDoan::orderBy('id','asc')->where('flag','0')->get();
        return view('admin.template.xacnhanseikyu.index',['hoadon'=>$hoadon,'nghiepdoan'=>$nghiepdoan]);
    }
    public function getEdit($id){
        $hoadon = XacNhanSeiKyu::find($id);
        return view('admin.template.xacnhanseikyu.edit',['hoadon'=>$hoadon]);
    }
    public function postEdit(Request $request,$id){
        $hoadon = XacNhanSeiKyu::find($id);
        $hoadon->tknhan = $request->tknhan;
        $hoadon->ngaynhan = $request->ngaynhan;
        $hoadon->sotiennhan = $request->sotiennhan;
        $hoadon->ghichu = $request->ghichu;
        $hoadon->tinhtrang = ($request->tinhtrang == 'on' ? 1 : 0);
        $hoadon->updated_at = date("Y-m-d H:i:s");
        $hoadon->save();
        return redirect('xacnhanseikyu')->with('addsuccess', 'Đã sửa thành công!');
    }
    public function delete($id){
        $hoadon = XacNhanSeiKyu::find($id);
        if($hoadon->loai_seikyu=='Tiền vé máy bay'){
            $hocvien_tienve = HocVien::where([['flag',0],['ma_seikyu_vemaybay',$hoadon->ma_seikyu]])->update(['flag_tienve' => 0]);
        }
        else if($hoadon->loai_seikyu=='Tiền đào tạo'){
            $hocvien_tiendaotao = HocVien::where([['flag',0],['ma_seikyu_tiendaotao',$hoadon->ma_seikyu]])->update(['flag_daotao' => 0]);
        }
        else if($hoadon->loai_seikyu=='Tiền quản lý'){
            $hoadontienquanly= HoaDonTienQuanLy::where('ma_seikyu',$hoadon->ma_seikyu)->get();
            foreach($hoadontienquanly as $item){
                $trusolan = HocVien::where([['id_ndoan',$item->id_ndoan],['id_congty',$item->id_congty],['ngay_xc',$item->ngay_nhapquoc],['flag',0]])->decrement('solan',$item->sothang);
                $trusothang = HocVien::where([['id_ndoan',$item->id_ndoan],['id_congty',$item->id_congty],['ngay_xc',$item->ngay_nhapquoc],['flag',0]])->get();
                foreach ($trusothang as $trusothang) {
                    $ngayseikyu= $trusothang->ngay_seikyu;
                    $trusothang->ngay_seikyu = date('Y-m-d',strtotime("-$item->sothang month",strtotime($ngayseikyu)));
                    $trusothang->save();
                }
            }
        }
        $delhoadontienquanly = HoaDonTienQuanLy::where('ma_seikyu',$hoadon->ma_seikyu)->delete();
        $hoadon->delete();
        return redirect('xacnhanseikyu')->with('addsuccess', 'Đã xóa thành công!');
    }
}
