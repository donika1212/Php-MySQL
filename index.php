<?php

$age = 28;
switch($age){
    case($age >=8 && $age <18);
    echo"You are a minor(8-18 years old)" ."<br>";
    break;
    case($age >= 18 && $age <=25);
    echo"You are a young adult" . "<br>";
    break;

    case($age > 25);
    echo"You are an adult" ."<br>";
    break;
    default;
    echo"Invalid age" ."<br>";
    break;
}

$day = "Tuesday";
switch($day) {
    case "Monday":
        echo"Its Monday!" ."<br>";
        break;

        case"Tuesday";
        echo"It's Tuesday" . "<br>";
        break;

        case"Wednesday";
        echo"It's Wednesday" . "<br>";
        break;

        case"Thursday";
        echo"It's Thursday" . "<br>";
        break;

        case"Friday";
        echo"It's Friday" . "<br>";
        break;

        case"Saturday";
        echo"It's Saturday" . "<br>";
        break;

        case"Sunday";
        echo"It's Sunday" . "<br>";
        break;

        default;
        echo"Invalid day" . "<br>";
        break;
}



$x = 1;

while($x <= 5){
    echo "The number is : $x". "<br>";
    $x++;
}
$y = 1;

do {
    echo"The number is $y" ."<br>";
    $y++;
}while($y <= 6);

for($x = 0;$x<=10;$x++){
    echo"Shkolla digjitale $x"."<br>";

}
$cars = array("BMW","W","Audi","Tesla");

foreach($cars as $value){
    echo"$value" . "<br>";
}

$age = array("John" => "18", "Michael" => "23","Joe"=>"18");

foreach($age as $key => $value){
    echo"$key = $value"."<br>";
}

// BuildFunctions


//phpinfo();

$y = "Helloooo" . "<br>";

print_r($y);

$x =2;
echo gettype($x) . "<br>";

$x =2.3;
echo gettype($x) . "<br>";

$x ="Shkolla";
echo gettype($x) . "<br>";

function displayPhpVersion (){
    echo"This is PHP" . phpversion() . "<br>";
}
displayPhpVersion();

//User defined functions




?>