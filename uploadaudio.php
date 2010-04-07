<?php
include("session.php");

if (!$logged_in)
{
	include("notloggedin.php");
}

include("db_connect.php");

$track_id = $_POST['track'];

if (isset($_POST) && !empty($track_id))
{
    if (is_uploaded_file($_FILES['mp3']['tmp_name']))
    {
        $file_name = rand(10000000, 100000000)."-".$track_id;
		$uploaded = move_uploaded_file($_FILES['mp3']['tmp_name'], "./audio/$file_name.mp3");
		
        if ($uploaded)
        {
			$email = $_SESSION['email'];
			$play_count = 0;
			
			$result = mysqli_query($db, "SELECT * FROM audio WHERE track_id = '$track_id'");
			
			while ($row = mysqli_fetch_assoc($result))
			{
				$play_count = $row['play_count'];
			}
			
			mysqli_query($db, "START TRANSACTION");
			mysqli_query($db, "DELETE FROM audio WHERE track_id = '$track_id'");
			$query = "INSERT INTO audio (mp3_name, track_id, email, play_count) ";
			$query .= "VALUES ('$file_name', '$track_id', '$email', '$play_count')";
			mysqli_query($db, $query);
			mysqli_query($db, "COMMIT");
		}
		
		else
		{
			header("location:track.php?id=$track_id&err=uploadfail");
			exit;
		}
        
		header("location:track.php?id=$track_id");
    }
	
    else
    {
        header("location:track.php?id=$track_id&err=uploadfail");
		exit;
    }
}

else header("location:.");
?>