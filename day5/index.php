<?php

$name = "Artiol Thaqi";

echo "Hello $name" . "<br>";

$a = "Artiol";
$b = "Thaqi";
echo "Hello $a $b";



$bpi = "3.14";
$r = "201";
$siperfaqja = $bpi * $r;
echo "Siperfaqja rrethit eshte $siperfaqja";



$age=19;
if(($age >= 18)){ 
echo "Ti ke drejt per te votuar" ."<br>"; 
}

$day = "7";

switch($day){

    case "1": 
        case "2":
            case "3":
                case "4":
                    case "5":
                        echo "It's weekday" . "<br>";
                        break;
                        case "6";
                        case "7";
                        echo "Its weekend";

                            }



function shuma($numbers){
    return array_sum($numbers);
}

$numbers = array_sum (1,2,3);
echo "Shuma:" .shuma($numbers);


?>