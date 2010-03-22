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

	//--Deleted variables
	$del_Name=$_GET['delname'];
	$deleted=$_GET['deleted']==1;
	//--Deleted Variables

	$search = $_GET['q'];
	$sort = $_GET['sort'];
	if (empty($sort)) $sort = "venueName";
	$desc = $_GET['desc'];
	$find = "LIKE '%$search%'";
	$query = "SELECT * FROM venue WHERE venueName $find OR venueState $find OR venueCity $find ORDER BY $sort";
	if ($desc == 1) $query .= " DESC";
	
	echo "<br />";
	$num_col = 0;

	//<venue was deleted>
	if ($deleted)
	{
		echo "<fieldset style='border:2px solid white; background-color:black; width:415px;'>";
		echo "<p style='color:white; font-weight:bold; text-align:center;'>";
		echo $del_Name;
		echo " was deleted from BandLink.";
		echo "</p></fieldset>";
	}

	//</venue was deleted>
	
	function header_cell($title, $attribute, $num_col)
	{
		++$num_col;
		
		return "<th><a style='color:darkblue;' href='venuesearch?sort=$attribute&desc=$desc'>$title</a></th>";
	}

	echo "<table style='width:640px;' id=\"hor-minimalist-b\" >\n<tr>";
	echo header_cell("Name", "venueName", $num_col);
	echo header_cell("Street", "venueStreet", $num_col);
	echo header_cell("City", "venueCity", $num_col);
	echo header_cell("State", "venueState", $num_col);
	if ($logged_in) echo header_cell("", "", $num_col);
	echo "</tr>\n";
	
	$count = 0;
	$results = mysqli_query($db, $query) or die("Error Querying Database");

	while ($row = mysqli_fetch_assoc($results))
	{
		$name = $row['venueName'];
		$street = $row['venueStreet'];
		$city = $row['venueCity'];
		$state = $row['venueState'];
		$linked_name = "<a style='color:darkblue;' href='venueprofile.php?name=$name'>$name</a>";
		
		echo "<tr>";
		echo "<td>$linked_name</td>";
		echo "<td>$street</td>";
		echo "<td>$city</td>";
		echo "<td>$state</td>";
		
		if ($logged_in)
		{
			echo "<td>";
			echo "<input type='submit' onClick=\"parent.location = 'deleteVenueConfirm.php?deletebox=$name'\" ";
			echo "value='Delete' /></td>";
		}
		
		echo "</tr>\n";
		
		++$count;
	}
	
	if ($count < 1)
	{
		echo "<tr><td style='text-align:center;' colspan='$num_col'><p style='font-weight:bold; font-size:125%'>";
		echo "No results found";
		if (!empty($search)) echo " for \"".$search.".\"</p>";
		else echo ".";
		echo "<p style='font-size:125%'>";
		echo "<a style='color:darkblue;' href='venuesearch.php?sort=$sort&desc=$desc'>Show All</a></p></th></tr>";
	}
	
	echo "</table>\n";
	
	echo "<p><form method='get' action='venuesearch.php'>";
	echo "<input type='hidden' name='sort' value='$sort' />";
	echo "<input type='text' name='q' value='$search' />";
	echo "&nbsp;&nbsp;<input type='submit' value=' Search ' /></p>";
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