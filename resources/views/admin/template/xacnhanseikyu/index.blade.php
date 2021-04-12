@extends('admin.master')
@section('title', 'Xác nhận SeiKyu')
@section('PageContent')
<div class="row border-bottom bd-lightGray mt-4">
    <div class="col-md-4 text-center text-left-md">
        <h3 class="content_title m-0">Xác nhận SeiKyu</h3>
    </div>
    <div class="col-md-8 d-flex flex-justify-center flex-justify-end-md">
        <ul class="breadcrumbs bg-transparent m-0">
            <li class="page-item"><a class="page-link" href="/"><span class="mdi mdi-home"></span></a></li>
            <li class="page-item"><a class="page-link" href="#">Xác nhận SeiKyu</a></li>
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
                        <table class="table table-border cell-border" data-table-search-title="Tìm kiếm" data-table-rows-count-title="Hiển thị" id="table1" data-role="table" data-search-wrapper=".custom_table-search" data-rows-wrapper=".custom_table-rows" data-info-wrapper=".custom_table-info" data-pagination-wrapper=".custom_table-pagination" data-pagination-short-mode="true" data-horizontal-scroll="true" data-check="fakse" data-check-style="2" data-rownum="true" data-table-info-title="Hiển thị  $1 đến $2 trong $3 mục">
                            <thead>
                                <tr>
                                    <th>Mã SEIKYU</th>
                                    <th>Loại SEIKYU</th>
                                    <th>Nghiệp đoàn</th>
                                    <th>Tổng tiền</th>
                                    <th>Số tiền nhận</th>
                                    <th>Ngày nhận</th>
                                    <th>Tình trạng</th>
                                    <th>Tài khoản nhận</th>
                                    <th>Ghi chú</th>
                                    <th>Khoảng thời gian</th>
                                    <th>Người tạo</th>
                                    <th>Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($hoadon as $item)
                                    <tr>
                                        <td>{{$item->ma_seikyu}}</td>
                                        <td>{{$item->loai_seikyu}}</td>
                                        <td>
                                            @foreach ($nghiepdoan as $nd)
                                                @if($nd->id==$item->nghiepdoan_id)
                                                    {{$nd->name_vn}}
                                                @endif
                                            @endforeach
                                        </td>
                                        <td>{{number_format($item->tongtien)}}¥</td>
                                        <td>{{number_format($item->sotiennhan)}}¥</td>
                                        <td>@php
                                               if ($item->ngaynhan!=null) {
                                                echo(date('d-m-Y',strtotime($item->ngaynhan)));
                                               }
                                        @endphp</td>
                                        @if ($item->tinhtrang==1)
                                            <td><div class="fg-emerald"> Đã thanh toán</div></td>
                                        @else
                                            <td><div class="fg-magenta">Chưa thanh toán</div></td>
                                        @endif
                                        <td>{{str_limit($item->tknhan,10)}}</td>
                                        <td>{{str_limit($item->ghichu,10)}}</td>
                                        <td>{{$item->khoangthoigian}}</td>
                                        <td>{{$item->creator}}</td>

                                        <td >
                                            <div style="text-align: center;color:white">
                                                <a href="/xacnhanseikyu/edit/{{$item->id}}" class="mt-1 button cycle square primary"><span class="mif-wrench"></span></a>
                                                <a href="/hoadon/quanly/view/{{$item->ma_seikyu}}" class="mt-1 button cycle square warning"><span class="mif-eye"></span></a>
                                                <a onclick="return confirm('Bạn có chắc chắn muốn xóa? Lưu ý sau khi xóa sẽ không phục hồi lại được')" href="/xacnhanseikyu/delete/{{$item->id}}" class="mt-1 button cycle square alert"><span class="mif-bin"></span></a>
                                            </div>
                                        </td>
                                    </tr>
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
