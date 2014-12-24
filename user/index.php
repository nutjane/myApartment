 <?php require_once "authentication.php" ?>
<!DOCTYPE html>
<html>
<head>
	<meta content="charset=utf-8">
	<title>My Apartment</title>
	<link rel="stylesheet" href="../css/style.css" type="text/css" media="screen" />
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
        <table class="hometable" style="width:auto;">
        	<tr>
            	<td width="120px"><h3>Your status</h3></td>
                <td width="200px"><h3>Outstanding balance</h3></td>
                <td width="100px"><h3>Cycle</h3></td>
                
            </tr>
            <tr>
            	<td><span style="size:30px; color:green;">ACTIVE</span></td>
                <td>9999.99</td>
                <td>12</td>
               
            </tr>
        </table>
        
        <hr class="style1">
        
        <h2>Message broadcast</h2>
        .......
        
        <hr class="style1">
        
        <h2>Your previous 5 bills</h2>
         <table class="simple">
        	<tr >
            	<th>Cycle</th>
            	<th>Month</th>
                <th>Monthly fee</th>
                <th colspan="2">Water usage</th>
                 <th colspan="2">Electricity usage</th>
                 <th>Total Balance</th>
                 <th width="50px">*</th>
            </tr>
            <tr>
            	<td>52</td>
                <td>2014/12</td>
                <td>5900.00</td>
                <td>124</td>
                <td>200.00</td>
                <td>511</td>
                <td>1982.25</td>
                <td><b>9999.25</b></td>
                <td><img src="../images/printer.gif"></td>
            </tr>
        </table>
        <hr class="style1">
         <h2>Your water and electricity usage</h2>
        
        </div>
    </div>

  </div>




</body>
</html>