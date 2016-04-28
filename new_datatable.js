var firstRender = true;
var global_datatable;
var handleKeyupEvent = function(id, table, table_id){
    $("#search_" + table_id+ ""+id).on("keyup change", function (e) {
        if($(this).attr("class") === "search_init"){
            if($(this).val() == ''){
                firstRender = true;
            }else{
                firstRender = false;
            }
            if(e.which !== undefined){
                table.fnFilter(this.value, id, true);
            }
        } else {
            table.fnFilter(this.value, id, true);
        }
    });
};

var setNewDatatable = function ($config){
    var $sDOM = "<'dt-top-row'Clf>r<'dt-wrapper't><'dt-row dt-bottom-row'<'row'<'col-sm-6'i><'col-sm-6 text-right'p>>";
    var $sButton = function(oSettings, json) {
        $('.ColVis_Button').addClass('btn btn-default btn-sm').html('Columns <i class=\"icon-arrow-down\"></i>');
    };
    var sortOff = $config['sort_off'];
    var $table = $config['table_name'];
    var $colums = $config['colums'];
    var data_set = $config['data_array'];
    var bVisibleCol = $config['bVisibleCols'];
    var sorable = true;
    sorable = $config['sortable'] === undefined ? true : $config['sortable'];
    var colums_json = JSON.stringify($colums);
    var convert_colums = [];
    var colums_render = [];
    var convertDataPost = [];

    for(var i = 0; i < $colums.length; i ++){
        if(sorable === false){
            convert_colums.push({"bSortable": false,"mData":$colums[i]});
        }else {
            convert_colums.push({"mData":$colums[i]});
        }
    }

    if(sortOff !== undefined){
        for(var i = 0; i < sortOff.length; i ++){
            convert_colums[sortOff[i]].bSortable = false;
        }
    }

    if(bVisibleCol !== undefined){
        for(var i = 0; i < bVisibleCol.length; i ++){
            convert_colums[bVisibleCol[i]].bVisible = false;
            convert_colums[bVisibleCol[i]].aTargets = bVisibleCol[i];
        }

    }
    if($config['data_post'] !== undefined){
        for(var key in $config['data_post']){
            convertDataPost.push({"name": key, "value": $config['data_post'][key]});
        }
    }
    if(data_set !== undefined){
        for(var  i= 0; i< data_set.length; i ++){
            colums_render.push(data_set[i]);
        }
    }
    var oTable = $("#"+$table).dataTable({
        "aaSorting":[],
        "sPaginationType": "bootstrap_full",
        "sDom" : $sDOM,
        "fnInitComplete" : $sButton ,
        "responsive": true,
        "bDestroy": true,
        "bAutoWidth" : false,
        "bFilter": true,
        "bSort": true,
        "bSortCellsTop" : true,
        "bRegex":true,
        "bRetrieve": true,
        "oSearch": {"bRegex": true},
        "bProcessing": true,
        "bServerSide": true,
        "stateSave": true,
        "bDeferRender": true,
        "sAjaxSource": $config['url'],
        "fnServerData": function(sSource, aaData, fnCallback)
        {
            $.ajax({
                "dataType": "json",
                "type"    : "POST",
                "url"     : sSource,
                "data"    : aaData,
                "success" : fnCallback
            });
        },
        "fnServerParams": function ( aaData ) {
            aaData.push({"name": "colums", "value": colums_json});
            aaData.push(convertDataPost);
			if($config['data_send_to_server'] !== undefined){
                aaData.push({
                    "name": "data_send_to_server",
                    "value": JSON.stringify($config['data_send_to_server'])
                });
            }
        },
        "fnDrawCallback": function( oSettings ) {
            if($table == 'list_svmc_project' && firstRender == false){
                $('#'+$table).find('.btn-circle').each(function(i,e){
                    $(e).click();
                });
            }
            if($config['fnDrawCallback'] !== undefined) {
                $config['fnDrawCallback'](oSettings);
            }
            if($config['tooltip'] !== undefined) {
                $(".tooltip_pic").tooltip({
                    items: "[attr-tooltip], [title]",
                    position: {
                        my: "center bottom-20",
                        at: "center top",
                        using: function (position, feedback) {
                            $(this).css(position);
                            $("<div>").addClass("arrow").addClass(feedback.vertical).addClass(feedback.horizontal).appendTo(this);
                        }
                    },
                    content: function() {
                      var element = $( this );

                      if ( element.is( "[attr-tooltip]" ) ) {
                        var email = element.attr('attr-email');
                        var phone = element.attr('attr-phone');
                        return '<div style="text-align:left">'+
                                '<table style="width:100%;">'+
                                '<tr><td style="width:60px">Email:</td><td>'+$.trim(email)+'</td></tr>'+
                                '<tr><td>Phone:</td><td>'+$.trim(phone)+'</td></tr>'+
                                '</table></div>';
                      }
                    }
                  });
            }

	},
        "aoColumns": convert_colums,
        "aoColumnDefs": colums_render
    });

    for(var i =0; i < convert_colums.length; i++){
        handleKeyupEvent(i,oTable, $table);
    }

    $("#clear_"+$table).click(function(e) {
        var oSettings = oTable.fnSettings();
        for(var iCol = 0; iCol < oSettings.aoPreSearchCols.length; iCol++) {
            oSettings.aoPreSearchCols[ iCol ].sSearch = "";
            $("#search_"+$table+iCol).val("");
            $("#placeholdersearch_"+iCol+"_"+$table).html("--- Select ---");
            $(".select2-chosen").html("");
        }
        
        $("#"+$table+" .multiple_select_cb").each(function(){
            $(this).prop('checked', false);
        });
        oSettings.oPreviousSearch.sSearch = "";
        oTable.fnDraw();
    });
    $.tableData = oTable;
    return oTable;
};

function check_logic_time(obj) {
    var check = false;
    if (obj.type === 'week') {
        check = check_period(obj.from.week, obj.to.week, obj.from.year, obj.to.year, obj.type);
    } else if (obj.type === 'month' || obj.type === 'quarter' || obj.type === 'year') {
        check = check_period(obj.from.month, obj.to.month, obj.from.year, obj.to.year, obj.type);
    }
    return check;
}
