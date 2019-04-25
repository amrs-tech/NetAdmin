<?php
session_start();
$mail = $pas = "";

if($_SERVER["REQUEST_METHOD"]=="POST"){
	$mail = $_POST["email"];
	$pas = $_POST["pass"];
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
$NAME = "";
$conn = new mysqli($serv,$user,$pass,$db);
if($conn->connect_error){
	echo "<br>";
	echo "<div align = 'center'>";
	echo "Internal Database Error !";
	echo "</div>";
	echo "<script>setTimeout(function(){window.location.href='index.html'},2200);</script>";
}
else{
	$sql = "select fname, lname, email, pwd, role from reg where email = '$mail'";
	$res = $conn->query($sql);
	if($res->num_rows > 0){
		while($row = $res->fetch_assoc()){
			if($mail == $row["email"] && $pas == $row["pwd"] ){
				$NAME = $row["fname"];
				$_SESSION['UNAME'] = $NAME;
				$_SESSION['role'] = $row['role'];
				$_SESSION['NAME'] = '';
				$_SESSION['total'] = '';
				echo "<br>";
				echo "<div align = 'center'>";
				echo "<h3>Login Successful !</h3>";
				echo "</div>";
				if($row['role']=='Administrator')
					echo "<script>setTimeout(function(){window.location.href='auser.php'},2200);</script>";
				else if($row['role']=="Semi-Admin")
					echo "<script>setTimeout(function(){window.location.href='suser.php'},2200);</script>";
				else {
					echo "<script>setTimeout(function(){window.location.href='uuser.php'},2200);</script>";
				}
			}
			else{
				echo "<div align='center'> ";
				echo "<h3>Login Id/Password/Role is Incorrect !</h3>";
				echo "</div>";
				echo "<script>setTimeout(function(){window.location.href='index.html'},2200);</script>";
			}
		}
	}

	else{
		echo "<br>";
		echo "<div align = 'center'>";
		echo "<h3>Some Technical Error !</h3>";
		echo "</div>";
		echo "<script>setTimeout(function(){window.location.href='index.html'},2200);</script>";
	}
	$conn->close();
}

?>
