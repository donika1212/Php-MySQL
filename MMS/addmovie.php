<?php


include_once('config.php');

if(isset($_POST['submit']))
{
    $movie_name = $_POST['moive_name'];
    $movie_name = $_POST['moive_desc'];
    $movie_name = $_POST['moive_quality'];
    $movie_name = $_POST['moive_rating'];
    $movie_name = $_POST['moive_image'];



    $sql= "INSERT INTO movies (movie_name,movie_quality,movie_rating, movie_image) VALUES (:movies_name, :movie_desc, :movie_quality, :movie_rating, :movie_image)";
    
    $insertMovie = $conn->prepare($sql)



    $insertMovie->bindParam(':movie_name', $movie_name);
    $insertMovie->bindParam(':movie_desc', $movie_desc);
    $insertMovie->bindParam(':movie_quality', $movie_quality);
    $insertMovie->bindParam(':movie_rating', $movie_rating);
    $insertMovie->bindParam(':movie_image', $movie_image);

    $insertMovie->execute();

    header("Location: movies.php");


  }




?>