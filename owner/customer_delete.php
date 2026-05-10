<?php session_start(); ?>
<?php
 include 'db.php';
$id =$_REQUEST['id'];
$result = mysqli_query($conn, "SELECT * FROM customers WHERE id  = '$id'");
$test = mysqli_fetch_array($result);
if (!$result) 
		{
		die("Error: Data not found..");
		}
				$id=$test['id'] ;
?>
<form action="customer_delete_action.php" method="post" align="center">
<h4><font size="" color="red">Are you sure you want to Delete this Record?</font></h4>
<input type="hidden" name="id" value="<?php echo $id; ?>" />
<input type="submit" nsme="ok" value="Delete">
</form>