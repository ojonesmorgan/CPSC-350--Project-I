<?php
include("session.php");
if (!$logged_in) include("notloggedin.php");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>BandLink | Add Band</title>
  <link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>
<div id="wrap">
<?php include("header.php"); ?>
<div id="main">
  <h1><u>Add a Band</u></h1>
  
	<?php
	$error = $_GET['err'];
	$name = $_GET['name'];
	$genre = $_GET['genre'];
	$city = $_GET['city'];
	$state = $_GET['state'];
	$description = $_GET['description'];
	$photo = $_GET['photo'];
	
	if (isset($error))
	{
		echo "<fieldset style='border:2px solid white; background-color:black;'>";
		echo "<p style='color:white; font-weight:bold; text-align:center;'>";
		if ($error == "noname") echo "Please enter a name for this artist.";
		echo "</p></fieldset>";
	}
	
	if ($logged_in) echo "<form method='post' action='newband.php'>";
	echo "<p>";
	echo "<label for='name'>Band Name:</label> ";
	echo "<input name='name' type='text' value='$name' />";
	echo "<br /><label>Genre(s) Max 4:</label> ";
	//<4 genre inputs>
	echo "<br><label for ='genre1'>Genre 1:</label>";
	echo "<input name='genre1' type='text'  value='$genre' />";
	echo "<br><label for ='genre2'>Genre 2:</label>";
	echo "<input name='genre2' type='text' />";
	echo "<br><label for ='genre3'>Genre 3:</label>";
	echo "<input name='genre3' type='text' />";
	echo "<br><label for ='genre4'>Genre 4:</label>";
	echo "<input name='genre4' type='text' />";	
	//</4 genre Inputs>
	//echo "<br /><label for='city'>City:</label> ";
	//echo "<input name='city' type='text' value='$city' />";
	echo "<br /><label for='state'>State:</label> ";
	echo "<input name='state' type='text' value='$state' />";
	echo "<br /><label style='vertical-align:top;' for='description'>Description:</label> ";
	echo "<textarea name='description' rows=5>$description</textarea>";
	echo "<br /><label for='photo'>Photo URL:</label> <input name='photo' type='text' value='$photo' />";
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
