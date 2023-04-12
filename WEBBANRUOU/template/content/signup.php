<?php
session_start();
if (isset($_SESSION['username'])) {
    header('Location: index.php');
    exit();
}
if (isset($_POST['signup'])) {
    // $servername = "localhost";
    // $username = "admin";
    // $password = "admin";
    // $dbname = "pubmanager";

    // Create connection
    $conn = new mysqli('localhost', 'admin', 'admin', 'pubmanager');

    if ($conn->connect_errno) {
        echo "Failed to connect to MySQL: " . $mysqli->connect_error;
    } else {
        mysqli_set_charset($conn, "utf8");
        // kiem tra thong tin dang ky
        $username = $conn->real_escape_string($_POST['username']);
        $password = $conn->real_escape_string($_POST['password']);
        $email = $conn->real_escape_string($_POST['email']);

        $data1 = $conn->query("SELECT userid FROM useraccount WHERE UserName='$username' ");
        $data2 = $conn->query("SELECT userid FROM useraccount WHERE Email='$email'");
        if ($data1->num_rows > 0) {
            exit('error1');
        } else if ($data2->num_rows > 0) {
            exit('error2');
        } else {
            $UserID = hash_hmac('sha256', $username, '123654789');
            $query = "INSERT INTO useraccount (UserID, UserName, UserPassword, Email, AccessLevel, IsActive) VALUES ('$UserID', '$username', '$password', '$email', '50', '1')";
            if ($conn->query($query) === TRUE) {
                exit('success');
            } else {
                echo "Error: " . $query . "<br>" . $conn->error;
            }
        }
    }
    $conn->close();
}
?>

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

    .content-signup-container{
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

    /* button:focus {
	outline: none;
	color: #fff;
	background-color: #0b5ed7;
	border-color: #0a58ca;
	box-shadow: 0 0 0 0.25rem rgb(49 132 253 / 50%);
    } */

    /* radio  & checkbox*/
    /* .content-signup-form label.radio,
    .content-signup-form label.checkbox {
        width: auto;
        cursor: pointer;
        display: inline-block;
        position: relative;
        border-radius: 5px;
    }

    .content-signup-form .stack label.radio,
    .content-signup-form .stack label.checkbox {
        display: block;
        margin-left: auto;
    }

    .content-signup-form .radio+.radio,
    .content-signup-form .checkbox+.checkbox {
        margin-left: 1rem;
    }

    .content-signup-form input[type="checkbox"],
    .content-signup-form input[type="radio"] {
        vertical-align: baseline;
        width: auto;
    }

    /* vertical form */
    /* .vertical label,
    .vertical input,
    .vertical textarea {
        display: block;
        width: 100%;
    } */

    /* horizontal form */
    /* .horizontal .field {
        display: grid;
        grid-template-columns: 20% 1fr;
        gap: 1rem 1rem;
        align-items: center;
        margin-bottom: 1rem;
    }

    .horizontal .field label {
        grid-column: 1 / 2;
        text-align: left;
    }

    .horizontal .field label.radio,
    .horizontal .field label.checkbox {
        grid-column: 2 / 3;
        text-align: left;
    }

    .horizontal .field input,
    .horizontal .field button,
    .horizontal .field small {
        grid-column: 2 / 3;
    } */

    /* Utility classes*/
    /* .half {
        width: 50%;
    }

    .quarter {
        width: 25%;
    }

    .full {
        width: 100%;
    } */

    /* .error {
        color: #dc3545;
    } */ 
</style>
<!-- SCRIPT    /////////////////////////////////////////////////////////////////////////// -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
<script>
    function checkUsername() {
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
        } else {
            username.style.borderStyle = "none";
        }
    }

    function checkPassword() {
        var password = document.getElementById("password");
        var _password = $("#password").val();

        if (password.validity.valueMissing) {
            password.setCustomValidity("Vui lòng nhập mật khẩu");
            password.reportValidity();
            password.style.borderColor = "red";
        } else if (password.validity.tooShort) {
            password.setCustomValidity("Mật khẩu cần ít nhất 8 ký tự");
            password.reportValidity();
            password.style.borderColor = "red";
        } else {
            password.style.borderStyle = "none";
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
        }

    }



    $(document).ready(function() {
        console.log('ready');
        $("#submit").on("click", function() {
            var username = document.getElementById("username");
            var password = document.getElementById("password");
            var rePassword = document.getElementById("rePassword")
            var email = document.getElementById("email");
            var _username = $("#username").val();
            var _password = $("#password").val();
            var _rePassword = $("#rePassword").val();
            var _email = $("#email").val();

            checkEmail();
            checkRePassWord();
            checkPassword();
            checkUsername();

            $.ajax({
                url: 'signup.php',
                method: 'POST',
                dataType: 'text',
                data: {
                    signup: 1,
                    username: _username,
                    password: _password,
                    email: _email,
                },
                success: function(result) {
                    $("#result").html(result);
                    if (result.indexOf("success") >= 0) {
                        alert("Đăng ký thành công \nChuyển sang trang đăng nhập ");
                        window.location = 'login.php';
                    } else if (result.indexOf("error1") >= 0) {
                        alert("Tên đăng nhập đã được sử dụng, vui lòng chọn tên đăng nhập khác");
                    } else if (result.indexOf("error2") >= 0) {
                        alert("Email đã được sử dụng, vui lòng chọn Email khác");
                    }

                },

            })

        });
    });
</script>