<?php
include("session.php");
include("db_connect.php");
if (!$logged_in) include("notloggedin.php");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>BandLink | Add Event</title>
  <link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>
<script type="text/javascript" src="calendarDateInput.js"></script>
<div id="wrap">
<?php include("header.php"); ?>
<div id="main">
<h1><u>Add an Event</u></h1>
  
	<?php
	$error = $_GET['err'];
	$name = $_GET['name'];
	$band = $_GET['band'];
	$venue = $_GET['venue'];
	$date = $_GET['date'];
	$time = $_GET['time'];
	$description = $_GET['description'];
	
	if (isset($error))
	{
		echo "<fieldset style='border:2px solid white; background-color:black;'>";
		echo "<p style='color:white; font-weight:bold; text-align:center;'>";
		if ($error == "noname") echo "Please enter a name for this event.";
		echo "</p></fieldset>";
	}
	
	if ($logged_in) echo "<form method='post' action='newEvent.php'>";
	echo "<p>";
	echo "<label for='name'>Event Name:</label> ";
	echo "<input name='name' type='text' value='$name' />";
	?>
	
	<!--Band drop down menu-->

	<?php
	$table1 = "band";
	$query1 = "SELECT band_id, bandName FROM $table1";
	$result1 = mysqli_query($db, $query1) or die("Error Querying Database");
	?>
	<tr><td>
	<?php echo "<label for=\"band\">Band:</label><br /><select name=\"id\">";
	while($row1 = mysqli_fetch_array($result1)) 
	{
		$band_id = $row['band_id'];
		$bandName = $row['bandName'];
		echo "<option value=\"$band_id\">$bandName</option>";
	}
	echo "</select><br />";
	?>
	</td><td>
	<th rowspan="2"></th>
	</td></tr>

	<!--Venue drop down menu-->

	<?php
	$table = "venue";
	$query = "SELECT venue_id, venueName FROM $table";
	$result = mysqli_query($db, $query) or die("Error Querying Database");
	?>
	<tr><td>
	<?php echo "<label for=\"venue\">Venue:</label><br /><select name=\"id\">";
	while($row = mysqli_fetch_array($result)) 
	{
		$venue_id = $row['venue_id'];
		$venueName = $row['venueName'];
  		echo "<option value=\"$venue_id\">$venueName</option>";
	}
	echo "</select><br />";

	?>
	</td><td>
	<th rowspan="2"></th>
	</td></tr>
	
	<?php
	mysqli_close($db);
	?>
	
	<tr><td>
	<label for="date">Date:</label>
    <script>DateInput('date', true, 'YYYY-MM-DD')</script>
    </td></tr>
	
	<?php
	


	#echo "br /><label for='date'>Date:</label>";
	#echo "<input name='time' type='text' value='$time' /.>";

	echo "<br /><label for='time'>Time:</label> ";
	echo "<input name='time' type='text' value='$time' />";
	
	echo "<br /><label style='vertical-align:top;' for='description'>Description:</label> ";
	echo "<textarea name='description' rows=5>$description</textarea>";

	echo "<p><input style='display:block; margin-left:auto; margin-right:auto;' type='submit' ";
	echo "value=' Submit ' /></p></form>";
	echo "</p>\n";
	?>
	
</div> <!-- end main div -->
 <?php include("projectSideBar.php"); ?>
 <?php include("footer.html");?>
</body>



</div> <!-- end wrap div -->
</html>
