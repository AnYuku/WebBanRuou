<!-- HTML -->
<div class="content-signup-container">
    <div class="content-signup-form">
        <form action="signup.php" method="post" id="signup">
            <h1>Đăng ký</h1>
            <div class="field">
                <label for="username">Tên đăng nhập</label>
                <input type="text" id="username" name="username" required minlength="6" />
                <br>
                <small></small>
            </div>
            <div class="field">
                <label for="password">Mật khẩu</label>
                <input type="password" id="password" name="password" required minlength="8" />
                <br>
                <small></small>
            </div>
            <div class="field">
                <label for="rePassword">Nhập lại mật khẩu</label>
                <input type="password" id="rePassword" name="rePassword" required minlength="8" />
                <br>
                <small></small>
            </div>

            <div class="field">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required />
                <br>
                <small></small>
            </div>
            <!-- <div class="field"> -->
            <div class="center-button">
                <button type="button" id="submit" name="submit">Đăng ký</button>
            </div>

            <!-- </div> -->
        </form>
    </div>
</div>
<!-- STYLE      ////////////////////////////////////////////////////////////////////////// -->
<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;

    }

    .content-signup-container {
        font-weight: bold;
        flex-direction: column;
        font-family: 'OpenSans-regular';
        font-size: 1rem;
        background-color: #fefefe;
        display: flex;
        align-items: center;
        justify-content: center;
        min-height: 100vh;
        background: url('../../../image/login-background.jpg') no-repeat center center fixed;
        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        background-size: cover;
    }

    .content-signup-form {
        background-color: rgba(217, 217, 217, 0.5);
        border-radius: 20px;
        box-shadow: rgba(50, 50, 93, 0.25) 0px 2px 5px -1px, rgba(0, 0, 0, 0.3) 0px 1px 3px -1px;
        width: 350px;

    }

    .content-signup-form form {
        max-width: 400px;
        margin: 10px auto;
        padding: 0.5rem 1rem;
    }

    .content-signup-form form h1 {
        padding: 15px;
        font-size: 1.4rem;
        text-align: center;
        color: #961313;
        font-weight: bold;

        margin: 0px -1rem;
        margin-top: -1.2rem;
        margin-bottom: 1rem;
        border-top-right-radius: 20px 20px;
        border-top-left-radius: 20px 20px;
    }

    /*! form.css v1.0 | MIT License | https://www.javascripttutorial.net/ */

    .content-signup-form .field {
        margin-bottom: 0.75rem;
    }

    .content-signup-form .field small {
        color: #dc3545;
    }

    .content-signup-form label {
        display: inline-block;
        margin-bottom: 5px;
        vertical-align: top;
        width: 100%;
        color: #961313;
    }

    /* input, textarea */
    .content-signup-form input,
    .content-signup-form textarea,
    .content-signup-form select {
        border: solid 1px #ccc;
        border-radius: 3px;
        display: inline-block;
        padding: 0.5rem 0.75rem;
        width: 100%;
        font-family: inherit;
        font-size: 1rem;
    }

    .content-signup-form input::placeholder {
        color: #c2c2c2;
    }

    .content-signup-form input:focus,
    .content-signup-form textarea:focus,
    .content-signup-form select:focus {
        outline: none;
        box-shadow: 0 0 0 2pt rgb(49, 132, 253, 0.5);
    }

    .content-signup-form input[disabled],
    .content-signup-form textarea[disabled] {
        background-color: #f5f5f5;
        box-shadow: none;
        color: #7a7a7a;
        cursor: not-allowed;
    }

    /* input error */
    .content-signup-form input.error,
    .content-signup-form textarea.error,
    .content-signup-form select.error {
        border-color: #dc3545;
    }

    .content-signup-form input.error:focus,
    .content-signup-form textarea.error:focus,
    .content-signup-form select.error:focus {
        box-shadow: 0 0 0 0.25rem rgb(220 53 69 / 25%);
    }

    /* input success */
    .content-signup-form input.success,
    .content-signup-form textarea.success,
    .content-signup-form select.success {
        border-color: #198754;
    }

    .content-signup-form input.success:focus,
    .content-signup-form textarea.success:focus {
        box-shadow: 0 0 0 0.25rem rgb(25 135 84 / 25%);
    }

    /* button */
    .content-signup-form button {
        background: #961313;
        color: #fff;
        width: 50%;
        border-radius: 20px;
        font-size: 1rem;
        /* font-weight: 400; */
        border: 1px solid #961313;
        /* transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out,
		box-shadow 0.15s ease-in-out; */
        text-align: center;
        padding: 0.375rem 0.75rem;
        font-weight: bold;
    }

    .content-signup-form button:hover {
        background: #7f0202;
        border-color: #7f0202;
        cursor: pointer;
    }

    .content-signup-form .center-button {
        text-align: center;
        margin-top: 2.5rem;
        margin-bottom: 1rem;
    }
</style>
<!-- SCRIPT    /////////////////////////////////////////////////////////////////////////// -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
    function checkUsername() {
        var regex = /^[a-zA-Z0-9]+$/;
        var username = document.getElementById("username");
        var _username = $("#username").val();
        if (username.validity.valueMissing) {
            username.setCustomValidity("Vui lòng nhập tên đăng nhập");
            username.reportValidity();
            username.style.borderColor = "red";
        } else if (username.validity.tooShort) {
            username.setCustomValidity("Tên đăng nhập cần ít nhất 6 ký tự");
            username.reportValidity();
            username.style.borderColor = "red";
        } else if (!regex.test(_username)) {
            username.setCustomValidity("Tên đăng nhập không hợp lệ");
            username.reportValidity();
            username.style.borderColor = "red";
        } else {
            username.style.borderStyle = "none";
            return true;
        }
    }

    function checkPassword() {
        var password = document.getElementById("password");
        var _password = $("#password").val();
        var regex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$@$!%*?&])[A-Za-z\d$@$!%*?&]{8,}$/;
        if (password.validity.valueMissing) {
            password.setCustomValidity("Vui lòng nhập mật khẩu");
            password.reportValidity();
            password.style.borderColor = "red";
        } else if (password.validity.tooShort) {
            password.setCustomValidity("Mật khẩu cần ít nhất 8 ký tự");
            password.reportValidity();
            password.style.borderColor = "red";
        } else if (!regex.test(_password)) {
            password.setCustomValidity("Mật khẩu không hợp lệ");
            password.reportValidity();
            password.style.borderColor = "red";
        } else {
            password.style.borderStyle = "none";
            return true;
        }
    }

    function checkRePassWord() {
        var rePassword = document.getElementById("rePassword")
        var _password = $("#password").val();
        var _rePassword = $("#rePassword").val();
        if (_rePassword != _password || _rePassword == "") {
            rePassword.setCustomValidity("Mật khẩu không khớp");
            rePassword.reportValidity();
            rePassword.style.borderColor = "red";
        } else {
            rePassword.style.borderStyle = "none";
            return true;
        }

    }

    function checkEmail() {
        var email = document.getElementById("email");
        var _email = $("#email").val();
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
            email.style.borderStyle = "none";
            return true;
        }

    }
    $(document).ready(function() {
        console.log('ready');
        $("#submit").on("click", function() {
            var _username = $("#username").val();
            var _password = $("#password").val();
            var _rePassword = $("#rePassword").val();
            var _email = $("#email").val();

            if (checkUsername() && checkPassword() && checkEmail() && checkRePassWord()) {
                $.ajax({
                    url: '../../template/dbconnection_SIGNUP.php',
                    method: 'POST',
                    dataType: 'json',
                    data: {
                        username: _username,
                        password: _password,
                        email: _email,
                        action: 'check_and_signup'
                    },
                    success: function(response) {
                        if (response.indexOf("success") >= 0) {
                            swal("Thành công", "Đăng ký thành công", "success")
                                .then((value) => {
                                    window.location = 'login.php';
                                });
                        } else if (response.indexOf("error1") >= 0) {
                            swal("Thất bại", "Tên đăng nhập đã được sử dụng, vui lòng chọn tên đăng nhập khác", "error");
                        } else if (response.indexOf("error2") >= 0) {
                            swal("Thất bại", "Email đã được sử dụng, vui lòng chọn email khác", "error");

                        }

                    },

                })
            }
        });
    });
</script>