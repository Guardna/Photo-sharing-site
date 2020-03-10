<?php
define("PHOTO_OFFSET", 9);
function get_posts_with_photo($limit = 0){
    global $conn;
    try{
    $select = $conn->prepare("SELECT *, pu.id AS post_id FROM posts pu INNER JOIN photos p ON pu.photo_id = p.id LIMIT :limit, :offset");
    $limit = ((int) $limit) * PHOTO_OFFSET;
    $select->bindParam(":limit", $limit, PDO::PARAM_INT); 

    $offset = PHOTO_OFFSET;
    $select->bindParam(":offset", $offset, PDO::PARAM_INT);

    $select->execute(); 
    
    $photos=$select->fetchAll();
    return $photos;

}
catch(PDOException $ex){
    return null;
}
}

function get_users($post_id){
    global $conn;
    try{
        $select = $conn->prepare("SELECT username FROM users u INNER JOIN posts p ON u.id = p.user_ids WHERE p.id = ?");
        $select->execute([$post_id]);

        return $select->fetch();

    } catch(PDOException $ex){
        return null;
    }
}
function get_all_users(){
    global $conn;
    try{
        $select = $conn->prepare("SELECT * FROM users u INNER JOIN roles r ON u.role_id = r.id");
        $select->execute();

        return $select->fetch();

    } catch(PDOException $ex){
        return null;
    }
}

function get_one_post_with_photo_and_user($post_id){
    global $conn;
    try {
        $select_post = $conn->prepare("SELECT *, pu.id AS post_id FROM posts pu INNER JOIN photos p ON pu.photo_id = p.id WHERE pu.id = ?");
        $select_post->execute([$post_id]);
        
        $post = $select_post->fetch();
        $post->user = get_users($post->post_id);

        return $post;

    } catch(PDOException $ex){
        return null;
    }
}
function insert($pathcurrentPhoto, $pathnewPhoto, $pathmedPhoto){
    global $conn;
    $insert = $conn->prepare("INSERT INTO photos VALUES('', ?, ?, ?)");
    $isInserted = $insert->execute([$pathcurrentPhoto, $pathnewPhoto, $pathmedPhoto]);
    return $isInserted;
}
function updatet($pathcurrentPhoto, $pathnewPhoto, $pathmedPhoto,$pic){
    global $conn;
    $insert = $conn->prepare("UPDATE photos SET original=? , small=? , medium=? WHERE id=?");
    $isInserted = $insert->execute([$pathcurrentPhoto, $pathnewPhoto, $pathmedPhoto, $pic]);
    return $isInserted;
}


function get_num_of_photos(){
    return executeQueryOneRow("SELECT COUNT(*) AS num_of_photos FROM posts");
}

function get_pagination_count(){
    $result = get_num_of_photos();
    $num_of_photos = $result->num_of_photos;

    return ceil($num_of_photos / PHOTO_OFFSET);
}
function Query($limit = 0){
    return "SELECT *, pu.id AS post_id FROM posts pu INNER JOIN photos p ON pu.photo_id = p.id INNER JOIN users u ON pu.user_ids = u.id";
}
function menu(){
    return executeQuery("SELECT * FROM menu");
}
function get_log_pagination_count(){
    $num_of_logs = get_num_of_logs();
    return ceil($num_of_logs / PHOTO_OFFSET);
}
function get_num_of_logs(){
    $open = fopen("data/log.txt", "r");
    $logdata = file("data/log.txt");
    fclose($open);
    return count($logdata);
}

