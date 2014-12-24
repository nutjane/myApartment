<?php require_once "admin/configuration.php" ?>
<!DOCTYPE html>
<html>
<head>

	<meta content="charset=utf-8">
	<title><?php echo $COM_NAME; ?></title>
	<link rel="stylesheet" href="css/style.css" type="text/css" media="screen" />
	<style>
    body{
		background-image:url(images/bg2.jpg);
		background-position:center top;
	}
    </style>
    <meta http-equiv=Content-Type content="text/html; charset=utf-8">
   
</head>
<body>

  <div id="container">
    <?php require_once "leftbar.php" ?>

	<div id="main">
    <div id="datetime" style="color:#666;">
		<script type="text/javascript">
		var n = new Date().toLocaleString();
		document.writeln(n);
        </script>
    </div>
        <div class="box">
       
        <form action="login_check.php" method="post">
        <table width="100%">
            <tr>
                <td><h2>USERNAME</h2></td>
                <td><input type="text" id="user78" name="user78" class="inputs" style="font-size:24px;" required></td>
            
                <td><h2>PASSWORD</h2></td>
                <td><input type="text" id="pass98" name="pass98" class="inputs" style="font-size:24px;" required></td>
            	<td><input type="submit" class="button green" value="LOGIN" style="font-size:17px;"></td>
                <td><input name="Reset" type="reset" class="button yellow" value="CLEAR" style="font-size:17px;">   </td>
            </tr>
        </table>
        </form>
        
        
      </div>
    </div>

  </div>




</body>
</html>