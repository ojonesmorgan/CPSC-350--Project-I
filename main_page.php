<?php include("session.php"); ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>BandLink</title>
  <link rel="stylesheet" type="text/css" href="style.css" />
</head>

<body>
<div id="wrap">
    <?php include("header.php"); ?>
	<div id="main">
  
	<?php
	  include "db_connect.php";


	  //start
	

	echo "<p><span style=\"color:darkred\"><b>Featured Band:</B></span><br/>";
	  $query = "SELECT * FROM band ORDER BY RAND() LIMIT 1";
  
	 $results = mysqli_query($db, $query);
	while($row = mysqli_fetch_array($results)) {
  	$bandName = $row['bandName'];
  	$bandState = $row['bandState'];
  	$bandCity = $row['bandCity'];
	$bandGenre = $row['bandGenre'];
	$bandPhoto= $row['bandPhoto'];
	if (file_exists( $bandPhoto)== false){
		//set $bandPhoto to default image
		$bandPhoto="Pictures/default.jpg";
		$altPhoto="Band Image Could Not Be Found";
	}
	else{
		$altPhoto="$bandName's Photo";
	}
	$desc=$row['bandDescription'];
	}
	
  	echo "
	<table width=400 bordercolor=darkred bgcolor=darkblue>
	<tr>
		<td align =center><h3>$bandName<h3> ($bandGenre) </td>
		<td ><table width=200 align= center><tr><td><h4>From:</h4></td></tr><tr><td><p>$bandCity , $bandState<p></td></tr></table> </td>
	</tr>
	<tr>
		<td><img src=\"$bandPhoto\" alt=\"$altPhoto\" width=200 height=100></td>
		<!--<td>Photo Path: bandPhoto </td>-->
		<!-- Comments
			makes a sizable image in the table with the path 'skull.jpg'
			<td><img src=\"skull.jpg\" width = 150 height = 100></td>
		-->
		<td><p>$desc</p></td>
	</tr>
	</table>\n";


	//finish

	//start

	echo "<p><span style=\"color:darkred\"><b>Featured Venue:</B></span><br/>";

	  $query = "select venueName, venueState, venueCity, venueStreet, venueDescription, venuePicture, venueMap
				from venue ORDER BY RAND() LIMIT 1";
  
	 $results2 = mysqli_query($db, $query);
	while($row = mysqli_fetch_array($results2)) {
  	$venueName = $row['venueName'];
  	$venueState = $row['venueState'];
  	$venueCity = $row['venueCity'];
	$venueStreet=$row['venueStreet'];
	$venueDescription=$row['venueDescription'];
	$venuePicture=$row['venuePicture'];
	$venueMap=$row['venueMap'];
	if (file_exists( $venuePicture)== false){
		//set $venuePicture to default image
		$venuePicture="Pictures/default.jpg";
		$altvenPhoto="Band Image Could Not Be Found";
	}
	else{
		$altvenPhoto="$venueName's Photo";
	}
	}
		
  	echo "
	<table width =400 bordercolor=darkred bgcolor=darkblue>
	<tr>
		<td ><h3 align=center>$venueName<h3> </td>
		<td >
			<table width=200 align=center>
				<tr align=left>
					<td><h4>From:</h4></td>
				</tr>
				<tr>
					<td><p>$venueCity , $venueState</p><td></td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td><img src=\"$venuePicture\" alt=\"$altvenPhoto\" width=200 height=100></td>
		<!-- Comments
			makes a sizable image in the table with the path 'skull.jpg'
			<td><img src=\"skull.jpg\" width = 150 height = 100></td>
		-->
		<td><p>$venueDescription</p></td>
	</tr>
	</table><br>";
	//finish

	
	
	
	

	?>	
	</div>	
	
    <?php include("projectSideBar.php"); ?>
	<?php include("footer.html");?>
</div>
</div>
</body>
</html>
