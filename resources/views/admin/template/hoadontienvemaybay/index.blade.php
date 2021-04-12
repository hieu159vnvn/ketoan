@extends('admin.master')
@section('title', 'Hóa đơn tiền vé máy bay')
@section('PageContent')
<div class="row border-bottom bd-lightGray mt-4">
    <div class="col-md-4 text-center text-left-md">
        <h3 class="content_title m-0">Hóa đơn tiền vé máy bay</h3>
    </div>
    <div class="col-md-8 d-flex flex-justify-center flex-justify-end-md">
        <ul class="breadcrumbs bg-transparent m-0">
            <li class="page-item"><a class="page-link" href="/"><span class="mdi mdi-home"></span></a></li>
            <li class="page-item"><a class="page-link" href="#">Hóa đơn tiền vé máy bay</a></li>
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
                                <option value="/hoadontienvemaybay/{{$item->id}}" >{{$item->name_vn}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
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