<!DOCTYPE html>
<html>
<head>
	<title>Add New User</title>
</head>
<body>
    <?php require 'require-login.php';  ?>
    <?php require 'links.html';  ?>
    <br>
        <br> 
    <?php ob_start();  
        printEditUser();
        
    ?> 
    <?php if ($_SERVER["REQUEST_METHOD"] == "POST") {
	
    require 'dbconn.php';
    switch ($_POST['action']){
        case "checkUsername":
                $uname_old = $_POST['username_old'];  
                    if (!empty($uname_old)) {
                        $sql = "SELECT * from users where username = '$uname_old'";
                        $result = $conn->query($sql);
                        if ($result->num_rows) {
                            // output data of each row
                            $row = $result->fetch_assoc();
                            if ($row){
                                ob_clean();
                                echo "<form action='edit.php' method='post'>
                                        <label> Edit Username</label>
                                        <input type='text' name='username_new' value='".$row['username']."'"." required='true'><br>
                                        <label> Edit First Name</label>
                                        <input type='text' name='first_name' value='".$row['first_name']."'"." required='true'><br>
                                        <label> Edit Last Name</label>
                                        <input type='text' name='last_name' value='".$row['last_name']."'"." required='true'><br>
                                        <label> Edit Password</label>
                                        <input type='password' name='password' value='".$row['password']."'"." required='true'><br>
                                        <input type='hidden' name='username_old' value='".$uname_old."'"." required='true'>
                                        <input type='hidden' name='action' value='update'>
                                        <input type='submit' value='Update User' >
                                    </form>";
                            }
                            else {
                                echo "No existing username";
                            }
                        }  
                    }
        break;
        case "update":
                $uname_new = $_POST['username_new'];
                $first_name = $_POST['first_name'];
                $last_name = $_POST['last_name'];
                $password = $_POST['password'];
                $uname_old = $_POST['username_old'];
                $sql = "UPDATE users SET username='$uname_new', first_name='$first_name', last_name='$last_name', password='$password'  WHERE username='$uname_old'";

                if ($conn->query($sql) === TRUE) {
                    echo "Record updated successfully";
                } else {
                    echo "Error updating record: " . $conn->error;
                }
        break;
    }

    }
?>
<?php
function printEditUser(){
echo "<form action='edit.php' method='post'>
        <label> Edit User</label>
        <input type='text' name='username_old'>
        <input type='submit' value='Edit' >
        <input type='hidden' name='action' value='checkUsername'>
      </form>";
}
?>


</body>
</html>