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

    if (isset($_POST['postSerie'])) {
        $serieId = $_POST['postSerie'];
        $serie = $pdo->prepare("SELECT * FROM `series` WHERE id = :id");    //imports the data from the right show
        $serie->bindParam(':id', $serieId);
        $serie->execute();
        $detail = $serie->fetch();
    } else {
        echo "Help :<";
    }
} catch (PDOException $e) {
    echo "Connection Failed: " . $e->getMessage();
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
                <td>Awards</td>
                <td>
                    <?php
                    if ($detail['has_won_awards'] == '1') {    //uses boolean to echo yes or no
                        echo 'Ja';
                    } else {
                        echo 'No';
                    }
                    ?>
                </td>
            </tr>
            <tr>
                <td>Seasons</td>
                <td><?php echo $detail['seasons'] ?>
            </tr>
            <tr>
                <td>Country</td>
                <td><?php echo $detail['country'] ?>
            </tr>
            <tr>
                <td>Language</td>
                <td><?php echo $detail['spoken_in_language'] ?>
            </tr>
            <tr>
                <td>Rating</td>
                <td><?php echo $detail['rating'] ?>
            </tr>
        </table>
    </div>
    <div class="details">
        <h3>Beschrijving</h3>
        <p class="summary"><?php echo $detail['summary'] ?></p>
    </div>
</body>

</html>