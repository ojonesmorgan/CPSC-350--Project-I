<?php include("session.php"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>BandLink | Search Music</title>
  <link rel="stylesheet" type="text/css" href="style.css" />
</head>

<body>
<div id="wrap">
    <?php include("header.php"); ?>
	<center><div id="search">
	<?php
	include("db_connect.php");
	$search = $_POST['searchbox'];
	$sort = $_GET['sort'];
	if ($sort == "") $sort = "bandName";
	$desc = $_POST['desc'];
	if ($desc == "") $desc = $_GET['desc'];
	$find = "LIKE '%$search%'";
	$query = "SELECT * FROM band WHERE bandName $find OR bandGenre $find OR bandState $find OR bandCity $find ORDER BY $sort";
	if ($desc == 1) $query .= " DESC";
	
	echo "<br /><h1>";
	
	if (empty($search)) echo "All results";
	else echo "Results for \"".$search."\"";
	echo "</h1>";
	
	$results = mysqli_query($db, $query) or die("Error Querying Database");
	$sortlink = "musicsearch.php?sort=";
	$desclink = "&desc=$desc";

	echo "<table id=\"hor-minimalist-b\" >\n<tr>";
	echo "<th><a href='".$sortlink."bandName".$desclink."'>Artist</a></th>";
	echo "<th><a href='".$sortlink."bandGenre".$desclink."'>Genre</a></th>";
	echo "<th><a href='".$sortlink."bandCity".$desclink."'>City</a></th>";
	echo "<th><a href='".$sortlink."bandState".$desclink."'>State</a></th>";
	echo "</tr>\n";
	
	$count = 0;

	while ($row = mysqli_fetch_assoc($results))
	{
		echo "<tr>";
		echo "<td>".$row['bandName']."</td>";
		echo "<td>".$row['bandGenre']."</td>";
		echo "<td>".$row['bandCity']."</td>";
		echo "<td>".$row['bandState']."</td>";
		echo "</tr>\n";
		
		++$count;
	}
	
	if ($count == 0) echo "<tr><td style='text-align:center;' colspan=4><b>No results found.</th></tr>";
	echo "</table>\n";
	
	echo "<p><a href='musicsearch.php'>Show All</a></p>\n";
	
	echo "<br /><p><form method='post' action='musicsearch.php?sort=$sort'>";
	echo "<input type='text' name='searchbox' value='$search' /></p>";
	echo "<p><input type='radio' name='desc' value=0";
	if ($desc == 0 || $desc == "") echo " checked";
	echo " />&nbsp;ascending&nbsp;&nbsp;";
	echo "<input type='radio' name='desc' value=1";
	if ($desc == 1) echo " checked";
	echo " />&nbsp;descending</p>";
	echo "<p><input type='submit' value=' Search Bands ' name='submit' />";
	echo "</form></p><br />\n";

	echo "<p style='text-align:center;'><a href='main_page.php'>Home</a></p><br />\n";
	?>
	</div></center>
	<?php include("footer.html"); ?>
</div>
</body>
</html>