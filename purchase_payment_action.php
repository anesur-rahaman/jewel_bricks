<?php
include 'db.php';

	date_default_timezone_set('Asia/Kolkata');
	$time_now=mktime(date('H'),date('i'),date('s'));
	$current_date = date('Y-m-d',$time_now);
	$current_time = date('H:i:s',$time_now);
	$date=$current_date." ".$current_time ;
	
	$vendor_id = $_POST['vendor_id'];

	$payment = $_POST['payment'];
	$trx_date = $_POST['trx_date'];
	
	$today = date('Y-m-d');
	$current_yr = date('Y',$time_now);	

	$result = mysqli_query($conn, "SELECT * FROM vendors WHERE id  = '$vendor_id'");
	$row = mysqli_fetch_array($result);
	if (!$result) 
	{
	die("Error: Data not found..");
	}
	$name= $row['name'] ;
	
	if(($payment!='')){
	mysqli_query($conn, "INSERT INTO purchase (vendor_id, item, quantity, bill, payment, vehicle, trx_date, date) 
	VALUES ('$vendor_id', '$item', '$quantity', '$bill', '$payment', '$vehicle', '$trx_date', '$date')");
	
	mysqli_query($conn, "INSERT INTO expenses (expense, sub_expense, amount, trx_date, date) 
	VALUES ('Payment', '$name', '$payment', '$trx_date', '$date')");
	
	//echo '<script>windows: location="dailysheetreport_trx_date.php?reportdate=' .$trx_date. ' "</script>';
	echo '<script>windows: location="purchase_view.php?id=' .$vendor_id. ' "</script>';
	}else{				
	echo '<script>windows: location="purchase_payment.php?id=' .$vendor_id. ' "</script>';
}
?>