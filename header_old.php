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
<html lang="en">
<head>
  <!--<title>Jewel Bricks</title>-->
<link rel="shortcut icon" href="logo.jpg">     
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

<link href="facebox.css" media="screen" rel="stylesheet" type="text/css">
<script src="facebox.js" type="text/javascript"></script>
<script type="text/javascript">
	jQuery(document).ready(function($) {
	  $('a[rel*=facebox]').facebox({
		loadingImage : 'src/loading.gif',
		closeImage   : 'src/closelabel.png'
	  })
	})
</script>
</head>
<body>

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <!--<a class="navbar-brand" href="#">Jewel Bricks</a>-->
	  <a class="navbar-brand" href="http://35.189.179.20/jewel_bricks/sale.php"><img src="logo.jpg" style="width:150px" style="height:100px"/></a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <!--<li class="active"><img src="logo.jpg" style="width:70px" style="height:40px"/><a href="#">Home</a></li>
		<li class="active"><img src="logo.jpg" style="width:70px" style="height:40px"/></li>-->
        <li><a href="dailysheetreport_trx_date.php?reportdate=<?php echo $reportdate; ?>">Daily Sheet</a></li>
		<li><a href="expense.php">Expenses</a></li>

        <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="">Family Expenses<span class="caret"></span></a>
          <ul class="dropdown-menu">
			<li><a href="family_expense.php?expense_by=<?='Maa'?>">Maa</a></li>
			<li><a href="family_expense.php?expense_by=<?='Jewel'?>">Jewel</a></li>
			<li><a href="family_expense.php?expense_by=<?='Liton'?>">Liton</a></li>
			<li><a href="family_expense.php?expense_by=<?='Babor'?>">Babor</a></li>
			<li><a href="family_expense.php?expense_by=<?='Papon'?>">Papon</a></li>
          </ul>
        </li>
		<li><a href="family_expense_all.php">Family Expenses (New)</a></li>		

        <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="">Labour<span class="caret"></span></a>
          <ul class="dropdown-menu">
			<li><a href="labour_all.php">All Labour</a></li>
			<?php 
			$sql= "SELECT DISTINCT type FROM labour ORDER BY type";
			$result=mysqli_query($conn, $sql);
			while($row=mysqli_fetch_array($result)){
				$type = $row["type"];
			?>
				<li><a href="labour.php?type=<?php echo $type;?>"><?php echo $type;?></a></li>
			<?php } ?>			
          </ul>
        </li>

		<li><a href="purchase.php">Purchase</a></li>
        <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="">Sale<span class="caret"></span></a>
          <ul class="dropdown-menu">
			<li><a href="sale.php">All Customer</a></li>
			<li><a href="sale_bhatta.php">Bhatta</a></li>
			<li><a href="sale_bullock_cart.php">Bullock Cart (গরুর গাড়ি)</a></li>
			<li><a href="sale_contractor.php">Contractor</a></li>
			<li><a href="sale_general.php">General</a></li>
			<li><a href="sale_raj_mistry.php">Raj Mistry</a></li>
			<li><a href="sale_supplier.php">Supplier</a></li>
          </ul>
        </li>
		<li><a href="staff.php">Staff & Salary</a></li>
		<li><a href="vehicle.php">Vehicle</a></li>
		</ul>
      <ul class="nav navbar-nav navbar-right">
        <!--<li><a href="#"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
        <li><a href="#"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>-->
        <li><a href="#"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>		
      </ul>
    </div>
  </div>
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

</body>
</html>