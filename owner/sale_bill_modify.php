<?php require_once "db.php"; ?>
<?php session_start();
if(!isset($_SESSION['id'])){
	echo '<script>windows: location="index.php"</script>';
	}
?>

<?php
$id =$_REQUEST['id'];
$customer_id =$_REQUEST['customer_id'];
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
$customer_id =$_REQUEST['customer_id'];
$result = mysqli_query($conn, "SELECT * FROM sale WHERE id  = '$id'");
$row = mysqli_fetch_array($result);
if (!$result) 
	{
	die("Error: Data not found..");
	}
	$id=$row['id'] ;
	$customer_id= $row['customer_id'] ;					
	$item=$row['item'] ;
	$quantity=$row['quantity'] ;
	$bill=$row['bill'] ;
	$payment= $row['payment'] ;					
	$discount=$row['discount'] ;
	$vehicle=$row['vehicle'] ;	
	$trx_date=$row['trx_date'] ;	
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
<form name="myForm" action="sale_bill_modify_action.php" method="post" style="font-family: Trebuchet MS">
<table width="500">

<input type="hidden" name="id" value="<?php echo $id; ?>" >
<input type="hidden" name="customer_id" value="<?php echo $customer_id; ?>" >

<tr>
<td>Item</td>
<td><select name="item" id="item" value="<?php echo $item; ?>" class="form-control">
	<option value="<?php echo $item; ?>"><?php echo $item; ?></option>
	<option value="" disabled>-Select Item-</option>
	<option value="1 No Brick">1 No Brick</option>
	<option value="2 No Brick">2 No Brick</option>
	<option value="Mitha Bricks + Red Bricks">Mitha Bricks + Red Bricks</option>
	<option value="Red Bricks">Red Bricks</option>	
</select></td>
</tr>

<tr>
<td>Quantity</td>
	<td><input type="text" name="quantity" id="quantity" value="<?php echo $quantity; ?>" class="form-control" placeholder="Qty"></td>
</tr>

<td>Bill Amount</td>
	<td><input type="text" name="bill" id="bill" value="<?php echo $bill; ?>" class="form-control" placeholder="Enter Bill Amount"></td>
</tr>

<td>Payment Amount</td>
	<td><input type="text" name="payment" id="payment" value="<?php echo $payment; ?>" class="form-control" placeholder="Enter Payment Amount"></td>
</tr>

<td>Discount</td>
	<td><input type="text" name="discount" id="discount" value="<?php echo $discount; ?>" class="form-control" placeholder="Enter Discount Amount"></td>
</tr>

<tr>
<td>Vehicle</td>
<td><select name="vehicle" id="vehicle" value="<?php echo $vehicle; ?>" class="form-control">
	<option value="<?php echo $vehicle; ?>"><?php echo $vehicle; ?></option>
	<option value="" disabled>-Select Vehicle-</option>
	<option value="2826">2826</option>
	<option value="9244">9244</option>
</select></td>
</tr>

<td>Trx Date</td>
	<td><input type="date" name="trx_date" id="trx_date" value="<?php echo $trx_date; ?>" class="form-control" placeholder="Enter Trx Date" required></td>
</tr>

<tr><td><font size="" color="red"><input type="submit" value="Submit"></td></tr>

</table>
</form>

</body>
</html>