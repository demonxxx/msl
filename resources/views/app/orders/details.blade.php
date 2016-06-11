<div class="container-fluid">
    <div class="table-responsive">
        <table class="table table-condensed">
            <tbody>
                <tr>
                    <th colspan="8"><h4>Thông tin khách hàng</h4></th>
                </tr>
                <tr>
                    <th width='15%'>Mã khách hàng</th>
                    <td>{{$details->customer_code}}</td>
                    <th width='10%'>Họ tên</th>
                    <td>{{$details->customer_name}}</td>
                    <th width='5%'>Email</th>
                    <td>{{$details->customer_email}}</td>
                    <th width='15%'>Số ĐT</th>
                    <td>{{$details->customer_phone_number}}</td>
                </tr>
            </tbody>
        </table>
        <table class="table table-condensed">
            <tbody>
                <tr>
                    <th colspan="8"><h4>Thông tin đơn hàng</h4></th>
                </tr>
                <tr>
                    <th width='10%'>Mã đơn</th>
                    <td>{{$details->code}}</td>
                    <th width='15%'>Tên đơn</th>
                    <td>{{$details->name}}</td>
                    <th width='15%'>ĐC lấy</th>
                    <td>{{$details->full_address_from}}</td>
                    <th width='15%'>ĐC giao</th>
                    <td>{{$details->full_address_to}}</td>
                </tr>
                <tr>
                    <th>Người nhận</th>
                    <td>{{$details->recipient_name}}</td>
                    <th>SĐT người nhận</th>
                    <td>{{$details->recipient_phone}}</td>
                    <th>Người nhận</th>
                    <td>{{$details->recipient_name}}</td>
                    <th>SĐT người nhận</th>
                    <td>{{$details->recipient_phone}}</td>
                </tr>
                <tr>
                    <th>Giá trị</th>
                    <td>{{$details->order_values}}</td>
                    <th>Khoảng cách</th>
                    <td>{{$details->distance}}</td>
                    <th>Trọng lượng</th>
                    <td>{{$details->weight}}</td>
                    <?php
                    switch ($details->status) {
                        case 1:
                            $status = 'Đang xử lý';
                            break;
                        case 2:
                            $status = 'Đã nhận đơn';
                            break;
                        case 3:
                            $status = 'Đã nhận hàng';
                            break;
                        case 4:
                            $status = 'Đang vận chuyển';
                            break;
                        case 5:
                            $status = 'Vận chuyển thành công';
                            break;
                        case 6:
                            $status = 'Đã trả tiền';
                            break;
                        case 7:
                            $status = 'Hủy đơn hàng';
                            break;
                        case 8:
                            $status = 'Đã trả hàng';
                            break;
                        case 9:
                            $status = 'Đang trả hàng';
                            break;
                        default:
                            $status = 'Đang xử lý';
                    }
                    ?>
                    <th>Trạng thái</th>
                    <td><?php echo $status; ?></td>
                </tr>
                <tr>
                    <th>Cước chính</th>
                    <td>{{$details->main_freight}}</td>
                    <th>Cước phụ</th>
                    <td>{{$details->vas_freight}}</td>
                    <th>Cước giảm</th>
                    <td>{{$details->discount_freight}}</td>
                    <th>Cước cuối</th>
                    <td>{{$details->base_freight}}</td>
                </tr>
                <tr>
                    <th>Nhận đơn</th>
                    <td>{{$details->taken_order_at}}</td>
                    <th>Nhận hàng</th>
                    <td>{{$details->taken_items_at}}</td>
                    <th>Chuyển hàng</th>
                    <td>{{$details->shipping_at}}</td>
                    <th>Chuyển thành công</th>
                    <td>{{$details->ship_success_at}}</td>
                </tr>
                <tr>
                    <th>Thanh toán</th>
                    <td>{{$details->payed_at}}</td>
                    <th>Hủy đơn</th>
                    <td>{{$details->shop_cancel_at}}</td>
                    <th>Đang trả</th>
                    <td>{{$details->returning_at}}</td>
                    <th>Đã trả</th>
                    <td>{{$details->return_items_at}}</td>
                </tr>
                <tr>
                    <th>Bắt đầu</th>
                    <td>{{$details->start_time}}</td>
                    <th>Kết thúc</th>
                    <td>{{$details->end_time}}</td>
                    <th>Loại đơn</th>
                    <td>{{$details->order_type_name}}</td>
                    <th>Phương tiện</th>
                    <td>{{$details->vehicle_name}}</td>
                </tr>
            </tbody>
        </table>
        <table class="table table-condensed">
            <tbody>
                <tr>
                    <th colspan="6"><h4>Thông tin người vận chuyển</h4></th>
                </tr>
                <tr>
                    <th width='10%'>Mã</th>
                    <td>{{$details->shipper_code}}</td>
                    <th width='15%'>Họ tên</th>
                    <td>{{$details->shipper_name}}</td>
                    <th width='15%'>Số ĐT</th>
                    <td>{{$details->shipper_phone_number}}</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>