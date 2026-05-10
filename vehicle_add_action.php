<?php require_once "db.php"; ?>
<?php
	$name= $_POST['name'] ;
	mysqli_query($conn, "INSERT INTO vehicle (name) 
	VALUES ('$name')"); 
	echo '<script>windows: location="vehicle.php"</script>';
?>