<?php
include("session.php");

if (!$logged_in)
{
	header("location:login.php?err=accessdenied");
	exit;
}

$old_name = $_GET['id'];
$name = $_POST['name'];
$genre = $_POST['genre'];
$city = $_POST['city'];
$state = $_POST['state'];
//$description = $_POST['description'];
//$photo = $_POST['photo'];
//$map = $_POST['map'];

include("db_connect.php");
	
$name = mysql_escape_string(stripslashes(htmlspecialchars(trim($name))));
$genre = mysql_escape_string(stripslashes(htmlspecialchars(trim($genre))));
$city = mysql_escape_string(stripslashes(htmlspecialchars(trim($city))));
$state = mysql_escape_string(stripslashes(htmlspecialchars(trim($state))));
//$description = mysql_escape_string(stripslashes(htmlspecialchars(trim($description))));
//$photo = mysql_escape_string(stripslashes(htmlspecialchars(trim($photo))));

$band = "WHERE bandName='$old_name'";

if (!empty($genre)) mysqli_query($db, "UPDATE band SET bandGenre='$genre' $band");
if (!empty($city)) mysqli_query($db, "UPDATE band SET bandCity='$city' $band");
if (!empty($state)) mysqli_query($db, "UPDATE band SET bandState='$state' $band");
//if (!empty($photo)) mysqli_query($db, "UPDATE  SET bandPhoto='$photo' $band");
//if (!empty($description)) mysqli_query($db, "UPDATE  SET bandDescription='$description' $band");
if (!empty($name)) mysqli_query($db, "UPDATE band SET bandName='$name' $band"); //This must be the LAST update statement.

header("location:bandprofile.php?saved=1&name=$name&genre=$genre&city=$city&state=$state");
?>