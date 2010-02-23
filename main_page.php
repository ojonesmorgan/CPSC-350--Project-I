<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Group: Decide on site title.</title>
  <link rel="stylesheet" type="text/css" href="style.css" />
</head>

<body>
<div id="wrap">
    <?php include("header.html"); ?>
	<div id="main">
	
	<p><a href="addBand.html">Add Band</a></p>

    
    <p><a href="addVenue.html">Add Venue</a></p>

  
	<?php
	  include "db_connect.php";
	
	echo "<p class =\"side\"><b>Featured Band:</B><br/>";

	  $query = "select bandName , bandState, bandCity, bandGenre, bandPhoto, bandDescription from band ORDER BY RAND() LIMIT 1";
  
	 $results = mysqli_query($db, $query);
	while($row = mysqli_fetch_array($results)) {
  	$bandName = $row['bandName'];
  	$bandState = $row['bandState'];
  	$bandCity = $row['bandCity'];
	$bandGenre = $row['bandGenre'];
	$bandPhoto= $row['bandPhoto'];
	if (file_exists( $bandPhoto)== false){
		//set $bandPhoto to default image
		$bandPhoto="skull.jpg";
		$altPhoto="Band Image Could Not Be Found";
	}
	else{
		$altPhoto="$bandName's Photo";
	}
	$desc=$row['bandDescription'];
	
  	echo "
	<table border=1 bordercolor=black>
	<tr>
		<td ><h3>$bandName<h3> ($bandGenre) </td>
		<td ><table><tr><td><h4>From</h4></td></tr><tr><td>$bandCity , $bandState</td></tr></table> </td>
	</tr>
	<tr>
		<td><img src=\"$bandPhoto\" alt=\"$altPhoto\" width=150 height=100></td>
		<!--<td>Photo Path: bandPhoto </td>-->
		<!-- Comments
			makes a sizable image in the table with the path 'skull.jpg'
			<td><img src=\"skull.jpg\" width = 150 height = 100></td>
		-->
		<td>$desc</td>
	</tr>
	</table>\n";
	
	
	}
	?>	
	</div>	
	
    <?php include("projectSideBar.php"); ?>
	<div id="footer"><p>"Footer" </p></div>
</div>
</div>
</body>
</html>
