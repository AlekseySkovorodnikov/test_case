<?php
session_start(); // Стартуем сессию
?>

<?php
//echo $_SESSION['id_user']; 
if (!isset($_SESSION['id_role'])) // если в сессии не загружены логин и id админа
	{
	header("Location: http://localhost/test_case/index.php");	
	}	
?>

<h1><?php echo "Добро пожаловать, " . $_SESSION['login'] . " !" ?> </h1>
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
		if(isset($_GET['srt'])) {
		$srt = $_GET['srt'];
	}
	else {
		$srt = 'id_user';	
		}

    $qr_result = mysql_query("select * from " . $db_table_to_show . " order by " . $srt)
    or die(mysql_error());
?>
	<p><b> Сортировать по:</b> </p>
	<u><a href="table.php?srt=login">Логин </a></u>
	<u><a href="table.php?srt=name">Имя  </a></u>
	<u><a href="table.php?srt=id_role">Роль  </a> </u>   

<?php
    // выводим на страницу сайта заголовки HTML-таблицы
    echo '<table border="1">';
  echo '<thead>';
  echo '<tr>';
  echo '<th>Id</th>';
  echo '<th>Login</th>';
  echo '<th>Name</th>';
  echo '<th>E-mail</th>';
  echo '<th>Role</th>';
  echo '</tr>';
  echo '</thead>';
  echo '<tbody>';
  
   // выводим в HTML-таблицу все данные из таблицы MySQL 
  while($data = mysql_fetch_array($qr_result)){ 
    echo '<tr>';
    echo '<td>' . $data['id_user'] . '</td>';
    echo '<td>' . $data['login'] . '</td>';
    echo '<td>' . $data['name'] . '</td>';
    echo '<td>' . $data['email'] . '</td>';
    echo '<td>' . $data['id_role'] . '</td>';
    echo '</tr>';
  }
  
    echo '</tbody>';
  echo '</table>';
    
    // закрываем соединение с сервером  базы данных
    mysql_close($connect_to_db);

?>
<?php
//if (isset($_SESSION['login']) && isset($_SESSION['id_user'])) // если в сессии загружены логин и id
{
	echo '<div align="center"><a href="index.php?exit">Выход</a></div>'; // Выводим нашу ссылку выхода
	
	echo"<td> <a href ='edit_user.php'>Редактировать свой профиль</a>";

} ?>

<code lang="php">