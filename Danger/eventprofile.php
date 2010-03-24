<?php
include("session.php");

$saved = $_GET['saved'] == 1;
$name = $_GET['name'];

if (empty($name))
{
	header("location:eventsearch.php");
	exit;
}

include("db_connect.php");
$result = mysqli_query($db, "SELECT e.eventName, b.bandName, v.venueName, e.eventDate, e.eventTime, e.eventDescription FROM event e INNER JOIN ON e.venue_id=v.venue_id AND e.band_id=b.band_id WHERE eventName = '$name'");
$count = 0;

while ($row = mysqli_fetch_assoc($result))
{
	$eventName = $row['e.eventName'];
	$bandName = $row['b.bandName'];
	$venueName = $row['v.venueName'];
	$eventDate = $row['e.eventDate'];
	$eventTime = $row['e.eventTime'];
	$description = $row['e.eventDescription'];

	++$count;
}

if ($count < 1)
{
	header("location:eventsearch.php");
    exit;
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Venue Link | Venue Profile</title>
  <link rel="stylesheet" type="text/css" href="style.css" />
</head>

<body>
<div id="wrap">
    <?php include("header.php"); ?>
	<div id="main">
	<!--<center><div>-->

	<h1><u><?php echo $name; ?></u><?php include("ratings.php"); ?></h1>
	
	<?php

	if ($saved)
	{
		echo "<fieldset style='border:2px solid white; background-color:black;'>";
		echo "<p style='color:white; font-weight:bold; text-align:center;'>";
		echo "Your changes have been saved.";
		echo "</p></fieldset>";
	}
	
	if ($logged_in) echo "<form method='post' action='updateevent.php?id=$name'>";
	echo "<p>";
	//echo "<label for='name'>Event Name:</label> ";
	//if ($logged_in) echo "<input name='name' type='text' value='$name' />";
	//else echo "<a style='text-decoration:none;' name='name'>$name</a><br /><br />";
	
	echo "<br /><label for='bandName'>Band:</label> ";
	if ($logged_in) echo "<input name='bandName' type='text' value='$bandName' />";
	else echo "<a style='text-decoration:none;' name='bandName'>$bandName</a><br />";
	echo "<br /><label for='venueName'>Venue:</label> ";
	if ($logged_in) echo "<input name='venueName' type='text' value='$venueName' />";
	else echo "<a style='text-decoration:none;' name='city'>$venueName</a><br />";
	echo "<br /><label for='eventDate'>Date:</label> ";
	if ($logged_in) echo "<input name='eventDate' type='text' value='$eventDate' />";
	else echo "<a style='text-decoration:none;' name='eventDate'>$eventDate</a><br />";
	echo "<br /><label for='eventTime'>Date:</label> ";
	if ($logged_in) echo "<input name='eventTime' type='text' value='$eventTime' />";
	else echo "<a style='text-decoration:none;' name='eventTime'>$eventTime</a><br />";
	echo "<br /><label style='vertical-align:top;' for='eventDescription'>Description:</label> ";
	if ($logged_in) echo "<textarea name='eventDescription' rows=5>$eventDescription</textarea>";
	else echo "<br /><a style='text-decoration:none;' name='eventDescription'>".nl2br($eventDescription)."</a><br />";
	
	if ($logged_in)
	{
		echo "<p><input style='display:block; margin-left:auto; margin-right:auto;' type='submit' ";
		echo "value=' Save Changes ' /></p></form>";
	}
	
	echo "</p>\n";
	
	include("listcomments.php");
	?>
	
	<!--</div></center>-->
	
	</div> <!-- end main div -->
	
	<?php include("projectSideBar.php"); ?>
	<?php include("footer.html");?>
</body>
</div>
</html>