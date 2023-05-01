<header class="header_admin">
    <div class="header_index">
        <div class="menu_admin"> 
            <img class="menuadmin" id="menuadmin" src="./image/icons8_list_64px.png" alt="" srcset="">
        </div>
        <div>
            <a href="index.php?chon=t&id=trangchu" class="logo"><img  src="./image/Logo.png" alt="" srcset=""></a> 
        </div>
        <div class="link_user">
            <img class="iconuser" id="iconuser" src="./image/Male User_64px.png" alt="" srcset="">
            <div>
            <?php
                if (session_status() == PHP_SESSION_NONE) {
                    session_start();
                }
                ?>
                <?php if (isset($_SESSION['username'])): ?>
                    <p style="color: white;line-height: 68px;margin-left: 10px;font-size: 18px;"><?php echo $_SESSION['username']; ?></p>
                <?php else: ?>
                    <a id="loginphp" href="index.php?chon=t&id=dangnhap">Đăng nhập</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</header>
