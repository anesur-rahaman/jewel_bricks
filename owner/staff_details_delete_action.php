<?php
include 'db.php';
	$id = $_POST['id'];
	$customer_id = $_POST['customer_id'];	
	mysqli_query($conn, "DELETE from sale WHERE id='$id'");
		 echo '<script>windows: location="sale_view.php?id=' .$customer_id. ' "</script>';
?>