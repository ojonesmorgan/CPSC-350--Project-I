<?php 

include("session.php");


	include("db_connect.php");
 //$delete = $_POST['deletebox'];
   $delete = $_GET['deletebox'];
   $deleteName=$_GET['deleteName'];
   $query2= "SELECT * FROM venue where venue_id='$delete'"; 
   $results2=mysqli_query($db,$query2);
   while ($row = mysqli_fetch_assoc($results2))
	{
		$addressID = $row['venueAddress_id'];
	}
   $query = "DELETE FROM venue WHERE venue_id = '$delete'"; 
	$query3="DELETE FROM venue_address where address_id='$addressID'"; 
   $results = mysqli_query($db, $query);
   $results3=mysqli_query($db,$query3);
   header("location:venuesearch.php?delname=$deletNamee&deleted=1");

?>
