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
			$monthly_fee =  $row['monthly_fee'];
			
		?>
       <table style="width:100%;">
            <tr>
            	<td style="padding-top:0px;"> <h1>Contract info</h1></td>
                <td style="padding-top:0px; text-align:right;"> <span class="highlight" style="font-size:24px; background-color:#4F8954;">&nbsp;ACTIVE&nbsp;</span></td>
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
            <td></td>
          </tr>
          
          
        </table>          
        <div style="margin:20px 0;"><a class="button green" href="invoice_new.php?ID=<?php echo $row['ID']; ?>">ISSUE INVOICE</a>&nbsp;
        <a class="button green" href="contract_edit.php?ID=<?php echo $row['ID']; ?>">EDIT CONTRACT INFO</a>&nbsp;
         <a  class="button green" href='contract_view.php?ID=<?php echo $row['ID']; ?>'>VIEW CONTRACT LETTER</a>&nbsp;
         <a class="button red" href="contract_delete.php?ID=<?php echo $row['ID']; ?>">END CONRACT</a>&nbsp;
        
         </div>
     

        
        <h2 style="color:#FF4444;">Unpaid invoices</h2>
        <table width="100%" border="1" cellpadding="5" cellspacing="0" style="border-collapse: collapse;" class="data-center" >
        	<tr bgcolor='#CCCCCC'>
            	<th>Cycle</th>
            	<th>Month</th>
                <th>Monthly fee</th>
                <th colspan="2">Water usage</th>
                 <th colspan="2">Electricity usage</th>
                 <th>Balance</th>
                 <th>Due date</th>
                 <th>*</th>
            </tr>
            
           	<?php
			//mysql_select_db("webpro",$con);
			$result = mysql_query("SELECT *,i.ID as InvID FROM invoice as i, contract as c WHERE  i.contractID = $id  AND i.contractID = c.ID AND i.status=0");
			if($result === FALSE) {
   				 die(mysql_error()); // TODO: better error handling
			}
			$num_rows = mysql_num_rows($result);
			if($num_rows == 0) {
				echo "<tr><td colspan=10 style='text-align:center;'> - This contract has no unpaid invoice. -</td><tr>";
			}
			else{
				while($row = mysql_fetch_array($result)){
					          
			//Due date calculation
			$Date1 = $row['dateissue'];
			$due = date('Y-m-d', strtotime($Date1 . " + 15 day"));
			
			//Ramain date calculation
			$now = date('Y-m-d');		
			$datediff = strtotime($due) - strtotime($now);
     		$due_ramain = floor($datediff/(60.0*60.0*24.0));

			if($due_ramain < '0') $dueall = "<span class='highlight' style='background-color:#FA4B23;'>&nbsp;".$due."&nbsp;(+".abs($due_ramain).")&nbsp;</span> ";
			else $dueall = $due." <font color='#13668F'>(".$due_ramain.")</font>";
						
					echo "<tr>
                <td>".$row['cycle']."</td>
                <td>".$row['month']."</td>
                <td>".$CURRENCY.$monthly_fee."</td>
                <td>".$row['water']."</td>
                <td>".$CURRENCY.$row['water']*$row['fee_w']."</td>
                <td>".$row['electricity']."</td>
                <td>".$CURRENCY.$row['electricity']*$row['fee_e']."</td>
                <td><b>".$CURRENCY.$row['amountpaid']."</b></td>
				 <td>".$dueall."</td>
                "; ?> <td style="font-size:13px;">
				<form name="delete" method='post' action='invoice_paid.php' onSubmit="return confirm('Mark as PAID?');">
        <input name='ID' type='hidden' value='<?php echo $row['InvID']; ?>'>
		 <input type='submit' class='button green' value='PAID'>
          <a class='button green' href='invoice_edit.php?ID=<?php echo $row['InvID']; ?>'>EDIT</a>&nbsp;
          <a class='button green' href='invoice_view.php?ID=<?php echo $row['InvID']; ?>'>VIEW</a>
          
         </form>  
		</td>
                 </tr>
                 <?php   } } ?>
           

        </table>
          <p class="no-print">Remark: 
          <span class="highlight" style="background-color:#33B3F3;">&nbsp;(x)&nbsp;</span>: x is the number of day until due date. &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          <span class="highlight" style="background-color:#FA4B23;">&nbsp;????-??-??&nbsp;</span>: invoice is overdue.

          </p>
        
        <h2 style="color:#44FF7D;">Previous invoices (Paid)</h2>
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
				echo "<tr><td colspan=10 style='text-align:center;'> - This contract has no paid invoice. -</td><tr>";
			}
			else{
				while($row = mysql_fetch_array($result)){
                    echo "<tr>
                <td>".$row['cycle']."</td>
                <td>".$row['month']."</td>
                <td>".$CURRENCY.$monthly_fee."</td>
                <td>".$row['water']."</td>
                <td>".$CURRENCY.$row['water']*$row['fee_w']."</td>
                <td>".$row['electricity']."</td>
                <td>".$CURRENCY.$row['electricity']*$row['fee_e']."</td>
                <td><b>".$CURRENCY.$row['amountpaid']."</b></td>
                <td>"; ?><a href='invoice_view_receipt.php?ID=<?php echo $row['InvID']; ?>'><img src='../images/printer.gif'></a>  </td>
                 </tr>
                
                 <?php
				}
			}
			mysql_close($con);
		?>
        </table>
      </div>
    </div>

  </div>




</body>
</html>