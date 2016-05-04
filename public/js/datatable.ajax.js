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
    for (var i = 0; i < renders.length; i ++){
        columDefs.push(renders[i]);
    }

    for (var i = 0; i < colums_data.length; i++) {
        colums_render.push({"data": colums_data[i]});
    }
    var oTable = $('#' + tableId).DataTable(
        {
            "dom": '<"row"<"col-md-8 col-sm-12"<"inline-controls"l>><"col-md-4 col-sm-12"<"pull-right"f>>>t<"row"<"col-md-4 col-sm-12"<"inline-controls"l>><"col-md-4 col-sm-12"<"inline-controls text-center"i>><"col-md-4 col-sm-12"p>>',
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
