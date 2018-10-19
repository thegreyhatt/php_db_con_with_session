<!DOCTYPE html>
<html>
<head>
	<title>Add New User</title>
</head>
<body>
	<?php session_start();
	if($_SESSION["loggedIn"]) require 'links.html';  
	?>
	
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	
	require 'dbconn.php';

	$uname = $_POST['username'];
	$first_name = $_POST['first_name'];
	$last_name = $_POST['last_name'];
	$password = $_POST['password'];

	if (empty($uname) || empty($first_name) || empty($last_name) || empty($password)) {
		echo "All fields are required.";
	}else{
		$sql = "SELECT * from users where username='$uname'";
		$check=$conn->query($sql);
		$checkrows=mysqli_num_rows($check);
		if($checkrows>0) {
			echo "user exists";
		}else{
			$sql = "INSERT INTO users (username, first_name, last_name, password)
			VALUES ('".$uname."', '".$first_name."', '".$last_name."', '".$password."')";
			if ($conn->query($sql) === TRUE) {
				echo "<br>New record created successfully";
			} else {
				echo "Error: " . $sql . "<br>" . $conn->error;
			}
			$conn->close();
		}	
	}
}
?>

<form action="add-new.php" method="post">
	<label>Username</label>
	<input type="text" name="username">
	<br>
	<label>First Name</label>
	<input type="text" name="first_name">
	<br>
	<label>Last Name</label>
	<input type="text" name="last_name">
	<br>
	<label>Password</label>
	<input type="password" name="password">
	<br>
	<input type="submit" value="Add New User" >
</form>
<button onclick="goBack()">Go Back</button>
<script>
function goBack() {
    window.history.back();
}
</script>
</body>
</html>