<?php

$school ="Digital school";

echo "I love $school" . "<br>";

//simple arithemtic's
$x = 120;
$y=50;

echo $x + $y . "<br>";
echo $x - $y . "<br>";

echo $x / $y . "<br>";
echo $x * $y .  "<br>";


ECHO $x % $y . "<br>" ;


//concatenation

$a="Digital";
$b= "School";

$c= $a.$b;

echo $c . "<br>" ;

//String functions

$the_string= "Digital School";

echo strlen($the_string) . "<br>";

$programing = "Programing is not cool";
echo str_replace("not", "very",$programing) . "<br>";

$the_string="Programming";
echo strrev($the_string) ."<br>";

//Conditonals
$num = -1;

if($num < 0 ) {
    echo "$num is less than 0" . "<br>";
}
$age=18;
if(($age >12) && ($age <20)){
    echo "You are a teenager" . "<br>";
}

if($age < 18){
    echo"you are under 18";
}else {
    echo "you are an adult" . "<br>";
}

if($num <0){
    echo "the value of $num is a negative number" . "<br>";
}elseif($num==0){
    echo "the vale of $num is 0" . "<br>";
}else {
    echo "the value of $num is a postivie number" . "<br>";
}

$num1 = 1;
$num2 = 2;

if($num1 == $num2){
    echo"PO MORE";
}else{
    echo"JA MO QFART";
}

?>