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
            }
        }
        else{
            include('./template/content/contentPage.php');
        }
        
    ?>
</main>
<!-- <script>
    $('#loginphp').click(function(e){
        e.preventDefault();
        $('#main').load("./template/content/conTentChangeLogin.php");
    })
    $('#changePageProduct').click(function(e){
        e.preventDefault();
        $('#main').load("./template/content/conTentChangeClient.php");
    })
    $('.logo').click(function(e){
        e.preventDefault();
        $('#main').load("./template/content/conTent.php");
    })
</script> -->


