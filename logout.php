<?php

session_start();

include_once("config.php");

sesswion_destroy();

header('Location: login.php');

?>