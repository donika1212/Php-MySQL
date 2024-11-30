<?php
$my_file = fopen ("file1.txt","w");
 
fclose($my_file);

//fread
$filename = "ds.txt";
$file = fopen ($filename,"r");
$filesize = filesize($filename);
$my_filedata = fread ($file,$filesize);

echo $my_filedata . "<br>";
fclose($file);

$file1=fopen ("example.txt", "r");
while (!feof($file1)) {
    echo fgets($file1) . "<br>";
}

$my_file =fopen ("file1.txt", "w");

$text = "computer programming";
fwrite($my_file, $text);

$my_file = fopen ("data.txt" , "w+");
fwrite($my_file, "Data test 1");

$myfile = fopen ("data.txt", "a+");
fwrite  ($my_file , "dgdggddddd");
?>