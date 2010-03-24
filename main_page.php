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
	  include("db_connect.php");


	  //start
	$default_photo = "Pictures/default.jpg";
	echo "<p><span style=\"color:darkred\"><b>Featured Band:</B></span><br/>";
	
	$query1="Select * from band order by rand() limit 1";
	$results1=mysqli_query($db,$query1);
	$bandCount=0;
	//if($results1!=false){
	//$bandCount=1;
	while ($row1 = mysqli_fetch_array($results1)){
		$bandCount+=$bandCount;
		$bandID=$row1['band_id'];
		$bandName=$row1['bandName'];
		$bandState=$row1['bandState'];
		$bandPhoto=$row1['bandPhoto'];
		$desc=$row1['bandDescription'];
		//if (file_exists( $bandPhoto)== false){
		if (empty($bandPhoto)) {
			//set $bandPhoto to default image
			$bandPhoto=$default_photo;
			$altPhoto="Band Image Could Not Be Found";
		}
		else{
			$altPhoto="$bandName's Photo";
		}
			
	}
	//}	
	
	$query="Select Genre from band b join genre g join band_genre bg where b.band_id=bg.band_id
		and g.genre_id=bg.genre_id and b.band_id=" .$bandID;
	//$query = "Select * from band b join genre g join band_genre bg where b.band_id=bg.band_id
	//and g.genre_id=bg.genre_id ORDER BY RAND() LIMIT 1";
	
	$bandGenres="<table><tr><td>";
	 $results = mysqli_query($db, $query);
	 if($results!=false){
	while($row = mysqli_fetch_array($results)) {
		$bandGenres=$bandGenres.$row['Genre']. "</td></tr><tr><td>";
	}
	$bandGenres=$bandGenres."</td></tr></table>";
	}else{$bandGenres=$bandGenres."</td></tr></table>";}
	
	$band_link = "bandprofile.php?id=$bandID";
	if ($bandCount>0){
  	echo "
	<table width=400 border=4 bordercolor=darkred bgcolor=darkblue>
	<tr>
		<td align =center><h3><a style='color:red;' href='$band_link'>$bandName</a><h3> $bandGenres </td>
		<td ><table width=200 align= center><tr><td><h4>From:</h4></td></tr><tr><td><p>$bandState<p></td></tr></table> </td>
	</tr>
	<tr>
		<td><a href='$band_link'><img src=\"$bandPhoto\" alt=\"$altPhoto\" width=200 height=100 /></a></td>
		<!--<td>Photo Path: bandPhoto </td>-->
		<!-- Comments
			makes a sizable image in the table with the path 'skull.jpg'
			<td><img src=\"skull.jpg\" ";
			if ($bandPhoto == $default_photo) echo "width = 150 height = 100";
			echo "></td>
		-->
		<td><p>$desc</p></td>
	</tr>
	</table>\n";


	//finish
	echo "<br/>\n";
	}else{//no bands in DB
	echo "<h4>There are no bands currently in Bandlink's database.</h4>";
	if($logged_in) echo "<br><h4>Click <a href='addband.php'>here</a> to add a band</h4>"; 
	echo "<br />\n";
	}
	

	//start

	echo "<p><span style=\"color:darkred\"><b>Featured Venue:</B></span><br/>";

	//  $query = "select venueName, venueState, venueCity, venueStreet, venueDescription, venuePicture, venueMap
	//			from venue ORDER BY RAND() LIMIT 1";
		$query= "select * from venue join venue_address join venue_zip_code
					where 
					venue.venueZipCode=venue_zip_code.zip_code
					and
					venue.venueAddress_id=venue_address.address_id order by rand() limit 1";
	 $results2 = mysqli_query($db, $query);
	 $venCount=0;
	while($row = mysqli_fetch_array($results2)) {
	$venCount++;
	$venueID=$row['venue_id'];
  	$venueName = $row['venueName'];
  	$venueState = $row['state'];
  	$venueCity = $row['city'];
	$venueStreet=$row['street'];
	$venueDescription=$row['venueDescription'];
	$venuePicture=$row['venuePicture'];
	$venueMap=$row['venueMap'];
	//if (file_exists( $venuePicture)== false){
	if (empty($venuePicture)) {
		//set $venuePicture to default image
		$venuePicture=$default_photo;
		$altvenPhoto="Band Image Could Not Be Found";
	}
	else{
		$altvenPhoto="$venueName's Photo";
	}
	}
	
	$venue_link = "venueprofile.php?id=$venueID";
	if ($venCount>0){	
  	echo "
	<table width =400 border=4 bordercolor=darkred bgcolor=darkblue>
	<tr>
		<td ><h3 align=center><a style='color:red;' href='$venue_link'>$venueName</a><h3> </td>
		<td >
			<table width=200 align=center>
				<tr align=left>
					<td><h4>Location:</h4></td>
				</tr>
				<tr>
					<td><p>$venueCity , $venueState</p><td></td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td><a href='$venue_link'><img src=\"$venuePicture\" alt=\"$altvenPhoto\" width=200 height=100 /></a></td>
		<!-- Comments
			makes a sizable image in the table with the path 'skull.jpg'
			<td><img src=\"skull.jpg\" ";
			if ($venuePicture == $default_photo) echo "width = 150 height = 100";
			echo "></td>
		-->
		<td><p>$venueDescription</p></td>
	</tr>
	</table><br>";
	}else{//no venues in DB
	echo "<h4>There are no venues currently in Bandlink's database.</h4>";
	if($logged_in) echo "<br><h4>Click <a href='addvenue.php'>here</a> to add a venue</h4>"; 
	echo "<br />\n";
	}
	//finish

	
	
	
	

	?>	
	</div>	
	
    <?php include("projectSideBar.php"); ?>
	<?php include("footer.html");?>
</div>
</div>
</body>
</html>
