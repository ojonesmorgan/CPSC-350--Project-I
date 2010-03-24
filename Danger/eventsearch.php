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
	
	//--Deleted variables
	$del_Name=$_GET['delname'];
	$deleted=$_GET['deleted']==1;
	//--Deleted Variables

	$search = trim($_GET['q']);
	$sort = $_GET['sort'];
	if (empty($sort)) $sort = "eventName";
	$desc = $_GET['desc'];
	$find = "LIKE '%$search%'";
	$query = "SELECT e.eventName, b.bandName, v.venuename, e.eventDate, e.eventTime, e.eventDescription FROM event e INNER JOIN band b INNER JOIN venue v  WHERE e.eventName $find OR b.bandName $find OR v.venueName $find ORDER BY $sort";
	if ($desc == 1) $query .= " DESC";
	
	echo "<br />";
	$num_col = 0;

	//<band was deleted>
	if ($deleted)
	{
		echo "<fieldset style='border:2px solid white; background-color:black; width:415px;'>";
		echo "<p style='color:white; font-weight:bold; text-align:center;'>";
		echo $del_Name;
		echo " was deleted from BandLink.";
		echo "</p></fieldset>";
	}

	//</band was deleted>
	
	function header_cell($title, $attribute, $num_col)
	{
		++$num_col;
		
		return "<th><a style='color:darkblue;' href='musicsearch?sort=$attribute&desc=$desc'>$title</a></th>";
	}

	echo "<table style='width:640px;' id=\"hor-minimalist-b\" >\n<tr>";
	echo header_cell("Event", "e.eventName", $num_col);
	echo header_cell("Band", "b.bandName", $num_col);
	echo header_cell("Venue", "v.venueName", $num_col);
	if ($logged_in) echo header_cell("", "", $num_col);
	echo "</tr>\n";
	
	function highlight_matches($term, $str, $underline)
	{
		if (empty($term)) return $str;
		
		$start = 0;
		$end = 0;
		$highlight_start = "<span style='background-color:yellow;";
		if ($underline) $highlight_start .= " text-decoration:underline;";
		$highlight_start .= "'>";
		$highlight_end = "</span>";
		$num_instances = substr_count(strtolower($str), strtolower($term));
		
		for ($i = 0; $i < $num_instances; $i++)
		{
			$start = stripos($str, $term, $end);
			$end = $start + strlen($term);
			$str = substr_replace($str, $highlight_start, $start, 0);
			$start += strlen($highlight_start);
			$end += strlen($highlight_start);
			$str = substr_replace($str, $highlight_end, $end, 0);
			$start += strlen($highlight_end);
			$end += strlen($highlight_end);
		}
		
		return $str;
	}
	
	$count = 0;
	$results = mysqli_query($db, $query) or die("Error Querying Database");

	while ($row = mysqli_fetch_assoc($results))
	{
		$name = $row['e.eventName'];
		$band = $row['b.bandName'];
		$venue = $row['v.venueName'];
		
		echo "<tr>";
		echo "<td><a style='color:darkblue;' href='eventprofile.php?name=$name'>";
		echo highlight_matches($search, $name, true)."</a></td>";
		echo "<td>".highlight_matches($search, $band, false)."</td>";
		echo "<td>".highlight_matches($search, $venue, false)."</td>";
		
		if ($logged_in)
		{
			echo "<td>";
			echo "<input type='submit' onClick=\"parent.location = 'deleteEventConfirm.php?deletebox=$name'\" ";
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
		echo "<a style='color:darkblue;' href='eventsearch.php?sort=$sort&desc=$desc'>Show All</a></p></th></tr>";
	}
	
	echo "</table>\n";
	
	echo "<p><form method='get' action='eventsearch.php'>";
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
	</div></center>
	<?php include("footer.html"); ?>
</div>
</body>
</html>