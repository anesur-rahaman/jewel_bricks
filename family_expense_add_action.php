<?php require_once "db.php"; ?>
<?php
	date_default_timezone_set('Asia/Kolkata');
	$time_now=mktime(date('H'),date('i'),date('s'));
	$current_date = date('Y-m-d',$time_now);
	$current_time = date('H:i:s',$time_now);
	$date=$current_date." ".$current_time ;
	
	$expense= $_POST['expense'] ;					
	$expense_by= $_POST['expense_by'] ;					
	$amount=$_POST['amount'] ;
	$trx_date=$_POST['trx_date'] ;

	$today = date('Y-m-d');
	
	if(($expense!='')||($expense_by!='')||(amount!='')||($trx_date!='')){
	mysqli_query($conn, "INSERT INTO family_expense (expense, expense_by, amount, trx_date, date) VALUES ('$expense', '$expense_by', '$amount', '$trx_date', '$date')");
	mysqli_query($conn, "INSERT INTO expenses (expense, sub_expense, amount, trx_date, date) VALUES ('$expense', '$expense_by', '$amount', '$trx_date', '$date')");	
	echo '<script>windows: location="family_expense.php?expense_by=' .$expense_by. '"</script>';
	}else{				
	echo '<script>alert("Please fill this form")</script>';
	echo '<script>windows: location="family_expense.php?expense_by=' .$expense_by. '"</script>';	
}				
?>