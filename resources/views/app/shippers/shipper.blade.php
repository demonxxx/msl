@extends('templates.admin')
@section('content')
<div class="page page-shop-products">
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