<?php

//funksion fopen
$my_file = fopen("file1.txt","w");

//fclose
fclose($my_file);

//fread 

$filename = "ds.txt";
$file = fopen($filename, "r");
$filesize = filesize($filename);

$my_filedata = fread ($file,$filesize);
echo $my_filedata . "<br>";

fclose($file);

//feof-end of line

$file1= fopen("example.txt","r");

while(!feof($file1)){
    echo fgets($file1). "<br>";
}

//fwrite
$my_file = fopen("file1.txt","w");

$text = "computer programming";

fwrite($my_file,$text);

//w+ (read and write mode)
$my_file = fopen("data.txt", "w+");

fwrite($my_file, "Date test 1 ");

//a+

$my_file = fopen("data.txt", "a+");

fwrite($my_file , "Blend Osmani");









?>