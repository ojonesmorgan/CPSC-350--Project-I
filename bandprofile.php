<?php
include("session.php");

$saved = $_GET['saved'] == 1;
$bandID = $_GET['id'];

if (empty($bandID))
{
	header("location:musicsearch.php");
	exit;
}


include("db_connect.php");

$result = mysqli_query($db, "SELECT * FROM band WHERE band_id = '$bandID'");
$count = 0;

while ($row = mysqli_fetch_assoc($result))
{
	$name = $row['bandName'];
	$city = $row['bandCity'];
	$state = $row['bandState'];
	$description = $row['bandDescription'];
	$photo = $row['bandPhoto'];

	++$count;
}

$genre = "";
$query = "SELECT * FROM band_genre WHERE band_id = '$bandID'";
$result2 = mysqli_query($db, $query);
$first = true;
		
while ($row2 = mysqli_fetch_assoc($result2))
{	
	$result3 = mysqli_query($db, "SELECT * FROM genre WHERE genre_id = '".$row2['genre_id']."'");
	
	while ($row3 = mysqli_fetch_assoc($result3))
	{
		if (!$first) $genre .= ", ";
		$genre .= $row3['genre'];
		$first = false;
	}
}

if ($count < 1)
{
	header("location:musicsearch.php");
    exit;
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>BandLink | Band Profile</title>
  <link rel="stylesheet" type="text/css" href="style.css" />
</head>

<body>
<div id="wrap">
    <?php include("header.php"); ?>
	<div id="main">
	<!--<center><div>-->

	<h1>
	<?php
	echo "<span style='text-decoration:underline;'>$name</span>\n";
	
	if ($logged_in)
	{
		if ($_GET['edit'] != 1)
		{
			echo " <input type='submit' onClick=\"parent.location = parent.location + '&edit=1'\" ";
			echo "value=' Edit ' />\n";
		}
	}
	
	include("ratings.php");
	?>
	</h1>
	
	<?php
	$edit_view = $logged_in && ($_GET['edit'] == 1);
	$default_photo = "Pictures/default.jpg";
	
	//the code below will only try to display the image from the path pulled
	//from the database if the image exists... other wise it will set to default.
	if (empty($photo)) $photo = $default_photo; //set $photo to default image
	
	if ($saved && !$edit_view)
	{
		echo "<fieldset style='border:2px solid white; background-color:black;'>";
		echo "<p style='color:white; font-weight:bold; text-align:center;'>";
		echo "Your changes have been saved.";
		echo "</p></fieldset>";
	}
	
	if ($edit_view) echo "<form method='post' action='updateband.php?id=$bandID'>";
	echo "<p>";
	echo "<label for='name'>Band Name:</label> ";
	if ($edit_view) echo "<input name='name' type='text' value='$name' />";
	else echo "<a style='text-decoration:none;' name='name'>$name</a><br />";
	echo "<br /><label for='genres'>Genre(s):</label> ";
	if ($edit_view) echo "<input name='genres' type='text' value='$genre' />";
	else echo "<a style='text-decoration:none;' name='genres'>$genre</a><br />";
	echo "<br /><label for='city'>City:</label> ";
	if ($edit_view) echo "<input name='city' type='text' value='$city' />";
	else echo "<a style='text-decoration:none;' name='city'>$city</a><br />";
	echo "<br /><label for='state'>State:</label> ";
	if ($edit_view) echo "<input name='state' type='text' value='$state' />";
	else echo "<a style='text-decoration:none;' name='state'>$state</a><br />";
	echo "<br /><label style='vertical-align:top;' for='description'>Description:</label> ";
	if ($edit_view) echo "<textarea name='description' rows=5>$description</textarea>";
	else echo "<p><a style='text-decoration:none;' name='description'>".nl2br($description)."</a></p>";
	
	if ($edit_view)
	{
		echo "<br /><label for='photo'> Photo: ";
		echo "<a href=\"uploadImage.php?sent=editband&venue=$venueID&other=$photo\" target=\"_blank\"> Upload</a></label> ";
		//echo "<input type='button' onClick=\"parent.location = 'uploadImage.php?sent=editband&band=$bandID';\" ";
		//echo "value=' Upload ' /></label> ";
		echo "<input name='photo' type ='text' value='";
		if (!empty($_GET['picPath'])) $photo = $_GET['picPath'];
		if ($photo != $default_photo) echo $photo;
		echo "' />";
	}
	
	echo "\n<p style='text-align:center;'><img style='border:1px solid red;";
	if ($photo == $default_photo) echo " height:100px; width:150px;";
	echo "' src='$photo' alt='$name' /></p>";
	
	if ($edit_view)
	{
		echo "<p><input style='display:block; margin-left:auto; margin-right:auto;' type='submit' ";
		echo "value=' Save Changes ' /></p></form>";
	}
	
	echo "</p>\n";
	
	echo "<br /><a name='albums'></a>\n";
	echo "<h1>Albums</h1>\n";
	echo "<p><table border=0 cellspacing=15>\n";
	
	$result = mysqli_query($db, "SELECT * FROM album WHERE band_id = '$bandID' ORDER BY RAND() LIMIT 5");
	$count = 0;
	
	while ($row = mysqli_fetch_assoc($result))
	{
		$album_id = $row['album_id'];
		$album_name = $row['name'];
		$artwork = $row['artwork'];
		
		echo "<tr>";
		echo "<td><a href='album.php?id=$album_id'><img style='width:100px; height:100px;' src='";
		if (!empty($artwork)) echo $artwork;
		else echo "Pictures/default.jpg";
		echo "' border=0 alt='$album_name by $name' /></a></td>";
		echo "<td style='vertical-align:middle;'>";
		echo "<a style='color:red; text-decoration:none; font-weight:bold; font-style:italic;' ";
		echo "href='album.php?id=$album_id'>$album_name</a></td>";
		echo "</tr>";
		
		++$count;
	}
	
	echo "</table>\n";
	
	if ($count < 1)
	{
		echo "<p style='color:red; text-align:center;'>No albums have been added for this artist.</p>\n";
	}
	
	echo "</p>\n";
	
	if ($logged_in)
	{
		echo "<p><input style='display:block; margin-left:auto; margin-right:auto;' ";
		echo "onClick=\"parent.location = 'addalbum.php?band=$bandID'\" type='submit' ";
		echo "value='  Add a New Album by $name  ' /></p>\n";
	}
	
	echo "<br /><a name='tracks'></a>\n";
	echo "<h1>Popular Tracks</h1>\n";
	echo "<p><table style='width:485px; margin-left:auto; margin-right:auto;' id='hor-minimalist-b' ";
	echo "name='populartracks'>\n";
	echo "<th style='font-weight:bold;'></th>\n";
	echo "<th style='font-weight:bold;'>Title</th>\n";
	echo "<th style='font-weight:bold;'>Play Count</th>\n";
	echo "<th style='font-weight:bold;'>Rating</th>\n";
	if ($logged_in) echo "<th style='font-weight:bold;'></th>\n";
	
	$query = "SELECT tracks.track_id, title, play_count, mp3_name, ";
	$query .= "(SELECT AVG(rating) FROM ratings WHERE tracks.track_id = ratings.track_id) AS rating ";
	$query .= "FROM tracks LEFT OUTER JOIN audio ON tracks.track_id = audio.track_id ";
	$query .= "WHERE tracks.track_id IN (SELECT track_id FROM track_bands WHERE band_id = '$bandID') ";
	$query .= "ORDER BY play_count DESC, rating DESC, RAND()";
	$result = mysqli_query($db, $query);
	$count = 0;
	$num_col = 4;
	if ($logged_in) ++$num_col;
	
	while ($row = mysqli_fetch_assoc($result))
	{		
		$track_id = $row['track_id'];
		$title = "<a style='color:darkblue;' href='track.php?id=$track_id'>".stripslashes($row['title'])."</a>";
		$play_count = $row['play_count'];
		$rating = $row['rating'];
		$playable = !empty($row['mp3_name']);
		if (empty($play_count)) $play_count = 0;
	
		echo "<tr id='row$count'";
		if ($count >= 10) echo " style='display:none;'";
		echo ">";
		echo "<td>".($count + 1)."</td>";
		echo "<td>$title</td>";
		echo "<td>$play_count</td>";
		echo "<td>";
		
		for ($i = 1; $i <= 5; $i++)
		{
			echo "<img border=0 src='";
			if ($rating >= $i) echo "Pictures/fullstar.gif";
			else if ($rating >= ($i - .5)) echo "Pictures/halfstar.gif";
			else echo "Pictures/emptystar.gif";
			echo "' />";
		}
		
		echo "</td>";
		
		if ($logged_in)
		{
			echo "<td>";
			
			if ($playable)
			{
				echo "<input style='float:right;' onClick=\"parent.location = 'play.php?track=$track_id'\" ";
				echo "type='submit' value=' Play ' />";
			}
			
			echo "</td>";
		}
		
		echo "</tr>\n";
		
		++$count;
	}
	
	if ($count > 10)
	{
		echo "<tr style='text-align:center;' id='moreButton'><td colspan=$num_col>";
		echo "<input style='width:460px;' onClick=\"document.getElementById('moreButton').style.display = 'none'; ";
		
		for ($i = 10; $i <= $count; $i++)
		{
			echo "document.getElementById('row$i').style.display = 'table-row'; ";
		}
		
		echo "\" type='submit' ";
		echo "value=' More ' /></td></tr>";
	}
	
	else if ($count < 1)
	{
		echo "<tr><td colspan=$num_col style='text-align:center;'>No tracks have been added for this artist.</td></tr>\n";
	}
	
	echo "</table></p>\n";
	
	if ($logged_in) 
	{
		echo "<p><input style='display:block; margin-left:auto; margin-right:auto;' ";
		echo "onClick=\"parent.location = 'addtrack.php?band=$bandID'\" type='submit' ";
		echo "value='  Add a New Track by $name  ' /></p>\n";
	}
	
	include("listcomments.php");
	?>
	
	<!--</div></center>-->
	
	</div> <!-- end main div -->
	
	<?php include("projectSideBar.php"); ?>
	<?php include("footer.html");?>
</body>
</div>
</html>