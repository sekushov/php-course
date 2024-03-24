<!DOCTYPE html>
<html lang="ru">

<head>
    <?php 
        $website_title = 'PHP авторизация';
        require './modules/head.php';
    ?>
</head>

<body>
    <?php require './modules/header.php'; ?>

    <main class="container mt-5">
        <div class="col-md-8 mb-3">
            <?php
                if($_COOKIE['log'] == ''):
            ?>
                <h4>Авторизация</h4>
                <form>
                    <label for="email">Ваше email</label>
                    <input type="email" name="email" id="email" class="form-control">
                    <label for="password">Пароль</label>
                    <input type="password" name="password" id="password" class="form-control">
                    <div class="alert alert-danger mt-2" id="error-block"></div>
                    <div class="alert alert-success mt-2" id="success-block"></div>
                    <button type="button" id="auth-user" class="btn btn-success mt-3">Войти</button>
                </form>
            <?php
                else:
            ?>
                <h4>Вход выполнен</h4>
                <h6><?=$_COOKIE['log']?></h6>
                <button class="btn btn-danger" id="exit-user">Выйти</button>
            <?php
                endif;
            ?>
        </div>
    </main>


    <?php require './modules/footer.php';?>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>
        $('#auth-user').click(function () {
            var email = $('#email').val();
            var password = $('#password').val();

            $.ajax({
                url: './ajax/auth.php',
                type: 'POST',
                cache: false,
                data: {'email' : email, 'password': password},
                dataType: 'html',
                success: function (data) {
                    if(data == 'Пользователь авторизован') {
                        $('#success-block').show();
                        $('#success-block').text(data);
                        $('#error-block').hide();
                        document.location.reload(true);
                    } else {
                        $('#error-block').show();
                        $('#error-block').text(data);
                        $('#success-block').hide();
                    }
                }
            });
        });

        $('#exit-user').click(function () {
            $.ajax({
                url: './ajax/exit.php',
                type: 'POST',
                cache: false,
                data: {},
                dataType: 'html',
                success: function (data) {
                    document.location.reload(true);
                }
            });
        });
    </script>
</body>

</html>