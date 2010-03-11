<?php
include("session.php");

$name = $_POST['venuename'];
$state = $_POST['venuestate'];
$city = $_POST['venuecity'];
$street = $_POST['venuestreet'];
$description = $_POST['venuedescription'];
$photo = $_POST['venuephoto'];
$map = $_POST['venuemap'];



include("db_connect.php");
	
	
	$name = mysql_escape_string(stripslashes(trim($name)));
	$state = mysql_escape_string(stripslashes(trim($state)));
	$city =mysql_escape_string(stripslashes(trim($city)));
	$street = mysql_escape_string(stripslashes(trim($street)));
	//$description = mysql_escape_string(stripslashes(trim($description)));
	//$photo = mysql_escape_string(stripslashes(trim($photo)));
	//$map = mysql_escape_string(stripslashes(trim($map)));

	
	
	$venue = "WHERE venueName='$name'";
	
	if (!empty($name)) mysqli_query($db, "UPDATE venue SET venueName='$name' $venue");
	if (!empty($state)) mysqli_query($db, "UPDATE venue SET venueState='$state' $venue");
	if (!empty($city)) mysqli_query($db, "UPDATE venue SET venueCity='$city' $venue");
	if (!empty($street)) mysqli_query($db, "UPDATE venue SET venueStreet='$street' $venue");
	//if (!empty($photo)) mysqli_query($db, "UPDATE venue SET venuePhoto='$photo' $venue");
	//if (!empty($map)) mysqli_query($db, "UPDATE venue SET venueMap='$map' $venue");
	//if (!empty($description)) mysqli_query($db, "UPDATE venue SET venueDescription='$description' $venue");
	
	header("location:venueprofile.php?saved=1&name=$name&state=$state&city=$city&street=$street");
	
?>
