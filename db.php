<?php
	$hostname = "sql213.infinityfree.com";
	$dbname = "if0_41881666_jewel_bricks";
	$username = "if0_41881666";
	$password = "JewelBricks123";
	$conn = mysqli_connect($hostname,$username,$password) or die ("Could Not Connect To MySQL");
	$conn->set_charset("utf8");
	mysqli_select_db($conn, $dbname) or die ("No Database");     
?>