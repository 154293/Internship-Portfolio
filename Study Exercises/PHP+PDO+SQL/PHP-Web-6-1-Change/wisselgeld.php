<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        img {
            max-height: 100px;
        }
        ul {
            list-style-type: none;              /* very basic css, not worth an external doc for my usecase */
        }
        li {
            float: left;
            margin: 0 1% 0 0;
        }
    </style>
</head>

<body>

    <h1>Hoeveel geld wil je wisselen?</h1>

    <form method="post" action="wisselgeld.php">
        <input type="text" name="input" value="<?php echo isset($_POST['input']) ? $_POST['input'] : '' ?>">
        <input type="submit" value="Wisselen!"><br>
    </form>

    <?php


    if (isset($_POST['input'])) {
        $input = $_POST['input'];


        try {
            validateInput($input);
            echo "<h1>Je krijgt terug:</h1>";
        } catch (Exception $e) {
            echo "Error opgevangen: " . $e->getMessage();
            exit;
        }

        $MONEY_UNITS = array(5000, 2000, 1000, 500, 200, 100, 50, 20, 10, 5);           //units in amount of cents   

        $input = round($input += 0.02, 2, PHP_ROUND_HALF_UP);   //rounds input to the nearest 5 cent

        $input *= 100;       //turns euros into cents

        if ($input > 0) {
            foreach ($MONEY_UNITS as $unit) {
                $aantalUnits = floor($input / $unit);
                $overNaUnits = $input % $unit;
                $input = $overNaUnits;

                if ($aantalUnits > 0) { //This 'if' is to only echo when a unit is actually being used
                    if ($unit > 99) {
                        $dividedAgain = $unit / 100;               //this divides euros back down to cents if it's over 99 cents
                        for ($x = 0; $x < $aantalUnits; $x++) {
                            imgPrinter("$dividedAgain euro");
                        }
                    } else {
                        for ($x = 0; $x < $aantalUnits; $x++) {
                            imgPrinter("$unit cent");
                        }
                    }
                }
            }
        } else {
            echo "Geen wisselgeld";
        }
    }

    function validateInput($validateInput)
    {
        if ($validateInput < 0) {                                         //checks if input is positive
            throw new Exception("Input moet een positief getal zijn");
        } else if (is_numeric($validateInput) == 0) {                     //checks if input is a number
            throw new Exception("Input moet een valide getal zijn");
        }
    }

    function imgPrinter($unit)
    {
        echo '<ul>';
        switch ($unit) {          //switch case with the different images it needs to display
            case '50 euro':
                echo '<li><img src="euro50.png" alt="geen 50 euro"></li>';
                break;                                  //this could've been shortened if all images were the same file format
            case '20 euro':
                echo '<li><img src="euro20.jpg" alt="geen 20 euro"></li>';
                break;
            case '10 euro':
                echo '<li><img src="euro10.png" alt="geen 10 euro"></li>';
                break;
            case '5 euro':
                echo '<li><img src="euro5.png" alt="geen 5 euro"></li>';
                break;
            case '2 euro':
                echo '<li><img src="euro2.jpg" alt="geen 2 euro"></li>';
                break;
            case '1 euro':
                echo '<li><img src="euro1.png" alt="geen 1 euro"></li>';
                break;
            case '50 cent':
                echo '<li><img src="cent50.jpg" alt="geen 50 cent"></li>';
                break;
            case '20 cent':
                echo '<li><img src="cent20.jpg" alt="geen 20 cent"></li>';
                break;
            case '10 cent':
                echo '<li><img src="cent10.jpg" alt="geen 10 cent"></li>';
                break;
            case '5 cent':
                echo '<li><img src="cent5.jpg" alt="geen 5 cent"></li>';
                break;
        }
        echo '</ul>';
    }
    ?>

</body>

</html>