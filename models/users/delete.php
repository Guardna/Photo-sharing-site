<?php
header("Content-type: application/json");
if(isset($_GET['id'])){

    require_once "../../config/connection.php";
    require_once "functions.php";

    $id = $_GET['id'];

    $result=$conn->prepare("DELETE FROM users WHERE id=?");
    $r=$result->execute([$id]);
    

    $response = [];
    if($r){
        $response = getUsers();
    }
    echo json_encode($response);


} else {
    http_response_code(400);
}