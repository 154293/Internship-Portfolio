<?php

session_start();

function check($player, $bot)    //function to check winner
{
    echo "<h2>Speler koos $player, bot koos $bot</h2>";   //echoes the choices made
    
    if ($player === $bot) {
        echo "<h2>Het is gelijkspel!</h2>";
    } else if ($player === "steen" && $bot === "schaar") {
        echo "<h2>Speler heeft gewonnen!</h2>";
    } else if ($player === "papier" && $bot === "steen") {
        echo "<h2>Speler heeft gewonnen!</h2>";
    } else if ($player === "schaar" && $bot === "papier") {
        echo "<h2>Speler heeft gewonnen!</h2>";
    } else {
        echo "<h2>Bot heeft gewonnen!</h2>";                //echoes who won
    }
}

function resetPage()         //function to reset page
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
    <h1>Steen Papier Schaar! (VS Jarvis!)</h1>
    <?php

    $random = ["steen", "papier", "schaar"];
    $bot = $random[(rand(0, 2))];

    if (isset($_GET['reset'])) {
        resetPage();
    }

    if (isset($_GET['sps'])) {
        $_SESSION['choice'] = $_GET['sps'];                 //saves chosen rps in session
    }

    if (isset($_SESSION['choice'])) {
        $_SESSION['speler1'] = $_SESSION['choice'];         //saves session of rps in player 1 and checks winner with function
        check($_SESSION['speler1'], $bot);
    }
    
    echo '<br>';

    ?>
    <form action='jarvis.php' method='get'>
        <select name='sps'>
            <option value='steen'>Steen</option>
            <option value='papier'>Papier</option>
            <option value='schaar'>Schaar</option>             <!-- simple form with options -->
        </select><br>
        <input type='submit' value="submit">
    </form>

    <form action='jarvis.php' method='get'>
        <input type='submit' name='reset' value='Reset'></input>
    </form>
</body>

</html>
