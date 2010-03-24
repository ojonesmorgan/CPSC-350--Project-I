<?php 

include("session.php");


	include("db_connect.php");
 //$delete = $_POST['deletebox'];
   $delete = $_GET['deletebox'];
   $query = "DELETE FROM event WHERE eventName = '$delete'";
   $results = mysqli_query($db, $query);
   header("location:eventearch.php?delname=$delete&deleted=1");

?>

