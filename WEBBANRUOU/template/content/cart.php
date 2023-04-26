<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$Whopay = $_SESSION["userId"];

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
        // Xử lý lỗi theo cách phù hợp với ứng dụng của bạn, ví dụ:
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
//Đếm indexTS cho generateTempID
$sql2 = "SELECT TransactId FROM transactheader";
$result2 = mysqli_query($conn, $sql2);
// Đếm số lượng kết quả trả về
$indexTS = mysqli_num_rows($result2);
//Đếm indexTD cho generateTempID
$sql3 = "SELECT TransactDetailId FROM transactdetail";
$result3 = mysqli_query($conn, $sql3);
// Đếm số lượng kết quả trả về
$indexTD = mysqli_num_rows($result3);

//Hàm tạo ID  khi chưa có ID khả dụng
function generateTempID($indexTS, $conn)
{
    $tempID = "TS" . str_pad(($indexTS + 1), 5, "0", STR_PAD_LEFT);
    while (checkIfIDExists($tempID, $conn)) {
        $indexTS++;
        $tempID = "TS" . str_pad(($indexTS + 1), 5, "0", STR_PAD_LEFT);
    }
    return $tempID;
}
//Kiểm tra xem người dùng đã có giỏ hàng chưa
$sql = "SELECT * FROM transactheader WHERE WhoPay = '$Whopay' AND Status = 0";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    //Dang co gio hang
    while ($row = mysqli_fetch_assoc($result)) {
        $transactId = $row["TransactId"];
    }
} else {
    //Chua co gio hang
    $transactId = generateTempID($indexTS, $conn);
    $sql = "INSERT INTO `transactheader`(`TransactId`,`WhoPay`, `Status`)VALUES('$transactId','$Whopay',0)";
    $conn->query($sql);
}
//Giỏ hàng
$sql = "SELECT transactdetail.ProductNum, product.ProductName, transactdetail.Quan, transactdetail.CostEach, transactheader.Net
        FROM product, transactdetail, transactheader
        WHERE product.ProductNum = transactdetail.ProductNum 
        AND transactheader.TransactId = transactdetail.TransactId 
        AND transactheader.TransactId = '$transactId'";
$resultc = $conn->query($sql);

function updateTotalHH($transactId, $conn)
{
    $sql = "UPDATE transactheader SET Total = (
        SELECT SUM(CostEach * Quan)
        FROM transactdetail
        WHERE TransactId = '{$transactId}'
    )
    WHERE TransactId = '{$transactId}'";
    $conn->query($sql);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
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
        updateTotalHH($transactId, $conn);
    } else {
        // Sản phẩm chưa tồn tại trong hóa đơn
        $TransactDetailId = generateTempID($indexTD, $conn);
        $CostEach = floatval($productInfo["Price"]);
        $Total = $CostEach * $data_insert['productQuantity'];
        $sql = "INSERT INTO `transactdetail`(`TransactDetailId`,`ProductNum`,`CostEach`,`Total`,`Quan`,
        `Status`,`TransactId`) VALUES ('$TransactDetailId','{$data_insert["productId"]}','$CostEach',
         '$Total',{$data_insert['productQuantity']},'0','$transactId')";
        $conn->query($sql);
        updateTotalHH($transactId, $conn);
    }

    // Cập nhật tổng tiền trong hóa đơn

    $sql = "UPDATE transactHeader h
    JOIN (
        SELECT TransactId, SUM(Total) AS TotalSum
        FROM transactDetail
        GROUP BY TransactId
    ) d ON h.TransactId = d.TransactId
    SET h.Net = d.TotalSum";
    $conn->query($sql);
}
?>

<div id="cart-container">
    <h1>Giỏ hàng của bạn</h1>
    <table id="cart-cart-table">
        <thead>
            <tr>
                <th>Tên sản phẩm</th>
                <th>Số lượng</th>
                <th>Đơn giá</th>
                <th>Xóa sản phẩm</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // error_reporting(E_ERROR); 
            $totalCost = 0;
            foreach ($resultc as $row) :
                $productId = $row["ProductNum"];
                $productName = $row["ProductName"];
                $quantity = $row["Quan"];
                $price = $row["CostEach"];
                $totalPrice = $quantity * $price;
                $totalCost += $totalPrice;
            ?>
                <tr>
                    <td><?php echo $productName; ?></td>
                    <td>
                        <button class="btn-minus" data-product-id="<?php echo $productId; ?>">-</button>
                        <span id="quantity-<?php echo $productId; ?>"><?php echo $quantity; ?></span>
                        <button class="btn-plus" data-product-id="<?php echo $productId; ?>">+</button>
                    </td>
                    <td> <?php echo number_format($price); ?> đ
                    </td>
                    <td> <button class="btn-remove" data-product-id="<?php echo $productId; ?>"><i class="fa-regular fa-trash-can"></i></button>
                    </td>

                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <p><span id="totalPrice">Tổng tiền: <?php echo number_format($totalCost); ?> đ </span></p>

    <button onclick="">Thanh toán</button>
</div>
<script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://kit.fontawesome.com/44c01e1bca.js" crossorigin="anonymous"></script>

<script>
    //Ajax chỉnh sửa SL sản phẩm
    $(document).on('click', '.btn-plus, .btn-minus', function() {
        var transactId = "<?php echo $transactId; ?>";
        var productId = $(this).data('product-id');
        var quantityChange = $(this).hasClass('btn-plus') ? 1 : -1;

        $.ajax({
            type: 'POST',
            url: './template/dbconnection_UPDATE_QUANTITY.php',
            data: {
                productId: productId,
                quantityChange: quantityChange,
                transactId: transactId
            },
            success: function(response) {
                var decoded_json = JSON.parse(response);
                const count = Object.keys(decoded_json).length;
                if (count == 2) {
                    var quantityNew = decoded_json.Quan;
                    var totalPrice = decoded_json.Total;
                    $("#quantity-" + productId).text(quantityNew);
                    $("#totalPrice").text("Tổng tiền: " + parseFloat(totalPrice).toLocaleString('en-US', {
                        useGrouping: true
                    }) + " đ");
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Số lượng sản phẩm không hợp lệ',
                        showConfirmButton: false,
                        timer: 1500
                    });
                }

            }
        });

    });
    //Ajax xóa sản phẩm khỏi cart
    $(document).on('click', '.btn-remove', function() {
        
        Swal.fire({
            title: 'Bạn muốn bỏ sản phẩm ra khỏi giỏ hàng?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Đúng vậy'
        }).then((result) => {
            if (result.isConfirmed) {
                var transactId = "<?php echo $transactId; ?>";
                var productId = $(this).data('product-id');
                $.ajax({
                    type: 'POST',
                    url: './template/dbconnection_RMV_F_CART.php',
                    data: {
                        productId: productId,                        
                        transactId: transactId
                    },
                    success: function(response) {                        
                        console.log(response);
                        location.reload();
                    }
                });
            }
        })
    });
</script>
<style>
    #cart-container {
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    #cart-cart-table {
        width: 100%;
        border-collapse: collapse;
    }

    #cart-cart-table th,
    #cart-cart-table td {
        padding: 8px;
        border: 1px solid #ddd;
        text-align: center;
    }

    #cart-cart-table th {
        background-color: #f2f2f2;
    }

    #cart-cart-table td button {
        background-color: #f2f2f2;
        border: none;
        cursor: pointer;
    }

    #cart-cart-table td button:hover {
        background-color: #ddd;
    }

    #cart-cart-table td span {
        margin: 0 10px;
    }
</style>

<script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>