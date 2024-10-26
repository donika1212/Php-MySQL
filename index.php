<?php

//switch//

$age=25;

switch($age){

case ($age >= 0 && $age <18):
    echo "You are a minor (0-18 years old)" . "<br>";
    break;
    case ($age >=18 && $age <=25):
        echo "You are young adult" . "<br>";
        break;
        case ($age > 25):
            echo "You are an adult";
            break;
            default:
            echo "Invalid age";
            break;



}


$day = "Tuesday";

switch($day){

    case "Monday":
        echo "It' s Monday!" . "<br>"; 
        break;

        case "Tuesday":
            echo "It's Tuesday!" . "<br>";
            break;

            case "Wednesday":
                echo "It's Wednesday!" . "<br>";
                break;

                case "Thursday":
                    echo "It's Thursday!" . "<br>";
                    break;

                    case "Friday":
                        echo "It's Friday!" . "<br>";
                        break;

                        case "Saturday":
                            echo "It's Saturday!" . "<br>";
                            break;

                            case "Sunday":
                                echo "It's Sunday!". "<br>";
                                break;



                            }
//Loops (Unazat)//

$x = 1;

while( $x <= 5){
    echo "The number is : $x" . "<br>";

    $x++;
}

$y = 1;

do{
    echo "The number is : $y." . "<br>";
    $y++;
}while( $y <= 6);


for($x=0;$x < 10; $x++){
    echo "Shkolla Digjitale" . "<br>";
}

$cars = array ("Mercedes","Bmw","Audi","VW");

foreach($cars as $value){
    echo "$value" . "<br>";
}


$age = array("John" => "18", "Michael" => "23", "Joe" => "10");

foreach($age as $key => $value){
    echo "$key = $value" . "<br>";
}

//built-in Functions//

//phpinfo();//

$y="Hello" . "<br>";

print_r($y);

$x="SHKOLLA";
echo gettype($x) . "<br>";


function displayPhpVersion (){
    echo "This is PHP:" .phpversion() . "<br>";
}

displayPhpVersion();

//User defined functions//


















 


?>