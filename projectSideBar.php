<?php
function searchbox_js_events($msg)
{
	$on_focus = "onFocus=\"if (this.value == '$msg') { this.value = ''; } this.style.color = 'black';\"";
	$on_blur = "onBlur=\"if(this.value == '') { this.value = '$msg'; this.style.color = 'gray'; }\"";
	$value = "value='$msg'";
	return "$on_focus \n$on_blur \n$value ";
}
?>

<div id="sidebar">
<br />
<fieldset style="border:2px solid red;">
<legend style="color:red; font-weight:bold;">Search Music</legend>
<form method="get" action="musicsearch.php">
<input style="width:225px; display:block; margin-left:auto; margin-right:auto; color:gray; font-size:0.65em;"

<?php
echo searchbox_js_events("Enter an artist, genre, or location...");
?>

type="text" id="searchBand" name="q" />
<input style="width:225px; display:block; margin:10px auto 2px auto;" type="submit" value=" Search " />
</form>
</fieldset>
<br />
<fieldset style="border:2px solid red;">
<legend style="color:red; font-weight:bold;">Search Venues</legend>
<form method="get" action="searchVenue.php">
<input style="width:225px; display:block; margin-left:auto; margin-right:auto; color:gray; font-size:0.65em;"

<?php
echo searchbox_js_events("Enter a venue name or location...");
?>

type="text" id="searchVenue" name="q" />
<input style="width:225px; display:block; margin:10px auto 2px auto;" type="submit" value=" Search " />
</form>
</fieldset>
</div>