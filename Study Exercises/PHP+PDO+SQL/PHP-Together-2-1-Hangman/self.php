<?php

if (isset($_POST['word'])) {
    $word = $_POST['word'];          //if word has been set already, store it in the right variable
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Landing</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <h1>Hangman</h1>
    <h2>You want to choose your own word</h2>
    <form method="post" action="galgje.php">
        <input type="text" name="word">
        <input type="submit" name="startSelf" value="Start game">         <!-- sends the info that it needs to be with a custom word -->
    </form>
</body>

</html>