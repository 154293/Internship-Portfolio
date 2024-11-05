<div class="lbvert">
    <div class="lbheader">
        <?php echo '<h1>' . $_COOKIE['map'] . ' Classic WR Home</h1>'; ?>
    </div>
    <div>
        <?php echo '<h3>Latest ' . $_COOKIE['map'] . ' Records</h3>' ?>
        <table>
            <tr>
                <th>Name</th>
                <th>Track</th>
                <th>Time / Score</th>
                <th>Date</th>
                <th>Time Set</th>
                <th>Improvement</th>
            </tr>

            <?php
            for ($x = 0; $x < 10; $x++) {
                echo '<tr>';
                echo '<td>bleep</td>';
                echo '<td>bloop</td>';
                echo '<td>blip</td>';
                echo '<td>blop</td>';
                echo '<td>blep</td>';
                echo '<td>blub</td>';
                echo '</tr>';
            }
            ?>
        </table>
    </div>
    <div class="lbhori">
        <div>
            <table>
                <tr>
                    <?php echo '<th colspan=2>' . $_COOKIE['map'] . ' WRs By Player</th>' ?>
                </tr>
                <tr>
                    <th>bleep</th>
                    <td>12</td>
                </tr>
                <tr>
                    <th>bloop</th>
                    <td>7</td>
                </tr>
                <tr>
                    <th>blip</th>
                    <td>5</td>
                </tr>
                <tr>
                    <th>blop</th>
                    <td>4</td>
                </tr>
                <tr>
                    <th>blep</th>
                    <td>3</td>
                </tr>
                <tr>
                    <th>blub</th>
                    <td>1</td>
                </tr>
            </table>
        </div>
        <div class="piechart">
            <h1>Pie Chart lol</h1>
        </div>
    </div>
    <div>
        <?php echo '<h3>' . $_COOKIE['map'] . ' WRs</h3>' ?>
        <table>
            <tr>
                <th>Challenge</th>
                <th>Time / Score</th>
                <th>Player</th>
                <th>Date</th>
            </tr>

            <?php
            for ($x = 0; $x < 10; $x++) {
                echo '<tr>';
                echo '<td>bleep</td>';
                echo '<td>bloop</td>';
                echo '<td>blip</td>';
                echo '<td>blop</td>';
                echo '</tr>';
            }
            ?>
            <tr>
                <td colspan=3 class="sum">Sum of Best:</td>
                <td>4:00.00</td>
            </tr>
        </table>
    </div>
    <div class="lbhori">
        <table>
            <tr>
                <th colspan=3><?php echo $_COOKIE['map'] . ' Overall Rating' ?></th>
            </tr>
            <tr>
                <th>Rank</th>
                <th>Name</th>
                <th>Rating</th>
            </tr>
            <?php
            for ($i = 1; $i <= 10; $i++) {
                echo '<tr>';
                echo '<td>' . $i . '</td>';
                echo '<td>player ' . $i . '</td>';
                echo '<td>score</td>';
            }
            ?>
        </table>
        <table>
            <tr>
                <th colspan=3><?php echo $_COOKIE['map'] . ' TT Rating' ?></th>
            </tr>
            <tr>
                <th>Rank</th>
                <th>Name</th>
                <th>Rating</th>
            </tr>
            <?php
            for ($i = 1; $i <= 10; $i++) {
                echo '<tr>';
                echo '<td>' . $i . '</td>';
                echo '<td>player ' . $i . '</td>';
                echo '<td>score</td>';
            }
            ?>
        </table>
        <table>
            <tr>
                <th colspan=3><?php echo $_COOKIE['map'] . ' HS Rating' ?></th>
            </tr>
            <tr>
                <th>Rank</th>
                <th>Name</th>
                <th>Rating</th>
            </tr>
            <?php
            for ($i = 1; $i <= 10; $i++) {
                echo '<tr>';
                echo '<td>' . $i . '</td>';
                echo '<td>player ' . $i . '</td>';
                echo '<td>score</td>';
            }
            ?>
        </table>
    </div>
</div>