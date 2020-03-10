<?php

require_once "../../config/connection.php";
include "functions.php";

$users = get_all_users();

$excel = new COM("Excel.Application");

$excel->Visible = 1;

$workbook = $excel->Workbooks->Add();

$sheet = $workbook->Worksheets('Sheet1');
$sheet->activate;

$br = 1;
foreach($users as $user){
    $polje = $sheet->Range("A{$br}");
    $polje->activate;
    $polje->value = $user->uname;

    $polje = $sheet->Range("B{$br}");
    $polje->activate;
    $polje->value = $user->username;

    $polje = $sheet->Range("C{$br}");
    $polje->activate;
    $polje->value = $user->email;

    $polje = $sheet->Range("D{$br}");
    $polje->activate;
    $polje->value = $user->role;

    $br++;
}

$polje = $sheet->Range("E{$br}");
$polje->activate;
$polje->value = count($users);

$workbook->_SaveAs("Users.xlsx" -4143);
$workbook->Save();
header("Location: ../../index.php?page=author");