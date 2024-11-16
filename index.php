<?php

$name = 'Amar';

$Lastname = 'Simnica';

echo"Hello $name $Lastname!" ."<br>";

$pi = 3.14;
$r = 3;

$S = $pi*pow($r,2);


echo "Siperfaqja e rrethit: $S " . "<br>";


$mosha = 15;

if($mosha >= 18){
    echo "Keni te drejte te votoni";
} else {
    echo"Nuk keni te drejte te votoni"."<br>";
}



$day = 3;

switch($day) {
    case 1:
        

    case 2:
            
    case 3:
                
    case 4:   
        
    case 5:
      echo"Dite jave";
          break;
        case 6: 
      echo"Dite vikendi";
        break;
        case 7:
      echo"Dite vikendi";
        break;

       default:
      echo"Invalid ";
}





function shuma($array){
    return array_sum($array);
} 
$array = [1,2,3,4,5,6];

echo "Shuma e elementeve ne array eshte:" .shuma($array);




?>