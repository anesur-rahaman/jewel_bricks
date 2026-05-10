<?php require_once "db.php"; ?>
<?php session_start();
if(!isset($_SESSION['id'])){
	echo '<script>windows: location="index.php"</script>';
	}
?>
<?php

$vendor_id =$_REQUEST['id'];
$result = mysqli_query($conn, "SELECT * FROM vendors WHERE id  = '$vendor_id'");
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
$result = mysqli_query($conn, "SELECT SUM(bill) as sumbill, SUM(payment) as sumpayment FROM purchase WHERE vendor_id='$vendor_id'");
while($row = mysqli_fetch_array($result))
{
	$due = $row['sumbill']-$row['sumpayment'];
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Payment</title>
</head>
<!--<body onload="blinktext();">-->
<body class="main">
<div class="a">
<div class="container-fluid">
<div id="message"></div>
<div class="row justfied-content-center">
<div class="col-md-12 bg-light mt-2 rounded pb-3"><?php
	date_default_timezone_set('Asia/Kolkata');
	$time_now=mktime(date('h'),date('i'),date('s'));
	$current_date = date('d-M-y',$time_now);
	$current_time = date('h:i:s',$time_now);
	$date=$current_date." ".$current_time ;?>

	<h4 align="center">Payment for <font size="" color="blue"><?php echo $name;?></font><small> (ID # <?php echo $vendor_id;?>)</small>, <font size="" color="red"></font><font size="" color="dark green"><?php echo $address.'&nbsp;';?></font>|Total Due : <font size="" color="red"><?php echo number_format($due);?></font></h4>
<br>
<form method="post" action="purchase_payment_action.php" id="myForm">
<div>
<table width="500">

<thead>
   <tr>
  <input type="hidden" name="vendor_id" value="<?php echo $id; ?>" />
  <input type="hidden" name="date" value="<?php echo $date; ?>" />
   </tr>
</thead>
	
    <tbody>
	<tr>
    <th><font size="" color="blue">Payment Amount </font><br><font size="" color="blue"></font></th>
    <td><input type="number" name="payment" id="payment" class="form-control" min="1" oninput="validity.valid||(value='');" placeholder="Enter Payment Amount" required></td>
    </tr>
<td>Trx Date</td>
	<td><input type="date" name="trx_date" id="trx_date" class="form-control" placeholder="Enter Trx Date" required></td>
</tr>

<tr><td><font size="" color="red"><input type="submit" value="Submit"></td></tr>

	</tbody>	
  </table>
  </div>
</form>
  </div>
</body>
</html>