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
	$date=$current_date." ".$current_time ;?>
<?php
$vehicle_id =$_REQUEST['id'];
$result = mysqli_query($conn, "SELECT * FROM vehicle WHERE id  = '$vehicle_id'");
$row = mysqli_fetch_array($result);
if (!$result) 
	{
	die("Error: Data not found..");
	}
	$id=$row['id'] ;
	$name= $row['name'] ;
?>

<?php
$id =$_REQUEST['id'];
$result = mysqli_query($conn, "SELECT SUM(bill) AS sum_bill, SUM(income) AS sum_income,SUM(expense) AS sum_expense FROM vehicle_details WHERE vehicle_id='$vehicle_id'");
while($row = mysqli_fetch_array($result))
{
	$balance = $row['sum_bill'] - $row['sum_income'] - $row['sum_expense'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Vehicle Expense</title>
</head>
<body class="main">
<div class="a">
<div class="container-fluid">
<div id="message"></div>
<div class="row justfied-content-center">
<div class="col-md-12 bg-light mt-2 rounded pb-3">

<div class="" align="center">
<label for="distributor_search" class="font-weight-bold lead text-dark">Expense History for <font size="" color="blue"><?php echo $name;?></font><small> (ID # <?php echo $vehicle_id;?>)</small> | Balance : <font size="" color="red"><?php echo number_format($balance);?></font>

<h5 align="center">
	<a rel='facebox' href="vehicle_bill.php?id=<?=$vehicle_id?>" class="btn btn-primary btn-sm">Billing</a>	
	<a rel='facebox' href="vehicle_income_add.php?id=<?=$vehicle_id?>" class="btn btn-secondary btn-sm">Payment</a>
	<a rel='facebox' href="vehicle_expense_add.php?id=<?=$vehicle_id?>" class="btn btn-success btn-sm"></i>Expense</a>
</h5>

</label>
</div>
 
<table class="table table-hover table-light table-striped" id="table-data">
    <thead>
    <tr>
	<th>Trx Id</th>
	<th>Trx Date</th>
	<th>Description/Party Name</th>
	<th>Running Time</th>
	<th>Bill</th>	
	<th>Payment/Income</th>
	<th>Expense</th>
    </tr>
    </thead>

<?php
$id =$_REQUEST['id'];
$perpage = 250;
if(isset($_GET["page"])){
$page = intval($_GET["page"]);
}
else {
$page = 1;
}
$calc = $perpage * $page;
$start = $calc - $perpage;
$result = mysqli_query($conn, "SELECT * FROM vehicle_details where vehicle_id='$id' ORDER BY id DESC Limit $start, $perpage");

$rows = mysqli_num_rows($result);
if($rows){
$i = 0;
while($row = mysqli_fetch_assoc($result)) {
	
  $temp_date = $row['date'];
  //echo $temp_date;
  
?>

<?php
  echo "<tr>";
  echo "<td>" . $row['id'] . "</td>";
  echo "<td>" .date('d-M-y', strtotime( $row['trx_date'] )) . "</td>";
  echo "<td>" . $row['description'] . "</td>";
  echo "<td>" . $row['running_time'] . "</td>"; 
  echo "<td>" . $row['bill'] . "</td>";  
  echo "<td>" . $row['income'] . "</td>";  
  echo "<td>" . $row['expense'] . "</td>";
  echo "</tr>";
?>

<?php
}
}
?>
</table>

<table width="400" cellspacing="2" cellpadding="2" align="center">

<tr>
<td align="center">
<?php
	if(isset($page))
	{
	$result = mysqli_query($conn,"select Count(*) As Total from bill where vehicle_id='$id'");
	$rows = mysqli_num_rows($result);
	if($rows)
	{
	$rs = mysqli_fetch_assoc($result);
	$total = $rs["Total"];
	}
	$totalPages = ceil($total / $perpage);
	if($page <=1 ){
	echo "<span><button><id='page_links' style='font-weight: bold;'>Prev</button>&nbsp;</span>";
	}
	else
	{
	$j = $page - 1;
	echo "<span>&nbsp;<button><a id='page_a_link' href='vehicle_details_view.php?page=$j&id=$id'>< Prev</a>&nbsp;</button></span>";
	}
	for($i=1; $i <= $totalPages; $i++)
	{
	if($i<>$page)
	{
	echo "<span>&nbsp;<button><a id='page_a_link' href='vehicle_details_view.php?page=$i&id=$id'>$i</a>&nbsp;</button></span>";
	}
	else
	{
	echo "<span>&nbsp;<button><id='page_links' style='font-weight: bold;'>$i</button>&nbsp;</span>";
	}
	}
	if($page == $totalPages )
	{
	echo "<span>&nbsp;<button><id='page_links' style='font-weight: bold;'>Next</button></span>";
	}
	else
	{
	$j = $page + 1;
	echo "<span>&nbsp;<button><a id='page_a_link' href='vehicle_details_view.php?page=$j&id=$id'>Next</a></button></span>";
	}
	}
?></td>
<td></td>
</tr>
</table>
</body>
</html>