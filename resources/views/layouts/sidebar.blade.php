<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element">
                    <span>
                        <img alt="image" class="img-circle" src="{{asset("theme/img/profile_small.jpg")}}"/>
                    </span>
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <span class="clear"> <span class="block m-t-xs"> <strong
                                        class="font-bold">{{ Auth::user()->name }}</strong>
                            </span> <span class="text-muted text-xs block">Art Director <b
                                        class="caret"></b></span> </span> </a>
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
                    <a href="#"><i class="fa fa-user"></i> <span class="nav-label">Khách hàng</span><span
                                class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li><a href="{{url( '/shop/create' )}}"> Thêm khách hàng mới</a></li>
                        <li><a href="{{url('/shop')}}">Danh sách khách hàng</a></li>
                    </ul>
                </li>

                <li>
                    <a role="button" tabindex="0"><i class="fa fa-list"></i> <span>Đơn hàng</span><span
                                class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li><a href="{{url('/order')}}"> Danh sách đơn hàng</a></li>
                    </ul>
                </li>

            @endcan
            @can('shipper')

                <li>
                    <a role="button" tabindex="0"><i class="fa fa-taxi"></i> <span>Tài xế</span><span
                                class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li><a href="{{url( '/shipper/create' )}}"> Thêm tài xế</a></li>
                        <li><a href="{{url('/shipper')}}"> Danh sách tài xế</a></li>
                        <li><a href="{{url( '/shipper/notable_list' )}}"> Đánh giá tài xế</a></li>
                    </ul>
                </li>
            @endcan
            @can('admin')
                <li>
                    <a role="button" tabindex="0"><i class="fa fa-taxi"></i> <span>Cài đặt</span><span
                                class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li><a href="{{url( '/distance_freights' )}}"> Bảng giá</a>
                        </li>
                        <li><a href="{{url( 'admin/settings/vehicleTypes' )}}"> Loại xe</a></li>
                        <li><a href="{{url( 'admin/settings/addedServices' )}}"> Dịch vụ</a></li>
                        <li><a href="{{url( 'admin/settings/shopTypes' )}}"> Loại khách hàng</a></li>
                        <li><a href="{{url( 'admin/settings/shopScopes' )}}"> Phạm vi shop</a></li>
                        <li><a href="{{url( 'admin/settings/shipperTypes' )}}"> Loại tài xế</a></li>
                        <li><a href="{{url( 'admin/settings/orderTypes' )}}"> Loại đơn hàng</a></li>
                        <li><a href="ui-navs.html"> Nhóm người dùng</a></li>
                    </ul>
                </li>
                <li>
                    <a role="button" tabindex="0"><i class="fa fa-cogs"></i> <span>Cài đặt</span><span
                                class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li><a href="ui-general.html"> Thêm người dùng</a></li>
                        <li><a href="{{url('/account')}}"> Danh sách tài khoản</a></li>
                    </ul>
                </li>
            @endcan
        </ul>
    </div>
</nav>
