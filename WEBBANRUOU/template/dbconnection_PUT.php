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
$json_data = $_POST['data_update'];
$data_update = json_decode($json_data, true);

$sql = "";
if ($table_name == "taxinfo") {
    if (isset($data_update['TaxDes'])) {
        $sql = "UPDATE `taxinfo` SET `TaxDes`='{$data_update['TaxDes']}' WHERE TaxId = '{$data_update['TaxId']}'";
        $conn->query($sql);
    }
    if (isset($data_update['TaxRate'])) {
        $sql = "UPDATE `taxinfo` SET `TaxRate`='{$data_update['TaxRate']}' WHERE TaxId = '{$data_update['TaxId']}'";
        $conn->query($sql);
    }
    if (isset($data_update['IsActive'])) {
        $sql = "UPDATE `taxinfo` SET `IsActive`='{$data_update['IsActive']}' WHERE TaxId = '{$data_update['TaxId']}'";
        $conn->query($sql);
    }
} else if ($table_name == "useraccount") {
    //UserName
    if (isset($data_update['UserName'])) {
        $sql = "UPDATE `$table_name` SET `UserName`='{$data_update['UserName']}' WHERE UserId = '{$data_update['UserId']}'";
        $conn->query($sql);
    }
    //UserPassword
    if (isset($data_update['UserPassword'])) {
        $sql = "UPDATE `$table_name` SET `UserPassword`='{$data_update['UserPassword']}' WHERE UserId = '{$data_update['UserId']}'";
        $conn->query($sql);
    }
    //AccessLevel
    if (isset($data_update['AccessLevel'])) {
        $sql = "UPDATE `$table_name` SET `AccessLevel`='{$data_update['AccessLevel']}' WHERE UserId = '{$data_update['UserId']}'";
        $conn->query($sql);
    }
    //TotalCash
    if (isset($data_update['TotalCash'])) {
        $sql = "UPDATE `$table_name` SET `TotalCash`='{$data_update['TotalCash']}' WHERE UserId = '{$data_update['UserId']}'";
        $conn->query($sql);
    }
    if (isset($data_update['TotalCashDec'])) {
        $sql = "UPDATE `$table_name` SET `TotalCash`= `TotalCash` - '{$data_update['TotalCashDec']}' WHERE UserId = '{$data_update['UserId']}'";
        $conn->query($sql);
    }
    //IsActive
    if (isset($data_update['IsActive'])) {
        $sql = "UPDATE `$table_name` SET `IsActive`='{$data_update['IsActive']}' WHERE UserId = '{$data_update['UserId']}'";
        $conn->query($sql);
    }
    //Email
    if (isset($data_update['Email'])) {
        $sql = "UPDATE `$table_name` SET `Email`='{$data_update['Email']}' WHERE UserId = '{$data_update['UserId']}'";
        $conn->query($sql);
    }
    //Address
    if (isset($data_update['Address'])) {
        $sql = "UPDATE `$table_name` SET `Address`='{$data_update['Address']}' WHERE UserId = '{$data_update['UserId']}'";
        $conn->query($sql);
    }
} else if ($table_name == "transactdetails") {
    $sql = "";
} else if ($table_name == "transactheader") {
    $sql = "UPDATE `$table_name` SET `Status`='{$data_update['Status']}' WHERE TransactId = '{$data_update['TransactId']}'";
    $conn->query($sql);
} else if ($table_name == "product") {
    if (isset($data_update['QuanDec'])) {
        $sql = "UPDATE `product` SET `Quan`= `Quan` - '{$data_update['QuanDec']}' WHERE ProductNum = '{$data_update['ProductNum']}'";
        $conn->query($sql);
    }
} else if ($table_name == "productcombo") {
    $sql = "";
} else if ($table_name == "paymentmethod") {
    $sql = "";
} else if ($table_name == "category") {
    $sql = "";
} else {
    // None
}


echo json_encode(true);

$conn->close();
