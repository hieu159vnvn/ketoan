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
use App\Models\HocVien;



class NguoiDungController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function index(){
        $menu = NghiepDoan::orderBy('id','asc')->get();
        $users= User::all();
        return view('admin.template.nguoidung.index',['menu'=> $menu,'users' => $users]);
    }
    public function getSignup(){
        $menu = NghiepDoan::orderBy('id','asc')->get();
        $roles = Role::all();
        return view('admin.template.nguoidung.addnguoidung',[ 'menu'=> $menu, 'roles'=> $roles]);
    }
    public function postSignup(Request $request)
    {
        $this->validate($request, [     
            'email' => 'required|email|unique:users,email',
        ]);
        $user = User::create([
            'name'=> $request->name,
            'email'=> $request->email,
            'password'=> bcrypt($request->password),
        ]);
        $user->attachRole($request->roles);
        return redirect('danhsachnguoidung')->with('addsuccess','Thêm người dùng thành công');
    }
    public function delete($id){
        $user= User::find($id);
        $user->delete();
        return back()->with('addsuccess','Xóa thành công');
    }
    public function getEdit($id){
        $menu = NghiepDoan::orderBy('id','asc')->get();
        $user= User::find($id);
        $roles = Role::all();
        $select=$user->roles;
        return view('admin.template.nguoidung.edit',['menu'=> $menu,'user' => $user,'roles'=> $roles,'select'=> $select]);
    }
    public function postEdit($id,Request $request){
        $user= User::find($id);
        $user->name= $request->name;
        $user->email= $request->email;
        if(!empty($request->password)){
            $user->password=bcrypt($request->password);
        }
        else{
            $password = User::find($id);
            $passwordold = $password->password;
            $user->password = $passwordold;
        }
        $user->update();
        DB::table('role_user')->where('user_id',$id)->delete();
        $user->attachRole($request->roles);
        return redirect('danhsachnguoidung')->with('addsuccess','Sửa người dùng thành công!');
    }
}