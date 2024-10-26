<?php

//Switch

$age=15;

switch($age) {

    case ($age >=0 && $age <18):
    echo "you are a minor (0-18 years old)" . "<br>";
    break;
    case ($age >=18 && $age <=25):
        echo "you are a young adult" . "<br>";
        break;
    case($age > 25):
        echo "you are an adult" . "<br>";
        break;
        default:
        echo "invalid age" . "<br>";
        break;



}

$day = "tuesday";

switch($day) {

    case "monday";
    echo "its monday" . "<br>";
    break;

    case "tuesday";
    echo "its tuesday" . "<br>";
    break;


    case "wednesday";
    echo "its wednesday" . "<br>";
    break;


    case "thursday";
    echo "its thursday" . "<br>";
    break;


    case "friday";
    echo "its friday" . "<br>";
    break;

    case "saterday";
    echo "its saterday" . "<br>";
    break;

    case "sunday";
    echo "its sunday" . "<br>";
    break;

    default:
    echo "invalid day" . "<br>";
    break;


    //loops (unazat)


}

$x =1;

while( $x <= 5) {
    echo "the number is : $x" . "<br>";
    
    $x++;

}

$y = 1;

do{
    echo "the number is : $y." . "<br>";
    $y++;
}while( $y <=6);


for ($x=0; $x < 10; $x++) {
    echo "shkolla digjitale" . "<br>";
}

$cars = array ("BMW","VW","AUDI","TESLA");

foreach($cars as $value) {
    echo "$value" . "<br>";
}

$age = array("john" => "18","michael" => "23","joe" => "10");

foreach($age as $key => $value) {
    echo "$key = $value" . "<br>";
}

//built in-functions

phpinfo();

$y="hello" . "<br>";

print_r($y);

$x=2;
echo gettype($x) . "<br>";

$x=2.3;
echo gettype($x) . "<br>";

$x="shkolla";
echo gettype($x) . "<br>";

function displayphpversion (){
    echo "this is php:" . phpversion() . "<br>";
}

displayphpversion();

//user defined functions




?>