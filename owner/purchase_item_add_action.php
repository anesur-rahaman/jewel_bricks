<?php require_once "db.php"; ?>
<?php
date_default_timezone_set('Asia/Kolkata');
$time_now=mktime(date('H'),date('i'),date('s'));
$current_date = date('Y-m-d',$time_now);
$current_time = date('H:i:s',$time_now);
$date=$current_date." ".$current_time ;

$item= $_POST['item'] ;					


if($item!=''){
mysqli_query($conn, "INSERT INTO items (item, type) VALUES ('$item', 'Purchase')");
echo '<script>windows: location="purchase.php"</script>';
}else{				
echo '<script>alert("Please fill this form")</script>';
echo '<script>windows: location="purchase.php"</script>';
}				
?>