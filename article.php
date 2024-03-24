<?php
    if($_COOKIE['log'] == '') {
        header('Location: ./reg.php');
        exit();
    }
?>
<!DOCTYPE html>
<html lang="ru">

<head>
    <?php 
        $website_title = 'Добавление статьи';
        require './modules/head.php';
    ?>
</head>

<body>
    <?php require './modules/header.php'; ?>

    <main class="container mt-5">
        <div class="col-md-8 mb-3">
            <h4>Добавить статью</h4>
            <form>
                <label for="title">Заголовок статьи</label>
                <input type="text" name="title" id="title" class="form-control">
                <label for="intro">Интро</label>
                <textarea name="intro" id="intro" class="form-control"></textarea>
                <label for="text">Текст статьи</label>
                <textarea name="text" id="text" class="form-control"></textarea>
                <div class="alert alert-danger mt-2" id="error-block"></div>
                <div class="alert alert-success mt-2" id="success-block"></div>
                <button type="button" id="article-send" class="btn btn-success mt-3">Добавить</button>
            </form>
        </div>
    </main>


    <?php require './modules/footer.php';?>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>
        $('#article-send').click(function () {
            var title = $('#title').val();
            var intro = $('#intro').val();
            var text = $('#text').val();

            $.ajax({
                url: './ajax/add_article.php',
                type: 'POST',
                cache: false,
                data: {'title' : title, 'intro' : intro, 'text': text},
                dataType: 'html',
                success: function (data) {
                    if(data == 'Готово') {
                        $('#success-block').show();
                        $('#success-block').text(data);
                        $('#error-block').hide();
                    } else {
                        $('#error-block').show();
                        $('#error-block').text(data);
                        $('#success-block').hide();
                    }
                }
            });
        });
    </script>
</body>

</html>