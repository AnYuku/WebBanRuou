<?php
// Kết nối đến cơ sở dữ liệu
$db_host = "localhost";
$db_user = "admin";
$db_pass = "admin";
$db_name = "pubmanager";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Truy vấn cơ sở dữ liệu để lấy thông tin về số lượng sản phẩm đã bán và tổng doanh thu
$sql = "SELECT SUM(Quan) AS Total_sold FROM `transactdetail`";
$result = mysqli_query($conn, $sql);

if ($result) {
    // Fetch result as an associative array
    $row = mysqli_fetch_assoc($result);
    
    $total_sold = $row['Total_sold'];
    echo json_encode($total_sold);
} else {
    // Print an error message if query execution fails
    echo mysqli_error($conn);
}

$conn->close();
?>