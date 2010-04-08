<?php
include("session.php");

$saved = $_GET['saved'] == 1;
$track_id = $_GET['id'];
$album_id = $_GET['album'];
$autostart = ($_GET['autostart'] == 1);

if (empty($track_id))
{
	header("location:musicsearch.php");
	exit;
}

include("db_connect.php");

$query = "SELECT * FROM tracks LEFT OUTER JOIN genre ON tracks.genre_id = genre.genre_id ";
$query .= "WHERE track_id = '$track_id'";
$result = mysqli_query($db, $query);
$count = 0;

while ($row = mysqli_fetch_assoc($result))
{
	$title = stripslashes($row['title']);
	$genre = $row['genre'];
	$year = $row['year'];
	$composer = $row['composer'];
	$description = $row['description'];

	++$count;
}

if ($count < 1)
{
	header("location:musicsearch.php");
    exit;
}

$query = "SELECT * FROM track_bands NATURAL JOIN band WHERE track_id = '$track_id' ORDER BY track_band_id";
$result = mysqli_query($db, $query);
$count = 0;
$band_array = array();
$id_array = array();
$id_list = "";

while ($row = mysqli_fetch_assoc($result))
{
	$band_array[$count] = $row['bandName'];
	$id_array[$count] = $row['band_id'];
	$id_list .= ($row['band_id'].",");

	++$count;
}

$artist = "";
$artist_list = "";

for ($i = 0; $i < $count; $i++)
{
	$artist .= "<a style='color:red;' href='bandprofile.php?id=".$id_array[$i]."'>".$band_array[$i]."</a>";
	$artist_list .= $band_array[$i];
	
	if (($count > 2) && ($i <= ($count - 2))) $artist .= ", ";
	if (($count == 2) && ($i == $count - 2)) $artist .= " ";
	if (($count > 1) && ($i == $count - 2)) $artist .= "& ";
	
	if ($i != ($count - 1)) $artist_list .= ", ";
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>BandLink | Track</title>
  <link rel="stylesheet" type="text/css" href="style.css" />
</head>

<body>
<div id="wrap">
    <?php include("header.php"); ?>
	<div id="main">
	<!--<center><div>-->

	<h1>
	<?php
	echo "<span style='text-decoration:underline;'>$artist - \"$title\"</span> \n";
	
	$name = $title;
	include("ratings.php");
	
	if ($logged_in)
	{
		echo "<p>";
		
		if ($_GET['edit'] != 1)
		{
			echo "<input type='submit' onClick=\"parent.location = 'track.php?id=$track_id&album=$album_id&edit=1'\" ";
			echo "value='Edit' />\n";
		}
		
		echo "<input type='submit' onClick=\"if (confirm('Permanently delete this track?')) ";
		echo "parent.location = 'deletetrack.php?id=$track_id&band=".$id_list[0]."';\" ";
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
	
	if ($edit_view) echo "<form name='trackform' method='post' action='updatetrack.php?id=$track_id&album=$album_id'>";
	echo "<p>";
	echo "<label for='title'>Title:</label> ";
	if ($edit_view) echo "<input name='title' type='text' value='$title' />";
	else echo "<a style='text-decoration:none;' name='title'>$title</a><br />";
	echo "<br /><label for='artist'>Artist(s):";
	
	if ($edit_view)
	{
		echo " <input onClick=\"document.trackform.artist.value = ''; document.trackform.bandids.value = '';\" ";
		echo "type='button' value=' Reset ' />";
	}
	
	echo "</label> ";
	if ($edit_view) echo "<input name='artist' type='text' value='$artist_list' disabled />";
	else echo "<a style='text-decoration:none;' name='artist'>$artist</a><br />";
	
	if ($edit_view)
	{
		echo "<input type='hidden' name='bandids' value='$id_list' />\n";
		echo "<br /><label style='visibility:hidden;' for='bandlist'>Artist(s):</label> ";
		echo "<select style='margin:5px 5px 5px 0px;' name='bandlist'>\n";
		
		$result = mysqli_query($db, "SELECT * FROM band");
		
		while ($row = mysqli_fetch_assoc($result))
		{
			echo "<option value='".$row['band_id']."'>".$row['bandName']."</option>\n";
		}
		
		echo "</select>\n";
		echo "<input onClick=\"document.trackform.bandids.value += (document.trackform.bandlist.value + ','); ";
		echo "if (document.trackform.artist.value != '') document.trackform.artist.value += ', '; ";
		echo "document.trackform.artist.value += ";
		echo "document.trackform.bandlist.options[document.trackform.bandlist.selectedIndex].text;\" ";
		echo "type='button' value=' Add ' />";
	}
	
	if (!empty($album_id))
	{
		$query = "SELECT album.name, album_track.* FROM album LEFT OUTER JOIN album_track ";
		$query .= "ON album.album_id = album_track.album_id ";
		$query .= "WHERE album_track.track_id = '$track_id' AND album_track.album_id = '$album_id'";
		$result = mysqli_query($db, $query);
		
		while ($row = mysqli_fetch_assoc($result))
		{
			$album_name = stripslashes($row['name']);
			$track_number = $row['track_number'];
		}
	
		echo "<br /><label for='album'>Album:</label> ";
		echo "<a style='text-decoration:underline; color:red;' name='album' href='album.php?id=$album_id'>";
		echo "$album_name</a>";
		
		echo "<br /><label for='tracknum'>Track #:</label> ";
		if ($edit_view) echo "<input name='tracknum' type='text' value='$track_number' />";
		else echo "<a style='text-decoration:none;' name='tracknum'>$track_number</a><br />";
	}
	
	echo "<br /><label for='genres'>Genre:</label> ";
	if ($edit_view) echo "<input name='genre' type='text' value='$genre' />";
	else echo "<a style='text-decoration:none;' name='genre'>$genre</a><br />";
	echo "<br /><label for='year'>Year:</label> ";
	if ($edit_view) echo "<input name='year' type='text' value='$year' />";
	else echo "<a style='text-decoration:none;' name='year'>$year</a><br />";
	echo "<br /><label for='composer'>Composer:</label> ";
	if ($edit_view) echo "<input name='composer' type='text' value='$composer' />";
	else echo "<a style='text-decoration:none;' name='composer'>$composer</a><br />";
	echo "<br /><label style='vertical-align:top;' for='description'>Description:</label> ";
	if ($edit_view) echo "<textarea name='description' rows=5>$description</textarea>";
	else echo "<p><a style='text-decoration:none;' name='description'>".nl2br($description)."</a></p>";
	
	if ($logged_in)
	{
		$result = mysqli_query($db, "SELECT * FROM audio WHERE track_id = '$track_id'");
		
		while ($row = mysqli_fetch_assoc($result))
		{
			$mp3 = "audio/".$row['mp3_name'].".mp3";
		}
		
		if (!$edit_view && !$autostart)
		{
			echo "<fieldset style='border:1px solid red; text-align:center;'>\n";
			echo "<legend style='color:red;'>Audio</legend>\n";
		}
		
		if (!empty($mp3) && !$edit_view)
		{
			if ($autostart)
			{				
				echo "<a name='play'></a>\n";
				echo "<p style='text-align:center;'>";
				echo "<embed style='width:400px; height:50px; margin-left:auto; margin-right:auto;' ";
				echo "src='$mp3' autostart=true /></p>\n";
				
				mysqli_query($db, "UPDATE audio SET play_count = (play_count + 1) WHERE track_id = '$track_id'");
			}
			
			if (!$autostart)
			{
				echo "<input style='width:150px; margin-right:20px;' onClick=\"parent.location = ";
				echo "'play.php?track=$track_id';\" ";
				echo "type='submit' value=' Play ' />";
			}
			
			echo "<input style='width:150px;";
			if ($autostart) echo " display:block; margin-left:auto; margin-right:auto;";
			echo "' onClick=\"if (confirm('Delete audio for the track $title?')) ";
			echo "parent.location = 'deleteaudio.php?track=$track_id'\" ";
			echo "type='submit' value=' Delete MP3 ' />\n";
		}
		
		else if (!$edit_view)
		{
			if ($_GET['err'] == "uploadfail")
			{
				echo "<p style='text-align:center; color:red;'>";
				echo "An error occured and your file could not be uploaded.<br />Please try again.";
				echo "</p>\n";
			}
				
			echo "<form method='post' action='uploadaudio.php' enctype='multipart/form-data'>\n";
			echo "<input type='hidden' name='track' value='$track_id' />";
			echo "<input type='file' id='mp3' name='mp3' accept='*.mp3' /></p>";
			echo "<input style='display:block; margin:10px auto 0px auto;' type='submit' ";
			echo "value=' Upload MP3 ' />";
			echo "</form>\n";
		}
		
		if (!$edit_view && !$autostart)
		{
			echo "</fieldset>\n";
		}
	}
	
	if ($edit_view)
	{
		echo "<p><input style='display:block; margin-left:auto; margin-right:auto;' type='submit' ";
		echo "value=' Save Changes ' /></p></form>";
	}
	
	echo "</p>\n";
	
	if ($edit_view)
	{
		$result = mysqli_query($db, "SELECT * FROM album");
		$add_menu = "<select name='addalbum'>\n";
		$remove_menu = "<select name='removealbum'>\n";
		$count = 0;
		$add_count = 0;
		$remove_count = 0;
			
		while ($row = mysqli_fetch_assoc($result))
		{
			$option = "<option value='".$row['album_id']."'";
			if (!empty($album_id) && ($row['album_id'] == $album_id)) $option .= " selected";
			$option .= ">".$row['name']."</option>\n";
			
			$added = false;
			$query = "SELECT * FROM album_track WHERE album_id = '".$row['album_id']."' AND track_id = '$track_id'";
			$result2 = mysqli_query($db, $query);
			
			while ($row2 = mysqli_fetch_assoc($result2))
			{
				$added = true;
			}
			
			if (!$added)
			{
				$add_menu .= $option;
				++$add_count;
			}
			
			else
			{
				$remove_menu .= $option;
				++$remove_count;
			}
			
			++$count;
		}
		
		$add_menu .= "</select>\n";
		$remove_menu .= "</select>\n";
		
		if ($count > 0)
		{
			echo "<fieldset style='border:1px solid red; text-align:center;'>\n";
			echo "<legend style='color:red;'>Albums</legend>\n";
		}
		
		if ($add_count > 0)
		{
			echo "<form method='post' action='addalbumtrack.php?id=$track_id'>\n";
			echo "<p style='text-align:center;'>\n";
			echo "<input type='submit' value='Add' />";
			echo " this to the album $add_menu</p>";
			echo "<p style='text-align:center;'>\n";
			echo "as track # ";
			echo "<select name='addtracknum'>\n";
			
			for ($i = 1; $i <= 99; $i++)
			{
				echo "<option value='$i'>$i</option>\n";
			}
			
			echo "</select>\n";
			echo "</p>\n";
			echo "</form>\n";
		}
		
		if ($remove_count > 0)
		{
			echo "<form method='post' action='removealbumtrack.php?id=$track_id'>\n";
			echo "<p style='text-align:center;'>\n";
			echo "<input type='submit' value='Remove' />";
			echo " this track from the album $remove_menu";
			echo "</p>\n";
			echo "</form>\n";
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