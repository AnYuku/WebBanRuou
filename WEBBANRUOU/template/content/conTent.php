<main id="main">          
    <?php 
        if(isset($_GET["id"])){
            switch ($_GET["id"]) {
                case 'sanpham':
                    # code...
                    include('./template/content/conTentChangeClient.php');
                    break;
                case 'dangnhap':
                    # code...
                    include('./template/content/conTentChangeLogin.php');
                    break;
                case 'trangchu':
                        # code..   
                    include('./template/content/contentPage.php');
                break;                 
                case 'dangky':
                        # code..   
                    include('./template/content/conTentChangeSign.php');
                break;                 
            }
        }
        else{
            include('./template/content/contentPage.php');
        }
        
    ?>
</main>


