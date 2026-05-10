<?php require_once "db.php"; ?>
<?php session_start();
if(!isset($_SESSION['id'])){
	//echo '<script>windows: location="index.php"</script>';
	}
?>
<!DOCTYPE html>
<?php
 date_default_timezone_set('Asia/Kolkata');
 $time_now=mktime(date('H'),date('i'),date('s'));
 $current_date = date('Y-m-d',$time_now);
 $current_time = date('H:i:s',$time_now);
 $date=$current_date." ".$current_time ;
 $reportdate = date('Y-m-d', strtotime( $date ));
 //echo $reportdate;
?> 
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Jewel Bricks</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  
<link href="facebox.css" media="screen" rel="stylesheet" type="text/css">
<script src="facebox.js" type="text/javascript"></script>
<script type="text/javascript">
	jQuery(document).ready(function($) {
	  $('a[rel*=facebox]').facebox({
		loadingImage : 'loading.gif',
		closeImage   : 'closelabel.png'
	  })
	})
</script>  
</head>
<body>

<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
  <!-- Brand -->
   <a class="navbar-brand" href="#">
    <img src="logo.jpg" alt="Logo" style="width:150px" style="height:100px">
  </a>  

  <!-- Links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" href="dailysheetreport_trx_date.php?reportdate=<?php echo $reportdate; ?>">Daily Sheet</a>
    </li>
    <li class="nav-item"><a class="nav-link" href="expense.php">Expenses</a></li>

    <!-- Dropdown -->
    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">Family Expenses</a>
      <div class="dropdown-menu">
        <a class="dropdown-item" href="family_expense.php?expense_by=<?='Maa'?>">Maa</a>
        <a class="dropdown-item" href="family_expense.php?expense_by=<?='Jewel'?>">Jewel</a>
        <a class="dropdown-item" href="family_expense.php?expense_by=<?='Liton'?>">Liton</a>
        <a class="dropdown-item" href="family_expense.php?expense_by=<?='Babor'?>">Babor</a>
        <a class="dropdown-item" href="family_expense.php?expense_by=<?='Papon'?>">Papon</a>
      </div>
    </li>
    <!--<li class="nav-item"><a class="nav-link" href="family_expense_all.php">Family Expenses</a></li>-->
	
    <!-- Dropdown -->
    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">Labour</a>
      <div class="dropdown-menu">
        <a class="dropdown-item" href="labour_all.php">All Labour</a>

			<?php 
			$sql= "SELECT DISTINCT type FROM labour ORDER BY type";
			$result=mysqli_query($conn, $sql);
			while($row=mysqli_fetch_array($result)){
				$type = $row["type"];
			?>
				<a class="dropdown-item" href="labour.php?type=<?php echo $type;?>"><?php echo $type;?></a>
			<?php } ?>	
      </div>
    </li>
    <li class="nav-item"><a class="nav-link" href="purchase.php">Purchase</a></li>

    <!-- Dropdown -->
    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">Sale</a>
      <div class="dropdown-menu">
        <a class="dropdown-item" href="sale_all.php">All Customer</a>

			<?php 
			$sql= "SELECT DISTINCT type FROM customers ORDER BY type";
			$result=mysqli_query($conn, $sql);
			while($row=mysqli_fetch_array($result)){
				$type = $row["type"];
			?>
				<a class="dropdown-item" href="sale.php?type=<?php echo $type;?>"><?php echo $type;?></a>
			<?php } ?>	
      </div>
    </li>	

    <li class="nav-item"><a class="nav-link" href="staff.php">Staff & Salary</a></li>
    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">Vehicle</a>
      <div class="dropdown-menu">
        <a class="dropdown-item" href="vehicle_all.php">All Vehicle</a>

			<?php 
			$sql= "SELECT DISTINCT type FROM vehicle ORDER BY type";
			$result=mysqli_query($conn, $sql);
			while($row=mysqli_fetch_array($result)){
				$type = $row["type"];
			?>
				<a class="dropdown-item" href="vehicle.php?type=<?php echo $type;?>"><?php echo $type;?></a>
			<?php } ?>	
      </div>
    </li>	
    <li class="nav-item navbar-right"><a class="nav-link" href="logout.php">Logout</a></li>
</ul>
</nav>
<script language="JavaScript">
  /**
    * Disable right-click of mouse, F12 key, and save key combinations on page
    * By Arthur Gareginyan (https://www.arthurgareginyan.com)
    * For full source code, visit https://mycyberuniverse.com
    */
  window.onload = function() {
    document.addEventListener("contextmenu", function(e){
      e.preventDefault();
    }, false);
    document.addEventListener("keydown", function(e) {
    //document.onkeydown = function(e) {
      // "I" key
      if (e.ctrlKey && e.shiftKey && e.keyCode == 73) {
        disabledEvent(e);
      }
      // "J" key
      if (e.ctrlKey && e.shiftKey && e.keyCode == 74) {
        disabledEvent(e);
      }
      // "S" key + macOS
      if (e.keyCode == 83 && (navigator.platform.match("Mac") ? e.metaKey : e.ctrlKey)) {
        disabledEvent(e);
      }
      // "U" key
      if (e.ctrlKey && e.keyCode == 85) {
        disabledEvent(e);
      }
      // "F12" key
      if (event.keyCode == 123) {
        disabledEvent(e);
      }
    }, false);
    function disabledEvent(e){
      if (e.stopPropagation){
        e.stopPropagation();
      } else if (window.event){
        window.event.cancelBubble = true;
      }
      e.preventDefault();
      return false;
    }
  };
</script>
<style>
div.a {font-size: 13px;}
div.b {font-size: large;}
div.c {font-size: 150%;}

.main {
  padding: 16px;
  margin-top: -20px;
  height: 60%; /* Used in this example to enable scrolling */
  font-family: 'Trebuchet MS';
}
* {
  box-sizing: border-box;
}

/* Create three equal columns that floats next to each other */
.column {
  float: left;
  width: 33.33%;
  padding: 10px;
  height: 175px; /* Should be removed. Only for demonstration */
}

/* Clear floats after the columns */
.row:after {
  content: "";
  display: table;
  clear: both;
}
</style>
<br>
<?php
$today = date('Y-m-d');
$expiry = "2025-06-30";

$expiry = strtotime("2025-06-30");
$today = strtotime($today);
$day_diff = ($expiry - $today + 86400)/86400;
?>
<!--<marquee width="100%" direction="left" height="100px"><font size="" color="red"><b>Your subscription will expire in <?php echo $day_diff; ?> days. Please renew before 30-Jun-2025.</b></font></marquee>-->

<!--<marquee width="100%" direction="left" height="100px"><font size="" color="red"><b>Your subscription has been expired on 31-Dec-2025. Please renew to continue.</b></font></marquee>-->
</body>
</html>
