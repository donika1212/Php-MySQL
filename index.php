<?php



$burgaxhit = array(
    array("Hashimi","Hage",28),
    array("Kadri","Hage",15),
    array("Jakupi","Hage",10),
);

echo $burgaxhit[0][0] . ":ORIGIN:" . $burgaxhit[0][1] . ":Lifesentence:" . $burgaxhit[0][2] . "<br>";
echo $burgaxhit[1][0] . ":ORIGIN:" . $burgaxhit[1][1] . ":Lifesentence:" . $burgaxhit[1][2] . "<br>";
echo $burgaxhit[2][0] . ":ORIGIN:" . $burgaxhit[2][1] . ":Lifesentance:" . $burgaxhit[2][2] . "<br>";

for($row = 0 ;$row<3;$row++){
echo "<p><b> row number $row </b></p>";
echo "<ul>";
for($col=0;$col<3;$col++){
    echo "<li>" . $burgaxhit[$row][$col]. "</li>";

}
echo "</ul>";

///////////////////////////////////////////////////////////////

$iphones = array(
    array("iPhone 12", "Apple", 799),
    array("iPhone 13", "Apple", 899),
    array("iPhone 14", "Apple", 999),
    array("iPhone 15", "Apple", 1099), 
);


echo "<table border='1' cellpadding='5' cellspacing='0'>";
echo "<tr><th>Model</th><th>Brand</th><th>Price</th></tr>"; 


for ($row = 0; $row < 4; $row++) { 
    echo "<tr>"; 
    for ($col = 0; $col < 3; $col++) { 
        echo "<td>" . $iphones[$row][$col] . "</td>"; 
    }
    echo "</tr>"; 
}
echo "</table>"; 

}
//nerted loops
///////////////////////////////////////////////////////////////

$arrays = array(
    array(1,2,3),
    array(1,2,3),
    array(1,2,3),
);

for($i=0; $i<3; $i++){

    for($j=0; $j<3; $j++){

        echo "array: $i element: $j .<br> ";
    }
}

for($i=0; $i < 5; $i++){

    for($j=0; $j<$i; $j++){
echo "*";

    }
    echo "<br>";
}


$grade = array(
    "math" => "1",
    "art" => "5",
    "history" => "8",
    "Gjuh shqip" => "3",
);

echo "math grade is" .$grade["math"];


foreach($grade as $subject => $grade){

    echo "subject : " .$subject . ", grade :"  .$grade;
    echo "<br>";
}






 




























































?>