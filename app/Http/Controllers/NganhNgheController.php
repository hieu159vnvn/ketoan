<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\NganhNghe;
use Auth;

class NganhNgheController extends Controller
{
    //
    public function index(){
        $nganhnghe= NganhNghe::get();
        return view('admin.template.nganhnghe.index',['nganhnghe'=>$nganhnghe]);
    }
    public function getAdd(){
        return view('admin.template.nganhnghe.add');
    }
    public static function addnganhnghe($request,$item){
        DB::beginTransaction();
        try {
            $item->loainganh_jp = $request->loainganh_jp;
            $item->loainganh_vn = $request->loainganh_vn;
            $item->name_jp = $request->name_jp;
            $item->name_vn = $request->name_vn;
            $item->creator = Auth::user()->name;
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
        $item= new NganhNghe;
        $item->created_at = date("Y-m-d H:i:s");
        $item->updated_at = null;
        if(NganhNghe::where([['name_vn', $request->name_vn]])->count() > 0){
            return back()->with('error','Ngành nghề đã tồn tại');
        }
        else{
            if($this->addnganhnghe($request,$item)){
                return redirect('nganhnghe')->with('addsuccess', 'Đã thêm "' . $request->name_vn . '" thành công!');
            }
            return redirect('nganhnghe')->with('error','Đã thêm "' . $request->name_vn. '" không thành công!');
        }
    }
    public function delete($id){
        $item = NganhNghe::find($id);
        $item->delete();
        return redirect()->back()->with('addsuccess','Đã xóa thành công!');
    }
    public function getEdit($id){
        $nganhnghe=NganhNghe::find($id);
        return view('admin.template.nganhnghe.edit',['nganhnghe'=>$nganhnghe]);
    }
    public function postEdit(Request $request,$id){
        $nganhnghe=NganhNghe::find($id);
        $nganhnghe->updated_at = date("Y-m-d H:i:s");
        // if(NganhNghe::where([['name_vn', $request->name_vn]])->count() > 0){
        //     return back()->with('error','Ngành nghề đã tồn tại');
        // }
        // else{
            if($this->addnganhnghe($request,$nganhnghe)){
                return redirect('nganhnghe')->with('addsuccess', 'Đã sửa "' . $request->name_vn . '" thành công!');
            }
            return redirect('nganhnghe')->with('addsuccess','Đã sửa "' . $request->name_vn. '" không thành công!');
        // }
    }
}
