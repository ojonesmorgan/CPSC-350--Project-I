<div id="header" style="margin:10px 10px 0px 10px;">

<?php
echo "<span style='float:right;'>";
if ($logged_in) echo "<span style='color:red;'>".$_SESSION['name']."</span>&nbsp;&nbsp;<a href='logout.php'>Logout</a>";
else echo "<a href='login.php'>Log In</a>";
echo "</span><br />\n";
?>

<a href="."><img border=0 src="Pictures/logo.png" /></a>

<!--<center><h1 style="font-size:150%">BandLink</h1></center></div>-->
</div>
<div id="nav"><center><p><i>Your link to the latest band and venue information.</i></p></center></div>
	<div id="Navigation">
	<a href=".">Home</a>
	|
	<a href="addband.php">Add Band</a>
	|
	<a href="addvenue.php">Add Venue</a>
	|
	<a href="musicsearch.php">Search Music</a>
	|
	<a href="venuesearch.php">Search Venues</a>
	|
	<?php if (!$logged_in) { ?>
	<a href="register.php">Register</a>
	<?php } else { ?>
	<a href="account.php">Account</a>
	<?php } ?>
	</div>