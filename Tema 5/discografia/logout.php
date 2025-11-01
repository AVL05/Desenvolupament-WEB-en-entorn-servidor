<?php
session_start();

session_unset();
session_destroy();

setcookie('remember_user', '', 1, '/');

header('Location: login.php');
exit();
?>
