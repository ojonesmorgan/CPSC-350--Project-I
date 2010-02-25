<div id="header" style="margin:10px 20px 0px 20px;">

<?php
echo "<span style='float:right;'>";
if ($logged_in) echo $_SESSION['name']."&nbsp;&nbsp;<a href='logout.php'>Logout</a>";
else echo "<a href='login.php'>Login</a>";
echo "</span><br />\n";
?>

<h1 style="font-size:150%">BandLink</h1></div>
<div id="nav"><p><i>The most up to date site for the best bands and venues.</i></p></div>
	<div id="Navigation">
	<a href="main_page.php">Home</a>
	|
	<?php if (!$logged_in) { ?>
	<a href="register.php">Register</a>
	|
	<?php } ?>
	<a href="addBandForm.php">Add Band</a>
	|
	<a href="addVenueForm.php">Add Venue</a>
	|
	<a href="musicsearch.php">Search Music</a>
	|
	<a href="searchVenue.php">Search Venues</a>
	</div>