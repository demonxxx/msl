<?php

// Code within app\Helpers\Helper.php

function flash_message($message, $level = "success") {
    session()->flash("flash_message", $message);
    session()->flash("flash_level", $level);
}

function build_json_datatable($data, $length, $post) {
    $datatable = new stdClass();
    $datatable->draw = $post['draw'];
    $datatable->recordsTotal = $length;
    $datatable->recordsFiltered = $length;
    $datatable->data = $data;
    return json_encode($datatable);
}

function get_post_datatable($post_input) {
    return $post_input;
}

// datatable new
function build_json_datatable_new($data, $length, $post) {
    $datatable = $post;
    $datatable['iTotalRecords'] = $length;
    $datatable['iTotalDisplayRecords'] = $length;
    $datatable['aaData'] = $data;
    return json_encode($datatable);
}

// get all params datatable send by ajax
function get_post_datatable_new($input) {
    $params = [];
    $params['sEcho'] = $input['sEcho'];
    $params['iColumns'] = $input['iColumns'];
    $params['sColumns'] = $input['sColumns'];
    $params['iDisplayStart'] = $input['iDisplayStart'];
    $params['iDisplayLength'] = $input['iDisplayLength'];
    $params['iSortCol_0'] = $input['iSortCol_0'];
    $params['sSortDir_0'] = $input['sSortDir_0'];
    $params['orderBy'] = $input['mDataProp_' . $input['iSortCol_0']];
    $params['orderSort'] = $input['sSortDir_0'];
    $params['sSortDir_0'] = $input['sSortDir_0'];
    $params['sSearch'] = $input['sSearch'];

    $searchParams = [];
    for ($i = 0; $i < (int) $params['iColumns']; $i++) {
        if ($input['sSearch_' . $i] !== "") {
            $searchParams[$input['mDataProp_' . $i]] = $input['sSearch_' . $i];
        }
    }

    $params['searchParams'] = $searchParams;

    return $params;
}
