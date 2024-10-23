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

    if (isset($_POST['postFilm'])) {
        $serieId = $_POST['postFilm'];
        $serie = $pdo->prepare("SELECT * FROM `movies` WHERE id = :id");     //imports all the data from the right movie
        $serie->bindParam(':id', $serieId);
        $serie->execute();
        $detail = $serie->fetch();
    } else {
        echo "Help :<";
    }
} catch (PDOException $e) {
    echo "Connection Failed";
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
    <div class="info">
        <h3><?php echo $detail['title']; ?></h3>
        <table>
            <tr>
                <th>Information</th>
                <th>Information</th>
            </tr>
            <tr>
                <td>Datum van uitkomst</td>
                <td><?php echo $detail['released_at'] ?>
            </tr>
            <tr>
                <td>Land van uitkomst</td>
                <td><?php echo $detail['country_of_origin'] ?>
            </tr>
            <tr>
                <td>Duur</td>
                <td><?php echo $detail['length_in_minutes'] . " minuten" ?>
            </tr>
        </table>
    </div>
    <div class="details">
        <h3>Beschrijving</h3>
        <p class="summary"><?php echo $detail['summary'] ?></p>
    </div>
    <div class="trailer">
        <iframe width="420" height="315" <?php echo "src='https://www.youtube.com/embed/" . $detail['youtube_trailer_id'] . "'" ?>>
        </iframe>             <!-- appends youtube trailer id to the link -->
    </div>
</body>

</html>