<?php require_once "db.php"; ?>
<?php
 session_start();

 date_default_timezone_set('Asia/Kolkata');
 $time_now=mktime(date('H'),date('i'),date('s'));
 $current_date = date('Y-m-d',$time_now);
 $current_time = date('H:i:s',$time_now);
 $date=$current_date." ".$current_time ;
 $reportdate = date('Y-m-d', strtotime( $date ));
 $login = mysqli_query($conn, "SELECT * FROM user WHERE (username = '" .($_POST['username']) . "') and (password = '" .($_POST['password']) . "')");
 $row=mysqli_fetch_array($login);  
 
if($row && $_POST['username']=='jewel'){
 //if($row){	 
 $_SESSION['id'] = $row['id'];
 echo '<script>windows: location="dailysheetreport_trx_date.php?reportdate='. $reportdate. '"</script>';
	}
	else {
		header ("location: index.php?err");
		}
?>