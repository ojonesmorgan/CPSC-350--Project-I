<?php
include("session.php");

if (!$logged_in) include("notloggedin.php");

$old_name = $_GET['id'];
$name = $_POST['name'];
$street = $_POST['street'];
$city = $_POST['city'];
$state = $_POST['state'];
$description = $_POST['description'];
$picture = $_POST['picture'];
$map = $_POST['map'];

include("db_connect.php");
	
$name = mysql_escape_string(stripslashes(htmlspecialchars(trim($name))));
$genre = mysql_escape_string(stripslashes(htmlspecialchars(trim($genre))));
$city = mysql_escape_string(stripslashes(htmlspecialchars(trim($city))));
$state = mysql_escape_string(stripslashes(htmlspecialchars(trim($state))));
$description = mysql_escape_string(stripslashes(htmlspecialchars(trim($description))));
$picture = mysql_escape_string(stripslashes(htmlspecialchars(trim($picture))));
$map = mysql_escape_string(stripslashes(htmlspecialchars(trim($map))));

$saved_name = $name;
$venue = "WHERE venueName='$old_name'";

mysqli_query($db, "UPDATE venue SET venueStreet='$street' $venue");
mysqli_query($db, "UPDATE venue SET venueCity='$city' $venue");
mysqli_query($db, "UPDATE venue SET venueState='$state' $venue");
mysqli_query($db, "UPDATE venue SET venuePicture='$picture' $venue");
mysqli_query($db, "UPDATE venue SET venueMap='$map' $venue");
mysqli_query($db, "UPDATE venue SET venueDescription='$description' $venue");
if (!empty($name)) mysqli_query($db, "UPDATE venue SET venueName='$name' $venue"); //This must be the LAST update query.
else $saved_name = $old_name;

header("location:venueprofile.php?name=$saved_name&saved=1");
?>