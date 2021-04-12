@extends('admin.master')
@section('title', 'Sửa hóa đơn tiền quản lý')
@section('PageContent')
<div class="row border-bottom bd-lightGray mt-4">
    <div class="col-md-4 text-center text-left-md">
        <h3 class="content_title m-0">Sửa hóa đơn tiền quản lý</h3>
    </div>
    <div class="col-md-8 d-flex flex-justify-center flex-justify-end-md">
        <ul class="breadcrumbs bg-transparent m-0">
            <li class="page-item"><a class="page-link" href="/"><span class="mdi mdi-home"></span></a></li>
            <li class="page-item"><a class="page-link" href="#">Sửa hóa đơn tiền quản lý</a></li>
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
                            <h6>Nghiệp đoàn</h6>
                            <select name="id_ndoan" data-role="select" data-filter-placeholder="Search...">
                                @foreach ($nghiepdoan as $item)
                                    <option value="{{$item->id}}" {{ $item->id ==  $quanly->id_ndoan  ? 'selected' : '' }}>{{$item->name_vn}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-sm-6 mt-0">
                            <h6>Mã SEIKYU</h6>
                            <input type="text" data-role="input" name="ma_seikyu" value="{{ $quanly->ma_seikyu }}" >
                        </div>
                        <div class="form-group col-sm-6 mt-0">
                            <h6>Công ty</h6>
                            <select name="id_congty" data-role="select" data-filter-placeholder="Search...">
                                @foreach ($congty as $item)
                                    <option value="{{$item->id}}" {{ $item->id ==  $quanly->id_cty  ? 'selected' : '' }}>{{$item->name_vn}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-sm-6 mt-0">
                            <h6>Ngày nhập quốc</h6>
                            <input class="date_picker" name="ngay_nhapquoc" value="{{$quanly->ngay_nhapquoc }}" data-role="calendarpicker" >
                        </div>
                        <div class="form-group col-sm-6 mt-0">
                            <h6>Số lần</h6>
                            <input type="number" data-role="input" name="solan" value="{{ $quanly->solan }}" >
                        </div>
                        <div class="form-group col-sm-6 mt-0">
                            <h6>Số nguời</h6>
                            <input type="number" data-role="input" name="songuoi" value="{{ $quanly->songuoi }}" >
                        </div>
                        <div class="form-group col-sm-6 mt-0">
                            <h6>Đơn giá</h6>
                            <input type="number" data-role="input" name="dongia" value="{{ $quanly->dongia }}" >
                        </div>
                        <div class="form-group col-sm-6 mt-0">
                            <h6>Số tháng</h6>
                            <input type="number" data-role="input" name="sothang" value="{{ $quanly->sothang }}" >
                        </div>
                        <div class="form-group col-sm-6 mt-0">
                            <h6>Thời gian from</h6>
                            <input type="text" data-role="input" name="tg_from" value="{{ $quanly->tg_from }}" >
                        </div>
                        <div class="form-group col-sm-6 mt-0">
                            <h6>Thời gian to</h6>
                            <input type="text" data-role="input" name="tg_to" value="{{ $quanly->tg_to }}" >
                        </div>
                        <div class="form-group col-sm-6 mt-0">
                            <h6>Số tiền</h6>
                            <input type="number" data-role="input" name="sotien" value="{{ $quanly->sotien }}" >
                        </div>
                        <div class="form-group col-sm-12 mt-0">
                            <h6>Ghi chú</h6>
                            <textarea  data-role="textarea" name="ghichu">{{ $quanly->ghichu }}</textarea>
                        </div>
                        <div class="form-group col-sm-12 mt-0">
                            <a href="/hoadon" class="mt-1 image-button"><span class="mif-backward icon"></span><span class="caption">Danh sách</span></a>
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
