<?php
    setcookie('log', "", time() - 3600 * 24, "/");
    unset($_COOKIE['log']);
    echo true;
?>