<?php
//user defined functions

// function maximum($x,$y){

//     if($x > $y) {
//         return $x;
        
//     }else {
//         return $y;
//     }

// }

// $a=20;
// $b=30;

// $test = maximum($a,$b);
// echo "the max of $a and $b is $test" . "<br>"; -->

function fully_divisible($n){

  if($n % 2 ==0 ) {
    return "$n is fully divisivble by 2" ;    
   } else {
   return "$n is not fully divisivble by 2";


}}

print_r(fully_divisible(10));

//variable scope


$x=5;

function localVariable() {
    global $x;
    $y=10;
     echo $x . "<br>";
    echo $y . "<br>";


}

localVariable();

//static

function add1(){
    static $number=0;
    $number++;//1
    return $number;//1

}

echo add1();//1
echo "<br>";
echo add1();//2
echo "<br>";
echo add1();//3

//arrays

$sport1 = "football";
$sport2 = "basketball";
$sport3 = "voleyball";
$sport4 = "cricket";

//$sports = array("football","basketball","voleyball","cricket");

$sports = ["football","basketball","voleyball","cricket"];

echo "<br>";
echo $sports[0];
echo "<br>";
echo $sports[2];
echo "<br>";
echo end($sports);//the last item
echo "<br>";
echo count($sports); //return the number of elements as an integer value
echo "<br>";

$len = count($sports);
for($i=0; $i < 4; $i++) {
    echo $sports[$i] , "\n";
}

array_push($sports, "Golf");//add  an item at the end of an array

var_dump($sports);
array_pop($sports);//removes an item at the end of an array

array_unshift($sports, "Tennis"); //add an item to the  beggining of an array

array_shift($sports);
var_dump($sports);
echo "<br";

$output = array_slice($sports, 2);
var_dump($output);
echo "<br>";

$sports = ["football","basketball","voleyball","cricket"];

$output = array_slice($sports,0, 3);
var_dump($output);
echo"<br>";

$sports = ["football","basketball","voleyball","cricket"];

$output = array_slice($sports,-2, 1);
var_dump($output);
echo"<br>";


//array_sum

$values =[12,24,30,55];

$sum = array_sum($values);
var_dump($sum);

$week =[32,24,37,40,28,36,34];

$avreage = array_sum($week)/7;

echo($avreage);




?>