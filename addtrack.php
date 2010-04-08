<?php
include("session.php");
if (!$logged_in) include("notloggedin.php");

$band_id = $_GET['band'];
$album_id = $_GET['album'];
$title = $_GET['title'];
$track_number = $_GET['tracknum'];
$id_list = $_GET['artists'];
$genre = $_GET['genre'];
$year = $_GET['year'];
$composer = $_GET['composer'];
$description = $_GET['description'];

include("db_connect.php");

$result = mysqli_query($db, "SELECT * FROM band WHERE band_id = '$band_id'");

while ($row = mysqli_fetch_assoc($result))
{
	$band_name = $row['bandName'];
}

if (!empty($id_list))
{
	$artist_list = "";
	$artist_array = array_unique(explode(",", $id_list));
	
	foreach ($artist_array as $artist_id)
	{
		if ($artist_list != "") $artist_list .= ", ";
		
		$result = mysqli_query($db, "SELECT * FROM band WHERE band_id = '$artist_id'");
		
		while ($row = mysqli_fetch_assoc($result))
		{
			$artist_list .= $row['bandName'];
		}
	}
	
	$length = strlen($artist_list); 
	
	if (trim(substr($artist_list, ($length - 2), ($length - 1))) == ",")
	{
		$artist_list = substr($artist_list, 0, ($length - 2));
	}
}

if (empty($id_list) && !empty($band_id)) $id_list = $band_id.",";
if (empty($artist_list)) $artist_list = $band_name;
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>BandLink | Add Track</title>
  <link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>
<div id="wrap">
<?php include("header.php"); ?>
<div id="main">
  <h1><u>Add a Track</u></h1>
  
	<?php
	$error = $_GET['err'];
	
	if (isset($error))
	{
		echo "<fieldset style='border:2px solid white; background-color:black;'>";
		echo "<p style='color:white; font-weight:bold; text-align:center;'>";
		if ($error == "missinginfo") echo "You must enter a title and select at least one artist.";
		echo "</p></fieldset>";
	}
	
	echo "<form name='trackform' method='post' action='newtrack.php'>";
	echo "<p>";
	echo "<label for='title'>Title:</label> ";
	echo "<input name='title' type='text' value='$title' />";
	echo "<br /><label for='artist'>Artist(s):";
	echo " <input onClick=\"document.trackform.artist.value = ''; document.trackform.bandids.value = '';\" ";
	echo "type='button' value=' Reset ' /></label> ";
	echo "<input name='artist' type='text' value='$artist_list' disabled />";
	echo "<input type='hidden' name='bandids' value='$id_list,' />\n";
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
	echo "<br /><label for='album'>Album</label> ";
	echo "<select style='margin:5px 5px 5px 0px;' name='album'>\n";
	echo "<option value=''> </option>\n";
	
	$result = mysqli_query($db, "SELECT * FROM album");
	
	while ($row = mysqli_fetch_assoc($result))
	{
		echo "<option value='".$row['album_id']."'";
		if ($row['album_id'] == $album_id) echo " selected";
		echo ">".$row['name']."</option>\n";
	}
	
	echo "</select>\n";
	echo "<br /><label for='tracknum'>Track #:</label> ";
	echo "<input name='tracknum' type='text' value='$track_number' />";
	echo "<br /><label for='genres'>Genre:</label> ";
	echo "<input name='genre' type='text' value='$genre' />";
	echo "<br /><label for='year'>Year:</label> ";
	echo "<input name='year' type='text' value='$year' />";
	echo "<br /><label for='composer'>Composer:</label> ";
	echo "<input name='composer' type='text' value='$composer' />";
	echo "<br /><label style='vertical-align:top;' for='description'>Description:</label> ";
	echo "<textarea name='description' rows=5>$description</textarea>";
	echo "<p><input style='display:block; margin-left:auto; margin-right:auto;' type='submit' ";
	echo "value=' Submit ' /></p></form>";
	echo "</p>\n";
	?>
	
	<!--</div></center>-->
	
	</div> <!-- end main div -->
	
	<?php include("projectSideBar.php"); ?>
	<?php include("footer.html");?>
</body>
</div>
</html>