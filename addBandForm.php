<?php
include("session.php");
if (!$logged_in) header("location:login.php?err=accessdenied");
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

  
  <form method="post" action="addBandResults.php">
    <label for="name">Band name:</label>
    <input type="text" id="name" name="name" /><br />
    <label for="genre">Genre:</label>
    <input type="text" id="genre" name="genre" /><br />
    <label for="tity">City:</label>
    <input type="text" id="city" name="city" /><br />
    <label for="state">State:</label>
    <input type="text" id="state" name="state" /><br />
    <label for="description">Description:</label>
    <input type="text" id="description" name="description"  /><br />
    <label for="photo">Photo:</label>
    <input type="text" id="photo" name="photo"/><br />
  
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
