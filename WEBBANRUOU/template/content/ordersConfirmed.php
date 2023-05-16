<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$Whopay = $_SESSION["userId"];
?>

<div class="History-MainView">
    <div id="orders-confirmed-container" class="History-View">
        <div class="History-title_view">
            <a>- Lịch sử mua hàng -</a>
        </div>
        <div class="History-table_view">
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
                    <!-- Danh sách đơn hàng sẽ được tạo bởi JavaScript -->
                </tbody>
            </table>
        </div>
    </div>

    <!-- HTML chi tiết modal -->
    <div id="order-detail-modal" class="order-detail-modal">
        <div class="order-detail-modal-content">
            <span class="order-detail-modal-close">&times;</span>
            <div class="History-OrderDetail-title_view">
                <a>
                    Chi tiết đơn hàng
                </a>
            </div>
            <div class="History-OrderDetail-Main_View" id="order-detail"></div>
        </div>
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
                    row += "<td>" + toCurrency(order.Total) + " đ" + "</td>";
                    row += "<td>" + status + "</td>";
                    row += "<td><button class='btn-detail button-23' data-transact-id='" + order.TransactId + "'>Chi tiết</button></td>";
                    row += "</tr>";
                    orderList.innerHTML += row;
                }
                if (data.length === 0) {
                    var row = "<tr><td colspan=5>Hiện không có đơn hàng nào</td></tr>";
                    orderList.innerHTML += row;
                }
            }
        });
    });

    function toCurrency(totalCash) {
        return new Intl.NumberFormat('en-US').format(totalCash);
    };

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
                if (response.length > 0) {
                    let dateObj = new Date(response[0].TimePayment);
                    let formattedDate = dateObj.toLocaleTimeString('en-GB') + ' ' + dateObj.toLocaleDateString('en-GB');
                    let orderDetail = ""
                    orderDetail += "<div class='History-OrderDetail-Text_View'><p>Mã đơn hàng: <span>" + transactId + "</span></p>";
                    orderDetail += "<p>Thời gian: <span>" + formattedDate + "</span></p></div>";
                    orderDetail += "<div class='History-OrderDetail-Table_View'><table>";
                    orderDetail += "<thead>";
                    orderDetail += "<tr>";
                    orderDetail += "<th>Tên sản phẩm</th>";
                    orderDetail += "<th>Số lượng</th>";
                    orderDetail += "<th>Đơn giá</th>";
                    // orderDetail += "<th>Tổng tiền</th>";
                    orderDetail += "</tr>";
                    orderDetail += "</thead>";
                    orderDetail += "<tbody>";

                    for (var i = 0; i < response.length; i++) {
                        orderDetail += "<tr>";
                        orderDetail += "<td>" + response[i].ProductName + "</td>";
                        orderDetail += "<td>" + response[i].Quan + "</td>";
                        orderDetail += "<td>" + toCurrency(response[i].CostEach) + " đ" + "</td>";
                        orderDetail += "</tr>";
                    }
                    orderDetail += "</tbody>";
                    orderDetail += "</table></div>";
                    orderDetail += "<div class='History-OrderDetail-TongTien'><a>Thành tiền : </a><div><a>" + toCurrency(response[0].Total) + "</a><a>&nbsp;VND</a></div></div>";
                    // Hiển thị cửa sổ chi tiết đơn hàng

                    const orderDetailContent = document.getElementById('order-detail');
                    orderDetailContent.innerHTML = orderDetail;
                    orderDetailModal.style.display = 'block';
                }
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
    .History-MainView {
        width: 100%;
        min-height: 100%;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: flex-start;
        background-color: #ececec;
    }

    .History-View {
        width: 70%;
        background-color: #fff;
        border: 1px solid #000;
        border-radius: 10px;
        padding: 10px;
        margin-top: 20px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: flex-start;
    }

    .History-title_view {
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 10px;
    }

    .History-title_view a {
        font-size: 30px;
        font-weight: bold;
        color: #961313;
    }

    .History-table_view {
        width: 90%;
        border: 1px solid #000;
        border-radius: 10px;
        padding: 10px;
        margin-left: 10px;
        margin-right: 10px;
        margin-top: 10px;
        margin-bottom: 20px;
    }

    .History-OrderDetail-Main_View {
        width: 100%;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }

    .History-OrderDetail-title_view {
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .History-OrderDetail-title_view a {
        font-size: 30px;
        font-weight: bold;
    }

    .History-OrderDetail-Text_View {
        width: 100%;
        display: flex;
        flex-direction: row;
        align-items: center;
        justify-content: space-between;
        padding: 10px 40px;
    }

    .History-OrderDetail-Table_View {
        width: 90%;
        border: 1px solid #000;
        border-radius: 10px;
        padding: 10px;
    }

    .History-OrderDetail-TongTien {
        width: 100%;
        display: flex;
        flex-direction: row;
        align-items: center;
        justify-content: space-between;
        margin-top: 10px;
        padding: 0px 30px;
    }

    .History-OrderDetail-TongTien a {
        font-size: 25px;
        font-weight: bold;
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
        margin: 5% auto;
        padding: 20px;
        border: 1px solid #888;
        border-radius: 10px;
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

    .btn-detail {
        width: 100px !important;
        padding: 5px !important;
        background-color: #f2f2f2;
    }
</style>