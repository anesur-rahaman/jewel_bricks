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
	$labour_search=$_POST['query'];
	$stmt = $conn->prepare("SELECT * FROM labour WHERE name LIKE CONCAT(?, '%') OR address LIKE CONCAT(?, '%') OR phone LIKE CONCAT(?, '%') ");
	$stmt->bind_param("sss", $labour_search, $labour_search, $labour_search);
}
else{
	$stmt = $conn->prepare("SELECT * FROM labour");	
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
	<th>Balance</th>
	<th>Function</th>
</tr>
</thead>
<tbody>
<?php 
while($row = $result->fetch_assoc()){
$resultv = mysqli_query($conn, "SELECT SUM(advance) as sum_advance, SUM(wages) as sum_wages FROM labour_details WHERE labour_id ='".$row['id']."' ");
$rowv = mysqli_fetch_array($resultv);
$dues= $rowv['sum_advance'] - $rowv['sum_wages'];
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
	<td><?= $dues ?></td>
	<td><button><a rel='facebox' href="labour_advance.php?id=<?=$row['id']?>" <i class="far fa fa-address-card-o"></i>Advance</a></button>
	<button><a rel='facebox' href="labour_wages.php?id=<?=$row['id']?>" <i class="far fa fa-address-card-o"></i>Wages</a></button>
	<button><a href="labour_details_view.php?id=<?=$row['id']?>" <i class="far fa fa-address-card-o"></i>View Bill</a></button></td>
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