<?php
include("session.php");
/**if (!isset($_SESSION['user'])){
	$_SESSION['user']=$user;
	header("location: index.php");
	}
**/
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML>
 <HEAD>
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>BandLink | Upload Image</title>
  <link rel="stylesheet" type="text/css" href="style.css" />
	
	<div id="wrap">
 <BODY>
 <?php //include("header.php");?>
 <image src="Pictures/upload.png" />
 <div id="main">

<?php
include "db_connect.php";


//<Refered From>
$refer=$_GET['sent'];

if($refer=="editvenue"){
$other=$_GET['other'];
}
if($refer=="editmap"){
$other=$_GET['other'];
}
$band = $_GET['band'];
$venue = $_GET['venue'];


//</Refered From>


$id = $_GET['tag'];
//static $ids =& $id;
//echo "$id <--ID";

$uploadDir = 'Pictures/'; //Image Upload Folder


//if(!is_dir($uploadDir))

//{

//mkdir($uploadDir,0777);

//}

if(isset($_POST['Submit']))

{



$fileName = $_FILES['Photo']['name'];

$tmpName = $_FILES['Photo']['tmp_name'];

$fileSize = $_FILES['Photo']['size'];

$fileType = $_FILES['Photo']['type'];

$filePath = $uploadDir . $fileName;

$result = move_uploaded_file($tmpName, $filePath);

if (!$result) {

echo "Error uploading file";

exit;

}

if(!get_magic_quotes_gpc()) {

$fileName = addslashes($fileName);

$filePath = addslashes($filePath);

}

//$query = "UPDATE band SET image = '$fileName' WHERE bandID = '$id'";
  
//$result = mysqli_query($db, $query)
   //or die("Error Querying Database");
if($refer=="bandimg"){  
echo "<h2>Your image has been uploaded successfully.</h2>";
echo "<h3>You may copy this path:<font color = grey>  $filePath</font> and paste it into your 'Photo' field, then close this Tab/Window.</h3>";
//echo "<h3><a href=\"addBand.php?picPath=$filePath\"> Return to Add Band </a></h3>";
}
if($refer=="editband"){  
echo "<h2>Your image has been uploaded successfully.</h2>";
echo "<h3>You may copy this path:<font color = grey>  $filePath</font> and paste it into your 'Photo' field, then close this Tab/Window.</h3>";
//echo "<h3><a href=\"bandprofile.php?id=$band&edit=1&picPath=$filePath\"> Return to Band Profile </a></h3>";
}
if($refer=="venimg"){
echo "<h2>Your image has been uploaded successfully.</h2>";
echo "<h3>You may copy this path:<font color = grey>  $filePath</font> and paste it into your 'Picture' field, then close this Tab/Window.</h3>";
//echo "<h3><a href=\"addvenue.php?picPath=$filePath\"> Return to Add Venue </a></h3>";
}
if($refer=="venmap"){
echo "<h2>Your image has been uploaded successfully.</h2>";
echo "<h3>You may copy this path:<font color = grey>  $filePath</font> and paste it into your 'Map Image' field, then close this Tab/Window.</h3>";
//echo "<h3><a href=\"addvenue.php?mapPath=$filePath\"> Return to Add Venue </a></h3>";
}
if($refer=="editvenue"){  
echo "<h2>Your image has been uploaded successfully.</h2>";
echo "<h3>You may copy this path:<font color = grey>  $filePath</font> and paste it into your 'Photo' field, then close this Tab/Window.</h3>";
//echo "<h3><a href=\"venueprofile.php?id=$venue&edit=1&mapPath=$other&picPath=$filePath\"> Return to Venue Profile </a></h3>";
}
if($refer=="editmap"){  
echo "<h2>Your image has been uploaded successfully.</h2>";
echo "<h3>You may copy this path:<font color = grey>  $filePath</font> and paste it into your 'Map Image' field, then close this Tab/Window.</h3>";
//echo "<h3><a href=\"venueprofile.php?id=$venue&edit=1&picPath=$other&mapPath=$filePath\"> Return to Venue Profile </a></h3>";
}


}


mysqli_close($db);
?> 
	<h2>Please Choose a File to Upload.</h2>
	<form name="Image" enctype="multipart/form-data" <?php echo "action='uploadImage.php?tag=$id&sent=$refer&other=$other&band=$band&venue=$venue'" ?> method="POST">

	<input type="file" style="background-color:darkblue; color:red;" name="Photo" size="30" accept="image/gif, image/jpeg, image/x-ms-bmp, image/x-png"><br/>

	<INPUT type="submit" class="button" name="Submit" value=" Submit ">

	&nbsp;&nbsp;<INPUT type="reset" style="background-color:lightblue; color:darkred;"class="button" value="Cancel">
	

</div>
<?php //include("projectSideBar.php"); ?>
<?php include ("footer.html"); ?>
</div>
 </BODY>
</HTML>
