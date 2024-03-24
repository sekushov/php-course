<!DOCTYPE html>
<html lang="ru">

<head>
    <?php 
        $website_title = 'PHP blog';
        require './modules/head.php';
    ?>
</head>

<body>
    <?php require './modules/header.php'; ?>

    <main class="container mt-5">
        <h1>Статьи</h1>
        <div class="mb-3">
            <?php
                require './mysql_connect.php';
                $sql = 'SELECT * FROM `articles` ORDER BY `date` DESC';
                $query = $pdo->query($sql);
                while ($row = $query->fetch(PDO::FETCH_OBJ)) {
                    echo "<div>
                            <h2>$row->title</h2>
                            <p>$row->intro</p>
                            <p>Автор: <mark>$row->author</mark></p>
                            <a href='articles.php?id=$row->id'>
                                <button class='btn btn-warning mb-5'>Читать далее...</button>
                            </a>
                        </div>
                        ";
                }
            ?>
        </div>
    </main>


    <?php require './modules/footer.php'; ?>
</body>

</html>