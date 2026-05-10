<?php
include 'db.php';
	$id = $_POST['id'];
	
	mysqli_query($conn, "DELETE from vehicle WHERE id='$id'");
	echo '<script>windows: location="vehicle.php"</script>';
?>