<?php

$host = '127.0.0.1';
$db   = 'netland';
$user = 'bit_academy';
$pass = 'bit_academy';

$dsn = "mysql:host=localhost;dbname=netland;";

try {
    $pdo = new PDO($dsn, $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    echo "Connection Successful";
} catch (PDOException $e) {
    echo "Connection Failed";
}

if (!isset($_COOKIE['ratingCounter'])) {
    setcookie('ratingCounter', 0);        //makes rating cookie
    $_COOKIE['ratingCounter'] = 0;
}
if (isset($_POST['sortRating'])) {
    $ratingCounter = ++$_COOKIE['ratingCounter'];   //increment rating button when pressed
    setcookie('ratingCounter', $ratingCounter);
}
if (isset($_COOKIE['ratingCounter'])) {             //checkt if the amount is even or uneven
    if (($_COOKIE['ratingCounter'] % 2) === 1) {
        $series = $pdo->prepare("SELECT * FROM series ORDER BY rating DESC");
        $series->execute();                        //ASC or DESC dependent on even or uneven
        $series->setFetchMode(PDO::FETCH_ASSOC);
    } else {
        $series = $pdo->prepare("SELECT * FROM series ORDER BY rating ASC");
        $series->execute();
        $series->setFetchMode(PDO::FETCH_ASSOC);     //fixes skipping the first item in query
    }
}
if (!isset($series)) {
    $series = $pdo->prepare("SELECT * FROM series");
    $series->execute();         //if series query isn't set after sort check, grab this one by default
    $series->setFetchMode(PDO::FETCH_ASSOC);
}

if (!isset($_COOKIE['duurCounter'])) {
    setcookie('duurCounter', 0);
    $_COOKIE['duurCounter'] = 0;
}

if (isset($_POST['sortDuur'])) {
    $duurCounter = ++$_COOKIE['duurCounter'];       //all the same, but for movies rather than series
    setcookie('duurCounter', $duurCounter);
}
if (isset($_COOKIE['duurCounter'])) {
    if (($_COOKIE['duurCounter'] % 2) === 1) {
        $movies = $pdo->prepare("SELECT * FROM movies ORDER BY length_in_minutes DESC");
        $movies->execute();
        $movies->setFetchMode(PDO::FETCH_ASSOC);
        $movies = $pdo->prepare("SELECT * FROM movies ORDER BY length_in_minutes ASC");
        $movies->execute();
        $movies->setFetchMode(PDO::FETCH_ASSOC);
    }
}

if (!isset($movies)) {
    $movies = $pdo->prepare("SELECT * FROM movies");
    $movies->execute();
    $movies->setFetchMode(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="t1">
        <h1>Series</h1>
        <table>
            <tr>
                <th>Title</th>
                <th>
                    <form action="index.php" method="POST">
                        <input type="submit" name='sortRating' value="Rating">
                    </form>
                </th>
                <th>Details</th>
            </tr>
            <?php foreach ($series as $serie) : ?>
                <tr>
                    <td><?= $serie['title'] ?></td>
                    <td><?= $serie['rating'] ?></td>
                    <td>
                        <form action="detail_serie.php" method="POST">
                            <input type="hidden" name="postSerie" value="<?= $serie['id'] ?>">
                            <input type="submit" value="bekijk details">
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>

    <div class="t2">
        <h1>Films</h1>
        <table>
            <tr>
                <th>Title</th>
                <th>
                    <form action="index.php" method="POST">
                        <input type="submit" name='sortDuur' value="Duur">
                    </form>
                </th>
                <th>Details</th>
            </tr>
            <?php foreach ($movies as $movie) : ?>
                <tr>
                    <td><?= $movie['title'] ?></td>
                    <td><?= $movie['length_in_minutes'] ?></td>
                    <td>
                        <form action="detail_film.php" method="POST">
                            <input type="hidden" name="postFilm" value="<?= $movie['id'] ?>">
                            <input type="submit" value="bekijk details">
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
</body>

</html>