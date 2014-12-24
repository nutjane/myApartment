<?php require_once "authentication-admin.php";
 	require_once "connection.php";
 	require_once "configuration.php";

	if(!isset($_POST['user'])){
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
    <style type="text/css">
    body,td,th {
        font-family: Helvetica, Arial, sans-serif;
    }
    </style>
    
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
			$name = $_POST['user'];
			$thaiid = $_POST['pass'];
			$role = $_POST['role'];
			mysql_select_db("webpro",$con);
			$sqluser = "INSERT INTO user set user='$name', pass='$thaiid', role='$role'";
			$sql_query = mysql_query($sqluser);
			if(	!$sql_query ) {
				echo mysql_error();
			}

		?>
        <h1 style="text-align:center; margin: 50px 0 0 0;">The user has been created.</h1>
        <p style="text-align:center;">You will be automatically redirected.</p>
      	<?php
			header( "refresh:3; url=alluser.php" ); 
			
		?>
      </div>
    </div>

  </div>


<?php mysql_close($con); ?>
</html>