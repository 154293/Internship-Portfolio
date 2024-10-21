<?php

$list = array();

function LeesLijst()                 //function to add items to grocery list
{
    $product = readline("Wat wil je aan je boodschappenlijst toevoegen?");     //asks what you want to add to the list
    array_push($GLOBALS['list'], $product);                                   //adds it to the list

    echo "Je boodschappen lijstje bevat nu:" . PHP_EOL;           //tells you what the list currently contains
    foreach ($GLOBALS['list'] as $value) {                        //echoes all items
        echo $value . PHP_EOL;
    }
}

echo LeesLijst();      //initial function usage

while (strtolower(substr(trim(readline("Wil je meer producten toevoegen? (y/n)")), 0, 1)) === 'y') {      //asks if you want to add additional items
    echo LeesLijst();
}

echo "Bedankt voor het gebruik van de boodschappenlijst!" . PHP_EOL;