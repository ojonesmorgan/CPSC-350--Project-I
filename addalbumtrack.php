<?php
include("session.php");

if (!$logged_in)
{
	include("notloggedin.php");
}

include("db_connect.php");

$ref = $_GET['ref'];

if ($ref == "album")
{
	$album_id = $_GET['id'];
	$track_id = $_POST['addtrack'];
}

else
{
	$track_id = $_GET['id'];
	$album_id = $_POST['addalbum'];
}

$track_number = $_POST['addtracknum'];

if (empty($track_id) || empty($album_id))
{
	header("location:musicsearch.php");
	exit;
}

$query = "INSERT INTO album_track (track_id, album_id, track_number) VALUES ('$track_id', '$album_id', '$track_number')";
mysqli_query($db, $query);

if ($ref == "album")
{
	header("location:album.php?id=$album_id&saved=1");
	exit;
}

else header("location:track.php?id=$track_id&album=$album_id&saved=1");
?>