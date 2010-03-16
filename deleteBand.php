<?php include("session.php"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>BandLink | Delete Band</title>
  <link rel="stylesheet" type="text/css" href="style.css" />
</head>

<body>
   <div id="wrap">	
	<?php include("header.php"); ?>
	<div id="deleteBand">
	
    <?php include("deleteSideBar.php"); ?>	
    <?php include("db_connect.php"); ?>
   
   <?php
   $delete = $_POST['deletebox'];
   $query = "DELETE FROM band WHERE bandName = '$delete'";
   $results = mysqli_query($db, $query);
   ?>
   
   </div>
   </div>
</body>
	
</html>