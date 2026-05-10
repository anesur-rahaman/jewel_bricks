<?php
include 'db.php';
	$id = $_POST['id'];
	$labour_id = $_POST['labour_id'];	
	mysqli_query($conn, "DELETE from labour_details WHERE id='$id'");
		 echo '<script>windows: location="labour_details_view.php?id=' .$labour_id. ' "</script>';
?>