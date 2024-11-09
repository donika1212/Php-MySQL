<?php

//multidimiensional arrays

$dogs = array(
    array("Cihuahua","Mexico",20), //$dogs[0][1]
    array("Husky","Siberia",15),
    array("Bulldog","England",10),
);

echo $dogs [0][0] . ":Origin:" . $dogs[0][1] . ":Life Span:" . $dogs[0][2] . "<br>";
echo $dogs [1][0] . ":Origin:" . $dogs[1][1] . ":Life Span:" . $dogs[1][2] . "<br>";
echo $dogs [2][0] . ":Origin:" . $dogs[2][1] . ":Life Span:" . $dogs[2][2] . "<br>";

for($row=0;$row<3;$row++) {
    echo "<p><b> Row number $row </b></p>";
    echo "ul";
    for($col=0;$col<3;$col++) {
        echo "<li>" . $dogs[$row][$col] . "</li>";

    }
    echo "</ul>";
}

 



$phones = array(
    array("Iphone 14",20,10), //$dogs[0][1]
    array("Iphone 13",20,20),
    array("Iphone 12",20,25),
    array("Iphone 11",25,40),

);

//echo "table border ='1' cellpadding='5' cellspacing='0'>";
//echo "<tr><th>Model</th><th>Brand</th><th>Price</th></tr>";

for($row=0;$row<4;$row++){
    echo "<tr>";

    for($col=0;$col<3;$col++){
        echo "<td>" . $phones[$row][$col] . "</td>";

    }

    echo "</tr>";
}

echo "</table>";

//Nested loops 

$arrays=array(
array(1,2,3),
array(1,2,3),
array(1,2,3),
);

for($i=0; $i<3; $i++){

    for($j=0; $j<3; $j++){
        echo "Array:  $i element: $j .<br>";
    }
}


for ($i=0; $i < 5; $i++) {
    for($j=0; $j<$i; $j++){
        echo "*";
    }
    echo "<br>";

}

//Assocative arrays

$grade = array(
    "Math" => "1",
    "Art" => "5",
    "History" => "3",
    "Music" => "4",
);

echo "Math grade is " .$grade["Math"]. "<br>";

foreach($grade as $subject => $grade){
    echo "Subject : " .$subject . ",Grade :" .$grade;
    echo "<br>";
}

































































?>