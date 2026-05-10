<?php
include 'db.php';
	date_default_timezone_set('Asia/Kolkata');
	$time_now=mktime(date('H'),date('i'),date('s'));
	$current_date = date('Y-m-d',$time_now);
	$current_time = date('H:i:s',$time_now);
	$date=$current_date." ".$current_time ;

	$id = $_POST['id'];
	$labour_id = $_POST['labour_id'];

	$advance = $_POST['advance'];
	$wages = $_POST['wages'];
	$trx_date = $_POST['trx_date'];
	
	mysqli_query($conn, "UPDATE labour_details SET advance ='$advance', wages ='$wages', trx_date ='$trx_date' WHERE id = '$id'");
	
	echo '<script>windows: location="labour_details_view.php?id=' .$labour_id. ' "</script>';
?>