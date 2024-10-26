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

echo $x % $y . "<br>" ;

//Concatenation

$a="Digital";
$b= "School";
$c= $a.$b;

echo $c . "<br>";

//String functions 

$the_string = "Digital School";
echo strlen($the_string) . "<br>";

echo str_word_count($the_string) . "<br>";

$prgramming = "Programming is not cool";
echo str_replace("not", "very", $prgramming) . "<br>";

$the_string="Programming";
echo strrev($the_string) . "<br>";

//Conditonals
$num = -1;

if($num < 0){
    echo "$num is less than 0" ."<br>";
}

$age=15;
if(($age > 12) && ($age < 20)){
    echo "You are a teenager" . "<br>";
}

if($age < 18){
    echo "You are under 18" . "<br>";
}else{
    echo "You are an adult" . "<br>";
}

if($num <0){
    echo "The value of $num is a negative number" . "<br>";
}elseif($num==0){
    echo "The value of $num is 0" . "<br>";
}else{
    echo "The vaule of $num is a positive number" . "<br>";
}

$num1=1;
$num2=2;

if($num1 == $num2){
    echo "yes";
}else {
    echo "no";
}





?>