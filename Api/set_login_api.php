<?php

    header("Access-Control-Allow-Methos: POST");
    header("Content-Type: appilcation/json");

    include('Api.php');

    $Api = new Api();

    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        $Api->singin_to_user($_POST['email'],$_POST['password']);
    }
    else{
        echo json_encode(['result'=>'This Methos is Not....']);
    }

?>