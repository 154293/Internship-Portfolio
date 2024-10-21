<?php

$aantalvrienden = readline("Hoeveel vrienden zal ik vragen om hun droom?\n");   //asks how many friends you want to ask about their dreams
$dromenvanger = array();              //sets up dreamcatcher array

if (is_numeric($aantalvrienden)) {                          //checks if you gave a number of friends
    for ($x = 0; $x < $aantalvrienden; $x++) { 
        $naam = readline("Wat is jouw naam?" . PHP_EOL);
        $aantaldromen = readline("Hoeveel dromen ga je opgeven?" . PHP_EOL);  //asks how many dreams you want to tell
        if (is_numeric($aantaldromen)) {                //checks if it's a number
            for ($y = 0; $y < $aantaldromen; $y++) {
                $dromenvanger[$naam][] = readline("Wat is jouw droom?" . PHP_EOL);    //every dream gets saved in multidimensional array
            }
        } else {
            echo "Dat is geen getal :<" . PHP_EOL;       //tells you it's not a number
        }
    }
} else {
    echo "Dat is geen getal :<" . PHP_EOL;               //tells you it's not a number
}

foreach ($dromenvanger as $naam => $dromen) {
    foreach ($dromen as $droom) {
        echo "$naam heeft dit als droom: $droom" . PHP_EOL;    //loads the dreams per person from the multidimensional array
    }
}

?>