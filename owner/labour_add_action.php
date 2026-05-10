<?php require_once "db.php"; ?>
<?php
	$name = $_POST['name'] ;
	$name_value = $name ;	
	$address = $_POST['address'] ;
	$phone = $_POST['phone'] ;
	
	mysqli_query($conn, "INSERT INTO labour (name, name_value, address, phone) VALUES ('$name', '$name_value','$address', '$phone')");
	
	//mysqli_query($conn, "INSERT INTO expense_category (expense, sub_expense) VALUES ('Labour Advance', '$name')");
	//mysqli_query($conn, "INSERT INTO expense_category (expense, sub_expense) VALUES ('Labour Wages', '$name')");
	
	//echo '<script>alert("New Labour added successfully !!!")</script>';
	echo '<script>windows: location="labour.php"</script>';
?>