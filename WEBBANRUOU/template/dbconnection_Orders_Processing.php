<?php
$Whopay = $_POST['userID'];

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
if (isset($_POST['action']) && $_POST['action'] == 'getList') {
    $sql = "SELECT TransactId, TimePayment, Total, `Status`
        FROM transactheader 
        WHERE WhoPay = '$Whopay' AND `Status` = 1 ORDER BY TimePayment DESC;";
    $result = $conn->query($sql);

    $data = array();
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
    echo json_encode($data);
}
if (isset($_POST['action']) && $_POST['action'] == 'getConfirmedList') {
    $sql = "SELECT TransactId, TimePayment, Total, `Status`
        FROM transactheader 
        WHERE WhoPay = '$Whopay' AND (`Status` = 2 OR `Status` = 4) ORDER BY TimePayment DESC;";
    $result = $conn->query($sql);

    $data = array();
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
    echo json_encode($data);
}

if (isset($_POST['action']) && $_POST['action'] == 'getDetails') {
    $TransactId = $_POST['transactId'];
    $sql = "SELECT product.ProductName, transactdetail.Quan,transactdetail.CostEach, transactheader.TimePayment, 
    transactheader.Total
    FROM transactheader
    JOIN transactdetail ON transactdetail.TransactId = transactheader.TransactId
    JOIN product ON transactdetail.ProductNum = product.ProductNum
    WHERE transactheader.WhoPay = '$Whopay' 
    AND transactheader.TransactId = '$TransactId'";
    $result = $conn->query($sql);

    $data = array();
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }

    echo json_encode($data);
}
if (isset($_POST['action']) && $_POST['action'] == 'getConfirmedDetails') {
    $TransactId = $_POST['transactId'];
    $sql = "SELECT product.ProductName, transactdetail.Quan,transactdetail.CostEach, transactheader.TimePayment, 
    transactheader.Total
    FROM transactheader
    JOIN transactdetail ON transactdetail.TransactId = transactheader.TransactId
    JOIN product ON transactdetail.ProductNum = product.ProductNum
    WHERE transactheader.WhoPay = '$Whopay' 
    AND transactheader.TransactId = '$TransactId'";
    $result = $conn->query($sql);

    $data = array();
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }

    echo json_encode($data);
}
