<section class="navview-content">
    <section class="appbar_wrapper pos-absolute bg-white shadow-1" data-role="appbar"><a class="app-bar-item d-block d-none-lg" id="paneToggle" href="#"><span class="mdi mdi-menu"></span></a>
        <div class="app-bar-container ml-auto">
            <div class="app-bar-container"><a class="app-bar-item" href="#"><img class="appbar_avatar-thumb" src="https://via.placeholder.com/32">
                <span class="ml-2 d-none d-block-sm">{{Auth::user()->name}}</span></a>
                <div class="pos-absolute put-se mt-1 shadow-1" data-role="collapse" data-collapsed="true" style="line-height: 1.5">
                <div class="bg-lightBlue fg-white p-2 text-center"><img class="appbar_avatar" src="https://via.placeholder.com/48"><a class="d-block h4 mt-2 mb-0" href="#">{{Auth::user()->name}}</a></div>
                @permission('add-taikhoan')
                <div class="bg-white d-flex flex-justify-between flex-equal-items p-2 bg-light">
                    <a href="/danhsachnguoidung" class="button ml-1">Danh sách người dùng</a>
                </div>
                @endpermission
                @permission('add-chucvu')
                <div class="bg-white d-flex flex-justify-between flex-equal-items p-2 bg-light">
                    <a href="/danhsachchucvu" class="button ml-1">Danh sách chức vụ</a>
                </div>
                @endpermission
                <div class="bg-white d-flex flex-justify-between flex-equal-items p-2 bg-light">
                    <a href="/logout" class="button ml-1">Đăng xuất</a>
                </div>
            </div>
      </div>
  </section>
