@extends('templates.admin')
@section('content')
<div class="page page-shop-products">
        <div class="pageheader">
            <h2>Shipper</h2>
            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li>
                        <a href="index.html"><i class="fa fa-home"></i>LMS Việt Nam</a>
                    </li>
                    <li>
                        <a href="#">Shipper</a>
                    </li>
                    <li>
                        <a href="shop-products.html">Danh sách</a>
                    </li>
                </ul>
            </div>
        </div>
        <!-- page content -->
        <div class="pagecontent">
            <!-- row -->
            <div class="row">
                <!-- col -->
                <div class="col-md-12">
                    
                        @yield('shipper')
                    
                </div>
                <!-- /col -->
            </div>
            <!-- /row -->
        </div>
        <!-- /page content -->
    </div>
@endsection