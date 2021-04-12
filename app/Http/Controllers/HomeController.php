<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\HocVien;
use App\Models\NghiepDoan;
use App\Models\CongTy;
use App\Models\NganhNghe;
use Auth;
use Yajra\Datatables\Datatables;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */


    public function getAdd($id_ndoan,$id_cty){
        $nghiepdoan = NghiepDoan::orderBy('id','asc')->where('flag','0')->get();
        $congty=CongTy::where('flag',0)->get();
        $nganhnghe=NganhNghe::orderBy('id','asc')->get();
        return view('admin.template.hocvien.add',['nghiepdoan'=>$nghiepdoan,'congty'=>$congty,'nganhnghe'=>$nganhnghe,'id_ndoan'=>$id_ndoan,'id_cty'=>$id_cty]);
    }
    public static function addnghiepdoan($request,$item,$action){
        DB::beginTransaction();
        try {
            if($request->congty==null){
                $item->id_congty=json_encode([]);
            }
            else{
                $item->id_congty=json_encode($request->congty);
            }
            $item->name_jp = $request->name_jp;
            $item->name_vn = $request->name_vn;
            $item->add_jp = $request->add_jp;
            $item->add_vn = $request->add_vn;
            $item->tel = $request->tel;
            $item->fax = $request->fax;
            $item->postcode = $request->postcode;
            $item->creator = Auth::user()->name;
            $item->flag = 0;
            $item->note = $request->note;
            $item->save();

            DB::commit();
            return true;
        }
        catch (Exception $e) {
            DB::rollBack();
            return fail;
        }
    }
    public function postAdd(Request $request){
        if($request->name){
            $data=array();
            foreach($request->name as $key => $item){
                array_push($data,[
                    'name' => $request->name[$key],
                    'ngaysinh' => $request->ngaysinh[$key],
                    'gioitinh' => $request->gioitinh[$key],
                    'quequan' => $request->quequan[$key],
                    'tel' => $request->tel[$key],
                    'ma_donhang' => $request->ma_donhang[$key],
                    'id_nganh' => $request->id_nganh[$key],
                    'id_ndoan' => $request->id_ndoan[$key],
                    'id_congty' => $request->id_congty[$key],
                    'tinh' => $request->tinh[$key],
                    'gp' => $request->gp[$key],
                    'phi_thu' => $request->phi_thu[$key],
                    'phi_nguon' => $request->phi_nguon[$key],
                    'tien_dathu' => $request->tien_dathu[$key],
                    'tien_conlai' => $request->tien_conlai[$key],
                    'tien_thudot1' => $request->tien_thudot1[$key],
                    'tien_thudot2' => $request->tien_thudot2[$key],
                    'tien_thudot3' => $request->tien_thudot3[$key],
                    'ngay_thudot1' => $request->ngay_thudot1[$key],
                    'ngay_thudot2' => $request->ngay_thudot2[$key],
                    'ngay_thudot3' => $request->ngay_thudot3[$key],
                    'ngay_trungtuyen' => $request->ngay_trungtuyen[$key],
                    'ngay_xc' => $request->ngay_xc[$key],
                    'phi_dtnguon1' => $request->phi_dtnguon1[$key],
                    'phi_dtnguon2' => $request->phi_dtnguon2[$key],
                    'cty_nghe' => $request->cty_nghe[$key],
                    'tien_ve' => $request->tien_ve[$key],
                    'tien_daotao' => $request->tien_daotao[$key],
                    'tien_quanly' => $request->tien_quanly[$key],
                    // 'ngay_seikyu' => $request->ngay_seikyu[$key],
                    'ghichu' => $request->ghichu[$key],
                    'creator' => Auth::user()->name,
                    'created_at' => date("Y-m-d H:i:s"),
                    'flag' => 0,
                ]);
            }
        }
        DB::table('hocvien')->insert($data);
        return redirect()->back()->with('addsuccess', 'Đã thêm thành công!');
    }
    public function getEdit($id){
        $nghiepdoan = NghiepDoan::orderBy('id','asc')->where('flag','0')->get();
        $congty=CongTy::where('flag',0)->get();
        $nganhnghe=NganhNghe::orderBy('id','asc')->get();
        $hocvien = Hocvien::find($id);
        return view('admin.template.hocvien.edit',['hocvien' => $hocvien,'nghiepdoan' => $nghiepdoan,'congty' => $congty,'nganhnghe' => $nganhnghe]);
    }
    public static function edithocvien($request,$item,$action){
        DB::beginTransaction();
        try {
            $item->name = $request->name;
            $item->ngaysinh = $request->ngaysinh;
            $item->gioitinh = $request->gioitinh;
            $item->quequan = $request->quequan;
            $item->tel = $request->tel;
            $item->ma_donhang = $request->ma_donhang;
            $item->id_nganh = $request->id_nganh;
            $item->id_ndoan = $request->id_ndoan;
            $item->id_congty = $request->id_congty;
            $item->tinh = $request->tinh;
            $item->gp = $request->gp;
            $item->phi_thu = $request->phi_thu;
            $item->phi_nguon = $request->phi_nguon;
            $item->tien_dathu = $request->tien_dathu;
            $item->tien_conlai = $request->tien_conlai;
            $item->tien_thudot1 = $request->tien_thudot1;
            $item->tien_thudot2 = $request->tien_thudot2;
            $item->tien_thudot3 = $request->tien_thudot3;
            $item->ngay_thudot1 = $request->ngay_thudot1;
            $item->ngay_thudot2 = $request->ngay_thudot2;
            $item->ngay_thudot3 = $request->ngay_thudot3;
            $item->ngay_trungtuyen = $request->ngay_trungtuyen;
            $item->ngay_xc = $request->ngay_xc;
            $item->phi_dtnguon1 = $request->phi_dtnguon1;
            $item->phi_dtnguon2 = $request->phi_dtnguon2;
            $item->cty_nghe = $request->cty_nghe;
            $item->tien_ve = $request->tien_ve;
            $item->tien_daotao = $request->tien_daotao;
            $item->tien_quanly = $request->tien_quanly;
            $item->ghichu = $request->ghichu;
            $item->save();
            DB::commit();
            return true;
        }
        catch (Exception $e) {
            DB::rollBack();
            return fail;
        }
    }
    public function postEdit(Request $request,$id){
        $hocvien = Hocvien::find($id);
        if($this->edithocvien($request,$hocvien,"edit")){
            return redirect()->back()->with('addsuccess', 'Đã sửa "' . $request->name . '" thành công!');
        }
        return redirect()->back()->with('addsuccess','Đã sửa "' . $request->name. '" không thành công!');
    }
    public function gethocvien($id_ndoan,$id_cty){
        $hocvien = Hocvien::where([['id_ndoan',$id_ndoan],['id_congty',$id_cty],['flag',0]])->get();
        $nghiepdoan = NghiepDoan::orderBy('id','asc')->where('flag','0')->get();
        $congty= CongTy::where('flag',0)->get();
        $nganhnghe= NganhNghe::orderBy('id','asc')->get();
        return view('admin.template.hocvien.index',['hocvien'=>$hocvien,'id_ndoan'=>$id_ndoan,'id_cty'=>$id_cty,'nghiepdoan'=>$nghiepdoan,'congty'=>$congty,'nganhnghe'=>$nganhnghe]);

    }
    public function deletehocvien($id){
        $item = HocVien::find($id);
        $item->flag=1;
        $item->save();
        return redirect('danhsachhocvien')->with('addsuccess','Xóa học viên thành công');
    }
    public function danhsachhocvien(){
        $hocvien = HocVien::orderBy('id','asc')->where('flag','0')->get();
        $nghiepdoan = NghiepDoan::orderBy('id','asc')->where('flag','0')->get();
        $congty= CongTy::where('flag',0)->get();
        $nganhnghe= NganhNghe::orderBy('id','asc')->get();
        return view('admin.template.hocvien.danhsachhocvien',[
            'hocvien'=>$hocvien,
            'nghiepdoan'=>$nghiepdoan,
            'congty'=>$congty,
            'nganhnghe'=>$nganhnghe,
            ]);
    }
    public function danhdaudavenuoc($id){
        $hocvien = HocVien::find($id);
        $hocvien->ghichu = 'Đã về nước. Số lần đã đóng '.$hocvien->solan.'. '.$hocvien->ghichu;
        $hocvien->solan = 999;
        $hocvien->flag_tienve = 1;
        $hocvien->flag_daotao = 1;
        $hocvien->save();
        return redirect()->back()->with('addsuccess','Đã đánh dấu về nước học viên '.$hocvien->name);
    }
    public function datahocvien(){
        $hocvien = HocVien::select(['id','name','ngaysinh','gioitinh','quequan','tel','ma_donhang','id_nganh','id_ndoan','id_congty','tinh','gp','phi_thu','ngay_thudot1','tien_thudot1','ngay_thudot2','tien_thudot2','ngay_thudot3','tien_thudot3','phi_nguon','phi_dtnguon1','phi_dtnguon2','tien_dathu','tien_conlai','ngay_trungtuyen','ngay_xc','cty_nghe','tien_quanly','tien_daotao','tien_ve','solan','ngay_seikyu','ghichu'])->orderBy('id','asc')->where('flag','0')->get();
        return DataTables::of($hocvien)
        ->addColumn('thaotac', function ($hocvien) {
            return  '<a href="'.url('/edithocvien/'.$hocvien->id).'" class="mt-1 button cycle square primary"><span class="mif-wrench"></span></a> <a style="color:#fff" idhv="'.$hocvien->id.'" class="mt-1 button cycle square alert btn-delete"><span class="mif-cross"></span></a>';
        })
        ->editColumn('id_nganh', function ($hocvien) {
	    	if ($hocvien->id_nganh) {
                $nganhnghe = NganhNghe::find($hocvien->id_nganh);
                if($nganhnghe==null){
                    return 'Chưa nhập';
                }
	    		return $nganhnghe->loainganh_vn;
	    	}else{
	    		return 'Chưa nhập';
	    	}
        })
        ->editColumn('id_ndoan', function ($hocvien) {
	    	if ($hocvien->id_ndoan) {
                $nghiepdoan = NghiepDoan::find($hocvien->id_ndoan);
                if($nghiepdoan==null){
                    return 'Chưa nhập';
                }
	    		return $nghiepdoan->name_vn;
	    	}else{
	    		return 'Chưa nhập';
	    	}
        })
        ->editColumn('id_congty', function ($hocvien) {
	    	if ($hocvien->id_congty) {
                $congty = CongTy::find($hocvien->id_congty);
                if($congty==null){
                    return 'Chưa nhập';
                }
	    		return $congty->name_vn ;
	    	}else{
	    		return 'Chưa nhập';
	    	}
		})
        ->rawColumns(['thaotac','id_nganh','id_ndoan','id_congty'])->make(true);
    }
}
