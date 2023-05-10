<!-- HTML cho cửa sổ thêm sản phẩm -->
<div id="content-admin-product-add-product-window" class="content-admin-product-product-window" style="display:none;">
    <button id="close-add-product-button" class="content-admin-product-close-btn" style="margin:10px">&times;</button>
    <form method="POST" class='content-admin-product-product-form' action="manageProduct.php">
        <img id="previewImage" src="no_image.jpg" alt="Preview Image">
        <div class="field">
            <label for="">Đường dẫn ảnh</label>
            <input type="url" id="add_imageInput" required onchange="addImage('previewImage','add_imageInput')">
            <button type="button" id="add_image" onclick="addImage()"><i class="fa-solid fa-upload"></i></i> Tải ảnh</button>
        </div>
        <div class="field">
            <label>Tên sản phẩm</label>
            <input type="text" id="productName" name="product_name" required minlength="1">
        </div>
        <div class="field">
            <label for="">Giá sản phẩm</label>
            <input type="number" name="productPrice" class="numberInput" id="Price" required min="1000">
        </div>
        <div class="field tax-checkbox">
            <label for="">Thuế 1</label>
            <input type="checkbox" id="tax1" name="tax1" value="1">
            <label for="">Thuế 2</label>
            <input type="checkbox" id="tax2" name="tax2" value="1">
            <label for="">Thuế 3</label>
            <input type="checkbox" id="tax3" name="tax3" value="1">

        </div>
        <div class="field">
            <label for="">Số lượng</label>
            <input type="number" id="Quan" name="product_quanlity" class="numberInput" required min="0" value="0">
        </div>
        <div class="field">
            <label for="">Loại</label>
            <select id="category">
                <option value="C00001">Rượu vang đỏ</option>
                <option value="C00002">Rượu vang trắng</option>
                <option value="C00003">Vang bịch</option>
                <option value="C00004">Rượu vang nổ</option>
                <option value="C00005">Vang hồng</option>
                <option value="C00006">Vang ngọt</option>
                <option value="C00007">Vang organic</option>
                <option value="C00008">Champagne</option>
            </select>
        </div>
        <div class="field">
            <label for="">Mô tả</label>
            <textarea id="Descript" name="product_description" rows="4" cols="50"></textarea>
        </div>
        <div class="field">
            <button type="button" id="submit-add-product">Thêm sản phẩm</button>
        </div>

    </form>
</div>


<!-- HTML của form chỉnh sửa sản phẩm -->
<div id="content-admin-product-edit-product-window" class="content-admin-product-product-window" style="display:none;">
    <button id="close-edit-product-window" class="content-admin-product-close-btn" style="margin:10px">&times;</button>
    <form method="POST" class='content-admin-product-product-form' action="manageProduct.php">
        <img id="edit_previewImage" src="no_image.jpg" alt="Preview Image">
        <div class="field">
            <label for="">Đường dẫn ảnh</label>
            <input type="url" id="edit_imageInput" required onchange="addImage('edit_previewImage','edit_imageInput')">
            <button type="button" id="add_image" onclick="addImage('edit_previewImage','edit_imageInput')"><i class="fa_solid fa_upload"></i></i> Tải ảnh</button>
        </div>
        <div class="field">
            <label>ID sản phẩm</label>
            <input type="text" id="edit_ProductNum" disabled>
        </div>
        <div class="field">
            <label>Tên sản phẩm</label>
            <input type="text" id="edit_productName" name="product_name" required minlength="1">
        </div>
        <div class="field">
            <label for="">Giá sản phẩm</label>
            <input type="number" name="edit_productPrice" class="numberInput" id="edit_productPrice" required min="1000">
        </div>
        <div class="field tax-checkbox">
            <label for="">Thuế 1</label>
            <input type="checkbox" id="edit_tax1" name="tax1" value="1">
            <label for="">Thuế 2</label>
            <input type="checkbox" id="edit_tax2" name="tax2" value="1">
            <label for="">Thuế 3</label>
            <input type="checkbox" id="edit_tax3" name="tax3" value="1">

        </div>
        <div class="field">
            <label for="">Số lượng</label>
            <input type="number" id="edit_Quan" name="product_quanlity" class="numberInput" required min="0" value="0">
        </div>
        <div class="field">
            <label for="">Loại</label>
            <select id="edit_category">
                <option value="C00001">Rượu vang đỏ</option>
                <option value="C00002">Rượu vang trắng</option>
                <option value="C00003">Vang bịch</option>
                <option value="C00004">Rượu vang nổ</option>
                <option value="C00005">Vang hồng</option>
                <option value="C00006">Vang ngọt</option>
                <option value="C00007">Vang organic</option>
                <option value="C00008">Champagne</option>
            </select>
        </div>
        <div class="field">
            <label for="">Mô tả</label>
            <textarea id="edit_Descript" name="product_description" rows="4" cols="50"></textarea>
        </div>
        <!-- <div class="field"> -->
        <button type="button" id="submit-edit-product">Lưu</button>
</div>

</form>
</div>
<!-- HTML form xóa sản phẩm -->
<div id="content-admin-product-delete-product-window" style="display: none">
    <label>Bạn có chắc chắc muốn xóa sản phẩm <span id="delete-product-name"> </span></label>
    <div class="button-container">
        <button id="delete-product-confirm">Có</button>
        <button id="delete-product-cancel">Hủy</button>
    </div>
</div>

<!-------------------------------------- Table sản phẩm -------------------------------------------------->
<div class="content-admin-product-container">
    <div class='top-bar'>
        <div class="search-container">
            <form action="manageProduct.php">
                <input type="text" placeholder="Search" name="search" id="search-input">
                <button type="button" id="search-button"><i class="fa fa-search"></i></button>
            </form>
        </div>
        <div class="add-product">
            <form menthod="POST">
                <button type="button" id='add-product-button'>Thêm sản phẩm</button>
            </form>
        </div>
    </div>
    <div class="table-manager">
        <table id="content_admin_product_table">
            <thead>
                <tr>
                    <th>Product Number</th>
                    <th>Product Name</th>
                    <!-- <th>Description</th> -->
                    <th>Price</th>
                    <!-- <th>Active</th> -->
                    <th>Category</th>
                    <th>Stock</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>

            </tbody>

        </table>
    </div>
</div>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />



<style>
    .content-admin-product-container {
        background-color: rgba(217, 217, 217, 0.5);
        max-width: 90%;
        /* height: 90%; */
        margin: 10px auto;
        padding: 1rem;
        font-weight: bold;
        display: flex;
        flex-direction: column;
        font-family: 'OpenSans-regular';
    }

    /* cửa sổ sản phẩm */
    .content-admin-product-product-window {
        position: fixed;
        width: 80%;
        height: 90%;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background-color: #fff;
        border: 1px solid #ccc;
        padding: 30px;
        z-index: 9999;
    }

    /* Ẩn mũi tên ở input type number */
    .content-admin-product-product-window input::-webkit-outer-spin-button,
    .content-admin-product-product-window input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }


    /* CSS cho nút đóng */
    .content-admin-product-close-btn {
        position: absolute;
        top: -7px;
        right: -7px;
        font-size: 30px;
        color: #aaa;
        background-color: transparent;
        border: none;
        cursor: pointer;
    }

    .content-admin-product-product-window img {
        width: 20%;
        height: auto;
        float: right;
        margin-right: 10%;
        border-style: solid;
        border-width: 1px;
        border-color: #961313;
        border-radius: 10px;
    }


    .content-admin-product-product-form .field {
        margin: 15px;
        margin-top: 30px;
        margin-bottom: 10px;
    }

    .content-admin-product-product-form .field {
        display: flex;
        /* align-items: center; */
        /* margin-bottom: 10px; */
    }

    .content-admin-product-product-form .field label {
        width: 150px;
        text-align: left;
        margin-right: 10px;
    }

    .content-admin-product-product-form .field.tax-checkbox label {
        width: 60px;
    }

    .content-admin-product-product-form input[type=text],
    .content-admin-product-product-form input[type=number],
    .content-admin-product-product-form input[type=url] {
        padding: 10px;
        font-size: 14px;
        border-radius: 5px;
        outline: none;
        /* width: 40%; */
        border: solid 1px #ccc;
    }

    .content-admin-product-product-form input[type=checkbox] {
        margin-right: 70px;
        transform: scale(1.5);
    }

    .content-admin-product-product-form select {
        font-size: 15px;
        padding: 10px;
        border-radius: 5px;
    }

    .content-admin-product-product-form #submit-add-product {
        /* align-items: center; */
        padding: 10px;
        display: block;
        margin: 0 auto;
        background-color: #961313;
        color: white;
        border-radius: 5px;
        font-size: 20px;
        border: none;
    }

    .content-admin-product-container .search-container {
        float: left;
        width: 60%;
        /* position: absolute; */
    }

    .content-admin-product-container .add-product {
        float: right;
    }

    .content-admin-product-container .search-container input[type=text] {
        padding: 6px;
        /* padding-right: 90%; */
        margin-top: 8px;
        font-size: 17px;
        border: none;
        background-color: #D9D9D9;
        width: 60%;
    }

    .content-admin-product-container .search-container button {
        /* float: right; */
        position: absolute;
        padding: 6px 10px;
        margin-top: 8px;
        margin-right: 16px;
        background: #ddd;
        font-size: 17px;
        border: solid 2px #D9D9D9;
        margin-right: 25px;
        cursor: pointer;
    }

    .content-admin-product-container .search-container button:hover {
        background: #ccc;

    }

    .content-admin-product-container .add-product button {
        background-color: #961313;
        padding: 6px;
        padding-left: 15px;
        padding-right: 15px;
        margin-top: 8px;
        font-size: 17px;
        border: none;
        color: white;
        font-weight: bold;
        border-radius: 10px;
    }

    .content-admin-product-container .add-product button:hover {
        cursor: pointer;

    }

    #submit-edit-product {
        background-color: #961313;
        padding: 6px;
        padding-left: 15px;
        padding-right: 15px;
        margin-top: -8px;
        font-size: 17px;
        border: none;
        color: white;
        font-weight: bold;
        border-radius: 10px;
        float: right
    }

    #submit-edit-product:hover {
        cursor: pointer;
    }

    #content-admin-product-delete-product-window {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background-color: white;
        padding: 20px;
        border: 1px solid black;
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.5);
        z-index: 999;
    }

    #content-admin-product-delete-product-window .button-container {
        display: flex;
        justify-content: center;
        align-items: center;
        margin-top: 20px;
    }

    #content-admin-product-delete-product-window #delete-product-cancel {
        background-color: lightgray;
        color: black;
        padding: 5px 10px;
        border: none;
        margin-right: 10px;
        cursor: pointer;
    }

    #content-admin-product-delete-product-window #delete-product-confirm {
        background-color: red;
        color: white;
        padding: 5px 10px;
        border: none;
        cursor: pointer;
        margin-right: 30%;
    }

    .content-admin-product-container .table-manager {
        /* display: flex; */
        flex-direction: column;
    }


    .content-admin-product-container table {
        margin-top: 20px;
        border-collapse: collapse;
        width: 100%;
        resize: horizontal;
        overflow: auto;
        /* table-layout: fixed; */
        /* height: 100%; */
        /* cursor: ew-resize; */
        /* outline: none; */

    }

    .content-admin-product-container table input[type=checkbox] {
        transform: scale(1.5);
    }

    .content-admin-product-container td:nth-child(1) {
        /* text-align: center; */
        width: 10%;
    }
    .content-admin-product-container td:nth-child(2) {
        /* text-align: center; */
        width: 45%;
    }

    .content-admin-product-container td:nth-child(3) {
        text-align: right;
        width: 35px
    }

    .content-admin-product-container td:nth-child(4) {
        text-align: center;
        width: 15%;

    }
    .content-admin-product-container td:nth-child(5) {
        text-align: center;
        width: 10%;

    }

    .content-admin-product-container td:nth-child(6) {
        text-align: center;
        width: 15%
    }
    

    .content-admin-product-container th,
    .content-admin-product-container td {
        text-align: left;
        padding: 8px;
        border: 1px solid #ddd;
        resize: horizontal;
        overflow: auto;
        word-wrap: break-word;
    }

    .content-admin-product-container th {
        background-color: #961313;
        color: white;
        resize: horizontal;
    }

    .content-admin-product-container tr:hover {
        background-color: #f5f5f5;
    }

    .content-admin-product-container .fa-toggle-on {
        color: green;
    }

    .content-admin-product-container .fa-toggle-off {
        color: red;
    }


    /* CSS */
    .content-admin-product-container .btn-edit {
        /* background-color: yellow; */
        border-style: none;
        padding: 5px;
    }

    .content-admin-product-container .btn-edit:hover {
        cursor: pointer;
        text-decoration: underline;

    }

    .content-admin-product-container .btn-del {
        /* background-color: yellow; */
        border-style: none;
        padding: 5px;
    }

    .content-admin-product-container .btn-del:hover {
        cursor: pointer;
        text-decoration: underline;

    }
</style>
<script src="https://kit.fontawesome.com/44c01e1bca.js" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/numeral.js/2.0.6/numeral.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
    //------------- THÊM SẢN PHẨM--------------
    // Lấy đối tượng nút thêm sản phẩm
    var addProductButton = document.getElementById('add-product-button');

    // Thêm sự kiện click cho nút
    addProductButton.addEventListener('click', function() {
        // Hiển thị cửa sổ thêm sản phẩm
        var addProductWindow = document.getElementById('content-admin-product-add-product-window');
        addProductWindow.style.display = 'block';
    });
    // Lấy đối tượng nút đóng cửa sổ
    var closeAddProductButton = document.getElementById('close-add-product-button');

    // Thêm sự kiện click cho nút đóng cửa sổ
    closeAddProductButton.addEventListener('click', function() {
        // Ẩn cửa sổ thêm sản phẩm
        var addProductWindow = document.getElementById('content-admin-product-add-product-window');
        addProductWindow.style.display = 'none';
    });


    //-------------------THÊM ẢNH--------------

    function addImage(imageLocation, imageSrc) {
        const imageUrl = document.getElementById(imageSrc).value;
        if (imageUrl) {
            document.getElementById(imageLocation).innerHTML = "";
            document.getElementById(imageLocation).src = imageUrl;
        }
        if (imageUrl == "") {
            document.getElementById(imageLocation).innerHTML = "";
            document.getElementById(imageLocation).src = "no_image.jpg";
        }
    }

    // <!----------------- CHỈNH SỬA SẢN PHẨM---------------------- -->
    // Thêm sự kiện click cho nút chỉnh sửa
    function openEditForm(button) {
        var editForm = document.getElementById('content-admin-product-edit-product-window');
        // Nếu form chỉnh sửa đang ẩn, hiển thị nó
        if (editForm.style.display === 'none') {
            editForm.style.display = 'block';
        }
        // Nếu form chỉnh sửa đang hiển thị, ẩn nó
        else {
            editForm.style.display = 'none';
        }

        // Ẩn cửa sổ sửa sản phẩm
        var closeEditProductButton = document.getElementById('close-edit-product-window');
        closeEditProductButton.addEventListener('click', function() {
            var editProductWindow = document.getElementById('content-admin-product-edit-product-window');
            editProductWindow.style.display = 'none';
        });
        // Lấy id sản phẩm cần edit
        var id = button.getAttribute('data-id');
        var productId = button.getAttribute('data-id'); // Lấy ID của sản phẩm từ thuộc tính data-id của nút chỉnh sửa
        // console.log(productId);

        // Gửi yêu cầu AJAX để truy vấn thông tin sản phẩm từ server
        $.ajax({
            url: './template/dbconnection_EDIT_PRODUCT.php',
            type: 'POST',
            data: {
                table_name: "product",
                productId: productId,
                action: "getData"
            },
            success: function(response) {
                // Giải mã dữ liệu JSON trả về từ server
                var productInfo = JSON.parse(response);
                // Cập nhật giá trị các trường trong form với thông tin của sản phẩm
                document.getElementById('edit_ProductNum').value = productInfo[0].ProductNum;
                document.getElementById('edit_productName').value = productInfo[0].ProductName;
                document.getElementById('edit_productPrice').value = productInfo[0].Price;
                document.getElementById('edit_Quan').value = productInfo[0].Quan;
                document.getElementById('edit_Descript').value = productInfo[0].Descript;
                $('#edit_category').val(productInfo[0].CatId);
                $('#edit_imageInput').val(productInfo[0].ImageSource);
                $('#edit_previewImage').attr('src', productInfo[0].ImageSource);

                // Cập nhật trạng thái của các checkbox thuế
                $('#edit_tax1').prop('checked', productInfo[0].Tax1 === '1');
                $('#edit_tax2').prop('checked', productInfo[0].Tax2 === '1');
                $('#edit_tax3').prop('checked', productInfo[0].Tax3 === '1');
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(errorThrown);
                console.log(productId);
            }


        });
    }
    // --------------------------------------XÓA SẢN PHẨM-----------------------------
    function openDeleteConfirm(button) {
        var productId = button.getAttribute('data-id');
        swal({
                title: "Bạn có chắc chắn xóa sản phẩm " + productId,
                text: "Một khi đã xóa, bạn không thể phục hồi",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        url: './template/dbconnection_EDIT_PRODUCT.php',
                        type: 'POST',
                        data: {
                            action: 'delete',
                            table_name: "product",
                            id_object: productId
                        },
                        success: function(response) {
                            console.log(response);
                            if (response.indexOf("success") >= 0) {
                                swal("Thành công", "Sản phẩm đã bị xóa", "success")
                                    .then((value) => {
                                        location.reload();
                                    });
                            } else {
                                swal("Thất bại", "Có lỗi xảy ra", "error")
                                    .then((value) => {
                                        location.reload();
                                    });
                            }
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            console.log(errorThrown);
                            console.log(productId);
                        }

                    })

                }
            });

        function deleteProduct(productId) {

        }
        // $("#delete-product-name").html(productId);
        // $("#delete-product-confirm").on("click", function() {

        // });

    }

    // -------------------Ajax hiển thị sản phẩm vào table---------------------------------
    var Count_number_of_product = 0;
    $(document).ready(function() {
        var pro = [];
        var cat = [];
        $.ajax({
            url: "./template/dbconnection_GET.php",
            type: "GET",
            data: {
                table_name: "product"
            },
            dataType: "json",
            success: function(result) {
                pro = result;
            }
        }).then(function() {
            $.ajax({
                url: "./template/dbconnection_GET.php",
                type: "GET",
                data: {
                    table_name: "category"
                },
                dataType: "json",
                success: function(result) {
                    cat = result;
                    const proByCat = [];
                    const newPro = pro.map((itemPro) => {
                        const filteredCat = cat.filter(_ => _.CatId + '' === itemPro.CatId + '');
                        const catName = filteredCat.length > 0 ? filteredCat[0].CatName : '';
                        return {
                            ...itemPro,
                            CatName: catName
                        }
                    });
                    console.log(newPro);
                    $.each(newPro, function(i, item) {
                        // NếU số lượng = 0 thì không Active
                        if (item.IsActive !== "0") {
                            // var activeIcon = item.IsActive == 1 ?
                            //     '<button class="IconActive" value=1 data-id=' + item.ProductNum + ' onclick="switchActive(this)"><i class="fas fa-toggle-on"></i></button>' :
                            //     '<button class="IconDeactive" value=0 data-id=' + item.ProductNum + ' onclick="switchActive(this)"><i class="fas fa-toggle-off"></i></button>';
                            var priceFormatted = Number(item.Price).toLocaleString("vi-VN");
                            var id = item.ProductNum;
                            $("#content_admin_product_table tbody").append(
                                "<tr>" +
                                "<td>" + item.ProductNum + "</td>" +
                                "<td>" + item.ProductName + "</td>" +
                                "<td>" + priceFormatted + "</td>" +
                                // "<td>" + activeIcon + "</td>" +
                                "<td>" + item.CatName + "</td>" +
                                "<td>" + item.Quan + "</td>" +
                                "<td>" + '<button class="btn-edit" data-id=' + item.ProductNum + ' onclick="openEditForm(this)">Edit</button> | <button class="btn-del" data-id=' + item.ProductNum + ' onclick="openDeleteConfirm(this)">Delete</button>' + "</td>" +
                                "</tr>"
                            );
                            Count_number_of_product++;
                        };
                    });
                    console.log("Số lượng sản phẩm đã thêm: " + Count_number_of_product);
                }                
            })
        });
    });

    // -----------------------Kiểm tra hình ảnh----------------
    function checkProductImage(imgEle) {
        var imageInput = document.getElementById(imgEle);
        if (imageInput.validity.valueMissing) {
            imageInput.setCustomValidity("Vui lòng nhập đường dẫn ảnh");
            imageInput.reportValidity();
            imageInput.style.borderColor = "red";
            return false;
        } else if (imageInput.validity.typeMismatch) {
            imageInput.setCustomValidity("Vui lòng nhập đường dẫn ảnh hợp lệ");
            imageInput.reportValidity();
            imageInput.style.borderColor = "red";
            return false;
        } else {
            imageInput.setCustomValidity("");
            imageInput.style.borderStyle = "none";
            return true;
        }
    }

    // ----------------------KiếM tra tên sản phẩm
    function checkProductName(proName) {
        var productName = document.getElementById(proName);
        if (productName.validity.valueMissing) {
            productName.setCustomValidity("Vui lòng nhập tên sản phẩm");
            productName.reportValidity();
            productName.style.borderColor = "red";
            return false;
        } else if (productName.validity.tooShort) {
            productName.setCustomValidity("Tên sản phẩm phải có ít nhất 2 ký tự");
            productName.reportValidity();
            productName.style.borderColor = "red";
            return false;
        } else {
            productName.setCustomValidity("");
            productName.style.borderStyle = "none";
            return true;
        }
    }
    // -------------------------Kiểm tra giá sản phẩm
    function checkProductPrice(proPrice) {
        var productPrice = document.getElementById(proPrice);
        if (productPrice.validity.valueMissing) {
            productPrice.setCustomValidity("Vui lòng nhập giá sản phẩm");
            productPrice.reportValidity();
            productPrice.style.borderColor = "red";
            return false;
        } else if (productPrice.value < 1000) {
            productPrice.setCustomValidity("Giá sản phẩm không được nhỏ hơn 1000");
            productPrice.reportValidity();
            productPrice.style.borderColor = "red";
            return false;
        } else {
            productPrice.style.borderStyle = "none";
            return true;
        }
    }
    // ------------------------Kiểm tra số lượng sản phẩm-----------------------
    function checkProductQuantity(Quantity) {
        var checkProductQuantity = document.getElementById(Quantity);
        if (checkProductQuantity.value < 0) {
            checkProductQuantity.setCustomValidity("Số lượng sản phẩm không được nhỏ hơn 0");
            checkProductQuantity.reportValidity();
            checkProductQuantity.style.borderColor = "red";
            return false;
        } else {
            checkProductQuantity.style.borderStyle = "none";
            return true;
        }
    }

    function generateTempProductID(index) {
        return new Promise((resolve, reject) => {
            $.ajax({
                url: "./template/dbconnection_CHECK_ID.php",
                type: "POST",
                data: {
                    Id: index
                },
                dataType: "json",
                success: function(response) {
                    resolve(response);
                },
                error: function(xhr, status, error) {
                    reject(error);
                }
            });
        });
    }   
       
    
    // ---------------------------------Ajax thêm sản phẩm-------------------------
    $(document).ready(function() {
    $("#submit-add-product").on("click", async function() {
        if (checkProductImage("add_imageInput") == true &&
            checkProductName("productName") == true &&
            checkProductPrice("Price") == true &&
            checkProductQuantity("Quan") == true) {
            const productNum = await generateTempProductID(Count_number_of_product);
            const data_insert = {
                ProductNum: productNum,
                ProductName: $("#productName").val(),
                Descript: $("#Descript").val(),
                Price: $("#Price").val(),
                Tax1: $('#tax1').is(':checked') ? 1 : 0,
                Tax2: $('#tax2').is(':checked') ? 1 : 0,
                Tax3: $('#tax3').is(':checked') ? 1 : 0,
                Quan: $("#Quan").val(),
                IsActive: 1,
                CatId: $("#category").val(),
                ImageSource: $("#add_imageInput").val(),
            };
            console.log(data_insert);
            $.ajax({
                url: './template/dbconnection_POST.php',
                method: 'POST',
                dataType: 'json',
                data: {
                    table_name: 'product',
                    data_insert: JSON.stringify(data_insert)
                },
                success: function(response) {
                    console.log(response);
                    if (response) {
                        swal("Thành công", "Sản phẩm đã được thêm", "success")
                            .then((value) => {
                                location.reload();
                            });
                    } else {
                        swal("Thất bại", "Có lỗi xảy ra", "error")
                            .then((value) => {
                                location.reload();
                            });
                    }
                },
                error: function(xhr, status, error) {
                    var errorMessage = xhr.status + ': ' + xhr.statusText
                    alert('Có lỗi khi gửi dữ liệu tới API. ' + errorMessage);
                }
            });
        }
    });
});
    // ------------------------Ajax lưu sản phẩm đã edit--------------------------

    $("#submit-edit-product").on("click", function() {
        if (checkProductImage("edit_imageInput") == true && checkProductName("edit_productName") == true && checkProductPrice("edit_productPrice") == true &&
            checkProductQuantity("edit_Quan") == true) {
            var data_insert = {
                ProductNum: $("#edit_ProductNum").val() + '',
                ProductName: $("#edit_productName").val() + '',
                Descript: $("#edit_Descript").val() + '',
                Price: $("#edit_productPrice").val() + '',
                Tax1: $('#edit_tax1').is(':checked') ? Number('1') : Number('0') + '',
                Tax2: $('#edit_tax2').is(':checked') ? Number('1') : Number('0') + '',
                Tax3: $('#edit_tax3').is(':checked') ? Number('1') : Number('0') + '',
                Quan: $("#edit_Quan").val() + '',
                IsActive: 1 + '',
                CatId: $("#edit_category").val() + '',
                ImageSource: $("#edit_imageInput").val() + '',
            };
            $.ajax({
                url: './template/dbconnection_EDIT_PRODUCT.php',
                type: 'POST',
                data: {
                    action: 'save',
                    // table_name: 'product',
                    data_insert: JSON.stringify(
                        data_insert
                    )
                },
                success: function(response) {
                    // Xử lý phản hồi từ API
                    // console.log(response);
                    if (response) {
                        swal("Thành công", "Sản phẩm đã được lưu", "success")
                            .then((value) => {
                                location.reload();
                            });
                    } else {
                        swal("Thất bại", "Lưu sản phẩm thất bại", "error")
                            .then((value) => {
                                location.reload();
                            });
                    }
                },
                error: function(xhr, status, error) {
                    var errorMessage = xhr.status + ': ' + xhr.statusText
                    alert('Có lỗi khi gửi dữ liệu tới API. ' + errorMessage);
                }
            })
        }
    })

    // -------------------TÌM KIẾM--------------------
    $(document).ready(function() {
        $('#search-button').click(function() {
            var keyword = $('#search-input').val().toLowerCase();
            if (keyword.trim() === '') {
                $('#content_admin_product_table tbody tr').show();
                swal("Vui lòng nhập nội dung tìm kiếm");
                return;
            }
            var rowCount = 0;
            $('#content_admin_product_table tbody tr').filter(function() {
                var rowText = $(this).text().toLowerCase();
                var matched = rowText.indexOf(keyword) > -1;
                $(this).toggle(matched);
                if (matched) {
                    rowCount++;
                }
            });
            if (rowCount === 0) {
                swal("Thất bại", "Không tìm thấy sản phẩm yêu cầu", "error")
                    .then((value) => {
                        location.reload();
                    });
            }
        });
    });

    // -----------------------Active Icon------------------------------------------------
    function switchActive(button) {
        var _productId = button.getAttribute('data-id');
        var _isActive = button.getAttribute('value')
        // console.log(isActive);
        $.ajax({
            url: './template/dbconnection_PRODUCT_ACTIVE.php',
            type: 'POST',
            data: {
                productId: _productId,
                isActive: _isActive,
            },
            success: function(response) {
                console.log(response);
                if (response == "1") {
                    console.log("Đã ẩn sản phẩm");
                    location.reload();
                } else if (response == "0") {
                    console.log("Đã hiện sản phẩm");
                    location.reload();
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(errorThrown);
                console.log(productId);
            }

        })
    }
</script>