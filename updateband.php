<?php
include("session.php");

if (!$logged_in) include("notloggedin.php");
include("db_connect.php");

$id = $_GET['id'];
$name = $_POST['name'];
$genre1 = $_POST['genre1'];
$genre2 = $_POST['genre2'];
$genre3 = $_POST['genre3'];
$genre4 = $_POST['genre4'];
$state = $_POST['state'];
$description = $_POST['description'];
$photo = $_POST['photo'];

$id = mysql_escape_string(stripslashes(htmlspecialchars(trim($id))));	
$name = mysql_escape_string(stripslashes(htmlspecialchars(trim($name))));
$genre1 = mysql_escape_string(stripslashes(htmlspecialchars(trim($genre1))));
$genre2 = mysql_escape_string(stripslashes(htmlspecialchars(trim($genre2))));
$genre3 = mysql_escape_string(stripslashes(htmlspecialchars(trim($genre3))));
$genre4 = mysql_escape_string(stripslashes(htmlspecialchars(trim($genre4))));
$state = mysql_escape_string(stripslashes(htmlspecialchars(trim($state))));
$description = mysql_escape_string(stripslashes(htmlspecialchars(trim($description))));
$photo = mysql_escape_string(stripslashes(htmlspecialchars(trim($photo))));

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

if ($genre1 != null and $genre1 !=""){
	//***********************************************
	//<Find Genre's ID>
	$GenreQuery="select * from genre where genre='$genre1'";
	$GenreResults=mysqli_query($db,$GenreQuery);
	while ($row1 = mysqli_fetch_array($GenreResults)){
	$genreID=$row1['genre_id'];
	}
	//</Find Genre's ID>
	//***********************************************
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
    // if genre does exist test to see of the band is already connected to it
    }else {
    	
    	$GenreBandQuery="select * from band_genre where genre_id ='$genreID' && band_id='$id'";
		$GenreBandResults=mysqli_query($db,$GenreBandQuery);
		$counter=0;
		while ($row1 = mysqli_fetch_array($GenreBandResults)){
    		$counter = $counter + 1;
    	}
    	if ($counter==0) {
    		mysqli_query($db, "INSERT INTO band_genre VALUES ('$id','$genre_ID')");
    	}	
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
	mysqli_query($db, $query="INSERT INTO band_genre (band_id, genre_id) VALUES('$id','$genreID')");
	//</Add Genre and Band to band_genre table>
	//***********************************************
}
//Testing genre2
if ($genre2 != null and $genre2 !=""){
	//***********************************************
	//<Find Genre's ID>
	$GenreQuery="select * from genre where genre='$genre1'";
	$GenreResults=mysqli_query($db,$GenreQuery);
	while ($row1 = mysqli_fetch_array($GenreResults)){
	$genreID=$row1['genre_id'];
	}
	//</Find Genre's ID>
	//***********************************************
	//<Test to see if Genre is already in the table>
	$GenreQuery="select * from genre where genre ='$genre2'";
	$GenreResults=mysqli_query($db,$GenreQuery);
	$counter=0;
	while ($row1 = mysqli_fetch_array($GenreResults)){
	$counter=$counter + 1;
	}
	if($counter==0){//genre was not already in the table and needs to be added
			//test
			echo "Making it in here";
			//test
			mysqli_query($db, $query="INSERT INTO genre (genre) VALUES ('$genre2')");
    // if genre does exist test to see of the band is already connected to it
    }else{
    	
    	$GenreBandQuery="select * from band_genre where genre_id ='$genreID' && band_id='$id'";
		$GenreBandResults=mysqli_query($db,$GenreBandQuery);
		$counter=0;
		while ($row1 = mysqli_fetch_array($GenreBandResults)){
    		$counter = $counter + 1;
    	}
    	if ($counter==0) {
    		mysqli_query($db, "INSERT INTO band_genre VALUES ('$id','$genre_ID')");
    	}	
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
	mysqli_query($db, $query="INSERT INTO band_genre (band_id, genre_id) VALUES('$id','$genreID')");
	//</Add Genre and Band to band_genre table>
	//***********************************************
}
//Testing genre 3
if ($genre3 != null and $genre3 !=""){
	//***********************************************
	//<Find Genre's ID>
	$GenreQuery="select * from genre where genre='$genre3'";
	$GenreResults=mysqli_query($db,$GenreQuery);
	while ($row1 = mysqli_fetch_array($GenreResults)){
	$genreID=$row1['genre_id'];
	}
	//</Find Genre's ID>
	//***********************************************
	//<Test to see if Genre is already in the table>
	$GenreQuery="select * from genre where genre ='$genre3'";
	$GenreResults=mysqli_query($db,$GenreQuery);
	$counter=0;
	while ($row1 = mysqli_fetch_array($GenreResults)){
	$counter=$counter + 1;
	}
	if($counter==0){//genre was not already in the table and needs to be added
			//test
			echo "Making it in here";
			//test
			mysqli_query($db, $query="INSERT INTO genre (genre) VALUES ('$genre3')");
    // if genre does exist test to see of the band is already connected to it
    }else{
    	
    	$GenreBandQuery="select * from band_genre where genre_id ='$genreID' && band_id='$id'";
		$GenreBandResults=mysqli_query($db,$GenreBandQuery);
		$counter=0;
		while ($row1 = mysqli_fetch_array($GenreBandResults)){
    		$counter = $counter + 1;
    	}
    	if ($counter==0) {
    		mysqli_query($db, "INSERT INTO band_genre VALUES ('$id','$genre_ID')");
    	}	
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
	mysqli_query($db, $query="INSERT INTO band_genre (band_id, genre_id) VALUES('$id','$genreID')");
	//</Add Genre and Band to band_genre table>
	//***********************************************
}
//Testing genre 4
if ($genre1 != null and $genre4 !=""){
	//***********************************************
	//<Find Genre's ID>
	$GenreQuery="select * from genre where genre='$genre4'";
	$GenreResults=mysqli_query($db,$GenreQuery);
	while ($row1 = mysqli_fetch_array($GenreResults)){
	$genreID=$row1['genre_id'];
	}
	//</Find Genre's ID>
	//***********************************************
	//<Test to see if Genre is already in the table>
	$GenreQuery="select * from genre where genre ='$genre4'";
	$GenreResults=mysqli_query($db,$GenreQuery);
	$counter=0;
	while ($row1 = mysqli_fetch_array($GenreResults)){
	$counter=$counter + 1;
	}
	if($counter==0){//genre was not already in the table and needs to be added
			//test
			echo "Making it in here";
			//test
			mysqli_query($db, $query="INSERT INTO genre (genre) VALUES ('$genre4')");
    // if genre does exist test to see of the band is already connected to it
    }else{
    	
    	$GenreBandQuery="select * from band_genre where genre_id ='$genreID' && band_id='$id'";
		$GenreBandResults=mysqli_query($db,$GenreBandQuery);
		$counter=0;
		while ($row1 = mysqli_fetch_array($GenreBandResults)){
    		$counter = $counter + 1;
    	}
    	if ($counter==0) {
    		mysqli_query($db, "INSERT INTO band_genre VALUES ('$id','$genre_ID')");
    	}	
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
	mysqli_query($db, $query="INSERT INTO band_genre (band_id, genre_id) VALUES('$id','$genreID')");
	//</Add Genre and Band to band_genre table>
	//***********************************************
}





$saved_id = $id;
$band = "WHERE band_id='$id'";

mysqli_query($db, "UPDATE band SET bandName='$name' $band");
mysqli_query($db, "UPDATE band SET bandCity='$city' $band");
mysqli_query($db, "UPDATE band SET bandState='$state' $band");
mysqli_query($db, "UPDATE band SET bandPhoto='$photo' $band");
mysqli_query($db, "UPDATE band SET bandDescription='$description' $band");
if (!empty($id)) mysqli_query($db, "UPDATE band SET band_id='$id' $band"); //This must be the LAST update query.
else $saved_id = $id;

header("location:bandprofile.php?id=$saved_id&saved=1");
?>