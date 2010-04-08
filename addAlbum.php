<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Add Album</title>
  <link rel="stylesheet" type="text/css" href="style.css" />
</head>

<body>
<div id="wrap">
<?php include("header.php"); ?>
<div id="main">;

<?php
echo "
	<h1>Add Album</h1>
	
	<div id=\"nav\"><p><i>Add your favorite Albums.</i></p></div>
	
  <form method=\"post\" action=\"addAlbums.php?band=$band\">
    <label for=\"album_name\">Album Name:</label>
    <input type=\"text\" id=\"album_name\" name=\"album_name\" /><br />
  </form>";
  ?>
	</div>
  <?php include("projectSideBar.php"); ?>
  <?php include("footer.html"); ?>
  </div>
  </body>
  </html>