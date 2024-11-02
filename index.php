<?php
//user defined functions
function maximum($x,$y){
    if ($x >$y){
        return $x;

    }else{
        return $y;
    }

}
$a=20;
$b=30;

$test = maximum($a,$b);
echo "the max of $a and $b is $test" . "<br>";


//fully_divisibile function
function fully_divisible($num1, $num2) {
   
    if ($num2 == 0) {
        return false; 
    }
    
    return $num1 % $num2 == 0; 
}

// Example usage
$number1 = 20;
$number2 = 2;

if (fully_divisible($number1, $number2)) {
    echo "$number1 is fully divisible by $number2";
} else {
    echo "$number1 is not fully divisible by $number2";
} 
//print_r(fully_divisible(4)). "<br>";
//var scope
//global
//local
//static

$x=5; //global

function localVariable(){
    $y=10;
   // echo $x ."<br>";
    echo $y ."<br>";
}

localVariable(). "<br>";

//static
function add1(){
    static $number=0;
    $number++;
    return $number;//1

}
echo add1();//1
echo  "<br>";
echo add1();//2
echo  "<br>";
echo add1();//3


$sport1= "football";
$sport2= "basketball";
$sport3= "mma";

//$sport = array("football","basketball","mma",)
$sports = ["football","basketball","mma"];
echo "<br>";
echo $sports[0];
echo "<br>";
echo $sports[1];
echo "<br>";
echo end($sports);//the last item
echo "<br>";
echo count($sports);//return the number of elements as an integer
echo "<br>";
$len=count ($sports);
for($i=0; $i < $len; $i++){
    echo $sports [$i] ,"\n";
}
echo "<br>";
array_push($sports,"boxing");//add an item at the end of an array.
var_dump($sports);
echo "<br>";
array_pop($sports); //removes an item at the end of an array
var_dump($sports);

array_unshift($sports, "KIck boxing");//adds an item at the beggining of an array
var_dump($sports);
echo "<br>";
array_shift($sports);
var_dump($sports);
echo "<br>";
$output = array_slice ($sports, 2);
var_dump($output);
echo "<br>";
$sports = ["football","basketball","mma"];
$output = array_slice($sports,0,3);
var_dump($output);
echo "<br>";
$sports = ["football","basketball","mma"];
$output = array_slice($sports,-2,2);
var_dump($output);
echo "<br>";
//array sum
$values= [12,24,30,55];
$sum =array_sum($values);
var_dump($sum);

$weekly_temperature =[25,31,22,34,63,21,32];
$average =array_sum($weekly_temperature)/7;
echo($average);
?>




