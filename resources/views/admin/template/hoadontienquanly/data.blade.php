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
                    <div class="d-flex">
                        <p class="mt-2 mr-2">Tên nghiệp đoàn:</p>
                        @foreach ($nghiepdoan as $item)
                            @if ($item->id == $id_ndoan)
                                <strong class="mt-2 mr-2">{{$item->name_vn}}</strong>
                            @endif
                        @endforeach
                    </div>
                    <form action="inhoadonquanly">
                        <div class="custom_table-wrapper mt-8">
                            <div class="custom_table-top d-flex mb-2" style="justify-content: space-between">
                                <div>
                                    <p class="mt-2" >Tổng số tiền yêu cầu thanh toán (tạm tính): ¥ {{number_format($tong)}}
                                        <input type="text" name="id_ndoan" value="{{$id_ndoan}}" style="display:none">
                                        <input type="text" name="sothang" value="{{$sothang}}" style="display:none">
                                    </p>
                                    {{-- <p>Số tiền giảm (nếu có):</p><input type="number" min="0" max="{{$tong}}" name="sotiengiam"> --}}
                                </div>
                                <div class="d-flex">
                                    <p class="mt-2 mr-2">Chọn ngân hàng cần xuất hóa đơn:</p>
                                    <select style="width:300px;"name="nganhang" data-role="select" id="select-nd" data-filter-placeholder="Search...">
                                        <option value="Vui lòng chọn ngân hàng" disabled  >Vui lòng chọn ngân hàng</option>
                                        @foreach ($nganhang as $item)
                                        <option value="{{$item->id}}" >{{$item->tennh}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <table class="table table-border cell-border" data-show-search="false" data-show-rows-steps="false" data-rows="-1" data-show-pagination="false" data-show-table-info="false" data-show-table-rows="false" data-table-search-title="Tìm kiếm:" data-table-rows-count-title="Hiển thị:" id="table1" data-role="table" data-search-wrapper=".custom_table-search" data-rows-wrapper=".custom_table-rows" data-info-wrapper=".custom_table-info" data-pagination-wrapper=".custom_table-pagination" data-pagination-short-mode="true" data-horizontal-scroll="true" data-check="fakse" data-check-style="2" data-rownum="true">
                                <thead>
                                    <tr>
                                        <th class="text-center">Tên công ty </th>
                                        <th class="text-center">Ngày nhập quốc</th>
                                        <th class="text-center">Số lần</th>
                                        <th class="text-center">Nội dung</th>
                                        <th class="text-center">Số người</th>
                                        <th class="text-center">Đơn giá</th>
                                        <th class="text-center">Số tháng</th>
                                        <th class="text-center">Thời gian</th>
                                        <th class="text-center">Số tiền</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($hocvien as $item)
                                        <tr>
                                            @foreach ($congty as $cty)
                                                @if ($item->id_congty == $cty->id)
                                                    <td style="border: 1px solid #000;text-align:center">{{$cty->name_jp}}<br>{{$cty->name_vn}}</td>
                                                @endif
                                            @endforeach
                                            <td>{{date('Y',strtotime($item->ngay_xc))}}年{{date('m',strtotime($item->ngay_xc))}}月{{date('d',strtotime($item->ngay_xc))}}日</td>
                                            <td>
                                                <input class="warning text-center" style="width:50px; margin:auto" type="number" name="solan[]" value="{{$item->solan}}" min="0" max="36" required>
                                            </td>
                                            <td>管理費</td>
                                            <td>
                                                <input class="warning text-center" style="width:50px; margin:auto" type="number" name="sohocvien[]" value="{{$item->sohocvien}}" required>
                                            </td>
                                            <td>¥ 5,000</td>
                                            <td>
                                                @if (($item->solan+$sothang)>36)
                                                    {{36-$item->solan}}
                                                @else
                                                    {{$sothang}}
                                                @endif
                                            </td>
                                            <td>
                                                @if ($item->ngay_seikyu == null)
                                                    @if (($item->solan+$sothang)>36)
                                                        <?php $thang=36-$item->solan ?>
                                                    @else
                                                        <?php $thang=$sothang?>
                                                    @endif
                                                    <input class="warning" name="ngay_seikyu[]" style="width:250px;text-align:center" type="text" value="{{date('d-m-Y')}}">
                                                    @php
                                                        echo(date('Y',strtotime(date('Y-m-d'))).'年'.date('m',strtotime(date('Y-m-d'))).'月'.date('d',strtotime(date('Y-m-d'))).'日'.'~'.date('Y',strtotime("+$thang month",strtotime(date('Y-m-d')))).'年'.date('m',strtotime("+$thang month",strtotime(date('Y-m-d')))).'月'.date('d',strtotime("+$thang month",strtotime(date('Y-m-d')))).'日');
                                                    @endphp
                                                @else
                                                    @if (($item->solan+$sothang)>36)
                                                        <?php $thang=36-$item->solan ?>
                                                    @else
                                                        <?php $thang=$sothang?>
                                                    @endif
                                                    <input class="warning" name="ngay_seikyu[]" style="width:250px;text-align:center" type="text" value="{{date('d-m-Y',strtotime($item->ngay_seikyu))}}">
                                                    @php
                                                        echo(date('Y',strtotime($item->ngay_seikyu)).'年'.date('m',strtotime($item->ngay_seikyu)).'月'.date('d',strtotime($item->ngay_seikyu)).'日 ~' .date('Y',strtotime("+$thang month",strtotime($item->ngay_seikyu)))."年".date('m',strtotime("+$thang month",strtotime($item->ngay_seikyu))).'月'.date('d',strtotime("+$thang month",strtotime($item->ngay_seikyu))).'日');
                                                    @endphp
                                                @endif
                                            </td>
                                            <td>
                                                @if (($item->solan+$sothang)>36)
                                                    ¥{{number_format($item->sohocvien * 5000 * (36-$item->solan))}}
                                                @else
                                                    ¥{{number_format($item->sohocvien * 5000 * $sothang)}}
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <button class="button success" href="/inhoadontienquanly" ><span class="mif-create-new-folder mr-2"></span>Xuất hóa đơn</button>
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
