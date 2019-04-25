<?php
session_start();
$fname = $lname = $mail = $pas = $role = "";

if($_SERVER["REQUEST_METHOD"]=="POST"){
  $fname = $_POST["fname"];
  $lname = $_POST["lname"];
  $mail = $_POST["email"];
	$pas = $_POST["pas"];
  $role = $_POST["role"];
}
else{
	echo "<br>";
	echo "<div align = 'center'>";
	echo "Server Error !";
	echo "</div>";
}
?>

<?php
$serv = "localhost";
$user = "root";
$pass = "";
$db = "netman";

$conn = new mysqli($serv,$user,$pass,$db);
if($conn->connect_error){
	echo "<br>";
	echo "<div align = 'center'>";
	echo "Internal Database Error !";
	echo "</div>";
	echo "<script>setTimeout(function(){window.location.href='index.html'},2200);</script>";
}
else{
	$sql = "insert into reg values('$fname','$lname','$mail','$pas','$role')";
	$res = $conn->query($sql);
	if($res==TRUE){
				echo "<br>";
				echo "<div align = 'center'>";
				echo "<h3>Added Successfully !</h3>";
				echo "</div>";
				echo "<script>setTimeout(function(){window.location.href='auser.php'},2000);</script>";
			}
			else{
				echo "<div align='center'> ";
				echo "<h3>Some technical error</h3>";
				echo "</div>";
				echo "<script>setTimeout(function(){window.location.href='auser.php'},2000);</script>";
			}



	$conn->close();
}

?>
