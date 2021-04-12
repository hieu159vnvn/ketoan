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
class NghiepDoanController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function danhsachnghiepdoan(){
        $nghiepdoan = NghiepDoan::orderBy('id','asc')->where('flag','0')->get();
        return view('admin.template.nghiepdoan.index',['nghiepdoan'=>$nghiepdoan]);
    }
    public function getAddnghiepdoan(){
        return view('admin.template.nghiepdoan.addnghiepdoan');
    }

    public static function addnghiepdoan($request,$item,$action){
        DB::beginTransaction();
        try {

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
    public function postAddnghiepdoan(Request $request){
        $item = new NghiepDoan;
        $item->created_at = date("Y-m-d H:i:s");
        if(NghiepDoan::where([['name_vn', $request->name_vn],['flag',0]])->count() > 0){
            return back()->with('error','Nghiệp đoàn đã tồn tại');
        }
        else{
            if($this->addnghiepdoan($request,$item,"addnghiepdoan")){
                return redirect('danhsachnghiepdoan')->with('addsuccess', 'Đã thêm "' . $request->name_vn . '" thành công!');
            }
            return redirect('danhsachnghiepdoan')->with('error','Đã thêm "' . $request->name_vn. '" không thành công!');
        }
    }

    public function deletenghiepdoan($id){
        $item = NghiepDoan::find($id);
        $item->flag = 1;
        $item->save();
        return redirect()->back()->with('addsuccess','Đã xóa thành công!');
    }
    public function getEditnghiepdoan($id){
        $nghiepdoan = NghiepDoan::find($id);
        $congty=CongTy::where('flag',0)->get();
        $nghiepdoan_congty = DB::table("nghiepdoan_congty")->where('id_nghiepdoan',$id)
        ->pluck('id_congty')->all();
        return view('admin.template.nghiepdoan.editnghiepdoan',['nghiepdoan' => $nghiepdoan,'congty' => $congty,'nghiepdoan_congty' => $nghiepdoan_congty]);
    }
    public function postEditnghiepdoan(Request $request,$id){
        $nghiepdoan = NghiepDoan::find($id);
        $nghiepdoan->updated_at = date("Y-m-d H:i:s");

        $nghiepdoan_congty=DB::table("nghiepdoan_congty")->where('id_nghiepdoan',$id)->delete();
        ////
        if($request->input('congty')!=null){
            foreach ($request->input('congty') as $key => $value) {
                DB::table('nghiepdoan_congty')->insert([['id_nghiepdoan'=>$id,'id_congty'=>$value]]);
            }
        }
        if($this->addnghiepdoan($request,$nghiepdoan,"editnghiepdoan")){
            return redirect('danhsachnghiepdoan')->with('addsuccess', 'Đã sửa "' . $request->name_vn . '" thành công!');
        }
        else{
            return redirect('danhsachnghiepdoan')->with('addsuccess','Đã sửa "' . $request->name_vn. '" không thành công!');
        }
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
}
