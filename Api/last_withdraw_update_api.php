<?php

    header("Access-Control-Allow-Methos: POST");
    header("Content-Type: appilcation/json");

    include('Api.php');

    $Api = new Api();

    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        $Api->updateWithdrw($_POST['id'],$_POST['last_withdraw']);
    }
    else{
        echo json_encode(['result'=>'This Methos is Not....']);
    }

?>