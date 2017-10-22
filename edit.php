<?php
require("db.php");
$id =$_REQUEST['id'];

$result = mysql_query("SELECT * FROM users WHERE id_user  = $id");
$test = mysql_fetch_array($result);
if (!$result)
	die("Error: Data not found.");

$login=$test['login'] ;
$name=$test['name'] ;
$email=$test['email'] ;
$id_role=$test['id_role'] ;
$password=$test['password'] ;


if(isset($_POST['save'])) {	
	$login = $_POST['login'];

	mysql_query("UPDATE users SET login ='$login' WHERE id_user = $id")
				or die(mysql_error()); 
	echo "Saved!";

	
	$email = $_POST['email'];

	mysql_query("UPDATE users SET email ='$email' WHERE id_user = $id")
				or die(mysql_error()); 
	echo "Saved!";

	
	
	$name = $_POST['name'];
	mysql_query("UPDATE users SET name ='$name' WHERE id_user = $id")
				or die(mysql_error()); 
	echo "Saved!";
	
	$id_role = $_POST['id_role'];
	mysql_query("UPDATE users SET id_role ='$id_role' WHERE id_user = $id")
				or die(mysql_error()); 
	echo "Saved!";
	
	$password = $_POST['password'];
	mysql_query("UPDATE users SET password ='$password' WHERE id_user = $id")
				or die(mysql_error()); 
	echo "Saved!";
	
	
	header("Location: main.php");			
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
		<td>Role:</td>
		<td><input type="text" name="id_role" value="<?php echo $id_role ?>" size='30' /></td>
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