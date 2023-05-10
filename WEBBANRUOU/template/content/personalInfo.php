<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$UserId = $_SESSION["userId"];
?>
<div id="client-user-info">
    <h1>Thông tin cá nhân</h1>
    <div class="personal-info">
        <lable>Username:</lable>
        <span class="username"></span>
    </div>
    <div class="personal-info">
        <lable>Email:</lable>
        <input class="email" type="email" name="email" value="" disabled required>
    </div>
    <div class="personal-info">
        <lable>Tiền trong tài khoản:</lable>
        <span class="totalCash"></span>
    </div>
    <div class="personal-info">
        <lable>Địa chỉ:</lable>
        <input class="address" type="text" name="email" value="" disabled required>
    </div>
    <button id="edit-button">Sửa thông tin cá nhân</button>
    <button id="change-password-button">Đổi mật khẩu</button>
</div>


<!-- Thêm modal vào HTML -->
<div id="client-user-info-change-password-modal" class="modal">
    <!-- Nội dung của modal -->
    <div class="modal-content">
        <h2>Đổi mật khẩu</h2>
        <form>
            <div class="form-group">
                <label for="old-password">Mật khẩu cũ</label>
                <input type="password" class="form-control" id="old-password">
            </div>
            <div class="form-group">
                <label for="new-password">Mật khẩu mới</label>
                <input type="password" class="form-control" id="new-password">
            </div>
            <div class="form-group">
                <label for="confirm-password">Xác nhận mật khẩu</label>
                <input type="password" class="form-control" id="confirm-password">
            </div>
        </form>
        <div class="modal-buttons">
            <button type="button" id="confirm-change-password-button" class="button-23">Đổi mật khẩu</button>
            <button type="button" id="close-button" class="button-23">Đóng</button>
        </div>
    </div>
</div>


<script>
    var userID = '0';
    try {
        userID = '<?php echo $UserId; ?>';
    } catch (e) {
        console.log(e);
    };
    // Lấy các phần tử cần thiết
    const modal = document.getElementById('client-user-info-change-password-modal');
    const openModalButton = document.getElementById('change-password-button');
    const closeButton = document.getElementById('close-button');

    // Gắn sự kiện click vào nút đổi mật khẩu để mở modal
    openModalButton.addEventListener('click', function() {
        modal.style.display = 'block';
    });

    // Gắn sự kiện click vào nút đóng để đóng modal
    closeButton.addEventListener('click', function() {
        modal.style.display = 'none';
    });

    function checkPassword() {
        var oldPassword = document.getElementById("old-password");
        var newPassword = document.getElementById("new-password");
        var confirmPassword = document.getElementById("confirm-password");

        // Kiểm tra mật khẩu cũ
        if (oldPassword.value === "") {
            oldPassword.setCustomValidity("Vui lòng nhập mật khẩu cũ");
            oldPassword.reportValidity();
            oldPassword.style.borderColor = "red";
            return false;
        } else {
            oldPassword.style.borderStyle = "solid";
            oldPassword.style.borderColor = "black";
        }

        // Kiểm tra mật khẩu mới
        var newPasswordValue = newPassword.value;
        var regex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$@$!%*?&])[A-Za-z\d$@$!%*?&]{8,}$/;
        if (newPasswordValue === "") {
            newPassword.setCustomValidity("Vui lòng nhập mật khẩu mới");
            newPassword.reportValidity();
            newPassword.style.borderColor = "red";
            return false;
        } else if (newPasswordValue.length < 8) {
            newPassword.setCustomValidity("Mật khẩu phải có ít nhất 8 ký tự");
            newPassword.reportValidity();
            newPassword.style.borderColor = "red";
            return false;
        } else if (!/[a-z]/.test(newPasswordValue)) {
            newPassword.setCustomValidity("Mật khẩu phải chứa ít nhất một ký tự chữ thường");
            newPassword.reportValidity();
            newPassword.style.borderColor = "red";
            return false;
        } else if (!/[A-Z]/.test(newPasswordValue)) {
            newPassword.setCustomValidity("Mật khẩu phải chứa ít nhất một ký tự chữ hoa");
            newPassword.reportValidity();
            newPassword.style.borderColor = "red";
            return false;
        } else if (!/\d/.test(newPasswordValue)) {
            newPassword.setCustomValidity("Mật khẩu phải chứa ít nhất một chữ số");
            newPassword.reportValidity();
            newPassword.style.borderColor = "red";
            return false;
        } else if (!/[$@$!%*?&]/.test(newPasswordValue)) {
            newPassword.setCustomValidity("Mật khẩu phải chứa ít nhất một ký tự đặc biệt");
            newPassword.reportValidity();
            newPassword.style.borderColor = "red";
            return false;
        } else if (!regex.test(newPasswordValue)) {
            newPassword.setCustomValidity("Mật khẩu mới không hợp lệ");
            newPassword.reportValidity();
            newPassword.style.borderColor = "red";
            return false;
        } else {
            newPassword.style.borderStyle = "solid";
            newPassword.style.borderColor = "black";
        }

        // Kiểm tra xác nhận mật khẩu
        if (confirmPassword.value === "") {
            confirmPassword.setCustomValidity("Vui lòng xác nhận mật khẩu");
            confirmPassword.reportValidity();
            confirmPassword.style.borderColor = "red";
            return false;
        } else if (confirmPassword.value !== newPasswordValue) {
            confirmPassword.setCustomValidity("Mật khẩu không khớp");
            confirmPassword.reportValidity();
            confirmPassword.style.borderColor = "red";
            return false;
        } else {
            confirmPassword.style.borderStyle = "solid";
            confirmPassword.style.borderColor = "black";
        }

        // Nếu tất cả đều hợp lệ, trả về true
        return true;
    }
    // Gắn sự kiện click vào nút đổi mật khẩu để đổi mật khẩu
    const changePasswordButton = document.getElementById('confirm-change-password-button');
    changePasswordButton.addEventListener('click', function() {
        // Xử lý đổi mật khẩu ở đây
        if (checkPassword()) {
            $.ajax({
                type: "POST",
                url: "./template/dbconnection_Personal_Info.php",
                dataType: "json",
                data: {
                    userID: userID,
                    action: "changePassword",
                    oldPassword: $("#old-password").val(),
                    newPassword: $("#new-password").val(),
                    confirmPassword: $("#confirm-password").val()
                },
                success: function(response) {
                    console.log(response);
                    if (response.indexOf("success") >= 0) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Đổi mật khẩu thành công thành công',
                            showConfirmButton: false,
                            timer: 1500
                        });
                        setTimeout(function() {
                            location.reload();
                        }, 1500);
                    } else if (response.indexOf("old") >= 0) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Sai mật khẩu cũ',

                        })
                    }
                }
            })
            modal.style.display = 'none';
        } else {
            event.preventDefault();
        }
        // Đóng modal sau khi đổi mật khẩu xong

    });

    // Đóng modal khi nhấn vào nút đóng bên ngoài modal
    window.addEventListener('click', function(event) {
        if (event.target == modal) {
            modal.style.display = 'none';
        }
    });
</script>
<script>
    $(document).ready(function() {
        $.ajax({
            type: "POST",
            url: "./template/dbconnection_Personal_Info.php",
            dataType: "json",
            data: {
                userID: userID,
                action: "getInfo"
            },
            success: function(data) {
                $(".username").text(data.UserName);
                $(".email").val(data.Email);
                $(".totalCash").text(formatNumber(data.TotalCash) + " đ");
                $(".address").val(data.Address);
            }
        })
    });

    function formatNumber(number) {
        return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }
    $(document).on('click', '#edit-button', function() {
        $(".email").removeAttr("disabled");
        $(".address").removeAttr("disabled");
        $("#edit-button").text("Lưu").attr("id", "save-button");
        $("#change-password-button").text("Hủy").attr("id", "cancel-button");

        $("#save-button").on("click", function() {
            if (checkEmail() && checkAddress()) {
                var _email = $(".email").val();
                var _address = $(".address").val();
                $.ajax({
                    type: "POST",
                    url: "./template/dbconnection_Personal_Info.php",
                    dataType: "json",
                    data: {
                        userID: userID,
                        email: _email,
                        address: _address,
                        action: 'save',
                    },
                    success: function(response) {
                        if (response.indexOf("success") >= 0) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Lưu thành công',
                                showConfirmButton: false,
                                timer: 1500
                            });
                            setTimeout(function() {
                                location.reload();
                            }, 1500);
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'Trùng Email!',
                            })
                        }

                    }
                })
            }
        });
        $("#cancel-button").on("click", function() {
            location.reload();
        });
    });




    function checkEmail() {
        var email = document.getElementsByClassName("email")[0];
        var _email = $(".email").val();
        console.log(email);
        const emailRegex =
            /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

        if (email.validity.valueMissing) {
            email.setCustomValidity("Vui lòng nhập email");
            email.reportValidity();
            email.style.borderColor = "red";
        } else if (!emailRegex.test(_email)) {
            email.setCustomValidity("Email không hợp lệ");
            email.reportValidity();
            email.style.borderColor = "red";
        } else {
            email.style.borderStyle = "solid";
            email.style.borderColor = "black";
            return true;
        }

    }

    function checkAddress() {
        var address = document.getElementsByClassName("address")[0];
        var _address = $(".address").val();
        console.log(address);
        const addressRegex = /^[A-Za-z0-9\p{L}\s,-/]+$/u;
        if (address.validity.valueMissing) {
            address.setCustomValidity("Vui lòng nhập địa chỉ");
            address.reportValidity();
            address.style.borderColor = "red";
        } else if (!addressRegex.test(_address)) {
            address.setCustomValidity("Địa chỉ không hợp lệ");
            address.reportValidity();
            address.style.borderColor = "red";
        } else {
            address.style.borderStyle = "solid";
            address.style.borderColor = "black";
            return true;
        }

    }
</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<style>
    #client-user-info {
        background-color: #fff;
        border: 1px solid #ccc;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        margin: 10px auto;   
        max-width: 90%;    
        min-width: 600px;       
        padding: 1rem;
        display: flex;
        flex-direction: column;        
    }

    /* Thiết lập kiểu dáng cho tiêu đề trang */
    #client-user-info h1 {
        font-size: 24px;
        margin: 0 0 20px 0;
        text-align: center;
    }

    #client-user-info input[type="text"],
    #client-user-info input[type="email"] {
        margin: 10px 0px;
        padding: 0px 10px;
        width: 100%;
        height: 30px;
    }

    /* Thiết lập kiểu dáng cho các thông tin cá nhân */
    #client-user-info .personal-info {
        margin-bottom: 10px;
    }

    #client-user-info-change-password-modal .form-group {
        margin: 10px;
    }

    #client-user-info .personal-info span {
        font-weight: bold;
        margin-right: 10px;
    }

    /* Thiết lập kiểu dáng cho nút đăng xuất */
    #client-user-info button {
        background-color: #f44336;
        border: none;
        border-radius: 3px;
        color: #fff;
        cursor: pointer;
        font-size: 16px;
        padding: 10px;
        margin: 10px;
    }

    #client-user-info button:hover {
        background-color: #d32f2f;
    }

    .modal-content {
        max-width: 500px;
        padding: 30px;
        color: #fff;
    }

    .modal-content h2 {
        padding: 20px
    }

    .modal-content input[type="password"] {
        margin: 10px 0px;
        padding: 0px 10px;
        width: 100%;
        height: 30px;
        border-radius: 10px;
    }
</style>