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

  
  <form method="post" action="addVenueResults.php">
    <label for="name">Venue name:</label>
    <input type="text" id="name" name="name" /><br />
    <label for="street">Street:</label>
    <input type="text" id="street" name="street" /><br />
    <label for="tity">City:</label>
    <input type="text" id="city" name="city" /><br />
    <label for="state">State:</label>
    <input type="text" id="state" name="state" /><br />
    <label for="description">Description:</label>
    <input type="text" id="description" name="description" /><br />
    <label for="picture">Picture:</label>
    <input type="text" id="picture" name="picture" size="32" /><br />
    <label for="map">Map:</label>
    <input type="text" id="map" name="map" size="32" /><br />
  
  
    <label for="other">Anything else you want to add?</label>
    <textarea id="other" name="other"></textarea><br />
    <p><input style="display:block; margin-left:auto; margin-right:auto;" type="submit" value="Submit" name="submit" /></p>
  </form>
</div> <!-- end main div -->
 <?php include("projectSideBar.php"); ?>
 <?php include("footer.html");?>
</body>



</div> <!-- end wrap div -->
</html>
