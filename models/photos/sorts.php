<?php
session_start();
header("Content-Type: application/json");

if(isset($_POST['sort'])){
    $sort = $_POST['sort'];

    include "../../config/connection.php";
    include "functions.php";

    if(isset($_SESSION['user'])){
        if($_SESSION['user']->role_id==1){
            $edit=1;
        }else{
            $edit=$_SESSION['user']->useid;
        }

    }else{
        $edit="no";
    }
    
    $quer = Query($limit = 0);

    switch($sort){
        case 0:
            $quer .= " ORDER BY post_time DESC LIMIT :limit, :offset";
            break;
        case 1:
            $quer .= " ORDER BY pu.title ASC LIMIT :limit, :offset";
            break;
        case 2:
            $quer .= " ORDER BY pu.title DESC LIMIT :limit, :offset";
            break;
        case 3:
            $quer .= " ORDER BY post_time ASC LIMIT :limit, :offset";
            break;
        case 4:
            $quer .= " ORDER BY post_time DESC LIMIT :limit, :offset";
            break;
    }
    $nop=$conn->prepare("SELECT COUNT(*) AS num_of_photos FROM posts");
    $nop->execute();
    $nop1 = $nop->fetch();

    $limit = ((int) $limit) * PHOTO_OFFSET; 

    $offset = PHOTO_OFFSET;

   
    $num_of_p = $nop1->num_of_photos;
    $num_of_photos=($num_of_p / PHOTO_OFFSET);


    $result = $conn->prepare($quer);
    $result->bindParam(":limit", $limit, PDO::PARAM_INT); 
    $result->bindParam(":offset", $offset, PDO::PARAM_INT);

    $result->execute();

   

    $posts = $result->fetchAll();
    $photos=$posts;

    echo json_encode([
        "photos" => $photos,
        "num_of_photos" => $num_of_photos,
        "edit" => $edit
    ]);
} else {
    http_response_code(400);
}