<?php
include("db_connect.php");

$page = substr($_SERVER["SCRIPT_NAME"], strrpos($_SERVER["SCRIPT_NAME"], "/") + 1);
$band = $_GET['band'];
$venue = $_GET['venue'];
$event = $_GET['event'];
$track = $_GET['track'];
$album = $_GET['album'];

if ($page == "bandprofile.php" || !empty($band))
{	
	if (empty($band)) $band = $_GET['id'];
	
	$subject = array("name" => "band", "page" => "bandprofile.php", "field" => "band_id", "value" => "$band");
}

else if ($page == "venueprofile.php" || !empty($venue))
{
	if (empty($venue)) $venue = $_GET['id'];
	
	$subject = $subject = array("name" => "venue", "page" => "venueprofile.php", "field" => "venue_id", "value" => "$venue");
}

else if ($page == "eventprofile.php" || !empty($event))
{
	if (empty($event)) $event = $_GET['id'];
	
	$subject = array("name" => "event", "page" => "eventprofile.php", "field" => "event_id", "value" => "$event");
}

else if ($page == "track.php" || !empty($track))
{
	if (empty($track)) $track = $_GET['id'];
	
	$subject = array("name" => "tracks", "page" => "track.php", "field" => "track_id", "value" => "$track");
}

else if ($page == "album.php" || !empty($album))
{
	if (empty($album)) $album = $_GET['id'];
	
	$subject = array("name" => "album", "page" => "album.php", "field" => "album_id", "value" => "$album");
}

$query = "SELECT * FROM ".$subject['name']." WHERE ".$subject['field']." = '".$subject['value']."'";
$result = mysqli_query($db, $query);

while ($row = mysqli_fetch_assoc($result))
{
	$name_field = $subject['name']."Name";
	$name = $row[$name_field];
}

if ($page == "comments.php")
{
	echo "<br />\n<br />\n";
	echo "<input type='submit' style='display:block; margin-left:auto; margin-right:auto; width:400px; height:75px;' ";
	echo "onClick=\"parent.location = '".$subject['page']."?id=".$subject['value']."'\" value=";
	if ($subject['name'] == "band") echo "\"  Go to $name's Profile  \" />";
	if ($subject['name'] == "venue") echo "\"  Go to $name Profile  \" />";
	echo "<br />\n";
}

else echo "<br />\n<a name='comments'></a>\n<h1>Comments</h1>\n";

function display_rank($id)
{
	include("session.php");
	include("db_connect.php");
	
	$is_poster = false;
	$result = mysqli_query($db, "SELECT * FROM comments WHERE id = '$id'");
	
	while ($row = mysqli_fetch_assoc($result))
	{
		if ($row['email'] == $_SESSION['email']) $is_poster = true;
	}

	$rank = get_rank($id);
	$page = substr($_SERVER["SCRIPT_NAME"], strrpos($_SERVER["SCRIPT_NAME"], "/") + 1);
	echo "<span style='float:right;'>";
	
	if ($logged_in && !$is_poster)
	{
		echo "<a class='downrank' onMouseOver=\"this.style.backgroundColor='pink';\" ";
		echo "onMouseOut=\"this.style.backgroundColor='red';\" ";
		echo "href='votecomment.php?rank=down&id=$id&ref=$page?".$_SERVER["QUERY_STRING"]."' alt='downrank'>-</a>";
	}
	
	echo "<span style='font-weight:bold; color:";
	if ($rank < 0) echo "red";
	else if ($rank == 0 || empty($rank)) echo "gray";
	else if ($rank > 0) echo "green";
	echo "'>&nbsp;";
	if ($rank > 0) echo "+";
	if (empty($rank)) echo "0";
	else echo $rank;
	
	if ($logged_in && !$is_poster)
	{
		echo "&nbsp;<a class='uprank' onMouseOver=\"this.style.backgroundColor='lightgreen';\" ";
		echo "onMouseOut=\"this.style.backgroundColor='green';\" ";
		echo "href='votecomment.php?rank=up&id=$id&ref=$page?".$_SERVER["QUERY_STRING"]."' alt='uprank'>+</a>";
	}
	
	echo "</span></span>\n";
}

function get_rank($id)
{
	include("db_connect.php");
	$result = mysqli_query($db, "SELECT SUM(vote) AS rank FROM votes WHERE id = '$id'");
	
	while ($row = mysqli_fetch_assoc($result))
	{
		$rank = $row['rank'];
	}
	
	return $rank;
}

if ($logged_in)
{
	echo "<form method='post' action='postcomment.php?".$subject['name']."=".$subject['value']."'>\n";
	echo "<input type='hidden' name='reply' value='0' />";
	echo "<p style='text-align:center;'>";
	echo "<textarea class='comment' name='comment' rows=4></textarea>";
	echo "</p>";
	echo "<input style='display:block; margin-left:auto; margin-right:auto;' type='submit' value='  Post Comment  ' />";
	echo "\n</form>\n<br />\n";
}

else
{
	echo "<p style='text-align:center;'><a href='login.php?ref=comments.php?page=$page?".$_SERVER['QUERY_STRING'];
	echo "'>Log in</a> to leave a comment.</p>";
}

$query = "SELECT a.name AS poster, b.*, b.email AS posteremail, DATE_FORMAT(b.date, '%M %e, %Y') AS fdate,";
$query .= " TIME_FORMAT(b.time, '%l:%i %p') AS ftime";
$query .= " FROM users AS a NATURAL JOIN comments AS b";
$query .= " WHERE ".$subject['field']." = '".$subject['value']."'";
$reply_query = $query;
$query .= " AND reply = '0'";
$query .= " ORDER BY b.id DESC";
$result = mysqli_query($db, $query);
$comment_count = 0;

while ($row = mysqli_fetch_assoc($result))
{
	if (($comment_count < 10) || ($page == "comments.php"))
	{
		$poster = $row['poster'];
		$date = $row['fdate'];
		$time = $row['ftime'];
		$comment = $row['comment'];
		$poster_email = $row['posteremail'];
		$id = $row['id'];
		echo "<a name='$id'></a>";
		echo "<fieldset class='comment'>\n";
		echo "<span style='font-weight:bold;'>$poster:</span>\n";
		display_rank($id);
		echo "<blockquote>$comment</blockquote>\n";
		
		if ($logged_in)
		{
			echo "<span style='float:left; font-size:x-small;'><a style='color:darkred;' href='#$id' ";		
			echo "onClick=\"document.reply$id.style.display = 'inline';\">Reply</a>";
		}
		
		if ((!empty($poster_email) && ($poster_email == $_SESSION['email'])) || $is_admin)
		{
			echo "&nbsp;&nbsp;<a style='color:darkred;' href='deletecomment.php?id=$id&ref=$page?".$_SERVER["QUERY_STRING"]."'>Delete</a>";
		}
		
		echo "</span>\n";
		echo "<span style='float:right; font-style:italic; font-size:x-small;'>Posted on $date at $time.</span>\n";
		echo "\n</fieldset>\n";
		
		$query = $reply_query." AND reply = '$id' ORDER BY b.date, b.time";
		$result2 = mysqli_query($db, $query);
		
		if ($logged_in)
		{
			echo "<a name='replyto$id'></a>";
			echo "<form style='display:none;' name='reply$id' method='post' action='postcomment.php?";
			echo $subject['name']."=".$subject['value']."'>\n";
			echo "<input type='hidden' name='reply' value='$id' />";
			echo "<p style='text-align:center;'>";
			echo "<textarea class='comment' name='comment' rows=4></textarea>";
			echo "</p>";
			echo "<input style='display:block; margin-left:auto; margin-right:auto;' type='submit' value='  Reply  ' />";
			echo "\n<br />\n</form>";
		}
		
		while ($row2 = mysqli_fetch_assoc($result2))
		{
			$poster2 = $row2['poster'];
			$date2 = $row2['fdate'];
			$time2 = $row2['ftime'];
			$comment2 = $row2['comment'];
			$poster_email2 = $row2['posteremail'];
			$id2 = $row2['id'];
			
			echo "<a name='$id2'></a>";
			echo "<fieldset class='reply'>\n";
			echo "<span style='font-weight:bold;'>$poster2</span> in reply to $poster:\n";
			display_rank($id2);
			echo "<blockquote>$comment2</blockquote>\n";
			echo "<span style='float:left; font-size:x-small;'>";
		
			if ((!empty($poster_email2) && ($poster_email2 == $_SESSION['email'])) || $is_admin)
			{
				echo "<a style='color:darkred;' href='deletecomment.php?id=$id2&ref=$page?".$_SERVER["QUERY_STRING"]."'>Delete</a>";
			}
			
			echo "</span>\n";
			echo "<span style='float:right; font-style:italic; font-size:x-small;'>";
			echo "Posted on $date2 at $time2.</span>\n";
			echo "\n</fieldset>\n";
		}
	}
	
	++$comment_count;
}

if (($page != "comments.php") && ($comment_count > 10))
{
	echo "<p style='text-align:center;'><a href='comments.php?".$subject['name']."=".$subject['value'];
	echo "'>See all $comment_count comments...</a></p><br />\n";
}

else echo "<br />\n";
?>