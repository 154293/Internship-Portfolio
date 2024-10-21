<?php

$uitkomst = 0;
$totaal = 0;

if (count($argv) > "1") {
    $array = array_slice($argv, 1);                      //slices input up into array
    foreach ($array as $test) {                          //loops for every time-pair
        $nummers = (int) $test;                          //writes number down
        $letters = substr($test, -1);                    //finds letter in pair
        $uitkomst = 0;                                   //declares result
        switch ($letters) {                              //switch case with calculation depending on what letter is given
            case "d":
                $uitkomst = $nummers * 24 * 60 * 60;
                break;
            case "u":
                $uitkomst = $nummers * 60 * 60;
                break;
            case "m":
                $uitkomst = $nummers * 60;
                break;
            case "s":
                $uitkomst = $nummers;
                break;
        }
        $totaal = $totaal + $uitkomst;                    //adds result to total
    }
    echo "De totale tijd is $totaal seconden" . PHP_EOL;  //total time in seconds
} else {
    echo "Geen tijd meegegeven" . PHP_EOL;                //message if no argument with the time was given when executing the program
}

?>