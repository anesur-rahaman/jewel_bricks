<?php require_once "db.php"; ?>
<?php
	date_default_timezone_set('Asia/Kolkata');
	$time_now=mktime(date('H'),date('i'),date('s'));
	$current_date = date('Y-m-d',$time_now);
	$current_time = date('H:i:s',$time_now);
	$date=$current_date." ".$current_time ;
	$vehicle_id = $_POST['vehicle_id'];	
	$description= $_POST['description'] ;
	$running_time= $_POST['running_time'] ;
	$bill= $_POST['bill'] ;		
	$income=$_POST['income'] ;
	$expense= $_POST['expense'] ;		
	$trx_date=$_POST['trx_date'] ;

	$today = date('Y-m-d');

	$result = mysqli_query($conn, "SELECT * FROM vehicle WHERE id  = '$vehicle_id'");
	$row = mysqli_fetch_array($result);
	if (!$result) 
	{
	die("Error: Data not found..");
	}
	$name= $row['name'] ;	
	
	if(($vehicle_id!='')||($description!='')||($running_time!='')||($bill!='')||(income!='')||(expense!='')||($trx_date!='')){
	mysqli_query($conn, "INSERT INTO vehicle_details (vehicle_id, description, running_time, bill, income, expense, trx_date, date) 
	VALUES ('$vehicle_id', '$description', '$running_time', '$bill', '$income', '$expense', '$trx_date', '$date')");
	
	mysqli_query($conn, "INSERT INTO expenses (expense, sub_expense, amount, trx_date, date) 
	VALUES ('$name', '$description', '$expense', '$trx_date', '$date')");
	
	echo '<script>windows: location="vehicle_details_view.php?id=' .$vehicle_id.' "</script>';
	}else{				
	echo '<script>alert("Please fill this form")</script>';
	echo '<script>windows: location="vehicle_details_view.php?id=' .$vehicle_id.' "</script>';
}				
?>