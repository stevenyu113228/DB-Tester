<?php

// phpinfo();
require_once "./vendor/autoload.php";

$client = new MongoDB\Client(
    'mongodb://root:root@mongodb'
);
$db = $client->meowdb; 
if(isset($_GET["user"]) && isset($_GET["user"])){
    echo "user : ";
    var_dump($_GET["user"]);

    echo "pass : ";
    var_dump($_GET["pass"]);

    $cursor = $db->user->find(array("name" => $_GET["user"], "password" => $_GET["pass"]));
    foreach ($cursor as $c){
        die("Login Success");
    }
    die("Login Error");
}else{
    echo "No param";
}