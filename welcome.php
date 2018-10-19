<!DOCTYPE html>
<html>
<head>
	<title>Welcome</title>
</head>
<body>

<?php require 'links.html';  ?>
<br>
<?php require 'require-login.php';  ?>
<?php
    session_start();
    echo 'Welcome '.$_SESSION['username'];
    ?>
    <?php 
    if(isset($_POST['logout'])){
        session_start();
        $_SESSION["loggedIn"] = false;
        header( "Location: index.php" );    
    }
    ?>


    <form  method="post">
        <button type="submit" name="logout"> Logout </button>
    </form>
</body>
</html>
