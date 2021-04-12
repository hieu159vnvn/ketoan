@extends('admin.master')
@section('title', 'Edit Học Viên')
@section('PageContent')
<div class="row border-bottom bd-lightGray mt-4">
    <div class="col-md-4 text-center text-left-md">
        <h3 class="content_title m-0">Edit học viên</h3>
    </div>
    <div class="col-md-8 d-flex flex-justify-center flex-justify-end-md">
        <ul class="breadcrumbs bg-transparent m-0">
            <li class="page-item"><a class="page-link" href="/"><span class="mdi mdi-home"></span></a></li>
            <li class="page-item"><a class="page-link" href="#">Edit học viên</a></li>
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
                    <div class="flex-align-end" edu-card="0">
                        <div class="row" id="edu-card-list">
                            <div class="form-group col-sm-4 mt-0">
                                <h6>Họ và tên</h6>
                                <input type="text" data-role="input" name="name" value="{{ $hocvien->name }}" >
                            </div>
                            <div class="form-group col-sm-4 mt-0">
                                <h6>Ngày sinh</h6>
                                <input class="date_picker" name="ngaysinh" value="{{ $hocvien->ngaysinh}}" data-role="calendarpicker" >
                            </div>
                            <div class="form-group col-sm-4 mt-0">
                                <h6>Giới tính</h6>
                                <select name="gioitinh" data-role="select" data-filter-placeholder="Search...">
                                    <option value="Nam">Nam</option>
                                    <option value="Nữ">Nữ</option>
                                </select>
                            </div>
                            <div class="form-group col-sm-4 mt-0">
                                <h6>Quê quán</h6>
                                <input type="text" data-role="input" name="quequan" value="{{ $hocvien->quequan }}" >
                            </div>
                            <div class="form-group col-sm-4 mt-0">
                                <h6>Số điện thoại</h6>
                                <input type="text" data-role="input" name="tel" value="{{ $hocvien->tel }}" >
                            </div>
                            <div class="form-group col-sm-4 mt-0">
                                <h6>Đơn hàng</h6>
                                <input type="text" data-role="input" name="ma_donhang" value="{{ $hocvien->ma_donhang }}" >
                            </div>
                            <div class="form-group col-sm-4 mt-0">
                                <h6>Ngành</h6>
                                <select name="id_nganh" data-role="select" data-filter-placeholder="Search...">
                                    @foreach ($nganhnghe as $item)
                                        <option value="{{$item->id}}" {{ $item->id ==  $hocvien->id_nganh  ? 'selected' : '' }}>{{$item->name_vn}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-sm-4 mt-0">
                                <h6>Nghiệp đoàn</h6>
                                <select name="id_ndoan" data-role="select" data-filter-placeholder="Search...">
                                    @foreach ($nghiepdoan as $item)
                                        <option value="{{$item->id}}" {{ $item->id ==  $hocvien->id_ndoan  ? 'selected' : '' }}>{{$item->name_vn}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-sm-4 mt-0">
                                <h6>Công ty</h6>
                                <select name="id_congty" data-role="select" data-filter-placeholder="Search...">
                                    @foreach ($congty as $item)
                                        <option value="{{$item->id}}" {{ $item->id ==  $hocvien->id_cty  ? 'selected' : '' }}>{{$item->name_vn}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-sm-4 mt-0">
                                <h6>Tỉnh làm việc</h6>
                                <input type="text" data-role="input" name="tinh" value="{{ $hocvien->tinh }}" >
                            </div>
                            <div class="form-group col-sm-4 mt-0">
                                <h6>Giấy phép</h6>
                                <input type="text" data-role="input" name="gp" value="{{ $hocvien->gp }}" >
                            </div>
                            <div class="form-group col-sm-4 mt-0">
                                <h6>Phí thu</h6>
                                <input type="number" data-role="input" name="phi_thu" value="{{ $hocvien->phi_thu }}" >
                            </div>
                            <div class="form-group col-sm-4 mt-0">
                                <h6>Ngày thu đợt 1</h6>
                                <input class="date_picker" name="ngay_thudot1" value="{{ $hocvien->ngay_thudot1 }}" data-role="calendarpicker" >
                            </div>
                            <div class="form-group col-sm-4 mt-0">
                                <h6>Tiền thu đợt 1</h6>
                                <input type="number" data-role="input" name="tien_thudot1" value="{{ $hocvien->tien_thudot1 }}" >
                            </div>
                            <div class="form-group col-sm-4 mt-0">
                                <h6>Ngày thu đợt 2</h6>
                                <input class="date_picker" name="ngay_thudot2" value="{{ $hocvien->ngay_thudot2 }}" data-role="calendarpicker" >
                            </div>
                            <div class="form-group col-sm-4 mt-0">
                                <h6>Tiền thu đợt 2</h6>
                                <input type="number" data-role="input" name="tien_thudot2" value="{{ $hocvien->tien_thudot2 }}" >
                            </div>
                            <div class="form-group col-sm-4 mt-0">
                                <h6>Ngày thu đợt 3</h6>
                                <input class="date_picker" name="ngay_thudot3" value="{{ $hocvien->ngay_thudot3 }}" data-role="calendarpicker" >
                            </div>
                            <div class="form-group col-sm-4 mt-0">
                                <h6>Tiền thu đợt 3</h6>
                                <input type="number" data-role="input" name="tien_thudot3" value="{{ $hocvien->tien_thudot3 }}" >
                            </div>
                            <div class="form-group col-sm-4 mt-0">
                                <h6>Phí tạo nguồn</h6>
                                <input type="number" data-role="input" name="phi_nguon" value="{{ $hocvien->phi_nguon }}" >
                            </div>
                            <div class="form-group col-sm-4 mt-0">
                                <h6>Phí đào tạo nguồn đợt 1</h6>
                                <input type="number" data-role="input" name="phi_dtnguon1" value="{{ $hocvien->phi_dtnguon1 }}" >
                            </div>
                            <div class="form-group col-sm-4 mt-0">
                                <h6>Phí đào tạo nguồn đợt 2</h6>
                                <input type="number" data-role="input" name="phi_dtnguon2" value="{{ $hocvien->phi_dtnguon2 }}" >
                            </div>
                            <div class="form-group col-sm-4 mt-0">
                                <h6>Ngày trúng tuyển</h6>
                                <input class="date_picker" name="ngay_trungtuyen" value="{{ $hocvien->ngay_trungtuyen }}" data-role="calendarpicker" >
                            </div>
                            <div class="form-group col-sm-4 mt-0">
                                <h6>Ngày xuất cảnh</h6>
                                <input class="date_picker" name="ngay_xc" value="{{ $hocvien->ngay_xc }}" data-role="calendarpicker" >
                            </div>
                            <div class="form-group col-sm-4 mt-0">
                                <h6>Công ty chứng nghề</h6>
                                <input type="text" data-role="input" name="cty_nghe" value="{{ $hocvien->cty_nghe }}" >
                            </div>
                            <div class="form-group col-sm-4 mt-0">
                                <h6>Tiền vé</h6>
                                <input type="number" data-role="input" name="tien_ve" value="{{ $hocvien->tien_ve }}" >
                            </div>
                            <div class="form-group col-sm-4 mt-0">
                                <h6>Tiền đào tạo</h6>
                                <input type="number" data-role="input" name="tien_daotao" value="{{ $hocvien->tien_daotao }}" >
                            </div>
                            <div class="form-group col-sm-4 mt-0">
                                <h6>Tiền quản lí</h6>
                                <input type="number" data-role="input" name="tien_quanly" value="{{ $hocvien->tien_quanly }}" >
                            </div>
                            <div class="form-group col-sm-4 mt-0">
                                <h6>Ghi chú</h6>
                                <input type="text" data-role="input" name="ghichu" value="{{ $hocvien->ghichu }}" >
                            </div>
                            @if ($hocvien->solan!=999)
                            <div class="form-group col-sm-4" style="margin-top: 51px !important">
                                <a onclick="return confirm('Bạn có chắc chắn muốn đánh dấu học viên về nước? Lưu ý sau khi đánh dấu sẽ không phục hồi lại được')" href="/danhdauhocvienvenuoc/{{$hocvien->id}}" class="image-button secondary" ><span class="mif-airplane icon"></span><span class="caption">Đánh dấu đã về nước</span></a>
                            </div>
                            @endif
                        </div>
                        <div class="form-group col-sm-4 mt-0">
                            <a href="/hocvien/{{ $hocvien->id_ndoan }}/{{ $hocvien->id_congty }}" class="mt-1 image-button"><span class="mif-backward icon"></span><span class="caption">Danh sách</span></a>
                            <button class="mt-1 image-button primary"><span class="mif-checkmark icon"></span><span class="caption">Lưu</span></button>
                        </div>
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
