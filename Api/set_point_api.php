<?php

    header("Access-Control-Allow-Methos: POST");
    header("Content-Type: appilcation/json");

    include('Api.php');

    $Api = new Api();

    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        $Api->AddPoint($_POST['total_amount'],$_POST['u_id'],$_POST['last_withdraw'],$_POST['ad_count']);
    }
    else{
        echo json_encode(['result'=>'This Methos is Not....']);
    }
?>