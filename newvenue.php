<?php
include("session.php");
if (!$logged_in) include("notloggedin.php");

include("db_connect.php");
  
$name = mysql_escape_string(stripslashes(htmlspecialchars(strip_tags(trim($_POST['name'])))));
$street = mysql_escape_string(stripslashes(htmlspecialchars(strip_tags(trim($_POST['street'])))));
$streetnum = mysql_escape_string(stripslashes(htmlspecialchars(strip_tags(trim($_POST['streetnum'])))));
$city = mysql_escape_string(stripslashes(htmlspecialchars(strip_tags(trim($_POST['city'])))));
$state = mysql_escape_string(stripslashes(htmlspecialchars(strip_tags(trim($_POST['state'])))));
$zipcode = mysql_escape_string(stripslashes(htmlspecialchars(strip_tags(trim($_POST['zipcode'])))));
$picture = mysql_escape_string(stripslashes(htmlspecialchars(strip_tags(trim($_POST['picture'])))));
$description = mysql_escape_string(stripslashes(htmlspecialchars(strip_tags(trim($_POST['description'])))));
$map = mysql_escape_string(stripslashes(htmlspecialchars(strip_tags(trim($_POST['map'])))));
 
 //***********************************
 //	<Check to see if zipcode already exists in DB>
	if(!empty($zipcode)){
		$quickQ="select zip_code from venue_zip_code where zip_code=$zipcode";
		$quickR=mysqli_query($db,$quickQ);
		$counter=0;
		while ($quickRow= mysqli_fetch_array($quickR)){
			$counter= $counter + 1;
		}
		if (counter == 0){ //zipcode is not already in the DB
			mysqli_query($db, "INSERT INTO venue_zip_code (zip_code, city, state) 
								VALUES ('$zipcode', '$city','$state')");		
		}
	}
 //	</Check to see if zipcode already exists in DB>
 //***********************************
 //	<Insert Address Into DB>
	if(!empty($street) or !empty($streetnum)){
		mysqli_query($db,"INSERT INTO venue_address(number,street)
							VALUES ('$streetnum','$street')");	
	}
 
 //	</Insert Address Into DB>
 //***********************************
 //	<Find Last Address Entered>
		$quickQ="select address_id from venue_address order by address_id desc limit 1";
		$quickR=mysqli_query($db,$quickQ);
		while ($quickRow= mysqli_fetch_array($quickR)){
			$addressID=$quickRow['address_id'];
		}
 //	</Find Last Address Entered>
 //***********************************
 //	<Insert New Band Into Database>
/**if (!empty($name)){
	mysqli_query($db, "INSERT INTO venue (venueName, venueState, venueCity, venueStreet, venueDescription, venuePicture, venueMap) 
		VALUES ('$name', '$state', '$city', '$street', '$description', '$picture', '$map')");
 }
else header("location:addvenue.php?err=noname&name=$name&street=$street&city=$city&state=$state&description=$description&picture=$picture&map=$map"); 
**/
$result = mysqli_query($db, "SELECT venue_id FROM venue");
	
while ($row = mysqli_fetch_assoc($result))
{
	$venue_id = $row['venue_id'];
}
		
if (!empty($name)){
	mysqli_query($db, "INSERT INTO venue (venueName, venueDescription, venuePicture, venueMap, venueZipCode,venueAddress_id) 
		VALUES ('$name','$description', '$picture', '$map', '$zipcode','$addressID')");
		
		//<Find Laast Venue Entered>
		$quickQ="select venue_id from venue order by venue_id desc limit 1";
		$quickR=mysqli_query($db,$quickQ);
		while ($quickRow= mysqli_fetch_array($quickR)){
			$venueID=$quickRow['band_id'];
		}
		//</Find Laast Venue Entered>
 }
else header("location:addvenue.php?err=noname&name=$name&street=$street&city=$city&state=$state&description=$description&picture=$picture&map=$map"); 
//	</Insert New Band Into Database> 
//***********************************
?>
 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>BandLink | Venue Added</title>
  <link rel="stylesheet" type="text/css" href="style.css" />
</head>

<body>
<div id="wrap">
<?php include("header.php"); ?>
<center><div>
	
<?php
echo "<br /><h1>Thanks for adding the venue $name.</h1>";
echo "<p><a href='venueprofile.php?id=$venue_id'>Click here to go to the venue profile for $name.</a></p><br />\n";
?>
	
</div></center></div>
</body>
</html>