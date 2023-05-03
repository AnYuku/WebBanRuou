<div class="table_confirm_order_view">
    <div id="modalDetails" class="modal">
        <div class="modal-content">
            <div>
                <span class="close" onclick="hideDetails()">&times;</span>
            </div>
            <div class="modal-content-title">
                <a>Chi Tiết Đơn Hàng</a>
            </div>
            <div>
                <table class="content_admin_table" id="table_product_transDetail">
                    <thead class="content_admin_table_thead">
                        <tr>
                            <th>Tên sản phẩm</th>
                            <th>Giá</th>
                            <th>Số lượng</th>
                            <th>Tổng tiền</th>
                        </tr>
                    </thead>
                    <tbody class="content_admin_table_tbody">

                    </tbody>
                    <thead class="content_admin_table_thead">
                        <tr>
                            <th>THÀNH TIỀN</th>
                            <th colspan="3" id="thanhTien_transactDetail">0 VND</th>
                        </tr>
                    </thead>
                    <thead class="content_admin_table_thead">
                        <tr>
                            <th>Người thanh toán</th>
                            <th colspan="3" id="WhoPay_TransactDetail"></th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
    <div id="modalConfirm" class="modal">
        <div class="modal-content">
            <div>
                <span class="close" onclick="hideModalConfirm()">&times;</span>
            </div>
            <div class="modal-content-title">
                <a>Xác nhận địa chỉ giao</a>
            </div>
            <div class="modal-content-title">
                <a id="modalConfirm_address"></a>
            </div>
            <div class="modal-content-button">
                <button class="button-23" onclick="handleConfirm2()">Xác nhận</button>
                <button class="button-23" onclick="hideModalConfirm()">Hủy</button>
            </div>
        </div>
    </div>
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
    // variables
    let allProduct = [];
    let allTransDetail = [];
    let transactIdSelected = 0;
    let userIdSelected = {
        id: 0,
        totalCash: 0
    };

    function showDetails() {
        var modalDetails = document.getElementById("modalDetails");
        modalDetails.style.display = "block";
    };

    function hideDetails() {
        var modalDetails = document.getElementById("modalDetails");
        modalDetails.style.display = "none";
    };

    function showModalConfirm() {
        var modalConfirm = document.getElementById("modalConfirm");
        modalConfirm.style.display = "block";
    };

    function hideModalConfirm() {
        var modalConfirm = document.getElementById("modalConfirm");
        modalConfirm.style.display = "none";
    };

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

    function toCurrency(money) {
        const total = parseInt(money, 10);
        return total.toLocaleString("en-US");
    }

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
                    return timeB - timeA;
                });
                document.querySelector("#table_order tbody").innerHTML = "";
                allTransDetail = [];
                $.each(data, function(i, item) {
                    allTransDetail.push(item);
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
                                `<button class='content_admin_button_edit detailOrderBtn' id='order-` + item.TransactId + `' onClick='handleDetailOrder(this.id)'">Chi tiết</button>` +
                                `<button class='content_admin_button_edit detailOrderBtn' id='order-` + item.TransactId + `' onClick='handleCancelOrder(this.id)'">Huỷ</button>` +
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
                                `<button class='content_admin_button_edit detailOrderBtn' id='order-` + item.TransactId + `' onClick='handleDetailOrder(this.id)'">Chi tiết</button>` +
                                "</td>" +
                                "</tr>"
                            );
                    } else if (item.Status + '' === '4') {
                        $("#table_order tbody")
                            .append(
                                "<tr>" +
                                "<td>" + item.TransactId + "</td>" +
                                "<td>" + time + "</td>" +
                                "<td>Đã hủy</td>" +
                                "<td class='content_admin_button_edit_view'>" +
                                `<button class='content_admin_button_edit detailOrderBtn' id='order-` + item.TransactId + `' onClick='handleDetailOrder(this.id)'">Chi tiết</button>` +
                                "</td>" +
                                "</tr>"
                            );
                    }
                });

                $.ajax({
                    url: "./template/dbconnection_GET.php",
                    type: "GET",
                    data: {
                        table_name: "product"
                    },
                    dataType: "json",
                    success: function(resultProduct) {
                        allProduct = resultProduct;
                    },
                    error: function(xhr, status, error) {
                        alert(status);
                        console.log(xhr.responseText);
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

    function handleConfirm2() {
        const contentUpdate = {
            TransactId: transactIdSelected,
            Status: 2
        }
        $.ajax({
            url: "./template/dbconnection_PUT.php",
            type: "POST",
            data: {
                table_name: "transactheader",
                data_update: JSON.stringify(contentUpdate)
            },
            dataType: "json",
            success: function(result) {
                checkIsAbleToPay({
                        transactId: transactIdSelected,
                        mode: 1
                    })
                    .then(function(allDetail) {
                        allDetail.data.forEach((item) => {
                            const Quan = item.Quan;
                            const ProductNum = item.ProductNum;
                            const contentUpdate2 = {
                                ProductNum: ProductNum,
                                QuanDec: Quan
                            }
                            $.ajax({
                                url: "./template/dbconnection_PUT.php",
                                type: "POST",
                                data: {
                                    table_name: "product",
                                    data_update: JSON.stringify(contentUpdate2)
                                },
                                dataType: "json",
                                success: function(result) {

                                },
                                error: function(xhr, status, error) {
                                    alert(status);
                                    console.log(xhr.responseText);
                                }
                            });
                        });
                        const contentUpdate1 = {
                            UserId: userIdSelected.id,
                            TotalCashDec: userIdSelected.totalCash
                        };
                        $.ajax({
                            url: "./template/dbconnection_PUT.php",
                            type: "POST",
                            data: {
                                table_name: "useraccount",
                                data_update: JSON.stringify(contentUpdate1)
                            },
                            dataType: "json",
                            success: function(result) {
                                alert("Xác nhận thành công");
                                hideModalConfirm();
                                loadData();
                            },
                            error: function(xhr, status, error) {
                                alert(status);
                                console.log(xhr.responseText);
                            }
                        });
                    })
                    .catch(function(error) {
                        alert(error);
                    });
            },
            error: function(xhr, status, error) {
                alert(status);
                console.log(xhr.responseText);
            }
        });
    }

    function getInfoUserById(userID) {
        return new Promise(function(resolve, reject) {
            $.ajax({
                url: "./template/db_GET_InfoUserByUserId.php",
                type: "GET",
                data: {
                    UserId: userID
                },
                dataType: "json",
                success: function(result) {
                    const infoUser = result[0];
                    resolve({
                        ...infoUser
                    });
                },
                error: function(xhr, status, error) {
                    reject(error);
                }
            });
        });
    }

    function checkIsAbleToConfirm(userID) {
        return new Promise(function(resolve, reject) {
            if (userID !== "") {
                $.ajax({
                    url: "./template/db_GET_InfoUserByUserId.php",
                    type: "GET",
                    data: {
                        UserId: userID
                    },
                    dataType: "json",
                    success: function(result) {
                        const infoUser = result[0];
                        if (infoUser.Address.length == 0) {
                            reject("Không có địa chỉ giao");
                        } else {
                            resolve({
                                Address: infoUser.Address,
                                TotalCash: infoUser.TotalCash
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        reject(error);
                    }
                });
            } else {
                resolve(false);
            }
        });
    };

    function checkIsAbleToPay({
        transactId,
        userMoney = 0,
        mode = 0
    }) {
        return new Promise(function(resolve, reject) {
            $.ajax({
                url: "./template/db_GET_TransDetailByTransId.php",
                type: "GET",
                data: {
                    transactId: transactId
                },
                dataType: "json",
                success: function(result) {
                    const customAllTransactDetail = result.map((item) => {
                        const product = getProductByProductNum(item.ProductNum);
                        return {
                            ...item,
                            ...product
                        }
                    });
                    let total = 0;
                    customAllTransactDetail.forEach((item) => {
                        total += parseInt(item.Total, 10);
                    });
                    if (mode !== 0) {
                        resolve({
                            data: customAllTransactDetail
                        });
                    }
                    if (mode === 0) {
                        if (total > userMoney) {
                            reject("Tiền không đủ để thanh toán");
                        } else {
                            resolve({
                                Status: true,
                                Change: (userMoney - total),
                                Total: total
                            });
                        }
                    }
                },
                error: function(xhr, status, error) {
                    reject(error);
                }
            });
        });
    };

    function getUserIdByTransactId(id) {
        let result = "";
        for (let i = 0; i < allTransDetail.length; i++) {
            if (allTransDetail[i].TransactId == id) {
                result = allTransDetail[i].WhoPay;
                break;
            }
        }
        return result;
    }

    function handleConfirmBtn(id) {
        const transactId = formatTransactId(id);
        const contentUpdate = {
            TransactId: transactId,
            Status: 2
        };
        const userId = getUserIdByTransactId(transactId);
        checkIsAbleToConfirm(userId)
            .then(function(info) {
                checkIsAbleToPay({
                        transactId: transactId,
                        userMoney: info.TotalCash
                    })
                    .then(function(result) {
                        showModalConfirm();
                        const modalConfirm_address = document.getElementById('modalConfirm_address');
                        modalConfirm_address.textContent = info.Address;
                        transactIdSelected = transactId;
                        userIdSelected = {
                            id: userId,
                            totalCash: result.Total
                        };
                    })
                    .catch(function(error) {
                        alert(error);
                        console.log(error);
                    });
            })
            .catch(function(error) {
                alert(error);
                console.log(error);
            });
    }

    function getProductByProductNum(productNum) {
        let result = {};
        for (let i = 0; i < allProduct.length; i++) {
            if (allProduct[i].ProductNum === productNum) {
                result = {
                    ProductName: allProduct[i].ProductName,
                    ImageSource: allProduct[i].ImageSource
                };
                break;
            }
        }
        return result;
    }

    function handleDetailOrder(id) {
        const transactId = formatTransactId(id);
        $.ajax({
            url: "./template/db_GET_TransDetailByTransId.php",
            type: "GET",
            data: {
                transactId: transactId
            },
            dataType: "json",
            success: function(result) {
                const customAllTransactDetail = result.map((item) => {
                    const product = getProductByProductNum(item.ProductNum);
                    return {
                        ...item,
                        ...product
                    }
                });
                document.querySelector("#table_product_transDetail tbody").innerHTML = "";
                let total = 0;
                customAllTransactDetail.forEach((item) => {
                    $("#table_product_transDetail tbody")
                        .append(
                            "<tr>" +
                            "<td>" + item.ProductName + "</td>" +
                            "<td>" + toCurrency(item.CostEach) + "</td>" +
                            "<td>" + item.Quan + "</td>" +
                            "<td>" + toCurrency(item.Total) + "</td>" +
                            "</tr>"
                        );
                    total += parseInt(item.Total, 10);
                });
                const thanhTien = document.getElementById("thanhTien_transactDetail");
                thanhTien.textContent = toCurrency(total) + ' VND';
                const whoPay = document.getElementById("WhoPay_TransactDetail");
                const userId = getUserIdByTransactId(transactId);
                getInfoUserById(userId + '')
                    .then(function(infoUser) {
                        whoPay.textContent = infoUser.UserName;
                        showDetails();
                    })
                    .catch(function(error) {
                        alert(error);
                        showDetails();
                    });
            },
            error: function(xhr, status, error) {
                alert(status);
                console.log(xhr.responseText);
            }
        });
    }

    function handleCancelOrder(id) {
        const transactId = formatTransactId(id);
        const contentUpdate = {
            TransactId: transactId,
            Status: 4
        };
        $.ajax({
            url: "./template/dbconnection_PUT.php",
            type: "POST",
            data: {
                table_name: "transactheader",
                data_update: JSON.stringify(contentUpdate)
            },
            dataType: "json",
            success: function(result) {
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
