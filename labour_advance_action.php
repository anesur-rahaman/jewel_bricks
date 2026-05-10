<?php
include 'db.php';
	date_default_timezone_set('Asia/Kolkata');
	$time_now=mktime(date('H'),date('i'),date('s'));
	$current_date = date('Y-m-d',$time_now);
	$current_time = date('H:i:s',$time_now);
	$date=$current_date." ".$current_time ;
	
	$labour_id = $_POST['labour_id'];
	$description = $_POST['description'];
	$advance = $_POST['advance'];
	$trx_date = $_POST['trx_date'];

	$today = date('Y-m-d');
	$current_yr = date('Y',$time_now);	

	$result = mysqli_query($conn, "SELECT * FROM labour WHERE id  = '$labour_id'");
	$row = mysqli_fetch_array($result);
	if (!$result) 
	{
	die("Error: Data not found..");
	}
	$name= $row['name'] ;

	if(($advance!='')||($trx_date!='')){

	mysqli_query($conn, "INSERT INTO labour_details (labour_id, description, advance, salary, salary_paid, wages, month, year, trx_date, date) 
	VALUES ('$labour_id', '$description', '$advance', '$salary', '$salary_paid', '$wages', '$month', '$year', '$trx_date', '$date')");	
	
	mysqli_query($conn, "INSERT INTO expenses (expense, sub_expense, amount, trx_date, date) 
	VALUES ('$description', '$name', '$advance', '$trx_date', '$date')");
	
	echo '<script>windows: location="labour_details_view.php?id=' .$labour_id. ' "</script>';	}else{				
	echo '<script>windows: location="labour_advance.php?id=' .$labour_id. ' "</script>';
}
?>