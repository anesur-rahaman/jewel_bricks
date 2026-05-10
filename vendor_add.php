<?php require_once "db.php"; ?>
<?php session_start();
if(!isset($_SESSION['id'])){
	echo '<script>windows: location="index.php"</script>';
	}
?>
<!DOCTYPE html>

<html>
<body>
<h3 align="center" style="font-family: Trebuchet MS">Add New Vendor</h3>
<form name="myForm" action="vendor_add_action.php" onsubmit="return validateForm()" method="post" style="font-family: Trebuchet MS">
<table width="300">

<tr>
<td>Name</td>
<td><input list="names" name="name" id="name" class="form-control" placeholder="Enter Name" required>
<datalist id="names">
<?php
$stmt_details = mysqli_query($conn, "SELECT DISTINCT name FROM vendors ORDER BY name");
while($row_details=mysqli_fetch_array($stmt_details)){
$name = $row_details['name'];
?>
<option value="<?php echo $name;?>"><?php echo $name;?></option>
<?php 
} ?> 
</datalist></td>
</tr>

<tr>
<td>Address</td>
<td><input list="addresss" name="address" id="address" class="form-control" placeholder="Enter Address" required>
<datalist id="addresss">
<?php
$stmt_details = mysqli_query($conn, "SELECT DISTINCT address FROM vendors ORDER BY address");
while($row_details=mysqli_fetch_array($stmt_details)){
$address = $row_details['address'];
?>
<option value="<?php echo $address;?>"><?php echo $address;?></option>
<?php 
} ?> 
</datalist></td>
</tr>

<tr>
<td>Phone</td>
<td><input list="phones" name="phone" id="phone" class="form-control" placeholder="Enter phone" required>
<datalist id="phones">
<?php
$stmt_details = mysqli_query($conn, "SELECT DISTINCT phone FROM vendors ORDER BY phone");
while($row_details=mysqli_fetch_array($stmt_details)){
$phone = $row_details['phone'];
?>
<option value="<?php echo $phone;?>"><?php echo $phone;?></option>
<?php 
} ?> 
</datalist></td>
</tr>


<tr><td><input type="submit" value="Submit"></td><td>&nbsp;</td></tr>

</table>
</form>

</body>
</html>