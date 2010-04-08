<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Aliens Abducted Me - Report an Abduction</title>
  <link rel="stylesheet" type="text/css" href="style.css" />
</head>
<script type="text/javascript" src="calendarDateInput.js" />

<body>
<div id="wrap">

    <?php include("header.php"); ?>
	<div id="main">
	
<?php
  include "db_connect.php";
  
  $album = $_POST['album_name'];
  $band = $_GET['band'];

  
  
  echo "<p>Thanks for submitting the form.</p>";
  
  
  
  $query = "INSERT INTO album (album_id, album_name, band_name) " . 
  		   "VALUES ('', '$album', '$band')";
  $result = mysqli_query($db, $query)
   or die("Error Querying Database");
  
  $result = mysqli_query($db, $query)
   or die("Error Querying Database");
  
  mysqli_close($db);
  
  
?>
</div>
<?php include ("projectSideBar.php"); ?>
<?php include ("footer.html"); ?>

</body>
</html>