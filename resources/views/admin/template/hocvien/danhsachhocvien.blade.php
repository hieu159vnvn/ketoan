@extends('admin.master')
@section('title', 'Danh sách học viên')
@section('PageContent')
<div class="row border-bottom bd-lightGray mt-4">
    <div class="col-md-4 text-center text-left-md">
        <h3 class="content_title m-0">Danh sách học viên</h3>
    </div>
    <div class="col-md-8 d-flex flex-justify-center flex-justify-end-md">
        <ul class="breadcrumbs bg-transparent m-0">
            <li class="page-item"><a class="page-link" href="/"><span class="mdi mdi-home"></span></a></li>
            <li class="page-item"><a class="page-link" href="#">Danh sách học viên</a></li>
        </ul>
    </div>
</div>
<section class="tables_wrapper">
    <aside class="tables_components">
        <div class="row">
            <div class="col-12">
                <div class="bg-white p-4">
                    <div class="custom_table-wrapper">
                        <style>
                            table.dataTable thead th{
                                border: 1px solid #dfdfdf !important;
                            }
                            #myTable th, td {
                                border: 1px solid #dfdfdf;
                            }
                            .dataTables_wrapper.no-footer .dataTables_scrollBody{
                                border: 1px solid #dfdfdf !important;
                            }
                            .dataTables_wrapper .dataTables_scroll{
                                overflow: auto;
                            }
                            #myTable tr>td:nth-child(2){
                                position: sticky;
                                left: 0;
                                background-color: #fff;
                            }
                        </style>
                        <table id="myTable" >
                            <thead>
                                <tr style="white-space: nowrap;">
                                    <th>Thao tác</th>
                                    <th>Họ và tên</th>
                                    <th>Ngày sinh</th>
                                    <th>Giới tính</th>
                                    <th>Quê quán</th>
                                    <th>Điện thoại</th>
                                    <th>Đơn hàng</th>
                                    <th>Ngành nghề</th>
                                    <th>Nghiệp đoàn</th>
                                    <th>Công ty</th>
                                    <th>Tỉnh làm việc</th>
                                    <th>Giấy phép</th>
                                    <th>Phí thu</th>
                                    <th>Ngày thu đợt 1</th>
                                    <th>Tiền thu đợt 1</th>
                                    <th>Ngày thu đợt 2</th>
                                    <th>Tiền thu đợt 2</th>
                                    <th>Ngày thu đợt 3</th>
                                    <th>Tiền thu đợt 3</th>
                                    <th>Phí tạo nguồn</th>
                                    <th>Phí tạo nguồn đợt 1</th>
                                    <th>Phí tạo nguồn đợt 2</th>
                                    <th>Số tiền đã thu</th>
                                    <th>Số tiền còn lại</th>
                                    <th>Ngày trúng tuyển</th>
                                    <th>Ngày xuất cảnh</th>
                                    <th>Công ty chứng nghề</th>
                                    <th>Số tiền quản lý</th>
                                    <th>Số tiền đào tạo</th>
                                    <th>Số tiền vé</th>
                                    <th>Số lần</th>
                                    <th>Ngày SEIKYU</th>
                                    <th>Ghi chú</th>
                                </tr>
                             </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </aside>
</section>
@endsection
@section('JsLibraries')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.css">

<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.js"></script>

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
    };
    $(document).ready( function () {
        $("#myTable").on('click',".btn-delete",function() {
            var idhv = $(this).attr('idhv');
            var a = confirm('Bạn có chắc chắn muốn xóa? Lưu ý sau khi xóa sẽ không phục hồi lại được');
            if(a==true){
                window.location.href = "/deletehocvien/" + idhv;
            }
        });
        $('#myTable').DataTable( {
            processing: true,
            serverSide: true,
            scrollX: true,
            ajax: '/datahocvien',
            columns: [
                { data: 'thaotac', name: 'thaotac'},
                { data: 'name', name: 'name' },
                { data: 'ngaysinh', name: 'ngaysinh' },
                { data: 'gioitinh', name: 'gioitinh' },
                { data: 'quequan', name: 'quequan' },
                { data: 'tel', name: 'tel' },
                { data: 'ma_donhang', name: 'ma_donhang' },
                { data: 'id_nganh', name: 'id_nganh' },
                { data: 'id_ndoan', name: 'id_ndoan' },
                { data: 'id_congty', name: 'id_congty' },
                { data: 'tinh', name: 'tinh' },
                { data: 'gp', name: 'gp' },
                { data: 'phi_thu', name: 'phi_thu' },
                { data: 'ngay_thudot1', name: 'ngay_thudot1' },
                { data: 'tien_thudot1', name: 'tien_thudot1' },
                { data: 'ngay_thudot2', name: 'ngay_thudot2' },
                { data: 'tien_thudot2', name: 'tien_thudot2' },
                { data: 'ngay_thudot3', name: 'ngay_thudot3' },
                { data: 'tien_thudot3', name: 'tien_thudot3' },
                { data: 'phi_nguon', name: 'phi_nguon' },
                { data: 'phi_dtnguon1', name: 'phi_dtnguon1' },
                { data: 'phi_dtnguon2', name: 'phi_dtnguon2' },
                { data: 'tien_dathu', name: 'tien_dathu' },
                { data: 'tien_conlai', name: 'tien_conlai' },
                { data: 'ngay_trungtuyen', name: 'ngay_trungtuyen' },
                { data: 'ngay_xc', name: 'ngay_xc' },
                { data: 'cty_nghe', name: 'cty_nghe' },
                { data: 'tien_quanly', name: 'tien_quanly' },
                { data: 'tien_daotao', name: 'tien_daotao' },
                { data: 'tien_ve', name: 'tien_ve' },
                { data: 'solan', name: 'solan' },
                { data: 'ngay_seikyu', name: 'ngay_seikyu' },
                { data: 'ghichu', name: 'ghichu' }
            ]
       });
    } );
</script>
@endsection
