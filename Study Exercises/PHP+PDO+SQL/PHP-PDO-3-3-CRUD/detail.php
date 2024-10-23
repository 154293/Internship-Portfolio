<?php

$host = '127.0.0.1';
$db   = 'netland';
$user = 'bit_academy';
$pass = 'bit_academy';

$dsn = "mysql:host=localhost;dbname=netland;";

try {
    $pdo = new PDO($dsn, $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if (isset($_POST['postMedia'])) {
        // echo "media ID is " . $_POST['postMedia'];              //echo to see if I'm working with the right ID
        $mediaId = $_POST['postMedia'];
        $media = $pdo->prepare("SELECT * FROM `media` WHERE id = :id");     // from detailpage
        $media->bindParam(':id', $mediaId);
        $media->execute();
        $detail = $media->fetch();
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
    <div class="title">
        <form action="index.php" method="POST">
            <input type="hidden" name="postMedia" value="<?= $detail['id'] ?>">
            <input type="submit" value="Terug">
        </form>
    </div>
    <div class="info">
        <h3><?php echo $detail['title']; ?></h3>
        <table>
            <tr>
                <th>Information</th>
                <th>Information</th>
            </tr>
            <tr>
                <td>Rating</td>
                <td><?php echo $detail['rating'] ?>
            </tr>
            <tr>
                <td>Land van uitkomst</td>
                <td><?php echo $detail['country'] ?>
            </tr>
            <tr>
                <td>Awards</td>
                <td>
                    <?php
                    if ($detail['has_won_awards'] == '1') {
                        echo 'Ja';
                    } else {
                        echo 'No';
                    }
                    ?>
                </td>
            </tr>
            <tr>
                <td>Duur</td>
                <td>
                    <?php
                    if (isset($detail['length_in_minutes'])) {
                        echo $detail['length_in_minutes'] . ' minuten';
                    }
                    ?>
                </td>
            </tr>
            <tr>
                <td>Datum van uitkomst</td>
                <td><?php echo $detail['released_at'] ?>
            </tr>
        </table>
    </div>
    <div class="details">
        <h3>Beschrijving</h3>
        <p class="summary"><?php echo $detail['summary'] ?></p>
    </div>
    <div class="trailer">
        <?php
        if (isset($detail['youtube_trailer_id'])) {
            echo '<iframe width="420" height="315" src="https://www.youtube.com/embed/' . $detail['youtube_trailer_id'] . '"';
            echo '</iframe>';
        }
        ?> 
    </div>
    <div class="edit">
        <form action="edit.php" method="POST">
            <input type="hidden" name="editMedia" value="<?= $detail['id'] ?>">
            <input type="submit" value="Edit Media">
        </form>
    </div>
</body>

</html>