<!DOCTYPE html>
<html lang="ru">

<head>
    <?php 
        $website_title = 'PHP регистрация';
        require './modules/head.php';
    ?>
</head>

<body>
    <?php require './modules/header.php'; ?>

    <main class="container mt-5">
        <div class="col-md-8 mb-3">
            <h4>Регистрация</h4>
            <form>
                <label for="username">Ваше имя</label>
                <input type="text" name="username" id="username" class="form-control">
                <label for="email">Ваше email</label>
                <input type="email" name="email" id="email" class="form-control">
                <label for="password">Пароль</label>
                <input type="password" name="password" id="password" class="form-control">
                <div class="alert alert-danger mt-2" id="error-block"></div>
                <div class="alert alert-success mt-2" id="success-block"></div>
                <button type="button" id="reg-user" class="btn btn-success mt-3">Зарегистрироваться</button>
            </form>
        </div>
    </main>


    <?php require './modules/footer.php';?>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>
        $('#reg-user').click(function () {
            var username = $('#username').val();
            var email = $('#email').val();
            var password = $('#password').val();

            $.ajax({
                url: './ajax/reg.php',
                type: 'POST',
                cache: false,
                data: {'username' : username, 'email' : email, 'password': password},
                dataType: 'html',
                success: function (data) {
                    if(data == 'Пользователь зарегистрирован') {
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