<section class="sidebar_wrapper navview-pane bg-custom fg-white z-5">
    <div class="sidebar_header d-flex flex-align-center">
        <button class="pull-button bg-blue-hover"><span class="mdi mdi-menu fg-white"></span></button>
        <div class="sidebar_header-title text-bold enlarge-1 ml-4">WEBSITE Kế toán</div>
    </div>
    <div class="sidebar_block suggest-box mt-4">
        <div class="data-box"><img class="avatar ml-4" src="https://via.placeholder.com/36">
            <div class="ml-4 avatar-title flex-column"><a class="d-block no-decor fg-white" href="#"><span class="text-medium">{{Auth::user()->name}}</span></a>
                <p class="m-0"><span class="fg-green mr-2">●</span><span class="text-small">online</span></p>
            </div>
        </div><img class="avatar holder" src="https://via.placeholder.com/36">
    </div>
    <div class="sidebar_nav-title text-medium my-2 px-3 enlarge-3">Menu</div>
    <ul class="navview-menu bg-custom ">
        <li><a href="/danhsachhocvien"><span class="icon"><span class="mif-user"></span></span><span class="caption">Danh sách học viên</span></a></li>
        <li><a href="/danhsachnghiepdoan"><span class="icon"><span class="mif-books"></span></span><span class="caption">Danh sách nghiệp đoàn</span></a></li>
        <li><a href="/danhsachcongty"><span class="icon"><span class="mif-books"></span></span><span class="caption">Danh sách công ty</span></a></li>
        <li><a href="/nganhang"><span class="icon"><span class="mif-dollar"></span></span><span class="caption">Danh sách ngân hàng</span></a></li>
        <li><a href="/nganhnghe"><span class="icon"><span class="mif-suitcase"></span></span><span class="caption">Danh sách ngành nghề</span></a></li>
        <li><a href="/hoadontiendaotao"><span class="icon"><span class="mif-dollar2"></span></span><span class="caption">Hóa đơn tiền đào tạo</span></a></li>
        <li><a href="/hoadontienvemaybay"><span class="icon"><span class="mif-dollar2"></span></span><span class="caption">Hóa đơn vé máy bay</span></a></li>
        <li><a href="/hoadontienquanly"><span class="icon"><span class="mif-dollar2"></span></span><span class="caption">Hóa đơn tiền quản lý</span></a></li>
        <li><a href="/xacnhanseikyu"><span class="icon"><span class="mif-checkmark"></span></span><span class="caption">Xác nhận SEIKYU</span></a></li>
        {{-- <li><a href="/hoadon"><span class="icon"><span class="mif-list"></span></span><span class="caption">Tất cả hóa đơn</span></a></li> --}}
        <li><a href="/thongketienthuduoc"><span class="icon"><span class="mif-chart-bars"></span></span><span class="caption">Thống kê số tiền thu được</span></a></li>

    </ul>
    <div class="data-box w-100 text-center reduce-2 p-2 border-top bd-grayMouse" data-role="hint" data-cls-hint="bg-orange fg-white drop-shadow"    data-hint-text="Design By Trung Hieu" style="position: absolute; bottom: 0">
        <div>© 2020 <a class="no-decor fg-white" href="#">MiraHuman Co., LTD</a></div>
    </div>

</section>
