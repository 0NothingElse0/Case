<?php
session_start();
// Проверяем был ли пользователь авторизован, если нет то кидаем его на страницу авторизации
if(empty($_SESSION["userLogin"])){
    header("location: authorization.php");
}else{
    header("location: page.php");
}
?>
