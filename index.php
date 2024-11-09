<table border ="1"> 
<tr>
<th>phones</tr>
<th>in stock </tr>
<th>sold </th>
</tr>
<?php




$dogs = array(
    array ("chiuauha", "mexico",20),
    array ("husky", "siberia",20),
    array ("bulldog", "england",20),
);
echo $dogs[0][0] . ":origin" . $dogs[0][1] . "lifespan:" . $dogs[0] [2]. "<br>";
echo $dogs[1][0] . ":origin" . $dogs[1][1] . "lifespan:" . $dogs[1] [2]. "<br>";
echo $dogs[2][0] . ":origin" . $dogs[2][1] . "lifespan:" . $dogs[2] [2]. "<br>";
for ($row = 0 ; $row<3; $row++){
    echo "<p><b> row numbers $row </b></p>";
    for ($col=0;$col<3;$col++){
    echo "<li>".$dogs [$row][$col]. "</li>";


}

echo "</ul";


}










//iphones

$phones = array(
    array ("iphone 16", "usa",2024),
    array ("iphone 15", "usa",2023),
    array ("iphone 14", "iphone",2022),
);
echo $phones[0][0] . ":origin" . $phones[0][1] . "lifespan:" . $phones[0] [2]. "<br>";
echo $phones[1][0] . ":origin" . $phones[1][1] . "lifespan:" . $phones[1] [2]. "<br>";
echo $phones[2][0] . ":origin" . $phones[2][1] . "lifespan:" . $phones[2] [2]. "<br>";
for ($row = 0 ; $row<3; $row++){
    echo "<p><b> row numbers $row </b></p>";
    for ($col=0;$col<3;$col++){
    echo "<li>".$phones [$row][$col]. "</li>";


}

echo "</ul";


}

$phones = array(
    array("Model" => "iPhone 16", "Origin" => "USA", "Release Year" => 2024),
    array("Model" => "iPhone 15", "Origin" => "USA", "Release Year" => 2023),
    array("Model" => "iPhone 14", "Origin" => "USA", "Release Year" => 2022),
);

echo $phones[0]["Model"] . ": origin " . $phones[0]["Origin"] . ", release year: " . $phones[0]["Release Year"] . "<br>";
echo $phones[1]["Model"] . ": origin " . $phones[1]["Origin"] . ", release year: " . $phones[1]["Release Year"] . "<br>";
echo $phones[2]["Model"] . ": origin " . $phones[2]["Origin"] . ", release year: " . $phones[2]["Release Year"] . "<br>";

// Display the data in a structured HTML table



//nerted loops
$arrays =array(
    array (1,2,3),
    array (1,2,3),
    array (1,2,3),
);
for ($i=0 ; $i<3; $i++){
    for ($j=0; $j<3; $j++) {
        echo "array: $i element: $j .<br> ";
    }
}


for($i=0; $i < 5; $i++){
    for($j =0; $j<$i; $j++ ){
        echo "*";

    }
    echo "<br>";
}


$grade = array(
    "math" => "1",
    "art"=> "5",
    "history" => "7",
    "gj,shqipe"=>"3",
);
echo "math grade is" . $grade["math"];
foreach($grade as $subject => $grade ){
    echo "subject: " . $subject  . ", grade " .$grade;
    echo "<br>";
}

 










?>