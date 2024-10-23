<?php

$alphabet = range('a', 'z');

$shift = intval($argv[1]);             //the shift is the distance in characters that you want to shift the alphabet for your cipher

$aantalKeer = floor($shift / 26);      //if the shift is bigger than 26

$shift = $shift - (26 * $aantalKeer);  //it removes the right amount of 26s until only a shift below 26 remains

$subject = strtolower($argv[2]);       //subject is the content of the message that you want to shift

for ($x = 0; $x <= (strlen($subject) - 1); $x++) {    //for loop that keeps going for the length of the subject
    $letterkey = array_search($subject[$x], $alphabet);    //finds the key that matches the current letter in the alphabet
    $letterkey = $letterkey + $shift;                   //adds shift to the key of the letter
    if ($subject[$x] == ' ') {
        echo ' ';                                       //echoes space if there's a space between words
    } else {
        if ($letterkey < 26) {
            echo $alphabet[$letterkey];                 //echoes the alphabet array with the now shifted key
        } else {
            $letterkey = $letterkey - 26;
            echo $alphabet[$letterkey];                 //if the shift puts the key over 26, that's compensated for
        }
    }
}
