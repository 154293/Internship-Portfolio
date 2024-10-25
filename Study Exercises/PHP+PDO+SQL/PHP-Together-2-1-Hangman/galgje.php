<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Galgje</title>
    <link rel="stylesheet" href="style.css?v=<?php echo time(); ?>">
</head>

<body>

    <?php

    if (!isset($_COOKIE['blankWord'])) {
        setcookie('blankWord', "");
        $_COOKIE['blankWord'] = "";                            //if cookie of blankWord isn't made, make one
    }
    $guessedLetter = '';                                            //default letter is string with non-letter in it
    $wordArray = ['delay', 'sanctuary', 'biography', 'hotdog', 'abstract', 'anticipation', 'romantic', 'judgement', 'portrait'];

    if (isset($_POST['startSelf'])) {
        $word = strtolower($_POST['word']);                          //if the word is selfmade, set word to the selfmade one
    } else if (isset($_POST['startRandom'])) {
        $word = $wordArray[(rand(0, (count($wordArray) - 1)))];     //if the word is random, set word to random word from array
    }

    if (!isset($_COOKIE['word'])) {
        setcookie('word', $word);                                   //makes a cookie for word
    }

    if (!isset($word)) {
        $word = $_COOKIE['word'];                                   //if word isn't set upon refresh, uses the cookie to respawn word
    } else {
        setcookie('word', $word);                                   //I don't remember whether this is useful
    }

    ?>

    <h1>Hangman</h1>

    <form method="post" action="">

        <?php
        if (isset($_POST['letter'])) {
            $guessedLetter = $_POST['letter'];                      //set variable for each chosen letter
        }

        if (!isset($_COOKIE['blankWord'])) {
            setcookie('blankWord');                            //if cookie of blankWord isn't made, make one
        } else if (!str_contains($_COOKIE["blankWord"], $guessedLetter)) {
            setcookie("blankWord", $_COOKIE["blankWord"] . $guessedLetter);
            $_COOKIE["blankWord"] = $_COOKIE["blankWord"] . $guessedLetter;
        }


        if (isset($_POST["letter"])) {
            if (!str_contains($word, $_POST["letter"])) {              //counter voor verkeerde letters voor het genereren van de galg img
                $wrongLetters = 0;
                $wrongLetters = ++$_COOKIE['count'];
                setcookie('count', $wrongLetters);
            } else {
                $wrongLetters = $_COOKIE['count'];
                setcookie('count', $wrongLetters);
            }
        }

        $allGuessed = $_COOKIE["blankWord"];
        echo "<p> Your guessed letters are <span> $allGuessed </span></p>";               //echoes guessed letter

        if ($_COOKIE['count'] <= 10) {
            echo "<img src='steps/step" . $_COOKIE['count'] . ".png' alt='" . $_COOKIE['count'] . ".png'>";     //echoes image step
        }

        $alphabet = range("a", "z");                                                               //generates array with alphabet

        foreach ($alphabet as $button) {
            if (isset($_COOKIE['word'])) {
                if (str_contains($_COOKIE['word'], $button) && str_contains($allGuessed, $button)) {
                    echo '<input type="submit" name="letter" value="' . $button . '" style="text-decoration:underline; font-weight:bold;">';  //onderstreept knop als die al geraden is
                } elseif (str_contains($allGuessed, $button)) {
                    echo '<input type="submit" name="letter" value="' . $button . '" style="text-decoration:line-through; font-weight:bold;">';
                } else {
                    echo '<input type="submit" name="letter" value="' . $button . '">';
                }
            } else if (!isset($_COOKIE['word'])) {
                echo '<input type="submit" name="letter" value="' . $button . '">';
            }
        }

        if ($_COOKIE['count'] >= 10) {
            echo "<h2>GAME OVER, IDIOT!</h2>";
        }
        ?>

    </form>
    <p>

        <?php
        $blankWord = "";
        if (!isset($_COOKIE['blankWord'])) {
            setcookie('blankWord', "");                      //if cookie of blankWord isn't made, make one
        } else {
            $blankWord = strtolower($_COOKIE["blankWord"]);
        }

        $gevuldWoord = "";
        for ($i = 0; $i < strlen($word); $i++) {
            $currentLetter = strtolower($word[$i]);
            if (str_contains($blankWord, $currentLetter)) {        //checks if current letter of word is one of the guessed letters
                $gevuldWoord .= $currentLetter;
            } else {
                $gevuldWoord .= "_";
            }
        }

        if (!str_contains($gevuldWoord, "_") && $_COOKIE['count'] < 10) {
            echo "<img src='win.gif' id='win' alt='win.gif'>";
            echo "<h2>YOU WON</h2>";
        }

        for ($z = 0; $z < strlen($gevuldWoord); $z++) {
            echo $gevuldWoord[$z];                             //runs through the guessed letters and echoes them with a space inserted
            echo " ";
        }
        ?>
    </p>

    <form action="index.php">
        <input type="submit" value="start over" id="restart">
    </form>
</body>

</html>