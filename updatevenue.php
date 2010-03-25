<?php
include("session.php");

if (!$logged_in) include("notloggedin.php");

$id = $_GET['id'];
$name = $_POST['name'];
$zipCode = $_POST['zip_code'];
$city = $_POST['city'];
$state = $_POST['state'];
$description = $_POST['description'];
$picture = $_POST['picture'];
$map = $_POST['map'];
$street=$_POST['street'];
$streetnum=$_POST['streetnum'];

include("db_connect.php");

$id = mysql_escape_string(stripslashes(htmlspecialchars(trim($id))));	
$name = mysql_escape_string(stripslashes(htmlspecialchars(trim($name))));
$zipCode = mysql_escape_string(stripslashes(htmlspecialchars(trim($zipCode))));
$city = mysql_escape_string(stripslashes(htmlspecialchars(trim($city))));
$state = mysql_escape_string(stripslashes(htmlspecialchars(trim($state))));
$description = mysql_escape_string(stripslashes(htmlspecialchars(trim($description))));
$picture = mysql_escape_string(stripslashes(htmlspecialchars(trim($picture))));
$map = mysql_escape_string(stripslashes(htmlspecialchars(trim($map))));
$street = mysql_escape_string(stripslashes(htmlspecialchars(trim($street))));
$streetnum  = mysql_escape_string(stripslashes(htmlspecialchars(trim($streetnum))));
// Test if zip code already exists
if(!empty($zipCode)) {
	$zipQuery="select * from venue_zip_code where zip_code ='$zipCode'";
	$zipResults=mysqli_query($db,$zipQuery);
	$counter=0;
	while ($row1 = mysqli_fetch_array($zipResults)){
	$counter=$counter + 1;
	}
	}
	if($counter==0){//zip code was not already in the table and needs to be added
			//test
			//echo "Making it in here";
			//test
			mysqli_query($db, $query="INSERT INTO venue_zip_code (zip_code, city, state) VALUES ('$zipCode', '$city', '$state')");
			mysqli_query($db, $query="UPDATE venue SET venueZipCode='$zipCode' WHERE venue_id = '$id'");
    // if zip code does exist test to see of the band is already connected to it
    }else{
    	
    	$zipVenueQuery="select * from venue where venueZipCode ='$zipCode' && venue_id='$id'";
		$zipVenueResults=mysqli_query($db,$zipVenueQuery);
		$counter=0;
		while ($row1 = mysqli_fetch_array($zipVenueResults)){
    		$counter = $counter + 1;
    	}
    	if ($counter==0) {
    		mysqli_query($db, "UPDATE venue SET venueZipCode='$zipCode' WHERE venue_id='id'");
    	}	

	}
$saved_id = $id;
$venue = "WHERE venue_id='$id'";
//<new address row>
mysqli_query($db, "INSERT INTO venue_address (number,street) VALUES ('$streetnum','$street')");
$testRes=mysqli_query($db, "SELECT * FROM venue_address order by address_id desc limit 1");
while($testRow=mysqli_fetch_array($testRes)){
	$addressID=$testRow['address_id'];
}
//<new address row>
mysqli_query($db, "UPDATE venue SET venueAddress_id='$addressID' $venue");
mysqli_query($db, "UPDATE venue_zip_code SET city='$city' where zip_code='$zipcode'");
mysqli_query($db, "UPDATE venue_zip_code SET state='$state' where zip_code='$zipcode' ");
mysqli_query($db, "UPDATE venue SET venuePicture='$picture' $venue");
mysqli_query($db, "UPDATE venue SET venueMap='$map' $venue");
mysqli_query($db, "UPDATE venue SET venueDescription='$description' $venue");
if (!empty($name)) mysqli_query($db, "UPDATE venue SET venueName='$name' $venue"); //This must be the LAST update query.
else $saved_name = $old_name;

header("location:venueprofile.php?id=$saved_id&saved=1");
?>