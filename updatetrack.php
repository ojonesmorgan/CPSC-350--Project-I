<?php
include("session.php");

if (!$logged_in) include("notloggedin.php");
include("db_connect.php");

$id = $_GET['id'];
$title = $_POST['title'];
$track_number = $_POST['tracknum'];
$genre = $_POST['genre'];
$year = $_POST['year'];
$composer = $_POST['composer'];
$description = $_POST['description'];
$artists = $_POST['bandids'];

$id = mysql_escape_string(stripslashes(htmlspecialchars(strip_tags(trim($id)))));
$title = mysql_escape_string(stripslashes(htmlspecialchars(strip_tags(trim($title)))));
$track_number = mysql_escape_string(stripslashes(htmlspecialchars(strip_tags(trim($track_number)))));
$genre = mysql_escape_string(stripslashes(htmlspecialchars(strip_tags(trim($genre)))));
$year = mysql_escape_string(stripslashes(htmlspecialchars(strip_tags(trim($year)))));
$composer = mysql_escape_string(stripslashes(htmlspecialchars(strip_tags(trim($composer)))));
$description = mysql_escape_string(stripslashes(htmlspecialchars(strip_tags(trim($description)))));
$artists = mysql_escape_string(stripslashes(htmlspecialchars(strip_tags(trim($artists)))));

if (!empty($artists))
{	
	mysqli_query($db, "START TRANSACTION");
	mysqli_query($db, "DELETE FROM track_bands WHERE track_id = '$id'");
	
	$band_array = explode(",", $artists);
	
	foreach ($band_array as $band_id)
	{
		$result = mysqli_query($db, "SELECT * FROM track_bands WHERE track_id = '$id' AND band_id = '$band_id'");
		$band_added = false;
		
		while ($row = mysqli_fetch_assoc($result))
		{
			$band_added = true;
		}
	
		if (!$band_added) mysqli_query($db, "INSERT INTO track_bands (track_id, band_id) VALUES ('$id', '$band_id')");
	}
	
	mysqli_query($db, "COMMIT");
}

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

mysqli_query($db, "UPDATE tracks SET title = '$title' WHERE track_id = '$id'");
mysqli_query($db, "UPDATE tracks SET track_number = '$track_number' WHERE track_id = '$id'");
mysqli_query($db, "UPDATE tracks SET year = '$year' WHERE track_id = '$id'");
mysqli_query($db, "UPDATE tracks SET composer = '$composer' WHERE track_id = '$id'");
mysqli_query($db, "UPDATE tracks SET genre_id = '$genre_id' WHERE track_id = '$id'");
mysqli_query($db, "UPDATE tracks SET description = '$description' WHERE track_id = '$id'");

header("location:track.php?id=$id&saved=1");
?>