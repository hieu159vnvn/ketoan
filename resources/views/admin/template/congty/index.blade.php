@extends('admin.master')
@section('title', 'Danh sách công ty')
@section('PageContent')
<div class="row border-bottom bd-lightGray mt-4">
    <div class="col-md-4 text-center text-left-md">
        <h3 class="content_title m-0">Danh sách công ty</h3>
    </div>
    <div class="col-md-8 d-flex flex-justify-center flex-justify-end-md">
        <ul class="breadcrumbs bg-transparent m-0">
            <li class="page-item"><a class="page-link" href="/"><span class="mdi mdi-home"></span></a></li>
            <li class="page-item"><a class="page-link" href="#">Danh sách công ty</a></li>
        </ul>
    </div>
</div>
<section class="tables_wrapper">
    <aside class="tables_components">
        <div class="row">
            <div class="col-12">
                <div class="bg-white p-4">
                    <div class="custom_table-wrapper">
                        <div class="custom_table-top d-flex mb-2" style="justify-content: space-between">
                            <select style="width:200px;"name="nghiepdoan" data-role="select" id="select-nd" >
                               @foreach ($allnghiepdoan as $item)
                                <option value="{{$item->id}}" {{ $item->id ==  $nghiepdoan->id  ? 'selected' : '' }}>{{$item->name_vn}}</option>
                               @endforeach
                            </select>
                            <p><strong>Tổng số công ty:
                                <?php
                                  $demcongty=DB::table('nghiepdoan_congty')->where('id_nghiepdoan',$id_ndoan)->count();
                                ?>
                                {{$demcongty}}
                            </strong></p>
                            <div class="custom_table-search w-100 w-auto-lg mb-2 mb-0-lg ml-3"></div>
                        </div>
                        <form class="ui form"  action="/congty/{{$nghiepdoan->id}}/addcongty" >
                            <div class="row flex-align-end">
                                <div class="form-group col-sm-3 mt-0">
                                    <input type="text" data-role="input" name="name_jp" value="{{ old('name_jp') }}" placeholder="Nhập tên công ty tiếng Nhật" required>
                                </div>
                                <div class="form-group col-sm-3 mt-0">
                                    <input type="text" data-role="input" name="name_vn" value="{{ old('name_vn') }}" placeholder="Nhập tên công ty tiếng Việt" required>
                                </div>
                                <div class="form-group col-sm-3 mt-0">
                                    <input type="text" data-role="input" name="note" placeholder="Ghi chú" value="{{ old('note') }}" >
                                </div>
                                <div class="form-group col-sm-3 mt-0 ">
                                    <button class="image-button primary"><span class="mif-plus icon"></span><span class="caption">Thêm</span></button>
                                </div>
                            </div>
                        </form>
                        <table class="table table-border cell-border"  data-show-rows-steps="false" data-rows="-1" data-show-pagination="false" data-show-table-info="false" data-show-table-rows="false" data-table-search-title="Tìm kiếm:" data-table-rows-count-title="Hiển thị:" id="table1" data-role="table" data-search-wrapper=".custom_table-search" data-rows-wrapper=".custom_table-rows" data-info-wrapper=".custom_table-info" data-pagination-wrapper=".custom_table-pagination" data-pagination-short-mode="true" data-horizontal-scroll="true" data-check="false" data-check-style="2" data-rownum="true">
                            <thead>
                                <tr>
                                    <th>Tên công ty tiếng Nhật</th>
                                    <th>Tên công ty tiếng Việt</th>
                                    <th>Số lượng TTS</th>
                                    <th>Ghi chú</th>
                                    <th>Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($congty as $item)
                                    @if (in_array($item->id, $nghiepdoan_congty))
                                        <tr>
                                            <td><a href="/hocvien/{{$id_ndoan}}/{{$item->id}}" class="nghiepdoan_a">{{$item->name_jp}}</a></td>
                                            <td>{{$item->name_vn}}</td>
                                            <td>
                                                <?php
                                                    $sohocvien=DB::table('hocvien')->where([['id_ndoan',$id_ndoan],['id_congty',$item->id],['flag',0]])->get();
                                                    echo(count($sohocvien));
                                                ?>
                                            </td>
                                            <td>{{$item->note}}</td>
                                            <td >
                                                <div style="text-align: center;color:white;width:77px">
                                                    @permission('edit-nghiepdoan')
                                                    <a id="{{$item->id}}" name_jp="{{$item->name_jp}}" name_vn="{{$item->name_vn}}" note="{{$item->note}}" class="mt-1 button cycle square primary edit_company"><span class="mif-wrench"></span></a>
                                                    @endpermission
                                                    @permission('del-nghiepdoan')
                                                    <a onclick="return confirm('Bạn có chắc chắn muốn xóa? Lưu ý sau khi xóa sẽ không phục hồi lại được')" href="/deletecongty/{{$nghiepdoan->id}}/{{$item->id}}" class="mt-1 button cycle square alert btn-delete"><span class="mif-cross"></span></a>
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
<section class="login-infobox_wrapper" id="LoginInfobox" data-role="infobox">
    <div id="inserthtml"></div>
</section>
@endsection
@section('JsLibraries')
<script>
    $(document).ready(function(){
      $("#select-nd").change(function(){
          var link =$("#select-nd").val();
          window.location.assign(link);
       });
    });
</script>
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
<script>
    var msg = '{{Session::get('error')}}';
    var exist = '{{Session::has('error')}}';
    if(exist){
        Swal.fire({
        position: 'top-end',
        icon: 'error',
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
                    $.get("/deletecongty/{{$nghiepdoan->id}}/"+id);
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
                    'Canceled',
                    'warning'
                    )
                }
            })
        });
    });
</script> --}}
{{-- sua cong ty --}}
<script>
    $(document).ready(function () {
        $('.edit_company').click(function () {
            var id = $(this).attr('id');
            $.ajax({
                type: "get",
                url: "editcompany/" + id, // route
                data:"",
                cache: false,
                success: function (data) {
                    $('#LoginInfobox').data('infobox').open();
                    $('#inserthtml').html(data);
                }
            });
        });
    });
</script>
@endsection


