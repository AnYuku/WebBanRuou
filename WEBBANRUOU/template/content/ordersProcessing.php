<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$Whopay = $_SESSION["userId"];
?>

<div class="Main_view_order_processing">
    <div id="orders-processing-container">
        <div class="order_processing-title">
            <h1>- Đơn hàng đang xử lý -</h1>
        </div>
        <br>
        <div>
            <table>
                <thead>
                    <tr>
                        <th>Mã đơn hàng</th>
                        <th>Ngày đặt hàng</th>
                        <th>Tổng tiền</th>
                        <th>Trạng thái</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody id="order-list">
                </tbody>
            </table>
        </div>
    </div>

    <div id="order-detail-modal" class="order-detail-modal">
        <div class="order-detail-modal-content">
            <span class="order-detail-modal-close">&times;</span>
            <div class="order_processing-title order_processing-detail-text">
                <a>Chi tiết đơn hàng</a>
            </div>
            <p id="order-detail"></p>
        </div>
    </div>
</div>

<script>
    userID = '0';
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
                action: "getList"
            },
            success: function(data) {
                var orderList = document.getElementById("order-list");
                for (var i = 0; i < data.length; i++) {
                    var order = data[i];
                    var status = (order.Status == 1) ? "Đang chờ xử lý" : "Lỗi";
                    let dateObj = new Date(order.TimePayment);
                    let formattedDate = dateObj.toLocaleTimeString('en-GB') + ' ' + dateObj.toLocaleDateString('en-GB');

                    var row = "<tr>";
                    row += "<td>" + order.TransactId + "</td>";
                    row += "<td>" + formattedDate + "</td>";
                    row += "<td>" + formatNumber(order.Total) + " đ" + "</td>";
                    row += "<td>" + status + "</td>";
                    row += "<td><button class='btn-detail button-23 style_button_order_processing' data-transact-id='" + order.TransactId + "'>Chi tiết</button></td>";
                    row += "</tr>";
                    orderList.innerHTML += row;
                }
                if (data.length === 0) {
                    var row = "<tr><td colspan=5>Hiện không có đơn hàng nào</td></tr>";
                    orderList.innerHTML += row;
                }
            },
            error: function(xhr, status, error) {
                alert(status);
                console.log(xhr.responseText);
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
                action: 'getDetails',
                transactId: transactId
            },
            success: function(response) {
                console.log('response:', response);
                let dateObj = new Date(response[0].TimePayment);
                let formattedDate = dateObj.toLocaleTimeString('en-GB') + ' ' + dateObj.toLocaleDateString('en-GB');
                let orderDetail = ""
                orderDetail += "<div class='order_processing-detail_title'><p>Mã đơn hàng: <span>" + transactId + "</span></p>";
                orderDetail += "<p>Thời gian thanh toán: <span>" + formattedDate + "</span></p></div>";
                orderDetail += "<div class='order_processing-table_view'><table>";
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
                orderDetail += "</table></div>";
                // orderDetail += "<div class='order_processing-line'><div class='line'></div></div>";
                orderDetail += "<div class='order_processing-thanhTienView'><div><p>Tổng tiền thanh toán:</p></div><div><span>" + formatNumber(response[0].Total) + " đ" + "</span></div></div>";
                // Hiển thị cửa sổ chi tiết đơn hàng

                const orderDetailContent = document.getElementById('order-detail');
                orderDetailContent.innerHTML = orderDetail;
                orderDetailModal.style.display = 'block';
            },
            error: function(xhr, status, error) {
                reject(error);
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
    .style_button_order_processing {
        display: block !important;
        background-color: #ececec !important;
        width: 80px !important;
        height: 30px !important;
        padding: 5px !important;
    }

    .Main_view_order_processing {
        z-index: 2;
        width: 100%;
        min-height: 100%;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: flex-start;
        background-color: #ececec;
    }

    .order_processing-title {
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .order_processing-detail-text a {
        font-size: 30px;
        font-weight: bold;
    }

    .order_processing-line {
        margin-top: 20px !important;
        margin-bottom: 10px !important;
    }

    .order_processing-thanhTienView {
        width: 100%;
        display: flex;
        flex-direction: row;
        justify-content: space-between;
        padding-right: 10%;
        margin-top: 10px;
    }

    .order_processing-thanhTienView div p {
        color: black;
        font-weight: bold;
        font-size: 20px !important;
    }

    .order_processing-thanhTienView div span {
        font-size: 20px !important;
    }

    .order_processing-table_view {
        width: 100%;
        padding: 5px;
        border: 1px solid #000;
        border-radius: 5px;
    }

    .order_processing-detail_title {
        width: 100%;
        display: flex;
        flex-direction: row;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 10px;
        margin-top: 40px;
    }

    #orders-processing-container {
        color: #961313;
        border: 2px solid #000;
        background-color: #fff;
        padding: 15px;
        border-radius: 10px;
        margin-top: 20px;
        margin-bottom: 20px;
    }

    #orders-processing-container table,
    .order-detail-modal-content table {
        border-collapse: collapse;
        width: 100%;
        margin: 0 auto;
        text-align: center;
    }

    #orders-processing-container th,
    #orders-processing-container td,
    .order-detail-modal-content th,
    .order-detail-modal-content td {
        text-align: left;
        padding: 8px;
        border-bottom: 1px solid #ddd;
    }

    #orders-processing-container th,
    .order-detail-modal-content th {
        background-color: #f2f2f2;
    }

    #orders-processing-container td:nth-child(1) {
        text-align: center;
        width: 120px;
    }

    #orders-processing-container td:nth-child(2) {
        text-align: left;
        width: 300px;
    }

    #orders-processing-container td:nth-child(3) {
        text-align: right;
        width: 150px;
    }

    #orders-processing-container td:nth-child(4) {
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
        border: 2px solid #888;
        width: 70%;
        border-radius: 10px;
    }

    .order-detail-modal-close {
        color: black;
        float: right;
        font-size: 40px;
        font-weight: bold;
    }

    .order-detail-modal-close:hover,
    .order-detail-modal-close:focus {
        color: #961313;
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