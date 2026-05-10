<?php include('header.php'); ?>
<?php require_once "db.php"; ?>
<?php session_start();
if(!isset($_SESSION['id'])){
	echo '<script>windows: location="index.php"</script>';
	}
?>

<?php
$id =$_REQUEST['id'];
$customer_id =$_REQUEST['customer_id'];
//$result = mysqli_query($conn, "SELECT SUM(bill) as sumbill, SUM(payment) as sumpayment FROM sale WHERE customer_id='$customer_id'");
$result = mysqli_query($conn, "SELECT SUM(bill) as sumbill, SUM(payment) as sumpayment FROM sale where id <'".$id."' AND customer_id ='".$customer_id."' ");
while($row = mysqli_fetch_array($result))
{
	$previousdues = $row['sumbill']-$row['sumpayment'];
}
?>

<?php
	date_default_timezone_set('Asia/Kolkata');
	$time_now=mktime(date('h'),date('i'),date('s'));
	$current_date = date('d-M-y',$time_now);
	$current_time = date('h:i:s',$time_now);
	$printdatetime=$current_date." ".$current_time ;

	?>
<?php
$id =$_REQUEST['id'];
$customer_id =$_REQUEST['customer_id'];  
$result = mysqli_query($conn, "SELECT * FROM sale where id ='".$id."' AND customer_id ='".$customer_id."' ");  
while($row = mysqli_fetch_array($result))
{
	$transactionid=$row['id'];
	$date=$row['date'];
	$item=$row['item'];
	$quantity=$row['quantity'];	
	$bill=$row['bill'];	
	$payment_last=$row['payment'];
	$customer_id=$row['customer_id'];

	$vehicle=$row['vehicle'];
	$challan_id=$row['invoice_id'];	
	//echo $challan_id;
}
?>
<?php
$result = mysqli_query($conn, "SELECT * FROM customers WHERE id  = '$customer_id'");
$test = mysqli_fetch_array($result);
if (!$result) 
{
	die("Error: Data not found..");
}
	$id=$test['id'] ;
	$name= $test['name'] ;					
	$address=$test['address'] ;
	$town=$test['town'] ;
	$phone=$test['phone'] ;
?>
<?php
$balancedue = $previousdues + $bill - $payment_last
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Challan Cum Bill</title>
</head>
<body class="main">
<div class="a">
<div class="container-fluid">
<div id="message"></div>
<div class="row justfied-content-center">
<div class="col-md-12 bg-light mt-2 rounded pb-3">


<link rel='stylesheet' type='text/css' href='style.css'>


<div id="page-wrap" style="font-family: Trebuchet MS">

<div class="header">
<img src="logo.jpg" alt="logo" style="width:100px" style="height:20px">
&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;<font size="5" color="">C H A L L A N</font>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;<font size="2" color=""># <text><?php if ($bill !="0" ) {echo $transactionid;}?> <?php //echo $challan_id;?></text> | <text id="date"><?php echo date('d-M-y h:i a', strtotime($date));?></text></font>
<br>
<!--<h4>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&nbsp;Challan # <text><?php //if ($bill !="0" ) {echo $transactionid;}?> <?php //echo $challan_id;?></text> | <text id="date"><?php //echo date('d-M-y h:i a', strtotime($date));?></text>
</h4>-->
</div>

<!-- ======== Buyer ========= -->

<!-- ======== Buyer ========= -->
<div style="clear:both"></div>
<div id="identity">
<text id="address">
	<h4>Jewel Sekh</p></h4>
	Dackbanglow Para, Rampurhat<br>	
	Birbhum, West Bengal - 731224, India<br>
	Phone : 98006 92492, 91534 24876
</text>

<div>
<text id="address"></text>
</div>
</div>


<div id="identity">
<text id="address">
<h4>Buyer <small>(ID # <?php echo $customer_id; ?>)</small></p></h4>
<b><?php echo $name; ?></b>
<br>
<?php echo $address; ?>, <?php echo $town; ?><br>
Phone : <?php echo $phone; ?><br>
</div>

<!-- ======== Billing ========= -->	
<div class="a">
<table id="items">
<tr>
	<th colspan="3" class="blank">Item</th>
	<th>Vehicle</th>
	<th>Quantity</th>
	<th>Bill Amount (₹)</th>
</tr>

<tr class="item-row" align="right">
<?php if($item !="" ){?>
    <!--<td class="item-name"><div class="delete-wpr"><text>1</text></div></td>-->
    <td colspan="3" class="blank"><text><?php echo $item; ?></text></td>
	<td><span class="description"><?php echo $vehicle; ?></span></td>
    <td><text class="description"><?php echo $quantity; ?></text></td>
	<td><span class="description"><?php echo number_format((float)$bill); ?></span></td>
<?php } ?>
</tr>

<tr class="item-row" align="right">
    <!--<td class="item-name"><div class="delete-wpr"><text>1</text></div></td>-->
	<td class="description"></td>
	<td></td>
    <td></td>	
	<td></td>
	<td></td>
</tr>
<tr class="item-row" align="right">
    <!--<td class="item-name"><div class="delete-wpr"><text>1</text></div></td>-->
	<td class="description"></td>
	<td></td>
    <td></td>	
	<td></td>
	<td></td>
</tr><tr class="item-row" align="right">
    <!--<td class="item-name"><div class="delete-wpr"><text>1</text></div></td>-->
	<td class="description"></td>
	<td></td>
    <td></td>	
	<td></td>
	<td></td>
</tr><tr class="item-row" align="right">
    <!--<td class="item-name"><div class="delete-wpr"><text>1</text></div></td>-->
	<td class="description"></td>
	<td></td>
    <td></td>	
	<td></td>
	<td></td>
</tr><tr class="item-row" align="right">
    <!--<td class="item-name"><div class="delete-wpr"><text>1</text></div></td>-->
	<td class="description"></td>
	<td></td>
    <td></td>	
	<td></td>
	<td></td>
</tr><tr class="item-row" align="right">
    <!--<td class="item-name"><div class="delete-wpr"><text>1</text></div></td>-->
	<td class="description"></td>
	<td></td>
    <td></td>	
	<td></td>
	<td></td>
</tr>

<tr align="right">
	<td colspan="4" class="blank"> </td>
	<td colspan="1" class="total-line"><text>Total (₹)</text></td>
    <td class="total-line"><div id="total"><?php echo number_format((float)$bill);?></div></td>
</tr>

<tr align="right">
	<td colspan="4" class="blank"> </td>
	<td colspan="1" class="total-line"><text>Previous Dues (₹)</text></td>
    <td class="total-line"><div id="total"><?php echo number_format((float)$previousdues);?></div></td>
</tr>


<tr align="right">
	<td colspan="4" class="blank"> </td>
	<td colspan="1" class="total-line">Amount Paid (₹)</</td>
    <td class="total-line"><text id="total"><?php echo number_format((float)$payment_last);?></text></td>
</tr>

<tr align="right">
 
	<td colspan="4" class="blank"> </td>
	<td colspan="1" class="total-line balance">Balance Due (₹)</</td>
	<td class="total-line"><div class="total"><b><?php echo number_format((float)$balancedue);?></div></td>
</tr>
</table>

	<tr><br><br><br>
    <td><text>&emsp;&emsp;&emsp;&emsp;Signature (Customer)</text></td>
	<td>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&nbsp;&nbsp;</td>
	<td><text>Signature (Manager)</text></td>
	</tr>

</div>
</body>
</html>