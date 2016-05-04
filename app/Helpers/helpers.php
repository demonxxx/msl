<?php // Code within app\Helpers\Helper.php

function flash_message($message, $level = "success")
{
    session()->flash("flash_message", $message);
    session()->flash("flash_level", $level);
}

function build_json_datatable($data, $length, $post)
{
    $datatable = new stdClass();
    $datatable->draw = $post['draw'];
    $datatable->recordsTotal = $length;
    $datatable->recordsFiltered = $length;
    $datatable->data = $data;
    return json_encode($datatable);
}

function get_post_datatable($post_input){
    return $post_input;
}