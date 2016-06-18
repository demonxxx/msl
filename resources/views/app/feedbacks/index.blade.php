@extends('app.feedbacks.feedback')
@section('feedback')
<style>
    .modal70 > .modal-dialog {
        width:70% !important;
    }
    .modal80 > .modal-dialog {
        width:80% !important;
    }
    .modal-body {
        padding: 10px 30px 0px 30px !important;
    }
</style>
<div class="row">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Danh sách phản hồi</h5>
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
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover dataTables-example" id="feedbacks-list">
                        <thead>
                            <tr>
                                <th class="text-center">Mã KH</th>
                                <th class="text-center">Họ và tên</th>
                                <th class="text-center">Email</th>
                                <th class="text-center">Số điện thoại</th>
                                <th class="text-center" style="width:40%">Nội dung phản hồi</th>
                                <th class="text-center">Thời gian</th>
                                <th class="text-center">Chức năng</th>
                            </tr>
                            <tr class="table-header-search">
                                <th class="text-center">
                                    <input class="text-center" style="max-width: 50px;" name="code" value="" placeholder="Mã KH" />
                                </th>
                                <th class="text-center">
                                    <input class="text-center" style="max-width: 90px;" name="name" value="" placeholder="Họ và tên" />
                                </th>
                                <th class="text-center">
                                    <input class="text-center" style="max-width: 100px;" name="email" value="" placeholder="Email" />
                                </th>
                                <th class="text-center">
                                    <input class="text-center" style="max-width: 100px;" name="phone_number" value="" placeholder="SĐT" />
                                </th>
                                <th class="text-center">
                                    <input class="text-center" style="max-width: 250px;" name="feedback" value="" placeholder="Phản hồi" />
                                </th>
                                <th class="text-center">
                                    <input class="text-center" style="max-width: 90px;" name="created_at" value="" placeholder="Thời gian" />
                                </th>
                                <th class="text-center clear-filter"></th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>
<script>
    var feedbackTable;
    $(document).ready(function () {
        var common_render = {
            "render": function (data, type, row) {
                data = (data !== null) ? data : "";
                return "<div class='text-center'>" + data + "</div>";
            },
            "targets": [0, 1, 2, 3, 4, 5]
        };

        var function_render = {
            "render": function (data, type, row) {
                return "";
            },
            "targets": [6]
        };

        var config = [];
        var renders = [];
        renders.push(common_render);
        renders.push(function_render);
        config['colums'] = ["code", "name", "email", "phone_number", "feedback", "created_at", "id"];
        config['url'] = "/feedback/load_list";
        config['id'] = "feedbacks-list";
        config['data_array'] = renders;
        config['clear_filter'] = true;
        config['sort_off'] = [6];
        config['hidden_global_seach'] = true;
        feedbackTable = setAjaxDataTable(config);
    });
</script>
@endsection


