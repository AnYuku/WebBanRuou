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
    $username = $conn->real_escape_string($_POST['username']);
    $password = $conn->real_escape_string($_POST['password']);
    $sql = $conn->query("SELECT * FROM useraccount WHERE UserName='$username' AND UserPassword='$password'");
    
    if ($sql->num_rows > 0) {
        // dang nhap thanh cong 
        $user = mysqli_fetch_assoc($sql);
        $_SESSION['logged_in'] = true;        
        $_SESSION['username'] = $username;
        $_SESSION['userId'] = $user["UserId"];
        $accessLevel = $user["AccessLevel"];
        if ($accessLevel == 100) {
            // Người dùng là admin
            echo json_encode('admin');
        } else if ($accessLevel == 50) {
            // Người dùng là khách hàng
            echo json_encode('client');
            // exit('success');
        } 
    }
    else {
            // dang nhap that bai
            echo json_encode('failed');
        }
   
    $conn->close();
