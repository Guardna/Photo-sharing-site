<?php
header("Content-type: application/json");
if(isset($_GET['id'])){

    require_once "../../config/connection.php";
    require_once "functions.php";

    $id = $_GET['id'];

    $result=$conn->prepare("DELETE FROM posts WHERE id=?");
    $r=$result->execute([$id]);
    

    header("Location: ../../index.php?page=home");
} else {
    http_response_code(400);
}