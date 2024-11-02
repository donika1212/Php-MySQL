<?php

function maximum($x,$y){

  if($x > $y){
    return $x;
}else{
    return $y;
}

}

$a = 20;
$b = 30;
 

$test = maximum($a,$b);
echo "the maximun of $a and $b is $test". "<br>";



function fully_divisible($n)  {
     
    if ($n % 2 == 0) {
        return "$n is fully divisible by 2";
    }else
    return"$n is not fully divisible by 2 ";
  
   } 
    //print_r(fully_divisible(4)). "<br>";


$x = 5;

function localVariable(){
global $x;
$y=10;// local
echo $x ."<br>";
echo $y ."<br>";

}
localVariable();


function add1(){
    static $number=0;
$number++;
return $number;
}

echo add1();
echo "<br>";
echo add1();
echo "<br>";
echo add1();


$sport1 = "football";
$sport2 = "basketboll";
$spoet3 = "handball";
$sport4 = "volleyball";


$sports = array("football","basketball","handball","volleyball");
echo "<br>";
echo $sports[0];
echo "<br>";
echo $sports[2];
echo "<br>";
echo end($sports);
echo "<br>";
echo count($sports);
echo "<br>";

$length = count($sports);
for($i = 0; $i < $length; $i++){
    echo $sports[$i] ,"\n";
}
echo "<br>";
array_push($sports, "golf 7 gti");

var_dump($sports);
echo "<br>";

array_pop($sports);
var_dump($sports);

array_unshift($sports, "tennis");
var_dump($sports);
echo "<br>";

array_shift($sports);
var_dump($sports);
echo "<br>";

$output = array_slice($sports, 2);
var_dump($output);
echo "<br>";

$sports = ["football","basketball","handball","volleyball"];

$output = array_slice($sports ,0, 3);
var_dump($output);
echo "<br>";


$sports = ["football","basketball","handball","volleyball"];
$output = array_slice($sports ,-2, 2);
var_dump($output);
echo "<br>";


$values =  [12,24,30,55];

$sum = array_sum($values);
var_dump($sum);
echo "<br>";

$week_temperature = [22,34,40,10,49,54,33];
$average = array_sum($week_temperature)/7;
echo($average);

?>