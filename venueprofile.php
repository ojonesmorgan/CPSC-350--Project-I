<?php
include("session.php");

$saved = $_GET['saved'] == 1;
$venueID = $_GET['id'];

if (empty($venueID))
{
	header("location:venuesearch.php");
	exit;
}

include("db_connect.php");
$result = mysqli_query($db, "SELECT * FROM venue WHERE venue_id =".$venueID);
$count = 0;

while ($row = mysqli_fetch_assoc($result))
{
	//$street = $row['venueStreet'];
	//$city = $row['venueCity'];
	//$state = $row['venueState'];
	$name=$row['venueName'];
	$addressID=$row['venueAddress_id'];
	$zipcode=$row['venueZipCode'];
	$description = $row['venueDescription'];
	$picture = $row['venuePicture'];
	$map = $row['venueMap'];

	++$count;
}

if ($count < 1)
{
	header("location:venuesearch.php");
    exit;
}
//*****************************************
//<Get ZipCode Information>
$query="select * from venue v join venue_zip_code vz 
		where v.venueZipCode=vz.zip_code and vz.zip_code=".$zipcode;
$results=mysqli_query($db, $query);
while ($row=mysqli_fetch_array($results)){
	$city=$row['city'];
	$state=$row['state'];
}
//</Get ZipCode Information>
//*****************************************
//<Get Address Information>
$query="select * from venue v join venue_address va 
		where v.venueAddress_id = va.address_id and va.address_id=".$addressID;
$results=mysqli_query($db, $query);
while ($row=mysqli_fetch_array($results)){
	$streetnum=$row['number'];
	$street=$row['street'];
}
//</Get Address Information>
//*****************************************
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

	<h1>
	<?php
	echo "<span style='text-decoration:underline;'>$name</span>\n";
	
	if ($_GET['edit'] != 1)
	{
		echo " <input type='submit' onClick=\"parent.location = parent.location + '&edit=1'\" ";
		echo "value=' Edit ' />\n";
	}
	
	include("ratings.php");
	?>
	</h1>
	
	<?php
	$edit_view = $logged_in && ($_GET['edit'] == 1);
	$default_picture = "Pictures/default.jpg";
	//$default_map = "Map/default.jpg";
	
	//the code below will only try to display the image from the path pulled
	//from the database if the image exists... other wise it will set to default.
	if (empty($picture)) $picture = $default_picture; //set $picture to default image
	if (empty($map)) $map = $default_picture; // set $map to default map
	
	if ($saved && !$edit_view)
	{
		echo "<fieldset style='border:2px solid white; background-color:black;'>";
		echo "<p style='color:white; font-weight:bold; text-align:center;'>";
		echo "Your changes have been saved.";
		echo "</p></fieldset>";
	}
	
	if ($edit_view) echo "<form method='post' action='updatevenue.php?id=$venueID'>";
	echo "<p>";
	echo "<br><label for='name'>Venue Name:</label> ";
	if ($edit_view) echo "<input name='name' type='text' value='$name' />";
	else echo "<a style='text-decoration:none;' name='name'>$name</a><br /><br />";
	echo"<br><label for='streetnum'>Street Number:</label> ";
	if ($edit_view) echo "<input name='streetnum' type ='text' value='$streetnum' />";
	else echo "<a style='text-decoration:none;' name='streetnum'>$streetnum</a><br />";
	echo "<br><label for='street'>Street:</label> ";
	if ($edit_view) echo "<input name='street' type='text' value='$street' />";
	else echo "<a style='text-decoration:none;' name='street'>$street</a><br />";
	echo "<br /><label for='city'>City:</label> ";
	if ($edit_view) echo "<input name='city' type='text' value='$city' />";
	else echo "<a style='text-decoration:none;' name='city'>$city</a><br />";
	echo "<br /><label for='state'>State:</label> ";
	if ($edit_view) echo "<input name='state' type='text' value='$state' />";
	else echo "<a style='text-decoration:none;' name='state'>$state</a><br />";
	echo "<br /><label for='city'>Zip Code:</label> ";
	if ($edit_view) echo "<input name='zip_code' type='text' value='$zipcode' />";
	else echo "<a style='text-decoration:none;' name='zip_code'>$zipcode</a><br />";
	echo "<br /><label style='vertical-align:top;' for='description'>Description:</label> ";
	if ($edit_view) echo "<textarea name='description' rows=5>$description</textarea>";
	else echo "<br /><a style='text-decoration:none;' name='description'>".nl2br($description)."</a><br />";
	
	if ($edit_view)
	{
		echo "<br /><label for='photo'> Photo: ";
		echo "<input type='button' onClick=\"parent.location = 'uploadImage.php?sent=editvenue&venue=$venueID';\" ";
		echo "value=' Upload ' /></label> ";
		echo "<input name='photo' type ='text' value='";
		if (!empty($_GET['picPath'])) $photo = $_GET['picPath'];
		if ($photo != $default_photo) echo $photo;
		echo "' />";
		echo "<br /><label for='picture'>Map Image: ";
		echo "<input type='button' onClick=\"parent.location = 'uploadImage.php?sent=editmap&venue=$venueID';\" ";
		echo "value=' Upload ' /></label> ";
		echo "<input name='map' type='text' value='";
		if (!empty($_GET['mapPath'])) $map = $_GET['mapPath'];
		if ($map != $default_picture) echo $map;
		echo "' />";
		echo "<h6 color=red>**WARNING** Uploading an image will result in loss of any changes made to this form</h6>";
	}
	
	echo "\n<p style='text-align:center;'><img style='border:1px solid red;";
	if ($picture == $default_picture) echo " height:100px; width:150px;";
	echo "' src='$picture' alt='$name' /></p>";
	echo "\n<p style='text-align:center;'><img style='border:1px solid red;";
	if ($map == $default_picture) echo " height:100px; width:150px;";
	echo "' src='$map' alt='$name map' /></p>";
	
	if ($edit_view)
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