<?php

session_start();

include_once('config.php');

if(isset($_POST["sumbit"])){
    $username - $_POST["usernmame"];
    $password - $_POST["password"];


if(empty($emri) || empty($username) )
    {
    echo "
    please fill in all the fields.";

    }else {

        $sql = "SELECT id , emri,username,password,confirm_password,is_admin,surname FROM useres where username =:username";

        $selectUsers = $conn-prepare($sql);

        $selectUsers->bindParam(":username",$username);

        $selectUasers->execute();

        $data =  $selectUsers ->fetch();

        id($data == false){
            echo "user does not exist";
        }else{

            if(password_veridy($password,$data['password'])){
                $_Session['id'] = $data['id'];
                $_Session['emri'] = $data['emri'];
                $_Session['username'] = $data['username'];
                $_Session['email'] = $data['email'];
                $_Session['is_admin'] = $data['is_admin'];

                header('Location: dashboard.php');
                 }else{
                    echo "teh passwrod is invalid";

            }
        }
    }

    }


?>