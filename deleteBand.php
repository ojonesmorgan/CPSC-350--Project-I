<?php 

include("session.php");


	include("db_connect.php");
 //$delete = $_POST['deletebox'];
   $delete = $_GET['deletebox'];
   $query = "DELETE FROM band WHERE bandName = '$delete'";
   $results = mysqli_query($db, $query);
   header("location:musicsearch.php?delname=$delete&deleted=1");

?>

