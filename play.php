<?php
$track_id = $_GET['track'];
header("location:track.php?id=$track_id&autostart=1#play");
?>