<?php
session_start();
if (isset($_SESSION['AccessLevel']) && $_SESSION["AccessLevel"] == 50) {
    // header('Location: index.php');
    exit();
}

$servername = "localhost";
$username = "admin";
$password = "admin";
$dbname = "pubmanager";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli->connect_error;
}
mysqli_set_charset($conn, "utf8");
// kiem tra thong tin dang ky
$username = $conn->real_escape_string($_POST['username']);
$password = $conn->real_escape_string($_POST['password']);
$email = $conn->real_escape_string($_POST['email']);
$flag = 0;
function checkAccount($conn,$username,$email){   
    $data1 = $conn->query("SELECT userid FROM useraccount WHERE UserName='$username' ");
    $data2 = $conn->query("SELECT userid FROM useraccount WHERE Email='$email'");
    if ($data1->num_rows > 0) {
        echo json_encode('error1');
    } else if ($data2->num_rows > 0) {
        echo json_encode('error2');
    } else {           
        return true;
    }
}
if (isset($_POST['action']) && $_POST['action'] == 'check') {
    if(checkAccount($conn,$username,$email))
        echo json_encode(true);
}

if (isset($_POST['action']) && $_POST['action'] == 'check_and_signup') {
    if (checkAccount($conn,$username,$email)){
         $UserID = hash_hmac('sha256', $username, '123654789');
         $query = "INSERT INTO useraccount (UserID, UserName, UserPassword, Email, AccessLevel, IsActive) VALUES ('$UserID', '$username', '$password', '$email', '50', '1')";
        if ($conn->query($query) === TRUE) {
            echo json_encode('success');
        } else {
            echo json_encode("Error: " . $query . "<br>" . $conn->error);
        }
    }
   
}




$conn->close();
