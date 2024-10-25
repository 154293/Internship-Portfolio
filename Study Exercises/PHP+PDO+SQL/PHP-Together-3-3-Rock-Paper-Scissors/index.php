<?php

if (isset($_POST['redirect'])) {
    $redirect = $_POST['redirect'];
    if ($redirect == "1 speler") {              //redirects to the right page depending on what option was chosen
        header("Location:jarvis.php");
    } elseif ($redirect == "2 spelers") {
        header("Location:game.php");
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Start</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <h1>Steen, papier, schaar</h1>
    <h2>Maak een keuze</h2>
    <form method="post">
        <input type="submit" name="redirect" value="1 speler">      <!-- buttons for 1 or two player options -->
        <input type="submit" name="redirect" value="2 spelers">
    </form>
</body>
</html>
