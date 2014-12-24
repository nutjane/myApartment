<?php require_once "authentication-admin.php" ?>
<?php require_once "connection.php" ?>
<?php require_once "configuration.php" ?>
<?php 
	if(!isset($_POST['id'])){
		header("Location: index.php");
	}
?><!DOCTYPE html>
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
		 $id = $_POST['id'];
	$room = $_POST['room'];
	$name = $_POST['name'];
	$surname = $_POST['surname'];
	$thaiid = $_POST['thaiID'];
	$tel = $_POST['tel'];
	$address = $_POST['address'];
	$fee_w = $_POST['fee_w'];
	$fee_e = $_POST['fee_e'];
	$monthly_fee = $_POST['monthly_fee'];
	if(isset($_POST['room'])){
		mysql_select_db("webpro",$con);
		$sql = "UPDATE contract set fee_e = '$fee_e', fee_w='$fee_w', room='$room', monthly_fee='$monthly_fee', name='$name', surname='$surname', tel='$tel', address='$address', thaiID='$thaiid' WHERE ID = '$id'";
		$sql_query = mysql_query($sql);
		if(	!$sql_query ) {
			echo mysql_error();
		}
	}
	
	

	mysql_select_db("webpro",$con);
	$result = mysql_query("SELECT ID,start FROM contract WHERE ID='$id'");
	if($result === FALSE) {
   		 die(mysql_error()); // TODO: better error handling
	}
	$row = mysql_fetch_array($result);
	?>
	
	
   <h2 class="no-print">The contract details have been updated.<br>Please print out this contract and sign by both parties again.</h2>	

        
 
  <table style="" class="center print">
  <tr>
  <td style="padding:15px;">
  <table width="100%" border="1" cellpadding="5" cellspacing="0" class="print2">
  <tr>
    <td colspan="5" align="center"><span style="font-size:17px; font-weight:bold;">SUBLEASE AGREEMENT FOR<br />
A RESIDENTIAL APARTMENT<br/>CONTRACT No.<?php echo $row['ID']; ?></span></td>
  </tr>
  <tr>
    <td>Information</td>
    <td colspan="4">Subletting an apartment means that the holder of the master lease lets his/her apartment to another person for
      independent use. To sublet an apartment always requires prior permission from the property owner. To sublet an apartment without prior permission constitutes grounds
    for termination of the sublease agreement.</td>
  </tr>
  <tr>
    <td rowspan="4">Landlord<br />
      (The holder of the head lease)</td>
    <td colspan="2">Name: <?php echo $COM_LANLORD_NAME; ?></td>
    <td colspan="2">Personal identity number: <?php echo $COM_LANLORD_ID; ?></td>
  </tr>
  <tr>
    <td colspan="4">Phone number: <?php echo $COM_TELL; ?></td>
  </tr>
  <tr>
    <td colspan="4">Address during the tenancy: <?php echo $COM_ADDRESS; ?></td>
  </tr>
  <tr>
    <td colspan="4">E‐mail / Website: <?php echo $COM_WEBSITE; ?></td>
  </tr>
  <tr>
    <td rowspan="3">Tenant<br />
      (The person/persons to sublease the apartment)</td>
    <td colspan="2">Name: <strong><?php echo $name; ?> <?php echo $surname; ?></strong></td>
    <td colspan="2">Personal identity number: <strong><?php echo $thaiid; ?></strong></td>
  </tr>
  <tr>
    <td colspan="4">Phone number: <strong><?php echo $tel; ?></strong></td>
  </tr>
  <tr>
    <td colspan="4">Address during the tenancy: <strong><?php echo $address; ?></strong></td>
  </tr>
  
  <tr>
    <td rowspan="5">Apartment to be sublet</td>
    <td colspan="4">The landlord rents to the tenant, for residential purposes, the following apartment:</td>
  </tr>
  <tr>
    <td height="26" colspan="4">Number of room in the Apartment: <strong>ROOM <?php echo $room; ?></strong></td>
  </tr>
  <tr>
    <td colspan="4">Street address: <?php echo $COM_ADDRESS; ?></td>
  </tr>
  <tr>
    <td colspan="4" style="border-bottom-style: none;">To the apartment belongs:</td>
  </tr>
  <tr>
    <td style="border-top-style:none;">Attic storage no.: -</td>
     <td style="border-top-style:none;">Basement storage no.: -</td>
     <td style="border-top-style:none;">Parking space no.: -</td>
     <td style="border-top-style:none;">Bicycle space no.: -</td>
  </tr>
  <tr>
    <td bgcolor="#CCCCCC">&nbsp;</td>
    <td colspan="4" bgcolor="#CCCCCC">That rent </td>
  </tr>
  <tr>
    <td>Rent</td>
    <td colspan="4">Rent is payable at SEK <u><strong>&nbsp;<?php echo $CURRENCY; ?><?php echo $monthly_fee; ?>&nbsp;</strong></u> per month.  </td>
  </tr>
  <tr>
    <td>Electricity</td>
    <td colspan="4">Electricity  Is included in the rent  Is not included in the rent<br />
    The tenant shall pay for his/her own electricity  through payment to the landlord at SEK <u><strong>&nbsp;<?php echo $CURRENCY; ?><?php echo $fee_e; ?>&nbsp;</strong></u> per month.</td>
  </tr>
  <tr>
    <td>Water</td>
    <td colspan="4">Electricity  Is included in the rent  Is not included in the rent<br />
The tenant shall pay for his/her own electricity  through payment to the landlord at SEK <u><strong>&nbsp;<?php echo $CURRENCY; ?><?php echo $fee_w; ?>&nbsp;</strong></u> per month.</td>
  </tr>
  <tr>
    <td bgcolor="#CCCCCC">&nbsp;</td>
    <td colspan="4" bgcolor="#CCCCCC">How the rent shall be paid</td>
  </tr>
  <tr>
    <td>Payment of rent</td>
    <td colspan="4">The tenant shall, no later than the last weekday of the month, pay the rent and any additions to the landlord.<br />
    Payment is to be made in cash or credit card to the Landlord against receipt</td>
  </tr>
  <tr>
    <td>Reminder to pay</td>
    <td colspan="4"> Late payments will be subjected to a reminder fee for written notice as determined by law.  </td>
  </tr>
  <tr>
    <td bgcolor="#CCCCCC">&nbsp;</td>
    <td colspan="4" bgcolor="#CCCCCC">Period of validity and the agreement's prolongation</td>
  </tr>
  <tr>
    <td>Period of validity<br />
      and the<br />
      agreement's<br />
    prolongation</td>
    <td colspan="4">The agreement is valid from <?php echo $row['start']; ?> and until further notice.  <br />
      The sublease agreement will terminate at the end of the month directly three (3) months after notice has been<br />
    given.</td>
  </tr>
  <tr>
    <td bgcolor="#CCCCCC">&nbsp;</td>
    <td colspan="4" bgcolor="#CCCCCC">Defects and damages</td>
  </tr>
  <tr>
    <td>Defects and<br />
    damages</td>
    <td colspan="4">No later than the day when access to the apartment is given to the tenant a list (appendix 2) of defects and<br />
      damages shall be drawn up. This appendix shall be drawn up in two identical copies, each signed by both<br />
      parties, of which the landlord and tenant each take one copy.<br />
      The tenant is responsible for defects and damages to the apartment resulting from the tenants cause, through<br />
      neglect or careless behavior. The tenant is not responsible for defects and damages to the apartment resulting<br />
    from normal usage</td>
  </tr>
  <tr>
    <td bgcolor="#CCCCCC">&nbsp;</td>
    <td colspan="4" bgcolor="#CCCCCC">Householder's insurance and security</td>
  </tr>
  <tr>
    <td>Householder's<br />
    insurance </td>
    <td colspan="4"> The landlord shall have a householder's insurance valid for the apartment during the period of this<br />
      agreement's validity.<br />
       The tenant shall have a householder's insurance valid for the apartment during the period of this agreement's<br />
      validity.<br />
       Both the tenant and the landlord shall have a householder's insurance valid for the apartment during the<br />
    period of this agreement's validity</td>
  </tr>
  <tr>
    <td bgcolor="#CCCCCC">&nbsp;</td>
    <td colspan="4" bgcolor="#CCCCCC">The tenants responsibilities and obligations</td>
  </tr>
  <tr>
    <td>Responsibilities<br />
    and obligations</td>
    <td colspan="4">The tenant commit to:   <br />
      ‐ only use the apartment as a residence  <br />
      ‐ not sublet the apartment or transfer the tenancy to anyone else<br />
      ‐ take good care of the apartment<br />
      ‐ report eventual damages to the landlord at once<br />
      ‐ respect and follow the rules and regulations the landlord is obliged to follow in respect to the property holder.   <br />
      ‐ leave the apartment tidy and clean as well as to hand over all gate and door keys to the apartment at the end of<br />
      the tenancy, even if the keys has been acquired by the tenant.<br />
      ‐ be responsible for loss of or damage to furniture or fittings as well as for defects and damages to the apartment<br />
      and common areas resulting from the tenants cause, through neglect or careless behavior. The tenant is to be<br />
      held responsible even if loss or damage has been caused by his or her friends, members of family, guests, lodgers<br />
      or persons undertaking work on behalf of the tenant in the apartment. The tenant is not responsible for defects<br />
    and damages resulting from normal usage</td>
  </tr>
  <tr>
    <td bgcolor="#CCCCCC">&nbsp;</td>
    <td colspan="4" bgcolor="#CCCCCC">The landlords responsibilities and obligations</td>
  </tr>
  <tr>
    <td>Responsibilities<br />
    and obligations</td>
    <td colspan="4">The landlord commit to:   <br />
      ‐ undertake to make sure that the apartment is tidy and clean when the tenant moves in as well as to hand over<br />
      all keys to the apartment to the tenant if such are available.<br />
      ‐ obtain required consent from the property holder, the tenant‐owner's society or the Swedish rent tribunal to<br />
    sublet the apartment. </td>
  </tr>
  <tr>
    <td bgcolor="#CCCCCC">&nbsp;</td>
    <td colspan="4" bgcolor="#CCCCCC">Special provisions</td>
  </tr>
  <tr>
    <td>Special provisions</td>
    <td colspan="4" style=" vertical-align:text-top; ">The tenant and the landlord have agreed upon the following provisions, rules of conduct or restrictions:
    <br><br><br><br>
    </td>
  </tr>
  <tr>
    <td bgcolor="#CCCCCC">&nbsp;</td>
    <td colspan="4" bgcolor="#CCCCCC">Signatures</td>
  </tr>
  <tr>
    <td>Signatures</td>
    <td colspan="2">Place/date<br><br><br><br></td>
    <td colspan="2">Place/date<br><br><br><br>
   </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="2">Landlord<br><br><br><br>
    </td>
    <td colspan="2">Tenant<br><br><br><br>
    </td>
  </tr>
  <tr>
    <td bgcolor="#CCCCCC">&nbsp;</td>
    <td colspan="4" bgcolor="#CCCCCC">Agreement to terminate this sublease agreement  </td>
  </tr>
  <tr>
    <td>Agreement to<br />
      terminate this<br />
      sublease<br />
    agreement  </td>
    <td colspan="4">Because of agreement reached today between the landlord and tenant this sublease agreement will terminate the<br />
    _________________ (date) to when the tenant undertakes to have moved out of the apartment.</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="2">Place/date<br><br><br><br></td>
    <td colspan="2">Place/date<br><br><br><br></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="2">Tenant<br><br><br><br></td>
    <td colspan="2">Tenant<br><br><br><br></td>
  </tr>
</table>
             
               
    </td>
  </tr>
  </table>       
	<p align="center" class="no-print"><a class="button green" href="javascript:window.print()">Print</a> <a class="button green" href="index.php">HOME</a></p>
        

       
         
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