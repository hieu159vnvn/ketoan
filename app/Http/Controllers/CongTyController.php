<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\CongTy;
use App\Models\NghiepDoan;
use App\Models\HocVien;
use App\Models\Nghiepdoan_Congty;
use Auth;
class CongTyController extends Controller
{
    //
    public function index($id_ndoan){
        $nghiepdoan=NghiepDoan::where([['flag','0'],['id',$id_ndoan]])->first();
        $allnghiepdoan=NghiepDoan::where('flag','0')->get();
        $congty=CongTy::where('flag',0)->get();
        $nghiepdoan_congty = DB::table("nghiepdoan_congty")->where("nghiepdoan_congty.id_nghiepdoan",$id_ndoan)
        ->pluck('nghiepdoan_congty.id_congty')->all();
        return view('admin.template.congty.index',['nghiepdoan'=>$nghiepdoan,'allnghiepdoan'=>$allnghiepdoan,'id_ndoan'=>$id_ndoan,'congty'=>$congty,'nghiepdoan_congty'=>$nghiepdoan_congty]);
    }
    public function Add(Request $request,$id)
    {
        if(Congty::where([['name_vn', $request->name_vn],['flag',0]])->count() > 0){
            return back()->with('error','Công ty đã tồn tại');
        }
        else{
            $congty=new Congty;
            $congty->name_vn=$request->name_vn;
            $congty->name_jp=$request->name_jp;
            $congty->creator=Auth::user()->name;
            $congty->flag= 0;
            $congty->note= $request->note;
            $congty->created_at= date("Y-m-d H:i:s");
            $congty->save();
            //
            DB::table('nghiepdoan_congty')->insert([['id_nghiepdoan'=>$id,'id_congty'=>$congty->id]]);
            return back()->with('addsuccess','Thêm công ty thành công');
        }
    }
    public function delete($id_nd,$id){
        $nghiepdoan_congty=Nghiepdoan_Congty::where([['id_nghiepdoan',$id_nd],['id_congty',$id]])->delete();
        //
        $hocvien=HocVien::where([['id_ndoan',$id_nd],['id_congty',$id],['flag',0]])->get();
        for ($i=0; $i < count($hocvien); $i++) {
            $xoahv=HocVien::find($hocvien[$i]->id);
            $xoahv->flag=1;
            $xoahv->save();
        }
        return back()->with('addsuccess','Xóa công ty thành công');
    }
    public function getEdit($id){
        $congty= Congty::find($id);
        return view('admin.template.congty.edit',['congty' => $congty]);
    }
    public function postEdit(Request $request,$id){
        // if(Congty::where([['name_vn', $request->name_vn],['flag',0]])->count() > 0){
        //     return back()->with('error','Công ty đã tồn tại');
        // }
        // else{
            $congty=Congty::find($id);
            $congty->updated_at = date("Y-m-d H:i:s");
            $congty->name_vn=$request->name_vn;
            $congty->name_jp=$request->name_jp;
            $congty->note= $request->note;
            $congty->save();
            return redirect()->back()->with('addsuccess','Đã sửa "' . $request->name_vn. '" thành công!');
        // }
    }
    public function danhsach(){
        $congty= Congty::where('flag',0)->get();
        return view('admin.template.congty.danhsach',['congty' => $congty]);
    }
    public function deletecongty($id){
        $congty=CongTy::find($id);
        $congty->flag=1;
        $congty->save();

        $nghiepdoan=NghiepDoan::where('flag',0)->get();

        for ($i=0; $i < count($nghiepdoan); $i++) {
            $array=array(json_decode($nghiepdoan[$i]->id_congty));
            $array1=$array[0];
            $xoa=\array_diff($array1, ["$id"]);
            $ndoan=NghiepDoan::find($nghiepdoan[$i]->id);
            $ndoan->id_congty=json_encode(\array_values($xoa));
            $ndoan->save();
        }
        $hocvien=HocVien::where([['id_congty',$id],['flag',0]])->get();
        for ($i=0; $i < count($hocvien); $i++) {
            $xoahv=HocVien::find($hocvien[$i]->id);
            $xoahv->flag=1;
            $xoahv->save();
        }
        return redirect('danhsachcongty')->with('addsuccess','Đã xóa thành công!');
    }
    public function getEditcongty($id){
        $congty= Congty::find($id);
        return view('admin.template.congty.danhsach-edit',['congty' => $congty]);
    }
    public function postEditcongty(Request $request,$id){

            $congty=Congty::find($id);
            $congty->updated_at = date("Y-m-d H:i:s");
            $congty->name_vn=$request->name_vn;
            $congty->name_jp=$request->name_jp;
            $congty->note= $request->note;
            $congty->save();
            return redirect('danhsachcongty')->with('addsuccess','Đã sửa "' . $request->name_vn. '" thành công!');

    }
    public function viewNdoan($id_cty){
        $nghiepdoan=NghiepDoan::where('flag',0)->get();
        $nghiepdoan_congty=Nghiepdoan_Congty::where('id_congty',$id_cty)->pluck('id_nghiepdoan')->all();
        return view('admin.template.congty.viewnghiepdoan',['nghiepdoan'=>$nghiepdoan,'nghiepdoan_congty'=>$nghiepdoan_congty]);
    }
}
