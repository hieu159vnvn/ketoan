@extends('admin.master')
@section('title', 'Sửa hóa đơn đào tạo và vé máy bay')
@section('PageContent')
<div class="row border-bottom bd-lightGray mt-4">
    <div class="col-md-4 text-center text-left-md">
        <h3 class="content_title m-0">Sửa hóa đơn đào tạo và vé máy bay</h3>
    </div>
    <div class="col-md-8 d-flex flex-justify-center flex-justify-end-md">
        <ul class="breadcrumbs bg-transparent m-0">
            <li class="page-item"><a class="page-link" href="/"><span class="mdi mdi-home"></span></a></li>
            <li class="page-item"><a class="page-link" href="#">Sửa hóa đơn đào tạo và vé máy bay</a></li>
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
                                    <option value="{{$item->id}}" {{ $item->id ==  $tiendaotaovavemaybay->id_ndoan  ? 'selected' : '' }}>{{$item->name_vn}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-sm-6 mt-0">
                            <h6>Mã SEIKYU</h6>
                            <input type="text" data-role="input" name="ma_seikyu" value="{{ $tiendaotaovavemaybay->ma_seikyu }}" >
                        </div>
                        <div class="form-group col-sm-6 mt-0">
                            <h6>Công ty</h6>
                            <select name="id_congty" data-role="select" data-filter-placeholder="Search...">
                                @foreach ($congty as $item)
                                    <option value="{{$item->id}}" {{ $item->id ==  $tiendaotaovavemaybay->id_cty  ? 'selected' : '' }}>{{$item->name_vn}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-sm-6 mt-0">
                            <h6>Ngày nhập quốc</h6>
                            <input class="date_picker" name="ngay_nhapquoc" value="{{$tiendaotaovavemaybay->ngay_nhapquoc }}" data-role="datepicker" data-distance="1" data-cls-picker="shadow-2" data-cls-day="no-border bg-blue fg-white" data-cls-month="no-border" data-cls-year="no-border">
                        </div>
                        <div class="form-group col-sm-6 mt-0">
                            <h6>Số nguời</h6>
                            <input type="number" data-role="input" name="songuoi" value="{{ $tiendaotaovavemaybay->songuoi }}" >
                        </div>
                        <div class="form-group col-sm-6 mt-0">
                            <h6>Đơn giá USD</h6>
                            <input type="number" data-role="input" name="dongia_usd" value="{{ $tiendaotaovavemaybay->dongia_usd }}" >
                        </div>
                        <div class="form-group col-sm-6 mt-0">
                            <h6>Đơn giá Yên</h6>
                            <input type="number" data-role="input" name="dongia_yen" value="{{ $tiendaotaovavemaybay->dongia_yen }}" >
                        </div>
                        <div class="form-group col-sm-6 mt-0">
                            <h6>Số tiền</h6>
                            <input type="number" data-role="input" name="sotien" value="{{ $tiendaotaovavemaybay->sotien }}" >
                        </div>
                        <div class="form-group col-sm-12 mt-0">
                            <h6>Ghi chú</h6>
                            <textarea  data-role="textarea" name="ghichu">{{ $tiendaotaovavemaybay->ghichu }}</textarea>
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
