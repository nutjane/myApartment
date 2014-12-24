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
			$id = $_GET['ID'];
			mysql_select_db("webpro",$con);
			$result = mysql_query("SELECT * FROM contract WHERE id=$id");
			if($result === FALSE) {
   				 die(mysql_error()); // TODO: better error handling
			}
			//check if it is not true URL value
			$num_rows = mysql_num_rows($result);
			if($num_rows == 0) {header("Location: index.php");} 
			
			$row = mysql_fetch_array($result);
			
			//$row = mysql_fetch_array($result);

		?>
        <h1>Issue new Invoice</h1>
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
       
     

        
        <h2 style="color:#44FF7D;">Previous Invoice</h2>
        <table width="100%" border="1" cellpadding="5" cellspacing="0" style="border-collapse: collapse;" class="data-center" >
        	<tr bgcolor='#CCCCCC'>
            	<th>Cycle</th>
            	<th>Month</th>
                <th>Monthly fee</th>
                <th colspan="2">Water usage</th>
                 <th colspan="2">Electricity usage</th>
                 <th>Total Balance</th>
                 <th>Paid Date</th>
            </tr>
           	<?php
			//mysql_select_db("webpro",$con);
			$result = mysql_query("SELECT * FROM invoice as i, contract as c WHERE  i.contractID = $id  AND i.contractID = c.ID ORDER BY i.ID DESC LIMIT 1");
			if($result === FALSE) {
   				 die(mysql_error()); // TODO: better error handling
			}
			$num_rows = mysql_num_rows($result);
			if($num_rows == 0) {
				echo "<tr><td colspan=10 style='text-align:center;'> - You have no previous invoice -</td><tr>";
			}
			else{
				$row = mysql_fetch_array($result);
				//check about paiddate
				$check = "0000-00-00 00:00:00";
				if($row['paiddate'] == $check) $ans = "UNPAID!";
				else $ans =$row['paiddate'];
				
				echo "<tr>
                <td>".$row['cycle']."</td>
                <td>".$row['month']."</td>
                <td>".$row['monthly_fee']."</td>
                <td>".$row['water']." units</td>
                <td>".$row['water']*$row['fee_w']."$</td>
                <td>".$row['electricity']." units</td>
                <td>".$row['electricity']*$row['fee_e']."$</td>
                <td><b>".$row['amountpaid']."$</b></td>
                <td>".$ans."</td>
                 </tr>";
			}
			if($num_rows!=0){
				//keep value
				$pre_cycle = $row['cycle'];
				$pre_month = $row['month'];
				$month_fee = $row['monthly_fee'];
				$fee_e = $row['fee_e'];
				$fee_w = $row['fee_w'];
			}
			else{
				// if this is the first invoice
				$pre_cycle = 0;
				$pre_month = date("Y")."/".(date("m")-1);
			
				$result = mysql_query("SELECT monthly_fee, fee_e, fee_w FROM contract WHERE id=$id");
				if($result === FALSE) {
					 die(mysql_error()); // TODO: better error handling
				}
				$row = mysql_fetch_array($result);
				$month_fee = $row['monthly_fee'];
				$fee_e = $row['fee_e'];
				$fee_w = $row['fee_w'];
			}
		?>
        
        </table>
          <h2 style="color:#FF9045;">New Invoice Details</h2>
        <form id="newInvoice" name="newInvoice" method="post" action="invoice_added.php" onSubmit="return validateForm();">
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
            	<input name="contractID" value=<?php echo $id; ?> type="hidden">
            	<?php 
				//Month calculator
				$piece = explode("/",$pre_month);
				if($piece[1]<12) $piece[1]++;
				else {
					$piece[0]++;
					$piece[1]="01";
				}
				///add 0 if this month is less than 10
				if($piece[1]<9) $piece[1] = "0".$piece[1];
				?>
            	<td><input type="text" name="cycle" id="cycle" size="5" class="inputs"  value="<?php echo $pre_cycle+1; ?>" readonly="readonly"/></td>
                <td><input type="text" name="month" id="month"  size="7" class="inputs" value="<?php echo $piece[0]."/".$piece[1]; ?>" readonly="readonly"/></td>
                <td><input type="text" name="monthlyfee" id="monthlyfee" size="7" class="inputs" value="<?php echo $month_fee; ?>" readonly="readonly"/></td>
                <td><input type="text" name="water" id="water" size="7" class="inputs" onKeyup="calAll();" required/><span class="require">*</span></td>
                <td><div id="watersum">0 $</div></td>
                <td><input type="text" name="electricity" id="electricity" size="7" class="inputs" onKeyup="calAll();" required/><span class="require">*</span></td>
      			<td><div id="eleSUM">0 $</div></td>
                <td><input type="text" name="amountpaid" id="amountpaid" class="inputs" size="10" readonly="readonly"></td>
                <td><input type="submit" class="button green" value="ISSUE"> <a class="button yellow" href="javascript:window.history.back()">Cancle</a></td>
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
			else return true;
			
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


</html>