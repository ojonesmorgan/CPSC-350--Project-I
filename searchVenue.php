<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Band Venue - Search Results</title>
  <link rel="stylesheet" type="text/css" href="style.css" />
</head>
	
	
<div id="wrap">	
<?php include("header.html"); ?>
	<div id="searchVenue">
	<p align="left"><b>Results of Search</b></p>
	
<?php include("sidebar.php"); ?>	
 <?php include("db_connect.php"); ?>

	
	<?php
	$searched=$_POST['searchVenue'];
	$query = "SELECT  venueName, venueState, venueCity, venueStreet, venueDescriptino, venuePicture where
		venueName like \"%$searched%\";

	$results = mysqli_query($db, $query);
	 echo "<table id=\"hor-minimalist-b\">\n<tr><th>venueName</th><th>venueStreet</th><th>venueCity</th><th>City</th><th>venueState</th><tr>\n\n";
  
  while($row = mysqli_fetch_array($results)) {
  	$name = $row['venueName'];
  	$street = $row['venueState'];
  	$city = $row['venueCity'];
  	$state = $row['venueState'];
  	$description = $row['venueDescription'];
	$picture = $row['venuePicture'];
	$map = $row['venueMap'];
  	echo "<tr><td >$name</td><td>$street</td><td>$city</td><td >$state</td><td>$description</td></tr>\n";
  }
 echo "</table>\n"; 

mysqli_close($db);

	?>	 

	</div>
</div>