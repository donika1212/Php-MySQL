<?php

//user defined functions

function maximum($x,$y){

    if ($x > $y) {
        return $x;
    }else {
        return $y;
    }

}

$a=20;
$b=30;

$test = maximum($a,$b);
echo "The max of $a and $b is $test" ."<br>";

function fully_divisible($n){
    if($n % 2 ==0) {
        return "$n is fully divisible by 2";
    }else
    return "$n is not fully divisible by 2"; 
    
}

//print_r(fully_divisible(4)) ."<br>";


//Variable Scope
//global
//local
//static

$x=5; //global

function localVariable(){
    global $x;
    $y=10; //local
    echo $x ."<br>";
    echo $y ."<br>";
}

localVariable();

//static

function add1(){
    static $number=0;
    $number++; //1
    return $number; //1

}

echo add1(); //1
echo "<br>";
echo add1(); //2
echo "<br>";
echo add1(); //3

//arrays

$sport1="Football";
$sport2="Basketball";
$sport="Volleyball";
$sport4="Handball";

//$sport = array("Football","Basketball","Volleyball","Handball");

$sports = ["Football","Basketball","Volleyball","Handball"];

echo"<br>";
echo $sports[0];
echo"<br>";
echo $sports[2];
echo"<br>";
echo end($sports);// the last item
echo"<br>";
echo count($sports); //retunrs the number of elements as an integer number
echo"<br>";


$len = count($sports);
for ($i=0; $i < $len; $i++) {
    echo $sports[$i] , "\n";
}
echo "<br>";
array_push($sports,"Golf");

var_dump($sports);
echo "<br>";

array_pop($sports); //removes an item at the end of an array
var_dump($sports);
echo "<br>";

array_unshift($sports, "Tennis");//adds an item at the begginign of an array
var_dump($sports);
echo "<br>";

array_shift($sports);//removs the first item
var_dump($sports);
echo "<br>";

$output = array_slice($sports, 2);
var_dump($output);
echo "<br>";

$sports = ["Football","Basketball","Volleyball","Handball"];

$output = array_slice($sports, 0, 3);
var_dump($output);
echo "<br>";

$sports = ["Football","Basketball","Volleyball","Handball"];
$output = array_slice($sports, -2, 2);
var_dump($output);
echo "<br>";

//array_sum

$values = [12,24,30,55];

$sum = array_sum($values);
var_dump($sum);
echo "<br>";    

$temperatures = [19,19,20,21,19,22,23];

$avarage = array_sum($temperatures)/7;

echo($avarage);



?>