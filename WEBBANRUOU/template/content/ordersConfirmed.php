<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$Whopay = $_SESSION["userId"];
?>
<div id="orders-confirmed-container">
    <h1>Đơn hàng đã xử lý </h1>
    <br>
    <table>
        <thead>
            <tr>
                <th>Mã đơn hàng</th>
                <th>Ngày đặt hàng</th>
                <th>Tổng tiền</th>
                <th>Trạng thái</th>
                <th>Chi tiết</th>
            </tr>
        </thead>
        <tbody id="order-list">
            <!-- Danh sách đơn hàng sẽ được tạo bởi JavaScript -->
        </tbody>
    </table>
</div>

<!-- HTML chi tiết modal -->
<div id="order-detail-modal" class="order-detail-modal">
    <div class="order-detail-modal-content">

        <span class="order-detail-modal-close">&times;</span>
        <p id="order-detail"></p>
    </div>
</div>

<script>
    var userID = '0';
    try {
        userID = '<?php echo $Whopay; ?>';
    } catch (e) {
        console.log(e);
    };
    // Gửi yêu cầu lấy danh sách đơn hàng từ máy chủ
    $(document).ready(function() {
        $.ajax({
            type: "POST",
            url: "./template/dbconnection_Orders_Processing.php",
            dataType: "json",
            data: {
                userID: userID,
                action: "getConfirmedList"
            },
            success: function(data) {                
                var orderList = document.getElementById("order-list");
                for (var i = 0; i < data.length; i++) {
                    var order = data[i];
                    var status = (order.Status == 2) ? "Đã xác nhận" : "Bị hủy";
                    let dateObj = new Date(order.TimePayment);
                    let formattedDate = dateObj.toLocaleTimeString('en-GB') + ' ' + dateObj.toLocaleDateString('en-GB');

                    var row = "<tr>";
                    row += "<td>" + order.TransactId + "</td>";
                    row += "<td>" + formattedDate + "</td>";
                    row += "<td>" + formatNumber(order.Total) + " đ" + "</td>";
                    row += "<td>" + status + "</td>";
                    row += "<td><button class='btn-detail button-23' data-transact-id='" + order.TransactId + "'>Chi tiết</button></td>";
                    row += "</tr>";
                    orderList.innerHTML += row;
                }
            }
        });
    });

    function formatNumber(number) {
        return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }

    // Chi tiết sản phẩm

    // var productId = $(this).data('product-id');
    $(document).on('click', '.btn-detail', function() {
        const orderDetailModal = document.getElementById('order-detail-modal');
        let transactId = $(this).data('transact-id');
        $.ajax({
            type: "POST",
            url: "./template/dbconnection_Orders_Processing.php",
            dataType: "json",
            data: {
                userID: userID,
                action: 'getConfirmedDetails',
                transactId: transactId
            },
            success: function(response) {
                // console.log(response);
                let dateObj = new Date(response[0].TimePayment);
                let formattedDate = dateObj.toLocaleTimeString('en-GB') + ' ' + dateObj.toLocaleDateString('en-GB');
                let orderDetail = ""
                orderDetail += "<table>";
                orderDetail += "<p>Chi tiết đơn hàng: <span>" + transactId + "</span></p>";
                orderDetail += "<p>Tổng cộng: <span>" + formatNumber(response[0].Total) + " đ" + "</span></p>";
                orderDetail += "<p>Thời gian: <span>" + formattedDate + "</span></p>";
                orderDetail += "<thead>";
                orderDetail += "<tr>";
                orderDetail += "<th>Tên sản phẩm</th>";
                orderDetail += "<th>Số lượng</th>";
                orderDetail += "<th>Đơn giá</th>";
                orderDetail += "</tr>";
                orderDetail += "</thead>";
                orderDetail += "<tbody>";

                for (var i = 0; i < response.length; i++) {
                    orderDetail += "<tr>";
                    orderDetail += "<td>" + response[i].ProductName + "</td>";
                    orderDetail += "<td>" + response[i].Quan + "</td>";
                    orderDetail += "<td>" + formatNumber(response[i].CostEach) + " đ" + "</td>";
                    orderDetail += "</tr>";
                }
                orderDetail += "</tbody>";
                orderDetail += "</table>";
                // Hiển thị cửa sổ chi tiết đơn hàng

                const orderDetailContent = document.getElementById('order-detail');
                orderDetailContent.innerHTML = orderDetail;
                orderDetailModal.style.display = 'block';
            }
        })

        const orderDetailClose = document.getElementsByClassName('order-detail-modal-close')[0];
        orderDetailClose.addEventListener('click', () => {
            orderDetailModal.style.display = 'none';
        });
    });
    // Thêm sự kiện click vào nút đóng cửa sổ để ẩn cửa sổ chi tiết đơn hàng
</script>
<style>
    #orders-confirmed-container {
        max-width: 90%; 
        min-width: 600px;       
        
        /* margin-left: 500px; */
        padding: 1rem;        
        font-weight: bold;
        display: flex;
        flex-direction: column;
        align-items: center;
        color: #961313;
        margin: 10px 10px 500px 500px;
        border:2px solid #ccc; 
    }

    #orders-confirmed-container table,
    .order-detail-modal-content table {
        border-collapse: collapse;
        width: 100%;
        margin: 0 auto;
        text-align: center;
    }

    #orders-confirmed-container th,
    #orders-confirmed-container td,
    .order-detail-modal-content th,
    .order-detail-modal-content td {
        text-align: left;
        padding: 8px;
        border-bottom: 1px solid #ddd;
    }

    #orders-confirmed-container th,
    .order-detail-modal-content th {
        background-color: #f2f2f2;
    }

    #orders-confirmed-container td:nth-child(1) {
        text-align: center;
        width: 120px;
    }

    #orders-confirmed-container td:nth-child(2) {
        text-align: left;
        width: 300px;
    }

    #orders-confirmed-container td:nth-child(3) {
        text-align: right;
        width: 150px;
    }

    #orders-confirmed-container td:nth-child(4) {
        text-align: center;
        width: 120px;
    }

    .order-detail-modal {
        display: none;
        position: fixed;
        z-index: 1;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgba(0, 0, 0, 0.4);
    }

    .order-detail-modal-content {
        background-color: #fefefe;
        margin: 10% auto;
        padding: 20px;
        border: 1px solid #888;
        width: 80%;
        min-width: 700px;
        max-width: 800px;
    }

    .order-detail-modal-close {
        color: #aaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
    }

    .order-detail-modal-close:hover,
    .order-detail-modal-close:focus {
        color: black;
        text-decoration: none;
        cursor: pointer;
    }

    .order-detail-modal-content p {
        padding: 5px;
    }

    .order-detail-modal-content span {
        font-weight: bold;
    }
</style>