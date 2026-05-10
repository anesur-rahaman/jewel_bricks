<?php
	$hostname = "localhost";
	$dbname = "jewel_bricks";
	$username = "root";
	$password = "Kolkata@786";
	$conn = mysqli_connect($hostname,$username,$password) or die ("Could Not Connect To MySQL");
	$conn->set_charset("utf8");
	mysqli_select_db($conn, $dbname) or die ("No Database");     
?>