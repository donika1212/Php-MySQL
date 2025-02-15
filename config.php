<?php

$user= "root";
$pass= "";
$server= "localhost";
$dbname= "mms2";


try {

$conn = new PDO("mysql:host=$server; dbname=$dbname" ,$user , $pass);


}catch(PDOExeption $e){

echo "error:" . $e->getMessage();

}


?>