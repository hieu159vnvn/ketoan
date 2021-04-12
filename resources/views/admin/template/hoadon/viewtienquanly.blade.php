@extends('admin.master')
@section('title', 'Xem hóa đơn')
@section('PageContent')
<div class="row border-bottom bd-lightGray mt-4">
    <div class="col-md-4 text-center text-left-md">
        <h3 class="content_title m-0">Xem hóa đơn</h3>
    </div>
    <div class="col-md-8 d-flex flex-justify-center flex-justify-end-md">
        <ul class="breadcrumbs bg-transparent m-0">
            <li class="page-item"><a class="page-link" href="/"><span class="mdi mdi-home"></span></a></li>
            <li class="page-item"><a class="page-link" href="#">Xem hóa đơn</a></li>
        </ul>
    </div>
</div>
<section class="tables_wrapper">
    <aside class="tables_components">
        <div class="row">
            <div class="col-12">
                <div class="bg-white p-4">
                    <div class="custom_table-wrapper">
                        <table class="table table-border cell-border" >
                            <thead>
                                <tr>
                                    <th>Mã SEIKYU</th>
                                    <th>Loại SEIKYU </th>
                                    <th>Nghiệp đoàn</th>
                                    <th>Công ty</th>
                                    <th>Ngày nhập quốc</th>
                                    <th>Số lần</th>
                                    <th>Số người</th>
                                    <th>Đơn giá</th>
                                    <th>Số tháng</th>
                                    <th>Thời gian from</th>
                                    <th>Thời gian to</th>
                                    <th>Tổng số tiền</th>
                                    <th>Người tạo</th>
                                    <th>Ghi chú</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($hoadontienquanly as $item)
                                <tr>
                                    <td>{{$item->ma_seikyu}}</td>
                                    <td>Tiền quản lý</td>
                                    <td>
                                        @foreach ($nghiepdoan as $nd)
                                            @if($nd->id==$item->id_ndoan)
                                                {{$nd->name_vn}}
                                            @endif
                                        @endforeach
                                    </td>
                                    <td>
                                        @foreach ($congty as $ct)
                                            @if($ct->id==$item->id_congty)
                                                {{$ct->name_vn}}
                                            @endif
                                        @endforeach
                                    </td>
                                    <td>{{date('d-m-Y',strtotime($item->ngay_nhapquoc))}}</td>
                                    <td>{{$item->solan}}</td>
                                    <td>{{$item->songuoi}}</td>
                                    <td>{{$item->dongia}}¥</td>
                                    <td>{{$item->sothang}}</td>
                                    <td>{{date('d-m-Y',strtotime($item->tg_from))}}</td>
                                    <td>{{date('d-m-Y',strtotime($item->tg_to))}}</td>
                                    <td>{{$item->sotien}}¥</td>
                                    <td>{{$item->creator}}</td>
                                    <td>{{$item->ghichu}}</td>
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
