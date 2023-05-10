<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bán rượu</title>
    <!-- <link rel="stylesheet" href="./css/styles.css"> -->
    <link rel="stylesheet" href="./css/stylesnew.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>

</head>

<body>
    <?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    //   session_start();
    if (isset($_SESSION['admin']) && $_SESSION['admin'] === true) {
        include("pageAdmin.php");
    } elseif (isset($_SESSION['client']) && $_SESSION['client'] === true) {
        include("pageProduct.php");
    } else {
        // Nếu không có session hoặc không đúng loại session, kiểm tra biến GET 'user'
        if (isset($_GET['user'])) {
            $user = $_GET['user'];
            if ($user === 'admin') {
                include("pageAdmin.php");
            } else {
                include("pageProduct.php");
            }
        } else {
            include("pageProduct.php");
        }
    }
    ?>
</body>
<script src="./js/jsPage.js"></script>
<script src="./js/content_admin_user_manager.js"></script>

</html>


<script>
    function decryptString(encryptedText, secretKey = '123654789') {
        let decryptedString = '';

        for (let i = 0; i < encryptedText.length; i++) {
            const charCode = encryptedText.charCodeAt(i);
            const keyChar = secretKey.charCodeAt(i % secretKey.length);
            const decryptedCharCode = charCode ^ keyChar;
            decryptedString += String.fromCharCode(decryptedCharCode);
        }

        return decryptedString;
    };
    const storedValue = localStorage.getItem('UP');
    let userID = "";
    try {
        userID = '<?php echo $_SESSION['userId'] ?>';
    } catch (e) {
        console.log(e);
    };
    if (userID !== "" && !sessionStorage.getItem("codeExecuted")) {
        const pw = decryptString(storedValue, '123654789');
        $.ajax({
            url: 'template/db_LOGIN.php',
            method: 'POST',
            dataType: 'json',
            data: {
                userid: userID,
                password: pw,
            },
            success: function(response) {
                console.log(response);
                if (response == 'admin') {
                    window.location = 'index.php?user=admin';
                } else if (response == 'client') {
                    window.location = 'index.php?user=client';
                } else {

                }
                sessionStorage.setItem("codeExecuted", true);
            },
            error: function(xhr, status, error) {
                alert(status);
                console.log(xhr.responseText);
                sessionStorage.setItem("codeExecuted", true);
            }
        });
    };
</script>