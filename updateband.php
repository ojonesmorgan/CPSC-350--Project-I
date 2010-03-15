<?php
include("session.php");

if (!$logged_in) include("notloggedin.php");

$old_name = $_GET['id'];
$name = $_POST['name'];
$genre = $_POST['genre'];
$city = $_POST['city'];
$state = $_POST['state'];
$description = $_POST['description'];
$photo = $_POST['photo'];

include("db_connect.php");
	
$name = mysql_escape_string(stripslashes(htmlspecialchars(trim($name))));
$genre = mysql_escape_string(stripslashes(htmlspecialchars(trim($genre))));
$city = mysql_escape_string(stripslashes(htmlspecialchars(trim($city))));
$state = mysql_escape_string(stripslashes(htmlspecialchars(trim($state))));
$description = mysql_escape_string(stripslashes(htmlspecialchars(trim($description))));
$photo = mysql_escape_string(stripslashes(htmlspecialchars(trim($photo))));

$saved_name = $name;
$band = "WHERE bandName='$old_name'";

mysqli_query($db, "UPDATE band SET bandGenre='$genre' $band");
mysqli_query($db, "UPDATE band SET bandCity='$city' $band");
mysqli_query($db, "UPDATE band SET bandState='$state' $band");
mysqli_query($db, "UPDATE band SET bandPhoto='$photo' $band");
mysqli_query($db, "UPDATE band SET bandDescription='$description' $band");
if (!empty($name)) mysqli_query($db, "UPDATE band SET bandName='$name' $band"); //This must be the LAST update query.
else $saved_name = $old_name;

header("location:bandprofile.php?name=$saved_name&saved=1");
?>