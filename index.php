<?php


$x = "florjon";
$y = "BABLOKI";

echo "hello $x $y!". "<br>" ;

$pi = 3.14;
$r  = 50;
$s =  $pi * pow($r,2) ;
echo "Siperfaqja eshte $s";

$age = 15;
if($age > 18){
    echo "JU KENI DREJT MOSTANIN";
}else{
    echo " JU SKENI DREJT VALLA ME VOTU";
};



$day4;


switch($day){
    case "Monday":
    case "Wensday":
    case "Thursday":
    case "Friday":
    echo "Its Week day";
    break;
    case "Saturday":
    case "Sunday":
      echo "Its Weekend Day";  

}



function shuma($numbers){
    return array_sum($numbrs);

}


$number = array (1,2,3,4);
echo "Shuma e antarve". shuma ($sum);





?>