<?php
//User defined functions

function maximum ($x,$y){
    if($x > $y){
        return $x;
    }else{
        return $y;
    }
}

$a =20;
$b = 30;

$test = maximum($a,$b);
echo "The max of $a and $b is $test" ."<br>";

function fully_divisible($n){
    if($n % 2 == 0){
        return "$n  is fully divisible by 2" ."<br>";

    }else{
        return "$n is not fully divisible by 2" ."<br>";
    }
}
    print_r(fully_divisible(4)) . "<br>";


$x = 5;

function localVariable(){
    global $x;
    $y = 10;
    echo $x . "<br>";
    echo $y ."<br>";
}
localVariable();



function add1(){
    static $number =0;
    $number++;
    return $number;
}

echo add1();
echo "<br>";
echo add1();
echo "<br>";
echo add1();

//Arrays

$sport1 ="Football";
$sport2 ="Basketball";
$sport3 = "Handball";
$sport4 = "Voleyball";

//$sports = array("Football","Basketball","Handball","Voleyball");
$sports = ["Football","Baketball","Handball","Voleyball"];

echo "<br>";
echo $sports[0];
echo "<br>";
echo $sports[2];
echo "<br>";
echo end($sports) ;
echo "<br>";
echo count($sports) ."<br>";//return the number of elements as an integer

$len = count($sports);
for ($i =0;$i < 4;$i++){
    echo $sports[$i] ."\n";
}

array_push($sports,"Golf"); //add an item at the end of an array

var_dump($sports);
echo "<br>";

array_pop($sports);// removes an item at the end of an array
var_dump($sports);
echo "<br>";

array_unshift($sports,"Tennis"); //add an item to the beginning of the array
var_dump($sports);
echo "<br>";

array_shift($sports); //removes the first item
var_dump($sports);
echo "<br>";

$output = array_slice($sports,2);
var_dump($output);
echo "<br>";


$sports = ["Football","Baketball","Handball","Voleyball"];

$output = array_slice($sports,0,3);
var_dump($output);
echo "<br>";

$sports = ["Football","Baketball","Handball","Voleyball"];

$output = array_slice($sports,-2,1);
var_dump($output);
echo "<br>";

//array_sum
$values = [12,24,30,55];

$sum = array_sum($values);
var_dump($sum);


$weekly_temperature = [23,13,15,10,6,18,20];

$average =array_sum($weekly_temperature)/7;
echo ($average);




?>