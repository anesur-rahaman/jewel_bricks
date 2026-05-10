<?php require_once "db.php"; ?>
<?php session_start();
if(!isset($_SESSION['id'])){
	echo '<script>windows: location="index.php"</script>';
	}
?><!DOCTYPE html>
<html>
<head>
</head>
<body>
<h3 align="center" style="font-family: Trebuchet MS">Add New Purchase Item</h3>
<form name="myForm" action="purchase_item_add_action.php" method="post" style="font-family: Trebuchet MS">
<table width="500">

<tr>
<td>Purchase Item</td>
<td><input list="items" name="item" id="item" class="form-control" placeholder="Enter Item" required>
<datalist id="items">
<?php
$stmt_details = mysqli_query($conn, "SELECT DISTINCT item FROM items WHERE type ='Purchase' ORDER BY item");
while($row_details=mysqli_fetch_array($stmt_details)){
$item = $row_details['item'];
?>
<option value="<?php echo $item;?>"><?php echo $item;?></option>
<?php 
} ?> 
</datalist></td>
</tr>

<tr><td><input type="submit" value="Submit"></td><td>&nbsp;</td></tr>

</table>
</form>

</body>
</html>