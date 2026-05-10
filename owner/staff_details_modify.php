<?php require_once "db.php"; ?>
<?php session_start();
if(!isset($_SESSION['id'])){
	echo '<script>windows: location="index.php"</script>';
	}
?>

<?php
$id =$_REQUEST['id'];
$staff_id =$_REQUEST['staff_id'];
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
	$type=$row['type'] ;	
?>

<?php
$id =$_REQUEST['id'];
$staff_id =$_REQUEST['staff_id'];
$result = mysqli_query($conn, "SELECT * FROM staff_details WHERE id  = '$id'");
$row = mysqli_fetch_array($result);
if (!$result) 
	{
	die("Error: Data not found..");
	}
	$id=$row['id'] ;
	$staff_id= $row['staff_id'] ;					
	$description=$row['description'] ;
	$advance=$row['advance'] ;
	$wages=$row['wages'] ;
	$month= $row['month'] ;					
	$year=$row['year'] ;
	$trx_date=$row['trx_date'] ;
?>

<?php
$id =$_REQUEST['id'];
$result = mysqli_query($conn, "SELECT SUM(advance) as sum_advance, SUM(wages) as sum_wages FROM staff_details WHERE staff_id='$staff_id'");
while($row = mysqli_fetch_array($result))
{
	$due = $row['sum_advance']-$row['sum_wages'];
}
?>

<!DOCTYPE html>
<html>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
<div class="form-inline" align="center">
<label for="distributor_search" class="font-weight-bold lead text-dark"><h4><font size="" color="blue"><?php echo $name;?></font><small> (ID # <?php echo $staff_id;?>)</small>, <font size="" color="red"></font><font size="" color="dark green"><?php echo $address;?>,</font> <font size="" color="blue"><?php echo $phone;?></font> | Total Balance : <font size="" color="red"><?php echo number_format($due);?></font>
</h4></label>
</div>
<form name="myForm" action="staff_details_modify_action.php" method="post" style="font-family: Trebuchet MS">
<table width="500">

<input type="hidden" name="id" value="<?php echo $id; ?>" >
<input type="hidden" name="staff_id" value="<?php echo $staff_id; ?>" >

<tr>
<td>Description</td>
<td><input list="descriptions" name="description" id="description" value="<?php echo $description; ?>" class="form-control" placeholder="Enter Description" required>
<datalist id="descriptions">
<?php
$stmt_details = mysqli_query($conn, "SELECT DISTINCT description FROM customers ORDER BY description");
while($row_details=mysqli_fetch_array($stmt_details)){
$description = $row_details['description'];
?>
<option value="<?php echo $description;?>"><?php echo $description;?></option>
<?php 
} ?> 
</datalist></td>
</tr>

<tr>
<td>Advance</td>
	<td><input type="text" name="advance" id="advance" value="<?php echo $advance; ?>" class="form-control" placeholder="Advance"></td>
</tr>

<td>Wages</td>
	<td><input type="text" name="wages" id="wages" value="<?php echo $wages; ?>" class="form-control" placeholder="Enter Wages"></td>
</tr>

<td>Month</td>
	<td><input type="text" name="month" id="month" value="<?php echo $month; ?>" class="form-control" placeholder="Enter Month"></td>
</tr>

<td>Year</td>
	<td><input type="text" name="year" id="year" value="<?php echo $year; ?>" class="form-control" placeholder="Enter Year"></td>
</tr>

<td>Trx Date</td>
	<td><input type="date" name="trx_date" id="trx_date" value="<?php echo $trx_date; ?>" class="form-control" placeholder="Enter Trx Date" required></td>
</tr>

<tr><td><font size="" color="red"><input type="submit" value="Submit"></td></tr>

</table>
</form>

</body>
</html>