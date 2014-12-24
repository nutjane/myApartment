<?php require_once "authentication-admin.php";
 	require_once "connection.php";
 	require_once "configuration.php";

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

    
</head>
<body onLoad="calAll();">

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
			$id = $_GET['ID'];
			mysql_select_db("webpro",$con);
			$result = mysql_query("SELECT * FROM invoice as i, contract as c WHERE i.ID=$id AND i.status = '0' AND i.contractID = c.ID");
			if($result === FALSE) {
   				 die(mysql_error()); // TODO: better error handling
			}
			//check if it is not true URL value
			$num_rows = mysql_num_rows($result);
			if($num_rows == 0) {header("Location: index.php");} 
			
			$row = mysql_fetch_array($result);
			$fee_e = $row['fee_e'];
			$fee_w = $row['fee_w'];
			$month_fee = $row['monthly_fee'];
			//$row = mysql_fetch_array($result);

		?>
        <h1>Edit Invoice</h1>
     <table class="simple">
          <tr>
            <td>Contract ID: <b><?php echo $row['ID']; ?></b></td>
            <td>Start from: <b><?php echo $row['start']; ?></b></td>
            <td rowspan="3">ROOM:<br><span class="roomNumber"><?php echo $row['room']; ?></span></td>
          </tr>
          <tr>
            <td>Name: <b><?php echo $row['name']." ".$row['surname']; ?></b></td>
           <td>Citizen ID:  <b><?php echo $row['thaiID']; ?></b></td>
            
          </tr>
          <tr>
            <td>Tel: <b><?php echo $row['tel']; ?></b></td>
            <td>Address:  <b><?php echo $row['address']; ?></b></td>
          </tr>
          <tr>
            <td>Water fee: <b><?php echo $row['fee_w']; ?>$</b> (per unit)</td>
            <td>Elecrticity fee:  <b><?php echo $row['fee_e']; ?>$</b> (per unit)</td>
          </tr>
           <tr>
            <td>Monthly fee: <b><?php echo $row['monthly_fee']; ?>$</b></td>
            <td></td>
          </tr>
          
        </table>  

          <h2 style="color:#FF9045;"> Invoice Details</h2>
        <form id="newInvoice" name="newInvoice" method="post" action="invoice_edit_success.php"  onSubmit="return validateForm();">
		<table class="simple">
        	<tr>
            	<th>Cycle</th>
            	<th>Month</th>
                <th>Monthly fee</th>
                <th colspan="2">Water usage</th>
                 <th colspan="2">Electricity usage</th>
                 <th>Total Balance</th>
                 <th> </th>
                
            </tr>
            <tr >
            	
            	<input name="invID" value=<?php echo $id; ?> type="hidden">
            	<td><input type="text" name="cycle" id="cycle" size="5" class="inputs"  value="<?php echo $row['cycle'] ?>" required /><span class="require">*</span></td>
                <td><input type="text" name="month" id="month"  size="7" class="inputs" value="<?php echo $row['month'] ?>" required/><span class="require">*</span></td>
                <td><input type="text" name="monthlyfee" id="monthlyfee" size="7" class="inputs" value="<?php echo $row['monthly_fee'] ?>" readonly/></td>
                <td><input type="text" name="water" id="water" size="7" class="inputs" onKeyup="calAll();" value="<?php echo $row['water'] ?>" required/><span class="require">*</span></td>
                <td><div id="watersum">0 $</div></td>
                <td><input type="text" name="electricity" id="electricity" size="7" class="inputs" onKeyup="calAll();" value="<?php echo $row['electricity'] ?>" required/>
                	<span class="require">*</span></td>
      			<td><div id="eleSUM">0 $</div></td>
                <td><input type="text" name="amountpaid" id="amountpaid" class="inputs" size="10" value="<?php echo $row['amountpaid'] ?>"; readonly="readonly"></td>
                <td><input type="submit" class="button red" value="EDIT"> <a class="button green" href="javascript:window.history.back()">Cancle</a></td>
            </tr>
            <tr>
            	<td colspan="8"><span style=" color:red; font-size:12px; font-style:italic;">* These fields are required.</span></td>
            </tr>
         </table>
		</form>
        
      </div>
    </div>

  </div>
<script type="text/javascript">
function validateForm(){
			var reexp = /^\d+$/;
			if(document.getElementById("water").value=="" || !document.getElementById("water").value.match(reexp)){
				window.alert("Please fill Water usage");
				return false;
			}
			else if(document.getElementById("electricity").value=="" || !document.getElementById("electricity").value.match(reexp)){
				window.alert("Please fill Electricity usage");
				return false;
			}
			else if(document.getElementById("cycle").value=="" || !document.getElementById("cycle").value.match(reexp)){
				window.alert("Please fill Electricity usage");
				return false;
			}
			else if(document.getElementById("month").value==""){
				window.alert("Please fill the month");
				return false;
			}
			else return confirm('Edit this invoice?');
			
}

function calAll()
	{
		var fee_e =  <?php echo $fee_e ?>;
		var fee_w =  <?php echo $fee_w ?>;
		var value = document.getElementById("water").value*fee_w;
		document.getElementById("watersum").innerHTML = value + " $";
		var value2 = document.getElementById("electricity").value * fee_e;
		document.getElementById("eleSUM").innerHTML = value2 + " $";
		document.getElementById("amountpaid").value = value + value2 + <?php echo $month_fee ?>;
	}

</script>

<?php mysql_close($con); ?>

</html>