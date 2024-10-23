<?php

require_once 'connection.php';

try {
    if (isset($_POST['like'])) {  //when the like button is pressed
        $likeId = $_POST['like'];
        $sql = 'UPDATE posts SET likes = likes + 1 WHERE id = ?';
        $stmt = $pdo->prepare($sql);                 //increment like with the right id
        $stmt->execute([$likeId]);
    }
} catch (PDOException $e) {
    echo "Likes Failed :/ $e";
}

try {
    $posts = $pdo->prepare("SELECT posts.id, posts.titel, posts.datum, posts.img_url, posts.inhoud, posts.likes, auteurs.auteur
    FROM auteurs INNER JOIN posts
    ON auteurs.id = posts.auteur_id
    ORDER BY posts.likes DESC;");
    $posts->execute();
    $posts->setFetchMode(PDO::FETCH_ASSOC);
    $result = $posts->fetchAll();
} catch (PDOException $e) {
    echo "Posts Failed :< $e";
}

?>

<!DOCTYPE html>
<html lang="nl">

<head>
    <title>Foodblog</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <div class="container">

        <div id="header">
            <h1>Foodblog</h1>
            <p><a href="new_post.php">Nieuwe post</a></p>
        </div>

        <?php foreach ($result as $post) : 
            try {
                $tags = $pdo->prepare("SELECT posts_tags.tag_id, tags.titel AS tag_title
                FROM posts_tags INNER JOIN tags
                ON posts_tags.tag_id = tags.id
                WHERE post_id = ?");
                $tags->execute([
                    $post['id']
                ]);
                $tags->setFetchMode(PDO::FETCH_ASSOC);
                $tags = $tags->fetchAll();
                echo "Tags Gotten!";
            } catch (PDOException $e) {
                echo "Tags Failed :S $e";
            }
            ?>
            <div class="post">
                <div class="header">
                    <h2><?= $post['titel'] ?></h2>
                    <img src="<?= $post['img_url'] ?>">
                </div>
                <span class="details">Geschreven op: <?= $post['datum'] ?> door <b><?= $post['auteur'] ?></b></span>
                <span class="details">
                    Tags: 
                    <?php
                    foreach ($tags as $tag) {
                        echo '<a href="lookup.php?tag=' . $tag['tag_title'] . '">' . $tag['tag_title'] . ' </a>';
                    }
                    ?>
                </span>
                <span class="right">
                    <form action="index.php" method="post">
                        <button type="submit" value="<?php echo $post['id']; ?>" name="like">
                            <?php echo $post['likes']; ?> likes
                        </button>
                    </form>
                </span>
                <p>
                    <?= $post['inhoud'] ?>
                </p>
            </div>
        <?php endforeach; ?>

    </div>
</body>

</html>