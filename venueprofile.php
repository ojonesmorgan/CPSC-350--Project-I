<?php
include("session.php");

$saved = $_GET['saved'] == 1;
$name = $_GET['name'];

if (empty($name))
{
	header("location:searchVenue.php");
	exit;
}

include("db_connect.php");
$result = mysqli_query($db, "SELECT * FROM venue WHERE venueName = '$name'");
$count = 0;

while ($row = mysqli_fetch_assoc($result))
{
	$street = $row['venueStreet'];
	$city = $row['venueCity'];
	$state = $row['venueState'];
	$description = $row['venueDescription'];
	$picture = $row['venuePicture'];
	$map = $row['venueMap'];

	++$count;
}

if ($count < 1)
{
	header("location:searchVenue.php");
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

	<h1><u><?php echo $name; ?>'s Profile</u></h1>
	
	<?php
	$default_picture = "Pictures/default.jpg";
	$default_map = "Map/default.jpg";
	
	//the code below will only try to display the image from the path pulled
	//from the database if the image exists... other wise it will set to default.
	if (empty($picture)) $picture = $default_picture; //set $picture to default image
	if (empty($map)) $map = $default_map; // set $map to default map
	
	if ($saved)
	{
		echo "<fieldset style='border:2px solid white; background-color:black;'>";
		echo "<p style='color:white; font-weight:bold; text-align:center;'>";
		echo "Your changes have been saved.";
		echo "</p></fieldset>";
	}
	
	if ($logged_in) echo "<form method='post' action='updatevenue.php?id=$name'>";
	echo "<p>";
	echo "<label for='name'>Venue:</label> ";
	if ($logged_in) echo "<input name='name' type='text' value='$name' />";
	else echo "<a style='text-decoration:none;' name='name'>$name</a><br />";
	echo "<br /><label for='street'>Street:</label> ";
	if ($logged_in) echo "<input name='street' type='text' value='$street' />";
	else echo "<a style='text-decoration:none;' name='street'>$street</a><br />";
	echo "<br /><label for='city'>City:</label> ";
	if ($logged_in) echo "<input name='city' type='text' value='$city' />";
	else echo "<a style='text-decoration:none;' name='city'>$city</a><br />";
	echo "<br /><label for='state'>State:</label> ";
	if ($logged_in) echo "<input name='state' type='text' value='$state' />";
	else echo "<a style='text-decoration:none;' name='state'>$state</a><br />";
	echo "<br /><label style='vertical-align:top;' for='description'>Description:</label> ";
	if ($logged_in) echo "<textarea name='description' rows=5>$description</textarea>";
	else echo "<br /><a style='text-decoration:none;' name='description'>$description</a><br />";
	
	if ($logged_in)
	{
		echo "<br /><label for='picture'>Picture URL:</label> <input name='picture' type='text' value='";
		if ($picture != $default_picture) echo $picture;
		echo "' />";
		echo "<br /><label for='picture'>Map URL:</label> <input name='map' type='text' value='";
		if ($map != $default_map) echo $map;
		echo "' />";
	}
	
	echo "\n<p style='text-align:center;'><img style='border:1px solid red;";
	if ($picture == $default_picture) echo " height:100px; width:150px;";
	echo "' src='$picture' /></p>";
	echo "\n<p style='text-align:center;'><img style='border:1px solid red;";
	if ($map == $default_map) echo " height:100px; width:150px;";
	echo "' src='$map' /></p>";
	
	if ($logged_in)
	{
		echo "<p><input style='display:block; margin-left:auto; margin-right:auto;' type='submit' ";
		echo "value=' Save Changes ' /></p></form>";
	}
	
	echo "</p>\n";
	?>
	
	<!--</div></center>-->
	
	</div> <!-- end main div -->
	
	<?php include("projectSideBar.php"); ?>
	<?php include("footer.html");?>
</body>
</div>
</html>