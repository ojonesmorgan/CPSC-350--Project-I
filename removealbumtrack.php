<?php
include("session.php");

if (!$logged_in)
{
	include("notloggedin.php");
}

include("db_connect.php");

$track_id = $_GET['id'];
$album_id = $_POST['removealbum'];

$query = "DELETE FROM album_track WHERE track_id = '$track_id' AND album_id = '$album_id'";
mysqli_query($db, $query);

header("location:track.php?id=$track_id&saved=1");
?>