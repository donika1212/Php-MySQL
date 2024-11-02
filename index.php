<?php

$school = "Digital school";
echo "I love $school"  . "<hr>";

$x = 120;
$y = 50;

echo $x + $y . "<br>";
echo $x - $y  . "<br>";

echo $x / $y  .  "<br>";
echo $x * $y  .  "<br>";

echo $x % $y . "<br>";


$a="Digital";
$b="School";

$c = $a.$b;

echo $c ."<br>";

$the_string = "Digital School";

echo strlen($the_string) . "<br>";

echo str_word_count($the_string) . "<br>";

$programming = "Programing is not cool";
echo str_replace("not","very",$programming) . "<br>";

$the_string = "Programming";
echo strrev($the_string) . "<br>";

//
$num = -1;

if($num < 0){
    echo"Nun is less than 0" . "<br>";
}


$age = 15;
if(($age > 12) &&($age < 20)){
    echo "You are a teenager" . "<br>";
}

if($age < 18){
    echo "You are under 18" . "<br>";
} else{
    echo "You are an adult";
}

if($num < 0){
    echo"The value of $num is a negative number" . "<br>";
}
else if($num ==0){
    echo"The value of $num is 0";
} else{
        echo"The value of $num is a positive number";
}

 $x = 20;
 $y = 14;

 if($x == $y){
    echo"Yes";
 } else{
    echo"No";
 }


?>