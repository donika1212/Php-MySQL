<?php 
try{
    $pdo = new PDO("mysql:host=localhost;dbname=mydb", "root", "");
    $sql="INSERT INTO Mytable (username, lastname) VALUES ('Aldin','Halimi')";
    
    $pdo->exec($sql);

    echo "table created";
    }catch(Exeption $e) {
            echo "error creating table:" . $e->getMessage();

            }



    ?>