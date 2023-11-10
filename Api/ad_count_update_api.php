<?php

    header("Access-Control-Allow-Methos: POST");
    header("Content-Type: appilcation/json");

    include('Api.php');

    $Api = new Api();

    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        $Api->updateAd($_POST['id'],$_POST['ad_count']);
    }
    else{
        echo json_encode(['result'=>'This Methos is Not....']);
    }

?>