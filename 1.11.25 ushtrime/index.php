<?php

try{

    $pdo = new PDO("mysql:host=localhost;dbname=database1" , "root" , "");

    $sql = "CREATE TABLE Mytable (id INT(6) NOT NULL AUTO_INCREMENT PRIMARY KEY ,
    username VARCHAR(30) NOT NULL,
    lastname VARCHAR(30) NOT NULL)";

    $pdo->exec($sql);

    echo "table created succsefully";

}catch(Exeption $e) {
    echo "Error creating table:" .$e->getMessage();
}

?>