<?php require_once "db.php"; ?>
<?php session_start();
if(!isset($_SESSION['id'])){
	echo '<script>windows: location="index.php"</script>';
	}
?>
<!DOCTYPE html>
<html>
<body>
<h3 align="center" style="font-family: Trebuchet MS">Add New Labour</h3>
<form name="myForm" action="labour_add_action.php" method="post" style="font-family: Trebuchet MS">
<table width="400">

<tr>
<td>Name</td>
<td><input list="names" name="name" id="name" class="form-control" placeholder="Enter Name" required>
<datalist id="names">
<?php
$stmt_details = mysqli_query($conn, "SELECT DISTINCT name FROM labour ORDER BY name");
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
$stmt_details = mysqli_query($conn, "SELECT DISTINCT address FROM labour ORDER BY address");
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
<td><input list="phones" name="phone" id="phone" class="form-control" placeholder="Enter Phone" required>
<datalist id="phones">
<?php
$stmt_details = mysqli_query($conn, "SELECT DISTINCT phone FROM labour ORDER BY phone");
while($row_details=mysqli_fetch_array($stmt_details)){
$phone = $row_details['phone'];
?>
<option value="<?php echo $phone;?>"><?php echo $phone;?></option>
<?php 
} ?> 
</datalist></td>
</tr>

<div class="form-group"><td><input type="submit" name="submit" value="Submit" class="btn btn-info btn-block"></div>

</table>
</form>
</body>
</html>