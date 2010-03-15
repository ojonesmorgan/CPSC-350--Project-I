<?php
include("session.php");
if (!$logged_in) include("notloggedin.php");

include("db_connect.php");
  
$name = mysql_escape_string(stripslashes(htmlspecialchars(trim($_POST['name']))));
$street = mysql_escape_string(stripslashes(htmlspecialchars(trim($_POST['street']))));
$city = mysql_escape_string(stripslashes(htmlspecialchars(trim($_POST['city'])))); 
$state = mysql_escape_string(stripslashes(htmlspecialchars(trim($_POST['state']))));
$picture = mysql_escape_string(stripslashes(htmlspecialchars(trim($_POST['picture']))));
$description = mysql_escape_string(stripslashes(htmlspecialchars(trim($_POST['description']))));
$map = mysql_escape_string(stripslashes(htmlspecialchars(trim($_POST['map']))));
  
if (!empty($name)) mysqli_query($db, "INSERT INTO venue (venueName, venueState, venueCity, venueStreet, venueDescription, venuePicture, venueMap) VALUES ('$name', '$state', '$city', '$street', '$description', '$picture', '$map')");
else header("location:addVenueForm.php?err=noname&name=$name&street=$street&city=$city&state=$state&description=$description&picture=$picture&map=$map");
?>
 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>BandLink | Venue Added</title>
  <link rel="stylesheet" type="text/css" href="style.css" />
</head>

<body>
<div id="wrap">
<?php include("header.php"); ?>
<center><div>
	
<?php
echo "<br /><h1>Thanks for adding the venue $name.</h1>";
echo "<p><a href='venueprofile.php?name=$name'>Click here to go to the venue profile for $name.</a></p><br />\n";
?>
	
</div></center></div>
</body>
</html>