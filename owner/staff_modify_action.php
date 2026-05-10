<?php require_once "db.php"; ?>
<?php
	$id = $_POST['id'];
	$type= $_POST['type'] ;
	$name= $_POST['name'] ;
	$address=$_POST['address'] ;
	$phone=$_POST['phone'] ;
	
	mysqli_query($conn, "UPDATE staff SET name ='$name', address ='$address', phone ='$phone', type ='$type' WHERE id = '$id'");
	echo '<script>windows: location="staff.php"</script>';
?>