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
// -----------------------Lưu sản phẩm-------------------------
    // Check if the form has been submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Get data from form        
        $json_data = $_POST['data_insert'];
        $data_insert = json_decode($json_data, true);

        // Update data in table
        $sql = "UPDATE `product` SET `ProductName` = '{$data_insert['ProductName']}', 
        `Descript` = '{$data_insert['Descript']}', `Price` = '{$data_insert['Price']}', 
        `Tax1` = '{$data_insert['Tax1']}', 
        `Tax2` = '{$data_insert['Tax2']}', 
        `Tax3` = '{$data_insert['Tax3']}', 
        `Quan` = '{$data_insert['Quan']}', 
        `IsActive` = '{$data_insert['IsActive']}', 
        `CatId` = '{$data_insert['CatId']}', 
        `ImageSource` = '{$data_insert['ImageSource']}' 
        WHERE `ProductNum` = '{$data_insert['ProductNum']}'";
        echo $sql;
        if ($conn->query($sql) === TRUE) {
            $affected_rows = $conn->affected_rows;
            if ($affected_rows > 0) {
                echo "Record updated successfully";
                echo json_encode(true);
            } else {
                echo "No record was updated";
                echo json_encode(false);
            }
        } else {
            echo "Error updating record: " . $conn->error;
        }
        $conn->close();
    }
// ------------------------------------LấY thông tin sản phẩm để edit-----------------------------
if ($_SERVER["REQUEST_METHOD"] == "GET"){
    $table_name = $_GET['table_name'];
    $id = $_GET['productId'];
    
    // Get data from table
    $sql = "SELECT product.*, category.CatName FROM $table_name JOIN category on product.CatId = category.CatId WHERE ProductNum = '" . $id . "'";

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
    else echo"Khong tim thay san pham";
    echo json_encode($data);

    $conn->close();
}
