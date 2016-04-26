@extends('templates.admin')
@section('content')
<!-- ====================================================
================= CONTENT ===============================
===================================================== -->
    <div class="page page-dashboard">
        <div class="pageheader">
            <h2>Dashboard </h2>
            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li>
                        <a href="index.html"><i class="fa fa-home"></i> LMS VietNam</a>
                    </li>
                    <li>
                        <a href="{{url('/')}}">Dashboard</a>
                    </li>
                </ul>

                <div class="page-toolbar">
                    <a role="button" tabindex="0" class="btn btn-lightred no-border pickDate">
                        <i class="fa fa-calendar"></i>&nbsp;&nbsp;<span></span>&nbsp;&nbsp;<i class="fa fa-angle-down"></i>
                    </a>
                </div>
            </div>
        </div>
        <div class="row">

            <!-- col -->
            <div class="card-container col-lg-3 col-sm-6 col-sm-12">
                <div class="card">
                    <div class="front bg-greensea">

                        <!-- row -->
                        <div class="row">
                            <!-- col -->
                            <div class="col-xs-4">
                                <i class="fa fa-users fa-4x"></i>
                            </div>
                            <!-- /col -->
                            <!-- col -->
                            <div class="col-xs-8">
                                <p class="text-elg text-strong mb-0">3 659</p>
                                <span>New Users</span>
                            </div>
                            <!-- /col -->
                        </div>
                        <!-- /row -->

                    </div>
                    <div class="back bg-greensea">

                        <!-- row -->
                        <div class="row">
                            <!-- col -->
                            <div class="col-xs-4">
                                <a href=#><i class="fa fa-cog fa-2x"></i> Settings</a>
                            </div>
                            <!-- /col -->
                            <!-- col -->
                            <div class="col-xs-4">
                                <a href=#><i class="fa fa-chain-broken fa-2x"></i> Content</a>
                            </div>
                            <!-- /col -->
                            <!-- col -->
                            <div class="col-xs-4">
                                <a href=#><i class="fa fa-ellipsis-h fa-2x"></i> More</a>
                            </div>
                            <!-- /col -->
                        </div>
                        <!-- /row -->

                    </div>
                </div>
            </div>
            <!-- /col -->

            <!-- col -->
            <div class="card-container col-lg-3 col-sm-6 col-sm-12">
                <div class="card">
                    <div class="front bg-lightred">

                        <!-- row -->
                        <div class="row">
                            <!-- col -->
                            <div class="col-xs-4">
                                <i class="fa fa-shopping-cart fa-4x"></i>
                            </div>
                            <!-- /col -->
                            <!-- col -->
                            <div class="col-xs-8">
                                <p class="text-elg text-strong mb-0">19 364</p>
                                <span>New Orders</span>
                            </div>
                            <!-- /col -->
                        </div>
                        <!-- /row -->

                    </div>
                    <div class="back bg-lightred">

                        <!-- row -->
                        <div class="row">
                            <!-- col -->
                            <div class="col-xs-4">
                                <a href=#><i class="fa fa-cog fa-2x"></i> Settings</a>
                            </div>
                            <!-- /col -->
                            <!-- col -->
                            <div class="col-xs-4">
                                <a href=#><i class="fa fa-chain-broken fa-2x"></i> Content</a>
                            </div>
                            <!-- /col -->
                            <!-- col -->
                            <div class="col-xs-4">
                                <a href=#><i class="fa fa-ellipsis-h fa-2x"></i> More</a>
                            </div>
                            <!-- /col -->
                        </div>
                        <!-- /row -->

                    </div>
                </div>
            </div>
            <!-- /col -->

            <!-- col -->
            <div class="card-container col-lg-3 col-sm-6 col-sm-12">
                <div class="card">
                    <div class="front bg-blue">

                        <!-- row -->
                        <div class="row">
                            <!-- col -->
                            <div class="col-xs-4">
                                <i class="fa fa-usd fa-4x"></i>
                            </div>
                            <!-- /col -->
                            <!-- col -->
                            <div class="col-xs-8">
                                <p class="text-elg text-strong mb-0">165 984</p>
                                <span>Sales</span>
                            </div>
                            <!-- /col -->
                        </div>
                        <!-- /row -->

                    </div>
                    <div class="back bg-blue">

                        <!-- row -->
                        <div class="row">
                            <!-- col -->
                            <div class="col-xs-4">
                                <a href=#><i class="fa fa-cog fa-2x"></i> Settings</a>
                            </div>
                            <!-- /col -->
                            <!-- col -->
                            <div class="col-xs-4">
                                <a href=#><i class="fa fa-chain-broken fa-2x"></i> Content</a>
                            </div>
                            <!-- /col -->
                            <!-- col -->
                            <div class="col-xs-4">
                                <a href=#><i class="fa fa-ellipsis-h fa-2x"></i> More</a>
                            </div>
                            <!-- /col -->
                        </div>
                        <!-- /row -->

                    </div>
                </div>
            </div>
            <!-- /col -->

            <!-- col -->
            <div class="card-container col-lg-3 col-sm-6 col-sm-12">
                <div class="card">
                    <div class="front bg-slategray">

                        <!-- row -->
                        <div class="row">
                            <!-- col -->
                            <div class="col-xs-4">
                                <i class="fa fa-eye fa-4x"></i>
                            </div>
                            <!-- /col -->
                            <!-- col -->
                            <div class="col-xs-8">
                                <p class="text-elg text-strong mb-0">29 651</p>
                                <span>Visits</span>
                            </div>
                            <!-- /col -->
                        </div>
                        <!-- /row -->

                    </div>
                    <div class="back bg-slategray">

                        <!-- row -->
                        <div class="row">
                            <!-- col -->
                            <div class="col-xs-4">
                                <a href=#><i class="fa fa-cog fa-2x"></i> Settings</a>
                            </div>
                            <!-- /col -->
                            <!-- col -->
                            <div class="col-xs-4">
                                <a href=#><i class="fa fa-chain-broken fa-2x"></i> Content</a>
                            </div>
                            <!-- /col -->
                            <!-- col -->
                            <div class="col-xs-4">
                                <a href=#><i class="fa fa-ellipsis-h fa-2x"></i> More</a>
                            </div>
                            <!-- /col -->
                        </div>
                        <!-- /row -->

                    </div>
                </div>
            </div>
            <!-- /col -->

        </div>
        <!-- /row -->




        <!-- row -->
        <div class="row">



            <!-- col -->
            <div class="col-md-8">

                <!-- tile -->
                <section class="tile">

                    <!-- tile header -->
                    <div class="tile-header bg-greensea dvd dvd-btm">
                        <h1 class="custom-font"><strong>Statistics </strong>Graph</h1>
                        <ul class="controls">
                            <li>
                                <a role="button" tabindex="0" class="pickDate">
                                    <span></span>&nbsp;&nbsp;<i class="fa fa-angle-down"></i>
                                </a>
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

                    <!-- tile widget -->
                    <div class="tile-widget bg-greensea">
                        <div id="statistics-chart" style="height: 250px;"></div>
                    </div>
                    <!-- /tile widget -->

                    <!-- tile body -->
                    <div class="tile-body">

                        <!-- row -->
                        <div class="row">


                            <!-- col -->
                            <div class="col-md-8 col-sm-12">

                                <h4 class="underline custom-font mb-20"><strong>Actual</strong> Statistics</h4>

                                <!-- row -->
                                <div class="row">
                                    <!-- col -->
                                    <div class="col-lg-4 text-center">
                                        <div class="easypiechart"
                                             data-percent="100"
                                             data-size="140"
                                             data-bar-color="#418bca"
                                             data-scale-color="false"
                                             data-line-cap="round"
                                             data-line-width="4"
                                             style="width: 140px; height: 140px;">

                                            <i class="fa fa-usd fa-4x text-blue" style="line-height: 140px;"></i>

                                        </div>
                                        <p class="text-uppercase text-elg mt-20 mb-0"><strong class="text-blue">6,175</strong> <small class="text-lg text-light text-default lt">Sales</small></p>
                                        <p class="text-light"><i class="fa fa-caret-up text-success"></i> 18% this month</p>
                                    </div>
                                    <!-- /col
                                    <!-- col -->
                                    <div class="col-lg-4 text-center">
                                        <div class="easypiechart"
                                             data-percent="75"
                                             data-size="140"
                                             data-bar-color="#e05d6f"
                                             data-scale-color="false"
                                             data-line-cap="round"
                                             data-line-width="4"
                                             style="width: 140px; height: 140px;">

                                            <i class="fa fa-eye fa-4x text-lightred" style="line-height: 140px;"></i>
                                            <p class="text-uppercase text-elg mt-20 mb-0"><strong class="text-lightred">8,213</strong> <small class="text-lg text-light text-default lt">Visits</small></p>
                                            <p class="text-light"><i class="fa fa-caret-down text-warning"></i> 25% this month</p>
                                        </div>
                                    </div>
                                    <!-- /col -->
                                    <!-- col -->
                                    <div class="col-lg-4 text-center">
                                        <div class="easypiechart"
                                             data-percent="46"
                                             data-size="140"
                                             data-bar-color="#16a085"
                                             data-scale-color="false"
                                             data-line-cap="round"
                                             data-line-width="4"
                                             style="width: 140px; height: 140px;">

                                            <i class="fa fa-user fa-4x text-greensea" style="line-height: 140px;"></i>
                                            <p class="text-uppercase text-elg mt-20 mb-0"><strong class="text-greensea">632</strong> <small class="text-lg text-light text-default lt">Users</small></p>
                                            <p class="text-light"><i class="fa fa-caret-down text-danger"></i> 61% this month</p>
                                        </div>
                                    </div>
                                    <!-- /col -->
                                </div>
                                <!-- /row -->

                            </div>
                            <!-- /col -->



                            <!-- col -->
                            <div class="col-md-4 col-sm-12">

                                <h4 class="underline custom-font"><strong>Visitors</strong> Statistics</h4>

                                <div class="progress-list">
                                    <div class="details">
                                        <div class="title">America</div>
                                        <div class="description">visitor from america</div>
                                    </div>
                                    <div class="status pull-right">
                                        <span>40</span>%
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="progress-xs not-rounded progress">
                                      <div class="progress-bar progress-bar-dutch" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%">
                                        <span class="sr-only">40%</span>
                                      </div>
                                    </div>
                                </div>

                                <div class="progress-list">
                                    <div class="details">
                                        <div class="title">Europe</div>
                                        <div class="description">visitor from europe</div>
                                    </div>
                                    <div class="status pull-right">
                                        <span>38</span>%
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="progress-xs not-rounded progress">
                                      <div class="progress-bar progress-bar-greensea" role="progressbar" aria-valuenow="38" aria-valuemin="0" aria-valuemax="100" style="width: 38%">
                                        <span class="sr-only">38%</span>
                                      </div>
                                    </div>
                                </div>

                                <div class="progress-list">
                                    <div class="details">
                                        <div class="title">Asia</div>
                                        <div class="description">visitor from asia</div>
                                    </div>
                                    <div class="status pull-right">
                                        <span>12</span>%
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="progress-xs not-rounded progress">
                                      <div class="progress-bar progress-bar-lightred" role="progressbar" aria-valuenow="12" aria-valuemin="0" aria-valuemax="100" style="width: 12%">
                                        <span class="sr-only">12%</span>
                                      </div>
                                    </div>
                                </div>

                                <div class="progress-list">
                                    <div class="details">
                                        <div class="title">Africa</div>
                                        <div class="description">visitor from africa</div>
                                    </div>
                                    <div class="status pull-right">
                                        <span>7</span>%
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="progress-xs not-rounded progress">
                                      <div class="progress-bar progress-bar-blue" role="progressbar" aria-valuenow="7" aria-valuemin="0" aria-valuemax="100" style="width: 7%">
                                        <span class="sr-only">7%</span>
                                      </div>
                                    </div>
                                </div>

                                <div class="progress-list">
                                    <div class="details">
                                        <div class="title">Other</div>
                                        <div class="description">visitor from other</div>
                                    </div>
                                    <div class="status pull-right">
                                        <span>6</span>%
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="progress-xs not-rounded progress">
                                      <div class="progress-bar progress-bar-hotpink" role="progressbar" aria-valuenow="6" aria-valuemin="0" aria-valuemax="100" style="width: 6%">
                                        <span class="sr-only">6%</span>
                                      </div>
                                    </div>
                                </div>

                            </div>
                            <!-- /col -->




                        </div>
                        <!-- /row -->

                    </div>
                    <!-- /tile body -->

                </section>
                <!-- /tile -->

            </div>
            <!-- /col -->



            <!-- col -->
            <div class="col-md-4">

                <!-- tile -->
                <section class="tile" fullscreen="isFullscreen02">

                    <!-- tile header -->
                    <div class="tile-header dvd dvd-btm">
                        <h1 class="custom-font"><strong>Browser </strong>Usage</h1>
                        <ul class="controls">
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

                    <!-- tile widget -->
                    <div class="tile-widget">
                        <div id="browser-usage" style="height: 250px"></div>
                    </div>
                    <!-- /tile widget -->

                    <!-- tile body -->
                    <div class="tile-body p-0">

                        <div class="panel-group icon-plus" id="accordion" role="tablist" aria-multiselectable="true">
                            <div class="panel panel-default panel-transparent">
                                <div class="panel-heading" role="tab" id="headingOne">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                            <span><i class="fa fa-minus text-sm mr-5"></i> This Month</span>
                                            <span class="badge pull-right bg-lightred">3</span>
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                                    <div class="panel-body">
                                        <table class="table table-no-border m-0">
                                            <tbody>
                                            <tr>
                                                <td>1</td>
                                                <td>Chrome</td>
                                                <td>6985</td>
                                                <td><i class="fa fa-caret-up text-success"></i></td>
                                            </tr>
                                            <tr>
                                                <td>2</td>
                                                <td>Other</td>
                                                <td>2697</td>
                                                <td><i class="fa fa-caret-up text-success"></i></td>
                                            </tr>
                                            <tr>
                                                <td>3</td>
                                                <td>Safari</td>
                                                <td>3597</td>
                                                <td><i class="fa fa-caret-down text-danger"></i></td>
                                            </tr>
                                            <tr>
                                                <td>4</td>
                                                <td>Firefox</td>
                                                <td>2145</td>
                                                <td><i class="fa fa-caret-up text-success"></i></td>
                                            </tr>
                                            <tr>
                                                <td>5</td>
                                                <td>Internet Explorer</td>
                                                <td>1854</td>
                                                <td><i class="fa fa-caret-down text-danger"></i></td>
                                            </tr>
                                            <tr>
                                                <td>6</td>
                                                <td>Opera</td>
                                                <td>654</td>
                                                <td><i class="fa fa-caret-up text-success"></i></td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-default panel-transparent">
                                <div class="panel-heading" role="tab" id="headingTwo">
                                    <h4 class="panel-title">
                                        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                            <span><i class="fa fa-minus text-sm mr-5"></i> Last Month</span>
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                                    <div class="panel-body">
                                        <table class="table table-no-border m-0">
                                            <tbody>
                                            <tr>
                                                <td>1</td>
                                                <td>Chrome</td>
                                                <td>6985</td>
                                                <td><i class="fa fa-caret-up text-success"></i></td>
                                            </tr>
                                            <tr>
                                                <td>2</td>
                                                <td>Other</td>
                                                <td>2697</td>
                                                <td><i class="fa fa-caret-up text-success"></i></td>
                                            </tr>
                                            <tr>
                                                <td>3</td>
                                                <td>Safari</td>
                                                <td>3597</td>
                                                <td><i class="fa fa-caret-down text-danger"></i></td>
                                            </tr>
                                            <tr>
                                                <td>4</td>
                                                <td>Firefox</td>
                                                <td>2145</td>
                                                <td><i class="fa fa-caret-up text-success"></i></td>
                                            </tr>
                                            <tr>
                                                <td>5</td>
                                                <td>Internet Explorer</td>
                                                <td>1854</td>
                                                <td><i class="fa fa-caret-down text-danger"></i></td>
                                            </tr>
                                            <tr>
                                                <td>6</td>
                                                <td>Opera</td>
                                                <td>654</td>
                                                <td><i class="fa fa-caret-up text-success"></i></td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-default panel-transparent">
                                <div class="panel-heading" role="tab" id="headingThree">
                                    <h4 class="panel-title">
                                        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                            <span><i class="fa fa-minus text-sm mr-5"></i> This Year</span>
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                                    <div class="panel-body">
                                        <table class="table table-no-border m-0">
                                            <tbody>
                                            <tr>
                                                <td>1</td>
                                                <td>Chrome</td>
                                                <td>6985</td>
                                                <td><i class="fa fa-caret-up text-success"></i></td>
                                            </tr>
                                            <tr>
                                                <td>2</td>
                                                <td>Other</td>
                                                <td>2697</td>
                                                <td><i class="fa fa-caret-up text-success"></i></td>
                                            </tr>
                                            <tr>
                                                <td>3</td>
                                                <td>Safari</td>
                                                <td>3597</td>
                                                <td><i class="fa fa-caret-down text-danger"></i></td>
                                            </tr>
                                            <tr>
                                                <td>4</td>
                                                <td>Firefox</td>
                                                <td>2145</td>
                                                <td><i class="fa fa-caret-up text-success"></i></td>
                                            </tr>
                                            <tr>
                                                <td>5</td>
                                                <td>Internet Explorer</td>
                                                <td>1854</td>
                                                <td><i class="fa fa-caret-down text-danger"></i></td>
                                            </tr>
                                            <tr>
                                                <td>6</td>
                                                <td>Opera</td>
                                                <td>654</td>
                                                <td><i class="fa fa-caret-up text-success"></i></td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /tile body -->
                </section>
                <!-- /tile -->
            </div>
            <!-- /col -->
        </div>
        <!-- /row -->
    </div>
@endsection