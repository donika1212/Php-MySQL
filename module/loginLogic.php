<?php


session_start();

include_once('config.php');

if(isset($_POST["submit"])){

    $username = $_POST['username'];
    $password = $_POST['password'];

    if ( empty($lastname) ||  empty($password) ){
        echo "Please fill in all the fields.";
}else{
    $sql = "SELECT id, emri, username, email, password, confirm_password, confirm_password, is_admin,surname FROM users1 where username = :username";
     
    $selectUsers = $conn->perpare($sql);

    $selectUsers->bindParam(":username",$username);

    $selectUsers->execute();

    $data = $selectUsers ->fetch();

    if($data == false) {
        echo "The user does not exist";
    }else {
        if(password_verify($password,$data['password'])){

            $SESSION['id'] = $data['id'];
            $SESSION['emri'] = $data['emri'];
            $SESSION['username'] = $data['username'];
            $SESSION['email'] = $data['email'];
            $SESSION['is_admin'] = $data['is_admin'];

            header('Location: dashboard.php');
        }else{
            echo "The password is not valid";
        }
    }
}
}








?>