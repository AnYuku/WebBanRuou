<header>
    <div class="header_index">
        <div id="menu_product"> 
            <div id="menu_product_btn">
                <img class="menuheader" id="menuheader" src="./image/menu_rounded_512px.png" alt="" srcset="">
            </div>
        </div>
        <div id="index_btn_view">
        <?php
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }

            $user = isset($_GET['user']) ? $_GET['user'] : '';

            if ($user === 'admin') {
                ?>
                <div style="display: none;" id="index_btn">
                    <a class="logo">Trang chủ</a> 
                </div>
                <?php
            } else {
                ?>
                <div id="index_btn">
                    <a class="logo">Trang chủ</a> 
                </div>
                <?php
            }
        ?>
        </div>
        <div id="link_product">
        <?php
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }

            $user = isset($_GET['user']) ? $_GET['user'] : '';

            if ($user === 'admin') {
                ?>
                <div style="display: none;" id="product_btn">
                    <img class="iconproduct" src="./image/champagne_bottle_30px.png" alt="" srcset="">
                    <div id="product_btn_text">
                        <a id="changePageProduct">Sản phẩm</a>
                    </div>
                </div>
                <?php
            } else {
                ?>
                <div id="product_btn">
                    <img class="iconproduct" src="./image/champagne_bottle_30px.png" alt="" srcset="">
                    <div id="product_btn_text">
                        <a id="changePageProduct">Sản phẩm</a>
                    </div>
                </div>
                <?php
            }
        ?>
                
        </div>
        <div class="link_user_view">
            <div id="link_user" class="link_user_hover">
                <div id="link_user-img_user">
                    <img class="iconuser" id="iconuser" src="./image/Male User_64px.png" alt="" srcset="">
                </div>
                <div id="link_user-user_name">
                    <?php
                        if (session_status() == PHP_SESSION_NONE) {
                            session_start();
                        }
                    ?>
                    <?php if (isset($_SESSION['username'])): ?>
                        <a><?php echo $_SESSION['username']; ?></a>
                    <?php else: ?>
                        <a id="loginphp" href="index.php?chon=t&id=dangnhap">Đăng nhập</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</header>

<style>
    
</style>

<script>
    var index_btn = document.getElementById("index_btn");

    index_btn.addEventListener("click", function() {
        window.location.href = "index.php?chon=t&id=trangchu";
    });

    var product_btn = document.getElementById("product_btn");

    product_btn.addEventListener("click", function() {
        window.location.href = "index.php?chon=t&id=sanpham";
    });


    const header = document.querySelector('header'); // Lấy thẻ header

    window.addEventListener('scroll', function() { // Thêm sự kiện cuộn trang
    if (window.pageYOffset > 0) { // Kiểm tra vị trí cuộn của trang
        header.classList.add('sticky'); // Thêm lớp CSS "sticky" cho thẻ header nếu vị trí cuộn > 0
    } else {
        header.classList.remove('sticky'); // Xóa lớp CSS "sticky" cho thẻ header nếu vị trí cuộn <= 0
    }
    });
</script>



