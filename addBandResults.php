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
<script type="text/javascript" src="calendarDateInput.js" />

<body>
<div id="wrap">
<?php include("header.php"); ?>
	<div id="main">

	
<?php
  include  "db_connect.php";  
  
  $name = $_POST['name'];
  $state = $_POST['state'];
  $city = $_POST['city'];  
  $genre = $_POST['genre'];
  $photo = $_POST['photo'];
  $description = $_POST['description'];
  
  
  
  echo "<p>Thanks for submitting this new band</p>";

 
  
  
  
  $query = "INSERT INTO band (bandName, bandState, bandCity, bandGenre, bandDescription, bandPhoto) " . 
  		   "VALUES ('$name', '$state', '$city', '$genre', '$description', '$photo')";
  
echo "<p> You Description of the band: </p>";
echo "<p>$description</p>";
  $result = mysqli_query($db, $query)
   or die("Error Querying Database");
   
   
  //echo "<h1>Abductions by date</h1>";
  
  
  $query = "SELECT * FROM band ORDER BY bandName";
  
  $result = mysqli_query($db, $query)
   or die("Error Querying Database");
  
  //echo "<table id=\"hor-minimalist-b\">\n<tr><th>Date</th><th>Band</th><th>City</th><th>State</th><tr>\n\n";
  
  //while($row = mysqli_fetch_array($result)) {
  	//$name = $row['name'];
  	//$description = $row['description'];
  	//$genre = $row['genre'];
  	//$city = $row['city'];
  	//$state = $row['state'];
  	//echo "<tr><td  >$date</td><td  >$name</td><td >$city</td><td>$state</td></tr>\n";
  //}
 echo "</table>\n"; 
  
  mysqli_close($db);
  
  
?>
	
	
	
	</div><!-- end main div -->
	
	
    <?php include("projectSideBar.php"); ?>

	<?php include ("footer.html"); ?>
</div> <!-- end wrap div -->
</body>
</html>
