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
 <?php include("header.php");?>
 <div id="main">

<?php
include "db_connect.php";

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
   
echo "<h2>You have uploaded a new picture to BandLink successfully</h2>";
echo "<h3><a href=\"addBand.php?picPath=$filePath\"> Return to Add Band </a></h3>";

}


mysqli_close($db);
?> 
	
	<form name="Image" enctype="multipart/form-data" <?php echo "action='uploadImage.php?tag= $id '" ?> method="POST">

	<input type="file" name="Photo" size="30" accept="image/gif, image/jpeg, image/x-ms-bmp, image/x-png"><br/>

	<INPUT type="submit" class="button" name="Submit" value=" Submit ">

	&nbsp;&nbsp;<INPUT type="reset" class="button" value="Cancel">
	

</div>
<?php include("projectSideBar.php"); ?>
<?php include ("footer.html"); ?>
</div>
 </BODY>
</HTML>
