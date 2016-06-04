/**
 * Created by ngoduyanh on 4/29/16.
 */

function setDatatable(data) {
    var tableId = data.id;
    var url = data.url;
    var colums_data = data.colums;
    var colums_render = [];
    var renders = data.renders;
    var columDefs = [];
    for (var i = 0; i < renders.length; i++) {
        columDefs.push(renders[i]);
    }

    for (var i = 0; i < colums_data.length; i++) {
        colums_render.push({"data": colums_data[i]});
    }
    var oTable = $('#' + tableId).DataTable(
            {
                dom: '<"html5buttons"B>lTfgitp',
                buttons: [
                    {extend: 'copy'},
                    {extend: 'csv'},
                    {extend: 'excel', title: 'ExampleFile'},
                    {extend: 'pdf', title: 'ExampleFile'},
                    {extend: 'print',
                        customize: function (win) {
                            $(win.document.body).addClass('white-bg');
                            $(win.document.body).css('font-size', '10px');

                            $(win.document.body).find('table')
                                    .addClass('compact')
                                    .css('font-size', 'inherit');
                        }
                    }
                ],
                "language": {
                    "sLengthMenu": 'View _MENU_ records',
                    "sInfo": 'Found _TOTAL_ records',
                    "oPaginate": {
                        "sPage": "Page ",
                        "sPageOf": "of",
                        "sNext": '<i class="fa fa-angle-right"></i>',
                        "sPrevious": '<i class="fa fa-angle-left"></i>'
                    }
                },
                "processing": true,
                "serverSide": true,
                "pagingType": "input",
                "ajax": {
                    "url": url,
                    "type": "POST"
                },
                "order": [[1, "asc"]],
                "columns": colums_render,
                "aoColumnDefs": columDefs,
                "drawCallback": function (settings, json) {

                }
            });
    return oTable;
}

jQuery.fn.dataTableExt.oApi.fnPagingInfo = function (oSettings)
{
    return {
        "iStart": oSettings._iDisplayStart,
        "iEnd": oSettings.fnDisplayEnd(),
        "iLength": oSettings._iDisplayLength,
        "iTotal": oSettings.fnRecordsTotal(),
        "iFilteredTotal": oSettings.fnRecordsDisplay(),
        "iPage": oSettings._iDisplayLength === -1 ?
                0 : Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength),
        "iTotalPages": oSettings._iDisplayLength === -1 ?
                0 : Math.ceil(oSettings.fnRecordsDisplay() / oSettings._iDisplayLength)
    };
};

// setting default datatable
$.extend(true, $.fn.dataTable.defaults, {
    "language": {
        "lengthMenu": "Hiển thị _MENU_ dòng mỗi trang",
        "zeroRecords": "Không tìm thấy thông tin",
        "info": "Hiển thị trang _PAGE_ trên _PAGES_",
        "infoEmpty": "Không có thông tin",
        "infoFiltered": "(lọc từ _MAX_ tổng số kết quả)",
        "paginate": {
            "first": "Trang đầu",
            "last": "Trang cuối",
            "next": "Sau",
            "previous": "Trước"
        },
        "decimal": "",
        "infoEmpty": "Hiển thị 0 đến 0 của 0 kết quả",
                "infoPostFix": "",
        "thousands": ",",
        "loadingRecords": "Đang tải dữ liệu...",
        "processing": "Đang xử lý dữ liệu...",
        "search": "Tìm kiếm:",
    }
});

// function add datatable
// config required:
// table id, ajax url, columns config
// optionals:
// sort off columns, clear filter, global filter off, callback
function setAjaxDataTable(config) {
    var table = document.getElementById(config['id']);
    var url = config['url'];
    var colums = config['colums'];
    config['table'] = document.getElementById(config['id']);
    // config sort of all column table
    var sortAble = true;
    sortAble = config['sortable'];
    var convert_colums = [];
    var columns_length = (config['columns_length'] !== undefined) ? config['columns_length'] : colums.length;
    for (var i = 0; i < columns_length; i++) {
        if (sortAble === false) {
            convert_colums.push({"bSortable": false, "mData": $colums[i]});
        } else {
            convert_colums.push({"mData": colums[i]});
        }
    }
    // config sort of a column
    var sortOff = config['sort_off'];
    if (sortOff !== undefined) {
        for (var i = 0; i < sortOff.length; i++) {
            convert_colums[sortOff[i]].bSortable = false;
        }
    }

    // config visible column
    var bVisibleCol = config['bVisibleCols'];
    if (bVisibleCol !== undefined) {
        for (var i = 0; i < bVisibleCol.length; i++) {
            convert_colums[bVisibleCol[i]].bVisible = false;
            convert_colums[bVisibleCol[i]].aTargets = bVisibleCol[i];
        }
    }

    // config custom data post to server
    var convertDataPost = [];
    if (config['data_post'] !== undefined) {
        for (var key in config['data_post']) {
            convertDataPost.push({"name": key, "value": config['data_post'][key]});
        }
    }

    // config data refence
    var colums_render = [];
    var data_set = config['data_array'];
    if (data_set !== undefined) {
        for (var i = 0; i < data_set.length; i++) {
            colums_render.push(data_set[i]);
        }
    }

    config['searchInit'] = [];
    $(table).find("tr.table-header-search").find("th").each(function (i, e) {
        if ($(this).find('input').length || $(this).find('select').length) {
            $(this).find('input').attr('id', "search_" + config['id'] + i);
            $(this).find('select').attr('id', "search_" + config['id'] + i);
            config['searchInit'].push("search_" + config['id'] + i);
        }
    });
    // before callback
    if (config['beforeCallback'] !== undefined) {
        var beforeCallback = config['beforeCallback'];
        if (beforeCallback) {
            beforeCallback(config);
        }
    }

    // init datatable
    var oTable = $(table).DataTable({
        "bProcessing": false,
        "bServerSide": true,
        "bStateSave": false,
        "responsive": true,
        "bDestroy": true,
        "bAutoWidth": false,
        "bFilter": true,
        "bSort": true,
        "bSortCellsTop": true,
        "bRegex": true,
        "bRetrieve": true,
        "bDeferRender": true,
        "sAjaxSource": url,
        "bAutoWidth":true,
                "fnServerData": function (sSource, aaData, fnCallback)
                {
                    $.ajax({
                        "dataType": "json",
                        "type": "POST",
                        "url": sSource,
                        "data": aaData,
                        "success": fnCallback
                    });
                }, "fnServerParams": function (aaData) {
            aaData.push({
                "name": "data_post",
                "value": JSON.stringify(convertDataPost)
            });
            if (config['data_send_to_server'] !== undefined) {
                aaData.push({
                    "name": "data_send_to_server",
                    "value": JSON.stringify(config['data_send_to_server'])
                });
            }
        },
        "fnDrawCallback": function (oSettings) {
            global = oSettings;
            if (config['fnDrawCallback'] !== undefined) {
                var callback = config['fnDrawCallback'];
                if (callback) {
                    callback(oSettings);
                }
            }
        },
        "fnRowCallback": function (nRow, aData, iDisplayIndex, iDisplayIndexFull) {
            if (config['fnRowCallback'] !== undefined) {
                var callback = config['fnRowCallback'];
                if (callback) {
                    callback(nRow, aData, iDisplayIndex, iDisplayIndexFull);
                }
            }
            return nRow;
        },
        "createdRow": function (row, data, index) {
            if (config['createdRow'] !== undefined) {
                var callback = config['createdRow'];
                if (callback) {
                    callback(row, data, index);
                }
            }
        },
        "aoColumns": convert_colums,
        "aoColumnDefs": colums_render
    });
    config['oTable'] = oTable;
    // add action listener
    if (config['listenerCallback'] !== undefined) {
        var listenerCallback = config['listenerCallback'];
        if (listenerCallback) {
            listenerCallback(config);
        }
    }
    for (var i = 0; i < convert_colums.length; i++) {
        $("#search_" + config['id'] + "" + i).on("change", function () {
            var value = $(this).val() || "";
            var searchData = "";
            if ($.isArray(value)) {
                for (var i = 0; i < value.length - 1; i++) {
                    searchData += "'" + value[i] + "',";
                }
                searchData += "'" + value[value.length - 1] + "'";
            } else {
                searchData = value;
            }
            oTable.column($(this).closest("th").index()).search(searchData).draw();
        });
    }
    if (config['clear_filter'] !== undefined) {
        var clearButton = '<button id="clear_' + config['id'] + '" class="btn btn-primary btn-clear btn-sm"> <i class="fa fa-refresh"></i> Reload</button>';
        $(table).find("tr.table-header-search").find("th.clear-filter").append(clearButton);
    }
    $("#clear_" + config['id']).click(function (e) {
        for (var i = 0; i < convert_colums.length; i++) {
            $("#search_" + config['id'] + "" + i).val("");
            oTable.column(i).search("");
        }
        $(".multiple_select_cb").each(function (i, e) {
            $(e).val([]);
        });
        oTable.draw();
    });
    if (config['hidden_global_seach'] !== undefined) {
        $(".dataTables_filter").hide();
    }
    if (config['callback'] !== undefined) {
        var callback = config['callback'];
        if (callback) {
            callback(config);
        }
    }
    return oTable;
}