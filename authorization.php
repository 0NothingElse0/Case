<?php
require_once "db_connection.php";
session_start();

$error = '';
//Проверяем хочет ли пользователь авторизироватся 
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['auth'])) {

    $login = trim($_POST['login']);
    $password = trim($_POST['password']);//использую не хешированный пароль потому что не делал авторизацию

    if (empty($login)) {
        $error .= '<p class="error">Введите логин.</p>';
    }

    if (empty($password)) {
        $error .= '<p class="error">Введите пароль.</p>';
    }
    //сверяем есть ли администратор с такими данными
    if(empty($error)){
        $sql = "SELECT * FROM `admins` WHERE `login` = '$login' AND `password` = '$password'";
        $res = $connect -> query($sql);
        if($res -> num_rows > 0){
            while($row = $res -> fetch_assoc()){
                $_SESSION["type"] ="admin";
                $_SESSION["userLogin"] =$row['login'];
            }
        }else{
            $error .= '<p class="error">Аккаунт не существует.</p>';
        }
        header("location: page.php");
    }
}
//если пользователь хочет зайти как гость 
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['no-auth'])) {
    $_SESSION["type"] ="guest";
    $_SESSION["userLogin"] ="unknow";
    header("location: page.php");
}
?>


<!DOCTYPE html>
 <html lang="ru">
	 <head>
		<meta charset="utf-8">
	 	<title>Авторизация</title>
	 </head>
     <div class="body">
        <?php echo $error; ?>
        <form action="" method="post">
            Логин: <input type="text" name="login" />
        
            Пароль: <input type="password" name="password" />

            <input type="submit" value="Авторизация" name="auth" />

            <input type="submit" value="Не авторизироваться" name="no-auth" />
            </form>
     </div>
</html>
