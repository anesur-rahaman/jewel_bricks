<?php require_once "db.php"; ?>
<?php session_start();
if(!isset($_SESSION['id'])){
	echo '<script>windows: location="index.php"</script>';
	}
?>

<?php
$id =$_REQUEST['id'];
$vehicle_id =$_REQUEST['vehicle_id'];
$result = mysqli_query($conn, "SELECT * FROM vehicle WHERE id  = '$vehicle_id'");
$row = mysqli_fetch_array($result);
if (!$result) 
	{
	die("Error: Data not found..");
	}
	$id=$row['id'] ;
	$name= $row['name'] ;					
	$address=$row['address'] ;
	$phone=$row['phone'] ;
?>

<?php
$id =$_REQUEST['id'];
$vehicle_id =$_REQUEST['vehicle_id'];
$result = mysqli_query($conn, "SELECT * FROM vehicle_details WHERE id  = '$id'");
$row = mysqli_fetch_array($result);
if (!$result) 
	{
	die("Error: Data not found..");
	}
	$id=$row['id'] ;
	$vehicle_id= $row['vehicle_id'] ;					
	$expense=$row['expense'] ;
	$amount=$row['amount'] ;
	$trx_date=$row['trx_date'] ;	
?>

<?php
$id =$_REQUEST['id'];
$result = mysqli_query($conn, "SELECT SUM(amount) AS sum_expense FROM vehicle_details WHERE vehicle_id='$vehicle_id'");
while($row = mysqli_fetch_array($result))
{
	$sum_expense = $row['sum_expense'];
}
?>

<!DOCTYPE html>
<html>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
<div class="form-inline" align="center">
<label for="distributor_search" class="font-weight-bold lead text-dark"><h4><font size="" color="blue"><?php echo $name;?></font><small> (ID # <?php echo $vehicle_id;?>)</small> | Total Due : <font size="" color="red"><?php echo number_format($sum_expense);?></font>
</h4></label>
</div>
<form name="myForm" action="vehicle_details_modify_action.php" method="post" style="font-family: Trebuchet MS">
<table width="500">

<input type="hidden" name="id" value="<?php echo $id; ?>" >
<input type="hidden" name="vehicle_id" value="<?php echo $vehicle_id; ?>" >

<tr>
<td>Expense</td>
<td><input list="expenses" name="expense" id="expense" value="<?php echo $expense; ?>" class="form-control" placeholder="Enter Expense" required>
<datalist id="expenses">
<?php
$stmt_details = mysqli_query($conn, "SELECT DISTINCT expense FROM vehicle ORDER BY expense");
while($row_details=mysqli_fetch_array($stmt_details)){
$expense = $row_details['expense'];
?>
<option value="<?php echo $expense;?>"><?php echo $expense;?></option>
<?php 
} ?> 
</datalist></td>
</tr>

<tr>
<td>Amount</td>
	<td><input type="text" name="amount" id="amount" value="<?php echo $amount; ?>" class="form-control" placeholder="Amount"></td>
</tr>

<td>Trx Date</td>
	<td><input type="date" name="trx_date" id="trx_date" value="<?php echo $trx_date; ?>" class="form-control" placeholder="Enter Trx Date" required></td>
</tr>

<tr><td><font size="" color="red"><input type="submit" value="Submit"></td></tr>

</table>
</form>

</body>
</html>