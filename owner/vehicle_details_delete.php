<?php session_start(); ?>
<?php
 include 'db.php';
$id =$_REQUEST['id'];
$vehicle_id =$_REQUEST['vehicle_id'];
$result = mysqli_query($conn, "SELECT * FROM vehicle_details WHERE id  = '$id'");
$row = mysqli_fetch_array($result);
if (!$result) 
		{
		die("Error: Data not found..");
		}
				$id=$row['id'] ;
?>
<form action="vehicle_details_delete_action.php" method="post" align="center">
<h4><font size="" color="red">Are you sure you want to Delete this Record?</font></h4>
<input type="hidden" name="vehicle_id" value="<?php echo $vehicle_id; ?>" />
<input type="hidden" name="id" value="<?php echo $id; ?>" />
<input type="submit" nsme="ok" value="Delete">
</form>