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
	$sql = "SELECT * FROM vehicle where type='$type' ";
    if( isset($_GET['char']) ){
    $sql .= " and LEFT(name,1)='".$_GET['char']."' ";
    }
    $sql .=" ORDER BY name ASC";
    $result = mysqli_query($conn,$sql);
    /////////////
    $sno = 1;
    while($row = mysqli_fetch_array($result)){
	$resultv = mysqli_query($conn, "SELECT SUM(advance) as sum_advance, SUM(salary) as sum_salary, SUM(wages) as sum_wages FROM vehicle_details WHERE vehicle_id ='".$row['id']."' ");
	$rowv = mysqli_fetch_array($resultv);
	$running_advance += $rowv['sum_advance']-($rowv['sum_salary'] - $rowv['sum_wages']);
	}	
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Vehicle</title>
</head>
<body class="main">
<div class="a">
<div class="container-fluid">
<div id="message"></div>
<div class="row justfied-content-center">
<div class="col-md-12 bg-light mt-2 rounded pb-3">
<!--<h1 class=="text-primary p-2">Live Search</h1>-->
<div class="form-inline">
<label for="vehicle_search" class="font-weight-bold lead text-dark">Search by Name or Address or Phone&nbsp;&nbsp;&nbsp;&nbsp;
<input type="text" name="vehicle_search" id="search_text" class="form-control form-control-lg rounded-0 border-primary" placeholder="Search...">

&nbsp;&nbsp;&nbsp;&nbsp;<b>OR</b>&nbsp;&nbsp;&nbsp;&nbsp;

<td align ="right"><a rel="facebox" href="vehicle_party_add.php" class="btn btn-info">Add New Party</a></td>
</label>
</div>

<?php 
$stmt = $conn->prepare("SELECT * FROM vehicle ORDER BY name");
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
	<th>Type</th>
	<th>Balance</th>
	<th>Function</th>
</tr>
</thead>
<tbody>

    <!-- Alphabets -->
    <ul class="sort">
<?php
	echo '<button><a href="vehicle.php" '; 
    if( !isset($_GET['char']) ){
	echo ' class="active" ';
    }
    echo ' >All</a></button>&nbsp;';
    // Select Alphabets and total records
	$sql = "select DISTINCT LEFT(name , 1) as firstCharacter,( select count(*) FROM vehicle WHERE type='$type' AND LEFT(name , 1)= firstCharacter ) AS counter FROM vehicle WHERE type='$type'";
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
	$sql = "SELECT * FROM vehicle where type='$type' ";
    if( isset($_GET['char']) ){
    $sql .= " and LEFT(name,1)='".$_GET['char']."' ";
    }
    $sql .=" ORDER BY name ASC";
    $result = mysqli_query($conn,$sql);
    /////////////
    $sno = 1;
    while($row = mysqli_fetch_array($result)){
	$resultv = mysqli_query($conn, "SELECT SUM(advance) as sum_advance, SUM(salary) as sum_salary, SUM(wages) as sum_wages FROM vehicle_details WHERE vehicle_id ='".$row['id']."' ");
	$rowv = mysqli_fetch_array($resultv);
	$running_advance = $rowv['sum_advance']-($rowv['sum_salary'] - $rowv['sum_wages']);	
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
	<td><?= $running_advance ?></td>
	<td><a rel='facebox' href="vehicle_bill.php?id=<?=$row['id']?>" class="btn btn-primary btn-sm">Billing</a>	
	<a rel='facebox' href="vehicle_income_add.php?id=<?=$row['id']?>" class="btn btn-secondary btn-sm">Payment</a>
	<a rel='facebox' href="vehicle_expense_add.php?id=<?=$row['id']?>" class="btn btn-success btn-sm"></i>Expense</a>
	<a href="vehicle_details_view.php?id=<?=$row['id']?>" class="btn btn-info btn-sm">View Detials</a>
	<a rel="facebox" href="vehicle_modify.php?id=<?=$row['id']?>" class="btn btn-warning btn-sm">Modify</a>
	<a rel="facebox" href="vehicle_delete.php?id=<?=$row['id']?>" class="btn btn-danger btn-sm">Delete</a>
	</td>
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
		var vehicle_search = $(this).val();
		$.ajax({
		url: 'vehicle_search.php',
		method: 'post',
		data: {query:vehicle_search},
		success:function(response){
			$("#table-data").html(response);
			}
		});	
		
	});
});
</script>
</body>
</html>