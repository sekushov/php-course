<header class="d-flex flex-column flex-md-row justify-content-around align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm">
    <a href="./"><h5 class="my-0 mr-md-auto font-weight-normal">PHP Blog</h5></a>
    <nav class="my-2 my-md-0 mr-md-3">
        <a href="./">Главная</a>
        <a href="./contacts.php">Контакты</a>
        <?php
            if($_COOKIE['log'] != ''):
        ?>
        <a href="/article.php">Добавить статью</a>
    <?php endif; ?>
    </nav>
    <div>
        <?php
            if($_COOKIE['log'] == ''):
        ?>
            <a href="./auth.php" class="btn btn-outline-primary">Войти</a>
            <a href="./reg.php" class="btn btn-outline-primary">Регистрация</a>
        <?php
            else:
        ?>
            <a href="./auth.php" class="btn btn-outline-primary">Личный кабинет</a>
        <?php
            endif;
        ?>
    </div>
</header>