<?php
include("session.php");

if (!$logged_in) include("notloggedin.php");

$rating = $_GET['rating'];
$band = $_GET['band'];
$venue = $_GET['venue'];
$email = $_SESSION['email'];
$has_rated = false;

if (!empty($band)) $subject = array("name" => "band", "field" => "band_id", "value" => "$band");
if (!empty($venue)) $subject = array("name" => "venue", "field" => "venue_id", "value" => "$venue");

include("db_connect.php");

$result = mysqli_query($db, "SELECT * FROM ratings WHERE ".$subject['field']." = '".$subject['value']."'");

while ($row = mysqli_fetch_assoc($result))
{
	if ($row['email'] == $email) $has_rated = true;
}

$valid_ratings = array(1, 2, 3, 4, 5);

if (in_array($rating, $valid_ratings))
{
	if (!$has_rated) $query = "INSERT INTO ratings (rating, ";
	else $query = "UPDATE ratings SET rating = '$rating' WHERE ";
	$query .= $subject['field'];
	if (!$has_rated) $query .= ", email) VALUES ('$rating', '".$subject['value']."', '$email')";
	else $query .= " = '".$subject['value']."' AND email = '$email'";
	mysqli_query($db, $query);
}

header("location:".$subject['name']."profile.php?id=".$subject['value']."&rated=1#rating");
?>