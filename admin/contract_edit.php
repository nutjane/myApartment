<?php require_once "authentication-admin.php" ?>
<?php require_once "connection.php" ?>
<?php require_once "configuration.php" ?>
<?php 
	if(!isset($_GET['ID'])){
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

        <h1>Edit Contract</h1>
        <p>Please note that you cannot edit contact ID (Contract No.) and the issue date of this contract.<br><span class="require">Changes in any fees will not effect the previous invoices.</span></p>
          <?php
		
			$id = $_GET['ID'];
			
			mysql_select_db("webpro",$con);
			$result = mysql_query("SELECT * FROM contract WHERE id=$id AND status = '1'");
			if($result === FALSE) {
   				 die(mysql_error()); // TODO: better error handling
			}
			//check if it is not true URL value
			$num_rows = mysql_num_rows($result);
			if($num_rows == 0) {header("Location: index.php");} 
			$row = mysql_fetch_array($result);
		?>
        
         <form id="newContract" name="newContract" method="post" action="contract_edit_success.php" onSubmit="return validateForm();">
      <table class="simple">
          <tr>
            <td>Contract ID: <b><?php echo $id;?><input name="id" type="hidden" value="<?php echo $id;?>"></b></td>
            <td>Start from: <b><?php echo $row['start']; ?></b></td>
            <td rowspan="3">ROOM:<br><input type="text" id="room" name="room" class="inputs" value="<?php echo $row['room']; ?>" required> </td>
          </tr>
          <tr>
            <td>Name: <input type="text" id="name" name="name" class="inputs" value="<?php echo $row['name']; ?>" required>
            <input type="text" id="surname" name="surname" class="inputs" value="<?php echo $row['surname']; ?>" required></td>
           <td>Citizen ID:  <input type="text" id="thaiID" name="thaiID" class="inputs" value="<?php echo $row['thaiID']; ?>" required></td>
            
          </tr>
          <tr>
            <td>Tel: <input type="text" id="tel" name="tel" class="inputs" value="<?php echo $row['tel']; ?>" required></td>
            <td>Address:  <input type="text" id="address" name="address" class="inputs" value="<?php echo $row['address']; ?>" required></td>
          </tr>
          <tr>
            <td>Water fee: <input type="text" id="fee_w" name="fee_w" class="inputs"  size="5" value="<?php echo $row['fee_w']; ?>" required> (per unit)</td>
            <td>Elecrticity fee: <input type="text" id="fee_e" name="fee_e" class="inputs"  size="5" value="<?php echo $row['fee_w']; ?>" required> (per unit)</td>
          </tr>
           <tr>
            <td>Monthly fee:  <input type="text" id="monthly_fee" name="monthly_fee" class="inputs"  value="<?php echo $row['monthly_fee']; ?>" size="5" required></td>
            <td></td>
          </tr>
          
        </table>  
        <p align="center"><input type="submit" class="button green" value="CHANGE" >&nbsp;&nbsp;<a class="button yellow" href="javascript:window.history.back()">Cancle</a></p>   
	</form>
       
      </div>
    </div>

  </div>
<script type="text/javascript">

function validateForm(){
			
			var reexp = /^\d+$/;
			if(document.getElementById("room").value=="" || !document.getElementById("room").value.match(reexp)){
				window.alert("Can't find room number.");
				return false;
			}
			else if(document.getElementById("name").value==""){
				window.alert("Please fill Name");
				return false;
			}
			else if(document.getElementById("surname").value==""){
				window.alert("Please fill Name");
				return false;
			}
			else if(document.getElementById("thaiID").value=="" || !document.getElementById("thaiID").value.match(reexp)){
				window.alert("Please fill the citizen ID");
				return false;
			}
			else if(document.getElementById("tel").value=="" || !document.getElementById("tel").value.match(reexp)){
				window.alert("Please fill telephone number");
				return false;
			}
			else if(document.getElementById("fee_w").value=="" || !document.getElementById("fee_w").value.match(reexp)){
				window.alert("Please fill water fee");
				return false;
			}
			else if(document.getElementById("monthly_fee").value=="" || !document.getElementById("monthly_fee").value.match(reexp)){
				window.alert("Please fill monthly fee");
				return false;
			}
			else if(document.getElementById("fee_e").value=="" || !document.getElementById("fee_e").value.match(reexp)){
				window.alert("Please fill Electricity fee");
				return false;
			}
			else if(document.getElementById("address").value==""){
				window.alert("Please fill Address");
				return false;
			}
			else return confirm('I have checked all of information above.');
			
}

</script>


</html>