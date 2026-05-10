<?php include('header.php'); ?>
<?php require_once "db.php"; ?>
<?php session_start();
if(!isset($_SESSION['id'])){
	echo '<script>windows: location="index.php"</script>';
	}
?>

<?php
	$type =$_REQUEST['type'];

	date_default_timezone_set('Asia/Kolkata');
	$time_now=mktime(date('h'),date('i'),date('s'));
	$current_date = date('Y-m-d',$time_now);
	$current_time = date('h:i:s',$time_now);
	$date=$current_date." ".$current_time ;
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Dues - Sale</title>
</head>
<body class="main">
<div class="a">
<div class="container-fluid">
<div id="message"></div>
<div class="row justfied-content-center">
<div class="col-md-12 bg-light mt-2 rounded pb-3">
<!--<h1 class=="text-primary p-2">Live Search</h1>-->
<div class="form-inline">
<img src="logo.jpg" alt="logo" style="width:150px" style="height:100px">
&emsp;&emsp;
<label for="sale_dues_search" class="font-weight-bold lead text-dark"><?php echo $type;?> - Dues as of <?php echo date('d-M-Y H:i:a', strtotime($date));?></label>&nbsp;&nbsp;&nbsp;&nbsp;
</div>

<?php 
$stmt = $conn->prepare("SELECT * FROM customers ORDER BY name");
$stmt->execute();
$result = $stmt->get_result();
?>
<table class="table table-hover table-light table-striped" id="table-data">
<thead>
<tr>
	<th>Customer ID</th>
	<th>Name</th>
	<th>Address</th>
	<th>Phone</th>
	<th>Type</th>	
	<th>Dues</th>	
</tr>
</thead>
<tbody>

<?php        
    // selecting rows
	$sql = "SELECT * FROM customers where type='$type' ";
    if( isset($_GET['char']) ){
    $sql .= " and LEFT(name,1)='".$_GET['char']."' ";
    }
    $sql .=" ORDER BY name ASC";
    $result = mysqli_query($conn,$sql);
    /////////////
    $sno = 1;
    while($row = mysqli_fetch_array($result)){
	$resultv = mysqli_query($conn, "SELECT SUM(bill) as sum_bill, SUM(payment) as sum_payment FROM sale WHERE customer_id ='".$row['id']."' ");
	$rowv = mysqli_fetch_array($resultv);
	$dues= $rowv['sum_bill'] - $rowv['sum_payment'];
    $name = $row['name'];
    $address = $row['address'];
    $phone = $row['phone'];
	$type = $row['type'];	
?>
<tr><?php if($dues > 0 ){?>
	<td><?= $row['id'] ?></td>
	<td><?= $row['name'] ?></td>
	<td><?= $row['address'] ?></td>
	<td><?= $row['phone'] ?></td>
	<td><?= $row['type'] ?></td>	
	<td>₹ <?= $dues ?></td>
	<?php } ?>
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
		var sale_dues_search = $(this).val();
		$.ajax({
		url: 'sale_dues_search.php',
		method: 'post',
		data: {query:sale_dues_search},
		success:function(response){
			$("#table-data").html(response);
			}
		});	
		
	});
});
</script>
</body>
</html>