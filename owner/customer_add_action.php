<?php require_once "db.php"; ?>
<?php
	$type= $_POST['type'] ;
	$name= $_POST['name'] ;
	$address=$_POST['address'] ;
	$phone=$_POST['phone'] ;
	
	mysqli_query($conn, "INSERT INTO customers (name, address, phone, type) 
	VALUES ('$name', '$address', '$phone', '$type')"); 
	//echo '<script>alert("New customer added successfully !!!")</script>';
	echo '<script>windows: location="sale.php"</script>';
?>