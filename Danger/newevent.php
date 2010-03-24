<?php
include("session.php");
if (!$logged_in) include("notloggedin.php");

include("db_connect.php");
  
$event = mysql_escape_string(stripslashes(htmlspecialchars(trim($_POST['event']))));
$band = mysql_escape_string(stripslashes(htmlspecialchars(trim($_POST['band']))));
$venue = mysql_escape_string(stripslashes(htmlspecialchars(trim($_POST['venue'])))); 
$date = mysql_escape_string(stripslashes(htmlspecialchars(trim($_POST['date']))));
$time = mysql_escape_string(stripslashes(htmlspecialchars(trim($_POST['time']))));
$description = mysql_escape_string(stripslashes(htmlspecialchars(trim($_POST['description']))));

//<Insert New Band into DB>
if (!empty($name)) mysqli_query($db, $query = "INSERT INTO event (eventName, band_id, venue_id, eventDate, eventTime, eventDescription) VALUES ('$eventName', '$band_id', '$venue_id', '$eventDate', '$eventTime', '$eventdescription',)");
else header("location:addevent.php?err=noname&name=$name&genre=$genre&city=$city&state=$state&description=$description&photo=$photo");

//</Insert New Event into DB>
//***********************************************
//<Find Event's ID>
	//<Find Last Event Entered>
		$quickQ="SLECECT event_id FROM event ORDER BY event_id DESC LIMIT 1";
		$quickR=mysqli_query($db,$quickQ);
		while ($quickRow= mysqli_fetch_array($quickR)){
			$bandID=$quickRow['event_id'];
		}
	//</Find Last Event Entered>
//</Find Event's ID>
//***********************************************

//if (!empty($name)) mysqli_query($db, $query = "INSERT INTO band (bandName, bandState, bandDescription, bandPhoto) VALUES ('$name', '$state', '$description', '$photo')");
//else header("location:addevent.php?err=noname&name=$name&genre=$genre&city=$city&state=$state&description=$description&photo=$photo");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>BandLink | Event Added</title>
  <link rel="stylesheet" type="text/css" href="style.css" />
</head>

<body>
<div id="wrap">
<?php include("header.php"); ?>
<center><div>
	
<?php
echo "<br /><h1>Thanks for adding the Event $name.</h1>";
echo "<p><a href='eventprofile.php?name=$name'>Click here to go to ".$name."'s profile.</a></p><br />\n";
?>
	
</div></center></div>
</body>
</html>