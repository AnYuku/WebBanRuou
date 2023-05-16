<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pubmanager";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// Get data from table
$userid = $conn->real_escape_string($_POST['userid']);
$password = $conn->real_escape_string($_POST['password']);
$sql = $conn->query("SELECT * FROM useraccount WHERE UserId='$userid' AND UserPassword='$password'");

if ($sql->num_rows > 0) {
    // dang nhap thanh cong 
    $user = mysqli_fetch_assoc($sql);
    $_SESSION['logged_in'] = true;
    $_SESSION['username'] = $user['UserName'];
    $_SESSION['userId'] = $user["UserId"];
    $accessLevel = $user["AccessLevel"];
    $_SESSION['AccessLevel'] = $accessLevel;
    if ($accessLevel == 100) {
        // Người dùng là admin
        $_SESSION['userRole'] = "admin";
        echo json_encode('admin');
    } else if ($accessLevel == 50) {
        // Người dùng là khách hàng
        $_SESSION['userRole'] = "client";
        echo json_encode('client');
        // exit('success');
    }
} else {
    // dang nhap that bai
    echo json_encode('failed');
}

$conn->close();
