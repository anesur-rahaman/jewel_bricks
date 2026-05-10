<?php include('header.php'); ?>
<?php require_once "db.php"; ?>
<?php session_start();
if(!isset($_SESSION['id'])){
	echo '<script>windows: location="index.php"</script>';
	}
?>
<?php
	$type =$_REQUEST['type'];    
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
	$resultv = mysqli_query($conn, "SELECT SUM(bill) as sum_bill, SUM(payment) as sum_payment, SUM(discount) as sum_discount FROM sale WHERE customer_id ='".$row['id']."' ");
	$rowv = mysqli_fetch_array($resultv);
	$running_balance += $rowv['sum_bill']- $rowv['sum_payment'] - $rowv['sum_discount'];
	}	
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Sale</title>
</head>
<body class="main">
<div class="a">
<div class="container-fluid">
<div id="message"></div>
<div class="row justfied-content-center">
<div class="col-md-12 bg-light mt-2 rounded pb-3">
<!--<h1 class=="text-primary p-2">Live Search</h1>-->
<div class="form-inline">
<label for="distributor_search" class="font-weight-bold lead text-dark"><font size="" color="red"><?=$type?></font>&nbsp;&nbsp;&nbsp;&nbsp;
<input type="text" name="distributor_search" id="search_text" class="form-control form-control-lg rounded-0 border-primary" placeholder="Search by Name or Address or Phone...">

&nbsp;&nbsp;&nbsp;&nbsp;<b>OR</b>&nbsp;&nbsp;&nbsp;&nbsp;
<td align ="right"><a rel="facebox" href="customer_add.php" class="btn btn-info btn-sm">Add New Customer</a></td>
&nbsp;&nbsp;&nbsp;&nbsp;<b>OR</b>&nbsp;&nbsp;&nbsp;&nbsp;
<td align ="right"><a rel="facebox" href="sale_item_add.php" class="btn btn-info btn-sm">Add New Sale Item</a></td>
&nbsp;&nbsp;&nbsp;&nbsp;<b>OR</b>&nbsp;&nbsp;&nbsp;&nbsp;
<td align ="right"><a href="sale_dues_print_by_type.php?type=<?=$type?>" class="btn btn-success btn-sm">Print Dues</a></td>
&nbsp;&nbsp;&nbsp;&nbsp;| Balance : <font size="" color="red"><?php echo number_format($running_balance);?></font>
</label>
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
	<th>Function</th>	
</tr>
</thead>
<tbody>

    <!-- Alphabets -->
    <ul class="sort">
<?php
	echo '<button><a href="sale.php" '; 
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
	$sql = "SELECT * FROM customers where type='$type' ";
    if( isset($_GET['char']) ){
    $sql .= " and LEFT(name,1)='".$_GET['char']."' ";
    }
    $sql .=" ORDER BY name ASC";
    $result = mysqli_query($conn,$sql);
    /////////////
    $sno = 1;
    while($row = mysqli_fetch_array($result)){
	$resultv = mysqli_query($conn, "SELECT SUM(bill) as sum_bill, SUM(payment) as sum_payment, SUM(discount) as sum_discount FROM sale WHERE customer_id ='".$row['id']."' ");
	$rowv = mysqli_fetch_array($resultv);
	$dues= $rowv['sum_bill'] - $rowv['sum_payment'] - $rowv['sum_discount'];
    $name = $row['name'];
    $address = $row['address'];
    $phone = $row['phone'];
    $type = $row['type'];
?>
	<tr>
	<td><?= $row['id'] ?></td>
	<td><?= $row['name'] ?></td>
	<td><?= $row['address'] ?></td>
	<td><?= $row['phone'] ?></td>
	<td><?= $row['type'] ?></td>
	<td><a rel='facebox' href="sale_paybill.php?id=<?=$row['id']?>" class="btn btn-primary btn-sm">Billing</a>
	<a rel='facebox' href="sale_payment.php?id=<?=$row['id']?>" class="btn btn-secondary btn-sm">Payment</a>
	<a href="sale_view.php?id=<?=$row['id']?>" class="btn btn-success btn-sm">View Bill</a>
	<a rel='facebox' href="customer_modify.php?id=<?=$row['id']?>" class="btn btn-warning btn-sm">Modify</a>
	<a rel='facebox' href="customer_delete.php?id=<?=$row['id']?>" class="btn btn-danger btn-sm">Delete</a>
	<!--<button><a rel="facebox" href="sale_report_input.php?id=<?//=$row['id']?>" <i class="far fa fa-address-card-o"></i>Sale Report</a></button>--></td>
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
		url: 'sale_search.php',
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