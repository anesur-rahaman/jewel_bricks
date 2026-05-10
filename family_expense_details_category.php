<?php include('header.php'); ?>
<?php require_once "db.php"; ?>
<?php session_start();
if(!isset($_SESSION['id'])){
	echo '<script>windows: location="index.php"</script>';
	}
?>
<?php
	date_default_timezone_set('Asia/Kolkata');
	$time_now=mktime(date('h'),date('i'),date('s'));
	$current_date = date('d-M-y',$time_now);
	$current_time = date('h:i:s',$time_now);
	$date=$current_date." ".$current_time ;?></p>

<?php
$session=$_SESSION['id'];
$result = mysqli_query($conn, "SELECT * FROM user where id= '$session'");
while($row = mysqli_fetch_array($result))
  {
  $sessionname=$row['name'];
  }
?>

<?php
$expense_by= $_POST['expense_by'] ;	
$fromdate = $_POST['fromdate'];
$todate = $_POST['todate'];
$expense = $_POST['expense'];
?>
<?php
$expense_by =$_REQUEST['expense_by'];
$result = mysqli_query($conn, "SELECT SUM(amount) AS sum_expense FROM family_expense WHERE expense_by='$expense_by' AND expense='$expense' AND trx_date >='$fromdate' and trx_date <='$todate'");
while($row = mysqli_fetch_array($result))
{
	$sum_expense = $row['sum_expense'];
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Expense Report</title>
</head>
<body>
<body class="main">
<div class="a">
<div class="container-fluid">
<div id="message"></div>
<div class="row justfied-content-center">
	<div class="col-md-12 bg-light mt-2 rounded pb-3">
	<!--<h1 class=="text-primary p-2">Live Search</h1>-->
	<div class="form-inline" align="center">
	<label for="distributor_search" class="font-weight-bold lead text-dark"><font size="" color="red"><?php echo $expense_by?></font> - Expense Report from <?php echo date('d-M-y', strtotime($fromdate));?> to <?php echo date('d-M-y', strtotime($todate));?> | Total Expense <font size="" color="blue">₹ <?php echo $sum_expense?></font></label>
<div align="center">
<td align ="right"><a rel="facebox" href="family_expense_add.php" class="btn btn-info">Add New Family Expense</a></td>
<a rel="facebox" href="family_expense_category_add.php?expense_by=<?php echo $expense_by?>" class="btn btn-success">Add New Family Expense Category</a>
<a rel="facebox" href="family_expense_input.php?expense_by=<?php echo $expense_by?>" class="btn btn-warning">Sum of Expense Report</a>
<a rel="facebox" href="family_expense_input_by_category.php?expense_by=<?php echo $expense_by?>" class="btn btn-danger">Expense Report By Category</a>
</div>
<table class="table table-hover table-light table-striped" id="table-data">
    <thead>
    <tr>
	<th>Id</th>
	<th>Trx Date</th>
	<th>Expense</th>
	<th>Amount</th>
	</tr>
    </thead>


<?php
$perpage = 500;
if(isset($_GET["page"])){
$page = intval($_GET["page"]);
}
else {
$page = 1;
}

$calc = $perpage * $page;
$start = $calc - $perpage;
$result = mysqli_query($conn, "SELECT * FROM family_expense WHERE expense = '$expense' and expense_by = '$expense_by' and trx_date >='$fromdate' and trx_date <= '$todate'");
$rows = mysqli_num_rows($result);
if($rows){
$i = 0;
while($row = mysqli_fetch_assoc($result)) {

?>

<tbody>

<?php

  echo "<tr>";

  echo "<td>" . $row['id'] . "</td>";

  echo "<td>" .date('d-M-y', strtotime( $row['trx_date'] )) . "</td>";

  echo "<td>" . $row['expense'] . "</td>";
  echo "<td>₹ " . number_format(round($row['amount'], 2)) ."</td>";
  //echo "<td><button><a rel='facebox' href='invoice.php?id=".$bill['id']."&customer_id=".$bill['customers_id']."'>Print</a></button> ";

  //echo "<button><a rel='facebox' href='delbill.php?id=".$row['id']."'>Delete</a></button></td>";

  echo "</tr>";
?>


<?php

}

}

?>

</tbody>
</table>

</div>
</body>
</html>
 <script src="js/jquery.js"></script>
  <script type="text/javascript">
$(function() {
$(".delbutton").click(function(){
var element = $(this);
var del_id = element.attr("id");
var info = 'id=' + del_id;
 if(confirm("Sure you want to delete this update? There is NO undo!"))
		  {
 $.ajax({
   type: "GET",
   url: "delete.php",
   data: info,
   success: function(){
   }
 });
         $(this).parents(".record").animate({ backgroundColor: "#fbc7c7" }, "fast")
		.animate({ opacity: "hide" }, "slow");
 }
return false;
});
});
</script>