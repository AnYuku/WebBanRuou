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

$TimeStart = $_GET['Quy_TimeStart'];
$TimeEnd = $_GET['Quy_TimeEnd'];

// Get data from table Product
$sql = "SELECT SUM(Quan) AS TotalNumProduct FROM Product";
$result = $conn->query($sql);

$data1 = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data1[] = $row;
    }
}

// Get data from table transactheader
$sql = "SELECT SUM(Total) AS TotalDoanhThu FROM transactheader WHERE Status = 2 AND TimePayment >= '$TimeStart' AND TimePayment <= '$TimeEnd'";
$result = $conn->query($sql);

$data2 = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data2[] = $row;
    }
}

$sql = "SELECT COUNT(TransactId) AS TotalOrderConfirm FROM TransactHeader WHERE Status = 2 AND TimePayment >= '$TimeStart' AND TimePayment <= '$TimeEnd'";
$result = $conn->query($sql);

// Convert data to JSON format
$data3 = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data3[] = $row;
    }
}

$sql = "SELECT COUNT(TransactId) AS TotalOrderCancel FROM TransactHeader WHERE Status = 4 AND TimePayment >= '$TimeStart' AND TimePayment <= '$TimeEnd'";
$result = $conn->query($sql);

// Convert data to JSON format
$data4 = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data4[] = $row;
    }
}

$sql = "SELECT COUNT(*) AS TotalAdminActive FROM UserAccount WHERE AccessLevel = 100 AND IsActive = 1";
$result = $conn->query($sql);

// Convert data to JSON format
$data5 = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data5[] = $row;
    }
}

$sql = "SELECT COUNT(*) AS TotalAdminInactive FROM UserAccount WHERE AccessLevel = 100 AND IsActive = 0";
$result = $conn->query($sql);

// Convert data to JSON format
$data6 = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data6[] = $row;
    }
}

$sql = "SELECT COUNT(*) AS TotalClientActive FROM UserAccount WHERE AccessLevel = 50 AND IsActive = 1";
$result = $conn->query($sql);

// Convert data to JSON format
$data7 = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data7[] = $row;
    }
}

$sql = "SELECT COUNT(*) AS TotalClientInactive FROM UserAccount WHERE AccessLevel = 50 AND IsActive = 0";
$result = $conn->query($sql);

// Convert data to JSON format
$data8 = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data8[] = $row;
    }
}

$combinedData = array($data1[0], $data2[0], $data3[0], $data4[0], $data5[0], $data6[0], $data7[0], $data8[0]);

echo json_encode($combinedData);

$conn->close();
