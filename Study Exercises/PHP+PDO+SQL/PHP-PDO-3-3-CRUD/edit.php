<?php

$host = '127.0.0.1';
$db   = 'netland';
$user = 'bit_academy';
$pass = 'bit_academy';

$dsn = "mysql:host=localhost;dbname=netland;";

try {
    $pdo = new PDO($dsn, $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if (isset($_POST['editMedia'])) {   //from the detail page
        echo 'Is NIET aangepast';
        echo "media ID is " . $_POST['editMedia'];
        $mediaId = $_POST['editMedia'];
        $media = $pdo->prepare("SELECT * FROM `media` WHERE id = :id");     // from detail page
        $media->bindParam(':id', $mediaId);
        $media->execute();
        $detail = $media->fetch();
    } else if (isset($_POST['saveMedia'])) {   //from the edit page
        echo 'Is aangepast';
        echo $_POST['saveMedia']; //this is the ID
        echo $_POST['editTitel'];
        $sql = "UPDATE media SET title=?, rating=?, summary=?, has_won_awards=?, length_in_minutes=?,
        released_at=?, seasons=?, country=?, youtube_trailer_id=? WHERE id =?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            $_POST['editTitel'],
            $_POST['editRating'],
            $_POST['editDescrip'],
            $_POST['editAwards'],
            $_POST['editDuur'],                //upon refresh, it puts form data into query to change the row
            $_POST['editDatum'],
            $_POST['editSeasons'],
            $_POST['editLand'],
            $_POST['editYt'],
            $_POST['saveMedia'],
        ]);

        $mediaId = $_POST['saveMedia'];
        $media = $pdo->prepare("SELECT * FROM `media` WHERE id = :id");     // from detail page
        $media->bindParam(':id', $mediaId);
        $media->execute();
        $detail = $media->fetch();
    } else {
        echo "Help :<";
    }
} catch (PDOException $e) {
    echo "Connection Failed: " . $e;
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
        <form action="detail.php" method="POST">
            <input type="hidden" name="postMedia" value="<?= $detail['id'] ?>">
            <input type="submit" value="Terug">
        </form>
    </div>
    <div class="info">
        <form action="edit.php" method="POST">
            <table>
                <tr>
                    <th>Titel</th>
                    <td>
                        <input type="text" name='editTitel' value="<?= $detail['title'] ?>">
                    </td>
                </tr>
                <tr>
                    <th>Land van Uitkomst</th>
                    <td>
                        <input type="text" name='editLand' value="<?= $detail['country'] ?>">
                    </td>
                </tr>
                <tr>
                    <th>Omschrijving</th>
                    <td>
                        <textarea type="text" name='editDescrip'><?= $detail['summary'] ?></textarea>
                    </td>
                </tr>
                <tr>
                    <th>Rating</th>
                    <td>
                        <input type="text" name='editRating' value="<?= $detail['rating'] ?>">
                    </td>
                </tr>
                <tr>
                    <th>Seasons</th>
                    <td>
                        <input type="text" name='editSeasons' value="<?= $detail['seasons'] ?>">
                    </td>
                </tr>
                <tr>
                    <th>Duur</th>
                    <td>
                        <input type="text" name='editDuur' value="<?= $detail['length_in_minutes'] ?>">
                    </td>
                </tr>
                <tr>
                    <th>Datum van uitkomst</th>
                    <td>
                        <input type="date" name='editDatum' value="<?= $detail['released_at'] ?>">
                    </td>
                </tr>
                <tr>
                    <th>YouTube Trailer ID</th>
                    <td>
                        <input type="text" name='editYt' value='<?= $detail['youtube_trailer_id'] ?>'>
                    </td>
                </tr>
                <tr>
                    <th>Awards</th>
                    <td>
                        <input type="text" name='editAwards' value='<?= $detail['has_won_awards'] ?>'>
                    </td>
                </tr>
            </table>
            <input type="hidden" name="saveMedia" value="<?= $detail['id'] ?>">
            <input type='submit' value='Opslaan'>
        </form>
    </div>