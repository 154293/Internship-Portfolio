<?php

$host = '127.0.0.1';
$db   = 'netland';
$user = 'bit_academy';
$pass = 'bit_academy';

$dsn = "mysql:host=localhost;dbname=netland;";

try {
    $pdo = new PDO($dsn, $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    echo "Connection Successful";
} catch (PDOException $e) {
    echo "Connection Failed";
}

$enums = $pdo->prepare("SELECT DISTINCT `media_type` FROM `media`");
$enums->execute();
$enums->setFetchMode(PDO::FETCH_ASSOC);  //fixes skipping the first result in a query

if (!isset($_COOKIE['ratingCounter'])) {
    setcookie('ratingCounter', 0);              //adds rating cookie for rating of show
    $_COOKIE['ratingCounter'] = 0;
}
if (isset($_POST['sortRating'])) {
    $ratingCounter = ++$_COOKIE['ratingCounter']; 
    setcookie('ratingCounter', $ratingCounter);
}
if (isset($_COOKIE['ratingCounter'])) {
    if (($_COOKIE['ratingCounter'] % 2) === 1) {
        $series = $pdo->prepare("SELECT * FROM media WHERE media_type = 'serie' ORDER BY rating DESC");
        $series->execute();
        $series->setFetchMode(PDO::FETCH_ASSOC);
    } else {
        $series = $pdo->prepare("SELECT * FROM media WHERE media_type = 'serie' ORDER BY rating ASC");
        $series->execute();
        $series->setFetchMode(PDO::FETCH_ASSOC);
    }
}
if (!isset($series)) {
    $series = $pdo->prepare("SELECT * FROM media WHERE media_type = 'serie'");   //default query for shows
    $series->execute();
    $series->setFetchMode(PDO::FETCH_ASSOC);
}

if (!isset($_COOKIE['duurCounter'])) {
    setcookie('duurCounter', 0);              //adds counter cookie for length of the movie
    $_COOKIE['duurCounter'] = 0;
}
if (isset($_POST['sortDuur'])) {
    $duurCounter = ++$_COOKIE['duurCounter'];
    setcookie('duurCounter', $duurCounter);
}
if (isset($_COOKIE['duurCounter'])) {                 //turns even or odd number into ASC or DESC
    if (($_COOKIE['duurCounter'] % 2) === 1) {
        $movies = $pdo->prepare("SELECT * FROM media WHERE media_type = 'film' ORDER BY length_in_minutes DESC");
        $movies->execute();
        $movies->setFetchMode(PDO::FETCH_ASSOC);
    } else {
        $movies = $pdo->prepare("SELECT * FROM media WHERE media_type = 'film' ORDER BY length_in_minutes ASC");
        $movies->execute();
        $movies->setFetchMode(PDO::FETCH_ASSOC);
    }
}
if (!isset($movies)) {
    $movies = $pdo->prepare("SELECT * FROM media WHERE media_type = 'film'");        //default query for movies   
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
                        <form action="detail.php" method="POST">
                            <input type="hidden" name="postMedia" value="<?= $serie['id'] ?>">
                            <input type="submit" value="bekijk details">
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
    <div class="new">
        <form action="insert.php" method="POST">
            <input type="submit" value="Voeg Serie Toe">
        </form>
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
                        <form action="detail.php" method="POST">
                            <input type="hidden" name="postMedia" value="<?= $movie['id'] ?>">
                            <input type="submit" value="bekijk details">
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>

    <div class="new">
        <form action="insert.php" method="POST">
            <input type="submit" value="Voeg Film Toe">
        </form>
    </div>

</body>

</html>