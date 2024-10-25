<?php

if (isset($_POST['redirect'])) {
    $redirect = $_POST['redirect'];
    if ($redirect == "Choose your own word") {           //depending on what option has been pressed, it'll redirect to the corresponding page
        header("Location:self.php");
    } elseif ($redirect == "Random word") {
        header("Location:random.php");
    }
}

setcookie("geradenLetters", "");
$_COOKIE["geradenLetters"] = "";            //generates and sets cookie of guessed letters

setcookie('count', 0);                      //sets 'count' cookie at 0

if (!isset($_COOKIE['blankWord'])) {
    setcookie('blankWord');                            //if cookie of blankWord isn't made, make one
} else {
    setcookie("blankWord", "", time() - 3600);                           //sets it anyway
    setcookie("blankWord");
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
    <h1>Hangman</h1>
    <h2>Make a choice</h2>
    <form method="post"> <!-- refreshes page to top -->
        <input type="submit" name="redirect" value="Choose your own word">
        <input type="submit" name="redirect" value="Random word"> <!-- option buttons -->
    </form>
</body>

</html>