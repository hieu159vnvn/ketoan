@extends('admin.master')
@section('title', 'Thêm người dùng')
@section('PageContent')
<div class="row border-bottom bd-lightGray mt-4">
    <div class="col-md-4 text-center text-left-md">
        <h3 class="content_title m-0">Thêm người dùng</h3>
    </div>
    <div class="col-md-8 d-flex flex-justify-center flex-justify-end-md">
        <ul class="breadcrumbs bg-transparent m-0">
            <li class="page-item"><a class="page-link" href="/"><span class="mdi mdi-home"></span></a></li>
            <li class="page-item"><a class="page-link" href="#">Thêm người dùng</a></li>
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
                <form class="ui form" action="{{route('user.signup')}}" method="post" name="form_1">
                    {{ csrf_field() }}
                    <div class="row flex-align-end">
                        <div class="form-group col-sm-6 mt-0">
                            <h6>Tên</h6>
                            <input type="text" data-role="input" name="name" value="{{ old('name') }}" required>
                        </div>
                        <div class="form-group col-sm-6 mt-0">
                            <h6>Email</h6>
                            <input type="text" data-role="input" name="email" value="{{ old('email') }}" required>
                        </div>
                        <div class="form-group col-sm-6 mt-0">
                            <h6>Mật khẩu</h6>
                            <input type="password" data-role="input" name="password" value="{{ old('password') }}" required>
                        </div>
                        <div class="form-group col-sm-6 mt-0">
                            <h6>Vai trò</h6>
                            <select name="roles" data-role="select"  data-filter="false" data-duration="0">
                                @forelse ($roles as $item)
                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                @empty
                                    <option value="">No role</option>
                                @endforelse
                            </select>
                        </div>
                        <div class="form-group col-sm-12 mt-0">
                            <a href="/danhsachnguoidung" class="mt-1 image-button"><span class="mif-backward icon"></span><span class="caption">Danh sách</span></a>
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