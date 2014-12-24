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

	
        <table style="width:100%;" class="no-print">
            <tr>
            	<td style="padding-top:0px;"> <h1>Invoice</h1></td>
                <td style="padding-top:0px; text-align:right;"> <span class="highlight" style="font-size:24px; background-color:#FF2424;">&nbsp;UNPAID&nbsp;</span></td>
            </tr>
        </table>
      <?php
		 	$id = $_GET['ID'];
			mysql_select_db("webpro",$con);
			$result = mysql_query("SELECT *,i.ID as InvID FROM invoice as i, contract as c WHERE  i.ID = $id  AND i.contractID = c.ID AND i.status = '0'");
			if($result === FALSE) {
   				 die(mysql_error()); // TODO: better error handling
			}
			
			$num_rows = mysql_num_rows($result);
			if($num_rows == 0) {header("Location: index.php");} //check if it is not true URL value
			
			$row = mysql_fetch_array($result);
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
            <td>Date: <strong><?php echo $row['dateissue']; ?></strong></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>Invoice ID: <strong><?php echo $row['InvID']; ?></strong></td>
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
			$Date1 = $row['dateissue'];
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
            <td>For the month: <span class="highlight"><strong>&nbsp;<?php echo $row['month']; ?>&nbsp;</strong></span></td>
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
            <td>Monthly Fee of <?php echo $row['month']; ?> ( cycle: <?php echo $row['cycle']; ?> )</td>
            <td><?php echo $row['monthly_fee']; ?></td>
          </tr>
          <tr>
            <td>Water Fee - <?php echo $row['water']; ?> Units</td>
            <td><?php echo $row['fee_w']*$row['water']; ?></td>
          </tr>
          <tr>
            <td>Electricity Fee - <?php echo $row['electricity']; ?> Units</td>
            <td><?php echo $row['fee_e']*$row['electricity']; ?></td>
          </tr>
          <tr>
            <td>Subtotal</td>
            <td><strong><?php echo $row['amountpaid']; ?></strong></td>
          </tr>
        </table>
		<p>Please pay within 15 days after issue.<br>Please pay by Web Payment Gateway (Credit card) or pay by cash at lobby.<br/> To pay by Web Payment Gateway, please login to our system and proceed the payment.
        <br><br>For any mistakes, please contact Department of Finance - Call 02-4961753 or Call 275 by the intra-phone.</p>
    </td>
  </tr>
  </table>       
	<p align="center" class="no-print"><a class="button green" href="javascript:window.print()"><img src='../images/printer.gif'></a> 
    <a class="button green" href="javascript:history.go(-1)">Back</a></p>
        
	      
         
      </div>
    </div>

  </div>




</html>