<?php
include("db.php");  

$id =$_REQUEST['id'];
		
// sending query
mysql_query("DELETE FROM users WHERE id_user = '$id'")
	or die(mysql_error());  	
	
header("Location: main.php");
?>