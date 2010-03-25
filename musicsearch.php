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
	if (empty($sort)) $sort = "bandName";
	$desc = $_GET['desc'];
	$find = "LIKE '%$search%'";
	$query = "SELECT * FROM band ORDER BY $sort;";
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
	echo header_cell("Artist", "bandName", $num_col);
	echo header_cell("Genre", "bandGenre", $num_col);
	echo header_cell("City", "bandCity", $num_col);
	echo header_cell("State", "bandState", $num_col);
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
	$result = mysqli_query($db, $query) or die("Error Querying Database");

	while ($row = mysqli_fetch_assoc($result))
	{
		$match = false;
		$id = $row['band_id'];
		$name = $row['bandName'];
		$genre = "";
		$city = $row['bandCity'];
		$state = $row['bandState'];
		
		$query = "SELECT * FROM band_genre WHERE band_id = '$id'";
		$result2 = mysqli_query($db, $query);
		$first = true;
		
		while ($row2 = mysqli_fetch_assoc($result2))
		{	
			$result3 = mysqli_query($db, "SELECT * FROM genre WHERE genre_id = '".$row2['genre_id']."'");
			
			while ($row3 = mysqli_fetch_assoc($result3))
			{
				if (!$first) $genre .= ", ";
				$genre .= $row3['genre'];
				$first = false;
			}
		}
		
		if (stripos($name, $search) !== false) $match = true;
		if (stripos($genre, $search) !== false) $match = true;
		if (stripos($city, $search) !== false) $match = true;
		if (stripos($state, $search) !== false) $match = true;
		
		if ($match || (empty($search)))
		{
			echo "<tr>";
			echo "<td><a style='color:darkblue;' href='bandprofile.php?id=$id'>";
			echo highlight_matches($search, $name, true)."</a></td>";
			echo "<td>".highlight_matches($search, $genre, false)."</td>";
			echo "<td>".highlight_matches($search, $city, false)."</td>";
			echo "<td>".highlight_matches($search, $state, false)."</td>";
			
			if ($logged_in)
			{
				echo "<td style='text-align:right;'>";
				echo "<input type='submit' onClick=\"parent.location = 'deleteBandConfirm.php?deletebox=$name'\" ";
				echo "value='Delete' /></td>";
			}
			
			echo "</tr>\n";
			
			++$count;
		}
	}
	
	if ($count < 1)
	{
		echo "<tr><td style='text-align:center;' colspan='$num_col'><p style='font-weight:bold; font-size:125%'>";
		echo "No results found";
		if (!empty($search)) echo " for \"".$search.".\"</p>";
		else echo ".";
		echo "<p style='font-size:125%'>";
		echo "<a style='color:darkblue;' href='musicsearch.php?sort=$sort&desc=$desc'>Show All</a></p></th></tr>";
	}
	
	echo "</table>\n";
	
	echo "<p><form method='get' action='musicsearch.php'>";
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