<div class="listMenuUser">
    <ul>
        <?php
        if (isset($_SESSION['logged_in']) && $_SESSION['logged_in']) :
        ?>
            <?php
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }

            $user = isset($_SESSION['userRole']) ? $_SESSION['userRole'] : '';

            if ($user !== 'admin') {
            ?>
                <div>
                    <li class="listMenuUser_item" id="MenuUser-ThongTinCaNhan">
                        <img class="listMenuUser_item-style_img" src="./image/info_50px.png" alt="" srcset="">
                        <div class="automatic_line_break listMenuUser_item-style_text">
                            <a class="info">Thông tin cá nhân</a>
                        </div>
                    </li>
                    <li class="listMenuUser_item" id="MenuUser-LichSuMuaHang">
                        <img class="listMenuUser_item-style_img" src="./image/bill_512px.png" alt="" srcset="">
                        <div class="automatic_line_break listMenuUser_item-style_text">
                            <a class="order">Lịch sử mua hàng</a>
                        </div>
                    </li>
                    <li class="listMenuUser_item" id="MenuUser-GioHang">
                        <img class="listMenuUser_item-style_img" src="./image/shopping_cart_30px.png" alt="" srcset="">
                        <div class="automatic_line_break listMenuUser_item-style_text">
                            <a class="shopping">Giỏ hàng</a>
                        </div>
                    </li>
                    <li class="listMenuUser_item" id="MenuUser-DonHangDangXuLi">
                        <img class="listMenuUser_item-style_img" src="./image/order_history_30px.png" alt="" srcset="">
                        <div class="automatic_line_break listMenuUser_item-style_text">
                            <a class="shopping">Đơn hàng đang xử lí</a>
                        </div>
                    </li>
                    <li class="listMenuUser_item" id="MenuUser-DangXuat-Client">
                        <img class="listMenuUser_item-style_img" src="./image/Logout Rounded_32px.png" alt="" srcset="">
                        <div class="automatic_line_break listMenuUser_item-style_text">
                            <a class="logout">Đăng xuất</a>
                        </div>
                    </li>
                </div>
            <?php
            } else {
            ?>
                <div>
                    <li class="listMenuUser_item" id="MenuUser-DangXuat-Admin">
                        <img class="listMenuUser_item-style_img" src="./image/Logout Rounded_32px.png" alt="" srcset="">
                        <div class="automatic_line_break listMenuUser_item-style_text">
                            <a class="logout">Đăng xuất</a>
                        </div>
                    </li>
                </div>
            <?php
            }
            ?>

        <?php
        endif;
        ?>

    </ul>
</div>
<style>
    .listMenuUser {
        z-index: 1;
        width: 250px;
        background-color: black;
        border: 1px solid black;
        border-radius: 10px;
        padding: 5px 20px;
        margin-right: 10px;
        background-color: #861503;
    }

    .listMenuUser_item {
        width: 100%;
        display: flex;
        flex-direction: row;
        align-items: center;
        justify-content: flex-start;
        margin-top: 15px;
        margin-bottom: 15px;
    }

    .listMenuUser_item :hover {
        cursor: pointer;
    }

    .listMenuUser_item-style_text {
        padding-left: 10px;
    }

    .listMenuUser_item-style_text a {
        color: white;
        text-decoration: none;
        font-size: 20px;
    }

    .listMenuUser_item-style_img {
        width: 32px;
        height: 32px;
        filter: brightness(0) saturate(100%) invert(100%) sepia(0%) saturate(7483%) hue-rotate(0deg) brightness(100%) contrast(100%);
    }


    .automatic_line_break {
        display: flex;
        flex-wrap: wrap;
    }
</style>

<script>
    // Hover list menu user
    var mennuHoverUser = document.querySelector('.link_user_hover');
    var menuUser = document.querySelector('.listMenuUser');

    var isMenuVisible = false;

    mennuHoverUser.addEventListener('mouseenter', function() {
        let user1 = "";

        try {
            user1 = "<?php if (isset($_SESSION['userId'])) {
                            echo $_SESSION['userId'];
                        } else {
                            echo "";
                        } ?>";
        } catch (e) {
            console.log('Hiện không có user role');
        }
        if (user1 !== "") {
            menuUser.style.display = 'block';
            isMenuVisible = true;
        }
    });

    mennuHoverUser.addEventListener('mouseleave', function() {
        isMenuVisible = false;
        setTimeout(function() {
            if (!isMenuVisible) {
                menuUser.style.display = 'none';
            }
        }, 200);
    });

    menuUser.addEventListener('mouseenter', function() {
        let userID = "";
        try {
            userID = "<?php if (isset($_SESSION['userId'])) {
                            echo $_SESSION['userId'];
                        } else {
                            echo "";
                        } ?>";
        } catch (e) {
            console.log('Hiện không có user đăng nhập');
        }

        if (userID !== "") {
            isMenuVisible = true;
        }
    });

    menuUser.addEventListener('mouseleave', function() {
        isMenuVisible = false;
        setTimeout(function() {
            if (!isMenuVisible) {
                menuUser.style.display = 'none';
            }
        }, 200);
    });

    // ~
    let userRole = "";

    try {
        user1 = "<?php if (isset($_SESSION['userRole'])) {
                        echo $_SESSION['userRole'];
                    } else {
                        echo "";
                    } ?>";
    } catch (e) {
        console.log('Hiện không có user role');
    }
    if (userRole === 'admin') {
        const MenuUser_DangXuat_Admin = document.getElementById('MenuUser-DangXuat-Admin');
        MenuUser_DangXuat_Admin.addEventListener("click", function() {
            window.location.href = "./template/content/logout.php"
        });
    } else {
        const MenuUser_ThongTinCaNhan = document.getElementById('MenuUser-ThongTinCaNhan');
        MenuUser_ThongTinCaNhan.addEventListener("click", function() {
            console.log('click: ');
            window.location.href = "index.php?chon=t&id=sanpham&user=client&data=info";
        });
        const MenuUser_LichSuMuaHang = document.getElementById('MenuUser-LichSuMuaHang');
        MenuUser_LichSuMuaHang.addEventListener("click", function() {
            window.location.href = "index.php?chon=t&id=sanpham&user=client&data=order"
        });
        const MenuUser_GioHang = document.getElementById('MenuUser-GioHang');
        MenuUser_GioHang.addEventListener("click", function() {
            window.location.href = "index.php?chon=t&id=sanpham&user=client&data=giohang"
        });
        const MenuUser_DonHangDangXuLi = document.getElementById('MenuUser-DonHangDangXuLi');
        MenuUser_DonHangDangXuLi.addEventListener("click", function() {
            window.location.href = "index.php?chon=t&id=sanpham&user=client&data=donhangdangxuly"
        });
        const MenuUser_DangXuat_Client = document.getElementById('MenuUser-DangXuat-Client');
        MenuUser_DangXuat_Client.addEventListener("click", function() {
            window.location.href = "./template/content/logout.php"
        });
    }
</script>