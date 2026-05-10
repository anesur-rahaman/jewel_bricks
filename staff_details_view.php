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
$staff_id =$_REQUEST['id'];
$result = mysqli_query($conn, "SELECT * FROM staff WHERE id  = '$staff_id'");
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
$result = mysqli_query($conn, "SELECT SUM(advance) as sum_advance, SUM(salary) as sum_salary, SUM(wages) as sum_wages FROM staff_details WHERE staff_id='$staff_id'");
while($row = mysqli_fetch_array($result))
{
	$running_advance = $row['sum_advance']-($row['sum_salary'] - $row['sum_wages']);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Staff Details</title>
</head>
<body class="main">
<div class="a">
<div class="container-fluid">
<div id="message"></div>
<div class="row justfied-content-center">
<div class="col-md-12 bg-light mt-2 rounded pb-3">

<div class="" align="center">
<label for="distributor_search" class="font-weight-bold lead text-dark">Transactions History for <font size="" color="blue"><?php echo $name;?></font><small> (ID # <?php echo $staff_id;?>)</small>, <font size="" color="red"></font><font size="" color="dark green"><?php echo $address;?>,</font>, <font size="" color="blue"><?php echo $phone;?></font> | Total Advance : <font size="" color="red"><?php echo number_format($running_advance);?></font>
</div>
<div align="center">
<a rel='facebox' href="staff_advance.php?id=<?=$staff_id ;?>" class="btn btn-info btn-sm">Advance</a></td>
<a rel='facebox' href="staff_wages.php?id=<?=$staff_id ;?>" class="btn btn-success btn-sm">Wages</a></td>
</div>
</label>
</div>
 
<table class="table table-hover table-light table-striped" id="table-data">
    <thead>
    <tr>
	<th>Trx Id</th>
	<th>Trx Date</th>
	<th>Description</th>
	<th>Advance Amount</th>
	<th>Duration</th>	
	<th>Month Salary</th>
	<th>Wages Amount</th>
	<th>Running Advance</th>
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
$result = mysqli_query($conn, "SELECT * FROM staff_details where staff_id='$id' ORDER BY id DESC Limit $start, $perpage");

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
  if ($row['advance'] !="" ) {echo "<td>" . number_format(round($row['advance'], 2)) ."</td>";} else {echo "<td>";} ?>

<td><?php echo $row['month']; ?>,  <?php echo $row['year']; ?></td>   
<?php 
  if ($row['salary'] !="" ) {echo "<td>" . number_format(round($row['salary'], 2)) ."</td>";} else {echo "<td>";} 
  if ($row['wages'] !="" ) {echo "<td>" . number_format(round($row['wages'], 2)) ."</td>";} else {echo "<td>";}
  
  $Color = "red";
  $result_running_advance = mysqli_query($conn, "SELECT SUM(advance) as sum_advance, SUM(salary) as sum_salary, SUM(wages) as sum_wages FROM staff_details where staff_id='$id' AND date <= '$temp_date' ORDER BY id DESC Limit $start, $perpage");
  while($rows_advance=mysqli_fetch_array($result_running_advance)){
	$running_advance = $rows_advance['sum_advance']-($rows_advance['sum_salary'] - $rows_advance['sum_wages']);
  }  
  //echo '<div style="Color:'.$Color.'">'. number_format($running_advance) .'</div>';
  echo '<td style="Color:'.$Color.'">' . number_format($running_advance) . '</td>';	
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
	$result = mysqli_query($conn,"select Count(*) As Total from bill where staff_id='$id'");
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
	echo "<span>&nbsp;<button><a id='page_a_link' href='staff_view.php?page=$j&id=$id'>< Prev</a>&nbsp;</button></span>";
	}
	for($i=1; $i <= $totalPages; $i++)
	{
	if($i<>$page)
	{
	echo "<span>&nbsp;<button><a id='page_a_link' href='staff_view.php?page=$i&id=$id'>$i</a>&nbsp;</button></span>";
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
	echo "<span>&nbsp;<button><a id='page_a_link' href='staff_view.php?page=$j&id=$id'>Next</a></button></span>";
	}
	}
?></td>
<td></td>
</tr>
</table>
</body>
</html>