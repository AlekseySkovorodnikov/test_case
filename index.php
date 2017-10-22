<?php
session_start(); // Стартуем сессию
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Авторизация на сайте:</title>
</head>
<body>
<div align="center"><h2>Авторизация на сайте:</h2>
<form action="index.php" method="post">
Логин: <input type="text" name="login"><br>
Пароль: <input type="password" name="password"><br>
<input type="submit" name="submit" method="POST" action = "table.php">
</form></div>

<?php $connection = mysqli_connect('localhost', 'root', 'root', 'test_db') or die(mysqli_error());// Соединение с базой данных ?>

<?php if (isset($_POST['submit'])) // Отлавливаем нажатие кнопки "Отправить"
{
if (empty($_POST['login'])) // Если поле логин пустое
{
echo '<script>alert("Поле логин не заполненно");</script>'; // То выводим сообщение об ошибке
}
elseif (empty($_POST['password'])) // Если поле пароль пустое
{
echo '<script>alert("Поле пароль не заполненно");</script>'; // То выводим сообщение об ошибке
}
else  // Иначе если все поля заполненны
{    
$login = $_POST['login']; // Записываем логин в переменную
	
	
$password = $_POST['password']; // Записываем пароль в переменную           
$query = mysqli_query($connection, "SELECT `id_user`, id_role FROM `users` WHERE `login` = '$login' AND `password` = '$password'"); // Формируем переменную с запросом к базе данных с проверкой пользователя
$result = mysqli_fetch_array($query); // Формируем переменную с исполнением запроса к БД 
if (empty($result['id_user'])) // Если запрос к бд не возвращает id пользователя
{
echo '<script>alert("Неверные Логин или Пароль");</script>'; // Значит такой пользователь не существует или не верен пароль
}
else // Если возвращaем id пользователя, выполняем вход под ним
{
$_SESSION['password'] = $password; // Заносим в сессию  пароль
$_SESSION['login'] = $login; // Заносим в сессию  логин
$_SESSION['id_user'] = $result['id_user']; // Заносим в сессию  id
$_SESSION['id_role'] = $result['id_role'];; // Заносим в сессию  роль	

	echo '<div align="center">Вы успешно вошли в систему: '.$_SESSION['login'].'</div>'; // Выводим сообщение что пользователь авторизирован        
echo $id_role;
}     
}		
} ?>

<?php if (isset($_GET['exit'])) { // если вызвали переменную "exit"
unset($_SESSION['password']); // Чистим сессию пароля
unset($_SESSION['login']); // Чистим сессию логина
unset($_SESSION['id_user']); // Чистим сессию id
unset($_SESSION['id_role']); // Чистим сессию id_role	
} ?>

<?php if (isset($_SESSION['login']) && isset($_SESSION['id_user'])) // если в сессии загружены логин и id
{
	echo '<div align="center"><a href="index.php?exit">Выход</a></div>'; // Выводим нашу ссылку выхода
} ?>

	
<?php
	if (($_SESSION['login'] != 'admin') && ($_SESSION['id_user'] != 4) && isset($_SESSION['id_user']) && $_SESSION['id_role'] !== 1) // если в сессии загружены логин и id не #администратора 
{
	header("Location: http://localhost/test_case/table.php");
}
	else if (($_SESSION['login'] == 'admin') /*&& ($_SESSION['id_user'] == 4) *//*&& isset($_SESSION['id_user']) *//*&& $_SESSION['id_role'] == 1*/) 
	{
		header("Location: http://localhost/test_case/main.php");
	}	
	?>
	

<?php
	if (!isset($_SESSION['login']) || !isset($_SESSION['id_user'])) // если в сессии не загружены логин и id
{
echo '<div align="center"><a href="reg.php">Регистрация</a></div>'; // Выводим нашу ссылку регистрации
} ?>
