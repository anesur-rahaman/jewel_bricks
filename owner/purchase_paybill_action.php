<?php
include 'db.php';
	date_default_timezone_set('Asia/Kolkata');
	$time_now=mktime(date('H'),date('i'),date('s'));
	$current_date = date('Y-m-d',$time_now);
	$current_time = date('H:i:s',$time_now);
	$date=$current_date." ".$current_time ;
	
	$vendor_id = $_POST['vendor_id'];

	$item = $_POST['item'];
	$quantity = $_POST['quantity'];
	$bill=$_POST['bill'];
	$payment = $_POST['payment'];
	$vehicle = $_POST['vehicle'];
	$trx_date = $_POST['trx_date'];

	$today = date('Y-m-d');
	$current_yr = date('Y',$time_now);	
	
	if(($item!='')||($quantity!='')||($bill!='')||($payment!='')||($vehicle!='')||($trx_date!='')){
	mysqli_query($conn, "INSERT INTO purchase (vendor_id, item, quantity, bill, payment, vehicle, trx_date, date) 
	VALUES ('$vendor_id', '$item', '$quantity', '$bill', '$payment', '$vehicle', '$trx_date', '$date')");
	//echo '<script>windows: location="dailysheetreport_trx_date.php?reportdate=' .$trx_date. ' "</script>';
	echo '<script>windows: location="purchase_view.php?id=' .$vendor_id. ' "</script>';
	}else{				
	echo '<script>windows: location="purchase_paybill.php?id=' .$vendor_id. ' "</script>';
}
?>