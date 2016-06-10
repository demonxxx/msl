@extends('app.discounts.discount')
@section('discount')
<script src="{{ asset("theme/js/plugins/parsley/parsley.min.js") }}"></script>
<!-- tile -->
<section class="tile">
    <div class="tile-body">

        @if (count($errors) > 0)
        {{--{{dd($errors)}}--}}
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Mã khuyến mại
                        </h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                <i class="fa fa-wrench"></i>
                            </a>
                            <a class="close-link">
                                <i class="fa fa-times"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <form class="form-horizontal" id="create-discount-form">
                            <hr class="line-dashed line-full"/>
                            <div class="form-group">
                                <label class="col-md-2 control-label">Tên khuyến mại</label>
                                <div class="col-md-10">
                                    <span class="form-control" id="name">{{ $discount->name }}</span>
                                </div>
                            </div>
                            <hr class="line-dashed line-full"/>
                            <div class="form-group">
                                <label class="col-md-2 control-label">Mã khuyến mại</label>
                                <div class="col-md-10">
                                    <span class="form-control" id="code_number">{{ $discount->code_number }}</span>
                                </div>
                            </div>
                            <hr class="line-dashed line-full"/>
                            <div class="form-group">
                                <label class="col-md-2 control-label">Giá trị khuyến mại</label>
                                <div class="col-md-10">
                                    <span class="form-control" id="amount">
                                        @if ($discount->type == 1 || $discount->type == 2)
                                            {{ $discount->amount }} VNĐ
                                        @else 
                                            {{ $discount->amount }} %
                                        @endif
                                    </span>
                                </div>
                            </div>
                            <hr class="line-dashed line-full"/>
                            <div class="form-group">
                                <label class="col-md-2 control-label">Tổng số lượt sử dụng / đã dùng</label>
                                <div class="col-md-10">
                                    <span class="form-control" id="total_use_on_used">{{ $discount->total }} / {{ $discount->use_count }}</span>
                                </div>
                            </div>
                            <hr class="line-dashed line-full"/>
                            <div class="form-group">
                                <label class="col-md-2 control-label">Tổng số lượt dùng của một người</label>
                                <div class="col-md-10">
                                    <span class="form-control" id="total_one_user">{{ $discount->total_one_user }}</span>
                                </div>
                            </div>
                            <hr class="line-dashed line-full"/>
                            <div class="form-group">
                                <label class="col-md-2 control-label">Ngày áp dụng</label>
                                <div class="col-md-10">
                                    <span class="form-control" id="start_time">{{ $discount->start_time }}</span>
                                </div>
                            </div>
                            <hr class="line-dashed line-full"/>
                            <div class="form-group">
                                <label class="col-md-2 control-label">Ngày kết thúc </label>
                                <div class="col-md-10">
                                    <span class="form-control" id="end_time">{{ $discount->end_time }}</span>
                                </div>
                            </div>
                            <hr class="line-dashed line-full"/>
                            <div class="form-group">
                                <label class="col-md-2 control-label">Ghi chú</label>
                                <div class="col-md-10">
                                    <span class="form-control" id="description">{{ $discount->description }}</span>
                                </div>
                            </div>
                            <hr class="line-dashed line-full"/>
                            <div class="form-group">
                                <label class="col-md-2 control-label">Trạng thái mã khuyến mại</label>
                                <div class="col-md-10">
                                    <span class="form-control" id="status" >
                                        @if ($discount->status == 1)
                                            Kích hoạt
                                        @else
                                            Khóa
                                        @endif
                                    </span>
                                </div>
                            </div>
                            
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- /tile footer -->
</section>

<script type="text/javascript">
    

</script>
@endsection


