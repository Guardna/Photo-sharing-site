<?php
session_start();
header("Content-Type: application/json");

if(isset($_GET['id'])){
    $name=trim("",$_GET['id']);
    if($name!=""){
    $name = "%".strtolower($name)."%";
    }else {$name="";}
}else {$name="";}
if(isset($_GET['limit'])){
    require_once "../../config/connection.php";
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

    $limit = $_GET['limit'];

    if($name!=""){

        $search = Query($limit = 0);
    
        $search .= " WHERE LOWER(title) LIKE :name LIMIT :limit, :offset";
        $nop=$conn->prepare("SELECT COUNT(*) AS num_of_photos FROM posts WHERE LOWER(title) LIKE :name");
        $nop->bindParam(":name", $name);
        $nop->execute();
        $nop1 = $nop->fetch();
    
        $limit = ((int) $limit) * PHOTO_OFFSET; 
    
        $offset = PHOTO_OFFSET;
    
       
        $num_of_p = $nop1->num_of_photos;
        $num_of_photos=($num_of_p / PHOTO_OFFSET);
    
    
        $result = $conn->prepare($search);
        $result->bindParam(":name", $name);
        $result->bindParam(":limit", $limit, PDO::PARAM_INT); 
        $result->bindParam(":offset", $offset, PDO::PARAM_INT);
    
        $result->execute();
    
       
    
        $posts = $result->fetchAll();
        $photos=$posts;

    }else{
        $photos = get_posts_with_photo($limit);
        $num_of_photos = get_pagination_count();
    }
    
    
    echo json_encode([
        "photos" => $photos,
        "num_of_photos" => $num_of_photos,
        "edit" => $edit
    ]);
} else {
    echo json_encode(["message"=> "Limit not passed."]);
    http_response_code(400); 
}