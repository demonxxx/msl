<?php

// Code within app\Helpers\Helper.php
define("RANDOM_CODE_START", 100);
define("RANDOM_CODE_END", 200);
define("SHOP_TYPE", 1);
define("SHIPPER_TYPE", 2);
define("ADMIN_TYPE", 3);
define('ONLINE', 1);
define("OFFLINE", 0);
define("TIME_CHECK_ONLINE", 30);

define("ORDER_PENDING", 1);
define("ORDER_TAKEN_ORDER", 2);
define("ORDER_TAKEN_ITEMS", 3);
define("ORDER_SHIPPING", 4);
define("ORDER_SHIP_SUCCESS", 5);
define("ORDER_PAYED", 6);
define("ORDER_SHOP_CANCEL", 7);
define("ORDER_RETURNING", 8);
define("ORDER_RETURN_ITEMS", 9);

define("FREIGHT_SHIP", 0.15);
define("MSG_TRANSACTION_SHIPPER", "Trừ tiền ship");
define("MSG_ORDER_NOT_EXIST", "Đơn hàng không tồn tại!");
define("MSG_SHOP_NOT_EXIST", "Khách hàng không tồn tại!");
define("MSG_NOT_HAVE_PERMISSION", "Bạn không có quyền này!");
define("MSG_DISTANCE_FREIGHT_NOT_EXIST", "Không tồn tại giá cước này!");
define("MSG_CAN_NOT_CANCEL_ORDER", "Bạn không thể hủy đơn hàng được, đơn hàng đã được nhận!");
define("MSG_ORDER_HAVE_BEEN_CANCEL", "Đơn hàng đã được hủy");
define("MSG_CANCEL_ORDER_SUCCESSFULLY", "Hủy đơn hàng thành công!");
define("MSG_USER_DO_NOT_EXIST", "Người dùng không tồn tại");
define("MSG_PHONE_NUMBER_EXIST", "Đã tồn tại số điện thoại");
define("MSG_EMAIL_EXIST", "Đã tồn tại địa chỉ email");
define("MSG_UPDATE_USER_INFO_SUCCESSFULLY", "Cập nhật thông tin thành công");
define("MSG_FEEDBACK_EMPTY", "Nội dung phản hồi trống!");
define("MSG_FEEDBACK_SUCCESSFULLY", "Phản hồi thành công!");
define("FEEDBACK_STRING_LIMIT", 1000);
define("MSG_FEEDBACK_STRING_LIMIT", "Nội dung phản hồi quá " . FEEDBACK_STRING_LIMIT . " kí tự!");

define("MSG_UPLOAD_FILE_SUCCEEDED", "Gửi tệp tin thành công!");
define("MSG_UPLOAD_FILE_FAILED", "Gửi tệp tin không thành công!");
define("MSG_UPLOAD_FILE_EMPTY", "Chưa đính kèm!");
define("MSG_UPLOAD_FILE_SIZE", "Kích cỡ ảnh quá quy định!");
define("MSG_UPLOAD_WRONG_IMAGE_TYPE", "Sai định dạng ảnh!");
define("AVATAR_SIZE", 1);
define("IMAGE_SIZE", 5);
define("UPLOAD_AVATAR_DIR", "/var/www/upload/avatar/");
define("UPLOAD_ORDER_DIR", "/var/www/upload/order/");
define("UPLOAD_DIR", "/var/www/upload/");

define("ACCOUNT_TYPE_MAIN", 1);
define("ACCOUNT_TYPE_SECOND", 2);

define("TRANSACTION_TYPE_ADD", 1);
define("TRANSACTION_TYPE_SUB", 2);
// Mobile notification
define("IOS_CERTIFICATE_FILE", "certificate.pem");

// Google API
define("GOOGLE_API_KEY", 'google_api_key');
// Administrative units
define("CITY_UNIT", 0);
define("DISTRICT_UNIT", 1);
define("WARD_UNIT", 2);
// ajax result
define("AJAX_SUCCESS", 1);
define("AJAX_FAILED", 0);

define("DISCOUNT_ACTIVE", 1);
define("DISCOUNT_DEACTIVE", 0);

define("DISCOUNT_PERCENT", 0);
define("DISCOUNT_MONEY", 1);
define("DISCOUNT_GIFT", 2);

define("MSG_UPDATE_GCM_ID_SUCCESS", "Cập nhật gcm id thành công!");
define("MSG_UPDATE_GCM_ID_FAILED", "Cập nhật gcm id không thành công!");
define("MSG_LOGIN_REQUIRE", "Người dùng cần đăng nhập để thực hiện thao tác!");
