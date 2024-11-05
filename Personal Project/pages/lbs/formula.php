<!-- formula testing area without imported data. First Turns data only -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grand Mountain Guide Home</title>
    <link rel="stylesheet" href="../../styles/style.css">
</head>

<body>
    <header class="headerflex">
        <a href="index.php">
            <img src="../../external/imgs/CatBlush.png" alt="cat" title="cat">
        </a>
        <h1 class="lobster">Grand Mountain Adventure</h1>
        <p class="invis"></p>
    </header>
    <nav class="navflex">
        <ul>
            <li><a href="../home/index.php">Home</a></li>
            <li><a class="activenav" href="../lbs/leaderboards.php">Leaderboards</a></li>
            <li><a href="../maps/maps.php">Mountain Maps</a></li>
            <li><a href="../tnt/tnt.php">Tips and Tricks</a></li>
            <li><a href="../socials/socials.php">Socials</a></li>
        </ul>
        <ul>
            <li><a href="#login">Login/Register</a></li>
        </ul>
    </nav>
    <main>

        <h1>First Turns</h1>
        <?php

        $wr = 26.99;
        $td = 28.00;

        $ft = array(
            array("BouncyJello", 26.99),
            array("hschindele", 27.12),
            array("Gjeep302", 27.32),
            array("Ryan Monty", 27.39),
            array("Skier50", 27.43),
            array("Mountain_Greg", 27.47),
            array("Avel", 27.51),
            array("Foxster", 27.66),
            array("Jamiemac", 27.67),
            array("massiv97", 27.69),
            array("🍊Koolaid", 27.83),
            array("GSM", 27.97),
            array("Onihr_", 27.98),
            array("SYNO", 28.08),
            array("Pinsek", 28.36),
            array("eFrostyy", 28.41),
            array("Blair444A", 28.42),
            array("Susannah", 28.77),
            array("Chesty", 28.85),
            array("PelagusPlays", 29.43),
            array("Fenrir", 30.13),
            array("Slowpoke", 31.19)
        );

        function tmnf_default($array, $position, $time, $wr, $td)
        {
            $maxPoints = 50000;
            $maxPosPoints = 0.60 * $maxPoints;
            $maxTimePoints = 0.25 * $maxPoints;
            $maxBonusPoints = 0.15 * $maxPoints;

            //position points
            //       ((n-x+1)/n)^(ln(n/10 + 2)^1.5 + 1)
            // where n - total amount of PBs, x - your position
            $n = count($array);
            $x = $position;
            $posPointMultiplier = pow((($n - $x + 1) / $n), pow(log($n / 10 + 2), 1.5) + 1);
            $posPointResult = $posPointMultiplier * $maxPosPoints;
            $posPointResult = round($posPointResult);

            //time points
            // ((top10%-pb) / (top10%-wr))     * 0.5   + 0.5   if in top 10%,
            // ((top40%-pb) / (top40%-top10%)) * 0.45  + 0.05  if in top 40%,
            // ((top70%-pb) / (top70%-top40%)) * 0.045 + 0.005 if in top 70%,
            // ((top90%-pb) / (top90%-top70%)) * 0.005         if in top 90%,
            //                               0                 if placed lower
            $wr = $wr;
            $pb = $time;
            $timePointMultiplier = 0; //default
            $topTenPercent = $array[(round(0.1 * $n) - 1)][1];  // 21 * 0.1 = 2.1 = 2nd place score = 27.32
            $topFortyPercent = $array[(round(0.4 * $n) - 1)][1];  // 21 * 0.4 = 8.4 = 8th place score = 27.67
            $topSeventyPercent = $array[(round(0.7 * $n) - 1)][1];  // 21 * 0.7 = 14.7 = 15th place score = 28.41
            $topNinetyPercent = $array[(round(0.9 * $n) - 1)][1];  //21 * 0.9 = 18.9 = 19th place score = 28.85

            if ($pb <= $topTenPercent) {
                $timePointMultiplier = (($topTenPercent - $pb) / ($topTenPercent - $wr)) * 0.5 + 0.5;
            } else if ($pb > $topTenPercent && $pb <= $topFortyPercent) {
                $timePointMultiplier = (($topFortyPercent - $pb) / ($topFortyPercent - $topTenPercent)) * 0.45 + 0.05;
            } else if ($pb > $topFortyPercent && $pb <= $topSeventyPercent) {
                $timePointMultiplier = (($topSeventyPercent - $pb) / ($topSeventyPercent - $topFortyPercent)) * 0.045 + 0.005;
            } else if ($pb > $topSeventyPercent && $pb <= $topNinetyPercent) {
                $timePointMultiplier = (($topNinetyPercent - $pb) / ($topNinetyPercent - $topSeventyPercent)) * 0.005;
            } else {
                $timePointMultiplier = 0;
            }
            $timePointResult = $timePointMultiplier * $maxTimePoints;
            $timePointResult = round($timePointResult);

            //bonus points
            $bonusPointMultiplier = 0; //default
            if ($pb == $array[0][1]) {
                $bonusPointMultiplier = 1;   //1st
            } else if ($pb == $array[1][1]) {
                $bonusPointMultiplier = 0.6;  //2nd
            } else if ($pb == $array[2][1]) {
                $bonusPointMultiplier = 0.4;  //3rd
            } else if ($pb == $array[3][1]) {
                $bonusPointMultiplier = 0.3;  //4th
            } else if ($pb == $array[4][1]) {
                $bonusPointMultiplier = 0.2;  //5th
            } else if ($position >= 6 && $position <= 8) {
                $bonusPointMultiplier = 0.1;  //6-8th
            } else if ($position >= 9 && $position <= 15) {
                $bonusPointMultiplier = 0.05;  //9-15th
            } else if ($position > 15 && $pb < $td) {
                $bonusPointMultiplier = 0.03;  //higher than 15th place, but better than TD
            }
            $bonusPointResult = $bonusPointMultiplier * $maxBonusPoints;
            $bonusPointResult = round($bonusPointResult);

            $totalPointResult = $posPointResult + $timePointResult + $bonusPointResult;
            return $totalPointResult;
        }
















        function tmnf_pos_unchanged($array, $position, $time, $wr, $td)
        {
            $maxPoints = 50000;
            $maxPosPoints = 0.60 * $maxPoints;
            $maxTimePoints = 0.25 * $maxPoints;
            $maxBonusPoints = 0.15 * $maxPoints;

            //position points
            //       ((n-x+1)/n)^(ln(n/10 + 2)^1.5 + 1)
            // where n - total amount of PBs, x - your position
            $n = count($array);
            $x = $position;
            $posPointMultiplier = pow((($n - $x + 1) / $n), pow(log($n / 10 + 2), 1.5) + 1);
            $posPointResult = $posPointMultiplier * $maxPosPoints;
            $posPointResult = round($posPointResult);

            $tmnf_pos_unchanged_return[0] = $posPointResult;
            $tmnf_pos_unchanged_return[1] = round(($posPointResult / $maxPosPoints) * 100);
            return $tmnf_pos_unchanged_return;
        }

        function tmnf_time_unchanged($array, $position, $time, $wr, $td)
        {
            $maxPoints = 50000;
            $maxPosPoints = 0.60 * $maxPoints;
            $maxTimePoints = 0.25 * $maxPoints;
            $maxBonusPoints = 0.15 * $maxPoints;

            //time points
            // ((top10%-pb) / (top10%-wr))     * 0.5   + 0.5   if in top 10%,
            // ((top40%-pb) / (top40%-top10%)) * 0.45  + 0.05  if in top 40%,
            // ((top70%-pb) / (top70%-top40%)) * 0.045 + 0.005 if in top 70%,
            // ((top90%-pb) / (top90%-top70%)) * 0.005         if in top 90%,
            //                               0                 if placed lower
            $wr = $wr;
            $pb = $time;
            $n = count($array);
            $timePointMultiplier = 0; //default
            $topTenPercent = $array[(round(0.1 * $n) - 1)][1];  // 21 * 0.1 = 2.1 = 2nd place score = 27.32
            $topFortyPercent = $array[(round(0.4 * $n) - 1)][1];  // 21 * 0.4 = 8.4 = 8th place score = 27.67
            $topSeventyPercent = $array[(round(0.7 * $n) - 1)][1];  // 21 * 0.7 = 14.7 = 15th place score = 28.41
            $topNinetyPercent = $array[(round(0.9 * $n) - 1)][1];  //21 * 0.9 = 18.9 = 19th place score = 28.85

            if ($pb <= $topTenPercent) {
                $timePointMultiplier = (($topTenPercent - $pb) / ($topTenPercent - $wr)) * 0.5 + 0.5;
            } else if ($pb > $topTenPercent && $pb <= $topFortyPercent) {
                $timePointMultiplier = (($topFortyPercent - $pb) / ($topFortyPercent - $topTenPercent)) * 0.45 + 0.05;
            } else if ($pb > $topFortyPercent && $pb <= $topSeventyPercent) {
                $timePointMultiplier = (($topSeventyPercent - $pb) / ($topSeventyPercent - $topFortyPercent)) * 0.045 + 0.005;
            } else if ($pb > $topSeventyPercent && $pb <= $topNinetyPercent) {
                $timePointMultiplier = (($topNinetyPercent - $pb) / ($topNinetyPercent - $topSeventyPercent)) * 0.005;
            } else {
                $timePointMultiplier = 0;
            }
            $timePointResult = $timePointMultiplier * $maxTimePoints;
            $timePointResult = round($timePointResult);

            $tmnf_time_unchanged_return[0] = $timePointResult;
            $tmnf_time_unchanged_return[1] = round(($timePointResult / $maxTimePoints) * 100);
            return $tmnf_time_unchanged_return;
        }

        function tmnf_bonus_unchanged($array, $position, $time, $wr, $td)
        {
            $maxPoints = 50000;
            $maxPosPoints = 0.60 * $maxPoints;
            $maxTimePoints = 0.25 * $maxPoints;
            $maxBonusPoints = 0.15 * $maxPoints;
            $pb = $time;
            //bonus points
            $bonusPointMultiplier = 0; //default
            if ($pb == $array[0][1]) {
                $bonusPointMultiplier = 1;   //1st
            } else if ($pb == $array[1][1]) {
                $bonusPointMultiplier = 0.6;  //2nd
            } else if ($pb == $array[2][1]) {
                $bonusPointMultiplier = 0.4;  //3rd
            } else if ($pb == $array[3][1]) {
                $bonusPointMultiplier = 0.3;  //4th
            } else if ($pb == $array[4][1]) {
                $bonusPointMultiplier = 0.2;  //5th
            } else if ($position >= 6 && $position <= 8) {
                $bonusPointMultiplier = 0.1;  //6-8th
            } else if ($position >= 9 && $position <= 15) {
                $bonusPointMultiplier = 0.05;  //9-15th
            } else if ($position > 15 && $pb < $td) {
                $bonusPointMultiplier = 0.03;  //higher than 15th place, but better than TD
            }
            $bonusPointResult = $bonusPointMultiplier * $maxBonusPoints;
            $bonusPointResult = round($bonusPointResult);

            $tmnf_bonus_unchanged_return[0] = $bonusPointResult; //value
            $tmnf_bonus_unchanged_return[1] = round(($bonusPointResult / $maxBonusPoints) * 100);

            return $tmnf_bonus_unchanged_return;
        }

        function tmnf_total_unchanged($array, $position, $time, $wr, $td)
        {
            $resPos = tmnf_pos_unchanged($array, $position, $time, $wr, $td);
            $resTime = tmnf_time_unchanged($array, $position, $time, $wr, $td);
            $resBonus = tmnf_bonus_unchanged($array, $position, $time, $wr, $td);


            $tmnf_total_unchanged = $resPos[0] + $resTime[0] + $resBonus[0];
            $tmnf_total_unchanged_return[0] = $tmnf_total_unchanged;

            $maxPoints = 50000;
            $tmnf_total_unchanged_percentage = round(($tmnf_total_unchanged / $maxPoints) * 100);
            $tmnf_total_unchanged_return[1] = $tmnf_total_unchanged_percentage;

            return $tmnf_total_unchanged_return;
        }













        function tmnf_pos_changed($array, $position, $time, $wr, $td)
        {
            $maxPoints = 50000;
            $maxPosPoints = 0.25 * $maxPoints;

            //position points
            //       ((n-x+1)/n)^(ln(n/10 + 2)^1.5 + 1)
            // where n - total amount of PBs, x - your position
            $n = count($array);
            $x = $position;
            $posPointMultiplier = pow((($n - $x + 1) / $n), pow(log($n / 10 + 2), 1.5) + 1);
            $posPointResult = $posPointMultiplier * $maxPosPoints;
            $posPointResult = round($posPointResult);

            $tmnf_pos_changed_return[0] = $posPointResult;
            $tmnf_pos_changed_return[1] = round(($posPointResult / $maxPosPoints) * 100);
            return $tmnf_pos_changed_return;
        }

        function tmnf_time_changed($array, $position, $time, $wr, $td)
        {
            $maxPoints = 50000;
            $maxTimePoints = 0.60 * $maxPoints;

            //time points
            // ((top10%-pb) / (top10%-wr))     * 0.5   + 0.5   if in top 10%,
            // ((top40%-pb) / (top40%-top10%)) * 0.45  + 0.05  if in top 40%,
            // ((top70%-pb) / (top70%-top40%)) * 0.045 + 0.005 if in top 70%,
            // ((top90%-pb) / (top90%-top70%)) * 0.005         if in top 90%,
            //                               0                 if placed lower
            $wr = $wr;
            $pb = $time;
            $n = count($array);
            $timePointMultiplier = 0; //default
            $topTenPercent = $array[(round(0.1 * $n) - 1)][1];  // 21 * 0.1 = 2.1 = 2nd place score = 27.32
            $topFortyPercent = $array[(round(0.4 * $n) - 1)][1];  // 21 * 0.4 = 8.4 = 8th place score = 27.67
            $topSeventyPercent = $array[(round(0.7 * $n) - 1)][1];  // 21 * 0.7 = 14.7 = 15th place score = 28.41
            $topNinetyPercent = $array[(round(0.9 * $n) - 1)][1];  //21 * 0.9 = 18.9 = 19th place score = 28.85
            $topHundredPercent = $array[(round(1 * $n) - 1)][1];

            if ($pb <= $topHundredPercent) {
                $timePointMultiplier = (($topHundredPercent - $pb) / ($topHundredPercent - $wr)) * 0.5 + 0.5;
            }

            $timePointResult = $timePointMultiplier * $maxTimePoints;
            $timePointResult = round($timePointResult);

            $tmnf_time_changed_return[0] = $timePointResult;
            $tmnf_time_changed_return[1] = round(($timePointResult / $maxTimePoints) * 100);
            return $tmnf_time_changed_return;
        }

        function tmnf_bonus_changed($array, $position, $time, $wr, $td)
        {
            $maxPoints = 50000;
            $maxBonusPoints = 0.15 * $maxPoints;
            $pb = $time;
            //bonus points
            $bonusPointMultiplier = 0; //default
            if ($pb == $array[0][1]) {
                $bonusPointMultiplier = 1;   //1st
            } else if ($pb == $array[1][1]) {
                $bonusPointMultiplier = 0.6;  //2nd
            } else if ($pb == $array[2][1]) {
                $bonusPointMultiplier = 0.4;  //3rd
            } else if ($pb == $array[3][1]) {
                $bonusPointMultiplier = 0.3;  //4th
            } else if ($pb == $array[4][1]) {
                $bonusPointMultiplier = 0.2;  //5th
            } else if ($position >= 6 && $position <= 8) {
                $bonusPointMultiplier = 0.1;  //6-8th
            } else if ($position >= 9 && $position <= 15) {
                $bonusPointMultiplier = 0.05;  //9-15th
            } else if ($position > 15 && $pb < $td) {
                $bonusPointMultiplier = 0.03;  //higher than 15th place, but better than TD
            }
            $bonusPointResult = $bonusPointMultiplier * $maxBonusPoints;
            $bonusPointResult = round($bonusPointResult);

            $tmnf_bonus_changed_return[0] = $bonusPointResult; //value
            $tmnf_bonus_changed_return[1] = round(($bonusPointResult / $maxBonusPoints) * 100);

            return $tmnf_bonus_changed_return;
        }

        function tmnf_total_changed($array, $position, $time, $wr, $td)
        {
            $resPos = tmnf_pos_changed($array, $position, $time, $wr, $td);
            $resTime = tmnf_time_changed($array, $position, $time, $wr, $td);
            $resBonus = tmnf_bonus_changed($array, $position, $time, $wr, $td);

            $tmnf_total_changed = $resPos[0] + $resTime[0] + $resBonus[0];
            $tmnf_total_changed_return[0] = $tmnf_total_changed;

            $maxPoints = 50000;
            $tmnf_total_changed_percentage = round(($tmnf_total_changed / $maxPoints) * 100);
            $tmnf_total_changed_return[1] = $tmnf_total_changed_percentage;

            return $tmnf_total_changed_return;
        }

        ?>

        <table>
            <tr>
                <th>Position</th>
                <th>Name</th>
                <th>Time</th>
                <th>Score (Goldeneye)</th>
                <th>Score (TMNF Unchanged)</th>
                <th>Empty ;)</th>
                <th>TMNF Unchanged Pos (60%)</th>
                <th>TMNF Unchanged Time (25%)</th>
                <th>TMNF Unchanged Bonus (15%)</th>
                <th>(Changed?) Total</th>
            </tr>
            <?php
            //foreach entry, create row with content
            for ($i = 0; $i < count($ft); $i++) {
                echo '<tr>';
                echo '<th>' . $i + 1 . '</th>';
                echo '<td>' . $ft[$i][0] . '</td>';
                echo '<td>' . $ft[$i][1] . '</td>';
                //goldeneye unchanged
                if ($i + 1 == 1) {
                    echo '<td>100</td>';
                } elseif ($i + 1 == 2) {
                    echo '<td>97</td>';
                } elseif ($i + 1 == 3) {
                    echo '<td>95</td>';
                } else {
                    $j = $i;
                    $j = 97 - $j;
                    echo '<td>' . $j . '</td>';
                }

                //tmnf unchanged total
                echo '<td>' . tmnf_default($ft, $i + 1, $ft[$i][1], $wr, $td) . '</td>';
                echo '<td></td>';

                //tmnf position
                $res = tmnf_pos_unchanged($ft, $i + 1, $ft[$i][1], $wr, $td);
                echo '<td>' . $res[0] . '</td>';

                //tmnf time
                $res = tmnf_time_unchanged($ft, $i + 1, $ft[$i][1], $wr, $td);
                echo '<td>' . $res[0] . '</td>';

                //tmnf bonus
                $res = tmnf_bonus_unchanged($ft, $i + 1, $ft[$i][1], $wr, $td);
                echo '<td>' . $res[0] . '</td>';

                //tmnf (changed?) total
                $res = tmnf_total_unchanged($ft, $i + 1, $ft[$i][1], $wr, $td);
                echo '<td>' . $res[0] . '</td>';
                echo '</tr>';
            }
            ?>
        </table>
        <br><br>
        <h1>First Turns (TMNF Formula Testing Area)</h1>
        <table>
            <tr>
                <th>Pos</th>
                <th>Name</th>
                <th>Time</th>
                <th>Total Unchanged (100%)</th>
                <th>
                    < % diff</th>
                <th>Total Changed!!! (100%)</th>
                <th>
                    < % diff</th>
                <th></th>
                <th>Position Unchanged (60%)</th>
                <th>
                    < % diff</th>
                <th>Position (Changed?)(25%)</th>
                <th>
                    < % diff</th>
                <th></th>
                <th>Time Unchanged (25%)</th>
                <th>
                    < % diff</th>
                <th>Time Changed (Non-Ladder) (60%)</th>
                <th>
                    < % diff</th>
                <th></th>
                <th>Bonus Unchanged (15%)</th>
                <th>
                    < % diff</th>
                <th>Bonus (Changed?) (15%)</th>
                <th>
                    < % diff</th>
            </tr>
            <?php
            //foreach entry, create row with content
            for ($i = 0; $i < count($ft); $i++) {
                echo '<tr>';
                echo '<th>' . $i + 1 . '</th>';  //pos
                echo '<th>' . $ft[$i][0] . '</th>'; //name
                echo '<th>' . $ft[$i][1] . '</th>'; //time

                $res = tmnf_total_unchanged($ft, $i + 1, $ft[$i][1], $wr, $td);
                echo '<td>' . $res[0] . '</td>';    //total unchanged
                echo '<td>' . $res[1] . '</td>';    //total unchanged %

                $res = tmnf_total_changed($ft, $i + 1, $ft[$i][1], $wr, $td);
                echo '<td>' . $res[0] . '</td>';    //total changed
                echo '<td>' . $res[1] . '</td>';    //total changed %

                echo '<td></td>';

                $res = tmnf_pos_unchanged($ft, $i + 1, $ft[$i][1], $wr, $td);
                echo '<td>' . $res[0] . '</td>';    //position unchanged
                echo '<td>' . $res[1] . '</td>';    //position unchanged %

                $res = tmnf_pos_changed($ft, $i + 1, $ft[$i][1], $wr, $td);
                echo '<td>' . $res[0] . '</td>';    //position changed
                echo '<td>' . $res[1] . '</td>';    //position changed %

                echo '<td></td>';

                $res = tmnf_time_unchanged($ft, $i + 1, $ft[$i][1], $wr, $td);
                echo '<td>' . $res[0] . '</td>';    //time unchanged
                echo '<td>' . $res[1] . '</td>';    //time unchanged %

                $res = tmnf_time_changed($ft, $i + 1, $ft[$i][1], $wr, $td);
                echo '<td>' . $res[0] . '</td>';    //time changed
                echo '<td>' . $res[1] . '</td>';    //time changed %

                echo '<td></td>';

                $res = tmnf_bonus_unchanged($ft, $i + 1, $ft[$i][1], $wr, $td);
                echo '<td>' . $res[0] . '</td>';    //bonus unchanged
                echo '<td>' . $res[1] . '</td>';    //bonus unchanged %

                $res = tmnf_bonus_changed($ft, $i + 1, $ft[$i][1], $wr, $td);
                echo '<td>' . $res[0] . '</td>';    //bonus changed
                echo '<td>' . $res[1] . '</td>';    //bonus changed %

                echo '</tr>';
            }
            ?>
        </table>
    </main>
    <footer>
        <h1>FOOTER</h1>
    </footer>
</body>

</html>