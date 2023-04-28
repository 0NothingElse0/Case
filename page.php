<?php
session_start();
$type = $_SESSION["type"];
$visible = "";
// проверяем авторизован пользователь или нет, для гостя скрываем кнопки добавить и редактировать
if($type == "guest"){
	$visible = "hidden";
	echo '<style>.button{visibility : hidden;}</style>';
}
//получаем данные со всеми постами
require_once "db_connection.php";
$sql = "SELECT * FROM `data`";
$res = $connect -> query($sql);
if ($res -> num_rows > 0) {
    while ($row = $res -> fetch_assoc()) 
    { 
		$id = $row["id"];
		$name = $row["name"];
		$text = $row["text"];
		$date = $row["date"];
        echo '<table width="600px" cellpadding="0" cellspacing="0" >
        <tr>
            <td width="100px" height="100px" valign="top" >		
            <form method="post" name="form_add">
                <br>
                <input style="width:600px;" name="name_post" type="text" value="'.$name.'">
                <br>
                <textarea style="width:600px;height:100px;" name="text_post" rows="10">'.$text.'</textarea>
                <br>
                <input style="width:600px;" name="name_date" type="text" value="'.$date.'">
                <br>
            </form>		
			<form action="post_data.php"	 method="post" class="button">
                <input type="hidden" name="re_id" value="'. $id .'" />
                <input type="submit" value="Редактировать" name="replace" />
			</form>
            </td>
        </tr>
        </table>';
    }
}
?>

<!DOCTYPE html>
 <html lang="ru">
	 <head>
		<meta charset="utf-8">
	 	<title>Сайт</title>
	 </head>
	 
     <div>
	 <form action="post_data.php"  method="post" class="button">
            <input <?php echo $visible;?> type="submit" value="Добавить" name="add" />
	</form>
     </div>

</html>