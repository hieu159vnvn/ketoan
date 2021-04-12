@extends('admin.master')
@section('title', 'Danh sách nghiệp đoàn của công ty')
@section('PageContent')
<div class="row border-bottom bd-lightGray mt-4">
    <div class="col-md-4 text-center text-left-md">
        <h3 class="content_title m-0">Danh sách nghiệp đoàn của công ty</h3>
    </div>
    <div class="col-md-8 d-flex flex-justify-center flex-justify-end-md">
        <ul class="breadcrumbs bg-transparent m-0">
            <li class="page-item"><a class="page-link" href="/"><span class="mdi mdi-home"></span></a></li>
            <li class="page-item"><a class="page-link" href="#">Danh sách nghiệp đoàn của công ty</a></li>
        </ul>
    </div>
</div>
<section class="tables_wrapper">
    <aside class="tables_components">
        <div class="row">
            <div class="col-12">
                <div class="bg-white p-4">
                    <div class="custom_table-wrapper">
                        <div class="custom_table-top d-flex flex-wrap flex-nowrap-lg flex-align-center flex-justify-center flex-justify-start-lg mb-2">
                            <div class="custom_table-search w-100 w-auto-lg mb-2 mb-0-lg"></div>
                            <div class="custom_table-rows mx-2"></div>
                        </div>
                        <table class="table table-border cell-border" data-table-search-title="Tìm kiếm" data-table-rows-count-title="Hiển thị" id="table1" data-role="table" data-search-wrapper=".custom_table-search" data-rows-wrapper=".custom_table-rows" data-info-wrapper=".custom_table-info" data-pagination-wrapper=".custom_table-pagination" data-pagination-short-mode="true" data-horizontal-scroll="true" data-check="false" data-check-style="2" data-rownum="true" data-table-info-title="Hiển thị  $1 đến $2 trong $3 mục">
                            <thead>
                                <tr>
                                    <th>Tên nghiệp đoàn tiếng Việt</th>
                                    <th>Tên nghiệp đoàn tiếng Nhật</th>
                                    <th>Địa chỉ </th>
                                    <th>Số điện thoại</th>
                                    <th>Số fax</th>
                                    <th>Mã bưu điện</th>
                                    <th>Ghi chú</th>
                                    <th>Thao tác</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($nghiepdoan as $item)
                                    @if (in_array($item->id, $nghiepdoan_congty))
                                        <tr>
                                            <td>{{$item->name_vn}}</td>
                                            <td>{{$item->name_jp}}</td>
                                            <td>{{$item->add_jp}}<br>{{$item->add_vn}}</td>
                                            <td>{{$item->tel}}</td>
                                            <td>{{$item->fax}}</td>
                                            <td>{{$item->postcode}}</td>
                                            <td>{{$item->note}}</td>
                                            <td >
                                                <div style="text-align: center;color:white;width:77px">
                                                    @permission('edit-nghiepdoan')
                                                    <a href="/editnghiepdoan/{{$item->id}}" class="mt-1 button cycle square primary"><span class="mif-wrench"></span></a>
                                                    @endpermission
                                                    @permission('del-nghiepdoan')
                                                    <a href="/deletenghiepdoan/{{$item->id}}" class="mt-1 button cycle square alert btn-delete"><span class="mif-cross"></span></a>
                                                    @endpermission
                                                </div>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                        <div class="custom_table-bottom d-flex flex-wrap flex-nowrap-lg flex-align-center flex-justify-center flex-justify-start-lg mb-2">
                            <div class="custom_table-info w-100 w-auto-lg mb-2 mb-0-lg"></div>
                            <div class="custom_table-pagination ml-auto-lg"></div>
                            <div class="content"></div>
                        </div>
                    </div>
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
