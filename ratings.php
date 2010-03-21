<?php
include("db_connect.php");

$page = substr($_SERVER["SCRIPT_NAME"], strrpos($_SERVER["SCRIPT_NAME"], "/") + 1);
if ($page == "bandprofile.php") $condition = "WHERE bandName = '$name'";
else if ($page == "venueprofile.php") $condition = "WHERE venueName = '$name'";

$rating = 0;
$count = 0;
$email = $_SESSION['email'];

$result = mysqli_query($db, "SELECT * FROM ratings $condition");

while ($row = mysqli_fetch_assoc($result))
{	
	$rating += $row['rating'];
	++$count;
}

if ($count > 0) $rating = ($rating / $count);

function display_star($num, $rating)
{
	include("session.php");
	$full_star = "./Pictures/fullstar.gif";
	$half_star = "./Pictures/halfstar.gif";
	$empty_star = "./Pictures/emptystar.gif";
	$name = $_GET['name'];
	
	$page = substr($_SERVER["SCRIPT_NAME"], strrpos($_SERVER["SCRIPT_NAME"], "/") + 1);
	if ($page == "bandprofile.php") $for = "band=$name";
	else if ($page == "venueprofile.php") $for = "venue=$name";
	
	if ($logged_in) echo "<a href='rate.php?rating=$num&$for'>";
	echo "<img name='star$num' ";
	echo "onMouseOver=\"";
		
	for ($i = 1; $i <= $num; $i++)
	{
		echo "document.star$i.src = '$full_star'; ";
	}
	
	for ($i = $num + 1; $i <= 5; $i++)
	{
		echo "document.star$i.src = '$empty_star'; ";
	}
	
	echo "\" ";
	echo "onMouseOut=\"";
	
	for ($i = 1; $i <= 5; $i++)
	{
		echo "if (document.star$i.className == 'full-star') document.star$i.src = '$full_star'; ";
		echo "else if (document.star$i.className == 'half-star') document.star$i.src = '$half_star'; ";
		echo "else if (document.star$i.className == 'empty-star') document.star$i.src = '$empty_star'; ";
	}
		
	echo "\" ";
	if ($rating >= $num) echo "class='full-star' src='$full_star'";
	else if ($rating >= ($num - .5)) echo "class='half-star' src='$half_star'";
	else echo "class='empty-star' src='$empty_star'";
	echo " border=0 />";
	if ($logged_in) echo "</a>";
}

echo "\n<a name='rating'></a><span style='float:right;'>\n";

for ($i = 1; $i <= 5; $i++)
{
	display_star($i, $rating);
}

echo "\n</span>\n";

if (!$logged_in)
{
	echo "<br />\n<span style='font-size:xx-small; font-weight:normal; vertical-align:middle; float:right;'>";
	echo "<a href='login.php?ref=$page?".$_SERVER['QUERY_STRING']."'>Log in</a> to rate $name.";
	echo "</span>\n<br />\n";
}

else if ($_GET['rated'] == 1)
{
	echo "<br />\n<span style='font-size:xx-small; font-weight:normal; vertical-align:middle; float:right;'>";
	echo "Thanks for rating $name.";
	echo "</span>\n<br />\n";
}
?>