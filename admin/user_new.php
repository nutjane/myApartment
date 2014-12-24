<?php require_once "authentication-admin.php";
 	require_once "connection.php";
 	require_once "configuration.php";
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
     
     
        <h1>Create new user</h1>

        <form id="newUser" name="newUser" method="post" action="user_added.php" onSubmit="return validateForm();">
		<table class="simple">
        	<tr>
            	<th width="60px;">NAME</th>
                <td><input type="text" name="user" id="user" class="inputs" required>*</td>
            </tr>
            <tr>
            	<th>PASSWORD (Citizen ID)</th>
                <td><input type="text" name="pass" id="pass" class="inputs"  required>*</td>
            </tr>
            <tr>
            	<th>ROLE</th>
                <td><input type="text" name="role" id="role" class="inputs" required/>* <br><span style="font-size:13px;">ADMIN fill ADMIN <br>USER fill his/her contract ID</span></td>
            </tr>
             <tr>
            	<td colspan="2"><span style=" color:red; font-size:12px; font-style:italic;">* These fields are required.</span></td>
            </tr>
            <tr>
            	<td colspan="2"> <input type="submit" class="button green" value="CREATE"> <a class="button yellow" href="javascript:window.history.back()">Cancle</a></td>
            </tr>
    
           
         </table>
		</form>
        
      </div>
    </div>

  </div>
<script type="text/javascript">
function validateForm(){
			var reexp = /^\d+$/;
			if(document.getElementById("user").value==""){
				window.alert("Please fill username");
				return false;
			}
			else if(document.getElementById("pass").value=="" || !document.getElementById("pass").value.match(reexp)){
				window.alert("Please fill the correct password");
				return false;
			}
			else if(document.getElementById("rold").value=="" ){
				window.alert("Please fill the role");
				return false;
			}
			else return confirm('Are you sure to add this user?');
			
}


</script>


</html>