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
                            <input type="text" class="content_admin_form_input_style" style="width: 50%;" id="content_admin_form_input_money" value="0">
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
            if (capDoTruyCap === 'Admin') {
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
        document.getElementById("content_admin_form_input_username").value;
        document.getElementById("content_admin_form_input_password").value;
        //document.getElementById("content_admin_form_input_accesslevel").value;
        document.getElementById("content_admin_form_input_gmail").value;
        document.getElementById("content_admin_form_input_money").value;
        document.getElementById("content_admin_form_input_address").value;
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
            console.log('content: ', JSON.stringify(content));
            $.ajax({
                url: "./template/dbconnection_POST.php",
                type: "POST",
                data: {
                    table_name: "useraccount",
                    data_insert: JSON.stringify(content)
                },
                dataType: "json",
                success: function(result) {
                    console.log(result);
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
        document.getElementById("content_admin_form_input_username").value = "";
        document.getElementById("content_admin_form_input_password").value = "";
        hideCreateModal();
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
        const userID = <?php echo $_SESSION['userId'] ?>;
        console.log('userID: ', userID);
        const index = extractIdFromButtonId(id);
        console.log(user_data[index]);
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
        if (user_data[index].AccessLevel == 100) {
            document.getElementById("content_admin_form_input_edit_accessLevel").selectedIndex = 0;
            moneyView.style.display = 'none';
            napTienBtn.style.display = 'none';
        } else {
            document.getElementById("content_admin_form_input_edit_accessLevel").selectedIndex = 1;
            moneyView.style.display = 'flex';
            napTienBtn.style.display = 'block';
        }
        document.getElementById("content_admin_form_input_edit_email").value = user_data[index].Email;
        document.getElementById("content_admin_form_input_edit_money").value = toCurrency(user_data[index].TotalCash);
        document.getElementById("content_admin_form_input_edit_addresss").value = user_data[index].Address;
    }

    function handleEditBtn(id) {
        addDataIntoModal({
            id: id
        });
        showModal();
    }

    document.getElementById("content_admin_edit_form_depositBtn").addEventListener("click", function(event) {
        event.preventDefault();
        alert("Click Nạp tiền");
    });
    document.getElementById("content_admin_edit_form_deleteBtn").addEventListener("click", function(event) {
        event.preventDefault();
        alert("Click Xóa");
    });
    document.getElementById("content_admin_edit_form_saveBtn").addEventListener("click", function(event) {
        event.preventDefault();
        alert("Click Lưu");
    });
    document.getElementById("content_admin_edit_form_cancelBtn").addEventListener("click", function(event) {
        event.preventDefault();
        hideModal();
    });
</script>