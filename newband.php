<?php
include("session.php");
if (!$logged_in) include("notloggedin.php");

include("db_connect.php");

$name = mysql_escape_string(stripslashes(htmlspecialchars(strip_tags(trim($_POST['name'])))));
$state = mysql_escape_string(stripslashes(htmlspecialchars(strip_tags(trim($_POST['state'])))));
$city = mysql_escape_string(stripslashes(htmlspecialchars(strip_tags(trim($_POST['city'])))));
$genres = mysql_escape_string(stripslashes(htmlspecialchars(strip_tags(trim($_POST['genres'])))));
$photo = mysql_escape_string(stripslashes(htmlspecialchars(strip_tags(trim($_POST['photo'])))));
$description = mysql_escape_string(stripslashes(htmlspecialchars(strip_tags(trim($_POST['description'])))));

$query = "INSERT INTO band (bandName, bandCity, bandState, bandDescription, bandPhoto) ";
$query .= "VALUES ('$name', '$city', '$state', '$description', '$photo')";

if (!empty($name))
{
	mysqli_query($db, $query);
	
	$result = mysqli_query($db, "SELECT band_id FROM band");
		
	while ($row = mysqli_fetch_assoc($result))
	{
		$band_id = $row['band_id'];
	}
	
	if (!empty($genres))
	{
		$genre_array = explode(", ", $genres);
		
		foreach ($genre_array as $genre)
		{
			$result = mysqli_query($db, "SELECT * FROM genre");
			$genre_id = 0;
			
			while ($row = mysqli_fetch_assoc($result))
			{
				if ($genre == $row['genre']) $genre_id = $row['genre_id'];
			}
			
			if ($genre_id == 0)
			{
				mysqli_query($db, "INSERT INTO genre (genre) VALUES ('$genre')");
				
				$result = mysqli_query($db, "SELECT genre_id FROM genre");
		
				while ($row = mysqli_fetch_assoc($result))
				{
					$genre_id = $row['genre_id'];
				}
			}
			
			mysqli_query($db, "INSERT INTO band_genre (band_id, genre_id) VALUES ('$band_id', '$genre_id')");
		}
	}
}

else header("location:addband.php?err=noname&name=$name&genre=$genre&city=$city&state=$state&description=$description&photo=$photo");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>BandLink | Band Added</title>
  <link rel="stylesheet" type="text/css" href="style.css" />
</head>

<body>
<div id="wrap">
<?php include("header.php"); ?>
<center><div>
	
<?php
echo "<br /><h1>Thanks for adding the band $name.</h1>";
echo "<p><a href='bandprofile.php?id=$band_id'>Click here to go to ".$name."'s profile.</a></p><br />\n";
?>
	
</div></center></div>
</body>
</html>