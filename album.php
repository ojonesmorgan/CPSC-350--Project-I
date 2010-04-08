<?php
include("session.php");

$saved = $_GET['saved'] == 1;
$album_id = $_GET['id'];

if (empty($album_id))
{
	header("location:musicsearch.php");
	exit;
}

include("db_connect.php");

$query = "SELECT * FROM album NATURAL JOIN band WHERE album_id = '$album_id'";
$result = mysqli_query($db, $query);

while ($row = mysqli_fetch_assoc($result))
{
	$name = $row['name'];
	$artwork = $row['artwork'];
	$band_id = $row['band_id'];
	$album_artist = $row['bandName'];
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>BandLink | Album</title>
  <link rel="stylesheet" type="text/css" href="style.css" />
</head>

<body>
<div id="wrap">
    <?php include("header.php"); ?>
	<div id="main">
	<!--<center><div>-->

	<h1>
	<?php
	echo "<span style='text-decoration:underline;'>";
	echo "<a style='color:red;' href='bandprofile.php?id=$band_id'>$album_artist</a> - ";
	echo "<span style='font-style:italic;'>$name</span></span> \n";
	
	include("ratings.php");
	
	if ($logged_in)
	{
		echo "<p>";
		
		if ($_GET['edit'] != 1)
		{
			echo "<input type='submit' onClick=\"parent.location = 'album.php?id=$album_id&edit=1'\" ";
			echo "value='Edit' />\n";
		}
		
		echo "<input type='submit' onClick=\"if (confirm('Permanently delete this album?')) ";
		echo "parent.location = 'deletealbum.php?id=$album_id&band=$band_id';\" ";
		echo "value='Delete' />\n";
		echo "</p>";
	}
	?>
	</h1>
	
	<?php
	$edit_view = $logged_in && ($_GET['edit'] == 1);
	
	if ($saved && !$edit_view)
	{
		echo "<fieldset style='border:2px solid white; background-color:black;'>";
		echo "<p style='color:white; font-weight:bold; text-align:center;'>";
		echo "Your changes have been saved.";
		echo "</p></fieldset>";
	}
	
	if ($edit_view) echo "<form name='albumform' method='post' action='updatealbum.php?id=$album_id'>";
	echo "<p>";
	
	if ($edit_view)
	{
		echo "<label for='title'>Title:</label> ";
		echo "<input name='title' type='text' value='$name' />";
	}
	
	//echo "<label for='artist'>Album Artist:</label> ";
	//echo "<a style='text-decoration:none;' name='artist'>$album_artist</a><br />";
	
	if ($edit_view)
	{
		echo "<br /><label for='photo'>Artwork: ";
		echo "<a href='uploadImage.php?sent=album' target='_blank'>Upload</a></label> ";
		echo "<input name='photo' type ='text' value='$artwork' />";
	}
	
	if (!empty($artwork))
	{
		echo "<img style='width:275px; height:275px; display:block; margin-left:auto; margin-right:auto;' src='";
		echo "$artwork' border=0 alt='$name by $album_artist' />";
	}
	
	if ($edit_view)
	{
		echo "<p><input style='display:block; margin-left:auto; margin-right:auto;' type='submit' ";
		echo "value=' Save Changes ' /></p></form>";
	}
	
	echo "<p><table style='width:485px; margin-left:auto; margin-right:auto;' id='hor-minimalist-b' ";
	echo "name='tracks'>\n";
	echo "<th style='font-weight:bold;'>#</th>\n";
	echo "<th style='font-weight:bold;'>Artist</th>\n";
	echo "<th style='font-weight:bold;'>Title</th>\n";
	if ($logged_in) echo "<th style='font-weight:bold;'></th>\n";
	
	$num_col = 3;
	if ($logged_in) ++$num_col;
	
	$query = "SELECT * FROM album_track INNER JOIN tracks ON album_track.track_id = tracks.track_id ";
	$query .= "WHERE album_id = '$album_id' ORDER BY album_track.track_number";
	$result = mysqli_query($db, $query);
	$count = 0;
	$track_number_list = "";
	
	while ($row = mysqli_fetch_assoc($result))
	{
		$track_id = $row['track_id'];
		$title = $row['title'];
		$track_number = $row['track_number'];
		$track_number_list .= "$track_number,";
		
		$query = "SELECT * FROM track_bands NATURAL JOIN band WHERE track_id = '$track_id' ORDER BY track_band_id";
		$result2 = mysqli_query($db, $query);
		$artist_count = 0;
		$band_array = array();
		$id_array = array();
		
		while ($row2 = mysqli_fetch_assoc($result2))
		{
			$band_array[$artist_count] = $row2['bandName'];
			$id_array[$artist_count] = $row2['band_id'];
		
			++$artist_count;
		}
		
		$query = "SELECT * FROM audio WHERE track_id = '$track_id'";
		$result2 = mysqli_query($db, $query);
		$playable = false;
		
		while ($row2 = mysqli_fetch_assoc($result2))
		{
			$playable = !empty($row2['mp3_name']);
		}
		
		$artist = "";
		
		for ($i = 0; $i < $artist_count; $i++)
		{
			$artist .= "<a style='color:darkblue;' href='bandprofile.php?id=".$id_array[$i]."'>".$band_array[$i]."</a>";
			
			if (($artist_count > 2) && ($i <= ($artist_count - 2))) $artist .= ", ";
			if (($artist_count == 2) && ($i == $artist_count - 2)) $artist .= " ";
			if (($artist_count > 1) && ($i == $artist_count - 2)) $artist .= "& ";
		}
		
		echo "<tr>";
		echo "<td>$track_number</td>";
		echo "<td>$artist</td>";
		echo "<td><a style='color:darkblue;' href='track.php?id=$track_id&album=$album_id'>$title</a></td>";
		
		if ($logged_in)
		{
			echo "<td><span style='float:right;'>";
			
			if ($playable)
			{
				echo "<input onClick=\"parent.location = 'play.php?track=$track_id'\" type='submit' value=' Play ' />&nbsp;";
			}
			
			echo "<input onClick=\"parent.location = 'track.php?id=$track_id&album=$album_id&edit=1'\" type='submit' ";
			echo "value=' Edit/Remove ' />";
			echo "</span></td>";
		}
		
		echo "</tr>\n";
		
		++$count;
	}
	
	if ($count < 1)
	{
		echo "<tr><td colspan=$num_col style='text-align:center;'>No tracks have been added to this album.</td></tr>\n";
	}
	
	echo "</table></p>\n";
	echo "<br />\n";
	
	if ($logged_in)
	{
		$query = "SELECT * FROM tracks WHERE track_id NOT IN ";
		$query .= "(SELECT track_id FROM album_track WHERE album_id = '$album_id')";
		$result = mysqli_query($db, $query);
		$add_menu = "<select name='addtrack'>\n";
		$count = 0;
		$add_count = 0;
		
		while ($row = mysqli_fetch_assoc($result))
		{
			$option = "<option value='".$row['track_id']."'>".$row['title']."</option>\n";
			
			if ($row['track_id'] != $track_id)
			{
				$add_menu .= $option;
				++$add_count;
			}
			
			++$count;
		}
		
		$add_menu .= "</select>\n";
		
		if ($count > 0)
		{
			echo "<fieldset style='border:1px solid red; text-align:center;'>\n";
			echo "<legend style='color:red;'>Albums</legend>\n";
		}
		
		if ($add_count > 0)
		{
			echo "<form method='post' action='addalbumtrack.php?ref=album&id=$album_id'>\n";
			echo "<p style='text-align:center;'>\n";
			echo "<input type='submit' value='Add' />";
			echo " the track $add_menu</p>\n";
			echo "<p style='text-align:center;'>\n";
			echo "to this album as track # ";
			echo "<select name='addtracknum'>\n";
			
			for ($i = 1; $i <= 99; $i++)
			{
				echo "<option value='$i'>$i</option>\n";
			}
			
			echo "</select>\n";
			echo "</p>\n";
			echo "</form>\n";
			echo "<p style='text-align:center;'>or</p>\n";
			echo "<input style='display:block; margin:15px auto 10px auto;' ";
			echo "onClick=\"parent.location = 'addtrack.php?album=$album_id&band=$band_id';\" type='submit' ";
			echo "value='  Add a New Track to $name  ' />\n";
		}
		
		if ($count > 0)
		{
			echo "</fieldset>\n";
		}
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