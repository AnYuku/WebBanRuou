<div id="content_admin">
    <div id="createModal" class="modal">
        <div class="modal-content">
            <div>
                <span class="close" onclick="hideCreateModal()">&times;</span>
            </div>
            <div>
                <form method="POST" action="">
                    <div class="content_admin_form_2_item" style="width: 75%;">
                        <div class="content_admin_form_1_item" style="flex: 1;">
                            <a style="flex: 1;" class="content_admin_form_text_style">Tên thuế:</a>
                            <div style="flex: 1;">
                                <input type="text" style="width: 100px;" class="content_admin_form_input_style" id="content_admin_form_input_create_TaxDes">
                            </div>
                        </div>
                        <div class="content_admin_form_1_item" style="flex: 1;">
                            <div style="flex: 2; padding-left: 10px;">
                                <a style="float: right; margin-right: 10px" class="content_admin_form_text_style">Giá trị:</a>
                            </div>
                            <div style="flex: 1; margin-left: 2px;">
                                <input type="text" style="width: 100px;" class="content_admin_form_input_style" id="content_admin_form_input_create_TaxRate">
                            </div>
                        </div>
                        <div class="content_admin_form_1_item" style="flex: 1;">
                            <div style="flex: 2; padding-left: 10px;">
                                <a style="float: right; margin-right: 10px" class="content_admin_form_text_style">Áp dụng:</a>
                            </div>
                            <div style="flex: 1; margin-left: 2px;">
                                <input type="checkbox" style=" height: 30px; width: 30px;" class="content_admin_form_input_style" id="content_admin_form_input_create_IsActive" value="no">
                            </div>
                        </div>
                    </div>
                    
                    <div class="content_admin_form_buttons_view_style">
                        <div class="content_admin_form_buttons_row_style">
                            <div class="content_admin_form_button_view_style">
                                <input type="submit" class="content_admin_form_button_style" id="content_admin_form_create_input_add" value="Thêm"/>
                            </div>
                            <div class="content_admin_form_button_view_style">
                                <input type="submit" class="content_admin_form_button_style"id="content_admin_form_create_input_cancel" value="Hủy"/>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div id="editModal" class="modal">
        <div class="modal-content">
            <div>
                <span class="close" onclick="hideModal()">&times;</span>
            </div>
            <div>
                <form method="POST" action="">
                    <div class="content_admin_form_2_item" style="width: 100%;">
                        <div class="content_admin_form_1_item" style="flex: 1; margin-right: 30px;">
                            <div style="flex: 1; padding-left: 10px;">
                                <a style="float: right; margin-right: 10px" class="content_admin_form_text_style">Mã thuế:</a>
                            </div>
                            <div style="flex: 1;">
                                <input type="text" style="width: 100px;" class="content_admin_form_input_style" id="content_admin_form_edit_input_TaxID" readonly>
                            </div>
                        </div>
                        <div class="content_admin_form_1_item" style="flex: 1; margin-right: 30px;">
                            <div style="flex: 1; padding-left: 10px;">
                                <a style="float: right; margin-right: 10px" class="content_admin_form_text_style">Tên thuế:</a>
                            </div>
                            <div style="flex: 1;">
                                <input type="text" style="width: 100px;" class="content_admin_form_input_style"  id="content_admin_form_edit_input_taxDes">
                            </div>
                        </div>
                        
                    </div>
                    <div class="content_admin_form_2_item" style="width: 100%;">
                        <div class="content_admin_form_1_item" style="flex: 1; margin-right: 30px;">
                            <div style="flex: 1;">
                                <a style="float: right; margin-right: 10px" class="content_admin_form_text_style">Giá trị:</a>
                            </div>
                            <div style="flex: 1; margin-left: 2px; display: flex; flex-direction: row;">
                                <input type="text" style="width: 100px;" class="content_admin_form_input_style" id="content_admin_form_edit_input_taxRate">
                                <div>
                                    <a style="float: left; margin-left: 5px" class="content_admin_form_text_style">%</a>
                                </div>
                            </div>
                        </div>
                        <div class="content_admin_form_1_item" style="flex: 1; margin-right: 30px;">
                            <div style="flex: 1; padding-left: 10px;">
                                <a style="float: right; margin-right: 10px;" class="content_admin_form_text_style">Áp dụng:</a>
                            </div>
                            <div style="flex: 1;">
                                <input type="checkbox" style=" height: 30px; width: 30px;" class="content_admin_form_input_style" id="content_admin_form_edit_input_isActive">
                            </div>
                        </div>
                    </div>
                    
                    <div class="content_admin_form_buttons_view_style">
                        <div class="content_admin_form_buttons_row_style">
                            <div class="content_admin_form_button_view_style">
                                <input type="submit" class="content_admin_form_button_style"  id="content_admin_form_edit_input_save" value="Lưu" onclick="updateTax(event)"/>
                            </div>
                            <div class="content_admin_form_button_view_style">
                                <input type="submit" class="content_admin_form_button_style" id="content_admin_form_edit_input_delete" value="Xóa" onclick="deleteTax(event)"/>
                            </div>
                            <div class="content_admin_form_button_view_style">
                                <input type="submit" class="content_admin_form_button_style" id="content_admin_form_edit_input_cancel" value="Hủy" />
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="content_admin_button_view">
        <button type='button' class="content_admin_table_item_button"><i class="fa-solid fa-plus fa-2xl"></i></button>
    </div>
    <div class="content_admin_table_view">
        <table id="content_admin_tax_table" cellpadding="0" cellspacing="0" border="0">
            <thead>
                <tr>
                    <th>Mã thuế</th>
                    <th>Tên thuế</th>
                    <th>Giá trị thuế (%)</th>
                    <th>Đang áp dụng</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
    </div>
</div>

<script>
    let TaxInfo = [];
    function loadData() {
        $(document).ready(function() {
            $.ajax({
                url: "./template/dbconnection_GET.php",
                type: "GET",
                data: { table_name: "taxinfo" },
                dataType: "json",
                success: function(result) {
                    TaxInfo = result
                    if(result.length != 0) {
                        lastIndex = result[result.length - 1].TaxId;
                        $.each(result, function(i, item) {
                            if(item.IsActive+'' === '1') {
                                $("#content_admin_tax_table tbody")
                                    .append(
                                        "<tr>"+
                                            "<td>" + item.TaxId + "</td>" + 
                                            "<td>" + item.TaxDes + "</td>" + 
                                            "<td>" + item.TaxRate + "</td>" + 
                                            "<td>Có</td>" + 
                                            "<td>" + 
                                                `<button type='button' class='content_admin_table_item_button'>Chỉnh sửa</i></button>` + 
                                            "</td>" + 
                                        "</tr>"
                                    );
                            } else {
                                $("#content_admin_tax_table tbody")
                                    .append(
                                        "<tr>"+
                                            "<td>" + item.TaxId + "</td>" + 
                                            "<td>" + item.TaxDes + "</td>" + 
                                            "<td>" + item.TaxRate + "</td>" + 
                                            "<td>Không</td>" + 
                                            "<td>" + 
                                                `<button type='button' class='content_admin_table_item_button'>Chỉnh sửa</i></button>` + 
                                            "</td>" + 
                                        "</tr>"
                                    );
                            }
                        });
                        const buttons = document.getElementsByClassName("content_admin_table_item_button");
                        for (let i = 1; i < buttons.length; i++) {
                            buttons[i].addEventListener("click", function() {
                                showModal();
                                document.getElementById("content_admin_form_edit_input_TaxID").value = result[i-1].TaxId;
                                document.getElementById("content_admin_form_edit_input_taxDes").value = result[i-1].TaxDes;
                                document.getElementById("content_admin_form_edit_input_taxRate").value = result[i-1].TaxRate;
                                if(result[i-1].IsActive+'' === '1') {
                                    document.getElementById("content_admin_form_edit_input_isActive").checked = true;
                                } else {
                                    document.getElementById("content_admin_form_edit_input_isActive").checked = false;
                                }
                            });
                        }
                    } else {
                        const buttons = document.getElementsByClassName("content_admin_table_item_button");
                        buttons[0].addEventListener("click", function() {
                            showCreateModal();
                        });
                    }
                }
            });
            const buttons = document.getElementsByClassName("content_admin_table_item_button");
            buttons[0].addEventListener("click", function() {
                showCreateModal(); 
            });
        });
    };
    loadData();
    
    
    // POST data
    $(document).ready(function() {
        $('#content_admin_form_create_input_add').click(function(e) {
            e.preventDefault();
            if(document.getElementById("content_admin_form_input_create_TaxDes").value === "") {
                alert("Tên thuế đang bị để trống!");
            } else if (document.getElementById("content_admin_form_input_create_TaxRate").value === "") {
                alert("Giá trị thuế đang bị để trống!");
            } else {
                let new_taxid = "T01";
                if(lastIndex != 0) {
                    const taxid_num = parseInt(lastIndex.slice(1), 10);
                    const new_taxid_num = taxid_num + 1;
                    if (new_taxid_num < 10) {
                        new_taxid = "T0" + new_taxid_num;
                    } else {
                        new_taxid = "T" + new_taxid_num; 
                    }
                }
                var table_name = 'taxinfo';
                
                var data_insert = {
                    TaxId: new_taxid,
                    TaxDes: document.getElementById("content_admin_form_input_create_TaxDes").value+'',
                    TaxRate: document.getElementById("content_admin_form_input_create_TaxRate").value+'',
                    IsActive: (document.getElementById("content_admin_form_input_create_IsActive").checked === true) ? '1' : '0'
                };
                
                $.ajax({
                    type: 'POST',
                    url: './template/dbconnection_POST.php',
                    data: {
                        table_name: table_name, 
                        data_insert: JSON.stringify(data_insert)
                    },
                    dataType: "json",
                    success: function(response) {
                        hideCreateModal();
                        //..
                        $("#content_admin_tax_table tbody").html("");
                        //..
                        alert("Thêm thuế thành công!");
                        loadData();
                    },
                    error: function(xhr, status, error) {
                        alert(status);
                        console.log(xhr.responseText);
                    }
                });
            }
        });
    });

    function deleteTax(event) {
        event.preventDefault();
        const id_tax = document.getElementById("content_admin_form_edit_input_TaxID").value+"";
        console.log('id_tax: ', id_tax);
        $.ajax({
            url: "./template/dbconnection_DELETE.php",
            type: "POST",
            data: { 
                table_name: "taxinfo",
                id_object: id_tax
            },
            dataType: "json",
            success: function(response) {
                hideModal();
                // ..
                $("#content_admin_tax_table tbody").html("");
                // ..
                alert("Xóa thuế thành công!");
                // ..
                loadData();
            },
            error: function(xhr, status, error) {
                console.log(xhr.responseText);
            }
        });
    };

    function updateTax(event) {
        const runUpdateTax = (data_update, table_name) => {
            $.ajax({
                type: 'POST',
                url: './template/dbconnection_PUT.php',
                data: {
                    table_name: table_name, 
                    data_update: JSON.stringify(data_update)
                },
                dataType: "json",
                success: function(response) {
                    hideModal();
                    //..
                    $("#content_admin_tax_table tbody").html("");
                    //..
                    alert("Cập nhật thuế thành công!");
                    loadData();
                },
                error: function(xhr, status, error) {
                    alert(status);
                    console.log(xhr.responseText);
                }
            });
        }

        event.preventDefault();
        const tax_id = document.getElementById("content_admin_form_edit_input_TaxID").value;
        const tax_des = document.getElementById("content_admin_form_edit_input_taxDes").value;
        const tax_rate = document.getElementById("content_admin_form_edit_input_taxRate").value;
        const is_active = (document.getElementById("content_admin_form_edit_input_isActive").checked === true) ? '1' : '0';
        
        const pre_tax_value = TaxInfo.filter(_ => _.TaxId === tax_id)[0];
        let change = false;
        if(tax_des+'' !== pre_tax_value.TaxDes+'') {
            change = true;
        }
        if(tax_rate+'' !== pre_tax_value.TaxRate+'') {
            change = true;
        }
        if(is_active+'' !== pre_tax_value.IsActive+'') {
            change = true;
        }
        if(change) {
            const data_update = {
                TaxId: tax_id,
                TaxDes: tax_des,
                TaxRate: tax_rate,
                IsActive: is_active
            };
            runUpdateTax(data_update, 'taxinfo');
        }
    }

    function showModal() {
        var editModal = document.getElementById("editModal");
        editModal.style.display = "block";
    }

    function hideModal() {
        var editModal = document.getElementById("editModal");
        editModal.style.display = "none";
    }

    $(document).ready(function() {
        $('#content_admin_form_edit_input_cancel').click(function(e) {
            e.preventDefault();
            hideModal();
        });
        $('#content_admin_form_create_input_cancel').click(function(e) {
            e.preventDefault();
            hideCreateModal();
        });
    });

    function showCreateModal() {
        var createModal = document.getElementById("createModal");
        createModal.style.display = "block";
    }

    function hideCreateModal() {
        document.getElementById("content_admin_form_input_create_TaxDes").value = "";
        document.getElementById("content_admin_form_input_create_TaxRate").value = "";
        document.getElementById("content_admin_form_input_create_IsActive").checked = false;
        var createModal = document.getElementById("createModal");
        createModal.style.display = "none";
    }
    
</script>