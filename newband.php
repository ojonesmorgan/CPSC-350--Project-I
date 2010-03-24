<?php
include("session.php");
if (!$logged_in) include("notloggedin.php");

include("db_connect.php");
  
$name = mysql_escape_string(stripslashes(htmlspecialchars(trim($_POST['name']))));
$state = mysql_escape_string(stripslashes(htmlspecialchars(trim($_POST['state']))));
$city = mysql_escape_string(stripslashes(htmlspecialchars(trim($_POST['city'])))); 
$genre1 = mysql_escape_string(stripslashes(htmlspecialchars(trim($_POST['genre1']))));
$genre2 = mysql_escape_string(stripslashes(htmlspecialchars(trim($_POST['genre2']))));
$genre3 = mysql_escape_string(stripslashes(htmlspecialchars(trim($_POST['genre3']))));
$genre4 = mysql_escape_string(stripslashes(htmlspecialchars(trim($_POST['genre4']))));
$photo = mysql_escape_string(stripslashes(htmlspecialchars(trim($_POST['photo']))));
$description = mysql_escape_string(stripslashes(htmlspecialchars(trim($_POST['description']))));
//<Test for duplicated genres for a single band>
if ($genre1==$genre2){
	$genre2="";
}
if ($genre1 ==$genre3){
	$genre3="";
}
if ($genre1 == $genre4){
	$genre4="";
}
if ($genre2 == $genre3){
	$genre3="";
}
if ($genre2 == $genre4){
	$genre4="";
}
if ($genre3 == $genre4){
	$genre4="";
}
//</Test for duplicated genres for a single band>
//***********************************************
//<Insert New Band into DB>
if (!empty($name)) mysqli_query($db, $query = "INSERT INTO band (bandName, bandState, bandDescription, bandPhoto) VALUES ('$name', '$state', '$description', '$photo')");
else header("location:addband.php?err=noname&name=$name&genre=$genre&city=$city&state=$state&description=$description&photo=$photo");
//</Insert New Band into DB>
//***********************************************
//<Find Band's ID>
	//<Find Last Band Entered>
		$quickQ="select band_id from band order by band_id desc limit 1";
		$quickR=mysqli_query($db,$quickQ);
		while ($quickRow= mysqli_fetch_array($quickR)){
			$bandID=$quickRow['band_id'];
		}
	//</Find Last Band Entered>
//</Find Band's ID>
//***********************************************
//<Test to see if genre is already in database if not add it, then add band and genre to band_genre>
if ($genre1 != null and $genre1 !=""){
	//<Test to see if Genre is already in the table>
	$GenreQuery="select * from genre where genre ='$genre1'";
	$GenreResults=mysqli_query($db,$GenreQuery);
	$counter=0;
	while ($row1 = mysqli_fetch_array($GenreResults)){
	$counter=$counter + 1;
	}
	if($counter==0){//genre was not already in the table and needs to be added
			//test
			echo "Making it in here";
			//test
			mysqli_query($db, $query="INSERT INTO genre (genre) VALUES ('$genre1')");
	}
	//</Test to see if Genre is already in the table>
	//***********************************************
	//<Find Genre's ID>
	$GenreQuery="select * from genre where genre='$genre1'";
	$GenreResults=mysqli_query($db,$GenreQuery);
	while ($row1 = mysqli_fetch_array($GenreResults)){
	$genreID=$row1['genre_id'];
	}
	//</Find Genre's ID>
	//***********************************************
	//<Add Genre and Band to band_genre table>
	mysqli_query($db, $query="INSERT INTO band_genre (band_id, genre_id) VALUES('$bandID','$genreID')");
	//</Add Genre and Band to band_genre table>
	//***********************************************
}
if ($genre2 != null and $genre2 !=""){
	//<Test to see if Genre is already in the table>
	$GenreQuery="select * from genre where genre ='$genre2'";
	$GenreResults=mysqli_query($db,$GenreQuery);
	$counter=0;
	while ($row1 = mysqli_fetch_array($GenreResults)){
	$counter=$counter + 1;
	}
	if($counter==0){//genre was not already in the table and needs to be added
			mysqli_query($db, $query="INSERT INTO genre (genre) VALUES ('$genre2')");
	}
	//</Test to see if Genre is already in the table>
	//***********************************************
	//<Find Genre's ID>
	$GenreQuery="select * from genre where genre='$genre2'";
	$GenreResults=mysqli_query($db,$GenreQuery);
	while ($row1 = mysqli_fetch_array($GenreResults)){
	$genreID=$row1['genre_id'];
	}
	//</Find Genre's ID>
	//***********************************************
	//<Add Genre and Band to band_genre table>
	mysqli_query($db, $query="INSERT INTO band_genre (band_id, genre_id) VALUES('$bandID','$genreID')");
	//</Add Genre and Band to band_genre table>
	//***********************************************

}
if ($genre3 != null and $genre3 !=""){
	//<Test to see if Genre is already in the table>
	$GenreQuery="select * from genre where genre ='$genre3'";
	$GenreResults=mysqli_query($db,$GenreQuery);
	$counter=0;
	while ($row1 = mysqli_fetch_array($GenreResults)){
	$counter=$counter + 1;
	}
	if($counter==0){//genre was not already in the table and needs to be added
			mysqli_query($db, $query="INSERT INTO genre (genre) VALUES ('$genre3')");
	}
	//</Test to see if Genre is already in the table>
	//***********************************************
	//<Find Genre's ID>
	$GenreQuery="select * from genre where genre='$genre3'";
	$GenreResults=mysqli_query($db,$GenreQuery);
	while ($row1 = mysqli_fetch_array($GenreResults)){
	$genreID=$row1['genre_id'];
	}
	//</Find Genre's ID>
	//***********************************************
	//<Add Genre and Band to band_genre table>
	mysqli_query($db, $query="INSERT INTO band_genre (band_id, genre_id) VALUES('$bandID','$genreID')");
	//</Add Genre and Band to band_genre table>
	//***********************************************

}
if ($genre4 != null and $genre4 !=""){
	//<Test to see if Genre is already in the table>
	$GenreQuery="select * from genre where genre ='$genre4'";
	$GenreResults=mysqli_query($db,$GenreQuery);
	$counter=0;
	while ($row1 = mysqli_fetch_array($GenreResults)){
	$counter=$counter + 1;
	}
	if($counter==0){//genre was not already in the table and needs to be added
			mysqli_query($db, $query="INSERT INTO genre (genre) VALUES ('$genre4')");
	}
	//</Test to see if Genre is already in the table>
	//***********************************************
	//<Find Genre's ID>
	$GenreQuery="select * from genre where genre='$genre4'";
	$GenreResults=mysqli_query($db,$GenreQuery);
	while ($row1 = mysqli_fetch_array($GenreResults)){
	$genreID=$row1['genre_id'];
	}
	//</Find Genre's ID>
	//***********************************************
	//<Add Genre and Band to band_genre table>
	mysqli_query($db, $query="INSERT INTO band_genre (band_id, genre_id) VALUES('$bandID','$genreID')");
	//</Add Genre and Band to band_genre table>
	//***********************************************

}






//</Test to see if genre is already in database if not add it, then add band and genre to band_genre>
//***********************************************


//if (!empty($name)) mysqli_query($db, $query = "INSERT INTO band (bandName, bandState, bandDescription, bandPhoto) VALUES ('$name', '$state', '$description', '$photo')");
//else header("location:addband.php?err=noname&name=$name&genre=$genre&city=$city&state=$state&description=$description&photo=$photo");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>BandLink | Band Added</title>
  <link rel="stylesheet" type="text/css" href="style.css" />
</head>

<body>
<div id="wrap">
<?php include("header.php"); ?>
<center><div>
	
<?php
echo "<br /><h1>Thanks for adding the band $name.</h1>";
echo "<p><a href='bandprofile.php?name=$name'>Click here to go to ".$name."'s profile.</a></p><br />\n";
?>
	
</div></center></div>
</body>
</html>