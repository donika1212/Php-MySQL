<?php

include_once('config.php');

$sql = "INSERT INTO mytable (username, lastname) VALUES ('Ana' ,'Aliu')";
$conn->exect($sql);

?>