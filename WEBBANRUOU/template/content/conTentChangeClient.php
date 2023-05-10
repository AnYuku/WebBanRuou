<div id="container">
    <div id="contentleft">
    </div>
    <div id="contentcenter">
        <?php
            // if (!isset($_SESSION['username'])) {
            //     // Nếu chưa đăng nhập, chuyển hướng đến trang đăng nhập
            //     include('./template/content/conTentChangeLogin.php');
            //     exit;
            // }
            
            // Nếu đã đăng nhập, điều hướng đến trang thông tin cá nhân
            

            if(isset($_GET["data"])){
                switch ($_GET["data"]) {
                    case 'product_by_cat':
                        # code...
                        $CatId = $_GET["CatId"];
                        $url = './template/content/content_client_all_product.php';
                        include($url);
                        break;
                    case 'product_details':
                        include('./template/content/productDetail.php');
                        break;
                    case 'info':
                        # code...
                            include('./template/content/personalInfo.php');
                        // echo 'Thông tin cá nhân';
                        break;
                    case 'order':
                        # code...
                        include('./template/content/ordersConfirmed.php');
                        // echo 'Lịch sử mua hàng';
                        break;
                    case 'giohang':
                            # code..   
                            // include('./template/content/content-admin-tax-manager.php');
                        // echo 'Giỏ hàng';
                        include('./template/content/cart.php');
                    break;      
                    case 'donhangdangxuly':
                        # code..   
                        // include('./template/content/content-admin-tax-manager.php');
                    // echo 'Giỏ hàng';
                    include('./template/content/ordersProcessing.php');
                    
                    break;     
                    case 'logout':
                            # code..   
                        // include('./template/content/contentPage.php');
                        include('../../template/content/login.php');
                    break;          
                }
            }
            else{
                include('./template/content/content_client_all_product.php');

            }
        ?>
         
    </div>
    <div id="contentright">
    </div>
</div>

<style>
    #main #container{
    display: flex;
} 
#main #container #contentleft{
    float: left;
    height: 100vh;;
    width: 0px;

}
#main #container #contentcenter{
    float:left;
    min-height: 100vh;
    /* width: 70%;   */
}
#main #container #contentright {
    float:right;
    height: 100vh;
    width: 0px;
}
</style>