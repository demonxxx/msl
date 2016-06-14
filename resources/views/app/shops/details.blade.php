<div class="container-fluid">
    <div class="table-responsive">
        <table class="table table-condensed">
            <tbody>
                <tr>
                    <th colspan="8"><h3 style="color:green;">Thông tin chủ shop</h3></th>
                </tr>
                <tr>
                    <th width='15%'>Mã khách hàng</th>
                    <td>{{$shop->user_code}}</td>
                    <th width='10%'>Họ tên</th>
                    <td>{{$shop->user_name}}</td>
                    <th width='15%'>Tên đăng nhập</th>
                    <td>{{$shop->username}}</td>
                    <th width='5%'>Email</th>
                    <td>{{$shop->email}}</td>
                </tr>
                <tr>
                    <th colspan="2">Chứng minh thư</th>
                    <td>{{$shop->identity_card}}</td>
                    <th width='15%'>Tài khoản chính</th>
                    <td>{{$shop->account_main}}</td>
                    <th width='15%'>Tài khoản phụ</th>
                    <td colspan="2">{{$shop->account_second}}</td>
                </tr>
            </tbody>
        </table>
        <table class="table table-condensed">
            <tbody>
                <tr>
                    <th colspan="8"><h3 style="color:green;">Thông tin shop</h3></th>
                </tr>
                <tr>
                    <th width='10%'>Mã shop</th>
                    <td>{{$shop->code}}</td>
                    <th width='10%'>Tên shop</th>
                    <td>{{$shop->shop_name}}</td>
                    <th width='20%'>Tổng số cửa hàng</th>
                    <td>{{$shop->agency_number}}</td>
                    <th width='20%'>Tổng số đơn hàng</th>
                    <td>{{$shop->order_number}}</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>