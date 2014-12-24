 <?php require_once "admin/connection.php" ?>
 <div id="header">
      <a class="logo" href="#">
        <img src="images/logo.png" alt="WooThemes" />
	  </a>
      <h1>Welcome</h1>
      <h2>Please login</h2>
     
      <h3 class="nav-header">For Customer</h3>
      <div id="nav2">
        Please use your Name as a username <br>and your CitizenID as a password
      </div> 
      
       <h3 class="nav-header">For Staff</h3>
      <div id="nav2">
        Please use your Name as a username <br>and your Passcode as a password
      </div> 
        
     	<br><br>
      <h3 class="nav-header">Need help?</h3>
      <div id="nav2">
       Call us <?php echo $COM_TELL; ?><br>or email: <?php echo $COM_MAIL;?>
      </div>
      
    </div>