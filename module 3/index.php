<?php

//Switch

$age=15;

switch ($age) {

    case ($age >=0 && $age <18):
    echo "You are a minor (0-18 years old)" ."<br>";
    break;
    case ($age >=18 && $age<25):
    echo "You are a young adult" . "<br>";
    break;
    case ($age > 25):
    echo "You are an adult" . "<br>";
    break;
    default:
    echo "Invalid Age" . "<br>";
    break;

}

$day= "Tuesday";

switch($day){
    case "Monday":
        echo "Its Monday" . "<br>";
        break;

    case "Tuesday":
        echo "Its Tuesday" . "<br>";
        break;            
       
     case "Wendseday":
        echo "Its Wendseday" . "<br>";
        break;
    
    case "Thursday":
        echo "Its Thursday" . "<br>";
        break;

    case "Saterday":
        echo "Its Saterday" . "<br>";
        break;

    case "Sunday":
        echo "Its Sunday" . "<br>";
        break;
    }
    
    
//Loops (Unazat)

$x =1;

while($x <= 5){
    echo "The number is :$x" . "<br>";

    $x++;
}


$y=1;

do {
    echo "The number is : $y." ."<br>";
    $y++;
}while ($y <=6);

for($x=0; $x < 10; $x++){
    echo "Shkolla Digitale"."<br>";
}

$cars = array ("BMW","VW","Audi","LADA");

foreach($cars as $value)
 {
    echo "$value"."<br>";
 }

 $age = array("Filan" => "18", "Nystret" => "23", "Shaban" => "10",);

 foreach($age as $key => $value) {
    echo "$key = $value" . "<br>";
 }

//Build-in Functions

phpinfo();

$y="Qa Boneee". "<br>";

print_r($y);

$x=2;
echo gettype($x) . "<br>";

$x="Shkolla";
echo gettype($x) . "<br>";


function displayPhpVersion (){
    echo"This is PHP " . phpversion() . "<br>";
}

displayPhpVersion();






?>