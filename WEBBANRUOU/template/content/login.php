<?php
session_start();

//neu da login
// if (isset($_SESSION['logged_in'])) {
//     // header("location: Personal.php");
//     exit();
// }

if (isset($_POST['login'])) {
    // Create connection
    $conn = new mysqli('localhost','admin', 'admin','pubmanager');

    if ($conn->connect_errno) {
        echo "Failed to connect to MySQL: " . $mysqli->connect_error;
        // exit();
    } else {
        mysqli_set_charset($conn, "utf8");
    }

    // kiem tra thong tin dang nhap
    $username = $conn->real_escape_string($_POST['username']);
    $password = $conn->real_escape_string($_POST['password']);
    $data = $conn->query("SELECT * FROM useraccount WHERE UserName='$username' AND UserPassword='$password'");
    if ($data->num_rows > 0) {
        // dang nhap thanh cong 
        $_SESSION['logged_in'] = '1';
        $_SESSION['username'] = $username;
        $user = mysqli_fetch_assoc($data);
        $accessLevel = $user["AccessLevel"];
        if ($accessLevel == 100) {
            // Người dùng là admin
            exit('admin');
        } else if ($accessLevel == 50) {
            // Người dùng là khách hàng
            exit('client');
            // exit('success');
        } else {
            // dang nhap that bai
            exit('failed');
        }
    }
    $conn->close();
}
?>
<div class="content-login-container">
    <div class="content-login-form">
        <h1>Đăng nhập</h1>
        <p id="result"></p>
        <form method="POST" class="sign-in-form">
            <div class="field">
                <label for="username">Tên đăng nhập</label>
                <input type="text" name="username" id="username" required minlength="1">

            </div>
            <div class="field">
                <label for="password">Mật khẩu</label>
                <input type="password" name="password" id="password" required minlength="1">
                <i class="bi bi-eye-slash" id="togglePassword"></i>
                <small></small>
            </div>
            <div class="center-button">
                <button type="button" id="submit" class="submit" name="login" value="login">Đăng nhập</button>
            </div>
        </form>
        <div>
            <small>
                Bạn chưa có tài khoản? <a href="signup.php">Đăng ký</a>
            </small>
        </div>
    </div>
</div>

<!-- <link rel="stylesheet" href="style.css"> -->
<!-- STYLE -->
<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }


    .content-login-container{
        font-weight: bold;
        font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen, Ubuntu, Cantarell, "Open Sans",
            "Helvetica Neue", sans-serif;
        font-size: 1rem;
        line-height: 1.7;
        background-color: #f4f4f4;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        background: url('../../../image/login-background.jpg') no-repeat center center fixed;
        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        background-size: cover;

    }

    .content-login-form {
        background-color: rgba(217, 217, 217, 0.5);
        border-radius: 20px;
        /* box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2); */
        max-width: 300px;
        margin: 10px auto;
        padding: 1rem;
    }

    .content-login-form h1 {
        padding: 6px 0;
        /* margin-bottom: 1rem; */
        font-size: 1.2rem;
        color: #961313;
        text-align: center;
        /* background-color:#961313; */
        margin: 0px -1rem;
        margin-top: -15px;
        border-top-right-radius: 20px 20px;
        border-top-left-radius: 20px 20px;

    }

    .content-login-form label {

        color: #961313;
    }

    .content-login-form .sign-in-form {
        margin-top: 1rem;
    }

    .content-login-form input {
        padding: 10px;
        font-size: 14px;
        border-radius: 5px;
        outline: none;
        width: 100%;
        border: solid 1px #ccc;
    }

    .content-login-form form i {
        margin-left: -30px;
        cursor: pointer;
    }

    .content-login-form .center-button {
        text-align: center;
        margin-top: 1rem;
        margin-bottom: 1rem;
    }

    .content-login-form button {
        box-sizing: border-box;
        width: 50%;
        padding: 3%;
        background: #961313;
        border: none;
        color: #fff;
        font-size: 14px;
        border-radius: 20px;
        font-weight: bold;
    }

    .content-login-form button:hover {
        background: #7f0202;
        cursor: pointer;
    }

    .content-login-form .submit {
        margin-top: 10px;
    }

    /* input error */
    .content-login-form input.error,
    .content-login-form textarea.error,
    .content-login-form select.error {
        border-color: #dc3545;
    }

    .content-login-form small {
        color: #dc3545;
        display: block;
        font-weight: lighter;
        font-style: italic;
        text-align: center;
    }
</style>
<script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>



<script>
    //TOGGLE PASSWORD
    const togglePassword = document.querySelector("#togglePassword");
    const password = document.querySelector("#password");

    togglePassword.addEventListener("click", function() {
        // toggle the type attribute
        const type =
            password.getAttribute("type") === "password" ? "text" : "password";
        password.setAttribute("type", type);

        // toggle the icon
        this.classList.toggle("bi-eye");
    });

    //REQUIRE USERNAME AND PASSWORD

    function checkUsername() {
        var username = document.getElementById("username");
        var _username = $("#username").val();
        if (username.validity.valueMissing) {
            username.setCustomValidity("Vui lòng nhập tên đăng nhập");
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
        } else {
            password.style.borderStyle = "none";
        }
    }

    $(document).ready(function() {
        console.log('ready');
        $("#submit").on("click", function() {
            checkPassword();
            checkUsername();
            var username = document.getElementById("username");
            var _username = $("#username").val();
            var password = document.getElementById("password");
            var _password = $("#password").val();
            $.ajax({
                url: 'login.php',
                method: 'POST',
                dataType: 'text',
                data: {
                    login: 1,
                    username: _username,
                    password: _password,
                },
                success: function(response) {

                    // $("#result").html(result);
                    console.log(response);
                    if (response == 'admin') {
                        alert('Day la trang admin');
                        location.reload();
                    } else if (response == 'client') {
                        alert('Dang nhap khach hang thanh cong.');
                        // if (result.indexOf("success") >= 0)
                        //     window.location = 'Personal.php';
                        // console.log(result.indexOf("success"));
                    } else
                        alert("Tên đăng nhập hoặc mật khẩu không chính xác!");
                    // console.log(result.indexOf("error"));
                },
            })

        })

    });
</script>