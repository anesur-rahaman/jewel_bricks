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
	$purchase_dues_search=$_POST['query'];
	$stmt = $conn->prepare("SELECT * FROM vendors WHERE name LIKE CONCAT(?, '%') OR address LIKE CONCAT(?, '%') OR phone LIKE CONCAT(?, '%') ORDER BY name");
	$stmt->bind_param("sss", $purchase_dues_search, $purchase_dues_search, $purchase_dues_search);
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
	<th>Dues</th>
	<th>Function</th>	
</tr>
</thead>
<tbody>
<?php 
while($row = $result->fetch_assoc()){
$resultv = mysqli_query($conn, "SELECT SUM(bill) as sum_bill, SUM(payment) as sum_payment FROM purchase WHERE vendor_id ='".$row['id']."' ");
$rowv = mysqli_fetch_array($resultv);
$dues= $rowv['sum_bill'] - $rowv['sum_payment'];
$name = $row['name'];
$address = $row['address'];
$phone = $row['phone'];
?>
	<tr>
	<td><?= $row['id'] ?></td>
	<td><?= $row['name'] ?></td>
	<td><?= $row['address'] ?></td>
	<td><?= $row['phone'] ?></td>
	<td><?= $dues ?></td>	
	<td><button><a rel='facebox' href="purchase_paybill.php?id=<?=$row['id']?>" <i class="far fa fa-address-card-o"></i>Billing</a></button>
	<button><a rel='facebox' href="purchase_payment.php?id=<?=$row['id']?>" <i class="far fa fa-address-card-o"></i>Payment</a></button>
	<button><a href="purchase_view.php?id=<?=$row['id']?>" <i class="far fa fa-address-card-o"></i>View Bill</a></button>
	<!--<button><a rel="facebox" href="purchase_report_input.php?id=<?//=$row['id']?>" <i class="far fa fa-address-card-o"></i>purchase Report</a></button></td>-->
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