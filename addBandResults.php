<?php
include("session.php");
if (!$logged_in) include("notloggedin.php");

include("db_connect.php");
  
$name = mysql_escape_string(stripslashes(htmlspecialchars(trim($_POST['name']))));
$state = mysql_escape_string(stripslashes(htmlspecialchars(trim($_POST['state']))));
$city = mysql_escape_string(stripslashes(htmlspecialchars(trim($_POST['city'])))); 
$genre = mysql_escape_string(stripslashes(htmlspecialchars(trim($_POST['genre']))));
$photo = mysql_escape_string(stripslashes(htmlspecialchars(trim($_POST['photo']))));
$description = mysql_escape_string(stripslashes(htmlspecialchars(trim($_POST['description']))));

if (!empty($name)) mysqli_query($db, $query = "INSERT INTO band (bandName, bandState, bandCity, bandGenre, bandDescription, bandPhoto) VALUES ('$name', '$state', '$city', '$genre', '$description', '$photo')");
else header("location:addBandForm.php?err=noname&name=$name&genre=$genre&city=$city&state=$state&description=$description&photo=$photo");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>BandLink | Band Added</title>
  <link rel="stylesheet" type="text/css" href="style.css" />
</head>

<body>
<div id="wrap">
<?php include("header.php"); ?>
<center><div>
	
<?php
echo "<br /><h1>Thanks for adding the band $name.</h1>";
echo "<p><a href='bandprofile.php?name=$name'>Click here to go to ".$name."'s profile.</a></p><br />\n";
?>
	
</div></center></div>
</body>
</html>