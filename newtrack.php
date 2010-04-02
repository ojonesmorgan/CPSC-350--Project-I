<?php
include("session.php");
if (!$logged_in) include("notloggedin.php");

include("db_connect.php");

$title = $_POST['title'];
$track_number = $_POST['tracknum'];
$genre = $_POST['genre'];
$year = $_POST['year'];
$composer = $_POST['composer'];
$description = $_POST['description'];
$artists = $_POST['bandids'];

$title = mysql_escape_string(stripslashes(htmlspecialchars(strip_tags(trim($title)))));
$track_number = mysql_escape_string(stripslashes(htmlspecialchars(strip_tags(trim($track_number)))));
$genre = mysql_escape_string(stripslashes(htmlspecialchars(strip_tags(trim($genre)))));
$year = mysql_escape_string(stripslashes(htmlspecialchars(strip_tags(trim($year)))));
$composer = mysql_escape_string(stripslashes(htmlspecialchars(strip_tags(trim($composer)))));
$description = mysql_escape_string(stripslashes(htmlspecialchars(strip_tags(trim($description)))));
$artists = mysql_escape_string(stripslashes(htmlspecialchars(strip_tags(trim($artists)))));

$genre_id = 0;
$result = mysqli_query($db, "SELECT * FROM genre WHERE genre = '$genre'");

while ($row = mysqli_fetch_assoc($result))
{
	$genre_id = $row['genre_id'];
}

if ($genre_id == 0)
{
	mysqli_query($db, "INSERT INTO genre (genre) VALUES ('$genre')");
	
	$result = mysqli_query($db, "SELECT MAX(genre_id) AS max_genre_id FROM genre WHERE genre = '$genre'");
	
	while ($row = mysqli_fetch_assoc($result))
	{
		$genre_id = $row['max_genre_id'];
	}
}

$query = "INSERT INTO tracks (title, track_number, genre_id, year, composer, description) ";
$query .= "VALUES ('$title', '$track_number', '$genre_id', '$year', '$composer', '$description')";

if (!empty($title) && !empty($artists)) mysqli_query($db, $query);

else
{
	header("location:addtrack.php?err=missinginfo&title=$title&tracknum=$track_number&genre=$genre&year=$year&composer=$composer&description=$description&artists=$artists");
	exit;
}

$result = mysqli_query($db, "SELECT MAX(track_id) AS max_track_id FROM tracks");

while ($row = mysqli_fetch_assoc($result))
{
	$track_id = $row['max_track_id'];
}

if (!empty($artists))
{	
	$band_array = array_unique(explode(",", $artists));
	
	foreach ($band_array as $band_id)
	{
		mysqli_query($db, "INSERT INTO track_bands (track_id, band_id) VALUES ('$track_id', '$band_id')");
	}
}
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
echo "<br /><h1>Thanks for adding the track \"".stripslashes($title).".\"</h1>";
echo "<p><a href='track.php?id=$track_id'>Click here to view and edit this track's information.</a></p>\n";
echo "<p><a href='addtrack.php?artists=$artists'>Click here to add another track by this artist.</a></p><br />\n";
?>
	
</div></center></div>
</body>
</html>