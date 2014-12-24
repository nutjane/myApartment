<?php require_once "authentication-admin.php"; ?>
<?php require_once "connection.php"; ?>
<?php require_once "configuration.php";

if(!isset($_POST['contractID '])){
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
   	<link rel="stylesheet" href="../css/print.css" type="text/css" media="print" />

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
	$cycle = $_POST['cycle'];
	$contractID = $_POST['contractID'];
	$month = $_POST['month'];
	$amountpaid = $_POST['amountpaid'];
	$water = $_POST['water'];
	$electricity = $_POST['electricity'];
	if(!isset($_POST['cycle'])){
		header("Location: index.php");
	}
	else{
		mysql_select_db("webpro",$con);
		$sql = "INSERT INTO invoice set contractID = '$contractID', cycle='$cycle', month='$month', amountpaid='$amountpaid', water='$water', electricity='$electricity'";
		$sql_query = mysql_query($sql);
	}
	
	if(	!$sql_query ) {
		echo mysql_error();
	}
	else { //start ?> 
	
        <h1 class="no-print">New Invoice has been added.</h1>	
        <h3 class="no-print">Please print out this invoice to your customer.</h3>	
         <?php
			mysql_select_db("webpro",$con);
			$result = mysql_query("SELECT * FROM contract WHERE id=$contractID");
			if($result === FALSE) {
   				 die(mysql_error()); // TODO: better error handling
			}
			$row = mysql_fetch_array($result);
			
			
			$result2 = mysql_query("SELECT * FROM invoice ORDER BY ID DESC LIMIT 1");
			if($result2 === FALSE) {
   				 die(mysql_error()); // TODO: better error handling
			}
			$row2 = mysql_fetch_array($result2);
			mysql_close($con);
			
		?>
        
 
  <table style="" class="center print">
  <tr>
  <td style="padding:15px;">
  
             
                <table width="100%" border="0">
          <tr>
            <td width="25%"><strong><?php echo $COM_NAME; ?></strong></td>
            <td width="25%">&nbsp;</td>
            <td width="25%">&nbsp;</td>
            <td width="25%" rowspan="2"><h1 style="margin:0px;">INVOICE</h1></td>
          </tr>
          <tr>
            <td><?php echo $COM_ADDRESS; ?></td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td><?php echo $COM_TELL; ?></td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>Room No.: <span class="highlight"><strong>&nbsp;<?php echo $row['room']; ?>&nbsp;</strong></span></td>
          </tr>
          <tr>
            <td><?php echo $COM_FAX; ?></td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>Date: <strong><?php echo $row2['dateissue']; ?></strong></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>Invoice ID: <strong><?php echo $row2['ID']; ?></strong></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>Contract ID: <b><?php echo $row['ID']; ?></b></td>
          </tr>
          <tr>
            <td>To:</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
 			<?php 
			//Due date calculation
			$Date1 = $row2['dateissue'];
			$due = date('Y-m-d', strtotime($Date1 . " + 15 day"));
			?>
            <td>Due date: <strong><?php echo $due; ?></strong></td>
          </tr>
          <tr>
            <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b><?php echo $row['name']." ".$row['surname']; ?></b></td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b><?php echo $row['thaiID']; ?></b></td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>For the month: <span class="highlight"><strong>&nbsp;<?php echo $row2['month']; ?>&nbsp;</strong></span></td>
          </tr>
          <tr>
            <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b><?php echo $row['address']; ?></b></td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b><?php echo $row['tel']; ?></b></td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
        </table>
        <br/>
        <table width="100%" border="1" cellpadding="3" cellspacing="0" style="border-collapse: collapse;">
          <tr>
            <td width="70%" bgcolor="#CCCCCC"><strong>Description</strong></td>
            <td width="30%" bgcolor="#CCCCCC"><strong>Amount</strong></td>
          </tr>
          <tr>
            <td>Monthly Fee of <?php echo $row2['month']; ?> ( cycle: <?php echo $row2['cycle']; ?> )</td>
            <td><?php echo $row['monthly_fee']; ?></td>
          </tr>
          <tr>
            <td>Water Fee - <?php echo $row2['water']; ?> Units</td>
            <td><?php echo $row['fee_w']*$row2['water']; ?></td>
          </tr>
          <tr>
            <td>Electricity Fee - <?php echo $row2['electricity']; ?> Units</td>
            <td><?php echo $row['fee_e']*$row2['electricity']; ?></td>
          </tr>
          <tr>
            <td>Subtotal</td>
            <td><strong><?php echo $row2['amountpaid']; ?></strong></td>
          </tr>
        </table>
		<p>Please pay within 15 days after issue.<br>
        Please pay by Web Payment Gateway (Credit card) or pay by cash at lobby.<br/> To pay by Web Payment Gateway, please login to our system and proceed the payment.
        <br><br>For any mistakes, please contact Department of Finance - Call 02-4961753 or Call 275 by the intra-phone.</p>
    </td>
  </tr>
  </table>       
	<p align="center" class="no-print"><a class="button green" href="javascript:window.print()">Print</a> <a class="button green" href="roomInfo.php?ID=<?php echo $row['ID']; ?>">Back</a></p>
        
	<?php } //end ?>
       
         
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