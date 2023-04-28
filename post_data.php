<?php
    require_once "db_connection.php";
    $name = "";
    $text = "";
    $id = $_POST["re_id"];
    //если был передан параметр re_id понимаем, что нужно редактировать данные, считываем необходимый пост из БД
    if(isset($id)){
        
        $sql = "SELECT * FROM `data` WHERE `id` = '$id'";
        $res = $connect -> query($sql);
        if ($res -> num_rows > 0) {
            while ($row = $res -> fetch_assoc()) 
            { 
                $name = $row["name"];
                $text = $row["text"];
                $date = $row["date"];
            }
        }
    }
    //нажатие кнопки подтверждения, проверка не пусты ли поля
    if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["complite"]) && isset($_POST["name_post"]) && isset($_POST["text_post"])){
        $id = $_POST["post_id"];
        //если добавляем данные
        if(empty($id)){
            $name = $_POST['name_post'];
            $text = $_POST['text_post'];
            $date = date("Y") . "-" . date("m") . "-" . date("d");

            $sql = "INSERT INTO `data`(name, text, date) VALUES('$name', '$text', '$date')";
            $res = $connect -> query($sql);
        }
        //если редактируем данные
        if(isset($id)){
            $name = $_POST['name_post'];
            $text = $_POST['text_post'];
            $date = date("Y") . "-" . date("m") . "-" . date("d");
            $sql = "UPDATE `data` SET `name` = '$name', `text` = '$text', `date` = '$date' WHERE `id` = '$id'";
            $res = $connect -> query($sql);
        }
        header("location: page.php");
    }
    
?>

<!DOCTYPE html>
 <html lang="ru">
	 <head>
		<meta charset="utf-8">
	 	<title>Добавление поста</title>
	 </head>
	 
	 <div class="body">
        <table width="600px" cellpadding="0" cellspacing="0" >
            <tr>
                <td width="100px" height="100px" valign="top" >		
                <form method="post"  name="form_add">
                    <br>
                    <input type="hidden" name="post_id" value="<?php echo $id; ?>" />
                    <br>
                    <input style="width:600px;" name="name_post" type="text" value="<?php echo $name; ?>">
                    <br>
                    <textarea style="width:600px;height:600px;" name="text_post" rows="10"><?php echo $text; ?></textarea>
                    <br>
                    <br><br><input type="submit" value="Подтвердить" name="complite">
                </form>
                </td>
            </tr>
        </table>
	</div>

</html>