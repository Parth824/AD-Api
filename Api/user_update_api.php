<?php

    header("Access-Control-Allow-Methos: POST");
    header("Content-Type: appilcation/json");

    include('Api.php');

    $Api = new Api();

    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        $Api->updateUser($_POST['id'],$_POST['first_name'],$_POST['last_name']);
    }
    else{
        echo json_encode(['result'=>'This Methos is Not....']);
    }

?>