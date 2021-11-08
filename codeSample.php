<?php

//Stin php oi metavlites den einai objects gia na enonw .kati metavlites

// Metavliti - den exei data type
$x = 10;

// Dikse ti exw stin metavliti
echo ($x+10)*100;

// Mporw na kanw echo html kodika
// Edw kanei echo new line
echo "<br>";

// Mporw na kanw overwrite tin metavliti me allo data type
$x = "Hello";

// I teleia kanei concatenate sto telos kati
echo $x." there!";

echo "<br>";

// Mporw na exw kai if statements
if($x=="Hello"){
    echo "Hi";
}
else{
    echo "Bye";
}

echo "<br>";

//Mporw na kalesw php methodus
echo strlen($x);

echo "<br>";

//Mporw na exw kai for loops
for($i = 0; $i < 10; $i++){
    echo "i = ".$i."<br>";
}

//Dilonw arrays;
$a = array("We","Are","Learning","Arrays");

//Tipwnw to array
echo $a[1];

echo "<br>";

//Vgazei olo to info apo to variable
var_dump($a);

//Stin php den onomazontai indexes tu pinaka alla keys epidi mporei
//anti 0 1 2 3 klp na tu doso alles onomasies oti thelw akoma kai strings

//Edw px dinw to aristera string san keys 
$b = array(
            "type" => "Sedan", 
            "brand" => "Toyota",
            "price" => 19000
);

echo "<br>";

var_dump($b);

echo "<br>";

//anti index tu lew key type ara tha mu dosei Sedan
echo $b["type"]."<br>";

//Kanw iterate otan oi arrays exun keys anti indexes 0 1 2..
foreach ($b as $value) {
    echo $value."<br>";
}

//iterate mazi kai to key
foreach ($b as $key => $value) {
    echo $key." ".$value."<br>";
}

$c = array(
    "type" => "Hatch", 
    "brand" => "Mazda",
    "price" => 25000
);

//mporw na filaksw se array vars pou exun arrays
$cars = array($b,$c);

var_dump($cars);
echo "<br>";

foreach ($cars as $car) {
    echo $car['type']." ".$car['brand']."<br>";
}
?>