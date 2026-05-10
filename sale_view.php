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
$customer_id =$_REQUEST['id'];
$result = mysqli_query($conn, "SELECT * FROM customers WHERE id  = '$customer_id'");
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
$result = mysqli_query($conn, "SELECT SUM(bill) as sum_bill, SUM(payment) as sum_payment, SUM(discount) AS sum_discount FROM sale WHERE customer_id='$customer_id'");
while($row = mysqli_fetch_array($result))
{
	$due = $row['sum_bill'] - $row['sum_payment'] - $row['sum_discount'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Sale - Challan</title>
</head>
<body class="main">
<div class="a">
<div class="container-fluid">
<div id="message"></div>
<div class="row justfied-content-center">
<div class="col-md-12 bg-light mt-2 rounded pb-3">

<div class="form-inline" align="center">
<label for="distributor_search" class="font-weight-bold lead text-dark">Transactions History for <font size="" color="blue"><?php echo $name;?></font><small> (ID # <?php echo $customer_id;?>)</small>, <font size="" color="red"></font><font size="" color="dark green"><?php echo $address;?>,</font>, <font size="" color="blue"><?php echo $phone;?></font> | Total Due : <font size="" color="red"><?php echo number_format($due);?></font>

<h5 align="center">
<button><a rel='facebox' href="sale_paybill.php?id=<?=$customer_id ;?>" <i class="far fa fa-address-card-o"></i>Billing</a></button></td>
<button><a rel='facebox' href="sale_payment.php?id=<?=$customer_id ;?>" <i class="far fa fa-address-card-o"></i>Payment</a></button></td>
</h5>

</label>
</div>
 
<table class="table table-hover table-light table-striped" id="table-data">
    <thead>
    <tr>
	<th>Trx Id</th>
	<th>Trx Date</th>
	<th>Item</th>
	<th>Quantity</th>
	<th>Bill Amount</th>
	<th>Payment Amount</th>
	<th>Discount</th>
	<th>Running Due</th>
    <th>Vehicle</th>	
    <th>Function</th>		
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
$result = mysqli_query($conn, "SELECT * FROM sale where customer_id='$id' ORDER BY id DESC Limit $start, $perpage");

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
  echo "<td>" . $row['item'] . "</td>";
  echo "<td>" . $row['quantity'] . "</td>";
  if ($row['bill'] !="" ) {echo "<td>" . number_format(round($row['bill'], 2)) ."</td>";} else {echo "<td>";}  
  if ($row['payment'] !="0" ) {echo "<td>" . number_format(round($row['payment'], 2)) ."</td>";} else {echo "<td>";}
  if ($row['discount'] !="0" ) {echo "<td>" . number_format(round($row['discount'], 2)) ."</td>";} else {echo "<td>";}?>

  <?php 
  $Color = "red";
  $result_running_due = mysqli_query($conn, "SELECT SUM(bill) AS sum_bill, SUM(payment) AS sum_payment, SUM(discount) AS sum_discount FROM sale where customer_id='$id' AND date <= '$temp_date' ORDER BY id DESC Limit $start, $perpage");
  while($rows_due=mysqli_fetch_array($result_running_due)){
  $running_due = $rows_due['sum_bill'] - $rows_due['sum_payment'] - $rows_due['sum_discount'];
  }  
  //echo '<div style="Color:'.$Color.'">'. number_format($running_due) .'</div>';
  echo '<td style="Color:'.$Color.'">' . number_format($running_due) . '</td>';	
  echo "<td>" . $row['vehicle'] . "</td>";
 
  echo "<td><button><a href='sale_bill.php?id=".$row['id']."&customer_id=".$row['customer_id']."'>Challan</a></button></td>" ;
  //echo "<td><button><a href='invoice.php?id=".$row['id']."&customer_id=".$row['customer_id']."'>Invoice</a></button></td>";?>

  <?php
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
	$result = mysqli_query($conn,"select Count(*) As Total from bill where customer_id='$id'");
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
	echo "<span>&nbsp;<button><a id='page_a_link' href='sale_view.php?page=$j&id=$id'>< Prev</a>&nbsp;</button></span>";
	}
	for($i=1; $i <= $totalPages; $i++)
	{
	if($i<>$page)
	{
	echo "<span>&nbsp;<button><a id='page_a_link' href='sale_view.php?page=$i&id=$id'>$i</a>&nbsp;</button></span>";
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
	echo "<span>&nbsp;<button><a id='page_a_link' href='sale_view.php?page=$j&id=$id'>Next</a></button></span>";
	}
	}
?></td>
<td></td>
</tr>
</table>
</body>
</html>