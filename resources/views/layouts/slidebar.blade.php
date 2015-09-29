<section class="sidebar">
    <ul class="sidebar-menu">
        <li class="header">Quản lý kho</li>
        <li class="active treeview">
            <a href="#">
                <i class="fa fa-dashboard"></i> <span>Dashboard</span> <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
                <li><a href="index.html"><i class="fa fa-circle-o"></i> Dashboard v1</a></li>
                <li class="active"><a href="index2.html"><i class="fa fa-circle-o"></i> Dashboard v2</a></li>
            </ul>
        </li>

        <li class="treeview">
            <a href="#">
                <i class="fa fa-pie-chart"></i>
                <span>Quản lý sản phẩm</span>
                <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
                <li><a href="{{URL::route('listBranches')}}"><i class="fa fa-circle-o"></i>Thương Hiệu</a></li>
                <li><a href="{{URL::route('listProducts')}}"><i class="fa fa-circle-o"></i> Sản Phẩm</a></li>
                <li><a href="{{URL::route('listTags')}}"><i class="fa fa-circle-o"></i> Tag Sản Phẩm</a></li>
            </ul>
        </li>

        <li class="header">Admin</li>
        <li class="treeview"><a href="{{URL::route('listUsers')}}"><i class="fa fa-pie-chart"></i><span>Người dùng</span></a>
        </li>

        <li class="header">Quản Lý Đơn Hàng</li>
        <li><a href="#"><i class="fa fa-circle-o text-red"></i> <span>Important</span></a></li>
        <li><a href="#"><i class="fa fa-circle-o text-yellow"></i> <span>Warning</span></a></li>
        <li><a href="#"><i class="fa fa-circle-o text-aqua"></i> <span>Information</span></a></li>
    </ul>
</section>