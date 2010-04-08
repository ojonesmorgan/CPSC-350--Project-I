<?php
include("session.php");
if (!$logged_in) include("notloggedin.php");

include("db_connect.php");

$name = mysql_escape_string(stripslashes(htmlspecialchars(strip_tags(trim($_POST['name'])))));
$band_id = mysql_escape_string(stripslashes(htmlspecialchars(strip_tags(trim($_POST['band'])))));

$query = "INSERT INTO album (name, band_id) ";
$query .= "VALUES ('$name', '$band_id')";

if (!empty($name))
{
	mysqli_query($db, $query);
	
	$result = mysqli_query($db, "SELECT MAX(album_id) AS max_album_id FROM album");
		
	while ($row = mysqli_fetch_assoc($result))
	{
		$album_id = $row['max_album_id'];
	}
}

else header("location:album.php?err=noname&name=$name&band=$band_id");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>BandLink | Album Added</title>
  <link rel="stylesheet" type="text/css" href="style.css" />
</head>

<body>
<div id="wrap">
<?php include("header.php"); ?>
<center><div>
	
<?php
echo "<br /><h1>Thanks for adding the album $name.</h1>";
echo "<p><a href='album.php?id=$album_id'>Click here to view and edit this album.</a></p><br />\n";
?>
	
</div></center></div>
</body>
</html>