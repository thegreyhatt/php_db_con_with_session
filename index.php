<!DOCTYPE html>
<html>
<head>
	<title>PHP DB Connection</title>
</head>
<body>
<a href="add-new.php">Register</a><br>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	session_start();
	if(isset($_POST['btnLogin'])){
		require 'dbconn.php';
		$username = $_POST['username'];
		$password = $_POST['password'];
		$_SESSION["loggedIn"] = true;
		
		$sql = "SELECT * from users where username='$username' and password='$password'";
		echo $sql;
		$result = $conn->query($sql);
		if(mysqli_num_rows($result)==1){
			$_SESSION['username'] = $username;
			header('Location: welcome.php');
		}
		else
			echo "Account invalid";
	}
	if(isset($_GET['logout'])){
		session_unregister('username');
	}
}
?>
<form action="index.php" method="post">
    <input type="text" name="username" placeholder="Enter your username" required>
    <input type="password" name="password" placeholder="Enter your password" required>
    <input type="submit" name="btnLogin"value="Submit">
</form>
</body>
</html>
