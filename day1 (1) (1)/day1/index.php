<?php

$school = "Digital school";

echo "I love $school" . "<br>";

//Simple Arithmetic's
$x = 120;
$y = 50;

echo $x + $y . "<br>";
echo $x - $y . "<br>";

echo $x / $y . "<br>";
echo $x * $y . "<br>";

echo $x % $y . "<br>";

//Concatenation

$a="Digital";
$b="School";

$c= $a.$b;

echo $c . "<br>";

// String Functions

$the_string = "Digital School";
echo strlen($the_string) . "<br>";

echo str_word_count($the_string) . "<br>";

$programming = "Programming is not cool";

echo str_replace("not","very",$programming) . "<br>";

$the_string="Progremming";
echo strrev($the_string) . "<br>";

//Conditionals
$num = -1;

if($num < 0) {
    echo "$num is less than 0" . "<br>";
}
$age=15;
if(($age > 12) && ($age < 20)){
    echo "you are a teenager" . "<br>";
};

if($age < 18){
    echo "You are under 18" . "<br>";
}else{
    echo "You are an adult" . "<br>";
}

if($num < 0){
    echo "The value of $num is a negative number" . "<br>";
}elseif($num==0){
    echo "The value of $num is 0" . "<br>";
}else {
    echo  "The value of $num is a positive number" . "<br>";
}

$x=1;
$y=2;

if($x==$y){
    echo "Yes"  . "<br>";
}else{
    echo "No";
}





?>