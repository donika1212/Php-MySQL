<?php
//User defined functions//

function maximum ($x,$y){
    if ($x > $y){
        return $x;
    }else{
        return $y;


    }
}

$a = 20;
$b = 30;

$test = maximum ($a,$b);
echo "The max of $a and $b is a $test" ."<br>";


function fully_divisible($n){
    if ($n % 2 == 0){
        return "$n is fully divisible by 2";
    }else
    return "$n is not fully divisible by 2";
    }

    //print_r(fully_divisible(4)). "<br>";

    //Variable scope
    //global
    //local
    //static

    $x = 5;//global

    function localVariable (){
        global $x;
        $y = 10; //local
        echo $x . "<br>";
        echo  $y . "<br>";
    }

    localVariable();

    //static

    function add1(){
        static $number = 0;
        $number++;
        return $number;
    }

    echo add1();//1
    echo  "<br>";
    echo add1();//2
    echo  "<br>";
    echo add1();//3

    //Arrays

    $sport1 = "Football";
    $sport2 = "Basketball";
    $sport3 = "Handball";
    $sport4 = "Voleyball";

   //$sports = array("Football","Basketball","Handball","Voleyball");

    $sports = ["Football","Basketball","Handball","Voleyball"];

    echo "<br>";
    echo $sports[0];
    echo "<br>";
    echo $sports[2];
    echo "<br>";
    echo end($sports);//The last item
    echo "<br>";
    echo count($sports);//The number of elements as an integer value.
    echo "<br>";

    $len = count($sports);
    for($i = 0; $i < $len; $i++){
        echo $sports[$i] , "\n";

    }
    echo "<br>";

    array_push($sports,"Golf");//Add an item at the end of an array


    var_dump($sports);
    echo "<br>";
    array_pop($sports);
    var_dump($sports);
    echo "<br>";

    array_unshift($sports, "Tennis");//add an item to the begining of the array
    var_dump($sports);
    echo "<br>";

    array_shift($sports);//removes the first item
    var_dump($sports);
    echo "<br>";

    $output = array_slice($sports,2);
    var_dump($output);
    echo "<br>";

    $sports = ["Football","Basketball","Handball","Voleyball"];

    $output = array_slice($sports,0,3);
    var_dump($output);
    echo "<br>";

    $sports = ["Football","Basketball","Handball","Voleyball"];
    $output = array_slice($sports,-2, 2);
    var_dump($output);
    echo "<br>";

    //array_sum

    $values = [12,24,30,55];

    $sum = array_sum($values);
    var_dump($sum);
    echo "<br>";
    
//detyra
    $weektemperature = [18,22,17,25,30,21,12];
    $sum = array_sum($weektemperature);
    var_dump($sum);
    echo "<br>";

    $average = array_sum($weektemperature)/7;
    echo($average);








?>