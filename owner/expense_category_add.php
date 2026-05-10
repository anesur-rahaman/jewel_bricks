<?php require_once "db.php"; ?>
<?php session_start();
if(!isset($_SESSION['id'])){
	echo '<script>windows: location="index.php"</script>';
	}
?><!DOCTYPE html>
<html>
<head>
</head>
<body>
<h3 align="center" style="font-family: Trebuchet MS">Add New Expense Category</h3>
<form name="myForm" action="expense_category_add_action.php" method="post" style="font-family: Trebuchet MS">
<table width="500">

<tr>
<td>Expense</td>
<td><input list="expenses" name="expense" id="expense" class="form-control" placeholder="Enter Expense" required>
<datalist id="expenses">
<?php
$stmt_details = mysqli_query($conn, "SELECT DISTINCT expense FROM expense_category ORDER BY expense");
while($row_details=mysqli_fetch_array($stmt_details)){
$expense = $row_details['expense'];
?>
<option value="<?php echo $expense;?>"><?php echo $expense;?></option>
<?php 
} ?> 
</datalist></td>
</tr>

<tr>
<td>Sub Expense</td>
<td><input list="sub_expenses" name="sub_expense" id="sub_expense" class="form-control" placeholder="Enter Sub Expense" required>
<datalist id="sub_expenses">
<?php
$stmt_details = mysqli_query($conn, "SELECT DISTINCT sub_expense FROM expense_category ORDER BY sub_expense");
while($row_details=mysqli_fetch_array($stmt_details)){
$sub_expense = $row_details['sub_expense'];
?>
<option value="<?php echo $sub_expense;?>"><?php echo $sub_expense;?></option>
<?php 
} ?> 
</datalist></td>
</tr>

<tr><td><input type="submit" value="Submit"></td><td>&nbsp;</td></tr>

</table>
</form>

</body>
</html>