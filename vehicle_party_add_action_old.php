<?php require_once "db.php"; ?>
<?php
	$name = $_POST['name'] ;
	$address = $_POST['address'] ;
	$phone = $_POST['phone'] ;
	$type = $_POST['type'] ;
	
	mysqli_query($conn, "INSERT INTO vehicle (name, address, phone, type) VALUES ('$name','$address', '$phone', '$type')");

	echo '<script>windows: location="vehicle.php?type=' .$type. ' "</script>';
?>