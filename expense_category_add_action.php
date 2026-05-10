<?php require_once "db.php"; ?>
<?php
date_default_timezone_set('Asia/Kolkata');
$time_now=mktime(date('H'),date('i'),date('s'));
$current_date = date('Y-m-d',$time_now);
$current_time = date('H:i:s',$time_now);
$date=$current_date." ".$current_time ;
	
//$id=$_POST['id'] ;
$expense= $_POST['expense'] ;					
$sub_expense= $_POST['sub_expense'] ;					

if(($expense!='')||($sub_expense!='')){
mysqli_query($conn, "INSERT INTO  expense_category (expense, sub_expense) VALUES ('$expense', '$sub_expense')");
//echo '<script>alert("Successful")</script>';
echo '<script>windows: location="expense.php"</script>';
}else{				
echo '<script>alert("Please fill this form")</script>';
echo '<script>windows: location="expense.php"</script>';
}				
?>