<main>

    <?php

    if ($_COOKIE['map'] == 'Hirschalm') {
        echo '<h1>Hirschalm</h1>';
    } else if ($_COOKIE['map'] == 'Waldtal') {
        echo '<h1>Waldtal</h1>';
    } else if ($_COOKIE['map'] == 'Elnakka') {
        echo '<h1>Elnakka</h1>';   
    } else if ($_COOKIE['map'] == 'Dalarna') {
        echo '<h1>Dalarna</h1>';
    } else {
        echo 'Help :<';
    }

    ?>

</main>