<?php require_once "authentication-admin.php" ?>
<?php require_once "connection.php" ?>
<?php require_once "configuration.php" ;
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
			$num_rows = mysql_num_rows($result);
			if($num_rows == 0) {header("Location: index.php");} //check if it is not true URL value
			$row = mysql_fetch_array($result);
			
			//$row = mysql_fetch_array($result);
	
			
		?>
       <table style="width:100%;">
            <tr>
            	<td style="padding-top:0px;"> <h1>Contract info</h1></td>
                <td style="padding-top:0px; text-align:right;"> <span class="highlight" style="font-size:24px; background-color:#FF2424;">&nbsp;TERMINATED&nbsp;</span></td>
            </tr>
        </table>
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
            <td>Terminated date: <b><?php echo $row['terminatedate']; ?></b></td>
          </tr>
          
        </table>          
            

        <h2 style="color:#44FF7D;">Invoices (Paid)</h2>
        <table width="100%" border="1" cellpadding="5" cellspacing="0" style="border-collapse: collapse;" class="data-center" >
        	<tr bgcolor='#CCCCCC'>
            	<th>Cycle</th>
            	<th>Month</th>
                <th>Monthly fee</th>
                <th colspan="2">Water usage</th>
                 <th colspan="2">Electricity usage</th>
                 <th>Total Balance</th>
                 <th width="50px">*</th>
            </tr>
             	<?php
			$result = mysql_query("SELECT *,i.ID as InvID FROM invoice as i, contract as c WHERE  i.contractID = $id  AND i.contractID = c.ID AND i.status=1");
			if($result === FALSE) {
   				 die(mysql_error()); // TODO: better error handling
			}
			$num_rows = mysql_num_rows($result);
			if($num_rows == 0) {
				echo "<tr><td colspan=10 style='text-align:center;'> - This contract has no invoice. -</td><tr>";
			}
			else{
				while($row = mysql_fetch_array($result)){
                    echo "<tr>
                <td>".$row['cycle']."</td>
                <td>".$row['month']."</td>
                <td>".$row['amountpaid']."</td>
                <td>".$row['water']."</td>
                <td>".$row['water']*$row['fee_w']."</td>
                <td>".$row['electricity']."</td>
                <td>".$row['electricity']*$row['fee_e']."</td>
                <td><b>".$row['amountpaid']."</b></td>
                <td>"; ?><a href='invoice_view_receipt.php?ID=<?php echo $row['InvID']; ?>'><img src='../images/printer.gif'></a>  </td>
                 </tr>
                
                 <?php
				}
			}
			mysql_close($con);
		?>
        </table>
        <br><br><center> <a class="button green" href="javascript:window.history.back()">Back</a></center>
      </div>
    </div>

  </div>




</body>
</html>