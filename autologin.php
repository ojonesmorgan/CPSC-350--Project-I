<?php
if (!isset($_SESSION['loggedout']))
{
	include("db_connect.php");
	
	$email = htmlspecialchars($_COOKIE['blemail']);
	$password = md5(htmlspecialchars($_COOKIE['blpw']));
	
	$result = mysqli_query($db, "SELECT * FROM users WHERE email = '$email'");
	
	while ($row = mysqli_fetch_assoc($result))
	{
		$correct_password = ($row['password'] == $password) && isset($password);
		
		if ($correct_password)
		{
			$_SESSION['name'] = $row['name'];
			$_SESSION['email'] = $row['email'];
			$_SESSION['admin'] = $row['admin'];
		}
	}
}
?>