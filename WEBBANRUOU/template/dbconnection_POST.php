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
    $json_data = $_POST['data_insert'];
    $data_insert = json_decode($json_data, true);

    // Get data from table
    $sql = "";
    if($table_name == "taxinfo") {
        $sql = "INSERT INTO taxinfo(TaxId, TaxDes, TaxRate, IsActive) VALUES ('{$data_insert['TaxId']}','{$data_insert['TaxDes']}','{$data_insert['TaxRate']}', {$data_insert['IsActive']});";
    } else if ($table_name == "useraccount") {
        $sql = "INSERT INTO `useraccount`(`UserId`, `UserName`, `UserPassword`, `AccessLevel`, `TotalCash`, `IsActive`, `Email`, `Address`) VALUES ('{$data_insert['UserId']}','{$data_insert['UserName']}','{$data_insert['UserPassword']}','{$data_insert['AccessLevel']}','{$data_insert['TotalCash']}','{$data_insert['IsActive']}','{$data_insert['Email']}','{$data_insert['Address']}')";
    } else if ($table_name == "transactdetails") {
        $sql = "INSERT INTO `transactdetail`(`TransactDetailId`, `ProductNum`, `CostEach`, `Tax1`, `Tax2`, `Tax3`, `Total`, `Quan`, `Status`, `TransactId`) VALUES ('TransactDetailId','{$data_insert['ProductNum']}','{$data_insert['CostEach']}','{$data_insert['Tax1']}','{$data_insert['Tax2']}','{$data_insert['Tax3']}','{$data_insert['Total']}','{$data_insert['Quan']}','{$data_insert['Status']}','{$data_insert['TransactId']}')";
    } else if ($table_name == "transactheader") {
        $sql = "INSERT INTO `transactheader`(`TransactId`, `Net`, `Tax1`, `Tax2`, `Tax3`, `Total`, `TimePayment`, `WhoPay`, `Status`) VALUES ('{{$data_insert['TransactId']}','{{$data_insert['Net']}','{{$data_insert['Tax1']}','{{$data_insert['Tax2']}','{{$data_insert['Tax3']}','{{$data_insert['Total']}','{{$data_insert['TimePayment']}','{{$data_insert['WhoPay']}','{{$data_insert['Status']}')";
    } else if ($table_name == "product") {
        $sql = "INSERT INTO `product`(`ProductNum`, `ProductName`, `Descript`, `Price`, `Tax1`, `Tax2`, `Tax3`, `Quan`, `IsActive`, `CatId`, `ImageSource`) VALUES ('{$data_insert['ProductNum']}', '{$data_insert['ProductName']}','{$data_insert['Descript']}','{$data_insert['Price']}','{$data_insert['Tax1']}','{$data_insert['Tax2']}','{$data_insert['Tax3']}','{$data_insert['Quan']}','{$data_insert['IsActive']}','{$data_insert['CatId']}','{$data_insert['ImageSource']}')";
    } else if ($table_name == "productcombo") {
        $sql = "INSERT INTO `productcombo`(`ProductComboId`, `Descript`, `ProductLinkNum`, `IsActive`) VALUES ('{$data_insert['ProductComboId']}','{$data_insert['Descript']}','{{$data_insert['ProductLinkNum']}','{$data_insert['IsActive']}')";
    } else if ($table_name == "paymentmethod") {
        $sql = "INSERT INTO `paymentmethod`(`PaymentId`, `PaymentName`, `Descript`) VALUES ('{$data_insert['PaymentId']}','{$data_insert['PaymentName']}','{$data_insert['Descript']}')";
    } else if ($table_name == "category") {
        $sql = "INSERT INTO `category`(`CatId`, `CatName`, `Descript`, `IsActive`) VALUES ('{$data_insert['CatId']}','{$data_insert['CatName']}','{$data_insert['Descript']}','{$data_insert['IsActive']}');";
    } else {
        // None
    }    

    $conn->query($sql);
    echo json_encode(true);

    $conn->close();
?>