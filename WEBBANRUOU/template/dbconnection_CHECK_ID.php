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

function checkIfIDExists($idToCheck) {
    global $conn;
    $sql = "SELECT ProductNum FROM product WHERE ProductNum = '$idToCheck'";
    $result = $conn->query($sql);
    if ($result === false) {
        // Câu truy vấn bị lỗi
        $error = mysqli_error($conn);
        // Xử lý lỗi 
        error_log("Error executing SQL query: $error");
        return false;
    }
    if ($result->num_rows == 0) {
        // Không tìm thấy bản ghi nào
        return false;
    } else {
        // Tìm thấy ít nhất một bản ghi
        return true;
    }
}

$Id = $_POST['Id'];
$tempID = "P" . str_pad($Id, 5, "0", STR_PAD_LEFT);
$index = 0;

while (checkIfIDExists($tempID)) {
    $index++;
    $tempID = "P" . str_pad($index, 5, "0", STR_PAD_LEFT);
    if ($index > 99999) {
        // Đã đạt đến giới hạn số lượng sản phẩm
        echo json_encode(false);
        exit();
    }
}

echo json_encode($tempID);
?>