@extends('admin.master')
@section('title', 'Sửa chức vụ')
@section('PageContent')
<div class="row border-bottom bd-lightGray mt-4">
    <div class="col-md-4 text-center text-left-md">
        <h3 class="content_title m-0">Sửa chức vụ</h3>
    </div>
    <div class="col-md-8 d-flex flex-justify-center flex-justify-end-md">
        <ul class="breadcrumbs bg-transparent m-0">
            <li class="page-item"><a class="page-link" href="/"><span class="mdi mdi-home"></span></a></li>
            <li class="page-item"><a class="page-link" href="#">Sửa chức vụ</a></li>
        </ul>
    </div>
</div>
<section class="forms_wrapper">
    <aside class="forms_extended">
        <div class="row">
            <div class="col-12">
                <div class="bg-white p-4">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form class="ui form" action="" method="post" name="form_1">
                    {{ csrf_field() }}
                    <div class="row flex-align-end">
                        <div class="form-group col-sm-12 mt-0">
                            <h6>Tên chức vụ</h6>
                            <input type="text" data-role="input" name="name" value="{{ $role->name }}" required>
                        </div>
                        <div class="form-group col-sm-12 mt-0">
                            <h6>Vai trò</h6>
                            <select name="permission[]" data-role="select" multiple data-filter="false" data-duration="0">
                                @foreach ($permissions as $item)
                                    <option value="{{$item->id}}" @if(in_array($item->id, $rolePermissions)) selected @endif >{{$item->description}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-sm-12 mt-0">
                            <a href="/danhsachchucvu" class="mt-1 image-button"><span class="mif-backward icon"></span><span class="caption">Danh sách</span></a>
                            <button class="mt-1 image-button primary"><span class="mif-checkmark icon"></span><span class="caption">Lưu</span></button>
                        </div>
                    </div>
                </form>
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
