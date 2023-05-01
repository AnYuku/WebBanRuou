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
$productId = $_POST['productId'];
$quantityChange = $_POST['quantityChange'];

$sql = "SELECT TransactId FROM transactheader 
WHERE WhoPay = '$Whopay' AND Status = '0' ";
$result =$conn->query($sql);
$data = $result->fetch_assoc();
$transactId = $data['TransactId'] ;
// Lấy thông tin sản phẩm và số lượng cũ từ cơ sở dữ liệu
$sql = "SELECT Quan FROM transactdetail WHERE ProductNum = '$productId' AND TransactId = '$transactId'";
$result = $conn->query($sql);
$data = $result->fetch_assoc();
// Lấy giá trị số lượng cũ từ $data
$quantityOld = $data['Quan'];
// Tính toán số lượng mới
$quantityNew = $quantityOld + $quantityChange;
// Kiểm tra số lượng tồn kho
$sql = "SELECT Quan FROM product WHERE ProductNum = '$productId'";
$result = $conn->query($sql);
$data = $result->fetch_assoc();
$stock = $data['Quan'];
// Kiểm tra số lượng mới có hợp lệ hay không
if ($quantityNew < 1) {
    echo json_encode(array('error' => 'Số lượng sản phẩm không hợp lệ'));
    exit;
}
else if($quantityNew > $stock){
    echo json_encode(array('error' => 'Số lượng sản phẩm không hợp lệ'));
    exit;
}

// Cập nhật số lượng mới trong cơ sở dữ liệu
$sql = "UPDATE `transactdetail` SET `Quan`='$quantityNew' WHERE ProductNum = '$productId' AND TransactId = '$transactId'";
$conn->query($sql);
// Cập nhật tổng cộng
$sql = "UPDATE transactheader SET Net = (
    SELECT SUM(CostEach * Quan)
    FROM transactdetail
    WHERE TransactId = '{$transactId}'
), Total = (
    SELECT SUM(CostEach * Quan)
    FROM transactdetail
    WHERE TransactId = '{$transactId}'
)
WHERE TransactId = '{$transactId}'";
$conn->query($sql);
// Lấy số lượng mới + tổng cộng mới
$sql = "SELECT Quan, `transactheader`.Total FROM `transactdetail` Join `transactheader` on `transactheader`.TransactId =`transactdetail`.TransactId
WHERE ProductNum = '$productId' AND `transactdetail`.TransactId = '$transactId'";
$result =$conn->query($sql);
$data = $result->fetch_assoc();
$priceNew = $data['Total'];
echo json_encode(array('Quan' => $quantityNew, 'Total' => $priceNew));
?>