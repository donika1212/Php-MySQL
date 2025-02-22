<?php

session_start();

include_once('config.php');

if(isset($_POST["submit"])){

$username = $_POST["username"];
$password = $_POST["password"];


if(empty($username)|| empty($password)){

echo "please fill all the fields";


}else{

$sql = "SELECT id , emri,username,email,password,confirm_password,is_admin,surname FROM user where username = :username";

$selectUsers = $conn->prepare($sql);

$selectUsers->bindParam(":username",$username);

$selectUsers->execute();

$data = $selectUsers ->fetch();

if(data == false){
echo " the user does not exist";
}else{
    if (password_verify($password,$data['password'])){

$session['id']=$data['id'];
$session['emri']=$data['emri'];
$session['username']=$data['username'];
$session['email']=$data['email'];
$session['is_admin']=$data['is_admi'];

header('location: dashboard.php');
    }else{

        echo"the password is not valid";
    }
    
}

}


}























?>