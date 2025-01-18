<?php

include_once("config.php");

$id = $_GET['id'];

$sql = "DELETE FROM mytable WERE id = :id";

$getUsers