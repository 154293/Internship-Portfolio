<?php
//dit moet anders kan ik hem niet opnieuw inleveren omdat er geen verandering is
session_start();

function check()          //this function checks winstates
{
    echo "<h1>Speler 1 koos " . $_SESSION['speler1'] . ", speler 2 koos " . $_SESSION['speler2'] . " </h1>";  //echoes choices made
    
    if ($_SESSION['speler1'] === $_SESSION['speler2']) {
        echo "<h1>Het is gelijkspel!</h1>";
    } else if ($_SESSION['speler1'] === "steen" && $_SESSION['speler2'] === "schaar") {
        echo "<h1>Speler 1 heeft gewonnen!</h1>";
    } else if ($_SESSION['speler1'] === "papier" && $_SESSION['speler2'] === "steen") {
        echo "<h1>Speler 1 heeft gewonnen!</h1>";
    } else if ($_SESSION['speler1'] === "schaar" && $_SESSION['speler2'] === "papier") {
        echo "<h1>Speler 1 heeft gewonnen!</h1>";
    } else {                                             //echoes who won
        echo "<h1>Speler 2 heeft gewonnen!</h1>";
    }
}

function resetPage()          //function for resetting the page
{
    unset($_COOKIE['PHPSESSID']);
    session_destroy();
    header('Location: index.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>Steen Papier Schaar</h1>
    <?php

    if (!isset($_SESSION['counter'])) {                          //if counter isn't set, make one with default value 1
        $_SESSION['counter'] = 1;
    }

    if (isset($_GET['reset'])) {
        resetPage();
    }

    if (isset($_GET['sps'])) {
        $_SESSION['choice'] = $_GET['sps'];               //saves chosen rps in session
    }
    if (isset($_SESSION['counter'])) {
        if ($_SESSION['counter'] == 1 && isset($_SESSION['choice'])) {
            $_SESSION['speler1'] = $_SESSION['choice'];       //saves session of rps in player 1 or 2 depending on counter
        } elseif ($_SESSION['counter'] == 2 && isset($_SESSION['choice'])) {
            $_SESSION['speler2'] = $_SESSION['choice'];
        }
    }

    if (isset($_SESSION['speler1'])) {
        echo '<h3>Speler 1 heeft gekozen!</h3>';       //displays player 1 if session is set
    }

    if (isset($_SESSION['speler2'])) {
        echo '<h3>Speler 2 heeft gekozen!</h3>';      //displays player 2 if session is set
        check();
    }
    
    echo '<br>';

    if (isset($_GET['sps'])) {             //increments rps
        $_SESSION['counter']++;
    }

    ?>
    <form action='game.php' method='get'>
        <select name='sps'>
            <option value='steen'>Steen</option>               <!-- simple form with the three options -->
            <option value='papier'>Papier</option>
            <option value='schaar'>Schaar</option>
        </select><br>
        <input type='submit' value="submit">
    </form>

    <form action='game.php' method='get'>
        <input type='submit' name='reset' value='Reset'></input>
    </form>
</body>

</html>
