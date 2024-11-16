<?php

$x = "aldin";
$y = "halimi";

echo "Hello $x $y!" , "<br>";





$pi= 3.14;
$r= 2.17;

pow($r,2);
$s = $pi*pow($r,2);

echo "siperfaqja  eshte $s" . "<br>";

$age= 15;

if($age > 18){
    echo "you can vote";
} else{
    echo "you cant vote";
};

$day = "Monday";

switch ($day){
    case "Monday":
    case "tuesday":
    case "wendsday":
    case "thursday":
    case "friday":
    echo "its week day" . "<br>";
    break;
    case "saturday":
    case "sunday":

    echo "its a weekend day";
    break;
    default:
    echo "invalid day";
};

function shuma($numbers){
    return array_sum($numbers);
    
}

$numbers = array(1,2,3,4);

echo "shuma e antarv:" . shuma ($numbers);


?>