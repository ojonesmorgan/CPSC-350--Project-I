<?php include("session.php"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>BandLink | Delete</title>
  <link rel="stylesheet" type="text/css" href="style.css" />
</head>

<body>
<div id="wrap">
    <?php include("header.php"); ?>
	<div id="delete">
<!-- *** -->	
<?php
	$deletedName=$_GET['deleteName'];
	$deleted=$_GET['deletebox'];
	echo "<H3>";
	echo "Are you sure you want to delete ";
	echo $deletedName;
	echo "?";
	echo "</H3>";
	echo "<hr width = 415>";
	//yes
	echo "<a href='deleteBand.php?deletebox=$deleted&deleteName=$deletedName'>Yes, permanently delete ";
	echo "<B>" .$deletedName. "</B>";
	echo " from BandLink.";
	echo "<BR>";
	//no
	echo "<a href='musicsearch.php'>No, do NOT delete ";
	echo $deletedName;
	echo ".</a>";


?>
<!-- *** -->
	<?php include("footer.html");?>
</div>
</div>