<?php require_once "db.php"; ?>
<?php
	$name = $_POST['name'] ;
	$address = $_POST['address'] ;
	$phone = $_POST['phone'] ;
	$type = $_POST['type'] ;
	
	mysqli_query($conn, "INSERT INTO labour (name, address, phone, type) VALUES ('$name','$address', '$phone', '$type')");

	echo '<script>windows: location="labour.php?type=' .$type. ' "</script>';
?>