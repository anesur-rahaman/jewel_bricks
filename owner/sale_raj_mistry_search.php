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
	$sale_raj_mistry_search=$_POST['query'];
	$stmt = $conn->prepare("SELECT * FROM customers WHERE type='Raj Mistry' AND name LIKE CONCAT(?, '%') OR address LIKE CONCAT(?, '%') OR phone LIKE CONCAT(?, '%') ");
	$stmt->bind_param("sss", $sale_raj_mistry_search, $sale_raj_mistry_search, $sale_raj_mistry_search);
}
else{
	$stmt = $conn->prepare("SELECT * FROM customers WHERE type='Raj Mistry' ");	
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
	<th>Type</th>	
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
$type = $row['type'];
?>
<tr>
	<td><?= $row['id'] ?></td>
	<td><?= $row['name'] ?></td>
	<td><?= $row['address'] ?></td>
	<td><?= $row['phone'] ?></td>
	<td><?= $row['type'] ?></td>	
	<td><button><a rel='facebox' href="sale_paybill.php?id=<?=$row['id']?>" <i class="far fa fa-address-card-o"></i>Billing</a></button>
	<button><a rel='facebox' href="sale_payment.php?id=<?=$row['id']?>" <i class="far fa fa-address-card-o"></i>Payment</a></button>
	<button><a href="sale_view.php?id=<?=$row['id']?>" <i class="far fa fa-address-card-o"></i>View Bill</a></button>
	<button><a rel='facebox' href="customer_modify.php?id=<?=$row['id']?>" <i class="far fa fa-address-card-o"></i>Modify</a></button>
	<button><a rel='facebox' href="customer_delete.php?id=<?=$row['id']?>" <i class="far fa fa-address-card-o"></i><font size="" color="red">Delete</font></a></button></td>
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