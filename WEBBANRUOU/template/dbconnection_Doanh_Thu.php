<?php

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
$sql = "SELECT 
            category.CatName AS ten_loai, 
            SUM(transactdetail.Quan) AS tong_so_luong, 
            SUM(transactdetail.Quan * transactdetail.CostEach) AS doanh_thu, 
            DATE(transactheader.TimePayment) AS ngay, 
            MONTH(transactheader.TimePayment) AS thang, 
            YEAR(transactheader.TimePayment) AS nam
            FROM 
            category category 
            JOIN product product ON category.CatId = product.CatId 
            JOIN transactdetail transactdetail ON product.ProductNum = transactdetail.ProductNum 
            JOIN transactheader transactheader ON transactdetail.TransactId = transactheader.TransactId
            WHERE transactheader.TimePayment BETWEEN '$tungay' AND '$denngay'
            GROUP BY 
            category.CatId, 
            DATE(transactheader.TimePayment), 
            MONTH(transactheader.TimePayment), 
            YEAR(transactheader.TimePayment)";
$result = mysqli_query($conn, $sql);
$total_sol = [];
$catName =[];
$doanh_thu =[];
$ngay = [];
$data = [];

if ($result) {
    // Fetch result as an associative array
    $row = mysqli_fetch_all($result);
     $data[] = $row;
    // echo json_encode($data);
    foreach ($result as $data ) {
        $ngay[] = $data['ngay'];
        // echo json_encode($ngay);
        $doanh_thu[] = $data['doanh_thu'];
        // echo json_encode($doanh_thu);    
    }
    // echo json_encode($data);
    // $total_sol[] = $row['tong_so_luong'];
    // $catName[] = $row['ten_loai'];
} else {
    // Print an error message if query execution fails
    echo mysqli_error($conn);
}

$conn->close();
?>