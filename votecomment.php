<?php
include("session.php");

if (!$logged_in) include("notloggedin.php");

$rank = $_GET['rank'];
$id = $_GET['id'];
$ref = $_GET['ref'];
$email = $_SESSION['email'];

if ($rank == "up") $vote = 1;
if ($rank == "down") $vote = -1;

include("db_connect.php");

$is_poster = false;
$result = mysqli_query($db, "SELECT * FROM comments WHERE id = '$id'");

while ($row = mysqli_fetch_assoc($result))
{
	if ($row['email'] == $email) $is_poster = true;
}

if (!$is_poster)
{
	$has_voted = false;
	$same_vote = false;
	$current_rank = 0;
	$result = mysqli_query($db, "SELECT * FROM votes WHERE id = '$id'");
	
	while ($row = mysqli_fetch_assoc($result))
	{
		if ($row['email'] == $email)
		{
			$has_voted = true;
			if ($row['vote'] == $vote) $same_vote = true;
		}
	}

	if (!$has_voted) mysqli_query($db, "INSERT INTO votes VALUES ('$id', '$vote', '$email')");
	else if (!$same_vote) mysqli_query($db, "UPDATE votes SET vote = '$vote' WHERE id = '$id' AND email = '$email'");
}

header("location:$ref#$id");
?>