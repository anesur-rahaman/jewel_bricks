<?php require_once "db.php"; ?>
<?php session_start();
if(!isset($_SESSION['id'])){
	echo '<script>windows: location="index.php"</script>';
	}
?>

<?php
$id =$_REQUEST['id'];
$result = mysqli_query($conn, "SELECT * FROM expenses WHERE id  = '$id'");
$row = mysqli_fetch_array($result);
if (!$result) 
	{
	die("Error: Data not found..");
	}
	$id=$row['id'] ;
	$expense= $row['expense'] ;					
	$sub_expense=$row['sub_expense'] ;
	$amount=$row['amount'] ;
	$trx_date=$row['trx_date'] ;	
?>

<!DOCTYPE html>
<html>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
<h3 align="center" style="font-family: Trebuchet MS">Add New Expense</h3>
<form name="myForm" action="expense_modify_action.php" method="post" style="font-family: Trebuchet MS">
<table width="500">

<input type="hidden" name="id" value="<?php echo $id; ?>" >

<tr>
<td>Expense</td>
<td><select name="expense" id="expense" value="<?php echo $expense; ?>" class="form-control" required>
	<option value="<?php echo $expense; ?>"><?php echo $expense; ?></option>
</select></td>
</tr>

<tr>
<td>Sub Expense</td>
<td><select name="sub_expense" id="sub_expense" value="<?php echo $sub_expense; ?>" class="form-control">
	<option value="<?php echo $sub_expense; ?>"><?php echo $sub_expense; ?></option>
</select></td>
</tr>

<tr>
    <td>Amount</td>
    <td><input type="number" name="amount" id="amount" value="<?php echo $amount; ?>" class="form-control" placeholder="Enter Amount" required></td>
</tr>

<td>Trx Date</td>
	<td><input type="date" name="trx_date" id="trx_date" value="<?php echo $trx_date; ?>" class="form-control" placeholder="Enter Trx Date" required></td>
</tr>
  
<tr><td><font size="" color="red"><input type="submit" value="Submit"></td></tr>

</table>
</form>

</body>
</html>
<script>
$(document).ready(function(){
	$('#expense').change(function(){
		var expense = $(this).val();
		$.ajax({
		method: "post",
		url: "expense_fetch.php",
		data: {expense:expense},
		dataType:"text",
		success:function(data){
			$('#sub_expense').html(data);
		}
	});
	});
});
</script>