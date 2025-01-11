<?php

try{

    $pdo = new PDO("mysql:host=localhost;dbname=database1" , "root" , "");

    $sql = "INSERT INTO Mytable (username,lastname) VALUES ('John','Doe')";

    $pdo->exec($sql);

    echo "New row inserted crreated sucsefully";

}catch(Exeption $e) {
    echo "Error creating table:" .$e->getMessage();
}

?>