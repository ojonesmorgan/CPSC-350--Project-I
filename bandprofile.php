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

//**********************************
$query="Select Genre from band b join genre g join band_genre bg where b.band_id=bg.band_id
		and g.genre_id=bg.genre_id and b.band_id=" .$bandID;
	//$query = "Select * from band b join genre g join band_genre bg where b.band_id=bg.band_id
	//and g.genre_id=bg.genre_id ORDER BY RAND() LIMIT 1";
	
	$counter=0;
	$results = mysqli_query($db, $query);	 
	while($row = mysqli_fetch_array($results)) {
	$counter=$counter+1;
	
		if ($counter==1){//1st genre
			$genre1=$row['Genre'];	
		}
		if ($counter==2){//2nd genre
			$genre2=$row['Genre'];
		}
		if ($counter==3){//3rd genre
			$genre3=$row['Genre'];
		}
		if ($counter==4){//4th genre
			$genre4=$row['Genre'];
		}
	}
//**********************************
$result = mysqli_query($db, "SELECT * FROM band WHERE band_id = '$bandID'");
//echo "band name: " .$name;
$count = 0;
while ($row = mysqli_fetch_assoc($result))
{
	//$genre = $row['bandGenre'];
	//$city = $row['bandCity'];
	$name=$row['bandName'];
	$state = $row['bandState'];
	$description = $row['bandDescription'];
	$photo = $row['bandPhoto'];

	++$count;
}
echo "band name: " .$name;

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
	//echo "<label for='name'>Band Name:</label> ";
	//if ($logged_in) echo "<input name='name' type='text' value='$name' />";
	//else echo "<a style='text-decoration:none;' name='name'>$name</a><br /><br />";
	//*********************************************
	//<Genre(s)>
	echo "<br><label for='geners'>Genre(s)</label>";
	//<1>
	echo "<br><label for='genre1'>Genre 1:</label> ";
	if ($logged_in) echo "<input name='genre1' type='text' value='$genre1' />";
	else echo "<a style='text-decoration:none;' name='genre1'>$genre1</a><br />";
	//</1>
	//<2>
	echo "<br><label for='genre2'>Genre 2:</label> ";
	if ($logged_in) echo "<input name='genre2' type='text' value='$genre2' />";
	else echo "<a style='text-decoration:none;' name='genre2'>$genre2</a><br />";
	//</2>
	//<3>
	echo "<br><label for='genre3'>Genre 3:</label> ";
	if ($logged_in) echo "<input name='genre3' type='text' value='$genre3' />";
	else echo "<a style='text-decoration:none;' name='genre3'>$genre3</a><br />";
	//</3>
	//<4>
	echo "<br><label for='genre4'>Genre 4:</label> ";
	if ($logged_in) echo "<input name='genre4' type='text' value='$genre4' />";
	else echo "<a style='text-decoration:none;' name='genre4'>$genre4</a><br />";
	//</4>
	//</Genre(s)>
	//*********************************************
	//echo "<br /><label for='city'>City:</label> ";
	//if ($logged_in) echo "<input name='city' type='text' value='$city' />";
	//else echo "<a style='text-decoration:none;' name='city'>$city</a><br />";
	echo "<br /><label for='state'>State:</label> ";
	if ($logged_in) echo "<input name='state' type='text' value='$state' />";
	else echo "<a style='text-decoration:none;' name='state'>$state</a><br />";
	echo "<br /><label style='vertical-align:top;' for='description'>Description:</label> ";
	if ($logged_in) echo "<textarea name='description' rows=5>$description</textarea>";
	else echo "<br /><a style='text-decoration:none;' name='description'>".nl2br($description)."</a><br />";
	
	if ($logged_in)
	{
		echo "<br /><label for='photo'>Photo URL:</label> <input name='photo' type='text' value='";
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