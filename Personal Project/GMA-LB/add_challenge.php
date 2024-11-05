<!DOCTYPE html>
<html lang="nl">

<head>
    <title>ADD C</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php
    require_once 'connection.php';
    ?>
    <div class="box1">
        <?php

        try {
            $sql = "SELECT mountains.m_id as id, mountains.m_name as name, games.name as game
                        FROM mountains
                        INNER JOIN games ON mountains.game_id=games.g_id;";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);           //this one loads in mountain dropdown
            $m_drop = $stmt->fetchAll();
            // echo 'm_drop loaded!';
        } catch (PDOException $e) {
            echo "Can't retrieve m dropdowns $e";
        }

        try {
            $sql = "SELECT challenge_types.ct_id as id, challenge_types.ct_name as name FROM challenge_types;";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);           //this one loads in challenge type dropdown
            $ct_drop = $stmt->fetchAll();
            // echo 'ct_drop loaded!';
        } catch (PDOException $e) {
            echo "Can't retrieve 'ct' dropdown $e";
        }

        try {                                              //this one loads in delete dropdown
            $sql = "SELECT challenges.c_id as id, challenges.name as name, mountains.m_name as mountain
                    FROM challenges
                    INNER JOIN mountains ON mountains.m_id=challenges.m_id;";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);           //this one loads in mountain dropdown
            $del_drop = $stmt->fetchAll();
            // echo 'del_drop loaded!';
        } catch (PDOException $e) {
            echo "Can't retrieve 'delete' dropdown $e";
        }

        if (isset($_POST["submit_add"])) {         //upon refresh, checks if post is submitted
            try {
                $sql = "SELECT COUNT(ct_id) FROM challenges;";
                $stmt = $pdo->prepare($sql);
                $stmt->execute();
                $stmt->setFetchMode(PDO::FETCH_ASSOC);      //this one counts the amount of existing challenges so I don't have to auto_increment
                $result = $stmt->fetchAll();                //for the sake of id continuity when entries are deleted
                foreach ($result as $res) {
                    $c_id = 1 + $res['COUNT(ct_id)'];       //when adding SQL query function, if you want to replace this bit
                }                                           //make sure to take the foreach out and untangle the nested arrays after the function
                var_dump($c_id);                            //shows number of total challenges in DB
            } catch (PDOException $e) {
                echo "Wtf is a database anyway? $e";
            }

            $null_scores = array($_POST["bronze"],
            $_POST["silver"],                        //if NULL, turn string into NULL value for the post
            $_POST["gold"],                          //with array of the 5 parameters, if possible
            $_POST["dd"],
            $_POST["td"]);

            for ($l=0; $l < count($null_scores); $l++) { 
                if ($null_scores[$l] == '') {
                    // echo 'Null detected in key ' . $l . ' ';
                    $null_scores[$l] = NULL;
                }
            }

            try {
                $sql = 'INSERT INTO challenges (c_id, m_id, ct_id, name, bronze, silver, gold, dd, td) VALUES (?,?,?,?,?,?,?,?,?);';
                $stmt = $pdo->prepare($sql);
                $stmt->execute([
                    $c_id,
                    $_POST["m_id"],
                    $_POST["ct_id"],
                    $_POST["c_name"],                  //inserts variables from post into query
                    $null_scores[0],
                    $null_scores[1],
                    $null_scores[2],
                    $null_scores[3],
                    $null_scores[4]
                ]);
                echo "Challenge added successfully!";
            } catch (PDOException $e) {
                echo "You're a failure" . $e->getMessage();
            }
        }

        if (isset($_POST['submit_del'])) {
            try {
                $sql = 'DELETE FROM challenges WHERE c_id=?;';
                $stmt = $pdo->prepare($sql);
                $stmt->execute([
                    $_POST['del']
                ]);
                echo "Deleted successfully!";
            } catch (PDOException $e) {
                echo "Delete failed $e";
            }
        }

        ?>
        <div class="box2">
            <div class="add">
                <h2>Add Challenge</h2>
                <form action="add_challenge.php" method="POST">
                    Mountain ID:<br>

                    <select name="m_id">
                        <?php
                        foreach ($m_drop as $mountain) {
                            echo "<option value='" . $mountain['id'] . "'>" . $mountain['name'] . " - " . $mountain['game'] . "</option>";
                        }
                        ?>
                    </select><br><br>
                    Challenge Type:<br>
                    <select name="ct_id">
                        <?php
                        foreach ($ct_drop as $ct) {
                            echo "<option value='" . $ct['id'] . "'>" . $ct['name'] . "</option>";
                        }
                        ?>
                    </select><br><br>
                    Challenge Name:<br>
                    <input type="text" name="c_name"><br><br>
                    Bronze:<br>
                    <input type="text" name="bronze"><br><br>
                    Silver:<br>
                    <input type="text" name="silver"><br><br>
                    Gold:<br>
                    <input type="text" name="gold"><br><br>
                    DD:<br>
                    <input type="text" name="dd"><br><br>
                    TD:<br>
                    <input type="text" name="td"><br><br>
                    <input type="submit" name="submit_add" value="Add">
                </form>
            </div>
            <div class="delete">
                <h2>Delete Challenge</h2>
                <form action="add_challenge.php" method="POST">
                    <select name='del'>
                        <?php
                        foreach ($del_drop as $del) {
                            echo "<option value='" . $del['id'] . "'>" . $del['id'] . ' - ' . $del['name'] . ' - ' . $del['mountain'] . "</option>";
                        }
                        ?>
                    </select><br><br>
                    <input type="submit" name="submit_del" value="Delete">
                </form>
            </div>
        </div>
    </div>
</body>

</html>