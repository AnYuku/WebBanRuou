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

function checkIfIDExists($tempID, $conn)
{
    $sql = "SELECT TransactId FROM transactheader WHERE TransactId = '$tempID'";
    $result = mysqli_query($conn, $sql);
    if (!$result) {
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

function generateTempID($isTS, $conn)
{
    if ($isTS) {
        //Đếm indexTS cho generateTempID
        $sql2 = "SELECT TransactId FROM transactheader";
        $result2 = mysqli_query($conn, $sql2);
        // Đếm số lượng kết quả trả về
        $indexTS = mysqli_num_rows($result2);
        $tempID = "TS" . str_pad(($indexTS + 1), 5, "0", STR_PAD_LEFT);
        while (checkIfIDExists($tempID, $conn)) {
            $indexTS++;
            $tempID = "TS" . str_pad(($indexTS + 1), 5, "0", STR_PAD_LEFT);
        }
        return $tempID;
    } else {
        //Đếm indexTD cho generateTempID
        $sql3 = "SELECT TransactDetailId FROM transactdetail";
        $result3 = mysqli_query($conn, $sql3);
        // Đếm số lượng kết quả trả về
        $indexTD = mysqli_num_rows($result3);
        $tempID = "TD" . str_pad(($indexTD + 1), 5, "0", STR_PAD_LEFT);
        while (checkIfIDExists($tempID, $conn)) {
            $indexTD++;
            $tempID = "TD" . str_pad(($indexTD + 1), 5, "0", STR_PAD_LEFT);
        }
        return $tempID;
    }
}

// Kiểm tra xem đã có giỏ hàng hay chưa

$Whopay = $_POST['userID'];
$sql = "SELECT * FROM transactheader WHERE WhoPay = '$Whopay' AND Status = 0";
$result = $conn->query($sql);
// Đếm số lượng index
if ($result->num_rows > 0) {
    //Dang co gio hang
    while ($row = mysqli_fetch_assoc($result)) {
        $transactId = $row["TransactId"];
    }
    // echo json_encode($transactId);
} else {
    //Chua co gio hang
    $transactId = generateTempID(1, $conn);
    $sql = "INSERT INTO `transactheader`(`TransactId`,`WhoPay`, `Status`)VALUES('$transactId','$Whopay',0)";
    $conn->query($sql);
    // echo json_encode($transactId);
}

$json_data = $_POST['productDataToCart'];
$data_insert = json_decode($json_data, true);

// Lấy thông tin sản phẩm
$sql = "SELECT Price FROM product WHERE ProductNum = '{$data_insert["productId"]}'";
$result = $conn->query($sql);
$productInfo = $result->fetch_assoc();

// Kiểm tra sản phẩm đã tồn tại trong hóa đơn hay chưa
$sql = "SELECT * FROM transactdetail WHERE TransactId = '{$transactId}' AND ProductNum = '{$data_insert["productId"]}'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    // Sản phẩm đã tồn tại trong hóa đơn
    $row = $result->fetch_assoc();
    $TransactDetailId = $row["TransactDetailId"];
    $Quan = $row["Quan"] + $data_insert['productQuantity'];
    $Total = $productInfo["Price"] * $Quan;
    $sql = "UPDATE transactdetail SET Quan = {$Quan}, Total = {$Total} WHERE TransactDetailId = '{$TransactDetailId}'";
    $conn->query($sql);
    //Cập nhật tổng hóa đơn
    $sql = "UPDATE transactheader SET Net = (
        SELECT SUM(CostEach * Quan)
        FROM transactdetail
        WHERE TransactId = '{$transactId}'
    ), Total = (
        SELECT SUM(CostEach * Quan)
        FROM transactdetail
        WHERE TransactId = '{$transactId}'
    )
    WHERE TransactId = '{$transactId}'";
    $conn->query($sql);
} else {
    // Sản phẩm chưa tồn tại trong hóa đơn
    $TransactDetailId = generateTempID(0, $conn);
    $CostEach = floatval($productInfo["Price"]);
    $Total = $CostEach * $data_insert['productQuantity'];
    $sql = "INSERT INTO `transactdetail`(`TransactDetailId`,`ProductNum`,`CostEach`,`Tax1`,`Tax2`,`Tax3`,`Total`,`Quan`,
        `Status`,`TransactId`) VALUES ('$TransactDetailId','{$data_insert["productId"]}','$CostEach',0,0,0,
         '$Total',{$data_insert['productQuantity']},'0','$transactId')";
    $conn->query($sql);
    //Cập nhật tổng hóa đơn
    $sql = "UPDATE transactheader SET Net = (
        SELECT SUM(CostEach * Quan)
        FROM transactdetail
        WHERE TransactId = '{$transactId}'
    ), Total = (
        SELECT SUM(CostEach * Quan)
        FROM transactdetail
        WHERE TransactId = '{$transactId}'
    )
    WHERE TransactId = '{$transactId}'";
    $conn->query($sql);
}

// $array = array(
//     "productId" => $data_insert["productId"],
//     "productQuantity" => $data_insert["productQuantity"],
//     "transactId" => $transactId,
//     "TransactDetailId" => $TransactDetailId
// );
// echo json_encode($array);
echo json_encode(true);
