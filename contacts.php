<!DOCTYPE html>
<html lang="ru">

<head>
    <?php 
        $website_title = 'PHP контакты';
        require './modules/head.php';
    ?>
</head>

<body>
    <?php require './modules/header.php'; ?>

    <main class="container mt-5">
        <div class="col-md-8 mb-3">
            <h4>Форма обратной связи</h4>
            <form>
                <label for="username">Ваше имя</label>
                <input type="text" name="username" id="username" class="form-control">
                <label for="email">Ваш email</label>
                <input type="email" name="email" id="email" class="form-control">
                <label for="mess">Сообщение</label>
                <textarea name="mess" id="mess" class="form-control"></textarea>
                <div class="alert alert-danger mt-2" id="error-block"></div>
                <div class="alert alert-success mt-2" id="success-block"></div>
                <button type="button" id="send-mess" class="btn btn-success mt-3">Отправить</button>
            </form>
        </div>
    </main>


    <?php require './modules/footer.php';?>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>
        $('#send-mess').click(function () {
            var username = $('#username').val();
            var email = $('#email').val();
            var mess = $('#mess').val();

            $.ajax({
                url: './ajax/email.php',
                type: 'POST',
                cache: false,
                data: {'username' : username, 'email' : email, 'mess': mess},
                dataType: 'html',
                success: function (data) {
                    if(data == 'Сообщение отправлено') {
                        $('#success-block').show();
                        $('#success-block').text(data);
                        $('#error-block').hide();
                        document.getElementById('username').value = '';
                        document.getElementById('email').value = '';
                        document.getElementById('mess').value = '';
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