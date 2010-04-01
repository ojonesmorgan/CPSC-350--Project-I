<?php
$track_id = $_GET['track'];
include("db_connect.php");
mysqli_query($db, "UPDATE audio SET play_count = (play_count + 1) WHERE track_id = '$track_id'");
header("location:track.php?id=$track_id&autostart=1#play");
?>