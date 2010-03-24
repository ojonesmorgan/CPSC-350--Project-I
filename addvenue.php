<?php
include("session.php");
if (!$logged_in) include("notloggedin.php");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>BandLink | Add Venue</title>
  <link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>
<div id="wrap">
<?php include("header.php"); ?>
<div id="main">
  <h1><u>Add a Venue</u></h1>
  
  	<?php
	$error = $_GET['err'];
	$name = $_GET['name'];
	$street = $_GET['street'];
	$city = $_GET['city'];
	$state = $_GET['state'];
	$zipcode=$_GET['zipcode'];
	$description = $_GET['description'];
	$picture = $_GET['picPath'];
	$map = $_GET['mapPath'];
	$streetnum=$_GET['streetnum'];
	
	
	if (isset($error))
	{
		echo "<fieldset style='border:2px solid white; background-color:black;'>";
		echo "<p style='color:white; font-weight:bold; text-align:center;'>";
		if ($error == "noname") echo "Please enter a name for this venue.";
		echo "</p></fieldset>";
	}
	
	if ($logged_in) echo "<form method='post' action='newvenue.php'>";
	echo "<p>";
	echo "<label for='name'>Venue Name:</label> ";
	echo "<input name='name' type='text' value='$name' />";
	echo "<br /><label for='street'>Street:</label> ";
	echo "<input name='street' type='text' value='$street' />";
	echo "<br><label for='streetnum'>Street Number:</label>";
	echo "<input name='streetnum' type='text' value='$streetnum' />";
	echo "<br /><label for='city'>City:</label> ";
	echo "<input name='city' type='text' value='$city' />";
	echo "<br /><label for='state'>State:</label> ";
	echo "<input name='state' type='text' value='$state' />";
	echo "<br /><label for 'zipcode'>Zip Code:</label>";
	echo "<input name='zipcode' type='text' value='$zipcode' />";
	echo "<br /><label style='vertical-align:top;' for='description'>Description:</label> ";
	echo "<textarea name='description' rows=5>$description</textarea>";
	echo "<br /><label for='picture'>Picture URL:</label> <input name='picture' type='text' value='$picture' />";
	echo "<br /><label for='picture'>Map Image:</label> <input name='map' type='text' value='$map' />";
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

