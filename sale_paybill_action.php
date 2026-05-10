<?php
include 'db.php';
	date_default_timezone_set('Asia/Kolkata');
	$time_now=mktime(date('H'),date('i'),date('s'));
	$current_date = date('Y-m-d',$time_now);
	$current_time = date('H:i:s',$time_now);
	$date=$current_date." ".$current_time ;
	
	$customer_id = $_POST['customer_id'];

	$item = $_POST['item'];
	$quantity = $_POST['quantity'];
	$bill=$_POST['bill'];
	$payment = $_POST['payment'];
	$discount = $_POST['discount'];	
	$vehicle = $_POST['vehicle'];
	$trx_date = $_POST['trx_date'];

	$today = date('Y-m-d');
	$current_yr = date('Y',$time_now);	
	
	if(($item!='')||($quantity!='')||($bill!='')||($payment!='')||($discount!='')||($vehicle!='')||($trx_date!='')){
	mysqli_query($conn, "INSERT INTO sale (customer_id, item, quantity, bill, payment, discount, vehicle, trx_date, date) 
	VALUES ('$customer_id', '$item', '$quantity', '$bill', '$payment', '$discount', '$vehicle', '$trx_date', '$date')");
	//echo '<script>windows: location="dailysheetreport_trx_date.php?reportdate=' .$trx_date. ' "</script>';
	echo '<script>windows: location="sale_view.php?id=' .$customer_id. ' "</script>';	}else{				
	echo '<script>windows: location="sale_paybill.php?id=' .$customer_id. ' "</script>';
}
?>