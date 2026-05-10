<?php require_once "db.php"; ?>
<?php session_start();
if(!isset($_SESSION['id'])){
	echo '<script>windows: location="index.php"</script>';
	}
?>
<!DOCTYPE html>

<html>
<body>
<h3 align="center" style="font-family: Trebuchet MS">Add New Customer</h3>
<form name="myForm" action="customer_add_action.php" onsubmit="return validateForm()" method="post" style="font-family: Trebuchet MS">
<table width="300">
  <!--<tr>
  <td>Name</td><td><input type="text" name="name" class="form-control" placeholder="Is it Duplicate ?" required></td>
  </tr>-->

<tr>
<td>Customer Type</td>
	<td><select name="type" id="type" class="form-control" required>
	<option value="" selected disabled>-Select Customer Type-</option>
	<option value="Bhatta">Bhatta</option>
	<option value="Bullock Cart">Bullock Cart (গরুর গাড়ি)</option>	
	<option value="Contractor">Contractor</option>	
	<option value="General">General</option>
	<option value="Raj Mistry">Raj Mistry</option>	
	<option value="Supplier">Supplier</option>	
	</select></td>
</tr>

<tr>
<td>Name</td>
<td><input list="names" name="name" id="name" class="form-control" placeholder="Enter Name" required>
<datalist id="names">
<?php
$stmt_details = mysqli_query($conn, "SELECT DISTINCT name FROM customers ORDER BY name");
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
$stmt_details = mysqli_query($conn, "SELECT DISTINCT address FROM customers ORDER BY address");
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
$stmt_details = mysqli_query($conn, "SELECT DISTINCT phone FROM customers ORDER BY phone");
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