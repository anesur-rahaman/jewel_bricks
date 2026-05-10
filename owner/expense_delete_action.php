<?php
include 'db.php';
	$id = $_POST['id'];
	
	mysqli_query($conn, "DELETE from expenses WHERE id='$id'");
	echo '<script>windows: location="expense.php"</script>';
?>