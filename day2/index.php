<?php

//Switch

$age=15;

switch($age) {

    case ($age >=0 && $age <18):
        echo "You're a minor (0-18 years old)" . "<br>";
        break;
    case ($age >=18 && $age <=25):
        echo "You're a young adult" . "<br>";
        break;
    case ($age > 25):
        echo "You're an adult" . "<br>";
        break;
        default:
        echo "Invalid age" . "<br>";
        break;

}

$day = "Tuesday";

switch($day) {

    case "Monday":
        echo "It's Monday!" . "<br>";
        break;

    case "Tuesday":
        echo "It's Tuesday!" . "<br>";
        break;
        
    case "Wednesday":
        echo "It's Wednesday!" . "<br>";
        break;

    case "Thurday":
        echo "It's Thursaday!" . "<br>";
        break;

    case "Friday":
        echo "It's Friday!" . "<br>";
        break;

    case "Saturday":
        echo "It's Saturday!" . "<br>";
        break;

    case "Sunday":
        echo "It's Sunday!" . "<br>";
        break;

    default:
        echo "Invalid day"  . "<br>";
        break;
                          
}

//loops 

$x = 1;

while( $x <= 5) {
    echo "the number is : $x" . "<br>";
    $x++;

}

$y = 1;

do {
    echo "The number is : $y." . "<br>";
    $y++;
}while($y<=6);

for ($x=0; $x < 10; $x++) {
    echo "Shkolla digitale" . "<br>";
}

$cars = array("BMW","Audi","VW","Mercedes");

foreach($cars as $value) {

    echo "$value" . "<br>";
}

$age = array("Jhon" => "18", "Michael" => "23", "Joe" => "10");

foreach($age as $key => $value) {
    echo "$key = $value" . "<br>";
}

//built in functions

phpinfo();

$y="hello" . "<br>";

print_r($y) . "<br>";

$x=2;
echo gettype($x) . "<br>";

$x=2.3;
echo gettype($x) . "<br>";

$x="Shkolla";
echo gettype($x) . "<br>";

function displayPhpVersion (){
    echo "this is PHP" . phpversion() . "<br>";
}

displayPhpVersion() . "<br>";


?>