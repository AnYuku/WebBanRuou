<div class="listMenuUser">
    <ul>
        <?php
        if (isset($_SESSION['logged_in']) && $_SESSION['logged_in']) :
        ?>
<<<<<<< Updated upstream
        <li class="listMenuUser_item">
            <img src="./image/info_50px.png" alt="" srcset="">
            <a class="info" href="index.php?chon=t&id=sanpham&user=<?php echo $user ?>&data=info">Thông tin cá nhân</a>
        </li>
        <?php
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }

            $user = isset($_GET['user']) ? $_GET['user'] : '';

            if ($user === 'admin') {
                ?>
                <div style="display: none;" >
                    <li class="listMenuUser_item">
                        <img src="./image/order_history_30px.png" alt="" srcset="">
                        <a class="order" href="index.php?chon=t&id=sanpham&user=<?php echo $user ?>&data=order">Lịch sử mua hàng</a>
                    </li>
                    <li class="listMenuUser_item">
                        <img src="./image/shopping_cart_30px.png" alt="" srcset="">
                        <a class="shopping" href="index.php?chon=t&id=sanpham&user=<?php echo $user ?>&data=giohang">Giỏ hàng</a>
                    </li>
                    <li class="listMenuUser_item">
                        <img src="./image/bill_512px.png" alt="" srcset="">
                        <a class="shopping" href="">Đơn hàng đang xử lí</a>
                    </li>
                    <li class="listMenuUser_item" style="height: 60px;">
                        <img src="./image/paid_bill_512px.png" alt="" srcset="">
                        <a class="shopping" href="">Đơn hàng đã được xác nhận</a>
                    </li>
                </div>
                <?php
            } else {
                ?>
                <div >
                    <li class="listMenuUser_item">
                        <img src="./image/order_history_30px.png" alt="" srcset="">
                        <a class="order" href="index.php?chon=t&id=sanpham&user=<?php echo $user ?>&data=order">Lịch sử mua hàng</a>
                    </li>
                    <li class="listMenuUser_item">
                        <img src="./image/shopping_cart_30px.png" alt="" srcset="">
                        <a class="shopping" href="index.php?chon=t&id=sanpham&user=<?php echo $user ?>&data=giohang">Giỏ hàng</a>
                    </li>
                    <li class="listMenuUser_item">
                        <img src="./image/bill_512px.png" alt="" srcset="">
                        <a class="shopping" href="">Đơn hàng đang xử lí</a>
                    </li>
                    <li class="listMenuUser_item" style="height: 60px;">
                        <img src="./image/paid_bill_512px.png" alt="" srcset="">
                        <a class="shopping" href="">Đơn hàng đã được xác nhận</a>
                    </li>
                </div>
                <?php
            }
        ?>
        <li class="listMenuUser_item">
            <img src="./image/bill_512px.png" alt="" srcset="">
            <a class="shopping" href="">Đơn hàng đang xử lí</a>
        </li>
        <li class="listMenuUser_item" style="height: 60px;">
            <img src="./image/paid_bill_512px.png" alt="" srcset="">
            <a class="shopping" href="">Đơn hàng đã được xác nhận</a>
        </li>
        <li class="listMenuUser_item">
            <img src="./image/Logout Rounded_32px.png" alt="" srcset="">
            <a class="logout" href="./template/content/logout.php">Đăng xuất</a>
        </li>
=======
            <li class="listMenuUser_item">
                <img src="./image/info_50px.png" alt="" srcset="">
                <a class="info" href="index.php?chon=t&id=sanpham&user=<?php echo $user ?>&data=info">Thông tin cá nhân</a>
            </li>
            <?php
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }

            $user = isset($_GET['user']) ? $_GET['user'] : '';

            if ($user === 'admin') {
            ?>
                <div style="display: none;">
                    <li class="listMenuUser_item">
                        <img src="./image/order_history_30px.png" alt="" srcset="">
                        <a class="order" href="index.php?chon=t&id=sanpham&user=<?php echo $user ?>&data=order">Lịch sử mua hàng</a>
                    </li>
                    <li class="listMenuUser_item">
                        <img src="./image/shopping_cart_30px.png" alt="" srcset="">
                        <a class="shopping" href="index.php?chon=t&id=sanpham&user=<?php echo $user ?>&data=giohang">Giỏ hàng</a>
                    </li>
                    <li class="listMenuUser_item">
                        <img src="./image/bill_512px.png" alt="" srcset="">
                        <a class="shopping" href="">Đơn hàng đang xử lí</a>
                    </li>
                    <li class="listMenuUser_item" style="height: 60px;">
                        <img src="./image/paid_bill_512px.png" alt="" srcset="">
                        <a class="shopping" href="">Đơn hàng đã được xác nhận</a>
                    </li>
                </div>
            <?php
            } else {
            ?>
                <div>
                    <li class="listMenuUser_item">
                        <img src="./image/order_history_30px.png" alt="" srcset="">
                        <a class="order" href="index.php?chon=t&id=sanpham&user=<?php echo $user ?>&data=order">Lịch sử mua hàng</a>
                    </li>
                    <li class="listMenuUser_item">
                        <img src="./image/shopping_cart_30px.png" alt="" srcset="">
                        <a class="shopping" href="index.php?chon=t&id=sanpham&user=<?php echo $user ?>&data=giohang">Giỏ hàng</a>
                    </li>
                    <li class="listMenuUser_item">
                        <img src="./image/bill_512px.png" alt="" srcset="">
                        <a class="shopping" href="">Đơn hàng đang xử lí</a>
                    </li>
                    <li class="listMenuUser_item" style="height: 60px;">
                        <img src="./image/paid_bill_512px.png" alt="" srcset="">
                        <a class="shopping" href="">Đơn hàng đã được xác nhận</a>
                    </li>
                </div>
            <?php
            }
            ?>
            <li class="listMenuUser_item">
                <img src="./image/Logout Rounded_32px.png" alt="" srcset="">
                <a class="logout" href="./template/content/logout.php">Đăng xuất</a>
            </li>
>>>>>>> Stashed changes
        <?php
        endif;
        ?>

    </ul>
</div>
<script>
    // Hover list menu user
var mennuHoverUser = document.querySelector('.link_user_hover');
var menuUser = document.querySelector('.listMenuUser');

var isMenuVisible = false;

mennuHoverUser.addEventListener('mouseenter', function() {
    menuUser.style.display = 'block';
    isMenuVisible = true;
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
    isMenuVisible = true;
  });
  
  menuUser.addEventListener('mouseleave', function() {
    isMenuVisible = false;
    setTimeout(function() {
      if (!isMenuVisible) {
        menuUser.style.display = 'none';
      }
    }, 200);
  });

</script>
