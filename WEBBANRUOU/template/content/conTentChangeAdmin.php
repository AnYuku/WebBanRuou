<main>
    <div id="container">
        <div id="contentleft">

        </div>
        <div id="contentcenter">
            <?php
            if (isset($_GET["data"])) {
                switch ($_GET["data"]) {
                    case 'account_management':
                        # code...
                        include('./template/content/content-admin-user-manager.php');
                        break;
                    case 'payment_management':
                        # code...
                        // include('./template/content/conTentChangeLogin.php');
                        echo 'Quản lý thanh toán';
                        break;
                    case 'product_management':
                        # code..   
                        include('./template/content/manageProduct.php');
                        echo 'Quản lý sản phẩm';
                        break;
                    case 'tax_administration':
                        # code..   
                        include('./template/content/content-admin-tax-manager.php');
                        break;
                    case 'statistics_of_products _sold':
                        # code..   
                        include('./template/content/content_statistics_of_products _sold.php');
                        break;
                    case 'list_of_rows_menus':
                        # code..   
                        include('./template/content/content_list_of_rows_menus.php');
                        break;
                    case 'info':
                        # code...
                        // include('./template/content/content-admin-tax-manager.php');
                        echo 'Thông tin cá nhân';
                        break;
                    case 'order':
                        # code...
                        // include('./template/content/conTentChangeLogin.php');
                        echo 'Lịch sử mua hàng';
                        break;
                    case 'giohang':
                        # code..   
                        // include('./template/content/content-admin-tax-manager.php');
                        echo 'Giỏ hàng';
                        break;
                    case 'confirm_order':
                        include('./template/content/content-admin_confirm_order.php');
                        break;
                    case 'logout':
                        # code..   
                        // include('./template/content/contentPage.php');
                        include('./template/content/logout.php');
                        break;
                }
            } else {
                include('./template/content/content-admin-user-manager.php');
            }
            ?>
        </div>
        <div id="contentright">
        </div>
    </div>
</main>