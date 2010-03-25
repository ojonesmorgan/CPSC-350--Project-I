<?php
ob_start();

if(isset($_POST['submit']))
{
	$root = $_POST['root'];
	$password = $_POST['password'];
	$db = mysqli_connect('localhost',$root,$password);
	if(!$db)
		die('Connection Error, did you enter the right information?');
		mysqli_query($db,"CREATE DATABASE IF NOT EXISTS musicdb2");

	$db = mysqli_connect('localhost',$root,$password,'musicdb2');
	$file=fopen("setup.sql","r");

	while(!feof($file))
	{
		$line = fgets($file);
		mysqli_query($db,$line);
	}
	fclose($file);

	header("Location: home.php");
	ob_flush();

}
else
{
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
  
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>BandLink Database Setup</title>
  <link rel="stylesheet" type="text/css" href="style.css" />
</head>

<body>
<form method="post" action="setup.php">
<h1 style="text-align: center;"><u>Database Setup</u></h1>
<center>
<h4>Username</h4> <input type="text" name="root">
<br>
<h4>Password</h4> <input type="password" name="password">
<br>
<br>
<input type="submit" name="submit" value="Submit">
</center>
</form>
</body>
</html>
<?php
}
?>

<?php include("footer.html");?>