<?php include("session.php"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>BandLink | Search Venues</title>
  <link rel="stylesheet" type="text/css" href="style.css" />
</head>

<body>
<div id="wrap">
    <?php include("header.php"); ?>
	<center><div id="search">
	<?php
	include("db_connect.php");
	$search = $_GET['q'];
	$sort = $_GET['sort'];
	if (empty($sort)) $sort = "venueName";
	$desc = $_GET['desc'];
	$find = "LIKE '%$search%'";
	$query = "SELECT * FROM venue WHERE venueName $find OR venueState $find OR venueCity $find ORDER BY $sort";
	if ($desc == 1) $query .= " DESC";
	
	echo "<br />";
	
	$results = mysqli_query($db, $query) or die("Error Querying Database");
	$sortlink = "searchVenue.php?sort=";
	$desclink = "&desc=$desc";

	echo "<table id=\"hor-minimalist-b\" >\n<tr>";
	echo "<th><a style='color:darkblue;' href='".$sortlink."venueName".$desclink."'>Place</a></th>";
	echo "<th><a style='color:darkblue;' href='".$sortlink."venueCity".$desclink."'>City</a></th>";
	echo "<th><a style='color:darkblue;' href='".$sortlink."venueState".$desclink."'>State</a></th>";
	echo "</tr>\n";
	
	$count = 0;

	while ($row = mysqli_fetch_assoc($results))
	{
		echo "<tr>";
		echo "<td>".$row['venueName']."</td>";
		echo "<td>".$row['venueCity']."</td>";
		echo "<td>".$row['venueState']."</td>";
		echo "</tr>\n";
		
		++$count;
	}
	
	if ($count == 0)
	{
		echo "<tr><td style='text-align:center;' colspan=4><p style='font-weight:bold; font-size:125%'>";
		echo "No results found for \"".$search.".\"</p>";
		echo "<p style='font-size:125%'>";
		echo "<a style='color:darkblue;' href='searchVenue.php?sort=$sort&desc=$desc'>Show All</a></p></th></tr>";
	}
	
	echo "</table>\n";
	
	echo "<p><form method='get' action='searchVenue.php'>";
	echo "<input type='hidden' name='sort' value='$sort' />";
	echo "<input type='text' name='q' value='$search' />";
	echo "&nbsp;&nbsp;<input type='submit' value=' Search ' name='submit' /></p>";
	echo "<p><input type='radio' name='desc' value=0";
	if ($desc == 0 || $desc == "") echo " checked";
	echo " />&nbsp;ascending&nbsp;&nbsp;";
	echo "<input type='radio' name='desc' value=1";
	if ($desc == 1) echo " checked";
	echo " />&nbsp;descending&nbsp;&nbsp;</p>";
	echo "</form></p>\n";
	?>
	<?php include("footer.html"); ?>
</div>
</body>
</html>