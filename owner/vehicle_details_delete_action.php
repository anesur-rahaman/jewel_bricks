<?php
include 'db.php';
	$id = $_POST['id'];
	$vehicle_id = $_POST['vehicle_id'];	
	mysqli_query($conn, "DELETE from vehicle_details WHERE id='$id'");
		 echo '<script>windows: location="vehicle_details_view.php?id=' .$vehicle_id. ' "</script>';
?>