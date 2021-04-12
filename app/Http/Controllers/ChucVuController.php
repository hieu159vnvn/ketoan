<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\NghiepDoan;
use App\User;
use Hash;
use Auth;
use App\Role;
use App\Permission;
use App\Models\HocVien;

class ChucVuController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function index(){
        $roles= Role::all();
        return view('admin.template.chucvu.index',['roles' => $roles]);
    }
    public function getAdd(){
        $permissions = Permission::all();
        return view('admin.template.chucvu.add',['permissions'=> $permissions]);
    }
    public function postAdd(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:roles,name',
        ]);
        $role=new Role();
        $role->name=$request->name;
        $role->display_name=$request->name;
        $role->description=$request->name;
        $role->save();

        foreach ($request->permissions as $key => $value) {
            $role->attachPermission($value);
        }
        return redirect('danhsachchucvu')->with('addsuccess','Thêm chức vụ thành công');
    }
    public function delete($id){

            DB::table('roles')->where('id',$id)->delete();
            return back()->with('addsuccess','Xoá chức vụ thành công');

    }
    public function getEdit($id){
        $role = Role::find($id);
        $permissions = Permission::all();
        $rolePermissions = DB::table("permission_role")->where("permission_role.role_id",$id)
        ->pluck('permission_role.permission_id','permission_role.permission_id')->all();
        return view('admin.template.chucvu.edit',['role'=> $role,'permissions'=> $permissions,'rolePermissions'=> $rolePermissions]);
    }
    public function postEdit($id,Request $request){
        $this->validate($request,[
            'permission' => 'required',
            'name' => 'required',
        ]);
        $role = Role::find($id);
        $role->name=$request->name;
        $role->display_name=$request->name;
        $role->description=$request->name;
        $role->save();
        DB::table("permission_role")->where("permission_role.role_id",$id)
            ->delete();
        foreach ($request->input('permission') as $key => $value) {
            $role->attachPermission($value);
        }
        return redirect('danhsachchucvu')->with('addsuccess','Sửa người dùng thành công!');
    }
}
