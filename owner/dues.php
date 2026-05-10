<?php include('header.php'); ?>
<?php require_once "db.php"; ?>
<?php session_start();
if(!isset($_SESSION['id'])){
	echo '<script>windows: location="index.php"</script>';
	}
?>
<!-- ========================== Start Total Due ========================== -->
<?php
$id =$_REQUEST['id'];

date_default_timezone_set('Asia/Kolkata');
$time_now=mktime(date('h'),date('i'),date('s'));
$current_date = date('d-M-y',$time_now);
$current_time = date('h:i:s',$time_now);
$date=$current_date." ".$current_time ;

$startdate = date('Y-m-d H:i:s', strtotime( $current_date ));
$addtime = "23:59:59";
$secs = strtotime($startdate)-strtotime("00:00:00");
$enddate = date("Y-m-d H:i:s",strtotime($addtime)+$secs);

$result = mysqli_query($conn, "SELECT SUM(bill) as till_yesterday_sumbill_o, SUM(payment) as till_yesterday_sumpayment_o FROM sale WHERE customer_id='1'  OR customer_id='115' OR customer_id='414' OR customer_id='179' OR customer_id='1250' AND date < '$startdate'");
while($row = mysqli_fetch_array($result))
{
	$till_yesterday_owner= $row['till_yesterday_sumpayment_o'] - $row['till_yesterday_sumbill_o'];
}
?>

<?php
$id =$_REQUEST['id'];
$result = mysqli_query($conn, "SELECT SUM(bill) as today_sumbill_o, SUM(payment) as today_sumpayment_o FROM sale WHERE customer_id='1' AND date >'$startdate' and date <'$enddate'");
while($row = mysqli_fetch_array($result))
{
	$today_owner= $row['today_sumpayment_o'] - $row['today_sumbill_o'];
}
?>

 <?php
$id =$_REQUEST['id'];
$result = mysqli_query($conn, "SELECT SUM(bill) as till_yesterday_sumbill, SUM(payment) as till_yesterday_sumpayment FROM sale WHERE date < '$startdate'");

while($row = mysqli_fetch_array($result))
{
	$till_yesterday_totaldues= $row['till_yesterday_sumbill'] - $row['till_yesterday_sumpayment'] + $till_yesterday_owner;;
}
?>

 <?php
$id =$_REQUEST['id'];
$result = mysqli_query($conn, "SELECT SUM(bill) as today_sumbill, SUM(payment) as today_sumpayment FROM sale WHERE date >'$startdate' and date <'$enddate'");

while($row = mysqli_fetch_array($result))
{
	$today_totaldues= $row['today_sumbill'] - $row['today_sumpayment'] + $today_owner;;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Dues</title>
</head>
<body class="main">
<div class="a">
<div class="container-fluid">
<div id="message"></div>
<div class="row justfied-content-center">
	<div class="col-md-12 bg-light mt-2 rounded pb-3">
	<!--<h1 class=="text-primary p-2">Live Search</h1>-->

	<div class="form-inline"  align="center">
	<label for="distributor_search" class="font-weight-bold lead text-dark">Total Dues<?php echo $name;?> as of <?php echo $date;?> is <font size="" color="red"> ₹  <?php echo number_format((float)$till_yesterday_totaldues + $today_totaldues);?></font></label>
	</div>


	<div class="form-inline">
	<label for="distributor_search" class="font-weight-bold lead text-dark">Search by Name or Address or Phone</label>&nbsp;&nbsp;&nbsp;&nbsp;
	<input type="text" name="distributor_search" id="search_text" class="form-control form-control-lg rounded-0 border-primary" placeholder="Search...">
	</div>

	<?php 
	$stmt = $conn->prepare("SELECT * FROM customers ORDER BY name");
	$stmt->execute();
	$result = $stmt->get_result();
	?>
<table class="table table-hover table-light table-striped" id="table-data">
<thead>
<tr>
	<th>#</th>
	<th>Name</th>
	<th>Address</th>
	<th>Phone</th>
	<th>Dues</th>	
</tr>
</thead>
<tbody>

    <!-- Alphabets -->
    <ul class="sort">
<?php
	echo '<button><a href="bill.php" '; 
    if( !isset($_GET['char']) ){
	echo ' class="active" ';
    }
    echo ' >All</a></button>&nbsp;';
    // Select Alphabets and total records
	$sql = "select DISTINCT LEFT(name , 1) as firstCharacter,( select count(*) from customers where LEFT(name , 1)= firstCharacter ) AS counter from customers";
	$result_alpha = mysqli_query($conn, $sql);
    while($row_alpha = mysqli_fetch_array($result_alpha) ){
	$firstCharacter = $row_alpha['firstCharacter'];
    $counter = $row_alpha['counter'];
	echo '<button><a href="?char='.$firstCharacter.'" '; 
    if( isset($_GET['char']) && $firstCharacter == $_GET['char'] ){
    echo ' class="active" ';
    }
    echo ' >'.$firstCharacter.' ('.$counter.')</a></button>&nbsp;';
    }
?>
    </ul>

<?php        
    // selecting rows
	$sql = "SELECT * FROM customers where 1";
    if( isset($_GET['char']) ){
    $sql .= " and LEFT(name,1)='".$_GET['char']."' ";
    }
    $sql .=" ORDER BY name ASC";
    $result = mysqli_query($conn,$sql);
    /////////////
    $sno = 1;
    while($row = mysqli_fetch_array($result)){
	$resultv = mysqli_query($conn, "SELECT SUM(bill) as sumbill, SUM(payment) as sumpayment FROM sale WHERE customer_id ='".$row['id']."' ");
	$rowv = mysqli_fetch_array($resultv);
	$dues= $rowv['sumbill'] - $rowv['sumpayment'];
    $name = $row['name'];
    $address = $row['address'];
    $phone = $row['phone'];
?>
	<tr>
	<td><?= $row['id'] ?></td>
	<td><?= $row['name'] ?></td>
	<td><?= $row['address'] ?></td>
	<td><?= $row['phone'] ?></td>
	<td><?= number_format((float)$dues) ?></td>	
	</tr>
<?php
}
?>
</tbody>
</table>	
</div>
</div>
</div>
</div>
<script type="text/javascript">
$(document).ready(function(){
	$("#search_text").keyup(function(){
		var distributor_search = $(this).val();
		$.ajax({
		url: 'dues_search.php',
		method: 'post',
		data: {query:distributor_search},
		success:function(response){
			$("#table-data").html(response);
			}
		});	
		
	});
});
</script>
</body>
</html>