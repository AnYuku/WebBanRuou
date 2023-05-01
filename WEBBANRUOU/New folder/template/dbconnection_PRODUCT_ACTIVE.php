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
    // Get data from table
    $productID=$_POST['productId'];
    $isActive=$_POST['isActive'];
    if($isActive == 1){
        $sql = $conn->query("UPDATE `product` SET `IsActive`='0' WHERE `ProductNum` = '$productID'");
        echo json_encode(intval(0));
    }
    else{
        $sql = $conn->query("UPDATE `product` SET `IsActive`='1' WHERE `ProductNum` = '$productID'");
        echo json_encode(intval(1));
    }    
    $conn->close();
?>