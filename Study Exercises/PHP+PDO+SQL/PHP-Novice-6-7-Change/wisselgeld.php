<?php

$input = $argv;      //turns whole argv into input

function isItNumeric($isItNumeric)   //separate function that parses for number (I had to make this for the exercise)
{
    return is_numeric($isItNumeric);   
}

function validateInput($validateInput)
{
    if (count($validateInput) < 2) {                                        //checks if input has been given by checking if the array is bigger than 1
        throw new Exception("Geen wisselgeld");
    } else if (end($validateInput) < 0) {                                   //checkt if input is a positive number
        throw new Exception("Input moet een positief getal zijn");
    } else if (isItNumeric(end($validateInput)) == 0) {                     //fake is_numeric is used to parse number
        throw new Exception("Input moet een valide getal zijn");
    } else if (count($validateInput) > 2) {                                 //this last one wasn't required, but it's for if you give it too many arguments
        throw new Exception("Je hebt te veel array items meegegeven");      
    }                                                                       //every possible error throws its own exception
}

try {
    validateInput($input);                                                  //try-catch using the validateInput function above
} catch (Exception $e) {
    echo "Error opgevangen: " . $e->getMessage();                           //catches the errors and exits the program
    exit;
}

$input = end($input);                                                       //grabs the last item in argv array (which is the 2nd)

$MONEY_UNITS = array(5000, 2000, 1000, 500, 200, 100, 50, 20, 10, 5);       //different units of money by amount in cents

$input *= 100;                                                              //turns input of euros into cents

if ($input > 0) {
    foreach ($MONEY_UNITS as $unit) {
        $aantalUnits = floor($input / $unit);
        $overNaUnits = $input % $unit;
        $input = $overNaUnits;

        if ($aantalUnits > 0) {                                           //This 'if' is to only do an echo when the unit is being used.
            if ($unit > 99) {
                $dividedAgain = $unit / 100;                              //This one divides the cents back down to euros if there's more than 100 cents
                echo "$aantalUnits x $dividedAgain euro" . PHP_EOL;
            } else if ($unit != 5) {                                      //This one is for the cent-units as long as they're not 5-cent units
                echo "$aantalUnits x $unit cent" . PHP_EOL;               //This is for rounding reasons that'll become clear later on
            }
        }
        if ($unit == 5) { //This 'if' checks if we're already in the loop with 5-cents as the unit.
            $gedeeldDoorTien = ($overNaUnits / 10) * 2; //Divides the last bit by 10 and multiplies it by 2
            $gedeeldDoorTien = round($gedeeldDoorTien); // 2 becomes 0.2 becomes 0.4 and thus rounded down to 0. 3 becomes 0.3 becomes 0.6 and thus rounded up to 1
            if ($gedeeldDoorTien == 1) { //This 'if' checks if the last bit needs to be rounded up or down to 0 or 1 extra unit of 5 cent
                $aantalUnits = $aantalUnits + 1; //If 1 extra unit is necessary, it adds that extra unit of 5 cent.
            }
            if ($aantalUnits > 0) {
                echo "$aantalUnits x $unit cent" . PHP_EOL;
            }
        }
    }
} else {
    echo "Geen wisselgeld";
}
