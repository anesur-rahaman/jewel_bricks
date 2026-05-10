<?php require_once "db.php"; ?>
<?php
	$id = $_POST['id'];
	$name= $_POST['name'] ;
	mysqli_query($conn, "UPDATE vehicle SET name ='$name' WHERE id = '$id'");
	echo '<script>windows: location="vehicle.php"</script>';
?>