<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="author" content="Jewel Bricks">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>Jewel Bricks</title>
<link rel="shortcut icon" href="logo.jpg">
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Popper JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous" >

<!--<script src="https://kit.fontawesome.com/yourcode.js"></script>-->

</head>

<body class="">

<!--<marquee width="100%" direction="left" height="100px"><font size="" color="red"><b>Your subscription will expire in <?php echo $day_diff; ?> days. Please renew before 31-Dec-2024.</b></font></marquee>-->

<!--<marquee width="100%" direction="left" height="100px"><font size="" color="red"><b>Your subscription has been expired on 31-Dec-2025. Please renew to continue.</b></font></marquee>-->

<nav class="navbar navbar-expand-md bg-dark navbar-dark">
  <!-- Brand -->
  <a class="navbar-brand" href="index.php"><img src="logo.jpg" style="width:150px" style="height:100px">&nbsp;&nbsp;</a>
</nav>
<div class="a">
<div class="container" style="width: 350px;
    border: solid 1px;
    border-radius: 4px;
    margin-top: 30px;
    background-color: cadetblue;
	font-family: 'Trebuchet MS';
}">

<h2 align="center">Jewel Bricks</h2>
	<form method="post" action="process.php">
		<div class="form-group">
			<label for="user">Username:</label>
			<input type="text" name="username" class="form-control" id="user" placeholder="Enter Username">
		</div>
		<div class="form-group">
			<label for="pwd">Password:</label>
			<input type="password" name="password" class="form-control" id="pwd" placeholder="Enter password">
		</div>
		<div class="checkbox">
			<label><input type="checkbox"> Remember me</label>
		</div>
		<div align="center">
		<button type="submit" name="ok" class="btn btn-danger mb-2">Submit</button>
		</div>
	</form>
<?php if(isset($_GET['err'])){
	echo "<script>alert('Invalid Username or Password')</script>";
	}
?>
</div>
</div>
<!--<script type="text/javascript">
$(document).ready(function(){
	$("#search_text").keyup(function(){
		var search = $(this).val();
		$.ajax({
		url: 'search.php',
		method: 'post',
		data: {query:search},
		success:function(response){
			$("#table-data").html(response);
			}
		});	
		
	});
});
</script>-->

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Popper JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<style>
div.a {font-size: 14px;}
div.b {font-size: large;}
div.c {font-size: 150%;}
</style>

<script language="JavaScript">
</script>

</body>
</html>