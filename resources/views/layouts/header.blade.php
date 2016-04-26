<!-- ===============================================
================= HEADER Content ===================
================================================ -->
<section id="header">
    <header class="clearfix">

        <!-- Branding -->
        <div class="branding">
            <a class="brand" href="index.html">
                <span><strong>MSL</strong> Việt Nam</span>
            </a>
            <a role="button" tabindex="0" class="offcanvas-toggle visible-xs-inline"><i class="fa fa-bars"></i></a>
        </div>
        <!-- Branding end -->



        <!-- Left-side navigation -->
        <ul class="nav-left pull-left list-unstyled list-inline">
            <li class="sidebar-collapse divided-right">
                <a role="button" tabindex="0" class="collapse-sidebar">
                    <i class="fa fa-outdent"></i>
                </a>
            </li>
            
        </ul>
        <!-- Left-side navigation end -->




        <!-- Search -->
        <div class="search" id="main-search">
            <input type="text" class="form-control underline-input" placeholder="Search...">
        </div>
        <!-- Search end -->




        <!-- Right-side navigation -->
        <ul class="nav-right pull-right list-inline">
            <li class="dropdown users">

                <a href class="dropdown-toggle" data-toggle="dropdown">
                    <i class="fa fa-user"></i>
                    <span class="badge bg-lightred">2</span>
                </a>

                <div class="dropdown-menu pull-right with-arrow panel panel-default animated littleFadeInUp" role="menu">

                    <div class="panel-heading">
                        You have <strong>2</strong> requests
                    </div>

                    <ul class="list-group">

                        <li class="list-group-item">
                            <a role="button" tabindex="0" class="media">
                                <span class="pull-left media-object thumb thumb-sm">
                                    <img src="{{ asset("themes/assets/images/arnold-avatar.jpg") }}  " alt="" class="img-circle">
                                </span>
                                <div class="media-body">
                                    <span class="block">Arnold sent you a request</span>
                                    <small class="text-muted">15 minutes ago</small>
                                </div>
                            </a>
                        </li>

                        <li class="list-group-item">
                            <a role="button" tabindex="0" class="media">
                                <span class="pull-left media-object  thumb thumb-sm">
                                    <img src="{{ asset("themes/assets/images/george-avatar.jpg") }}  " alt="" class="img-circle">
                                </span>
                                <div class="media-body">
                                    <span class="block">George sent you a request</span>
                                    <small class="text-muted">5 hours ago</small>
                                </div>
                            </a>
                        </li>

                    </ul>

                    <div class="panel-footer">
                        <a role="button" tabindex="0">Show all requests <i class="fa fa-angle-right pull-right"></i></a>
                    </div>

                </div>

            </li>

            <li class="dropdown messages">

                <a href class="dropdown-toggle" data-toggle="dropdown">
                    <i class="fa fa-envelope"></i>
                    <span class="badge bg-lightred">4</span>
                </a>

                <div class="dropdown-menu pull-right with-arrow panel panel-default animated littleFadeInDown" role="menu">

                    <div class="panel-heading">
                        You have <strong>4</strong> messages
                    </div>

                    <ul class="list-group">

                        <li class="list-group-item">
                            <a role="button" tabindex="0" class="media">
                                <span class="pull-left media-object thumb thumb-sm">
                                    <img src="{{ asset("themes/assets/images/ici-avatar.jpg") }} " alt="" class="img-circle">
                                </span>
                                <div class="media-body">
                                    <span class="block">Imrich sent you a message</span>
                                    <small class="text-muted">12 minutes ago</small>
                                </div>
                            </a>
                        </li>

                        <li class="list-group-item">
                            <a role="button" tabindex="0" class="media">
                                <span class="pull-left media-object  thumb thumb-sm">
                                    <img src="{{ asset("themes/assets/images/peter-avatar.jpg") }} " alt="" class="img-circle">
                                </span>
                                <div class="media-body">
                                    <span class="block">Peter sent you a message</span>
                                    <small class="text-muted">46 minutes ago</small>
                                </div>
                            </a>
                        </li>

                        <li class="list-group-item">
                            <a role="button" tabindex="0" class="media">
                                <span class="pull-left media-object  thumb thumb-sm">
                                    <img src="{{ asset("themes/assets/images/random-avatar1.jpg") }} " alt="" class="img-circle">
                                </span>
                                <div class="media-body">
                                    <span class="block">Bill sent you a message</span>
                                    <small class="text-muted">1 hour ago</small>
                                </div>
                            </a>
                        </li>

                        <li class="list-group-item">
                            <a role="button" tabindex="0" class="media">
                                <span class="pull-left media-object  thumb thumb-sm">
                                    <img src="{{ asset("themes/assets/images/random-avatar3.jpg") }} " alt="" class="img-circle">
                                </span>
                                <div class="media-body">
                                    <span class="block">Ken sent you a message</span>
                                    <small class="text-muted">3 hours ago</small>
                                </div>
                            </a>
                        </li>

                    </ul>

                    <div class="panel-footer">
                        <a role="button" tabindex="0">Show all messages <i class="pull-right fa fa-angle-right"></i></a>
                    </div>

                </div>

            </li>

            <li class="dropdown notifications">

                <a href class="dropdown-toggle" data-toggle="dropdown">
                    <i class="fa fa-bell"></i>
                    <span class="badge bg-lightred">3</span>
                </a>

                <div class="dropdown-menu pull-right with-arrow panel panel-default animated littleFadeInLeft">

                    <div class="panel-heading">
                        You have <strong>3</strong> notifications
                    </div>

                    <ul class="list-group">

                        <li class="list-group-item">
                            <a role="button" tabindex="0" class="media">
                                <span class="pull-left media-object media-icon bg-danger">
                                    <i class="fa fa-ban"></i>
                                </span>
                                <div class="media-body">
                                    <span class="block">User Imrich cancelled account</span>
                                    <small class="text-muted">6 minutes ago</small>
                                </div>
                            </a>
                        </li>

                        <li class="list-group-item">
                            <a role="button" tabindex="0" class="media">
                                <span class="pull-left media-object media-icon bg-primary">
                                    <i class="fa fa-bolt"></i>
                                </span>
                                <div class="media-body">
                                    <span class="block">New user registered</span>
                                    <small class="text-muted">12 minutes ago</small>
                                </div>
                            </a>
                        </li>

                        <li class="list-group-item">
                            <a role="button" tabindex="0" class="media">
                                <span class="pull-left media-object media-icon bg-greensea">
                                    <i class="fa fa-lock"></i>
                                </span>
                                <div class="media-body">
                                    <span class="block">User Robert locked account</span>
                                    <small class="text-muted">18 minutes ago</small>
                                </div>
                            </a>
                        </li>

                    </ul>

                    <div class="panel-footer">
                        <a role="button" tabindex="0">Show all notifications <i class="fa fa-angle-right pull-right"></i></a>
                    </div>

                </div>

            </li>

            @if (Auth::guest())
                <li><a href="{{ url('/login') }}">Login</a></li>
                <li><a href="{{ url('/register') }}">Register</a></li>
            @else
                <li class="dropdown nav-profile">
                    <a href class="dropdown-toggle" data-toggle="dropdown">
                        <img src="{{ asset("themes/assets/images/profile-photo.jpg") }} " alt="" class="img-circle size-30x30">
                        <span>{{ Auth::user()->name }} <i class="fa fa-angle-down"></i></span>
                    </a>
                    <ul class="dropdown-menu animated littleFadeInRight" role="menu">
                        <li>
                            <a role="button" tabindex="0">
                                <span class="badge bg-greensea pull-right">86%</span>
                                <i class="fa fa-user"></i>Thông tin
                            </a>
                        </li>
                  
                        <li>
                            <a role="button" tabindex="0">
                                <i class="fa fa-cog"></i>Cài đặt
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a role="button" tabindex="0" href="{{ url('/logout') }}">
                                <i class="fa fa-sign-out"></i>Đăng xuất
                            </a>
                        </li>
                    </ul>
                </li>
            @endif

            
            <li class="toggle-right-sidebar">
                <a role="button" tabindex="0">
                    <i class="fa fa-comments"></i>
                </a>
            </li>
        </ul>
        <!-- Right-side navigation end -->
    </header>
</section>
<!--/ HEADER Content  -->