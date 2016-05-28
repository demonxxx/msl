<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element">
                    <span>
                        <img alt="image" class="img-circle" src="{{asset("theme/img/profile_small.jpg")}}" />
                    </span>
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold">{{ Auth::user()->name }}</strong>
                            </span> <span class="text-muted text-xs block">Art Director <b class="caret"></b></span> </span> </a>
                    <ul class="dropdown-menu animated fadeInRight m-t-xs">
                        <li><a href="#">Thông tin</a></li>
                        <li class="divider"></li>
                        <li><a href="{{ url('/logout') }}">Logout</a></li>
                    </ul>
                </div>
                <div class="logo-element">
                    MSL
                </div>
            </li>
            @can('shop')
            <li>
                <a href="#"><i class="fa fa-edit"></i> <span class="nav-label">Khách hàng</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li><a href="{{url( '/shop/create' )}}"> Thêm khách hàng mới</a></li>
                    <li><a href="{{url('/shop')}}">Danh sách khách hàng</a></li>
                </ul>
            </li>
            @can('admin')
            <li>
                <a role="button" tabindex="0"><i class="fa fa-list"></i> <span>Cài đặt</span></a>
                <ul>
                    <li><a href="{{url( '/distance_freights' )}}"><i class="fa fa-caret-right"></i> Bảng giá</a></li>
                    <li><a href="ui-buttons-icons.html"><i class="fa fa-caret-right"></i> Loại xe</a></li>
                    <li><a href="ui-typography.html"><i class="fa fa-caret-right"></i> Dịch vụ</a></li>
                    <li><a href="ui-navs.html"><i class="fa fa-caret-right"></i> Nhóm người dùng</a></li>
                </ul>
            </li>
            <li>
                <a role="button" tabindex="0"><i class="fa fa-pencil"></i> <span>Quản lý người dùng</span></a>
                <ul>
                    <li><a href="ui-general.html"><i class="fa fa-caret-right"></i> Thêm người dùng</a></li>
                    <li><a href="ui-buttons-icons.html"><i class="fa fa-caret-right"></i> Danh sách người dùng</a></li>
                    @endcan
                    @can('shipper')

                    <li>
                        <a role="button" tabindex="0"><i class="fa fa-pencil"></i> <span>Tài xế</span><span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level collapse">
                            <li><a href="{{url( '/shipper/create' )}}"> Thêm tài xế</a></li>
                            <li><a href="{{url('/shipper')}}"> Danh sách tài xế</a></li>
                        </ul>
                    </li>

                    @endcan

                    @can('admin')
                    <li>
                        <a role="button" tabindex="0"><i class="fa fa-list"></i> <span>Cài đặt</span><span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level collapse">
                            <li><a href="#"> Bảng giá</a></li>
                            <li><a href="#"> Loại xe</a></li>
                            <li><a href="#"> Dịch vụ</a></li>
                            <li><a href="#"> Nhóm người dùng</a></li>
                        </ul>
                    </li>
                    <li>
                        <a role="button" tabindex="0"><i class="fa fa-pencil"></i> <span>Quản lý người dùng</span><span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level collapse">
                            <li><a href="#"> Thêm người dùng</a></li>
                            <li><a href="#"> Danh sách người dùng</a></li>

                        </ul>
                    </li>
                    @endcan
                </ul>
                </div>
                </nav>