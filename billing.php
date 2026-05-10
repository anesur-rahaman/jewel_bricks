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
	$current_date = date('Y-m-d',$time_now);
	$current_time = date('h:i:s',$time_now);
	$date=$current_date." ".$current_time ;
?>
<!DOCTYPE html>
<html>
<title>Software Charges</title>
<body class="main">
<div class="a">
<div class="container-fluid">
<div id="message"></div>
<div class="row justfied-content-center">
<div class="col-md-12 bg-light mt-2 rounded pb-3">
<!--<h1 class=="text-primary p-2">Live Search</h1>-->
<div class="" align="center">
<label for="distributor_search" class="font-weight-bold lead text-dark">Software Charges as of <?php echo date('d-M-Y H:i:s', strtotime($date));?></label>&nbsp;&nbsp;&nbsp;&nbsp;
</div>

<table class="table table-hover table-light table-striped" id="table-data">
<tr align="left">
    <th>Id</th>
	<th>Month</th>
	<th>Bill</th>
	<th>Payment</th>
	<th>Running Due</th>
	<th>Status</th>
	<th>View Details</th>
</tr>
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
$result = mysqli_query($conn, "SELECT * FROM billing ORDER BY id DESC Limit $start, $perpage");

$rows = mysqli_num_rows($result);
if($rows){
$i = 0;
while($row = mysqli_fetch_assoc($result)) {
$temp_date = $row['date'];
?>

<tr>
	<td><?php echo $row['id'] ;?></td>
	<td><?php echo $row['month'] ;?></td>
	<td><?php echo $row['bill'] ;?></td>
	<td><?php echo $row['payment'] ;?></td>

  <?php 
  $Color = "red";
  $result_running_due = mysqli_query($conn, "SELECT SUM(bill) AS sum_bill, SUM(payment) AS sum_payment FROM billing WHERE date <= '$temp_date' ");
  //echo $temp_date;
  while($rows_due=mysqli_fetch_array($result_running_due)){
  $running_due = $rows_due['sum_bill'] - $rows_due['sum_payment'];
  }
  ?>
	<td><?php echo $running_due ;?></td>
	<td><?php echo $row['status'] ;?></td>	
	<td class="w3-button w3-green"><a href='billing/<?php echo $row['doc']; ?>' target="_blank" class="btn btn-success btn-xs">View Details</a></td>
</tr>
<?php
}
}
?>
</table>
</div>

<table class="w3-table w3-striped w3-bordered w3-border w3-hoverable w3-white">
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
$result = mysqli_query($conn, "SELECT * FROM billing ORDER BY id DESC Limit $start, $perpage");

//$result = mysqli_query($conn, "select * from bill Limit $start, $perpage");

$rows = mysqli_num_rows($result);
if($rows){
$i = 0;
while($row = mysqli_fetch_assoc($result)) {

?>

      <tr>
<td align="center">

<?php

	if(isset($page))
	{
	$result = mysqli_query($conn,"select Count(*) As Total from billing");
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
	echo "<span>&nbsp;<button><a id='page_a_link' href='billing.php?page=$j&id=$id'>< Prev</a>&nbsp;</button></span>";
	}
	for($i=1; $i <= $totalPages; $i++)
	{
	if($i<>$page)
	{
	echo "<span>&nbsp;<button><a id='page_a_link' href='billing.php?page=$i'>$i</a>&nbsp;</button></span>";
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
	echo "<span>&nbsp;<button><a id='page_a_link' href='billing.php?page=$j'>Next</a></button></span>";
	}
	}

?></td>
      </tr>
<?php
}
}
?>	
    </table>
</div>  

</body>
</html>