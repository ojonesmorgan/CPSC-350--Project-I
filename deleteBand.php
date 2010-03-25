<?php 

include("session.php");


	include("db_connect.php");
 //$delete = $_POST['deletebox'];
   $delete = $_GET['deletebox'];
   $deleteName=$_GET['deleteName'];
   $query = "DELETE FROM band WHERE band_id = '$delete'";
   $query2= "DELETE FROM band_genre where band_id= '$delete'";
   $results = mysqli_query($db, $query);
   $results2 = mysqli_query($db, $query2);
   header("location:musicsearch.php?delname=$deleteName&deleted=1");

?>

