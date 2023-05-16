<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<div id="content_admin">
    <div id="editModal" class="modal">
        <div class="modal-content">
            <div>
                <span class="close" onclick="hideModal()">&times;</span>
            </div>
            <div>
                <form method="POST" action="">
                    <div class="content_admin_form_1_item">
                        <a class="content_admin_form_1_item_text content_admin_form_text_style">Tên tài khoản:</a>
                        <div class="content_admin_form_1_item_input">
                            <input type="text" class="content_admin_form_input_style" id="content_admin_form_input_edit_username" style="width: 50%;" readonly>
                        </div>
                    </div>
                    <div class="content_admin_form_1_item">
                        <a class="content_admin_form_1_item_text content_admin_form_text_style">Mật khẩu:</a>
                        <div class="content_admin_form_1_item_input">
                            <input type="text" class="content_admin_form_input_style" id="content_admin_form_input_edit_password" style="width: 50%;">
                        </div>
                    </div>
                    <div class="content_admin_form_1_item">
                        <a class="content_admin_form_1_item_text content_admin_form_text_style">Mã người dùng:</a>
                        <div class="content_admin_form_1_item_input">
                            <input type="text" class="content_admin_form_input_style" id="content_admin_form_input_edit_userid" style="width: 100%;" readonly>
                        </div>
                    </div>
                    <div class="content_admin_form_2_item">
                        <div class="content_admin_form_1_item" style="flex: 1;">
                            <a style="flex: 1;" class="content_admin_form_text_style">Cấp độ truy cập bảo mật:</a>
                            <div style="flex: 1;">
                                <select style="width: 100px;" class="content_admin_form_input_style" id="content_admin_form_input_edit_accessLevel">
                                    <option value="admin">Admin</option>
                                    <option value="client">Client</option>
                                </select>
                            </div>
                        </div>
                        <div class="content_admin_form_1_item" style="flex: 1;">
                            <div style="flex: 2; padding-left: 10px;">
                                <a style="float: right; margin-right: 10px" class="content_admin_form_text_style">Trạng thái tài khoản:</a>
                            </div>
                            <div style="flex: 1; margin-left: 2px;">
                                <input type="checkbox" style=" height: 30px; width: 30px;" class="content_admin_form_input_style" id="content_admin_form_input_edit_status">
                            </div>
                        </div>
                    </div>
                    <div class="content_admin_form_1_item">
                        <a class="content_admin_form_1_item_text content_admin_form_text_style">Email:</a>
                        <div class="content_admin_form_1_item_input">
                            <input type="text" class="content_admin_form_input_style" id="content_admin_form_input_edit_email" style="width: 50%;">
                        </div>
                    </div>
                    <div class="content_admin_form_1_item" id="content_admin-edit-money_view">
                        <a class="content_admin_form_1_item_text content_admin_form_text_style">Tiền của bạn:</a>
                        <div class="content_admin_form_1_item_input">
                            <input type="text" class="content_admin_form_input_style" id="content_admin_form_input_edit_money" style="width: 50%;" readonly>
                        </div>
                    </div>
                    <div class="content_admin_form_1_item">
                        <a class="content_admin_form_1_item_text content_admin_form_text_style">Địa chỉ:</a>
                        <div class="content_admin_form_1_item_input">
                            <input type="text" class="content_admin_form_input_style" id="content_admin_form_input_edit_addresss" style="width: 100%;">
                        </div>
                    </div>
                    <div class="content_admin_form_buttons_view_style">
                        <div class="content_admin_form_buttons_row_style">
                            <div class="content_admin_form_button_view_style">
                                <input type="submit" class="content_admin_form_button_style" id="content_admin_edit_form_depositBtn" value="Nạp tiền" />
                            </div>
                            <div class="content_admin_form_button_view_style">
                                <input type="submit" class="content_admin_form_button_style" id="content_admin_edit_form_deleteBtn" value="Xóa" />
                            </div>
                        </div>
                        <div class="content_admin_form_buttons_row_style">
                            <div class="content_admin_form_button_view_style">
                                <input type="submit" class="content_admin_form_button_style" id="content_admin_edit_form_saveBtn" value="Lưu" />
                            </div>
                            <div class="content_admin_form_button_view_style">
                                <input type="submit" class="content_admin_form_button_style" id="content_admin_edit_form_cancelBtn" value="Hủy" />
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div id="createModal" class="modal">
        <div class="modal-content">
            <div>
                <span class="close" onclick="hideCreateModal()">&times;</span>
            </div>
            <div>
                <form method="POST" action="">
                    <div class="content_admin_form_1_item">
                        <a class="content_admin_form_1_item_text content_admin_form_text_style">Tên tài khoản:</a>
                        <div class="content_admin_form_1_item_input">
                            <input type="text" class="content_admin_form_input_style" id="content_admin_form_input_username" style="width: 50%;">
                        </div>
                    </div>
                    <div class="content_admin_form_1_item">
                        <a class="content_admin_form_1_item_text content_admin_form_text_style">Mật khẩu:</a>
                        <div class="content_admin_form_1_item_input">
                            <input type="text" class="content_admin_form_input_style" id="content_admin_form_input_password" style="width: 50%;">
                        </div>
                    </div>
                    <div class="content_admin_form_2_item">
                        <div class="content_admin_form_1_item" style="flex: 1;">
                            <a style="flex: 1;" class="content_admin_form_text_style">Cấp độ truy cập bảo mật:</a>
                            <div style="flex: 3; display: flex; flex-direction: row; align-items: flex-start;">
                                <select style="width: 100px;" class="content_admin_form_input_style" id="content_admin_form_input_accesslevel">
                                    <option value="admin">Admin</option>
                                    <option value="client" selected>Client</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="content_admin_form_1_item">
                        <a class="content_admin_form_1_item_text content_admin_form_text_style">Email:</a>
                        <div class="content_admin_form_1_item_input">
                            <input type="text" class="content_admin_form_input_style" id="content_admin_form_input_gmail" style="width: 50%;">
                        </div>
                    </div>
                    <div class="content_admin_form_1_item" id="conten_admin-money_view">
                        <a class="content_admin_form_1_item_text content_admin_form_text_style">Tiền trong ví:</a>
                        <div class="content_admin_form_1_item_input">
                            <input type="text" class="content_admin_form_input_style" style="width: 50%;" id="content_admin_form_input_money" value="0" oninput="changeToZero()">
                        </div>
                    </div>
                    <div class="content_admin_form_1_item">
                        <a class="content_admin_form_1_item_text content_admin_form_text_style">Địa chỉ:</a>
                        <div class="content_admin_form_1_item_input">
                            <input type="text" class="content_admin_form_input_style" id="content_admin_form_input_address" style="width: 100%;">
                        </div>
                    </div>
                    <div class="content_admin_form_buttons_view_style">
                        <div class="content_admin_form_buttons_row_style">
                            <div class="content_admin_form_button_view_style">
                                <input type="submit" class="content_admin_form_button_style" id="content_admin_form_button_add" value="Tạo" />
                            </div>
                            <div class="content_admin_form_button_view_style">
                                <input type="submit" class="content_admin_form_button_style" id="content_admin_form_button_cancel" value="Hủy" />
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div id="Modal_NapTien" style="display: none">
        <div class="modal" style="display: flex; align-items: center;">
            <div class="modal-content" style="height: 30%;">
                <div class="modal_NapTien_text_view">
                    <div class="modal_NapTien_text_view_center">
                        <a>Nạp tiền</a>
                    </div>
                    <div>
                        <span class="close" onclick="hideModalNapTien()">&times;</span>
                    </div>
                </div>
                <div class="moder_NapTien_buttons_view">
                    <button id="input_money_100" class="button-23">100,000 VND</button>
                    <button id="input_money_200" class="button-23">200,000 VND</button>
                    <button id="input_money_500" class="button-23">500,000 VND</button>
                    <button id="input_money_1000" class="button-23">1,000,000 VND</button>
                </div>
                <div>

                </div>
                <div class="moder_NapTien_buttons_view_2">
                    <div>
                        <a>Khác:</a>
                    </div>
                    <div>
                        <input type="number" id="input_money" class="content_admin_form_input_style no-arrow" value="0" oninput="changeToZeroNapTien()" />
                    </div>
                    <div>
                        <button class="button-23" id="Nap_Tien_Btn">Nạp</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="content_admin_button_view">
        <button type="button" id="content_admin_button_add" onclick="showCreateModal()">Thêm Tài Khoản</button>
    </div>
    <div class="content_admin_table_view">
        <table id="content_admin_table">
            <thead id="content_admin_table_thead">
                <tr>
                    <th>Tên người dùng</th>
                    <th>Mật khẩu</th>
                    <th>Vai trò</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody id="content_admin_table_tbody">

            </tbody>
        </table>
    </div>
</div>

<script>
    let user_data = [];
    let userIdSelected = 0;

    function changeToZero() {
        var input = document.getElementById("content_admin_form_input_money");
        if (input.value === "") {
            input.value = "0";
        }
    }

    function changeToZeroNapTien() {
        var input_money = document.getElementById("input_money");
        if (input_money.value === "") {
            input_money.value = "0";
        } else {
            input_money.value = parseInt(input_money.value, 10);
        }
    }

    function isGmailFormat(email) {
        const gmailRegex = /^[a-zA-Z0-9_.+-]+@gmail\.com$/;
        return gmailRegex.test(email);
    }

    function checkEmptyInfo() {
        const tenTaiKhoan = document.getElementById("content_admin_form_input_username").value;
        const matKhau = document.getElementById("content_admin_form_input_password").value;
        const capDoTruyCap = document.getElementById("content_admin_form_input_accesslevel").value;
        const gmail = document.getElementById("content_admin_form_input_gmail").value;
        let money = document.getElementById("content_admin_form_input_money").value;
        const address = document.getElementById("content_admin_form_input_address").value;

        if (tenTaiKhoan === "") {
            const data = {
                status: false,
                message: "Tên tài khoản trống."
            };
            return data;
        } else if (matKhau === "") {
            const data = {
                status: false,
                message: "Mật khẩu trống."
            };
            return data;
        } else if (gmail === "") {
            const data = {
                status: false,
                message: "Email đang trống"
            };
            return data;
        } else if (!isGmailFormat(gmail)) {
            const data = {
                status: false,
                message: "Email sai định dạng"
            };
            return data;
        } else if (money === "") {
            const data = {
                status: false,
                message: "Số tiền đang trống."
            };
            return data;
        } else {
            let AccessLevel = '50';
            if (capDoTruyCap === 'admin') {
                AccessLevel = '100';
                money = 0;
            }
            const content = {
                UserName: tenTaiKhoan,
                UserPassword: matKhau,
                AccessLevel: AccessLevel,
                TotalCash: money,
                IsActive: 1,
                Email: gmail,
                Address: address
            };
            const data = {
                status: true,
                message: content
            }
            return data;
        }
    };

    function resetFormCreate() {
        document.getElementById("content_admin_form_input_username").value = "";
        document.getElementById("content_admin_form_input_password").value = "";
        document.getElementById("content_admin_form_input_gmail").value = "";
        document.getElementById("content_admin_form_input_money").value = "0";
        document.getElementById("content_admin_form_input_address").value = "";
        document.getElementById("content_admin_form_input_accesslevel").selectedIndex = 1;
        const moneyElement = document.getElementById('conten_admin-money_view');
        moneyElement.style.display = 'flex';
    };
    // ============================================================================================================================================================
    function loadData() {
        $.ajax({
            url: "./template/dbconnection_GET.php",
            type: "GET",
            data: {
                table_name: "useraccount"
            },
            dataType: "json",
            success: function(result) {
                document.querySelector("#content_admin_table tbody").innerHTML = "";
                user_data = [];
                $.each(result, function(i, item) {
                    user_data.push(item);
                    if (item.AccessLevel + '' == '100') {
                        $("#content_admin_table tbody")
                            .append(
                                "<tr>" +
                                "<td>" + item.UserName + "</td>" +
                                "<td>" + item.UserPassword + "</td>" +
                                "<td>Admin</td>" +
                                "<td class='content_admin_button_edit_view'>" +
                                `<button class='content_admin_button_edit' id='user-` + i + `' onClick='handleEditBtn(this.id)'">Edit</button>` +
                                "</td>" +
                                "</tr>"
                            );
                    } else {
                        $("#content_admin_table tbody")
                            .append(
                                "<tr>" +
                                "<td>" + item.UserName + "</td>" +
                                "<td>" + item.UserPassword + "</td>" +
                                "<td>Client</td>" +
                                "<td class='content_admin_button_edit_view'>" +
                                `<button class='content_admin_button_edit' id='user-` + i + `' onClick='handleEditBtn(this.id)'">Edit</button>` +
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
    }

    $(document).ready(function() {
        // window.location.reload();
        loadData();
        const roleCombobox = document.getElementById('content_admin_form_input_accesslevel');
        roleCombobox.addEventListener('change', function() {
            const selectedValue = roleCombobox.value;
            const moneyElement = document.getElementById('conten_admin-money_view');
            if (selectedValue === 'admin') {
                moneyElement.style.display = 'none';
            } else if (selectedValue === 'client') {
                moneyElement.style.display = 'flex';
            }
        });
    });
    // ============================================================================================================================================================
    document.getElementById("content_admin_form_button_add").addEventListener("click", function(event) {
        event.preventDefault();
        if (checkEmptyInfo().status === true) {
            const content = checkEmptyInfo().message;
            // console.log('content: ', JSON.stringify(content));
            $.ajax({
                url: "./template/dbconnection_POST.php",
                type: "POST",
                data: {
                    table_name: "useraccount",
                    data_insert: JSON.stringify(content)
                },
                dataType: "json",
                success: function(result) {
                    // console.log(result);
                    alert("Tạo tài khoản thành công!");
                    hideCreateModal();
                    loadData();
                },
                error: function(xhr, status, error) {
                    alert("Tạo tài khoản thất bại!");
                    console.log(xhr.responseText);
                }
            });
        } else {
            alert(checkEmptyInfo().message);
        }
    });

    document.getElementById("content_admin_form_button_cancel").addEventListener("click", function(event) {
        event.preventDefault();
        resetFormCreate();
        hideCreateModal();
    });

    document.getElementById("Nap_Tien_Btn").addEventListener("click", function(event) {
        event.preventDefault();
        const id = document.getElementById("content_admin_form_input_edit_userid").value;
        const input_moneyString = document.getElementById("input_money").value;
        const input_money = parseInt(input_moneyString, 10);
        const content = {
            UserId: id,
            TotalCash: input_money
        };

        $.ajax({
            url: "./template/db_PUT_NapTien.php",
            type: "POST",
            data: {
                data_update: JSON.stringify(content)
            },
            dataType: "json",
            success: function(result) {
                alert("Nạp tiền thành công");
                hideModalNapTien();
                hideModal();
                loadData();
            },
            error: function(xhr, status, error) {
                alert("Nạp tiền thất bại!");
                console.log(xhr.responseText);
            }
        });
    });

    document.getElementById("input_money_1000").addEventListener("click", function(event) {
        event.preventDefault();
        const id = document.getElementById("content_admin_form_input_edit_userid").value;
        const content = {
            UserId: id,
            TotalCash: '1000000'
        };

        $.ajax({
            url: "./template/db_PUT_NapTien.php",
            type: "POST",
            data: {
                data_update: JSON.stringify(content)
            },
            dataType: "json",
            success: function(result) {
                alert("Nạp tiền thành công");
                hideModalNapTien();
                hideModal();
                loadData();
            },
            error: function(xhr, status, error) {
                alert("Nạp tiền thất bại!");
                console.log(xhr.responseText);
            }
        });
    });

    document.getElementById("input_money_500").addEventListener("click", function(event) {
        event.preventDefault();
        const id = document.getElementById("content_admin_form_input_edit_userid").value;
        const content = {
            UserId: id,
            TotalCash: '500000'
        };

        $.ajax({
            url: "./template/db_PUT_NapTien.php",
            type: "POST",
            data: {
                data_update: JSON.stringify(content)
            },
            dataType: "json",
            success: function(result) {
                alert("Nạp tiền thành công");
                hideModalNapTien();
                hideModal();
                loadData();
            },
            error: function(xhr, status, error) {
                alert("Nạp tiền thất bại!");
                console.log(xhr.responseText);
            }
        });
    });

    document.getElementById("input_money_200").addEventListener("click", function(event) {
        event.preventDefault();
        const id = document.getElementById("content_admin_form_input_edit_userid").value;
        const content = {
            UserId: id,
            TotalCash: '200000'
        };

        $.ajax({
            url: "./template/db_PUT_NapTien.php",
            type: "POST",
            data: {
                data_update: JSON.stringify(content)
            },
            dataType: "json",
            success: function(result) {
                alert("Nạp tiền thành công");
                hideModalNapTien();
                hideModal();
                loadData();
            },
            error: function(xhr, status, error) {
                alert("Nạp tiền thất bại!");
                console.log(xhr.responseText);
            }
        });
    });

    document.getElementById("input_money_100").addEventListener("click", function(event) {
        event.preventDefault();
        const id = document.getElementById("content_admin_form_input_edit_userid").value;
        const content = {
            UserId: id,
            TotalCash: '100000'
        };

        $.ajax({
            url: "./template/db_PUT_NapTien.php",
            type: "POST",
            data: {
                data_update: JSON.stringify(content)
            },
            dataType: "json",
            success: function(result) {
                alert("Nạp tiền thành công");
                hideModalNapTien();
                hideModal();
                loadData();
            },
            error: function(xhr, status, error) {
                alert("Nạp tiền thất bại!");
                console.log(xhr.responseText);
            }
        });
    });

    document.getElementById("input_money").addEventListener("click", function(event) {

    });

    // ============================================================================================================================================================
    function showModal() {
        var editModal = document.getElementById("editModal");
        editModal.style.display = "block";
    }

    function hideModal() {
        var editModal = document.getElementById("editModal");
        editModal.style.display = "none";
    }

    function showCreateModal() {
        var createModal = document.getElementById("createModal");
        createModal.style.display = "block";
    }

    function hideCreateModal() {
        var createModal = document.getElementById("createModal");
        createModal.style.display = "none";
    }

    function showModalNapTien() {
        var Modal_NapTien = document.getElementById("Modal_NapTien");
        Modal_NapTien.style.display = "block";
        document.getElementById("input_money").value = "0";
    }

    function hideModalNapTien() {
        var Modal_NapTien = document.getElementById("Modal_NapTien");
        Modal_NapTien.style.display = "none";
    }
    // ============================================================================================================================================================
    function extractIdFromButtonId(buttonId) {
        var numericId = buttonId.replace('user-', '');
        var id = parseInt(numericId, 10);
        return id;
    }

    function toCurrency(totalCash) {
        return new Intl.NumberFormat('en-US').format(totalCash);
    }

    function addDataIntoModal({
        id
    }) {
        let userID = "";
        try {
            userID = '<?php echo $_SESSION['userId'] ?>';
        } catch (e) {
            console.log(e);
        }
        const index = extractIdFromButtonId(id);
        document.getElementById("content_admin_form_input_edit_username").value = user_data[index].UserName;
        document.getElementById("content_admin_form_input_edit_userid").value = user_data[index].UserId;
        if (user_data[index].IsActive + '' == '1') {
            document.getElementById("content_admin_form_input_edit_status").checked = true;
        } else {
            document.getElementById("content_admin_form_input_edit_status").checked = false;
        }
        document.getElementById("content_admin_form_input_edit_password").value = user_data[index].UserPassword;
        const moneyView = document.getElementById('content_admin-edit-money_view');
        const napTienBtn = document.getElementById('content_admin_edit_form_depositBtn');
        const xoaBtn = document.getElementById('content_admin_edit_form_deleteBtn');
        // console.log('Role:', user_data[index].AccessLevel);
        if (user_data[index].AccessLevel == 100) {
            document.getElementById("content_admin_form_input_edit_accessLevel").selectedIndex = 0;
            document.getElementById("content_admin_form_input_edit_accessLevel").options[1].disabled = true;
            moneyView.style.display = 'none';
            napTienBtn.style.display = 'none';
            if (user_data[index].UserId === userID) {
                xoaBtn.style.display = 'none';
            }
        } else {
            document.getElementById("content_admin_form_input_edit_accessLevel").selectedIndex = 1;
            document.getElementById("content_admin_form_input_edit_accessLevel").options[0].disabled = true;
            moneyView.style.display = 'flex';
            napTienBtn.style.display = 'block';
            xoaBtn.style.display = 'block';
        }
        document.getElementById("content_admin_form_input_edit_email").value = user_data[index].Email;
        document.getElementById("content_admin_form_input_edit_money").value = toCurrency(user_data[index].TotalCash);
        document.getElementById("content_admin_form_input_edit_addresss").value = user_data[index].Address;
    }

    function handleEditBtn(id) {
        userIdSelected = id;
        addDataIntoModal({
            id: id
        });
        showModal();
    }

    function checkDataChange(pw, email) {
        if (pw === "") {
            return {
                status: false,
                message: "Mật khẩu đang trống"
            }
        } else if (email === "") {
            return {
                status: false,
                message: "Email đang trống"
            }
        } else if (!isGmailFormat(email)) {
            return {
                status: false,
                message: "Email sai định dạng"
            }
        } else {
            return {
                status: true
            }
        }
    }

    function getDataFromCreateForm() {
        const id = document.getElementById("content_admin_form_input_edit_userid").value;
        const pw = document.getElementById("content_admin_form_input_edit_password").value;
        const email = document.getElementById("content_admin_form_input_edit_email").value;
        const address = document.getElementById("content_admin_form_input_edit_addresss").value;
        const isActiveValue = document.getElementById("content_admin_form_input_edit_status").checked;
        let isActive = 0;
        if (isActiveValue === true) {
            isActive = 1;
        }
        const isOk = checkDataChange(pw, email).status;
        if (isOk) {
            return {
                UserId: id,
                UserPassword: pw,
                Email: email,
                Address: address,
                IsActive: isActive
            }
        } else {
            alert(checkDataChange(pw, email).message);
            return null;
        }

    }

    document.getElementById("content_admin_edit_form_depositBtn").addEventListener("click", function(event) {
        event.preventDefault();
        showModalNapTien();
    });
    document.getElementById("content_admin_edit_form_deleteBtn").addEventListener("click", function(event) {
        event.preventDefault();
        const index = extractIdFromButtonId(userIdSelected);
        const userInfo = user_data[index];
        const userid = userInfo.UserId;
        $.ajax({
            url: "./template/dbconnection_DELETE.php",
            type: "POST",
            data: {
                table_name: "useraccount",
                id_object: userid
            },
            dataType: "json",
            success: function(result) {
                alert("Xóa tài khoản thành công!");
                hideModal();
                loadData();
            },
            error: function(xhr, status, error) {
                alert("Xóa tài khoản thất bại!");
                console.log(xhr.responseText);
            }
        });
    });
    document.getElementById("content_admin_edit_form_saveBtn").addEventListener("click", function(event) {
        event.preventDefault();
        const contentChange = getDataFromCreateForm();
        let userID = "";
        try {
            userID = '<?php echo $_SESSION['userId'] ?>';
        } catch (e) {
            console.log(e);
        }
        const isActiveValue = document.getElementById("content_admin_form_input_edit_status").checked;
        if (contentChange.UserId === userID && isActiveValue === false) {
            alert("Không thể vô hiệu quá tài khoản của bản thân");
        } else {
            if (contentChange !== null) {
                $.ajax({
                    url: "./template/dbconnection_PUT.php",
                    type: "POST",
                    data: {
                        table_name: "useraccount",
                        data_update: JSON.stringify(contentChange)
                    },
                    dataType: "json",
                    success: function(result) {
                        console.log('result: ', result);
                        alert("Cập nhật tài khoản thành công!");
                        hideModal();
                        loadData();
                    },
                    error: function(xhr, status, error) {
                        alert("Cập nhật tài khoản thất bại!");
                        console.log(xhr.responseText);
                    }
                });
            }
        }
    });
    document.getElementById("content_admin_edit_form_cancelBtn").addEventListener("click", function(event) {
        event.preventDefault();
        hideModal();
    });
</script>