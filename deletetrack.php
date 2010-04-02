<?php
$track_id = $_GET['id'];
$band_id = $_GET['band'];
include("db_connect.php");

mysqli_query($db, "DELETE FROM tracks WHERE track_id = '$track_id'");
mysqli_query($db, "DELETE FROM track_bands WHERE track_id = '$track_id'");
mysqli_query($db, "DELETE FROM audio WHERE track_id = '$track_id'");

header("location:bandprofile.php?id=$band_id#tracks");
?>