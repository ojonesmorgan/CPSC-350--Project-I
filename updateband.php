<?php
include("session.php");

$old_name= $_GET['id'];
$name = $_POST['name'];
$genre = $_POST['genre'];
$city = $_POST['city'];
$street = $_POST['state'];
//$description = $_POST['venuedescription'];
//$photo = $_POST['venuephoto'];
//$map = $_POST['venuemap'];



include("db_connect.php");
	
	
	$name = mysql_escape_string(stripslashes(trim($name)));
	$genre = mysql_escape_string(stripslashes(trim($state)));
	$city =mysql_escape_string(stripslashes(trim($city)));
	$state = mysql_escape_string(stripslashes(trim($street)));
	//$description = mysql_escape_string(stripslashes(trim($description)));
	//$photo = mysql_escape_string(stripslashes(trim($photo)));
	//$map = mysql_escape_string(stripslashes(trim($map)));

	
	
	$band = "WHERE bandName='$old_name'";
	
	if (!empty($name)) mysqli_query($db, "UPDATE band SET bandName='$name' $band");
	if (!empty($genre)) mysqli_query($db, "UPDATE band SET bandgenre='$genre' $band");
	if (!empty($city)) mysqli_query($db, "UPDATE band SET bandCity='$city' $band");
	if (!empty($state)) mysqli_query($db, "UPDATE band SET bandState='$state' $band");
	//if (!empty($photo)) mysqli_query($db, "UPDATE venue SET venuePhoto='$photo' $band");
	//if (!empty($map)) mysqli_query($db, "UPDATE venue SET venueMap='$map' $band");
	//if (!empty($description)) mysqli_query($db, "UPDATE venue SET venueDescription='$description' $band");
	
	
	header("location:bandprofile.php?saved=1&name=$name&genre=$genre&city=$city&state=$state");
?>
