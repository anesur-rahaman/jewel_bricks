<?php include('header.php'); ?>
<?php require_once "db.php"; ?>
<?php session_start();
if(!isset($_SESSION['id'])){
	echo '<script>windows: location="index.php"</script>';
	}
?>
<?php
$reportdate =$_REQUEST['reportdate'];
$printdate = date('Y-m-d', strtotime( $reportdate ));
$printday = date('l', strtotime( $reportdate ));
$startdate = date('Y-m-d H:i:s', strtotime( $reportdate ));
$addtime = "23:59:59";
$secs = strtotime($startdate)-strtotime("00:00:00");
$enddate = date("Y-m-d H:i:s",strtotime($addtime)+$secs);

date_default_timezone_set('Asia/Kolkata');
$time_now=mktime(date('h'),date('i'),date('s'));
$current_date = date('d-M-y',$time_now);
$current_time = date('h:i:s',$time_now);
$date=$current_date." ".$current_time ;
?>

<!-- ========================== Start Sale Table Till Yesterday ========================== -->
<?php
$result = mysqli_query($conn, "SELECT SUM(bill) as till_yesterday_bill, SUM(payment) as till_yesterday_payment, SUM(discount) as till_yesterday_discount FROM sale WHERE trx_date < '$reportdate'");
while($row = mysqli_fetch_array($result))
{
$till_yesterday_totaldues = $row['till_yesterday_bill'] - $row['till_yesterday_payment'] - $row['till_yesterday_discount'] ;

$till_yesterday_bill=$row['till_yesterday_bill'];
$till_yesterday_payment=$row['till_yesterday_payment'];
$till_yesterday_discount=$row['till_yesterday_discount'];
}
?>

<!-- ========================== Start Sale Table Today ========================== -->
<?php
$result = mysqli_query($conn, "SELECT SUM(bill) as today_bill, SUM(payment) as today_payment, SUM(discount) as today_discount FROM sale WHERE trx_date = '$reportdate'");
while($row = mysqli_fetch_array($result))
{
$today_totaldues= $row['today_bill'] - $row['today_payment'] - $row['today_discount'] ;
$today_bill=$row['today_bill'];
$today_payment=$row['today_payment'];
$today_discount=$row['today_discount'];
}
?>


<!-- ========================== Start Expense Till Yesterday ========================== -->
<?php

$result = mysqli_query($conn, "SELECT SUM(amount) as till_yesterday_expense FROM expenses WHERE trx_date < '$reportdate'");
while($row = mysqli_fetch_array($result))
{
$till_yesterday_expense=$row['till_yesterday_expense'];
//echo $till_yesterday_expense;
}
?>

<!-- ========================== Start Today's Expense ========================== -->
<?php
$result = mysqli_query($conn, "SELECT SUM(amount) as today_expense FROM expenses WHERE trx_date = '$reportdate' ");
while($row = mysqli_fetch_array($result))
{
$today_expense=$row['today_expense'];
}
?>

<!-- ========================== Start Today's Purchase Table ========================== -->
<?php
$result = mysqli_query($conn, "SELECT SUM(bill) as today_purchase_bill, SUM(payment) as today_purchase_payment FROM purchase WHERE trx_date = '$reportdate'");
while($row = mysqli_fetch_array($result))
{
$today_purchase_bill=$row['today_purchase_bill'];
$today_purchase_payment=$row['today_purchase_payment'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title	>Daily Sheet - <?php echo date('d-M-y', strtotime( $reportdate)); ?></title>
</head>
<!--<body class="bg-secondary" oncontextmenu="return false;">-->
<body class="main" oncontextmenu="return false;">
<div class="a">
<div class="container">
<div class="row justify-content-center">
<div class="col-md-12 bg-light mt-2 rounded pb-3">
<div class="" align = "center">
<div class="row">
  <div class="column" style="background-color:#;">
	<img src=".png" alt="" style="width:400px" style="height:50px">
  </div>

<div class="column" style="background-color:#;">
<label for="purchase_search" class="font-weight-bold lead text-dark">Daily Sheet Report
<h5 align="center"><td><?php echo $printday; ?>, <?php echo date('d-M-y', strtotime($printdate));?> | Total Dues<font size="" color="red"> ₹  <?php echo number_format((float)$till_yesterday_totaldues + $today_totaldues);?></font></p></h5>
<td><a href='dailysheetreport_trx_date.php?reportdate=<?= date('Y-m-d', strtotime('-1 day', strtotime($reportdate)))?>' class="btn btn-info btn-sm">Previous Day</a></td>
<td><a href='dailysheetreport_trx_date.php?reportdate=<?php echo $todaydate = date('Y-m-d'); ?>' class="btn btn-success btn-sm">Today</a></td>
<td><a href='dailysheetreport_trx_date.php?reportdate=<?= date('Y-m-d', strtotime('+1 day', strtotime($reportdate)))?>' class="btn btn-info btn-sm">Next Day</a></td>
<div class="" align = "center">
	<form method="post" action="dailysheetreport_trx_date.php" id="myForm">
	<font size="" color="black">
	<td><input type="date" name="reportdate" id="reportdate"></td>	
	<td><button><name="total" class="" onclick="return submit_order()" >Submit</button></td></font>
	</form>
</div>
</label>
</div>

  <div class="column" style="background-color:#;">
	<!--<h4>Salesman of the Month</h4>-->
	<img src=".png" alt="" style="width:250px" style="height:15px">
  </div>
</div>

<div style="display:<?php if(isset($_SESSION['showAlert'])){echo $_SESSION['showAlert'];} else{echo 'none';} unset($_SESSION['showAlert']); ?>" class="alert alert-success alert-dismissible mt-3">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <strong><?php if(isset($_SESSION['message'])){echo $_SESSION['message'];} unset($_SESSION['showAlert']); ?></strong>
</div>

<body>

<!-- ============================== Cash =================================== -->
<div class="table-responsive mt-2">
<table class="table table-bordered table-striped text-center">
<tr>
<td colspan="7">
<h5 class="text-center text-info m-0"><font size="" color="red"><b>Cash & Balance</h5>
</td>
</tr>
<tr align="right">
    <th>Cash Holder</th>
    <th>B/F (₹)</th>
    <th>Deposit (₹)</th>
    <th>Expense (₹)</th>		
    <th>Total Amount (₹)</th>
</tr>
  
<tr align="center">
    <td colspan="1" class="total-line">Office</td>
	<td colspan="1" class="total-line"><?php echo number_format($till_yesterday_payment - $till_yesterday_expense); ?></td>
	<td colspan="1" class="total-line"><b><font size="" color="red">(+) </font></b><?php echo number_format($today_payment); ?></td>
	<td colspan="1" class="total-line"><b><font size="" color="red">(-) </font></b><?php echo number_format($today_expense); ?></td>
    <td colspan="1" class="total-line"><?php echo number_format($till_yesterday_payment - $till_yesterday_expense	+ $today_payment - $today_expense); ?></td>
</tr>

</tr>
</table>

<!-- ============================== Due =================================== -->
<div class="table-responsive mt-2">
<table class="table table-bordered table-striped text-center">
<tr>
<td colspan="7">
<h5 class="text-center text-info m-0"><font size="" color="red"><b>Sale Dues</h5>
</td>
</tr>
<tr align="right">
    <th>B/F (₹)</th>
    <th>Today's Bill (₹)</th>
    <th>Today's Payment (₹)</th>
    <th>Today's Discount (₹)</th>		
    <th>Total Dues (₹)</th>
</tr>
  
<tr align="center">
	<td colspan="1" class="total-line"><?php echo number_format($till_yesterday_totaldues); ?></td>
	<td colspan="1" class="total-line"><b><font size="" color="red">(+) </font></b><?php echo number_format($today_bill); ?></td>
	<td colspan="1" class="total-line"><b><font size="" color="red">(-) </font></b><?php echo number_format($today_payment); ?></td>
	<td colspan="1" class="total-line"><b><font size="" color="red">(-) </font></b><?php echo number_format($today_discount); ?></td>
    <td colspan="1" class="total-line"><?php echo number_format($till_yesterday_totaldues + $today_bill - $today_payment - $today_discount); ?></td>
</tr>

</tr>
</table>

<!-- ============================== Sale =================================== -->	
<div class="table-responsive mt-2">
<table class="table table-bordered table-striped text-center">
<tr>
<td colspan="11">
<h5 class="text-center text-info m-0"><font size="" color="red"><b>Sale</h5>
</td>
</tr>
<tr align="left">
    <th>Sr.</th>
    <th>Date</th>
    <th>Customer</th>
    <th>Address</th>	
	<th>Item</th>
	<th>Quantity</th>
	<th>Bill</th>
	<th>Vehicle</th>
	<th>Discount</th>
	<th>Payment</th>
	<th>Running Due</th>
</tr>
	
<tr class="item-row" align="center">

<?php
$result = mysqli_query($conn, "SELECT *, customer_id, payment  FROM sale WHERE trx_date ='$reportdate'");
$sno = 1;
while($row = mysqli_fetch_array($result))
{
$temp_date = $row['date'];
$resultc = mysqli_query($conn, "SELECT * FROM customers where id ='".$row['customer_id']."'");
$rowc = mysqli_fetch_array($resultc);
	
?>
<tr>
    <td><?php echo $sno; ?></td>
    <td><?php echo date('d-M-y', strtotime( $row['trx_date'])); ?><br><small>(Trx/Challan Id : <?php echo $row['id']; ?>)</small></td>

    <td><?php echo $rowc['name']; ?><br><small>(<?php echo $rowc['type']; ?>)</small></td>
    <td><?php echo $rowc['address']; ?>
	<p>
	<small><a href='sale_bill.php?id=<?php echo $row['id']; ?>&customer_id=<?php echo $row['customer_id']; ?>' class="btn btn-info btn-sm">Challan</a></small>
	<small><a href='sale_view.php?id=<?php echo $row['customer_id']; ?>' class="btn btn-success btn-sm">Bill</a></small>	
	<?php //echo "<small><button><a href='sale_bill.php?id=".$row['id']."&customer_id=".$row['customer_id']."'>Challan</a></small></button>"; ?>
	<?php //echo "<small><button><a href='sale_view.php?id=".$row['customer_id']."'>Bill</a></small></button>"; ?></td>    
	<td><?php echo $row['item']; ?></td>
	<td><?php echo $row['quantity']; ?></td>	
	<td align="right">₹ <?php $bill=$row['bill'];?><?php if($bill !="0" ){echo number_format((float)$bill);}?></td>
    <td><?php echo $row['vehicle']; ?><?php //if ($row['bill'] !="") {echo "<br><small>(" . $row['order_by'] . ")</small></td>";}?>
	<td align="right">₹ <?php $discount=$row['discount']; ?><?php echo number_format((float)$discount); ?></td>
	<td align="right">₹ <?php $payment=$row['payment']; ?><?php echo number_format((float)$payment); ?></td>
  <?php 
  $Color = "red";
  $result_running_due = mysqli_query($conn, "SELECT SUM(bill) AS sum_bill, SUM(payment) AS sum_payment, SUM(discount) AS sum_discount FROM sale where customer_id='".$row['customer_id']."' AND date <= '$temp_date' ");
  //echo $temp_date;
  while($rows_due=mysqli_fetch_array($result_running_due)){
  $running_due = $rows_due['sum_bill'] - $rows_due['sum_payment'] - $rows_due['sum_discount'];
  }  
  //echo '<td align="right" style="Color:'.$Color.'">' . number_format($running_due) . '</td>';?>

  <?php 
  $Color = "red";
  $result_running_due_overall = mysqli_query($conn, "SELECT SUM(bill) AS sum_bill, SUM(payment) AS sum_payment, SUM(discount) AS sum_discount FROM sale where customer_id='".$row['customer_id']."' AND date <= '2099-12-31' ");
  //echo $temp_date;
  while($rows_due=mysqli_fetch_array($result_running_due_overall)){
  $running_due_overall = $rows_due['sum_bill'] - $rows_due['sum_payment'] - $rows_due['sum_discount'];
  }  
  //echo '<td align="right" style="Color:'.$Color.'">' . number_format($running_due_overall) . '</td>';?>
  
<td align="right">₹ <font size="" color="red"><?php echo number_format($running_due); ?></font><!--<br><small>(<?php //echo number_format($running_due_overall); ?>)</small>--></td>
</tr>
<?php
    $sno ++;
  }
?>
</tr>

<tr align="right">
    <th colspan="6" class="total-line">Total Bill (₹)</th>
    <th class="total-line"><div id="total"><b><?php echo number_format((float)$today_bill); ?></b></div></th>
	<th colspan="2" class="total-line">Total Payment (₹)</th>
	<th class="total-line"><div id="total"><b><?php echo number_format((float)$today_payment); ?></b></div></th>
	<th colspan="3" class="total-line"></th>
</tr>
</table>


<!-- ============================== Purchase =================================== -->	
<div class="table-responsive mt-2">
<table class="table table-bordered table-striped text-center">
<tr>
<td colspan="10">
<h5 class="text-center text-info m-0"><font size="" color="red"><b>Purchase</h5>
</td>
</tr>
<tr align="left">
    <th>Sr.</th>
    <th>Date</th>
    <th>Customer</th>
    <th>Address</th>	
	<th>Item</th>
	<th>Quantity</th>
	<th>Bill</th>
	<th>Vehicle</th>
	<th>Payment</th>
	<th>Running Due</th>
</tr>
	
<tr class="item-row" align="center">

<?php
$result = mysqli_query($conn, "SELECT *, vendor_id, payment FROM purchase WHERE trx_date ='$reportdate'");
$sno = 1;
while($row = mysqli_fetch_array($result))
{
$temp_date = $row['date'];
$resultc = mysqli_query($conn, "SELECT * FROM vendors where id ='".$row['vendor_id']."'");
$rowc = mysqli_fetch_array($resultc);
	
?>
<tr>
    <td><?php echo $sno; ?></td>
    <td><?php echo date('d-M-y', strtotime( $row['trx_date'])); ?><!--<br><small>(Trx/Challan Id : <?php //echo $row['id']; ?>)</small>--></td>

    <td><?php echo $rowc['name']; ?><!--<br><small>(Customer Id : <?php //echo $row['vendor_id']; ?>)</small>--></td>
    <td><?php echo $rowc['address']; ?></td>    
	<td><?php echo $row['item']; ?></td>
	<td><?php echo $row['quantity']; ?></td>	
	<td align="right">₹ <?php $bill=$row['bill'];?><?php if($bill !="0" ){echo number_format((float)$bill);}?></td>
    <td><?php echo $row['vehicle']; ?><?php //if ($row['bill'] !="") {echo "<br><small>(" . $row['order_by'] . ")</small></td>";}?>
	<td align="right">₹ <?php $payment=$row['payment']; ?><?php echo number_format((float)$payment); ?></td>
  <?php 
  $Color = "red";
  $result_running_due = mysqli_query($conn, "SELECT SUM(bill) AS sum_bill, SUM(payment) AS sum_payment FROM purchase where vendor_id='".$row['vendor_id']."' AND date <= '$temp_date' ");
  //echo $temp_date;
  while($rows_due=mysqli_fetch_array($result_running_due)){
  $running_due = $rows_due['sum_bill'] - $rows_due['sum_payment'];
  }  
  //echo '<td align="right" style="Color:'.$Color.'">' . number_format($running_due) . '</td>';?>

  <?php 
  $Color = "red";
  $result_running_due_overall = mysqli_query($conn, "SELECT SUM(bill) AS sum_bill, SUM(payment) AS sum_payment FROM purchase where vendor_id='".$row['vendor_id']."' AND date <= '2099-12-31' ");
  //echo $temp_date;
  while($rows_due=mysqli_fetch_array($result_running_due_overall)){
  $running_due_overall = $rows_due['sum_bill'] - $rows_due['sum_payment'];
  }  
  //echo '<td align="right" style="Color:'.$Color.'">' . number_format($running_due_overall) . '</td>';?>
  
<td align="right">₹ <font size="" color="red"><?php echo number_format($running_due); ?></font><!--<br><small>(<?php //echo number_format($running_due_overall); ?>)</small>--></td>
</tr>
<?php
    $sno ++;
  }
?>
</tr>

<tr align="right">
    <th colspan="6" class="total-line">Total Bill (₹)</th>
    <th class="total-line"><div id="total"><b><?php echo number_format((float)$today_purchase_bill); ?></b></div></th>
	<th colspan="1" class="total-line">Total Payment (₹)</th>
	<th class="total-line"><div id="total"><b><?php echo number_format((float)$today_purchase_payment); ?></b></div></th>
	<th colspan="3" class="total-line"></th>
</tr>
</table>

<!-- ============================== Expenses =================================== -->			
<div class="table-responsive mt-2">
<table class="table table-bordered table-striped text-center">
<tr>
<td colspan="11">
<h5 class="text-center text-info m-0"><font size="" color="red"><b>Expenses</h5>
</td>
</tr>
<tr align="left">
    <th>Sr.</th>
    <th>Trx Date</th>
    <th>Expense</th>
    <th>Sub Expense</th>		
    <th>Amount (₹)</th>
</tr>
  
<tr class="item-row" align="center">

<?php
$result = mysqli_query($conn, "SELECT * FROM expenses WHERE trx_date ='$reportdate'");
$sno = 1;
while($row = mysqli_fetch_array($result))
{
?>
<tr>
	<td><?php echo $sno; ?></td>
    <td><?php echo date('d-M-y', strtotime( $row['trx_date'])); ?></td>
    <td><?php echo $row['expense']; ?></td>
    <td><?php echo $row['sub_expense']; ?></td>
    <td align="right">₹ <?php $amount=$row['amount']; ?><?php echo number_format((float)$amount); ?></td>
</tr>
<?php
    $sno ++;
  }
?>
</tr>
  
<tr align="right">
    <!--<td colspan="4" class="blank"> </td>
	<td colspan="1" class="total-line">Total (₹)</td>-->
	<th colspan="4" class="total-line">Total Expense (₹)</th>
	<th class="total-line"><div id="total"><b>₹ <?php echo number_format((float)$today_expense); ?></b></div></th>
</tr>
</table>

<tr><br><br>
<h5 align="right"><td>Signature (Manager) &nbsp;&nbsp;&nbsp;&nbsp;</p></h5>
</tr>
</div>
</body>
</html>