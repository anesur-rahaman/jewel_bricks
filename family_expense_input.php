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
<body>
<h3 align="center" style="font-family: Trebuchet MS">Family Expense Report</h3>
<form name="myForm" action="family_expense_details.php?expense_by=<?php echo $expense_by?>" onsubmit="return validateForm()" method="post" style="font-family: Trebuchet MS">
<input type="hidden" name="expense_by" value="<?php echo $expense_by; ?>" >
<div>   
 <table class="table table-hover">
  <tbody>
  <tr><th><font size="" color="red">From Date</th><td><input type="date" name="fromdate" id="fromdate" class="form-control" required></td></tr>
  <tr><th><font size="" color="red">To Date</th><td><input type="date" name="todate" id="todate" class="form-control" required></td></tr>
  <tr><td><input type="submit" value="Submit"></td><td>&nbsp;</td></tr>	
	</tbody>	
  </table>
  </div>
</form>
</body>
</html>