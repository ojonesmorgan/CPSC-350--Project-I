<?php
include("session.php");
if (!$logged_in) include("notloggedin.php");

include("db_connect.php");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>BandLink | Add Album</title>
  <link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>
<div id="wrap">
<?php include("header.php"); ?>
<div id="main">
  <h1><u>Add an Album</u></h1>
  
	<?php
	$error = $_GET['err'];
	$band = $_GET['band'];
	$name = $_GET['name'];
	
	if (isset($error))
	{
		echo "<fieldset style='border:2px solid white; background-color:black;'>";
		echo "<p style='color:white; font-weight:bold; text-align:center;'>";
		if ($error == "noname") echo "Please enter a name for this album.";
		echo "</p></fieldset>";
	}
	
	if ($logged_in) echo "<form method='post' action='newalbum.php'>";
	echo "<p>";
	echo "<label for='band'>Artist:</label> ";
	echo "<select name='band'>";
	
	$result = mysqli_query($db, "SELECT * FROM band");
	
	while ($row = mysqli_fetch_assoc($result))
	{
		echo "<option value='".$row['band_id']."'";
		if ($row['band_id'] == $band) echo " selected";
		echo ">".$row['bandName']."</option>";
	}
	
	echo "</select>";
	
	echo "<br />\n<label for='name'>Album Name:</label> ";
	echo "<input name='name' type='text' value='$name' />";
	echo "<p><input style='display:block; margin-left:auto; margin-right:auto;' type='submit' ";
	echo "value=' Submit ' /></p></form>";
	echo "</p>\n";
	?>
	
</div> <!-- end main div -->
 <?php include("projectSideBar.php"); ?>
 <?php include("footer.html");?>
</body>



</div> <!-- end wrap div -->
</html>