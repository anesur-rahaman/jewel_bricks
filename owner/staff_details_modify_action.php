<?php
include 'db.php';
	
	$id = $_POST['id'];	
	$staff_id = $_POST['staff_id'];

	$description = $_POST['description'];
	$advance = $_POST['advance'];
	$wages=$_POST['wages'];
	$month = $_POST['month'];
	$year = $_POST['year'];	
	$trx_date = $_POST['trx_date'];

	mysqli_query($conn, "UPDATE staff_details SET description ='$description', advance ='$advance', wages ='$wages', month ='$month', year='$year', trx_date ='$trx_date' WHERE id = '$id'");
	echo '<script>windows: location="staff_details_view.php?id=' .$staff_id. ' "</script>';
?>