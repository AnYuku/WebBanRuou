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
    $id = $_GET['productId'];
    // Get data from table
    $sql = "SELECT product.*, category.CatName FROM product JOIN category 
    on product.CatId = category.CatId WHERE ProductNum = '" . $id . "'";
    $result = $conn->query($sql);

    // Convert data to JSON format
    $data = array();
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            foreach ($row as $key => $value) {
                if (is_string($value)) {
                    $row[$key] = rtrim($value);
                }
            }
            $data[] = $row;
        }
    }
    echo json_encode($data);

    $conn->close();
?>