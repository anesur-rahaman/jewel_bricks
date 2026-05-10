<?php
include 'db.php';
	
	$id = $_POST['id'];	
	$vehicle_id = $_POST['vehicle_id'];

	$expense = $_POST['expense'];
	$amount = $_POST['amount'];
	$trx_date = $_POST['trx_date'];

	mysqli_query($conn, "UPDATE vehicle_details SET expense ='$expense', amount ='$amount', trx_date ='$trx_date' WHERE id = '$id'");
	echo '<script>windows: location="vehicle_details_view.php?id=' .$vehicle_id. ' "</script>';
?>