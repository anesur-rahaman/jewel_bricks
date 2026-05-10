<?php require_once "db.php"; ?>
<?php session_start();
if(!isset($_SESSION['id'])){
	echo '<script>windows: location="index.php"</script>';
	}
?>
<?php
	date_default_timezone_set('Asia/Kolkata');
	$time_now=mktime(date('h'),date('i'),date('s'));
	$current_date = date('d-M-y',$time_now);
	$current_time = date('h:i:s',$time_now);
	$date=$current_date." ".$current_time ;?>
<?php
$customer_id =$_REQUEST['id'];
$result = mysqli_query($conn, "SELECT * FROM customers WHERE id  = '$customer_id'");
$row = mysqli_fetch_array($result);
if (!$result) 
	{
	die("Error: Data not found..");
	}
	$id=$row['id'] ;
	$name= $row['name'] ;					
	$address=$row['address'] ;
	$phone=$row['phone'] ;
?>

<?php
$id =$_REQUEST['id'];
$result = mysqli_query($conn, "SELECT SUM(bill) as sum_bill, SUM(payment) as sum_payment, SUM(discount) AS sum_discount FROM sale WHERE customer_id='$customer_id'");
while($row = mysqli_fetch_array($result))
{
	$due = $row['sum_bill'] - $row['sum_payment'] - $row['sum_discount'];
}
?>

<!DOCTYPE html>
<html>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
<div class="form-inline" align="center">
<label for="distributor_search" class="font-weight-bold lead text-dark"><h4><font size="" color="blue"><?php echo $name;?></font><small> (ID # <?php echo $customer_id;?>)</small>, <font size="" color="red"></font><font size="" color="dark green"><?php echo $address;?>,</font> <font size="" color="blue"><?php echo $phone;?></font> | Total Due : <font size="" color="red"><?php echo number_format($due);?></font>
</h4></label>
</div>
<form name="myForm" action="sale_paybill_action.php" method="post" style="font-family: Trebuchet MS">
<table width="500">

<input type="hidden" name="customer_id" value="<?php echo $id; ?>" >

<!--<tr>
<td>Item</td>
	<td><select name="item" id="item" class="form-control" required>
	<option value="" selected disabled>-Select Item-</option>
	<option value="1 No Brick">1 No Brick</option>
	<option value="2 No Brick">2 No Brick</option>
	</select></td>
</tr>-->

<tr>
<td>Item</td>
<td><select name="item" id="item" class="form-control" required>
<option value="" selected disabled>-Select Item-</option>
<?php 
$sql= "SELECT DISTINCT item FROM items WHERE type='Sale' ORDER BY item";
$result=mysqli_query($conn, $sql);
while($row=mysqli_fetch_array($result)){
	$item = $row["item"];
?>
	<option value="<?php echo $item;?>"><?php echo $item;?></option>
<?php } ?>
</select></td>
</tr>

<tr>
<td>Quantity</td>
	<td><input type="text" name="quantity" id="quantity" class="form-control" placeholder="Qty" required></td>
</tr>

<td>Bill Amount</td>
	<td><input type="text" name="bill" id="bill" class="form-control" placeholder="Enter Bill Amount" required></td>
</tr>

<td>Payment Amount</td>
	<td><input type="text" name="payment" id="payment" class="form-control" placeholder="Enter Payment Amount"></td>
</tr>

<tr>
<td>Vehicle</td>
<td><input list="vehicles" name="vehicle" id="vehicle" class="form-control" placeholder="Enter Vehicle No" required>
<datalist id="vehicles">
<?php
$result = mysqli_query($conn, "SELECT DISTINCT vehicle FROM sale ORDER BY vehicle");
while($row=mysqli_fetch_array($result)){
$vehicle = $row['vehicle'];
?>
<option value="<?php echo $vehicle;?>"><?php echo $vehicle;?></option>
<?php 
} ?> 
</datalist></td>
</tr>

<td>Trx Date</td>
	<td><input type="date" name="trx_date" id="trx_date" class="form-control" placeholder="Enter Trx Date" required></td>
</tr>

<tr><td><font size="" color="red"><input type="submit" value="Submit"></td></tr>

</table>
</form>

</body>
</html>