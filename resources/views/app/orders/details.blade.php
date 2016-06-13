<div class="container-fluid">
    <div class="table-responsive">
        <table class="table table-condensed">
            <tbody>
                <tr>
                    <th colspan="8"><h3 style="color:green;">Thông tin khách hàng</h3></th>
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
                    <th colspan="8"><h3 style="color:green;">Thông tin đơn hàng</h3></th>
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
                    <th colspan="2">Người nhận</th>
                    <td colspan="2">{{$details->recipient_name}}</td>
                    <th colspan="2">SĐT người nhận</th>
                    <td colspan="2">{{$details->recipient_phone}}</td>
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
                            $status = 'Đã thanh toán';
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
                    <th>TG nhận đơn</th>
                    <td>{{$details->taken_order_at}}</td>
                    <th>TG nhận hàng</th>
                    <td>{{$details->taken_items_at}}</td>
                    <th>TG chuyển thành công</th>
                    <td>{{$details->ship_success_at}}</td>
                    <th>TG thanh toán</th>
                    <td>{{$details->payed_at}}</td>
                </tr>
                <tr>
                    <th>TG hủy đơn</th>
                    <td>{{$details->shop_cancel_at}}</td>
                    <th>TG đang trả</th>
                    <td>{{$details->returning_at}}</td>
                    <th>TG đã trả</th>
                    <td colspan="3">{{$details->return_items_at}}</td>
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
                    <th colspan="6"><h3 style="color:green;">Thông tin người vận chuyển</h3></th>
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