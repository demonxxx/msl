@extends('app.shops.shop')
@section('shop')
<!-- tile -->
<section class="tile">
    <!-- tile header -->
    <div class="tile-header dvd dvd-btm">
        <h1 class="custom-font"><strong>Danh sách khách hàng</strong></h1>
        <ul class="controls">
            <li><a href="{{url( '/shop/create' )}}"><i class="fa fa-plus mr-5"></i> Thêm khách hàng</a></li>
            <li class="dropdown">       
                <a role="button" tabindex="0" class="dropdown-toggle" data-toggle="dropdown">Công cụ <i class="fa fa-angle-down ml-5"></i></a>
                <ul class="dropdown-menu pull-right with-arrow animated littleFadeInUp">
                    <li>
                        <a href>Xuất file XLS</a>
                    </li>
                    <li>
                        <a href>Xuất file CSV</a>
                    </li>
                    <li>
                        <a href>Xuất file XML</a>
                    </li>
                    <li role="presentation" class="divider"></li>
                    <li>
                        <a href>In hóa đơn</a>
                    </li>
                </ul>
            </li>
            <li class="dropdown">
                <a role="button" tabindex="0" class="dropdown-toggle settings" data-toggle="dropdown">
                    <i class="fa fa-cog"></i>
                    <i class="fa fa-spinner fa-spin"></i>
                </a>
                <ul class="dropdown-menu pull-right with-arrow animated littleFadeInUp">
                    <li>
                        <a role="button" tabindex="0" class="tile-toggle">
                            <span class="minimize"><i class="fa fa-angle-down"></i>&nbsp;&nbsp;&nbsp;Minimize</span>
                            <span class="expand"><i class="fa fa-angle-up"></i>&nbsp;&nbsp;&nbsp;Expand</span>
                        </a>
                    </li>
                    <li>
                        <a role="button" tabindex="0" class="tile-refresh">
                            <i class="fa fa-refresh"></i> Refresh
                        </a>
                    </li>
                    <li>
                        <a role="button" tabindex="0" class="tile-fullscreen">
                            <i class="fa fa-expand"></i> Fullscreen
                        </a>
                    </li>
                </ul>
            </li>
            <li class="remove"><a role="button" tabindex="0" class="tile-close"><i class="fa fa-times"></i></a></li>
        </ul>
    </div>
    <!-- /tile header -->
    <!-- tile body -->
    <div class="tile-body">

        <div class="table-responsive">
            <table class="table table-striped table-hover table-custom" id="products-list">
                <thead>
                    <tr>
                        <th>Mã KH</th>
                        <th>Tên đăng nhập</th>
                        <th>Họ và tên</th>
                        <th>Số đt</th>
                        <th>Email</th>
                        <th>Địa chỉ nhà</th>
                        <th>Địa chỉ văn phòng</th>
                        <th>Số CMT</th>
                        <th class="no-sort">Chức năng</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
    <!-- /tile body -->
</section>
<!-- /tile -->
     
<script >
    $(document).ready(function(){

    });
</script>
@endsection


