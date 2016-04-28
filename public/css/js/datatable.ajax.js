/**
 * Created by ngoduyanh on 4/29/16.
 */
$('#products-list').DataTable(
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
        "pagingType": "input",
        "ajax": 'assets/extras/products.json',
        "order": [[1, "asc"]],
        "columns": [
            {
                "data": "null",
                "defaultContent": '<label class="checkbox checkbox-custom-alt checkbox-custom-sm m-0"><input type="checkbox" class="selectMe"><i></i></label>'
            },
            {"data": "id"},
            {"data": "name"},
            {"data": "category"},
            {
                "data": "price",
                "type": "num-fmt",
                "render": function (data) {
                    return '$' + parseFloat(data).toFixed(2);
                }
            },
            {
                "data": "date",
                "className": "formatDate"
            },
            {
                "type": "html",
                "data": "status",
                "render": function (data) {
                    if (data === 'published') {
                        return '<span class="label bg-success">' + data + '</span>'
                    } else if (data === 'not published') {
                        return '<span class="label bg-warning">' + data + '</span>'
                    } else if (data === 'deleted') {
                        return '<span class="label bg-lightred">' + data + '</span>'
                    }
                }
            },
            {
                "data": null,
                "defaultContent": '<a href="shop-single-product" class="btn btn-xs btn-default mr-5"><i class="fa fa-search"></i> View</a><a href="javascript:;" class="btn btn-xs btn-lightred"><i class="fa fa-times"></i> Delete</a>'
            }
        ],
        "aoColumnDefs": [
            {'bSortable': false, 'aTargets': ["no-sort"]}
        ],
        "drawCallback": function (settings, json) {
            $(".formatDate").each(function (idx, elem) {
                $(elem).text($.format.date($(elem).text(), "MMM d, yyyy"));
            });
            $('#select-all').change(function () {
                if ($(this).is(":checked")) {
                    $('#products-list tbody .selectMe').prop('checked', true);
                } else {
                    $('#products-list tbody .selectMe').prop('checked', false);
                }
            });
        }
    });