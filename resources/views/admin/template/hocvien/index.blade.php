@extends('admin.master')
@section('title', 'Học viên')
@section('PageContent')
<div class="row border-bottom bd-lightGray mt-4">
    <div class="col-md-4 text-center text-left-md">
        <h3 class="content_title m-0">Học viên</h3>
    </div>
    <div class="col-md-8 d-flex flex-justify-center flex-justify-end-md">
        <ul class="breadcrumbs bg-transparent m-0">
            <li class="page-item"><a class="page-link" href="/"><span class="mdi mdi-home"></span></a></li>
            <li class="page-item"><a class="page-link" href="#">Học viên</a></li>
        </ul>
    </div>
</div>
<section class="tables_wrapper">
    <aside class="tables_components">
        <div class="row">
            <div class="col-12">
                <div class="bg-white p-4">
                    <div class="custom_table-wrapper">
                        <a style="float:right;" href="/addhocvien/{{$id_ndoan}}/{{$id_cty}}" class="image-button primary"><span class="mif-plus icon"></span><span class="caption">Thêm</span></a>
                        <div class="custom_table-top d-flex flex-wrap flex-nowrap-lg flex-align-center flex-justify-center flex-justify-start-lg mb-2">
                            <div class="custom_table-search w-100 w-auto-lg mb-2 mb-0-lg"></div>
                            <div class="custom_table-rows mx-2"></div>
                        </div>
                        <table class="custom_table_a table table-border cell-border" data-role="table" data-search-wrapper=".custom_table-search" data-rows-wrapper=".custom_table-rows"   data-show-rows-steps="false" data-show-pagination="false" data-show-table-info="false" data-horizontal-scroll="true" data-rownum="true" data-rows="-1" data-table-search-title="Tìm kiếm:" data-table-rows-count-title="Hiển thị:">
                            <thead>
                                <tr>
                                    <th >Thao tác</th>
                                    <th class="sortable-column" >Họ và tên</th>
                                    <th >Ngày sinh</th>
                                    <th >Giới tính</th>
                                    <th >Quê quán</th>
                                    <th >Điện thoại</th>
                                    <th >Đơn hàng</th>
                                    <th >Ngành nghề</th>
                                    <th  class="sortable-column">Nghiệp đoàn</th>
                                    <th  class="sortable-column">Công ty</th>
                                    <th >Tỉnh làm việc</th>
                                    <th >Giấy phép</th>
                                    <th >Phí thu</th>
                                    <th >Ngày thu đợt 1</th>
                                    <th >Tiền thu đợt 1</th>
                                    <th >Ngày thu đợt 2</th>
                                    <th >Tiền thu đợt 2</th>
                                    <th >Ngày thu đợt 3</th>
                                    <th >Tiền thu đợt 3</th>
                                    <th >Phí tạo nguồn</th>
                                    <th >Phí tạo nguồn đợt 1</th>
                                    <th >Phí tạo nguồn đợt 2</th>
                                    <th >Số tiền đã thu</th>
                                    <th >Số tiền còn lại</th>
                                    <th >Ngày trúng tuyển</th>
                                    <th  class="sortable-column" data-format="date" data-format-mask="%d-%m-%y" >Ngày xuất cảnh</th>
                                    <th >Công ty chứng nghề</th>
                                    <th>Số tiền quản lý</th>
                                    <th>Số tiền đào tạo</th>
                                    <th>Số tiền vé</th>
                                    <th>Số lần</th>
                                    <th>Ngày SEIKYU</th>
                                    <th>Ghi chú</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($hocvien as $item)
                                    <tr>
                                        <td >
                                            <div  style="text-align: center;color:white;width:77px">
                                                <a href="/edithocvien/{{$item->id}}" class="mt-1 button cycle square primary"><span class="mif-wrench"></span></a>
                                                <a onclick="return confirm('Bạn có chắc chắn muốn xóa? Lưu ý sau khi xóa sẽ không phục hồi lại được')" href="/deletehocvien/{{$item->id}}" class="mt-1 button cycle square alert btn-delete"><span class="mif-cross"></span></a>
                                            </div>
                                        </td>
                                        <td>{{$item->name}}</td>
                                        <td>{{$item->ngaysinh}}</td>
                                        <td>{{$item->gioitinh}}</td>
                                        <td>{{$item->quequan}}</td>
                                        <td>{{$item->tel}}</td>
                                        <td>{{$item->ma_donhang}}</td>
                                        <td>
                                            @foreach($nganhnghe as $nn)
                                                @if($nn->id == $item->id_nganh )
                                                    {{$nn->name_vn}}
                                                @endif
                                            @endforeach
                                        </td>
                                        <td>
                                            @foreach($nghiepdoan as $nd)
                                                @if($nd->id == $item->id_ndoan )
                                                    {{$nd->name_vn}}
                                                @endif
                                            @endforeach
                                        </td>
                                        <td>
                                            @foreach($congty as $cty)
                                                @if($cty->id == $item->id_congty )
                                                    {{$cty->name_vn}}
                                                @endif
                                            @endforeach
                                        </td>
                                        <td>{{$item->tinh}}</td>
                                        <td>{{$item->gp}}</td>
                                        <td>{{$item->phi_thu}}</td>
                                        <td>{{$item->ngay_thudot1}}</td>
                                        <td>{{$item->tien_thudot1}}</td>
                                        <td>{{$item->ngay_thudot2}}</td>
                                        <td>{{$item->tien_thudot2}}</td>
                                        <td>{{$item->ngay_thudot3}}</td>
                                        <td>{{$item->tien_thudot3}}</td>
                                        <td>{{$item->phi_nguon}}</td>
                                        <td>{{$item->phi_dtnguon1}}</td>
                                        <td>{{$item->phi_dtnguon2}}</td>
                                        <td>{{$item->tien_dathu}}</td>
                                        <td>{{$item->tien_conlai}}</td>
                                        <td>{{$item->ngay_trungtuyen}}</td>
                                        <td>{{$item->ngay_xc}}</td>
                                        <td>{{$item->cty_nghe}}</td>
                                        <td>{{$item->tien_quanly}}</td>
                                        <td>{{$item->tien_daotao}}</td>
                                        <td>{{$item->tien_ve}}</td>
                                        <td>{{$item->solan}}</td>
                                        <td>{{$item->ngay_seikyu}}</td>
                                        <td>{{$item->ghichu}}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="custom_table-bottom d-flex flex-wrap flex-nowrap-lg flex-align-center flex-justify-center flex-justify-start-lg mb-2">
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
{{-- <script>
    $(function() {
        $(".btn-delete").on('click',function(e){
            var id = $(this).attr('id');
            Swal.fire({
            title: 'Bạn có chắc chắn?',
            text: "Xóa sẽ không phục hồi lại được!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes!'
            }).then((result) => {
                if (result.value) {
                    $.get("/deletehocvien/"+id);
                    Swal.fire(
                    'Đã xóa!',
                    'Your file has been deleted.',
                    'success'
                    )
                    window.location.reload(true);
                }
                else{
                    Swal.fire(
                    'Đã hủy!',
                    'Can not delete',
                    'warning'
                    )
                }
            })
        });
    });
</script> --}}
@endsection
