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

    $table_name = $_POST['table_name'];
    $id_object = $_POST['id_object']; // Xóa cái nào thì POST id của đối tượng đó

    $sql = "";
    if($table_name == "taxinfo") {
        $sql = "DELETE FROM `taxinfo` WHERE TaxId = '{$id_object}'";
    } else if ($table_name == "useraccount") {
        $sql = "DELETE FROM `useraccount` WHERE UserId='{$id_object}'";
    } else if ($table_name == "transactdetails") {
        $sql = "DELETE FROM `transactdetail` WHERE TransactDetailId='{$id_object}'";
    } else if ($table_name == "transactheader") {
        $sql = "DELETE FROM `transactdetail` WHERE TransactId = '{$id_object}';" + 
                "DELETE FROM `transactheader` WHERE TransactId = '{$id_object}'";
    } else if ($table_name == "product") {
        $sql = "DELETE FROM `product` WHERE ProductNum = '{$id_object}'";
    } else if ($table_name == "productcombo") {
        $sql = "DELETE FROM `productcombo` WHERE ProductComboId = '{$id_object}'";
    } else if ($table_name == "paymentmethod") {
        $sql = "DELETE FROM `paymentmethod` WHERE PaymentId='{$id_object}'";
    } else if ($table_name == "category") {
        $sql = "DELETE FROM `product` WHERE CatId = '{$id_object}';" + 
                "DELETE FROM `category` WHERE CatId = '{$id_object}';";
    } else {
        // None
    }  

    $conn->query($sql);
    echo json_encode(true);

    $conn->close();
?>