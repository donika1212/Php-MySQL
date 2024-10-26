<?php

//switch

$age=20;

switch($age) {
    case ($age >=0 && $age < 18):
        echo "You are a minor (0-18 years old)" . "<br>";
        break;
        case($age >=0 && $age <=25):
        echo "You are an young adult (0-25 years old)" .  "<br>";
        break;
        case($age > 25):
        echo"You are a adult" . "<br>";
        break;
        default:
        echo "invalid age" . "<br>";
        break;



}

$day = "Tuesday";

switch($day) {

    case"Monday":
        echo "its monday";
        break;

        case"Tuesday":
            echo "OMG Tuesday";
            break;

            case"Wednsday":
                echo "ohno wednesday";
                break;

                case"thursday":
                    echo "OHYE thursday";
                    break;

                    case"friday":
                        echo "COMON Friday";
                        break;

                        case"saturday":
                            echo "ohpapa saturday";
                            break;

                            case"sunday":
                                echo "OHNO sunday";
                                break;

                                default:
                                echo"Invalid day" . ">br>";

    

}



//loops 

$x =1;

while( $x <=5) {
    echo "the number is :$x" . "<br>";

    $x++;
}

$y = 1;

do{
    echo "the number is : $y." . "<br>";
    $y++;

}while( $y  <=6);

for($x=0; $x < 10; $x++){

echo "Shkolla digjitale " . "<br>";

}

$cars = array ("BMW","VW", "Audi", "Porsche");

foreach($cars as $value) {

    echo"$value" , "<br>";
}

$age = array ("John" => "18" , "istreti" => "25", "Naimi" => "10");


foreach($age as $key => $value) {
    echo "$key = $value" . "<br>";
}


// build in functions



$y ="Hellooo";

print_r ($y) ;

$x=2;
echo gettype($x) . "<br>";

$x=2.3;
echo gettype($x) . "<br>";

$x="shkolla";
echo gettype($x) . "<br>";


function displayPhpVersion (){
    
    echo "this is php" . phpversion() . "<br>";
}

displayPhpVersion();

//user defin version




?>