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
                            <input type="text" class="content_admin_form_input_style" style="width: 50%;">
                        </div>
                    </div>
                    <div class="content_admin_form_1_item">
                        <a class="content_admin_form_1_item_text content_admin_form_text_style">Mật khẩu:</a>
                        <div class="content_admin_form_1_item_input">
                            <input type="text" class="content_admin_form_input_style" style="width: 50%;">
                        </div>
                    </div>
                    <div class="content_admin_form_1_item">
                        <a class="content_admin_form_1_item_text content_admin_form_text_style">Mã người dùng:</a>
                        <div class="content_admin_form_1_item_input">
                            <input type="text" class="content_admin_form_input_style" style="width: 100%;">
                        </div>
                    </div>
                    <div class="content_admin_form_2_item">
                        <div class="content_admin_form_1_item" style="flex: 1;">
                            <a style="flex: 1;" class="content_admin_form_text_style">Cấp độ truy cập bảo mật:</a>
                            <div style="flex: 1;">
                                <input type="text" style="width: 100px;" class="content_admin_form_input_style">
                            </div>
                        </div>
                        <div class="content_admin_form_1_item" style="flex: 1;">
                            <div style="flex: 2; padding-left: 10px;">
                                <a style="float: right; margin-right: 10px" class="content_admin_form_text_style">Trạng thái tài khoản:</a>
                            </div>
                            <div style="flex: 1; margin-left: 2px;">
                                <input type="text" style="width: 100px;" class="content_admin_form_input_style">
                            </div>
                        </div>
                    </div>
                    <div class="content_admin_form_1_item">
                        <a class="content_admin_form_1_item_text content_admin_form_text_style">Email:</a>
                        <div class="content_admin_form_1_item_input">
                            <input type="text" class="content_admin_form_input_style" style="width: 50%;">
                        </div>
                    </div>
                    <div class="content_admin_form_1_item">
                        <a class="content_admin_form_1_item_text content_admin_form_text_style">Tiền của bạn:</a>
                        <div class="content_admin_form_1_item_input">
                            <input type="text" class="content_admin_form_input_style" style="width: 50%;" readonly>
                        </div>
                    </div>
                    <div class="content_admin_form_1_item">
                        <a class="content_admin_form_1_item_text content_admin_form_text_style">Địa chỉ:</a>
                        <div class="content_admin_form_1_item_input">
                            <input type="text" class="content_admin_form_input_style" style="width: 100%;">
                        </div>
                    </div>
                    <div class="content_admin_form_buttons_view_style">
                        <div class="content_admin_form_buttons_row_style">
                            <div class="content_admin_form_button_view_style">
                                <input type="submit" class="content_admin_form_button_style" value="Nạp tiền"/>
                            </div>
                            <div class="content_admin_form_button_view_style">
                                <input type="submit" class="content_admin_form_button_style" value="Xóa"/>
                            </div>
                        </div>
                        <div class="content_admin_form_buttons_row_style">
                            <div class="content_admin_form_button_view_style">
                                <input type="submit" class="content_admin_form_button_style" value="Lưu"/>
                            </div>
                            <div class="content_admin_form_button_view_style">
                                <input type="submit" class="content_admin_form_button_style" value="Hủy"/>
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
                <form method="POST" action="./template/dbconnection_POST.php">
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
                            <div style="flex: 1;">
                                <input type="text" style="width: 100px;" class="content_admin_form_input_style" id="content_admin_form_input_accesslevel">
                            </div>
                        </div>
                        <div class="content_admin_form_1_item" style="flex: 1;">
                            <div style="flex: 2; padding-left: 10px;">
                                <a style="float: right; margin-right: 10px" class="content_admin_form_text_style">Trạng thái tài khoản:</a>
                            </div>
                            <div style="flex: 1; margin-left: 2px;">
                                <input type="text" style="width: 100px;" class="content_admin_form_input_style" id="content_admin_form_input_accountstatus">
                            </div>
                        </div>
                    </div>
                    <div class="content_admin_form_1_item">
                        <a class="content_admin_form_1_item_text content_admin_form_text_style">Email:</a>
                        <div class="content_admin_form_1_item_input">
                            <input type="text" class="content_admin_form_input_style" style="width: 50%;">
                        </div>
                    </div>
                    <div class="content_admin_form_1_item">
                        <a class="content_admin_form_1_item_text content_admin_form_text_style">Tiền của bạn:</a>
                        <div class="content_admin_form_1_item_input">
                            <input type="text" class="content_admin_form_input_style" style="width: 50%;" id="content_admin_form_input_money">
                        </div>
                    </div>
                    <div class="content_admin_form_1_item">
                        <a class="content_admin_form_1_item_text content_admin_form_text_style">Địa chỉ:</a>
                        <div class="content_admin_form_1_item_input">
                            <input type="text" class="content_admin_form_input_style" style="width: 100%;">
                        </div>
                    </div>
                    <div class="content_admin_form_buttons_view_style">
                        <div class="content_admin_form_buttons_row_style">
                            <div class="content_admin_form_button_view_style">
                                <input type="submit" class="content_admin_form_button_style" id="content_admin_form_button_add" value="Tạo"/>
                            </div>
                            <div class="content_admin_form_button_view_style">
                                <input type="submit" class="content_admin_form_button_style" id="content_admin_form_button_cancel" value="Hủy"/>
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
                    <th>User Name</th>
                    <th>Password</th>
                    <th>Access Level</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="content_admin_table_tbody">
                
            </tbody>
        </table>
    </div>
</div>

<script>
    $(document).ready(function() {
        $.ajax({
            url: "./template/dbconnection_GET.php",
            type: "GET",
            data: { table_name: "useraccount" },
            dataType: "json",
            success: function(result) {
                console.log('result: ', result);
                $.each(result, function(i, item) {
                    $("#content_admin_table tbody")
                        .append(
                            "<tr>"+
                                "<td>" + item.UserName + "</td>" + 
                                "<td>" + item.UserPassword + "</td>" + 
                                "<td>" + item.AccessLevel + "</td>" + 
                                "<td class='content_admin_button_edit_view'>" + 
                                    `<button class='content_admin_button_edit' onclick="showModal()">Edit</button>` + 
                                "</td>" + 
                            "</tr>"
                        );
                });
            }
        });
    });
</script>

<script>
    document.getElementById("content_admin_form_button_add").addEventListener("click", function(event) {
        var username = document.getElementById("content_admin_form_input_username").value;
        var password = document.getElementById("content_admin_form_input_password").value;
        var accesslevel = document.getElementById("content_admin_form_input_accesslevel").value;
        var accountstatus = document.getElementById("content_admin_form_input_accountstatus").value;
        var money = document.getElementById("content_admin_form_input_money").value;
        let isEmpty = false;
        if (username === "") {
            alert("Tên tài khoản trống.");
            event.preventDefault();
        } else if (password === "") {
            alert("Mật khẩu trống.");
            event.preventDefault();
        } else if (accesslevel === "") {
            alert("Cấp độ truy cập bảo mật trống.");
            event.preventDefault();
        }  else if (accountstatus === "") {
            alert("Trạng thái tài khoản trống.");
            event.preventDefault();
        }  else if (money === "") {
            alert("Số tiền đang trống.");
            event.preventDefault();
        } else {
            // Code xử lý khi trường input không rỗng
            // Tạo tài khoản
        }
    });

    document.getElementById("content_admin_form_button_cancel").addEventListener("click", function(event) {
        document.getElementById("content_admin_form_input_username").value = "";
        document.getElementById("content_admin_form_input_password").value = "";
        hideCreateModal();
        event.preventDefault();
    });
</script>

<script>
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
</script>