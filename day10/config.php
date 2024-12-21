<?php

$user ="root";
$pass="";
$host="localhost";
$dbname="db";

try{
    $conn=new PDO("mysql:host=$host;dbname=$dbname",$user,$pass);



}catch (Exception $e) {
    echo "Error:" .$e->getMessage();

}
?>