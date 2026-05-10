<?php require_once "db.php"; ?>
<?php session_start();
if(!isset($_SESSION['id'])){
	echo '<script>windows: location="index.php"</script>';
	}
?>
<?php	
$expense_by =$_REQUEST['expense_by'];
?>
<!DOCTYPE html>
<html>
<head>
</head>
<body>
<h3 align="center" style="font-family: Trebuchet MS">Add New Family Expense Category</h3>
<form name="myForm" action="family_expense_category_add_action.php" method="post" style="font-family: Trebuchet MS">
<table width="500">
<input type="hidden" name="expense_by" value="<?php echo $expense_by; ?>" >
<tr>
<td>Expense</td>
<td><input list="expenses" name="expense" id="expense" class="form-control" placeholder="Enter Expense" required>
<datalist id="expenses">
<?php
$stmt_details = mysqli_query($conn, "SELECT DISTINCT expense FROM family_expense_category ORDER BY expense");
while($row_details=mysqli_fetch_array($stmt_details)){
$expense = $row_details['expense'];
?>
<option value="<?php echo $expense;?>"><?php echo $expense;?></option>
<?php 
} ?> 
</datalist></td>
</tr>

<tr><td><input type="submit" value="Submit"></td><td>&nbsp;</td></tr>

</table>
</form>

</body>
</html>