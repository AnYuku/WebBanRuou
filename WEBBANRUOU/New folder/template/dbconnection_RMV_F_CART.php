<?php
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
$transactId = $_POST['transactId'];
$sql = "UPDATE `transactdetail`SET `TransactId`='0' WHERE ProductNum = '$productId' AND TransactId = '$transactId'";
$conn->query($sql);
echo json_encode(true);
?>