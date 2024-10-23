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

    if (isset($_POST['addMedia'])) {
        echo 'Serie Toegevoegd!';
        $sql = "INSERT INTO media (media_type, title, rating, summary, has_won_awards,
        length_in_minutes, released_at, seasons, country, youtube_trailer_id) VALUES (?,?,?,?,?,?,?,?,?,?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            $_POST['addMediaType'],
            $_POST['addTitel'],                   //upon refresh, it puts the form info into query to be added
            $_POST['addRating'],
            $_POST['addDescrip'],
            $_POST['addAwards'],
            $_POST['addDuur'],
            $_POST['addDatum'],
            $_POST['addSeasons'],
            $_POST['addLand'],
            $_POST['addYt']
        ]);
    }
} catch (PDOException $e) {
    echo "Connection Failed $e";
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
            <input type="submit" value="Terug">
        </form>
    </div>
    <div class="add">
        <h1>Voeg Media Toe</h1>
        <form action='insert.php' method='POST' id='addMedia'>             <!-- form to add media -->
            <table>
                <tr>
                    <th>Titel</th>
                    <td>
                        <input type="text" name='addTitel'>
                    </td>
                </tr>
                <tr>
                    <th>Land van Uitkomst</th>
                    <td>
                        <input type="text" name='addLand'>
                    </td>
                </tr>
                <tr>
                    <th>Omschrijving</th>
                    <td>
                        <textarea type="text" name='addDescrip'></textarea>
                    </td>
                </tr>
                <tr>
                    <th>Rating</th>
                    <td>
                        <input type="text" name='addRating'>
                    </td>
                </tr>
                <tr>
                    <th>Seasons</th>
                    <td>
                        <input type="text" name='addSeasons'>
                    </td>
                </tr>
                <tr>
                    <th>Duur</th>
                    <td>
                        <input type="text" name='addDuur'>
                    </td>
                </tr>
                <tr>
                    <th>Datum van uitkomst</th>
                    <td>
                        <input type="date" name='addDatum'>
                    </td>
                </tr>
                <tr>
                    <th>YouTube Trailer ID</th>
                    <td>
                        <input type="text" name='addYt'>
                    </td>
                </tr>
                <tr>
                    <th>Awards</th>
                    <td>
                        <input type="text" name='addAwards'>
                    </td>
                </tr>
                <tr>
                    <th>Media Type</th>
                    <td>
                        <select name='addMediaType' form='addMedia'>
                            <option value="serie">Serie</option>
                            <option value="film">Film</option>
                        </select>
                    </td>
                </tr>
            </table>
            <input type='submit' name='addMedia' value="Toevoegen">
        </form>
    </div>