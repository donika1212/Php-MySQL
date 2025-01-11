<?php
try{

    $pdo = new PDO("mysql:host=localhost;dbname=db" , "root","");

    $sql = "INSERT INTO Mytable (username,lastname) VALUES ('John','Doe')";

    $pdo->exec($sql);

    echo "New row inserted created succesfully";

}catch(Exeption $e) {
    echo "Error creating table:" .$e->getMessage();
}
