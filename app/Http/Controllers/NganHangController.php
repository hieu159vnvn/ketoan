<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\NganHang;
use Auth;
class NganHangController extends Controller
{
    //
    public function index(){
        $nganhang= NganHang::where('flag',0)->get();
        return view('admin.template.nganhang.index',['nganhang'=>$nganhang]);
    }
    public function getAdd(){
        return view('admin.template.nganhang.add');
    }
    public static function addnganhang($request,$item){
        DB::beginTransaction();
        try {
            $item->tennh = $request->tennh;
            $item->chinhanh = $request->chinhanh;
            $item->sochinhanh = $request->sochinhanh;
            $item->dc = $request->dc;
            $item->sdt = $request->sdt;
            $item->swiftcode = $request->swiftcode;
            $item->sotk = $request->sotk;
            $item->tentk = $request->tentk;
            $item->creator = Auth::user()->name;
            $item->flag = 0;
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
        $item= new NganHang;
        $item->created_at = date("Y-m-d H:i:s");
        $item->updated_at = null;
        if(NganHang::where([['tennh', $request->tennh],['flag',0]])->count() > 0){
            return back()->with('error','Ngân hàng đã tồn tại');
        }
        else{
            if($this->addnganhang($request,$item)){
                return redirect('nganhang')->with('addsuccess', 'Đã thêm "' . $request->tennh . '" thành công!');
            }
            return redirect('nganhang')->with('error','Đã thêm "' . $request->tennh. '" không thành công!');
        }
    }
    public function delete($id){
        $item = NganHang::find($id);
        $item->flag = 1 ;
        $item->save();
        return redirect()->back()->with('addsuccess','Đã xóa thành công!');
    }
    public function getEdit($id){
        $nganhang=NganHang::find($id);
        return view('admin.template.nganhang.edit',['nganhang'=>$nganhang]);
    }
    public function postEdit(Request $request,$id){
        $nganhang=NganHang::find($id);
        $nganhang->updated_at = date("Y-m-d H:i:s");


            if($this->addnganhang($request,$nganhang)){
                return redirect('nganhang')->with('addsuccess', 'Đã sửa "' . $request->tennh . '" thành công!');
            }
            return redirect('nganhang')->with('addsuccess','Đã sửa "' . $request->tennh. '" không thành công!');

    }
}
