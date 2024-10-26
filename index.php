<?php

//Switch

$age=16;

switch($age) {
    case ($age >=0 && $age <18):
    echo "you are a minor (0-18 years old)";
    break;
    
    
    case ($age >=18 && $age <25):
        echo "you are a young adult" . "<br>";
        break;


        
    case ($age > 25):
        echo "you are a young adult" . "<br>";
        break;
        
     default:
     echo "invalid age" . "<br>";   
        

}


$day = "tuesday";

switch($day) {
    case "monday":
        echo "It s Monday" . "<br>";
    break;
    case "Tuesday":
         echo "It s Tuesday" . "<br>";
    break;
         case "monday":
            echo "It s Monday" . "<br>";           
}



//loops 

$x = 1;

while ($x <= 5){
    echo "The number is: $x" . "<br>";

    $x++;
}

$y =1;

do{
    echo "the number is : $y." . "<br>";
    $y++;   
}while($y <=6);

for ($x=0; $x < 10; $x++) {
    echo "Shkolla digjitale" . "<br>";
}

$cars = array ("BMW","VW","MERCEDES","KTM");

foreach($cars as $value) {
    echo "$value" . "<br>";
}

$age = array("John sins" => "18" ,"Nystret" => "23", "Shtrafciger" => "10");

foreach($age as $key => $value) {
    echo "$key = $value" . "<br>";
}

//built-in functions

phpinfo();
$y= "KUJT AMA BATARIN";
print_r($y);

$x=2;
echo gettype($x) . "<br>";

$x=2.3;
echo gettype($x) . "<br>";

$x="SHkolla";
echo gettype($x) . "<br>";

function displayPhpVersion (){
    echo "this is PHP:" . Phpversion() . "<br>";

}

displayPhpVersion();
//User defined functions




