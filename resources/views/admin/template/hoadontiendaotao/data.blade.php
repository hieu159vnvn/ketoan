@extends('admin.master')
@section('title', 'Hóa đơn tiền đào tạo')
@section('PageContent')
<div class="row border-bottom bd-lightGray mt-4">
    <div class="col-md-4 text-center text-left-md">
        <h3 class="content_title m-0">Hóa đơn tiền đào tạo</h3>
    </div>
    <div class="col-md-8 d-flex flex-justify-center flex-justify-end-md">
        <ul class="breadcrumbs bg-transparent m-0">
            <li class="page-item"><a class="page-link" href="/"><span class="mdi mdi-home"></span></a></li>
            <li class="page-item"><a class="page-link" href="#">Hóa đơn tiền đào tạo</a></li>
        </ul>
    </div>
</div>
<section class="tables_wrapper">
    <aside class="tables_components">
        <div class="row">
            <div class="col-12">
                <div class="bg-white p-4">
                    <div class="form-group mt-0 d-flex" style="justify-content: space-between">
                        <div class="d-flex">
                            <h6 class="mt-2 mr-2">Chọn nghiệp đoàn:</h6>
                            <select style="width:300px;"name="nghiepdoan" data-role="select" id="select-nd" >
                                <option value="Vui lòng chọn nghiệp đoàn" disabled selected>Vui lòng chọn nghiệp đoàn</option>
                                @foreach ($nghiepdoan as $item)
                                <option value="/hoadontiendaotao/{{$item->id}}" {{ $item->id ==  $id_ndoan  ? 'selected' : '' }}>{{$item->name_vn}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <form method="POST" action="/inhoadontiendaotao/{{$id_ndoan}}">
                        {{ csrf_field() }}
                        <div class="custom_table-top d-flex mb-2" style="justify-content: space-between">
                            <div>
                                <h6>Tổng số tiền yêu cầu thanh toán: ¥
                                    {{-- @foreach ($tong as $item)
                                        {{number_format($item->tong*15000)}}
                                    @endforeach --}}
                                    {{number_format($tong*15000)}}
                                </h6>
                                {{-- <p>Số tiền giảm (nếu có):</p><input type="number" min="0" max="{{$tong*15000}}" name="sotiengiam"> --}}
                            </div>
                            <div class="form-group mt-0 d-flex">
                                <h6 class="m-2">Chọn ngân hàng:</h6>
                                <select style="width:300px;"name="nganhang" data-role="select" id="select-nd" data-filter-placeholder="Search...">
                                    <option value="Vui lòng chọn ngân hàng" disabled  >Vui lòng chọn ngân hàng</option>
                                    @foreach ($nganhang as $item)
                                    <option value="{{$item->id}}" >{{$item->tennh}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <table class="table" id="hoadontienquanly" cellspacing="0" cellpadding="0">
                            <tr >
                                <td style="border: 1px solid #000;text-align:center"><strong>会社名<br>Tên công ty</strong></td>
                                <td style="border: 1px solid #000;text-align:center"><strong>入国日<br> Ngày nhập quốc</strong></td>
                                <td style="border: 1px solid #000;text-align:center"><strong>内容<br>Nội dung</strong></td>
                                <td style="border: 1px solid #000;text-align:center"><strong>人数<br>Số người</strong></td>
                                <td style="border: 1px solid #000;text-align:center"><strong>単価<br>Đơn giá</strong></td>
                                <td style="border: 1px solid #000;text-align:center"><strong>金額<br>Số tiền</strong></td>
                            </tr>
                            @foreach($hocvien as $item)
                                <tr>
                                    @foreach ($congty as $cty)
                                        @if ($item->id_congty == $cty->id)
                                            <td style="border: 1px solid #000;text-align:center">{{$cty->name_jp}}<br>{{$cty->name_vn}}</td>
                                        @endif
                                    @endforeach
                                    <td style="border: 1px solid #000;text-align:center">{{date('Y',strtotime($item->ngay_xc))}}年{{date('m',strtotime($item->ngay_xc))}}月{{date('d',strtotime($item->ngay_xc))}}日</td>
                                    <td style="border: 1px solid #000;text-align:center">講習費用</td>
                                    <td style="border: 1px solid #000;text-align:center"><input class="warning" style="width:50px;margin:auto" type="number" name="sohocvien[]" value="{{$item->sohocvien}}" min="0" max="36" required></td>
                                    <td style="border: 1px solid #000;text-align:center">¥15,000</td>
                                    <td style="border: 1px solid #000;text-align:center">¥{{number_format($item->sohocvien*15000)}}</td>
                                </tr>
                            @endforeach
                        </table>
                        <button class="button success confirm"><span class="mif-create-new-folder mr-2"></span>Xuất hóa đơn</button>
                    </form>
                </div>
            </div>
        </div>
    </aside>
</section>
@endsection
@section('JsLibraries')
{{-- xuat du lieu --}}
<script>
    $(document).ready(function () {
        $("#select-nd").change(function(){
          var id =$("#select-nd").val();
          window.location.assign(id);
        });
    });
</script>
@endsection
