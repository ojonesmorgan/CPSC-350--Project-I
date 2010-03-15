<?php
function search_panel($title, $id, $action, $msg)
{
	$on_focus = "onFocus=\"if (this.value == '$msg') { this.value = ''; } this.style.color = 'black';\"";
	$on_blur = "onBlur=\"if(this.value == '') { this.value = '$msg'; this.style.color = 'gray'; }\"";
	$searchbox .= "<input style=\"width:225px; display:block; margin-left:auto; margin-right:auto; color:gray; font-size:0.65em;\"";
	$searchbox .= " $on_focus $on_blur id=\"$id\" name=\"q\" type=\"text\" value=\"$msg\" />";
	$button = "<input style=\"width:225px; display:block; margin:10px auto 2px auto;\" type=\"submit\" value=\" Search \" />";
	$search_panel = "<br />\n";
	$search_panel .= "<fieldset style=\"border:2px solid red;\">\n";
	$search_panel .= "<legend style=\"color:red; font-weight:bold;\">$title</legend>\n";
	$search_panel .= "<form method=\"get\" action=\"$action\">\n";
	$search_panel .= "$searchbox\n$button\n";
	$search_panel .= "</form>\n";
	$search_panel .= "</fieldset>\n";
	return $search_panel;
}

echo "<div id=\"sidebar\">\n";
echo search_panel("Search Music", "searchBand", "musicsearch.php", "Enter an artist, genre, or location...");
echo search_panel("Search Venues", "searchVenue", "searchVenue.php", "Enter a venue name or location...");
echo "</div>\n";
?>