
<?php


    include_once('config.php');


    if(isset($_POST['submit']))
    {

        $username = $_POST['username'];
        $name = $_POST['name'];
        $surname = $_POST['surname'];
        $tempPass = $_POST['password'];
        $email = $_POST['email'];
        $password = password_hash($tempPass, PASSWORD_DEFAULT);

        if(empty($name) || empty($surname) || empty($username) || empty($password) || empty($email) || empty($surname))
        {
            echo "You need to fill all the fields";
        }
        else{

            $sql = "SELECT username FROM users WHERE username=:username";

            $tempSql = $conn->prepare($sql);


            $tempSql->bindParam(':username', $username);

            $tempSql->execute();

            if(($tempSql->rowCount() > 0)) {
                echo "Username exist!";
                header("refresh:2; url=sighnup.com");
            }
            else {
                $sql = "INSERT INTO users(name,surname,username,password,email) VALUES (:name, :surname, :username, :password, :email)";


            $insertSql = $conn->prepare($sql);


            $insertSql->bindParam(':name', $name);
            $insertSql->bindParam(':surname', $surname);
            $insertSql->bindParam(':username', $username);
            $insertSql->bindParam(':password', $password);
            $insertSql->bindParam(':email', $email);

            $insertSql->execute();

            echo "Data saved successfully";
            header("refresh:2; url=login.php");
            }

        }
        }

?>
