﻿<?php
session_start(); // Стартуем сессию
?>
<?php
//echo  $_SESSION['id_user']; 
$id_user = $_SESSION['id_user'];
?> 


<?php 

// определяем начальные данные
    $db_host = 'localhost';
    $db_name = 'test_db';
    $db_username = 'root';
    $db_password = 'root';
    $db_table_to_show = 'users';

    // соединяемся с сервером базы данных
    $connect_to_db = mysql_connect($db_host, $db_username, $db_password)
    or die("Could not connect: " . mysql_error());

    // подключаемся к базе данных
    mysql_select_db($db_name, $connect_to_db)
    or die("Could not select DB: " . mysql_error());

    // выбираем все значения из таблицы "users"

$result = mysql_query("select * from users where id_user = $id_user");
$test = mysql_fetch_array($result);
if (!$result)
	die("Error: Data not found.");


$login=$test['login'] ;
$name=$test['name'] ;
$email=$test['email'] ;
$id_role=$test['id_role'] ;
$password=$test['password'] ;

?>

<?php

if(isset($_POST['save'])) {	
	$login = $_POST['login'];

	mysql_query("UPDATE users SET login ='$login' WHERE id_user = $id_user")
				or die(mysql_error()); 
	
	$name = $_POST['name'];
	mysql_query("UPDATE users SET name ='$name' WHERE id_user = $id_user")
				or die(mysql_error()); 
		
	$email = $_POST['email'];
	
	if (filter_var($email, FILTER_VALIDATE_EMAIL) == true) {
			
		mysql_query("UPDATE users SET email ='$email' WHERE id_user = $id_user")
					or die(mysql_error()); 
		
		}
	else 
		{
		echo "Некорректный e-mail";
		}
	$password = $_POST['password'];
	mysql_query("UPDATE users SET password ='$password' WHERE id_user = $id_user")
				or die(mysql_error()); 
		
	header("Refresh:3; URL=main.php" );

//	header("Location: main.php");			
}
mysql_close($conn);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Редактирование</title>
</head>
<body>
	<h1> Редактирование профиля </h1>	
<form method="post">
<table>
	<tr>
		<td>Логин:</td>
		<td><input type="text" name="login" value="<?php echo $login ?>" size='30' /></td>
		<!--<td><input type="submit" name="save" value="Сохранить" /></td>-->
	</tr>
<br>
	<tr>
		<td>Имя:</td>
		<td><input type="text" name="name" value="<?php echo $name ?>" size='30' /></td>
		<!--<td><input type="submit" name="save" value="Сохранить" /></td>-->
	</tr>
	<tr>
		<td>E-mail:</td>
		<td><input type="text" name="email" value="<?php echo $email ?>" size='30' /></td>
		<!--<td><input type="submit" name="save" value="Сохранить" /></td>-->
	</tr>

		<tr>
		<td>Password:</td>
		<td><input type="text" name="password" value="<?php echo $password ?>" size='30' /></td>
		<td><input type="submit" name="save" value="Сохранить" /></td>
	</tr>

	</table>
<?php	
	//if (isset($_SESSION['login']) && isset($_SESSION['id_user'])) // если в сессии загружены логин и id
{
	echo '<div align="center"><a href="index.php?exit">Выход</a></div>'; // Выводим нашу ссылку выхода
} ?>

</body>
</html>



