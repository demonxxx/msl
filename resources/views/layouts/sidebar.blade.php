<!-- ================================================
================= SIDEBAR Content ===================
================================================= -->
<aside id="sidebar">
    <div id="sidebar-wrap">
        <div class="panel-group slim-scroll" role="tablist">
            <div class="panel panel-default">
                <div class="panel-heading" role="tab">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" href="#sidebarNav">
                            Danh Mục <i class="fa fa-angle-up"></i>
                        </a>
                    </h4>
                </div>
                <div id="sidebarNav" class="panel-collapse collapse in" role="tabpanel">
                    <div class="panel-body">
                        <!-- ===================================================
                        ================= NAVIGATION Content ===================
                        ==================================================== -->
                        <ul id="navigation">
                            <li class="active"><a href="index.html"><i class="fa fa-dashboard"></i> <span>Trang chủ</span></a></li>
                            <li>
                                <a role="button" tabindex="0"><i class="fa fa-envelope-o"></i> <span>Hộp thư</span> <span class="badge bg-lightred">6</span></a>
                                <ul>
                                    <li><a href="mail-inbox.html"><i class="fa fa-caret-right"></i> Soạn thư mới</a></li>
                                    <li><a href="mail-compose.html"><i class="fa fa-caret-right"></i> Hộp thư đến</a></li>
                                    <li><a href="mail-single.html"><i class="fa fa-caret-right"></i> Hộp thư đi</a></li>
                                </ul>
                            </li>
                            <li>
                                <a role="button" tabindex="0"><i class="fa fa-list"></i> <span>Khách hàng</span></a>
                                <ul>
                                    <li><a href="{{url( '/shop/create' )}}"><i class="fa fa-caret-right"></i> Thêm khách hàng mới</a></li>
                                    <li><a href="{{url('/shop')}}"><i class="fa fa-caret-right"></i> Danh sách khách hàng</a></li>
                                    <li><a href="form-wizard.html"><i class="fa fa-caret-right"></i> Danh sách yêu cầu thuê theo tháng 
                                    <span class="badge badge-success">13</span></a></li>
                                    <li><a href="form-upload.html"><i class="fa fa-caret-right"></i> Danh sách hợp đồng thuê theo tháng</a></li>
                                    <li><a href="form-imgcrop.html"><i class="fa fa-caret-right"></i> Danh sách đơn hàng</a></li>
                                </ul>
                            </li>
                            <li>
                                <a role="button" tabindex="0"><i class="fa fa-pencil"></i> <span>Tài xế</span></a>
                                <ul>
                                    <li><a href="{{url( '/shipper/create' )}}"><i class="fa fa-caret-right"></i> Thêm tài xế</a></li>
                                    <li><a href="{{url('/shipper')}}"><i class="fa fa-caret-right"></i> Danh sách tài xế</a></li>
                                    <li><a href="ui-typography.html"><i class="fa fa-caret-right"></i> Danh sách tài xế yêu thích</a></li>
                                    <li><a href="ui-navs.html"><i class="fa fa-caret-right"></i> Danh sách tài xế cấm nhận</a></li>
                                    <li><a href="ui-modals.html"><i class="fa fa-caret-right"></i> Danh sách tài xế thuê theo tháng</a></li>
                                
                                </ul>
                            </li>
                            
                             <li>
                                <a role="button" tabindex="0"><i class="fa fa-list"></i> <span>Cài đặt</span></a>
                                <ul>
                                    <li><a href="ui-general.html"><i class="fa fa-caret-right"></i> Bảng giá</a></li>
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
                                    
                                </ul>
                            </li>
                            
                        </ul>
                        <!--/ NAVIGATION Content -->
                    </div>
                </div>
            </div>
            <div class="panel charts panel-default">
                <div class="panel-heading" role="tab">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" href="#sidebarCharts">
                            Orders Summary <i class="fa fa-angle-up"></i>
                        </a>
                    </h4>
                </div>
                <div id="sidebarCharts" class="panel-collapse collapse in" role="tabpanel">
                    <div class="panel-body">
                        <div class="summary">

                            <div class="media">
                                <a class="pull-right" role="button" tabindex="0">
                                    <span class="sparklineChart"
                                          values="5, 8, 3, 4, 6, 2, 1, 9, 7"
                                          sparkType="bar"
                                          sparkBarColor="#92424e"
                                          sparkBarWidth="6px"
                                          sparkHeight="36px">
                                    Loading...</span>
                                </a>
                                <div class="media-body">
                                    This week sales
                                    <h4 class="media-heading">26, 149</h4>
                                </div>
                            </div>

                            <div class="media">
                                <a class="pull-right" role="button" tabindex="0">
                                    <span class="sparklineChart"
                                          values="2, 4, 5, 3, 8, 9, 7, 3, 5"
                                          sparkType="bar"
                                          sparkBarColor="#397193"
                                          sparkBarWidth="6px"
                                          sparkHeight="36px">
                                    Loading...</span>
                                </a>
                                <div class="media-body">
                                    This week balance
                                    <h4 class="media-heading">318, 651</h4>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="panel settings panel-default">
                <div class="panel-heading" role="tab">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" href="#sidebarControls">
                            General Settings <i class="fa fa-angle-up"></i>
                        </a>
                    </h4>
                </div>
                <div id="sidebarControls" class="panel-collapse collapse in" role="tabpanel">
                    <div class="panel-body">
                        <div class="form-group">
                            <div class="row">
                              <label class="col-xs-8 control-label">Switch ON</label>
                              <div class="col-xs-4 control-label">
                                <div class="onoffswitch greensea">
                                  <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="switch-on" checked="">
                                  <label class="onoffswitch-label" for="switch-on">
                                    <span class="onoffswitch-inner"></span>
                                    <span class="onoffswitch-switch"></span>
                                  </label>
                                </div>
                              </div>
                            </div>
                          </div>

                          <div class="form-group">
                            <div class="row">
                              <label class="col-xs-8 control-label">Switch OFF</label>
                              <div class="col-xs-4 control-label">
                                <div class="onoffswitch greensea">
                                  <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="switch-off">
                                  <label class="onoffswitch-label" for="switch-off">
                                    <span class="onoffswitch-inner"></span>
                                    <span class="onoffswitch-switch"></span>
                                  </label>
                                </div>
                              </div>
                            </div>
                          </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</aside>
<!--/ SIDEBAR Content -->