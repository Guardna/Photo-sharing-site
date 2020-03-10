<?php
include "../../config/connection.php";
require_once "../../models/users/functions.php";

$photo = getOneUser(1);

$word_app = new COM("Word.Application");
$word_app->Visible = true;

$word_app->Documents->Add();
var_dump($word_app->Selection);
$word_app->Selection->TypeText("$photo->uname \n $photo->username \n $photo->email");
$wordApp->Documents[1]->SaveAs("AboutAuthor.doc");

header("Location: ../../index.php?page=author");

