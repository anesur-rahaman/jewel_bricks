<?php require_once "db.php"; ?>
<?php
	date_default_timezone_set('Asia/Kolkata');
	$time_now=mktime(date('H'),date('i'),date('s'));
	$current_date = date('Y-m-d',$time_now);
	$current_time = date('H:i:s',$time_now);
	$date=$current_date." ".$current_time ;
	
	$expense= $_POST['expense'] ;					
	$sub_expense= $_POST['sub_expense'] ;					
	$amount=$_POST['amount'] ;
	$trx_date=$_POST['trx_date'] ;

	$today = date('Y-m-d');
	
	if(($expense!='')||($sub_expense!='')||(amount!='')||($trx_date!='')){
	mysqli_query($conn, "INSERT INTO expenses (expense, sub_expense, amount, trx_date, date) 
	VALUES ('$expense', '$sub_expense', '$amount', '$trx_date', '$date')");
	echo '<script>windows: location="expense.php"</script>';	
	}else{				
	echo '<script>alert("Please fill this form")</script>';
	echo '<script>windows: location="expense.php"</script>';
}				
?>