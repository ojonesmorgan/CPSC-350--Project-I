<?php 

include("session.php");


	include("db_connect.php");
 //$delete = $_POST['deletebox'];
   $delete = $_GET['deletebox'];
   $query = "DELETE FROM venue WHERE venueName = '$delete'";
   $results = mysqli_query($db, $query);
   header("location:venuesearch.php?delname=$delete&deleted=1");

?>
