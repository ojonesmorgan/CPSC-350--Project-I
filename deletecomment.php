<?php
include("session.php");

if (!$logged_in) include("notloggedin.php");

$id = $_GET['id'];
$ref = $_GET['ref'];

include("db_connect.php");

$result = mysqli_query($db, "SELECT * FROM comments WHERE id = '$id'");

while ($row = mysqli_fetch_assoc($result))
{
	$email = $row['email'];
}

if (($email == $_SESSION['email']) || $is_admin)
{
	mysqli_query($db, "DELETE FROM comments WHERE id = '$id'");
}

header("location:$ref#comments");
?>