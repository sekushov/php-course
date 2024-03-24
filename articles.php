<!DOCTYPE html>
<html lang="ru">

<head>
    <?php 
        require './mysql_connect.php';
        $sql = 'SELECT * FROM `articles` WHERE `id` = :id';
        $query = $pdo->prepare($sql);
        $query->execute(['id' => $_GET['id']]);
        $article = $query->fetch(PDO::FETCH_OBJ);

        $website_title = "$article->title";
        require './modules/head.php';
    ?>
</head>

<body>
    <?php require './modules/header.php'; ?>

    <main class="container mt-5">
        <div class="mb-3">
            <div>
                <h2><?=$article->title?></h2>
                <p><?=$article->text?></p>
                <div>
                    Автор: <mark><?=$article->author?></mark>
                </div>
                <div>
                    <?php
                        $date = date('d.m.Y, H:i', $article->date);
                    ?>
                    Дата: <?=$date?>
                </div>
            </div>
            <h4 class="mt-5">Добавить комментарий</h4>
            <form class="mb-5" action="/articles.php?id=<?=$_GET['id']?>" method="post">
                <label for="username">Ваше имя</label>
                <input type="text" value="<?=$_COOKIE['log']?>" name="username" id="username" class="form-control">
                <label for="text">Комментарий</label>
                <textarea name="text" id="text" class="form-control"></textarea>
                <button type="submit" id="comment-send" class="btn btn-success mt-3">Добавить</button>
            </form>
            <?php
                $username = trim(filter_var($_POST['username'], FILTER_SANITIZE_STRING));
                $text = trim(filter_var($_POST['text'], FILTER_SANITIZE_STRING));
                $article_id = $_GET['id'];
                if ($username != '' && $text != '') {
                    $sql = 'INSERT INTO comments(username, text, article_id) VALUES(:username, :text, :article_id)';
                    $query = $pdo->prepare($sql);
                    $query->execute(['username' => $username, 'text' => $text, 'article_id' => $article_id]);
                }
                $sql = "SELECT * FROM comments WHERE article_id = :article_id ORDER BY id DESC";
                $query = $pdo->prepare($sql);
                $query->execute(['article_id' => $_GET['id']]);
                while($comment = $query->fetch(PDO::FETCH_OBJ)) {
                    echo "
                        <div class='alert alert-info'>
                            <i>$comment->username:</i>
                            <p><quote>$comment->text</quote></p>
                        </div>
                    ";
                }
            ?>
        </div>
    </main>


    <?php require './modules/footer.php'; ?>
</body>

</html>