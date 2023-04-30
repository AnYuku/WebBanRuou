<?php
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
$sql = "SELECT 
        SUM(transactdetail.Quan * transactdetail.CostEach) AS TongDoanhThu,
        MONTH(transactheader.TimePayment) AS Thang,
        YEAR(transactheader.TimePayment) AS Nam
        FROM 
        transactdetail transactdetail 
        JOIN transactheader transactheader ON transactdetail.TransactId = transactheader.TransactId
        WHERE 
        transactheader.TimePayment BETWEEN DATE_SUB(NOW(), INTERVAL 1 MONTH) AND NOW()
        GROUP BY 
        MONTH(transactheader.TimePayment), 
        YEAR(transactheader.TimePayment);";
$result = mysqli_query($conn, $sql);
$doanh_thu_month = [];
$thang =[];
$data = [];

if ($result) {
    // Fetch result as an associative array
    $row = mysqli_fetch_all($result);
    $data[] = $row;
    foreach ($result as $data ) {
        $doanh_thu_month[] = $data['TongDoanhThu'];
        $thang[] = $data['Thang'];
    }
    
} else {
    // Print an error message if query execution fails
    echo mysqli_error($conn);
}

$conn->close();
?>