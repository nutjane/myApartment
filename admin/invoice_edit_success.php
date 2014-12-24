<?php require_once "authentication-admin.php" ?>
<?php require_once "connection.php" ?>
<?php require_once "configuration.php" ?>
<?php 
	if(!isset($_POST['id'])){
		header("Location: index.php");
	}
?>
<!DOCTYPE html>
<html>
<head>
<meta content="charset=utf-8">
<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<title><?php echo $COM_NAME; ?></title>
	<link rel="stylesheet" href="../css/style.css" type="text/css" media="screen" />

</head>
<body>

  <div id="container">
   <?php require_once "leftbar.php" ?>

	<div id="main">
    <div id="datetime" class="no-print">
		<script type="text/javascript">
		var n = new Date().toLocaleString();
		document.writeln(n);
        </script>
    </div>
        <div class="box">
         <?php
		 $id = $_POST['invID'];
		 $cycle = $_POST['cycle'];
	$month = $_POST['month'];
	$amountpaid = $_POST['amountpaid'];
	$water = $_POST['water'];
	$electricity = $_POST['electricity'];
		
		mysql_select_db("webpro",$con);
		$sql = "UPDATE invoice set cycle ='$cycle', month='$month',water='$water',electricity='$electricity',amountpaid='$amountpaid' WHERE ID = '$id'";
		$sql_query = mysql_query($sql);
		if(	!$sql_query ) {
			echo mysql_error();
		
	}
	
	
	?>
	
	
   <h1 style="text-align:center; margin: 50px 0 0 0;">The invoice has been edited.</h1>
        <p style="text-align:center;">You will be automatically redirected in 2 seconds.</p>
      	<?php
				echo "<meta http-equiv=\"refresh\" content=\"4;url=".$_SERVER['HTTP_REFERER']."\"/>";
		?>

        
 
      </div>
    </div>

  </div>



</html>