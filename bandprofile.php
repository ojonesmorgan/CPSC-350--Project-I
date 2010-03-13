<?php
include("session.php");

if (!$logged_in)
{
	header("location:login.php?err=accessdenied");
	exit;
}

$saved = $_GET['saved'] == 1;
$name = $_GET['name'];

if (empty($name))
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

	<h1><u><?php echo $name; ?>'s Profile</u></h1>
	
	<?php
	include("db_connect.php");
	$result = mysqli_query($db, "SELECT * FROM band WHERE bandName = '$name'");
	$count = 0;

	while ($row = mysqli_fetch_assoc($result))
	{
		$genre = $row['bandGenre'];
		$city = $row['bandCity'];
		$state = $row['bandState'];
		$description = $row['bandDescription'];
		$photo = $row['bandPhoto'];

		++$count;
	}

	if ($count < 1)
	{
		header("location:musicsearch.php");
	        exit;
	}
	
	$default_photo = "Pictures/default.jpg";
	
	//the code below will only try to display the image from the path pulled
	//from the database if the image exists... other wise it will set to default.
	if (empty($photo) || !file_exists($photo) || !is_array(getimagesize($photo))) $photo = $default_photo; //set $photo to default image
	
	if ($saved)
	{
		echo "<fieldset style='border:2px solid white; background-color:black;'>";
		echo "<p style='color:white; font-weight:bold; text-align:center;'>";
		echo "Your changes have been saved.";
		echo "</p></fieldset>";
	}
	
	echo "<form method='post' action='updateband.php?id=$name'><p>";
	echo "<label for='name'>Band Name:</label> <input name='name' type='text' value='$name' />";
	echo "<label for='genre'>Genre(s):</label> <input name='genre' type='text' value='$genre' />";
	echo "<label for='city'>City:</label> <input name='city' type='text' value='$city' />";
	echo "<label for='state'>State:</label> <input name='state' type='text' value='$state' />";
	echo "<label style='vertical-align:top;' for='description'>Description:</label> ";
	echo "<textarea name='description' rows=5>$description</textarea>";
	echo "<label for='photo'>Photo:</label> <input name='photo' type='text' value='";
	if ($photo != $default_photo) echo $photo;
	echo "' />";
	echo "<p style='text-align:center;'><img style='border:1px solid red;";
	if ($photo == $default_photo) echo " height:100px; width:150px;";
	echo "' src='$photo' /></center></p>";
	echo "<p><input style='display:block; margin-left:auto; margin-right:auto;' type='submit' value=' Save Changes ' />";
	echo "</p></p></form>";
	?>
	
	<!--</div></center>-->
	
	</div> <!-- end main div -->
	
	<?php include("projectSideBar.php"); ?>
	<?php include("footer.html");?>
</body>
</div>
</html>