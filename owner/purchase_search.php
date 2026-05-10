<script type="text/javascript">
	jQuery(document).ready(function($) {
	  $('a[rel*=facebox]').facebox({
		loadingImage : 'src/loading.gif',
		closeImage   : 'src/closelabel.png'
	  })
	})
</script>
<!DOCTYPE html>
<html lang="en">
<head>
</head>
<body class="bg-secondary">
<div class="container-fluid">
<div id="message"></div>
<div class="row justfied-content-center">
<?php 
include 'db.php';
$output ='' ;
if(isset($_POST['query'])){
	$distributor_search=$_POST['query'];
	$stmt = $conn->prepare("SELECT * FROM vendors WHERE name LIKE CONCAT(?, '%') OR address LIKE CONCAT(?, '%') OR phone LIKE CONCAT(?, '%') ");
	$stmt->bind_param("sss", $distributor_search, $distributor_search, $distributor_search);
}
else{
	$stmt = $conn->prepare("SELECT * FROM vendors");	
}
	$stmt->execute();	
	$result = $stmt->get_result();
?>
	
<?php if($result->num_rows>0){ ?>	
<table class="table table-hover table-light table-striped" id="table-data">
<thead>
<tr>
	<th>#</th>
	<th>Name</th>
	<th>Address</th>
	<th>Phone</th>
	<th>Function</th>	
</tr>
</thead>
<tbody>
<?php 
while($row = $result->fetch_assoc()){
//$resultv = mysqli_query($conn, "SELECT SUM(amount_paid) as sumbill, SUM(payment) as sumpayment FROM sale WHERE distributor_id ='".$row['id']."' ");
//$rowv = mysqli_fetch_array($resultv);
//$dues= $rowv['sumbill'] - $rowv['sumpayment'];
$name = $row['name'];
$address = $row['address'];
$phone = $row['phone'];
?>
<tr>
	<td><?= $row['id']; ?></td>
	<td><?= $row['name']; ?></td>
	<td><?= $row['address']; ?></td>
	<td><?= $row['phone']; ?></td>

	<td><button><a href="partyorder_add.php?id=<?=$row['id']?>" <i class="far fa fa-address-card-o"></i>Order</a></button>
	<button><a rel='facebox' href="sale_payment.php?id=<?=$row['id']?>" <i class="far fa fa-address-card-o"></i>Payment</a></button>
	<button><a href="sale_view.php?id=<?=$row['id']?>" <i class="far fa fa-address-card-o"></i>View Bill</a></button>
	<button><a rel="facebox" href="sale_report_input.php?id=<?=$row['id']?>" <i class="far fa fa-address-card-o"></i>Sale Report</a></button></td>
</tr>
<?php } }
	else{
	echo "<h3>No Records Found!</h3>";
	}	
?>
</tbody>
</table>
</div>
</div>
</body>
</html>