<div class="container-fluid">
    <div class="row"><h3><label>Thông tin chủ shop</label></h3></div>
    <div class="row">
        <label class="col-md-4">Mã</label>
        <div class="col-md-8">{{$shop->user_code}}</div>
    </div>
    <div class="row">
        <label class="col-md-4">Họ tên</label>
        <div class="col-md-8">{{$shop->user_name}}</div>
    </div>
    <div class="row">
        <label class="col-md-4">Tên đăng nhập</label>
        <div class="col-md-8">{{$shop->username}}</div>
    </div>
    <div class="row">
        <label class="col-md-4">Email</label>
        <div class="col-md-8">{{$shop->email}}</div>
    </div>
    <div class="row">
        <label class="col-md-4">Chứng minh thư</label>
        <div class="col-md-8">{{$shop->identity_card}}</div>
    </div>
    <div class="row"><h3><label>Thông tin shop</label></h3></div>
    <div class="row">
        <label class="col-md-4">Mã</label>
        <div class="col-md-8">{{$shop->code}}</div>
    </div>
    <div class="row">
        <label class="col-md-4">Tên</label>
        <div class="col-md-8">{{$shop->shop_name}}</div>
    </div>
    <div class="row">
        <label class="col-md-4">Tổng số cửa hàng</label>
        <div class="col-md-8">{{$shop->agency_number}}</div>
    </div>
    <div class="row">
        <label class="col-md-4">Tổng số đơn hàng</label>
        <div class="col-md-8">{{$shop->order_number}}</div>
    </div>
</div>