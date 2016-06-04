@extends('app.accounts.account')
@section('account')
    <script src="{{ asset("theme/js/plugins/bootbox/bootbox.js")}}"></script>

<!-- tile -->
<div class="row">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Danh sách tài khoản</h5>
                <div class="ibox-tools">
                    <a class="collapse-link">
                        <i class="fa fa-chevron-up"></i>
                    </a>
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-wrench"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="#">Config option 1</a>
                        </li>
                        <li><a href="#">Config option 2</a>
                        </li>
                    </ul>
                    <a class="close-link">
                        <i class="fa fa-times"></i>
                    </a>
                </div>
            </div>
            <div class="ibox-content">
                <div class="table-responsive">
                    <table class="table table-striped table-hover table-custom" id="accounts-list" style="width: 100%;">
                        <thead>
                            <tr>
                                <th class="text-center" width="4%">Mã người dùng</th>
                                <th class="text-center">Tên người dùng</th>
                                <th class="text-center">Tài khoản chính</th>
                                <th class="text-center">Chức năng</th>
                            </tr>
                            <tr class="table-header-search">
                                <th class="text-center" width="4%">
                                    <input class="text-center" name="code" value="" placeholder="Mã người dùng" />
                                </th>
                                <th class="text-center">
                                    <input class="text-center" name="name" value="" placeholder="Tên người dùng" />
                                </th>
                                <th class="text-center">
                                    <input class="text-center" name="main" value="" placeholder="Tài khoản chính" />
                                </th>
                                <th class="text-center clear-filter"></th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script >
    $(document).ready(function () {
        var common_render = {
            "render": function (data, type, row) {
                return render_common(data);
            },
            "targets": [0, 1]
        };
        
        var money_render = {
            "render": function (data, type, row) {
                return render_money(data);
            },
            "targets": [2]
        };
        
        var function_render = {
            "render": function (data, type, row) {
                return render_function(data);
            },
            "targets": [3]
        };
        function render_common(data) {
            return "<div class='text-center'>" + data + "</div>";
        }
        
        function render_money(data) {
            if (data == null) data = "0"
            return "<div class='text-center'>" + data + " đ</div>";
        }
        
        function render_function(data) {
            return "<div class='text-center'>" +
                    "<a class='btn btn-primary' onclick='money(" + data + ",1)' style='width: 70px;'>Cộng</a>" +
                    "<a class='btn btn-danger' onclick='money(" + data + ",0)' style='width: 70px; margin-left: 10px;'>Trừ</a>" +
                    "</div>";
        }
        var config = [];
        var renders = [];
        renders.push(common_render);
        renders.push(money_render);
        renders.push(function_render);
        config['colums'] = ["code", "name", "main", "id"];
        config['url'] = "/account/load_list";
        config['id'] = "accounts-list";
        config['data_array'] = renders;
        config['clear_filter'] = true;
        config['sort_off'] = [3];
        config['hidden_global_seach'] = true;
        setAjaxDataTable(config);
    });
    function money(id,type){
        if (type == 1) {
            question = "Nhập số tiền muốn cộng?";
        } else question = "Nhập số tiền muốn trừ?";
        bootbox.prompt({
            title: question,
            value: "",
            callback: function(result) {
                if (result === "") {
                    alert("Chưa nhập số tiền!");
                    return
                } else {
                    if( (/^\+?\d+$/.test(result)) == false){
                        alert("Sai định dạng số tiền!");
                        return
                    } else {
                        var jqxhr = $.ajax({
                                url: "/account/update_money",
                                data: {"money": result, "id":id, "type": type},
                                type: "POST"
                            })
                            .done(function(msg) {
                                location.reload();
                            })
                            .fail(function() {
                                alert( "Sảy ra lỗi, xin hãy thử lại" );
                            })
                    }
                }
            }
        });
    }
</script>
@endsection
