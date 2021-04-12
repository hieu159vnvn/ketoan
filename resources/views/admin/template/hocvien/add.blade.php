@extends('admin.master')
@section('title', 'Thêm Học Viên')
@section('PageContent')
<div class="row border-bottom bd-lightGray mt-4">
    <div class="col-md-4 text-center text-left-md">
        <h3 class="content_title m-0">Thêm học viên</h3>
    </div>
    <div class="col-md-8 d-flex flex-justify-center flex-justify-end-md">
        <ul class="breadcrumbs bg-transparent m-0">
            <li class="page-item"><a class="page-link" href="/"><span class="mdi mdi-home"></span></a></li>
            <li class="page-item"><a class="page-link" href="#">Thêm học viên</a></li>
        </ul>
    </div>
</div>
<section class="forms_wrapper">
    <aside class="forms_extended">
        <div class="row">
            <div class="col-12">
                <div class="bg-white p-4">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form class="ui form" action="" method="post" name="form_1">
                    {{ csrf_field() }}
                    <div class="flex-align-end" edu-card="0" id="parent">
                        <div class="row" id="edu-card-list-1">
                            <div class="form-group col-sm-4 mt-0">
                                <h6>Họ và tên</h6>
                                <input type="text" data-role="input" name="name[]" value="{{ old('name') }}" >
                            </div>
                            <div class="form-group col-sm-4 mt-0">
                                <h6>Ngày sinh</h6>
                                <input class="date_picker" name="ngaysinh[]" value="{{ old('ngaysinh') }}" data-role="calendarpicker" >
                            </div>
                            <div class="form-group col-sm-4 mt-0">
                                <h6>Giới tính</h6>
                                <select name="gioitinh[]" data-role="select" data-filter-placeholder="Search...">
                                    <option value="Nam">Nam</option>
                                    <option value="Nữ">Nữ</option>
                                </select>
                            </div>
                            <div class="form-group col-sm-4 mt-0">
                                <h6>Quê quán</h6>
                                <input type="text" data-role="input" name="quequan[]" value="{{ old('quequan') }}" >
                            </div>
                            <div class="form-group col-sm-4 mt-0">
                                <h6>Số điện thoại</h6>
                                <input type="text" data-role="input" name="tel[]" value="{{ old('tel') }}" >
                            </div>
                            <div class="form-group col-sm-4 mt-0">
                                <h6>Đơn hàng</h6>
                                <input type="text" data-role="input" name="ma_donhang[]" value="{{ old('ma_donhang') }}" >
                            </div>
                            <div class="form-group col-sm-4 mt-0">
                                <h6>Ngành</h6>
                                <select name="id_nganh[]" data-role="select" data-filter-placeholder="Search...">
                                    @foreach ($nganhnghe as $item)
                                        <option value="{{$item->id}}">{{$item->name_vn}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-sm-4 mt-0">
                                <h6>Nghiệp đoàn</h6>
                                <select name="id_ndoan[]" data-role="select" data-filter-placeholder="Search...">
                                    @foreach ($nghiepdoan as $item)
                                        <option value="{{$item->id}}" {{ $item->id ==  $id_ndoan  ? 'selected' : '' }}>{{$item->name_vn}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-sm-4 mt-0">
                                <h6>Công ty</h6>
                                <select name="id_congty[]" data-role="select" data-filter-placeholder="Search...">
                                    @foreach ($congty as $item)
                                        <option value="{{$item->id}}" {{ $item->id ==  $id_cty  ? 'selected' : '' }}>{{$item->name_vn}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-sm-4 mt-0">
                                <h6>Tỉnh làm việc</h6>
                                <input type="text" data-role="input" name="tinh[]" value="{{ old('tinh') }}" >
                            </div>
                            <div class="form-group col-sm-4 mt-0">
                                <h6>Giấy phép</h6>
                                <input type="text" data-role="input" name="gp[]" value="{{ old('gp') }}" >
                            </div>
                            <div class="form-group col-sm-4 mt-0">
                                <h6>Phí thu</h6>
                                <input type="number" data-role="input" name="phi_thu[]" value="{{ old('phi_thu') }}" >
                            </div>
                            <div class="form-group col-sm-4 mt-0">
                                <h6>Ngày thu đợt 1</h6>
                                <input class="date_picker" name="ngay_thudot1[]" value="{{ old('ngay_thudot1') }}" data-role="calendarpicker" >
                            </div>
                            <div class="form-group col-sm-4 mt-0">
                                <h6>Tiền thu đợt 1</h6>
                                <input type="number" data-role="input" name="tien_thudot1[]" value="{{ old('tien_thudot1') }}" >
                            </div>
                            <div class="form-group col-sm-4 mt-0">
                                <h6>Ngày thu đợt 2</h6>
                                <input class="date_picker" name="ngay_thudot2[]" value="{{ old('ngay_thudot2') }}" data-role="calendarpicker" >
                            </div>
                            <div class="form-group col-sm-4 mt-0">
                                <h6>Tiền thu đợt 2</h6>
                                <input type="number" data-role="input" name="tien_thudot2[]" value="{{ old('tien_thudot2') }}" >
                            </div>
                            <div class="form-group col-sm-4 mt-0">
                                <h6>Ngày thu đợt 3</h6>
                                <input class="date_picker" name="ngay_thudot3[]" value="{{ old('ngay_thudot3') }}" data-role="calendarpicker" >
                            </div>
                            <div class="form-group col-sm-4 mt-0">
                                <h6>Tiền thu đợt 3</h6>
                                <input type="number" data-role="input" name="tien_thudot3[]" value="{{ old('tien_thudot3') }}" >
                            </div>
                            <div class="form-group col-sm-4 mt-0">
                                <h6>Phí tạo nguồn</h6>
                                <input type="number" data-role="input" name="phi_nguon[]" value="{{ old('phi_nguon') }}" >
                            </div>
                            <div class="form-group col-sm-4 mt-0">
                                <h6>Phí đào tạo nguồn đợt 1</h6>
                                <input type="number" data-role="input" name="phi_dtnguon1[]" value="{{ old('phi_dtnguon1') }}" >
                            </div>
                            <div class="form-group col-sm-4 mt-0">
                                <h6>Phí đào tạo nguồn đợt 2</h6>
                                <input type="number" data-role="input" name="phi_dtnguon2[]" value="{{ old('phi_dtnguon2') }}" >
                            </div>
                            <div class="form-group col-sm-4 mt-0">
                                <h6>Ngày trúng tuyển</h6>
                                <input class="date_picker" name="ngay_trungtuyen[]" value="{{ old('ngay_trungtuyen') }}" data-role="calendarpicker" >
                            </div>
                            <div class="form-group col-sm-4 mt-0">
                                <h6>Ngày xuất cảnh</h6>
                                <input class="date_picker" name="ngay_xc[]" value="{{ old('ngay_xc') }}" data-role="calendarpicker" >
                            </div>
                            <div class="form-group col-sm-4 mt-0">
                                <h6>Công ty chứng nghề</h6>
                                <input type="text" data-role="input" name="cty_nghe[]" value="{{ old('cty_nghe') }}" >
                            </div>
                            <div class="form-group col-sm-4 mt-0">
                                <h6>Tiền vé</h6>
                                <input type="number" data-role="input" name="tien_ve[]" value="{{ old('tien_ve') }}" >
                            </div>
                            <div class="form-group col-sm-4 mt-0">
                                <h6>Tiền đào tạo</h6>
                                <input type="number" data-role="input" name="tien_daotao[]" value="{{ old('tien_daotao') }}" >
                            </div>
                            <div class="form-group col-sm-4 mt-0">
                                <h6>Tiền quản lí</h6>
                                <input type="number" data-role="input" name="tien_quanly[]" value="{{ old('tien_quanly') }}" >
                            </div>
                            <div class="form-group col-sm-4 mt-0">
                                <h6>Ghi chú</h6>
                                <input type="text" data-role="input" name="ghichu[]" value="{{ old('ghichu') }}" >
                            </div>
                            <div class="image-button remove mt-14"><span class="mif-cancel icon"></span><span class="caption">Xóa</span></div>
                            <div class="col-sm-12" style="border-bottom:1px solid #eaafaf;padding-bottom:10px"></div>
                        </div>
                    </div>
                    <div class="form-group col-sm-42 mt-0">
                        <div class="image-button primary add"><span class="mif-plus icon"></span><span class="caption">Thêm</span></div>
                        <button class="mt-0 image-button primary"><span class="mif-checkmark icon"></span><span class="caption">Lưu</span></button>
                        <a href="/hocvien/{{$id_ndoan}}/{{$id_cty}}" class="mt-0 image-button"><span class="mif-backward icon"></span><span class="caption">Danh sách</span></a>

                    </div>
                </form>
                </div>
            </div>
        </div>
    </aside>
</section>
@endsection
@section('JsLibraries')
    <script>
        $(document).on('click', '.add', function(event) {
		event.preventDefault();
		var count = parseInt($('#parent').attr('edu-card')) + 1;
        var html = '<div class="row" id="edu-card-list-'+count+'" style="border-bottom:1px solid #eaafaf;padding-bottom:10px">  <div class="form-group col-sm-4 mt-0">    <h6>Họ và tên</h6>    <input type="text" data-role="input" name="name[]" value="{{ old('name') }}" ></div><div class="form-group col-sm-4 mt-0">    <h6>Ngày sinh</h6>    <input class="date_picker" name="ngaysinh[]" value="{{ old('ngaysinh') }}" data-role="calendarpicker" ></div><div class="form-group col-sm-4 mt-0">    <h6>Giới tính</h6>    <select name="gioitinh[]" data-role="select" data-filter-placeholder="Search...">        <option value="Nam">Nam</option>        <option value="Nữ">Nữ</option>    </select></div><div class="form-group col-sm-4 mt-0">    <h6>Quê quán</h6>    <input type="text" data-role="input" name="quequan[]" value="{{ old('quequan') }}" ></div><div class="form-group col-sm-4 mt-0">    <h6>Số điện thoại</h6>    <input type="text" data-role="input" name="tel[]" value="{{ old('tel') }}" ></div><div class="form-group col-sm-4 mt-0">    <h6>Đơn hàng</h6>    <input type="text" data-role="input" name="ma_donhang[]" value="{{ old('ma_donhang') }}" ></div><div class="form-group col-sm-4 mt-0">    <h6>Ngành</h6>    <select name="id_nganh[]" data-role="select" data-filter-placeholder="Search...">        @foreach ($nganhnghe as $item)            <option value="{{$item->id}}">{{$item->name_vn}}</option>        @endforeach    </select></div><div class="form-group col-sm-4 mt-0">    <h6>Nghiệp đoàn</h6>    <select name="id_ndoan[]" data-role="select" data-filter-placeholder="Search...">        @foreach ($nghiepdoan as $item)            <option value="{{$item->id}}" {{ $item->id ==  $id_ndoan  ? 'selected' : '' }}>{{$item->name_vn}}</option>        @endforeach    </select></div><div class="form-group col-sm-4 mt-0">    <h6>Công ty</h6>    <select name="id_congty[]" data-role="select" data-filter-placeholder="Search...">        @foreach ($congty as $item)            <option value="{{$item->id}}" {{ $item->id ==  $id_cty  ? 'selected' : '' }}>{{$item->name_vn}}</option>        @endforeach    </select></div><div class="form-group col-sm-4 mt-0">    <h6>Tỉnh làm việc</h6>    <input type="text" data-role="input" name="tinh[]" value="{{ old('tinh') }}" ></div><div class="form-group col-sm-4 mt-0">    <h6>Giấy phép</h6>    <input type="text" data-role="input" name="gp[]" value="{{ old('gp') }}" ></div><div class="form-group col-sm-4 mt-0">    <h6>Phí thu</h6>    <input type="number" data-role="input" name="phi_thu[]" value="{{ old('phi_thu') }}" ></div><div class="form-group col-sm-4 mt-0">    <h6>Ngày thu đợt 1</h6>    <input class="date_picker" name="ngay_thudot1[]" value="{{ old('ngay_thudot1') }}" data-role="calendarpicker" ></div><div class="form-group col-sm-4 mt-0">    <h6>Tiền thu đợt 1</h6>    <input type="number" data-role="input" name="tien_thudot1[]" value="{{ old('tien_thudot1') }}" ></div><div class="form-group col-sm-4 mt-0">    <h6>Ngày thu đợt 2</h6>    <input class="date_picker" name="ngay_thudot2[]" value="{{ old('ngay_thudot2') }}" data-role="calendarpicker" ></div><div class="form-group col-sm-4 mt-0">    <h6>Tiền thu đợt 2</h6>    <input type="number" data-role="input" name="tien_thudot2[]" value="{{ old('tien_thudot2') }}" ></div><div class="form-group col-sm-4 mt-0">    <h6>Ngày thu đợt 3</h6>    <input class="date_picker" name="ngay_thudot3[]" value="{{ old('ngay_thudot3') }}" data-role="calendarpicker" ></div><div class="form-group col-sm-4 mt-0">    <h6>Tiền thu đợt 3</h6>    <input type="number" data-role="input" name="tien_thudot3[]" value="{{ old('tien_thudot3') }}" ></div><div class="form-group col-sm-4 mt-0">    <h6>Phí tạo nguồn</h6>    <input type="number" data-role="input" name="phi_nguon[]" value="{{ old('phi_nguon') }}" ></div><div class="form-group col-sm-4 mt-0">    <h6>Phí đào tạo nguồn đợt 1</h6>    <input type="number" data-role="input" name="phi_dtnguon1[]" value="{{ old('phi_dtnguon1') }}" ></div><div class="form-group col-sm-4 mt-0">    <h6>Phí đào tạo nguồn đợt 2</h6>    <input type="number" data-role="input" name="phi_dtnguon2[]" value="{{ old('phi_dtnguon2') }}" ></div><div class="form-group col-sm-4 mt-0">    <h6>Ngày trúng tuyển</h6>    <input class="date_picker" name="ngay_trungtuyen[]" value="{{ old('ngay_trungtuyen') }}" data-role="calendarpicker" ></div><div class="form-group col-sm-4 mt-0">    <h6>Ngày xuất cảnh</h6>    <input class="date_picker" name="ngay_xc[]" value="{{ old('ngay_xc') }}" data-role="calendarpicker" ></div><div class="form-group col-sm-4 mt-0">    <h6>Công ty chứng nghề</h6>    <input type="text" data-role="input" name="cty_nghe[]" value="{{ old('cty_nghe') }}" ></div><div class="form-group col-sm-4 mt-0">    <h6>Tiền vé</h6>    <input type="number" data-role="input" name="tien_ve[]" value="{{ old('tien_ve') }}" ></div><div class="form-group col-sm-4 mt-0">    <h6>Tiền đào tạo</h6>    <input type="number" data-role="input" name="tien_daotao[]" value="{{ old('tien_daotao') }}" ></div><div class="form-group col-sm-4 mt-0">    <h6>Tiền quản lí</h6>    <input type="number" data-role="input" name="tien_quanly[]" value="{{ old('tien_quanly') }}" ></div><div class="form-group col-sm-4 mt-0">    <h6>Ghi chú</h6>    <input type="text" data-role="input" name="ghichu[]" value="{{ old('ghichu') }}" ></div>  <div class="image-button remove mt-14"><span class="mif-cancel icon"></span><span class="caption">Xóa</span></div></div>';
        $('#parent').append(html);
		$('#parent').attr( 'edu-card', count );
	});
	$(document).on('click','.remove',function(event){
        event.preventDefault();
		$(this).parent().remove();
    });
    </script>
    <script>
        var msg = '{{Session::get('addsuccess')}}';
        var exist = '{{Session::has('addsuccess')}}';
        if(exist){
            Swal.fire({
            position: 'top-end',
            icon: 'success',
            title: msg,
            showConfirmButton: false,
            timer: 1500
            })
        }
    </script>
@endsection
