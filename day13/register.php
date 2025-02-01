<?php


include_once('config.php');

if(isset($_POST['submit']))
{
    $name= $_POST['name'];
    $surname = $_POST['surname'];
    $username = $_POST['username'];
    $tempPass = $_POST['password'];
    $email = $_POST['email'];

if(empty($name)) || (empty($surname)) || (empty($username)) ||  (empty($email)) ||  (empty($password)) ||
{
    echo "You need to fill all fileds";
}


else{

    $sql = "SELECT username FROM user1 WERE username=:username";

    $tempSql = $conn->prepare($sql);

    $tempSql = bindParam(':username',$username);
     
    $tempSql->execute();

    if(($tempsql=>rowCount() > 0)){
        echo "Username exist!";
        header("refresh:2; url=signup.com");
    }
    else{
        $sql = "INSERT INTO user1 (name,surname,username,email,password) VALUES (:name, :surname, :username, :email, :password)";

        $insertSql = $conn ->prepare ($Sql);



        $insertSql->bindParam(':username', $username);
        $insertSql->bindParam(':name', $name);
        $insertSql->bindParam(':surname', $surname);
        $insertSql->bindParam(':password', $password);
        $insertSql->bindParam(':email', $email);


        $insertSql->execute();

        echo"Data saved successfully";
        header("refresh:2; url=login.php")



    }


}



}