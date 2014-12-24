<?php require_once "authentication-admin.php" ?>
<?php require_once "connection.php" ?>
<?php require_once "configuration.php" ?>
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
    <script type="text/javascript">
     function openRoom()
	{
		window.open("http://www.javascript-coder.com","mywindow","menubar=1,resizable=1,width=350,height=250");
	}
    </script>
    
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
        <h2>Dashboard: Room Status</h2>
        
        <?php
		//fetch all room in a box
			mysql_select_db("webpro",$con);
			
			$result = mysql_query("SELECT ID as cID,name,room FROM contract i WHERE status=1 ORDER BY room");
			//echo mysql_num_rows($result);
			if($result === FALSE) {
   				 die(mysql_error()); // TODO: better error handling
			}
			
			$row = mysql_fetch_array($result);
			$floor = $FLOOR+1;
			$width = (int)(60/$ROOM_PER_FLOOR);
			for($j=1;$j<=$TOTAL_ROOM;$j++){
				
				$color = "FF4444";

				
				
				if(($j-1)%$ROOM_PER_FLOOR==0 || $j==1){
					$floor--;
					echo "<div class='clear'></div>";
					echo "<div style='width:20px; float:left; margin:0 10px;'>Fl.<br><span style='font-size:30px; text-align:center; color:#666'>".$floor."</span></div>";
				}
				if($row['room']==$j){ //not ava
					
					
					$sql = "SELECT MIN(status) as min FROM invoice WHERE contractID=".$row['cID'];
					$result2 = mysql_query($sql);
					if($result2 === FALSE) {
					 die(mysql_error()); // TODO: better error handling
					}
					$row2 = mysql_fetch_array($result2);
				
					if($row2['min'] == 1 || $row2['min'] == NULL ) $color = "33B3F3";
				
				
					echo "<a href='roomInfo.php?ID=$row[cID]'><div class='boxroom'  style='background-color:#".$color."; width:".$width."%;'>
					<b>".$j."</b><br>
					<br>".$row['name']."<br><br>(ID: ".$row['cID'].")
					<br>
					</div></a>";
					$row = mysql_fetch_array($result);
				}
				else { //Available
					echo "<a href='contract_new.php?room=$j'><div class='boxroom' style='background-color:#44FF7D; color:black; width:".$width."%;'><b>".$j."</b><br><br> Available</div></a>";
				}
				
				
					
			}
			

			mysql_close($con);
		?>
        <div class="clear"></div>
         <p class="no-print">Remark: 
          <span class="highlight" style="background-color:#44FF7D;">&nbsp; green &nbsp;</span>: available rom &nbsp;&nbsp;&nbsp;
          <span class="highlight" style="background-color:#FF4444;">&nbsp; red &nbsp;</span>: has an unpaid bill(s) &nbsp;&nbsp;&nbsp;
			<span class="highlight" style="background-color:#33B3F3;">&nbsp; blue &nbsp;</span>: doesn't have an unpaid bill
          </p>

        
      </div>
    </div>

  </div>




</body>
</html>