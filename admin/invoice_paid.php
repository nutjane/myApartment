<?php require_once "authentication-admin.php";
 	require_once "connection.php";
 	require_once "configuration.php";

	if(!isset($_POST['ID'])){
		header("Location: index.php");
	}
?>
<!DOCTYPE html>
<html>
<head>

	<meta content="charset=utf-8">
	<title><?php echo $COM_NAME; ?></title>
	<link rel="stylesheet" href="../css/style.css" type="text/css" media="screen" />

    <meta http-equiv=Content-Type content="text/html; charset=utf-8">
   
</head>
<body>

  <div id="container">
    <?php require_once "leftbar.php" ?>

	<div id="main">
    <div id="datetime">
		<script type="text/javascript">
		var n = new Date().toLocaleString();
		document.writeln(n);
        </script>
    </div>
        <div class="box">
     
      <?php
			$id = $_POST['ID'];
			
			//get time stamp
			
			$timestamp = date("Y-m-d H:i:s",time());
			//echo $timestamp;
			
			mysql_select_db("webpro",$con);
			$sql = "UPDATE invoice set status='1', paiddate = '$timestamp' WHERE ID = '$id'";
			$sql_query = mysql_query($sql);
			
			
			
			if(	!$sql_query ) {
				echo mysql_error();
			}
		?>
        <h1 style="text-align:center; margin: 50px 0 0 0;">The invoice has been set to PAID.</h1>
        <p style="text-align:center;">You will be automatically redirected in 2 seconds.</p>
      	<?php
				echo "<meta http-equiv=\"refresh\" content=\"2;url=".$_SERVER['HTTP_REFERER']."\"/>";
		?>
      
      </div>
    </div>

  </div>


<?php mysql_close($con); ?>
</html>