<?php require_once "db.php"; ?>
<?php
	$name= $_POST['name'] ;					
	$address=$_POST['address'] ;
	$phone=$_POST['phone'] ;
	
	mysqli_query($conn, "INSERT INTO vendors (name, address, phone) 
	VALUES ('$name', '$address', '$phone')"); 
	echo '<script>alert("New Vendor added successfully !!!")</script>';
	echo '<script>windows: location="purchase.php"</script>';
?>