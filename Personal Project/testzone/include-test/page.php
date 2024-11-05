<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
    <!-- <script>
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        } //prevents resubmit request, does it automatically instead
    </script> -->
</head>

<body>
    <nav>
        <ul>
            <li><a href="#one">one</a></li>
            <li><a href="#two">two</a></li>
            <li><a href="#three">three</a></li>
            <li><a href="#four">four</a></li>
            <li><a href="#five">five</a></li>
        </ul>
    </nav>
    <div class="horiflex">
        <?php

        if (isset($_GET['lb_map'])) {
            setcookie('map', $_GET['lb_map']);
            $_COOKIE['map'] = $_GET['lb_map'];

            include 'mountain.php';
        } else if (isset($_COOKIE['map'])) {
            include 'mountain.php';
        } else {
            include 'test.php';
        }

        ?>
        <aside>
            <ul>
                <li>
                    <form action="page.php" method="GET">
                        <input type="submit" class="lb_map" name="lb_map" value="Hirschalm">
                    </form>
                </li>
                <li>
                    <form action="page.php" method="GET">
                        <input type="submit" class="lb_map" name="lb_map" value="Waldtal">
                    </form>
                </li>
                <li>
                    <form action="page.php" method="GET">
                        <input type="submit" class="lb_map" name="lb_map" value="Elnakka">
                    </form>
                </li>
                <li>
                    <form action="page.php" method="GET">
                        <input type="submit" class="lb_map" name="lb_map" value="Dalarna">
                    </form>
                </li>
            </ul>
        </aside>
    </div>
</body>

</html>