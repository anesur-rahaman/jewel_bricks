<?php require_once "db.php"; ?>
<?php
	$name = $_POST['name'] ;
	$name_value = $name ;	
	$address = $_POST['address'] ;
	$phone = $_POST['phone'] ;
	$type = $_POST['type'] ;	
	
	mysqli_query($conn, "INSERT INTO staff (name, address, phone, type) VALUES ('$name','$address', '$phone', '$type')");
	
	//mysqli_query($conn, "INSERT INTO expense_category (expense, sub_expense) VALUES ('Staff Advance', '$name')");
	//mysqli_query($conn, "INSERT INTO expense_category (expense, sub_expense) VALUES ('Staff Wages', '$name')");
	
	//echo '<script>alert("New Staff added successfully !!!")</script>';
	echo '<script>windows: location="staff.php"</script>';
?>