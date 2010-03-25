<?php
include("session.php");

if (!$logged_in) include("notloggedin.php");

$comment = mysql_escape_string(stripslashes(htmlspecialchars(strip_tags($_POST['comment']))));
$reply = $_POST['reply'];
$band = $_GET['band'];
$venue = $_GET['venue'];
$email = $_SESSION['email'];

date_default_timezone_set("America/New_York");
$date = date("Y-m-d");
$time = date("H:i:s");

if (!empty($band)) $subject = array("name" => "band", "field" => "band_id", "value" => "$band");
if (!empty($venue)) $subject = array("name" => "venue", "field" => "venue_id", "value" => "$venue");

if (!isset($subject))
{
	header("location:.");
	exit;
}

if (trim($comment) != "")
{
	include("db_connect.php");
	
	$query = "INSERT INTO comments (comment, date, time, reply, email, ".$subject['field'];
	$query .= ") VALUES ('$comment', '$date', '$time', '$reply', '$email', ".$subject['value'].")";
	mysqli_query($db, $query);
}
	
$anchor = $reply;
if (empty($anchor)) $anchor = "comments";
header("location:".$subject['name']."profile.php?id=".$subject['value']."#$anchor");
?>