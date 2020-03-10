<?php

define("ABSOLUTE_PATH", $_SERVER["DOCUMENT_ROOT"]."/php1sajt");


define("ENV_FAJL", ABSOLUTE_PATH."/config/.env");
define("LOG_FAJL", ABSOLUTE_PATH."/data/log.txt");
define("VOTE_FAJL", ABSOLUTE_PATH."/data/notes.txt");
define("SEPARATOR", "\t");

define("SERVER", env("SERVER"));
define("DATABASE", env("DBNAME"));
define("USERNAME", env("USERNAME"));
define("PASSWORD", env("PASSWORD"));

function env($name){
    $file = file(ENV_FAJL);
    $result = "";
    foreach($file as $key=>$value){
        $config = explode("=", $value);
        if($config[0]==$name){
            $result = trim($config[1]);
        }
    }
    return $result;
}
