<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$UserId = $_SESSION["userId"];

// Kết nối với cơ sở dữ liệu MySQL
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pubmanager";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if (isset($_POST['action']) && $_POST['action'] == 'getInfo') {
    $sql = "SELECT UserName, TotalCash, Email, `Address`
        FROM useraccount
        WHERE UserId = '$UserId'";
    $result = $conn->query($sql);
    echo json_encode($result->fetch_assoc());
}

if (isset($_POST['action']) && $_POST['action'] == 'save') {
    $email = $_POST['email'];
    $address = $_POST['address'];
    // Kiểm tra trùng lặp email
    $sql = "SELECT COUNT(*) as count FROM `useraccount` WHERE `Email` = '$email' AND `UserId` != '$UserId'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $count = $row['count'];
    if ($count > 0) {
        echo json_encode("Email đã tồn tại trong cơ sở dữ liệu");
    } else {
        // Cập nhật email mới vào cơ sở dữ liệu
        $sql = "UPDATE `useraccount`
        SET Email = '$email',
        `Address` = '$address'
        WHERE UserId = '$UserId'";
        $conn->query($sql);
        echo json_encode('success');
    }
}

if (isset($_POST['action']) && $_POST['action'] == 'changePassword') {
    $oldPassword = $_POST['oldPassword'];
    $newPassword = $_POST['newPassword'];
    $confirmPassword = $_POST['confirmPassword'];

    $sql = "SELECT COUNT(*) as count FROM `useraccount` WHERE `UserPassword` = '$oldPassword' AND `UserId` = '$UserId'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $count = $row['count'];
    // Mật khẩu cũ đúng
    if ($count > 0) {        
            // Cập nhật email mới vào cơ sở dữ liệu
            $sql = "UPDATE `useraccount`
            SET `UserPassword` = '$newPassword'           
            WHERE `UserId` = '$UserId'";
            $conn->query($sql);
            echo json_encode('success');
        
    }
    else
        echo json_encode('old');
     
}
?>