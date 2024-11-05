<!DOCTYPE html>
<html lang="nl">

<head>
    <title>READ</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php
    require_once 'connection.php';
    ?>

    <div class="box1">
        <?php

        try {         //execute query to get data
            $sql = "SELECT mountains.m_name as mountain, challenges.name as name, challenge_types.ct_name as 'challenge type', challenges.bronze as bronze, challenges.silver as silver, challenges.gold as gold, challenges.dd as dd, challenges.td as td
                    FROM challenges
                    INNER JOIN mountains ON mountains.m_id=challenges.m_id
                    INNER JOIN challenge_types ON challenge_types.ct_id=challenges.ct_id;";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $raw_data = $stmt->fetchAll();

            $sql = "SELECT COUNT(distinct m_id) as 'unique mountains' FROM challenges;";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $unique = $stmt->fetchAll();

            $amount_of_unique_mountains = strval($unique[0]['unique mountains']);

            $sql = "SELECT * FROM mountains LIMIT $amount_of_unique_mountains;";  //variable of amount of mountains that have content to show
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $unique2 = $stmt->fetchAll();
        } catch (PDOException $e) {
            echo "Help :( $e";
        }

        ?>

        <div class="read">
            <h2>Currently Added Challenges!</h2>
            <?php
            $unique = $unique[0];
            for ($m = 0; $m < $unique['unique mountains']; $m++) {                     //loops as many times as there are unique mountains
                echo '<div class="mountain"><h4>' . $unique2[$m]['m_name'] . '</h4>';
            ?>

                <table>
                    <tr>
                        <th>Name</th>                <!-- this can be done with a loop too if I want -->
                        <th>Challenge Type</th>
                        <th>Bronze</th>
                        <th>Silver</th>
                        <th>Gold</th>
                        <th>DD</th>
                        <th>TD</th>
                    </tr>

                    <?php
                    foreach ($raw_data as $data) {
                        $data = array_values($data);                 //if a row is the same mountain as the current loop, it adds it
                        if ($data[0] == $unique2[$m]['m_name']) {
                            echo "<tr>";
                            for ($i = 1; $i < count($data); $i++) {
                                echo "<td>" . $data[$i] . "</td>";
                            }
                            echo "</tr>";
                        }
                    }
                    ?>
                </table>
            <?php
                echo '</div>';
            }
            ?>
        </div>
    </div>
</body>