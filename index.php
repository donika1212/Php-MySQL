
<table border="1">
    <tr>
      <th>phones</th>
      <th>in stock</th>
      <th>sold</th>
    </tr>

<style>
   table {
    width:50%:
    border-collapse:collapse;
   }

   th, td {
    padding:30px;
    text-align:left;
    border:3px solid red:
   }

   th{
    background-color:gray;
    font-wight:bold;
   }

</style>


<?php
$dogs = array(
    array("chihuahua", "mexico",20),  
    array("husky", "siberia",15),
    array("bulldog", "england",10),

);

echo $dogs[0][0] . ":Origin" . $dogs[0][1] . ",Life span:" .$dogs[0][2] . "<br>";
echo $dogs[1][0] . ":Origin" . $dogs[1][1] . ",Life span:" .$dogs[1][2] . "<br>";
echo $dogs[2][0] . ":Origin" . $dogs[2][1] . ",Life span:" .$dogs[2][2] . "<br>";

for($row=0;$row<3;$row++) {
        echo "<p><b> Row number $row </b></p>";
        echo "<ul>";
        for($col=0;$col<3;$col++) {
            echo "<li>" . $dogs[$row][$col] . "</li>";
        }
        echo "</ul>";
    }




    
$phones= array(
        array("iphone 14", "20",10),  
        array("iphone 13", "20",20),
        array("iphone 12", "20",25),
        array("iphone 11", "25",40),
    
    );

 for($row=0;$row<4;$row++) {

    echo "<tr>";

    for($col=0;$col<3;$col++) {

        echo "<td>" .$phones[$row][$col] ."</td>";

    }

    echo "</tr>";

    
 }
 echo "</table>";

 //nested loops

 $arrays=array(
    array(1,2,3),
    array(1,2,3),
    array(1,2,3),
 );

 for($i=0; $i<3; $i++){

    for($j=0; $j<3; $j++){
        echo "array: $i element: $j . <br>";
    }

 }


for($i=0; $i<4; $i++) {

    for($j=0; $j<=$i; $j++) {
        echo "*";
    }
    echo "<br>";
}

//associative arrays

$grade= array(
    "math" =>"1",   
    "art" =>"5",
    "histori" =>"3",
    "muzik" =>"4",
);


echo "math grade is" .$grade["math"] . "<br>";

foreach($grade as $subject => $grade) {
    echo "subject :" .$subject . "grade :" .$grade;
    echo "<br>";
}

?>