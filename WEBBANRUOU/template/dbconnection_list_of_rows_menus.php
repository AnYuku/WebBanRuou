<?php

$tungay=null;
$denngay=null;
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Lấy thời gian từ input
    $tungay = $_POST['from_date'];
    $denngay = $_POST['to_date'];
}
// Kết nối đến cơ sở dữ liệu
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

// Truy vấn cơ sở dữ liệu để lấy thông tin về số lượng sản phẩm đã bán của từng loại sản phẩm
$sql = "SELECT DATE(transactheader.TimePayment) AS TimeDay, COUNT(*) AS TotalCount
            FROM transactheader transactheader
            WHERE status = 1 AND transactheader.TimePayment BETWEEN '$tungay' AND '$denngay'
            GROUP BY DATE(transactheader.TimePayment);";
$result = mysqli_query($conn, $sql);
$count = [];
$timeday =[];
$data = [];

if ($result) {
    // Fetch result as an associative array
    $row = mysqli_fetch_all($result);
    $data[] = $row;
    foreach ($result as $data ) {
        $timeday[] = $data['TimeDay'];
        $count[] = $data['TotalCount'];
        

    }
    
} else {
    // Print an error message if query execution fails
    echo mysqli_error($conn);
}

$conn->close();
?>