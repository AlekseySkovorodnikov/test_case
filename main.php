<?php
session_start(); // Стартуем сессию
?>

<?php
//echo $_SESSION['id_user']; 
if ($_SESSION['id_role'] !== '1') // если в сессии не загружены логин и id админа
	{
	header("Location: http://localhost/test_case/table.php");	
	}	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Категории</title>
</head>
<body>
	<h1 align=	center> Административная панель </h1>
	<h2>Добавить нового пользователя: </h2>
<form method="post" action="add.php">
<table> 
	
	
	<tr> 
		<td>Логин:</td>
		<tr><td><input type="text" name="login" size='30' /></td></tr>
		<td>Имя:</td>
		<tr><td><input type="text" name="name" size='30' /></td></tr>
		<td>E-mail:</td>
		<tr><td><input type="text" name="email" size='30' /></td></tr>
		<td>Роль:</td>
		<tr><td><input type="text" name="id_role" size='30' /></td></tr>
		<td>Пароль:</td>
		<tr><td><input type="password" name="password" size='30' /></td></tr>
		
	<td><input type="submit" name="submit" value="Создать" /></td>
	</tr>
</table>
</form>
<br/>
<table border="1">
	<?php
	include("db.php");
	if(isset($_GET['srt'])) {
		$srt = $_GET['srt'];
	}
	else {
		$srt = 'id_user';	
		}
	$result = mysql_query("SELECT * FROM `users`  order by " . $srt );
	
	echo "Сортировать по:" . '<br>';
	?>
	<a href="main.php?srt=login">Логин</a><br>
	<a href="main.php?srt=name">Имя</a><br>
	<a href="main.php?srt=id_role">Роль</a><br>    
<?php	
	if (!$result)
		die("Error: Data not found.");
   echo "\n<tr>";
   echo "<td> ID </td>";
   echo "<td>ID Role </td>";
   echo "<td> name </td>";
   echo "<td> E-mail </td>";
   echo "<td> Login </td>";
   echo "<td> Password </td>";
 	echo  "</tr>";?>
	<b><?php echo "Список Пользователей";		
		?></b> <br>
	
	
	
		
<?php	while($test = mysql_fetch_array($result)) {
		$id = $test['id_user'];	
		
		echo "\n<tr>";	
		
		echo"<td><font color='black'>" .$test['id_user']."</font></td>";
		echo"<td><font color='black'>" .$test['id_role']."</font></td>";
		echo"<td><font color='black'>" .$test['name']."</font></td>";
		echo"<td><font color='black'>" .$test['email']."</font></td>";
		echo"<td><font color='black'>" .$test['login']."</font></td>";
		echo"<td><font color='black'>" .$test['password']."</font></td>";
		echo"<td> <a href ='edit.php?id=$id'>Редактировать</a>";
		echo"<td> <a href ='delete.php?id=$id'><center>Удалить</center></a>";
		echo "</tr>";
	}
	mysql_close($conn);
	?>
</table>
<?php
if (isset($_SESSION['login']) && isset($_SESSION['id_user'])) // если в сессии загружены логин и id
{
	echo '<div align="center"><a href="index.php?exit">Выход</a></div>'; // Выводим нашу ссылку выхода

	echo"<td> <a href ='edit_user.php'>Редактировать свой профиль</a>";
} 
	

	?>
	
</body>
</html>																				