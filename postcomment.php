<?php
include("session.php");

if (!$logged_in) include("notloggedin.php");

define("BAND", "band");
define("VENUE", "venue");

$comment = mysql_escape_string(stripslashes(htmlspecialchars($_POST['comment'])));
$reply = $_POST['reply'];
$band = $_GET['band'];
$venue = $_GET['venue'];
$email = $_SESSION['email'];

date_default_timezone_set("America/New_York");
$date = date("Y-m-d");
$time = date("H:i:s");

if (!empty($band) && empty($venue)) $subject = BAND;
if (empty($band) && !empty($venue)) $subject = VENUE;

if (!isset($subject))
{
	header("location:.");
	exit;
}

if (trim($comment) != "")
{
	include("db_connect.php");
	
	$query = "INSERT INTO comments (comment, date, time, reply, email, ";
	if ($subject == BAND) $query .= "bandName";
	else if ($subject == VENUE) $query .= "venueName";
	$query .= ") VALUES ('$comment', '$date', '$time', '$reply', '$email', ";
	if ($subject == BAND) $query .= "'$band'";
	else if ($subject == VENUE) $query .= "'$venue'";
	$query .= ")";
	mysqli_query($db, $query);
}
	
$anchor = $reply;
if (empty($anchor)) $anchor = "comments";
if ($subject == BAND) header("location:bandprofile.php?name=$band#$anchor");
else if ($subject == VENUE) header("location:venueprofile.php?name=$venue#$anchor");
?>