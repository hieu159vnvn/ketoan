<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

Route::get('/logout', function () {
	Session::flush();
    Auth::logout();
    return redirect('/login');
});

Route::group(['middleware' => ['auth']], function() {

	Route::get('/', 'HomeController@danhsachhocvien');
	// Route::get('/', 'ThongKeTienThuDuocController@index');


	//nghiep doan
	Route::get('/addnghiepdoan','NghiepDoanController@getAddnghiepdoan')->middleware(['permission:add-nghiepdoan']);
	Route::post('addnghiepdoan','NghiepDoanController@postAddnghiepdoan');

	Route::get('/danhsachnghiepdoan','NghiepDoanController@danhsachnghiepdoan')->middleware(['permission:show-nghiepdoan']);

	Route::get('/deletenghiepdoan/{id}','NghiepDoanController@deletenghiepdoan')->middleware(['permission:del-nghiepdoan']);

	Route::get('/editnghiepdoan/{id}','NghiepDoanController@getEditnghiepdoan')->middleware(['permission:edit-nghiepdoan']);
	Route::post('editnghiepdoan/{id}','NghiepDoanController@postEditnghiepdoan');

	//phan quyen
	Route::get('/signup','NguoiDungController@getSignup')->name('user.signup')->middleware(['permission:add-taikhoan']);
	Route::post('/signup','NguoiDungController@postSignup')->name('user.signup');

	Route::get('/danhsachnguoidung','NguoiDungController@index')->middleware(['permission:show-nguoidung']);
	Route::get('/deletenguoidung/{id}','NguoiDungController@delete')->middleware(['permission:del-nguoidung']);

	Route::get('/editnguoidung/{id}','NguoiDungController@getEdit')->middleware(['permission:edit-nguoidung']);
	Route::post('editnguoidung/{id}','NguoiDungController@postEdit')->middleware(['permission:edit-nguoidung']);

	Route::get('/danhsachchucvu','ChucVuController@index')->middleware(['permission:show-chucvu']);
	Route::get('/deletechucvu/{id}','ChucVuController@delete')->middleware(['permission:del-chucvu']);

	Route::get('/addchucvu','ChucVuController@getAdd')->middleware(['permission:add-chucvu']);
	Route::post('addchucvu','ChucVuController@postAdd')->middleware(['permission:add-chucvu']);

	Route::get('/editchucvu/{id}','ChucVuController@getEdit')->middleware(['permission:edit-chucvu']);
	Route::post('editchucvu/{id}','ChucVuController@postEdit')->middleware(['permission:edit-chucvu']);
	//cong ty
	Route::get('/congty/{id}','CongTyController@index')->middleware(['permission:show-nghiepdoan-cty']);
	Route::get('/congty/{id}/addcongty','CongTyController@add')->middleware(['permission:add-cty']);
	Route::get('/deletecongty/{id_nd}/{id}','CongTyController@delete')->middleware(['permission:del-cty']);
	Route::get('/congty/editcompany/{id}','CongTyController@getEdit')->middleware(['permission:edit-cty']);
	Route::post('congty/editcompany/{id}','CongTyController@postEdit')->middleware(['permission:edit-cty']);
    Route::get('/danhsachcongty','CongTyController@danhsach')->middleware(['permission:list-cty']);
    Route::get('/danhsachcongty/delete/{id}','CongTyController@deletecongty')->middleware(['permission:list-cty-del']);
    Route::get('/danhsachcongty/edit/{id}','CongTyController@getEditcongty')->middleware(['permission:list-cty-edit']);
	Route::post('/danhsachcongty/edit/{id}','CongTyController@postEditcongty')->middleware(['permission:list-cty-edit']);
	Route::get('/danhsachcongty/xemnghiepdoan/{id}','CongTyController@viewNdoan')->middleware(['permission:list-view-nghiepdoan']);

	//ngan hang
	Route::get('/nganhang','NganHangController@index')->middleware(['permission:show-nganhang']);
	Route::get('/addnganhang','NganHangController@getAdd')->middleware(['permission:add-nganhang']);
	Route::post('/addnganhang','NganHangController@postAdd')->middleware(['permission:add-nganhang']);
	Route::get('/deletenganhang/{id}','NganHangController@delete')->middleware(['permission:del-nganhang']);
	Route::get('/editnganhang/{id}','NganHangController@getEdit')->middleware(['permission:edit-nganhang']);
	Route::post('/editnganhang/{id}','NganHangController@postEdit')->middleware(['permission:edit-nganhang']);

	//hoc vien
	Route::get('/hocvien/{id_ndoan}/{id_cty}','HomeController@gethocvien')->middleware(['permission:show-hocvien']);
	Route::get('/addhocvien/{id_ndoan}/{id_cty}','HomeController@getAdd')->middleware(['permission:add-hocvien']);
	Route::post('/addhocvien/{id_ndoan}/{id_cty}','HomeController@postAdd')->middleware(['permission:add-hocvien']);

	Route::get('/deletehocvien/{id}','HomeController@deletehocvien')->middleware(['permission:del-hocvien']);
	Route::get('/edithocvien/{id}','HomeController@getEdit')->middleware(['permission:edit-hocvien']);
	Route::post('/edithocvien/{id}','HomeController@postEdit')->middleware(['permission:edit-hocvien']);
	Route::get('/danhsachhocvien','HomeController@danhsachhocvien')->middleware(['permission:list-hocvien']);
	Route::get('/danhdauhocvienvenuoc/{id}','HomeController@danhdaudavenuoc')->middleware(['permission:list-hocvien']);

    Route::get('/datahocvien','HomeController@datahocvien')->name('datahv');
	//nganh nghe
	Route::get('/nganhnghe','NganhNgheController@index')->middleware(['permission:show-nganhnghe']);
	Route::get('/addnganhnghe','NganhNgheController@getAdd')->middleware(['permission:add-nganhnghe']);
	Route::post('/addnganhnghe','NganhNgheController@postAdd')->middleware(['permission:add-nganhnghe']);
	Route::get('/deletenganhnghe/{id}','NganhNgheController@delete')->middleware(['permission:del-nganhnghe']);
	Route::get('/editnganhnghe/{id}','NganhNgheController@getEdit')->middleware(['permission:edit-nganhnghe']);
	Route::post('/editnganhnghe/{id}','NganhNgheController@postEdit')->middleware(['permission:edit-nganhnghe']);
	//hoa don tien dao tao
	Route::get('/hoadontiendaotao','HoaDonTienDaoTaoController@index')->middleware(['permission:hoadontiendaotao']);
	Route::get('/hoadontiendaotao/{id}','HoaDonTienDaoTaoController@getdata')->middleware(['permission:hoadontiendaotao']);
	Route::post('/inhoadontiendaotao/{id_doan}','HoaDonTienDaoTaoController@print')->middleware(['permission:hoadontiendaotao']);
	//hoa don tien ve may bay
	Route::get('/hoadontienvemaybay','HoaDonTienVeMayBayController@index')->middleware(['permission:hoadontienvemaybay']);
	Route::get('/hoadontienvemaybay/{id}','HoaDonTienVeMayBayController@getdata')->middleware(['permission:hoadontienvemaybay']);
	Route::post('/inhoadontienvemaybay/{id_doan}','HoaDonTienVeMayBayController@print')->middleware(['permission:hoadontienvemaybay']);
	//hoa don tien quan ly
	Route::get('/hoadontienquanly','HoaDonTienQuanLyController@index')->middleware(['permission:hoadontienquanly']);
	Route::get('/gethoadontienquanly','HoaDonTienQuanLyController@getdata')->middleware(['permission:hoadontienquanly']);
	Route::get('/inhoadonquanly','HoaDonTienQuanLyController@inhoadonquanly')->middleware(['permission:hoadontienquanly']);
	//xac nhan seikyu
	Route::get('/xacnhanseikyu','XacNhanSeiKyuController@index')->middleware(['permission:xacnhanseikyu']);
	Route::get('/xacnhanseikyu/edit/{id}','XacNhanSeiKyuController@getEdit')->middleware(['permission:xacnhanseikyu']);
	Route::post('/xacnhanseikyu/edit/{id}','XacNhanSeiKyuController@postEdit')->middleware(['permission:xacnhanseikyu']);
	Route::get('/xacnhanseikyu/delete/{id}','XacNhanSeiKyuController@delete')->middleware(['permission:xacnhanseikyu']);
	// tat ca hoa don
	Route::get('/hoadon','HoaDonController@index')->middleware(['permission:show-hoadon']);
	Route::get('/hoadon/quanly/view/{ma_seikyu}','HoaDonController@view')->middleware(['permission:show-hoadon']);
	Route::get('/hoadon/quanly/edit/{id}','HoaDonController@getEditQuanly')->middleware(['permission:edit-hoadon']);
	Route::post('/hoadon/quanly/edit/{id}','HoaDonController@postEditQuanly')->middleware(['permission:edit-hoadon']);
	Route::get('/hoadon/daotaovavemaybay/edit/{id}','HoaDonController@getEditDTVMB')->middleware(['permission:edit-hoadon']);
	Route::post('/hoadon/daotaovavemaybay/edit/{id}','HoaDonController@postEditDTVMB')->middleware(['permission:edit-hoadon']);
	Route::get('/hoadon/quanly/delete/{id}','HoaDonController@deleteQuanly')->middleware(['permission:del-hoadon']);
	Route::get('/hoadon/daotaovavemaybay/delete/{id}','HoaDonController@deleteDTVMB')->middleware(['permission:del-hoadon']);
	//thong ke tien thu duoc
    Route::get('/thongketienthuduoc','ThongKeTienThuDuocController@index')->middleware(['permission:thongke']);
});


