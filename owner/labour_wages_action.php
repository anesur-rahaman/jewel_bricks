<?php
include 'db.php';
	date_default_timezone_set('Asia/Kolkata');
	$time_now=mktime(date('H'),date('i'),date('s'));
	$current_date = date('Y-m-d',$time_now);
	$current_time = date('H:i:s',$time_now);
	$date=$current_date." ".$current_time ;
	
	$labour_id = $_POST['labour_id'];

	$wages = $_POST['wages'];
	$trx_date = $_POST['trx_date'];

	$today = date('Y-m-d');
	$current_yr = date('Y',$time_now);	
	
	if(($advance!='')||($trx_date!='')){
	mysqli_query($conn, "INSERT INTO labour_details (labour_id, description, advance, wages, trx_date, date) 
	VALUES ('$labour_id', 'Wages', '$advance', '$wages', '$trx_date', '$date')");
	//echo '<script>windows: location="dailysheetreport_trx_date.php?reportdate=' .$trx_date. ' "</script>';
	echo '<script>windows: location="labour_view.php?id=' .$labour_id. ' "</script>';	}else{				
	echo '<script>windows: location="labour_advance.php?id=' .$labour_id. ' "</script>';
}
?>