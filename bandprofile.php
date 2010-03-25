<?php
include("session.php");

$saved = $_GET['saved'] == 1;
$bandID = $_GET['id'];

if (empty($bandID))
{
	header("location:musicsearch.php");
	exit;
}


include("db_connect.php");

$result = mysqli_query($db, "SELECT * FROM band WHERE band_id = '$bandID'");
$count = 0;

while ($row = mysqli_fetch_assoc($result))
{
	$name = $row['bandName'];
	$city = $row['bandCity'];
	$state = $row['bandState'];
	$description = $row['bandDescription'];
	$photo = $row['bandPhoto'];

	++$count;
}

$genre = "";
$query = "SELECT * FROM band_genre WHERE band_id = '$bandID'";
$result2 = mysqli_query($db, $query);
$first = true;
		
while ($row2 = mysqli_fetch_assoc($result2))
{	
	$result3 = mysqli_query($db, "SELECT * FROM genre WHERE genre_id = '".$row2['genre_id']."'");
	
	while ($row3 = mysqli_fetch_assoc($result3))
	{
		if (!$first) $genre .= ", ";
		$genre .= $row3['genre'];
		$first = false;
	}
}

if ($count < 1)
{
	header("location:musicsearch.php");
    exit;
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>BandLink | Band Profile</title>
  <link rel="stylesheet" type="text/css" href="style.css" />
</head>

<body>
<div id="wrap">
    <?php include("header.php"); ?>
	<div id="main">
	<!--<center><div>-->

	<h1><u><?php echo $name; ?></u><?php include("ratings.php"); ?></h1>
	
	<?php
	$default_photo = "Pictures/default.jpg";
	
	//the code below will only try to display the image from the path pulled
	//from the database if the image exists... other wise it will set to default.
	if (empty($photo)) $photo = $default_photo; //set $photo to default image
	
	if ($saved)
	{
		echo "<fieldset style='border:2px solid white; background-color:black;'>";
		echo "<p style='color:white; font-weight:bold; text-align:center;'>";
		echo "Your changes have been saved.";
		echo "</p></fieldset>";
	}
	
	if ($logged_in) echo "<form method='post' action='updateband.php?id=$bandID'>";
	echo "<p>";
	echo "<br><label for='name'>Band Name:</label> ";
	if ($logged_in) echo "<input name='name' type='text' value='$name' />";
	else echo "<a style='text-decoration:none;' name='name'>$name</a><br /><br />";
	echo "<br /><label for='genres'>Genre(s)</label> ";
	if ($logged_in) echo "<input name='genres' type='text' value='$genre' />";
	else echo "<a style='text-decoration:none;' name='genres'>$genre</a><br />";
	echo "<br /><label for='city'>City:</label> ";
	if ($logged_in) echo "<input name='city' type='text' value='$city' />";
	else echo "<a style='text-decoration:none;' name='city'>$city</a><br />";
	echo "<br /><label for='state'>State:</label> ";
	if ($logged_in) echo "<input name='state' type='text' value='$state' />";
	else echo "<a style='text-decoration:none;' name='state'>$state</a><br />";
	echo "<br /><label style='vertical-align:top;' for='description'>Description:</label> ";
	if ($logged_in) echo "<textarea name='description' rows=5>$description</textarea>";
	else echo "<br /><a style='text-decoration:none;' name='description'>".nl2br($description)."</a><br />";
	
	if ($logged_in)
	{
		echo "<br /><label for='photo'> Photo: ";
		echo "<input type='button' onClick=\"parent.location = 'uploadImage.php?sent=editband&band=$bandID';\" ";
		echo "value=' Upload ' /></label> ";
		echo "<input name='photo' type ='text' value='";
		if (!empty($_GET['picPath'])) $photo = $_GET['picPath'];
		if ($photo != $default_photo) echo $photo;
		echo "' />";
	}
	
	echo "\n<p style='text-align:center;'><img style='border:1px solid red;";
	if ($photo == $default_photo) echo " height:100px; width:150px;";
	echo "' src='$photo' alt='$name' /></p>";
	
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