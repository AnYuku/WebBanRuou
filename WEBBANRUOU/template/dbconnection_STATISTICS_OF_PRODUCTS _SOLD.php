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
$sql = "SELECT category.CatName, SUM(transactdetail.Quan) AS Total_sold
                FROM category
                JOIN product ON category.CatId = product.CatId
                JOIN transactdetail ON product.ProductNum = transactdetail.ProductNum
                GROUP BY category.CatId;";
$result = mysqli_query($conn, $sql);
$total_sold = [];
$CatName =[];
$data = [];

if ($result) {
    // Fetch result as an associative array
    $row = mysqli_fetch_all($result);
    $data[] = $row;
    foreach ($result as $data ) {
        $total_sold[] = $data['Total_sold'];
        // echo json_encode($total_sold);
        $CatName[] = $data['CatName'];
        // echo json_encode($CatName);
    }
    
} else {
    // Print an error message if query execution fails
    echo mysqli_error($conn);
}

$conn->close();
?>