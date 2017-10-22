<?php
if(isset($_POST['submit'])){	   
	include 'db.php';
	if(isset($_POST['login']) && isset($_POST['name']) && isset($_POST['email']) && isset($_POST['id_role']) && isset($_POST['password'])){
		$login = mysql_real_escape_string($_POST['login']);
		$name = mysql_real_escape_string($_POST['name']);
		$email = mysql_real_escape_string($_POST['email']);
		$id_role = mysql_real_escape_string($_POST['id_role']);
		$password = mysql_real_escape_string($_POST['password']);
		if (filter_var($email, FILTER_VALIDATE_EMAIL) == true) {
			mysql_query("INSERT INTO users(login, name, email, id_role, password ) VALUES ('$login', '$name', '$email', '$id_role', '$password' )"); }
		else 
			{
				echo "Некорректный e-mail";	
			}
	}
	
}

	header("Refresh:3; URL=main.php" );

//header("Location: main.php");
?>