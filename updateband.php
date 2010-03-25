<?php
include("session.php");

if (!$logged_in) include("notloggedin.php");
include("db_connect.php");

$id = $_GET['id'];
$name = $_POST['name'];
$genres = $_POST['genres'];
$city = $_POST['city'];
$state = $_POST['state'];
$description = $_POST['description'];
$photo = $_POST['photo'];

$id = mysql_escape_string(stripslashes(htmlspecialchars(strip_tags(trim($id)))));
$name = mysql_escape_string(stripslashes(htmlspecialchars(strip_tags(trim($name)))));
$genres = mysql_escape_string(stripslashes(htmlspecialchars(strip_tags(trim($genres)))));
$city = mysql_escape_string(stripslashes(htmlspecialchars(strip_tags(trim($city)))));
$state = mysql_escape_string(stripslashes(htmlspecialchars(strip_tags(trim($state)))));
$description = mysql_escape_string(stripslashes(htmlspecialchars(strip_tags(trim($description)))));
$photo = mysql_escape_string(stripslashes(htmlspecialchars(strip_tags(trim($photo)))));

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
		
		mysqli_query($db, "INSERT INTO band_genre (band_id, genre_id) VALUES ('$id', '$genre_id')");
	}
	
	$result = mysqli_query($db, "SELECT * FROM band_genre WHERE band_id = '$id'");
	
	while ($row = mysqli_fetch_assoc($result))
	{
		$genre_id = $row['genre_id'];
		
		$result2 = mysqli_query($db, "SELECT * FROM genre WHERE genre_id = '$genre_id'");
		
		while ($row2 = mysqli_fetch_assoc($result2))
		{
			$genre_name = $row2['genre'];
		}
		
		if (!in_array($genre_name, $genre_array))
		{
			mysqli_query($db, "DELETE FROM band_genre WHERE genre_id = '$genre_id'");
		}
	}
}

$saved_id = $id;
$band = "WHERE band_id='$id'";

mysqli_query($db, "UPDATE band SET bandName='$name' $band");
mysqli_query($db, "UPDATE band SET bandCity='$city' $band");
mysqli_query($db, "UPDATE band SET bandState='$state' $band");
mysqli_query($db, "UPDATE band SET bandPhoto='$photo' $band");
mysqli_query($db, "UPDATE band SET bandDescription='$description' $band");
if (!empty($id)) mysqli_query($db, "UPDATE band SET band_id='$id' $band"); //This must be the LAST update query.
else $saved_id = $id;

header("location:bandprofile.php?id=$saved_id&saved=1");
?>