<?php
include("session.php");

if (!$logged_in) include("notloggedin.php");

$rating = $_GET['rating'];
$band = $_GET['band'];
$venue = $_GET['venue'];
$email = $_SESSION['email'];
$has_rated = false;

if (!empty($band))
{
	$name = $band;
	$condition = "WHERE bandName = '$name'";
}
	
else if (!empty($venue))
{
	$name = $venue;
	$condition = "WHERE venueName = '$name'";
}

include("db_connect.php");

$result = mysqli_query($db, "SELECT * FROM ratings $condition");

while ($row = mysqli_fetch_assoc($result))
{
	if ($row['email'] == $email) $has_rated = true;
}

$valid_ratings = array(1, 2, 3, 4, 5);

if (in_array($rating, $valid_ratings))
{
	if (!$has_rated) $query = "INSERT INTO ratings (rating, ";
	else $query = "UPDATE ratings SET rating = '$rating' WHERE ";
	if (!empty($band)) $query .= "bandName";
	else if (!empty($venue)) $query .= "venueName";
	if (!$has_rated) $query .= ", email) VALUES ('$rating', '$name', '$email')";
	else $query .= " = '$name' AND email = '$email'";
	mysqli_query($db, $query);
}

if (!empty($band)) header("location:bandprofile.php?name=$name&rated=1#rating");
else if (!empty($venue)) header("location:venueprofile.php?name=$name&rated=1#rating");
?>