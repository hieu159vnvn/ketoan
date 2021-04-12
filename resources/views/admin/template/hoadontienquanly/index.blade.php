@extends('admin.master')
@section('title', 'Hóa đơn tiền quản lý')
@section('PageContent')
<div class="row border-bottom bd-lightGray mt-4">
    <div class="col-md-4 text-center text-left-md">
        <h3 class="content_title m-0">Tạo hóa đơn (SEIKYU)</h3>
    </div>
    <div class="col-md-8 d-flex flex-justify-center flex-justify-end-md">
        <ul class="breadcrumbs bg-transparent m-0">
            <li class="page-item"><a class="page-link" href="/"><span class="mdi mdi-home"></span></a></li>
            <li class="page-item"><a class="page-link" href="#">Tạo hóa đơn (SEIKYU)</a></li>
        </ul>
    </div>
</div>
<section class="tables_wrapper">
    <aside class="tables_components">
        <div class="row">
            <div class="col-12">
                <div class="bg-white p-4">
                    <form class="d-flex" method="get" action="gethoadontienquanly">
                        <h6 class="mt-2 mr-2">Chọn nghiệp đoàn:</h6>
                        <select style="width:300px;"name="id_ndoan" data-role="select" id="select-nd" required>
                            <option value="Vui lòng chọn nghiệp đoàn" disabled selected>Vui lòng chọn nghiệp đoàn</option>
                            @foreach ($nghiepdoan as $item)
                            <option value="{{$item->id}}" >{{$item->name_vn}}</option>
                            @endforeach
                        </select>
                        <div class="d-flex mr-10 ml-10">
                            <p style="white-space:nowrap" class="mt-2 mr-2">Nhập số lượng tháng:</p>
                            <input type="number" name="sothang" style="width:60px" min="1" max="36" required >
                        </div>
                        <button class="image-button primary" ><span class="mif-loop2 icon"></span><span class="caption">Load thông tin</span></button>
                    </form>
                </div>
            </div>
        </div>
    </aside>
</section>
@endsection
@section('JsLibraries')
@endsection
