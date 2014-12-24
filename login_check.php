<title>CHECKING</title>
<?php

require_once "admin/connection.php";
if(!isset($_POST['user78'])&&!isset($_POST['pass98'])){
	header("Location: index.php");
}

$user = $_POST['user78'];
$pass = $_POST['pass98'];
			
mysql_select_db("webpro",$con);
$result = mysql_query("SELECT * FROM user WHERE user = '$user' AND pass = '$pass'");
if($result === FALSE) {
    die(mysql_error()); // TODO: better error handling
}
$num_rows = mysql_num_rows($result);
if($num_rows == 0) {
	/*$message = "Please check username & password again.";
	echo "<script type='text/javascript'>alert('$message');</script>";
	*/
	header("Location: index.php");
	
} //check if it is not true URL value
$row = mysql_fetch_array($result);


?>
