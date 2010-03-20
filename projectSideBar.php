<?php
function search_panel($title, $id, $action, $msg)
{
	$style = "style=\"width:225px; display:block; margin-left:auto; margin-right:auto; color:gray; font-size:0.65em;\"";
	$on_focus = "onFocus=\"if (this.value == '$msg') { this.value = ''; } this.style.color = 'black';\"";
	$on_blur = "onBlur=\"if (this.value == '') { this.value = '$msg'; this.style.color = 'gray'; }\"";
	$searchbox = "<input $style $on_focus $on_blur id=\"$id\" name=\"q\" type=\"text\" value=\"$msg\" />";
	
	$style = "style=\"width:225px; display:block; margin:10px auto 2px auto;\"";
	$button = "<input $style type=\"submit\" value=\" Search \" />";
	
	$search_panel = "<br />\n";
	$search_panel .= "<fieldset style=\"border:2px solid red;\">\n";
	$search_panel .= "<legend style=\"color:red; font-weight:bold;\">$title</legend>\n";
	$search_panel .= "<form onSubmit=\"if (this.q.value == '$msg') this.q.value = ''\" ";
	$search_panel .= "method=\"get\" action=\"$action\">\n";
	$search_panel .= "$searchbox\n$button\n";
	$search_panel .= "</form>\n";
	$search_panel .= "</fieldset>\n";
	return $search_panel;
}

function recent_comments($num_comments)
{
	include("db_connect.php");
	
	$recent_comments = "<br />\n<fieldset style=\"border:2px solid red;\">\n";;	
	$recent_comments .= "<legend style=\"color:red; font-weight:bold;\">Recent Comments</legend>\n";
	
	$query = "SELECT a.*, b.name FROM comments AS a NATURAL JOIN users AS b ORDER BY a.id DESC LIMIT $num_comments";
	$result = mysqli_query($db, $query);
	
	while ($row = mysqli_fetch_assoc($result))
	{
		$num_words = 50;
		$count = 0;
		$band = $row['bandName'];
		$venue = $row['venueName'];
		$words = str_word_count($row['comment'], 2);
		
		$recent_comments .= "<p style='font-size:xx-small;'><a href='comments.php?";
		if (!empty($band)) $recent_comments .= "band=$band";
		else if (!empty($venue)) $recent_comments .=  "venue=$venue";
		$recent_comments .=  "#".$row['id']."'>".$row['name']."</a> commented on ";
		if (!empty($band)) $recent_comments .=  $band;
		if (!empty($venue)) $recent_comments .=  $venue;
		
		$recent_comments .=  "...<p style='width:219px; margin-left:10px; color:yellow; font-size:xx-small;'>\n";
		$recent_comments .= $row['comment'];
		$recent_comments .=  "\n</p>\n</p>\n";
		
		++$count;
	}
	
	if ($count < 1) return "";
	
	$recent_comments .= "</fieldset>\n";

	return $recent_comments;
}

echo "<div id=\"sidebar\">\n";
echo search_panel("Search Music", "searchBand", "musicsearch.php", "Enter an artist, genre, or location...");
echo search_panel("Search Venues", "searchVenue", "venuesearch.php", "Enter a venue name or location...");
echo recent_comments(5);
echo "<br /></div>\n";
?>