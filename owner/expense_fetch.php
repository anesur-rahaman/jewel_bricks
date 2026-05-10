<?php require_once "db.php"; ?>
<?php
$output='';
$sql= "SELECT * FROM expense_category WHERE expense='".$_POST['expense']."' ORDER BY sub_expense";
$result=mysqli_query($conn, $sql);
//$output='<option value="">fetch_expense</option>';
while($row=mysqli_fetch_array($result)){
	$output .='<option value="'.$row["sub_expense"].'">'.$row["sub_expense"].'</option>';
}
echo $output;
?>