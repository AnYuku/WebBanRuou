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
    if($table_name == "taxinfo") {
        if(isset($data_update['TaxDes'])) {
            $sql = "UPDATE `taxinfo` SET `TaxDes`='{$data_update['TaxDes']}' WHERE TaxId = '{$data_update['TaxId']}'";
            $conn->query($sql);
        }
        if(isset($data_update['TaxRate'])) {
            $sql = "UPDATE `taxinfo` SET `TaxRate`='{$data_update['TaxRate']}' WHERE TaxId = '{$data_update['TaxId']}'";
            $conn->query($sql);
        }
        if(isset($data_update['IsActive'])) {
            $sql = "UPDATE `taxinfo` SET `IsActive`='{$data_update['IsActive']}' WHERE TaxId = '{$data_update['TaxId']}'";
            $conn->query($sql);
        }
    } else if ($table_name == "useraccount") {
        //UserName
        if(isset($data_update['UserName'])) {
            $sql = "UPDATE `taxinfo` SET `UserName`='{$data_update['UserName']}' WHERE UserId = '{$data_update['UserId']}'";
            $conn->query($sql);
        }
        //UserPassword
        if(isset($data_update['UserPassword'])) {
            $sql = "UPDATE `taxinfo` SET `UserPassword`='{$data_update['UserPassword']}' WHERE UserId = '{$data_update['UserId']}'";
            $conn->query($sql);
        }
        //AccessLevel
        if(isset($data_update['AccessLevel'])) {
            $sql = "UPDATE `taxinfo` SET `AccessLevel`='{$data_update['AccessLevel']}' WHERE UserId = '{$data_update['UserId']}'";
            $conn->query($sql);
        }
        //TotalCash
        if(isset($data_update['TotalCash'])) {
            $sql = "UPDATE `taxinfo` SET `TotalCash`='{$data_update['TotalCash']}' WHERE UserId = '{$data_update['UserId']}'";
            $conn->query($sql);
        }
        //IsActive
        if(isset($data_update['IsActive'])) {
            $sql = "UPDATE `taxinfo` SET `IsActive`='{$data_update['IsActive']}' WHERE UserId = '{$data_update['UserId']}'";
            $conn->query($sql);
        }
        //Email
        if(isset($data_update['Email'])) {
            $sql = "UPDATE `taxinfo` SET `Email`='{$data_update['Email']}' WHERE UserId = '{$data_update['UserId']}'";
            $conn->query($sql);
        }
        //Address
        if(isset($data_update['Address'])) {
            $sql = "UPDATE `taxinfo` SET `Address`='{$data_update['Address']}' WHERE UserId = '{$data_update['UserId']}'";
            $conn->query($sql);
        }
    } else if ($table_name == "transactdetails") {
        // Only update status transaction details
        if(isset($data_update['Status'])) {
            $sql = "UPDATE `transactdetails` SET `Status`='{$data_update['Status']}' WHERE TransactId = '{$data_update['TransactId']}'";
            $conn->query($sql);
        }
    } else if ($table_name == "transactheader") {
        // Only update status transaction header
        if(isset($data_update['Status'])) {
            $sql = "UPDATE `transactheader` SET `Status`='{$data_update['Status']}' WHERE TransactId = '{$data_update['TransactId']}'";
            $conn->query($sql);
        }
    } else if ($table_name == "product") {
        //ProductName
        if(isset($data_update['ProductName'])) {
            $sql = "UPDATE `product` SET `ProductName`='{$data_update['ProductName']}' WHERE `ProductNum` = '{$data_update['ProductNum']}'";
            $conn->query($sql);
        }
        //Descript
        if(isset($data_update['Descript'])) {
            $sql = "UPDATE `product` SET `Descript`='{$data_update['Descript']}' WHERE `ProductNum` = '{$data_update['ProductNum']}'";
            $conn->query($sql);
        }
        //Price
        if(isset($data_update['Price'])) {
            $sql = "UPDATE `product` SET `Price`='{$data_update['Price']}' WHERE `ProductNum` = '{$data_update['ProductNum']}'";
            $conn->query($sql);
        }
        //Tax1
        if(isset($data_update['Tax1'])) {
            $sql = "UPDATE `product` SET `Tax1`='{$data_update['Tax1']}' WHERE `ProductNum` = '{$data_update['ProductNum']}'";
            $conn->query($sql);
        }
        //Tax2
        if(isset($data_update['Tax2'])) {
            $sql = "UPDATE `product` SET `Tax2`='{$data_update['Tax2']}' WHERE `ProductNum` = '{$data_update['ProductNum']}'";
            $conn->query($sql);
        }
        //Tax3
        if(isset($data_update['Tax3'])) {
            $sql = "UPDATE `product` SET `Tax3`='{$data_update['Tax3']}' WHERE `ProductNum` = '{$data_update['ProductNum']}'";
            $conn->query($sql);
        }
        //Quan
        if(isset($data_update['Quan'])) {
            $sql = "UPDATE `product` SET `Quan`='{$data_update['Quan']}' WHERE `ProductNum` = '{$data_update['ProductNum']}'";
            $conn->query($sql);
        }
        //IsActive
        if(isset($data_update['IsActive'])) {
            $sql = "UPDATE `product` SET `IsActive`='{$data_update['IsActive']}' WHERE `ProductNum` = '{$data_update['ProductNum']}'";
            $conn->query($sql);
        }
        //CatId
        if(isset($data_update['CatId'])) {
            $sql = "UPDATE `product` SET `CatId`='{$data_update['CatId']}' WHERE `ProductNum` = '{$data_update['ProductNum']}'";
            $conn->query($sql);
        }
        //ImageSource
        if(isset($data_update['ImageSource'])) {
            $sql = "UPDATE `product` SET `ImageSource`='{$data_update['ImageSource']}' WHERE `ProductNum` = '{$data_update['ProductNum']}'";
            $conn->query($sql);
        }
    } else if ($table_name == "productcombo") {
        //Descript
        if(isset($data_update['Descript'])) {
            $sql = "UPDATE `productcombo` SET `Descript`='{$data_update['Descript']}' WHERE `ProductComboId` = '{$data_update['ProductComboId']}'";
            $conn->query($sql);
        }
        //ProductLinkNum
        if(isset($data_update['ProductLinkNum'])) {
            $sql = "UPDATE `productcombo` SET `ProductLinkNum`='{$data_update['ProductLinkNum']}' WHERE `ProductComboId` = '{$data_update['ProductComboId']}'";
            $conn->query($sql);
        }
        //IsActive
        if(isset($data_update['IsActive'])) {
            $sql = "UPDATE `productcombo` SET `IsActive`='{$data_update['IsActive']}' WHERE `ProductComboId` = '{$data_update['ProductComboId']}'";
            $conn->query($sql);
        }
    } else if ($table_name == "paymentmethod") {
        //PaymentName
        if(isset($data_update['PaymentName'])) {
            $sql = "UPDATE `paymentmethod` SET `PaymentName`='{$data_update['PaymentName']}' WHERE `PaymentId` = '{$data_update['PaymentId']}'";
            $conn->query($sql);
        }
        //Descript
        if(isset($data_update['Descript'])) {
            $sql = "UPDATE `paymentmethod` SET `Descript`='{$data_update['Descript']}' WHERE `PaymentId` = '{$data_update['PaymentId']}'";
            $conn->query($sql);
        }
    } else if ($table_name == "category") {
        //CatName
        if(isset($data_update['CatName'])) {
            $sql = "UPDATE `category` SET `CatName`='{$data_update['CatName']}' WHERE `CatId` = '{$data_update['CatId']}'";
            $conn->query($sql);
        }
        //Descript
        if(isset($data_update['Descript'])) {
            $sql = "UPDATE `category` SET `Descript`='{$data_update['Descript']}' WHERE `CatId` = '{$data_update['CatId']}'";
            $conn->query($sql);
        }
        //IsActive
        if(isset($data_update['IsActive'])) {
            $sql = "UPDATE `category` SET `Descript`='{$data_update['IsActive']}' WHERE `CatId` = '{$data_update['CatId']}'";
            $conn->query($sql);
        }
    } else {
        // None
    }  

    
    echo json_encode(true);

    $conn->close();
?>