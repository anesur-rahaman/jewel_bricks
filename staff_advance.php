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
$staff_id =$_REQUEST['id'];
$result = mysqli_query($conn, "SELECT * FROM staff WHERE id  = '$staff_id'");
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
$result = mysqli_query($conn, "SELECT SUM(advance) as sum_advance, SUM(salary) as sum_salary, SUM(wages) as sum_wages FROM staff_details WHERE staff_id='$staff_id'");
while($row = mysqli_fetch_array($result))
{
	$running_advance = $row['sum_advance']-($row['sum_salary'] - $row['sum_wages']);
}
?>

<!DOCTYPE html>
<html>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
<div class="form-inline" align="center">
<label for="distributor_search" class="font-weight-bold lead text-dark"><h4><font size="" color="blue"><?php echo $name;?></font><small> (ID # <?php echo $staff_id;?>)</small>, <font size="" color="red"></font><font size="" color="dark green"><?php echo $address;?>,</font> <font size="" color="blue"><?php echo $phone;?></font> | Running Advance : <font size="" color="red"><?php echo number_format($running_advance);?></font>
</h4></label>
</div>
<form name="myForm" action="staff_advance_action.php" method="post" style="font-family: Trebuchet MS">
<table width="500">

<input type="hidden" name="staff_id" value="<?php echo $id; ?>" >

<td>Advance Amount</td>
	<td><input type="text" name="advance" id="advance" class="form-control" placeholder="Enter Advance Amount" required></td>
</tr>

<td>Trx Date</td>
	<td><input type="date" name="trx_date" id="trx_date" class="form-control" placeholder="Enter Trx Date" required></td>
</tr>

<tr><td><font size="" color="red"><input type="submit" value="Submit"></td></tr>

</table>
</form>

</body>
</html>