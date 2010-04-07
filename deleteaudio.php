<?php
include("session.php");

if (!$logged_in)
{
	include("notloggedin.php");
}

include("db_connect.php");

$track_id = $_GET['track'];

mysqli_query($db, "DELETE FROM audio WHERE track_id = '$track_id'");

header("location:track.php?id=$track_id");
?>