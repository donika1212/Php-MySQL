<?php


session_start();

if(isset($_POST["submit"])){

  $username = $_POST['username'];
  $password = $_POST['password'];

if(empty($username) || empty($password))
{
    echo "you have not filled all the fields.";

}else{


  $sql = "SELECT id , name, username, email, password,confirm_password, is_admin,surname FROM users where username = :username";

  $selectUsers = $conn->prepare($sql);

  $selectUsers->bindparam(":username",$username);

  $selectUsers->execute();

  $data = $selectUsers->fetch();

  if($data == false) {
    echo "The user does not exist";
  } else {

    if(password_verify($password,$data['password'])){

        $_SESSION['id'] = $data['id'];
        $_SESSION['name'] = $data['name'];
        $_SESSION['username'] = $data['username'];
        $_SESSION['email'] = $data['email'];
        $_SESSION['is_admin'] = $data['id_admin'];

        header('Location: dashboard.php');
    }else{
        echo "thepassword is not valid";
    }
  }
}



}









?>