<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grand Mountain Guide Home</title>
    <link rel="stylesheet" href="../../../styles/style.css">
</head>

<body>
    <header class="headerflex">
        <a href="index.php">
            <img src="../../../external/imgs/CatBlush.png" alt="cat" title="cat">
        </a>
        <h1 class="lobster">Grand Mountain Adventure</h1>
        <p class="invis"></p>
    </header>
    <nav class="navflex">
        <ul>
            <li><a href="../../home/index.php">Home</a></li>
            <li><a class="activenav" href="../../lbs/leaderboards.php">Leaderboards</a></li>
            <li><a href="../../maps/maps.php">Mountain Maps</a></li>
            <li><a href="../../tnt/tnt.php">Tips and Tricks</a></li>
            <li><a href="../../socials/socials.php">Socials</a></li>
        </ul>
        <ul>
            <li><a href="#login">Login/Register</a></li>
        </ul>
    </nav>

    <div class="lbmain">
        <aside class="">
            <div class="asidediv">
                <h1>Hot Singles Near You!</h1>
                <a onclick="javascript: window.location = 'https://www.youtube.com/watch?v=dQw4w9WgXcQ';">
                    <img src="../../../external/imgs/AngryToad.webp" alt="hotsingle">
                </a>
            </div>
        </aside>

        <?php

        if (isset($_GET['classic_page'])) {
            setcookie('map', $_GET['classic_page']);
            $_COOKIE['map'] = $_GET['classic_page'];

            switch ($_COOKIE['map']) {
                case "GMA Classic WR Home":
                    include 'home.php';
                    break;
                case "PB Sheet":
                    include 'pb.php';
                    break;
                case "Rating LB":
                    include 'rating.php';
                    break;
                default:
                    include 'mountain.php';
            }
        } else {
            include 'home.php';
        }

        ?>

        <aside>
            <div class="sidenav">
                <div class="topthree">
                    <form action="classic.php" method="GET">
                        <input type="submit" class="lb_map" name="classic_page" value="GMA Classic WR Home">
                    </form>
                    <form action="classic.php" method="GET">
                        <input type="submit" class="lb_map" name="classic_page" value="PB Sheet">
                    </form>
                    <form action="classic.php" method="GET">
                        <input type="submit" class="lb_map" name="classic_page" value="Rating LB">
                    </form>
                </div>
                <br>
                <ul>
                    <li>
                        <form action="classic.php" method="GET">
                            <input type="submit" class="lb_map" name="classic_page" value="Hirschalm">
                        </form>
                    </li>
                    <li>
                        <form action="classic.php" method="GET">
                            <input type="submit" class="lb_map" name="classic_page" value="Waldtal">
                        </form>
                    </li>
                    <li>
                        <form action="classic.php" method="GET">
                            <input type="submit" class="lb_map" name="classic_page" value="Elnakka">
                        </form>
                    </li>
                    <li>
                        <form action="classic.php" method="GET">
                            <input type="submit" class="lb_map" name="classic_page" value="Dalarna">
                        </form>
                    </li>
                    <li>
                        <form action="classic.php" method="GET">
                            <input type="submit" class="lb_map" name="classic_page" value="Rotkamm">
                        </form>
                    </li>
                    <li>
                        <form action="classic.php" method="GET">
                            <input type="submit" class="lb_map" name="classic_page" value="Saint Luvette">
                        </form>
                    </li>
                    <li>
                        <form action="classic.php" method="GET">
                            <input type="submit" class="lb_map" name="classic_page" value="Passo Grolla">
                        </form>
                    </li>
                    <li>
                        <form action="classic.php" method="GET">
                            <input type="submit" class="lb_map" name="classic_page" value="Ben Ailig">
                        </form>
                    </li>
                    <li>
                        <form action="classic.php" method="GET">
                            <input type="submit" class="lb_map" name="classic_page" value="Mount Fairview">
                        </form>
                    </li>
                    <li>
                        <form action="classic.php" method="GET">
                            <input type="submit" class="lb_map" name="classic_page" value="Pinecone Peaks">
                        </form>
                    </li>
                    <li>
                        <form action="classic.php" method="GET">
                            <input type="submit" class="lb_map" name="classic_page" value="Agpat Island">
                        </form>
                    </li>
                </ul>
            </div>
        </aside>
    </div>

    <footer>
        <h1>FOOTER</h1>
    </footer>
</body>

</html>