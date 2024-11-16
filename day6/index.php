<?php
$a = "Ajan";
$b = "Syla";

echo"Hello $a $b !". "<br>";

$pi = 3.14;
$r = 4;

echo $pi * pow($r,2) . "<br>";

$age = 19;

if($age>=18){
    echo "You can vote". "<br>";
}else{
    echo "You can't vote". "<br>";
}

$day=2;

switch($day) {
    case 1:  
    case 2:
    case 3:
    case 4:
    case 5:
        echo"It's weekday" . "<br>";
             break;
    case 6:
    case 7:
         echo"It's weekend" . "<br>";
             break;
     default:
         echo"invalid day" . "<br>";
             break;                                                     
}

function sum($nr) {
    return array_sum($nr);
}

$nr = array (3,12,35);
echo "sum:".sum($nr);

?>