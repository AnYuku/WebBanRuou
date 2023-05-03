<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$Whopay = $_SESSION["userId"];

$servername = "localhost";
$username = "admin";
$password = "admin";
$dbname = "pubmanager";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

//Giỏ hàng
$sql = "SELECT td.ProductNum, p.ProductName, td.Quan, td.CostEach, th.Net
FROM product p
INNER JOIN transactdetail td ON p.ProductNum = td.ProductNum 
INNER JOIN transactheader th ON th.TransactId = td.TransactId 
WHERE th.WhoPay = '$Whopay' AND th.Status = 0;";
$result = $conn->query($sql);

$data = array();
while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

echo json_encode($data);

// Khi nhấn nút thanh toán
if (isset($_POST['action']) && $_POST['action'] == 'pay') {
    date_default_timezone_set('Asia/Ho_Chi_Minh');
    $current_date_time = date('Y-m-d H:i:s');
    
    $sql = "UPDATE transactheader 
        SET `Status` = 1, `TimePayment`='$current_date_time'
        WHERE `WhoPay` = '$Whopay' AND `Status` = 0 
        LIMIT 1";
    $conn->query($sql);
    // echo json_encode(true);
}

// if (isset($_POST['action']) && $_POST['action'] == "updateQuantity")

if (isset($_POST['action']) && $_POST['action'] == 'delete') {   
    $productNum = $_POST["productId"];
    $sql = "DELETE transactdetail
    FROM transactdetail
    INNER JOIN transactheader ON transactdetail.TransactId = transactheader.TransactId
    WHERE transactheader.WhoPay = '$Whopay' AND transactheader.Status = 0 
    AND transactdetail.ProductNum = '$productNum' ";
    $conn->query($sql);
    // echo json_encode(true);    
}
