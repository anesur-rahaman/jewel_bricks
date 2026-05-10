<?php
include 'db.php';
	
	$id = $_POST['id'];	
	$customer_id = $_POST['customer_id'];

	$item = $_POST['item'];
	$quantity = $_POST['quantity'];
	$bill=$_POST['bill'];
	$payment = $_POST['payment'];
	$discount = $_POST['discount'];	
	$vehicle = $_POST['vehicle'];
	$trx_date = $_POST['trx_date'];

	mysqli_query($conn, "UPDATE sale SET item ='$item', quantity ='$quantity', bill ='$bill', payment ='$payment', discount='$discount', vehicle='$vehicle', trx_date ='$trx_date' WHERE id = '$id'");
	echo '<script>windows: location="sale_view.php?id=' .$customer_id. ' "</script>';
?>