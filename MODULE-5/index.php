<?php

$x = "Blend";
$y = "Osmani";

echo "Hello $x $y!" . "<br>";

$pi = 3.14;
$r = 50;
$s = $pi*pow ($r,2);
echo "Siperfaqja eshte $s" . "<br>";

$age = 15;
if($age > 18){
    echo "Ju keni drajt me votu";
}else{
    echo "Ju nuk keni drejt me votu";
};

$day = 4;

switch($day){
    case "Monday":
    case "Tuesday":
    case "Wensday":
    case "Thursday":
    case "Friday":
    echo "Its week day" . "<br>";
    break;   
    case "Saterday":
    case "Sunday":    
    echo "Its Weekend day";
    default:
    echo "its invalid Day " . "<br>";
    }


function shuma($numbers){
        return array_sum($numbers);
    }


$num= array(1,2,3,4);
echo "shuma e antarv:" . shuma($num);
?>