<div class="listMenuUser">
    <ul>
        <?php
            if (isset($_SESSION['logged_in']) && $_SESSION['logged_in']):
        ?>
        <li>
            <img src="./image/info_50px.png" alt="" srcset="">
            <a class="info" href="index.php?chon=t&id=sanpham&user=<?php echo $user ?>&data=info">Thông tin cá nhân</a>
        </li>
        <li>
            <img src="./image/order_history_30px.png" alt="" srcset="">
            <a class="order" href="index.php?chon=t&id=sanpham&user=<?php echo $user ?>&data=order">Lịch sử mua hàng</a>
        </li>
        <li>
            <img src="./image/shopping_cart_30px.png" alt="" srcset="">
            <a class="shopping" href="index.php?chon=t&id=sanpham&user=<?php echo $user ?>&data=giohang">Giỏ hàng</a>
        </li>
        <li>
            <img src="./image/Logout Rounded_32px.png" alt="" srcset="">
            <a class="logout" href="./template/content/logout.php">Đăng xuất</a>
        </li>
        <?php
        endif; 
        ?>
        
    </ul>
</div>
