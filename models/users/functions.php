<?php

function getAll(){
    return executeQuery("SELECT * FROM userphoto");
}

function getOne($id){
    global $conn;
    $result = $conn->prepare("SELECT * FROM userphoto WHERE id = ?");
    $result->execute([$id]);
    return $result->fetch();
}

function insertt($pathcurrentPhoto, $pathnewPhoto){
    global $conn;
    $insert = $conn->prepare("INSERT INTO userphoto VALUES('', ?, ?)");
    $isInserted = $insert->execute([$pathcurrentPhoto, $pathnewPhoto]);
    return $isInserted;
}
function getUsers(){
    return executeQuery("SELECT * FROM users");
}
function getOneUser($id){
    global $conn;
    $result = $conn->prepare("SELECT * FROM users u INNER JOIN userphoto up ON u.pic_id=up.id WHERE u.id = ?");
    $result->execute([$id]);
    return $result->fetch();
}
function updatett($pathcurrentPhoto, $pathnewPhoto,$picid){
    global $conn;
    $insert = $conn->prepare("UPDATE userphoto SET original=?, small=? WHERE id=?");
    $isInserted = $insert->execute([$pathcurrentPhoto, $pathnewPhoto,$picid]);
    return $isInserted;
}