<?php
$servername = "localhost";
$username = "admin";
$password = "admin";
$dbname = "pubmanager";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$table_name = 'useraccount';
$json_data = $_POST['data_update'];
$data_update = json_decode($json_data, true);

$sql = "UPDATE `$table_name` SET `TotalCash`= `TotalCash` + '{$data_update['TotalCash']}' WHERE UserId = '{$data_update['UserId']}'";
$conn->query($sql);

echo json_encode(true);

$conn->close();
