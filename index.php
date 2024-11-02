<?php
//User defined functions

function maximum($x,$y){

    if ($x > $y ) {
        return $x;
    }else {
        return $y;
    }
}

$a = 20;
$b = 30;

$test = maximum($a,$b);
echo "The max of $a and $b is $test" . "<br>";


function fully_divisible($y) {

   if($y%2 ==0){
        return "$y is fully divisible by 2";
   }else
   return "$y is not fully divisible by 2";

}

print_r(fully_divisible(4)) . "<br>";

//Variable Scope
//global
//local
//static

$x=5;

function localVariable(){
    $y=10;
    //echo $x ."<br>";
    echo $y."<br>";
}

localVariable();

//static
function add1(){
    static $number=0;
    $number++;//1
    return $number;//1
}

echo add1();
echo "<br>";
echo add1();
echo "<br>";
echo add1();//3

//Arrays

$sport = "Football";
$sport = "Basketball";
$sport3 = "KickBox";
$sport4 = "MMA";


//$sports = array("Football","Basketball","KickBox","MMA");

$sports = ["Football","Basketball","KickBox","MMA"];

echo"<br>";
echo $sports [0];
echo"<br>";
echo $sports[2];
echo"<br>";
echo end($sports);// The last item 
echo count($sports);// returns the number of elements as an integer vaule
echo "<br>";

$len = count($sports);
for($i=0; $i < 4; $i++) {
    echo $sports[$i] , "\n";
}
echo "<br>";
array_push($sports,"BOX");

var_dump($sports);

array_pop($sports);
var_dump($sports);

array_unshift($sports,"F1");
var_dump($sports);
echo "<br>";
array_shift($sports);
echo"<br>";
var_dump($sports);

$output = array_slice($sports,2);
var_dump($output);
echo "<br>";

$sports = ["Football","Basketball","KickBox","MMA"];
$output = array_slice($sports,0,3);
var_dump($output);
echo"<br>";

$sports = ["Football","Basketball","KickBox","MMA"];
$output = array_slice($sports,-2,2);
var_dump($output);
echo"<br>";

//array_sum
$vaules = [12,24,30,55];

$sum = array_sum($vaules);
var_dump($sum);

$temp = [27,24,19,22,15,30,29];
$sum2 = array_sum($temp)/7;
echo($sum2);





?>