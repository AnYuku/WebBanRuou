<div class="table_confirm_order_view">
    <div class="content_admin_table_view">
        <table class="content_admin_table" id="table_order">
            <thead class="content_admin_table_thead">
                <tr>
                    <th>Mã đơn hàng</th>
                    <th>Thời gian thanh toán</th>
                    <th>Trạng thái</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody class="content_admin_table_tbody">

            </tbody>
        </table>
    </div>
</div>

<script>
    function formatDateTime(dateTime) {
        const dateString = dateTime + "";
        const dateObj = new Date(dateString);
        const hours = dateObj.getHours();
        const minutes = dateObj.getMinutes();
        const seconds = dateObj.getSeconds();
        const period = hours >= 12 ? "PM" : "AM";
        const hoursFormatted = hours % 12 || 12;
        const timeString = `${hoursFormatted.toString().padStart(2, "0")}:${minutes.toString().padStart(2, "0")}:${seconds.toString().padStart(2, "0")} ${period}`;
        const dateStringFormatted = `${dateObj.getDate().toString().padStart(2, "0")}/${(dateObj.getMonth() + 1).toString().padStart(2, "0")}/${dateObj.getFullYear()}`;
        const formattedString = `${timeString} - ${dateStringFormatted}`;
        return formattedString;
    };

    function formatTransactId(id) {
        const resultString = id.substring(6);
        return resultString;
    };

    function loadData() {
        $.ajax({
            url: "./template/dbconnection_GET.php",
            type: "GET",
            data: {
                table_name: "transactheader"
            },
            dataType: "json",
            success: function(result) {
                const data = result;
                data.sort((a, b) => {
                    const timeA = new Date(a.TimePayment);
                    const timeB = new Date(b.TimePayment);
                    return timeA - timeB;
                });
                console.log(data);
                document.querySelector("#table_order tbody").innerHTML = "";
                $.each(data, function(i, item) {
                    const time = formatDateTime(item.TimePayment);
                    if (item.Status + '' === '1') {
                        $("#table_order tbody")
                            .append(
                                "<tr>" +
                                "<td>" + item.TransactId + "</td>" +
                                "<td>" + time + "</td>" +
                                "<td>Đang chờ xác nhận</td>" +
                                "<td class='content_admin_button_edit_view'>" +
                                `<button class='content_admin_button_edit' id='order-` + item.TransactId + `' onClick='handleConfirmBtn(this.id)'">Xác nhận</button>` +
                                "</td>" +
                                "</tr>"
                            );
                    } else if (item.Status + '' === '2') {
                        $("#table_order tbody")
                            .append(
                                "<tr>" +
                                "<td>" + item.TransactId + "</td>" +
                                "<td>" + time + "</td>" +
                                "<td>Đã xác nhận</td>" +
                                "<td class='content_admin_button_edit_view'>" +
                                `<button class='content_admin_button_edit' id='order-` + item.TransactId + `' onClick='handleConfirmBtn(this.id)'">Xác nhận</button>` +
                                "</td>" +
                                "</tr>"
                            );
                    }
                });
            },
            error: function(xhr, status, error) {
                alert(status);
                console.log(xhr.responseText);
            }
        });
    };

    // Những thứ chạy đầu tiên
    loadData();

    function handleConfirmBtn(id) {
        const transactId = formatTransactId(id);
        const contentUpdate = {
            TransactId: transactId,
            Status: 2
        };
        console.log(contentUpdate);
        $.ajax({
            url: "./template/dbconnection_PUT.php",
            type: "POST",
            data: {
                table_name: "transactheader",
                data_update: JSON.stringify(contentUpdate)
            },
            dataType: "json",
            success: function(result) {
                console.log('result: ', result);
                alert("Xác nhận thành công");
                loadData();
            },
            error: function(xhr, status, error) {
                alert(status);
                console.log(xhr.responseText);
            }
        });
    }
</script>