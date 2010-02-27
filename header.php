<div id="header" style="margin:10px 10px 0px 10px;">

<?php
echo "<span style='float:right;'>";
if ($logged_in) echo "<span style='color:red;'>".$_SESSION['name']."</span>&nbsp;&nbsp;<a href='logout.php'>Logout</a>";
else echo "<a href='login.php'>Log In</a>";
echo "</span><br />\n";
?>

<center><h1 style="font-size:150%">BandLink</h1></center></div>
<div id="nav"><center><p><i>Your Link for the latest band and venue information.</i></p></center></div>
	<div id="Navigation">
	<a href=".">Home</a>
	|
	<a href="addBandForm.php">Add Band</a>
	|
	<a href="addVenueForm.php">Add Venue</a>
	|
	<a href="musicsearch.php">Search Music</a>
	|
	<a href="searchVenue.php">Search Venues</a>
	|
	<?php if (!$logged_in) { ?>
	<a href="register.php">Register</a>
	<?php } else { ?>
	<a href="account.php">Account</a>
	<?php } ?>
	</div>