<?php
include("session.php");

if (!$logged_in) include("notloggedin.php");
include("db_connect.php");

$id = $_GET['id'];
$name = $_POST['name'];
$genre = $_POST['genre'];
$city = $_POST['city'];
$state = $_POST['state'];
$description = $_POST['description'];
$photo = $_POST['photo'];
$genre_id = mysqli_query("SELECT genre_id FROM genre WHERE genre=$genre");

$id = mysql_escape_string(stripslashes(htmlspecialchars(trim($id))));	
$name = mysql_escape_string(stripslashes(htmlspecialchars(trim($name))));
$genre = mysql_escape_string(stripslashes(htmlspecialchars(trim($genre))));
$city = mysql_escape_string(stripslashes(htmlspecialchars(trim($city))));
$state = mysql_escape_string(stripslashes(htmlspecialchars(trim($state))));
$description = mysql_escape_string(stripslashes(htmlspecialchars(trim($description))));
$photo = mysql_escape_string(stripslashes(htmlspecialchars(trim($photo))));

$saved_name = $name;
$band = "WHERE band_id='$id'";
$band_id = mysqli_query("SELECT band_id FROM band_genre WHERE genre_id='$genre_id'");

mysqli_query($db, "UPDATE band SET bandName='$name' $band");
if (!empty($genre_id)) mysqli_query($db, "UPDATE band_genre SET band_id='$genre' WHERE band_id='$band_id";
&& mysqli_query(&db, "UPDATE band SET bandGenre ='$genre' $band");
else mysqli_query(&db, "INSERT INTO genre VALUES '$genre'");
mysqli_query(&db, "UPDATE band SET bandGenre ='$genre' $band");

mysqli_query($db, "UPDATE band SET bandCity='$city' $band");
mysqli_query($db, "UPDATE band SET bandState='$state' $band");
mysqli_query($db, "UPDATE band SET bandPhoto='$photo' $band");
mysqli_query($db, "UPDATE band SET bandDescription='$description' $band");
if (!empty($id)) mysqli_query($db, "UPDATE band SET band_id='$id' $band"); //This must be the LAST update query.
else $saved_id = $id;

header("location:bandprofile.php?id=$saved_id&saved=1");
?>