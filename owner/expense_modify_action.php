<?php
include 'db.php';
	date_default_timezone_set('Asia/Kolkata');
	$time_now=mktime(date('H'),date('i'),date('s'));
	$current_date = date('Y-m-d',$time_now);
	$current_time = date('H:i:s',$time_now);
	$date=$current_date." ".$current_time ;

	$id = $_POST['id'];		
	$amount = $_POST['amount'];
	$trx_date = $_POST['trx_date'];
	
	mysqli_query($conn, "UPDATE expenses SET amount ='$amount', trx_date ='$trx_date' WHERE id = '$id'");	
	
	echo '<script>windows: location="expense.php"</script>';
?>