@extends('admin.master')
@section('title', 'Sửa hóa đơn')
@section('PageContent')
<div class="row border-bottom bd-lightGray mt-4">
    <div class="col-md-4 text-center text-left-md">
        <h3 class="content_title m-0">Sửa hóa đơn</h3>
    </div>
    <div class="col-md-8 d-flex flex-justify-center flex-justify-end-md">
        <ul class="breadcrumbs bg-transparent m-0">
            <li class="page-item"><a class="page-link" href="/"><span class="mdi mdi-home"></span></a></li>
            <li class="page-item"><a class="page-link" href="#">Sửa hóa đơn</a></li>
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
                    <div class="row flex-align-end">
                        <div class="form-group col-sm-6 mt-0">
                            <h6>Tài khoản nhận</h6>
                            <input type="text" data-role="input" name="tknhan" value="{{$hoadon->tknhan }}" >
                        </div>
                        <div class="form-group col-sm-6 mt-0">
                            <h6>Ngày nhận</h6>
                            <input class="date_picker" name="ngaynhan" value="{{$hoadon->ngaynhan }}" data-role="calendarpicker" >
                        </div>
                        <div class="form-group col-sm-6 mt-0">
                            <h6>Tổng tiền</h6>
                            <input type="text" data-role="input" name="tongtien" value="{{ $hoadon->tongtien }}¥" disabled>
                        </div>
                        <div class="form-group col-sm-6 mt-0">
                            <h6>Số tiền nhận</h6>
                            <input type="number" data-role="input" name="sotiennhan" value="{{ $hoadon->sotiennhan }}" >
                        </div>

                        <div class="form-group col-sm-12 mt-0">
                            <h6>Ghi chú</h6>
                            <textarea  data-role="textarea" name="ghichu">{{ $hoadon->ghichu }}</textarea>
                        </div>
                        <div class="form-group col-sm-12 mt-0">
                            <input name="tinhtrang" type="checkbox" tabindex="0"  {{ $hoadon->tinhtrang ==  1  ? 'checked' : '' }} data-role="switch" data-cls-switch="custom_switch" data-caption="Tình trạng thanh toán" data-cls-caption="fg-blue text-bold">
                        </div>
                        <div class="form-group col-sm-12 mt-0">
                            <a href="/xacnhanseikyu" class="mt-1 image-button"><span class="mif-backward icon"></span><span class="caption">Danh sách</span></a>
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

@endsection
