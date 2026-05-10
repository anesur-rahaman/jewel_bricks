<?php require_once "db.php"; ?>
<?php session_start();
if(!isset($_SESSION['id'])){
	echo '<script>windows: location="index.php"</script>';
	}
?>
<?php
$id =$_REQUEST['id'];
$result = mysqli_query($conn, "SELECT * FROM vehicle WHERE id  = '$id'");
$row = mysqli_fetch_array($result);
if (!$result) 
	{
	die("Error: Data not found..");
	}
	$id=$row['id'] ;
	$name= $row['name'] ;					
?>

<!DOCTYPE html>

<html>
<body>
<h3 align="center" style="font-family: Trebuchet MS">Modify Vehicle Details</h3>
<form name="myForm" action="vehicle_modify_action.php" onsubmit="return validateForm()" method="post" style="font-family: Trebuchet MS">
<table width="300">
  <!--<tr>
  <td>Name</td><td><input type="text" name="name" class="form-control" placeholder="Is it Duplicate ?" required></td>
  </tr>-->

<input type="hidden" name="id" value="<?php echo $id; ?>" >

<tr>
<td>Name</td>
<td><input list="names" name="name" id="name" value="<?php echo $name; ?>" class="form-control" placeholder="Enter Name" required>
<datalist id="names">
<?php
$stmt_details = mysqli_query($conn, "SELECT DISTINCT name FROM vehicle ORDER BY name");
while($row_details=mysqli_fetch_array($stmt_details)){
$name = $row_details['name'];
?>
<option value="<?php echo $name;?>"><?php echo $name;?></option>
<?php 
} ?> 
</datalist></td>
</tr>

<tr><td><input type="submit" value="Submit"></td><td>&nbsp;</td></tr>

</table>
</form>

</body>
</html>