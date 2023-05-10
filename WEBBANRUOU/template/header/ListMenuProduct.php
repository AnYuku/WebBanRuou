<div class="menuCategory" id="menuCategory">
    <ul id="list_Menu_Product_Table">

    </ul>
</div>
<script>
    $(document).ready(function() {
        $.ajax({
            url: "./template/dbconnection_GET.php",
            type: "GET",
            data: {
                table_name: "category"
            },
            dataType: "json",
            success: function(result) {
                $.each(result, function(i, item) {
                    $("#list_Menu_Product_Table").append("<li class='menuCategoryItem'><div class='autoLineBreak menuCategoryItem-style_text'><a href='index.php?chon=t&id=sanpham&data=product_by_cat&CatId=" + item.CatId + "'>" + item.CatName + "</a></div></li>")
                });

            }
        });
    });


    // hover list menu product
    var mennuHoverProduct = document.querySelector('.menuheader');
    var menuProduct = document.querySelector('.menuCategory');

    var isMenuVisible = false;

    if (typeof mennuHoverProduct !== 'undefined' && mennuHoverProduct !== null) {
        // mennuHoverProduct đã được định nghĩa và có giá trị
        mennuHoverProduct.addEventListener('mouseenter', function() {
            menuProduct.style.display = 'block';
            isMenuVisible = true;
        });

        mennuHoverProduct.addEventListener('mouseleave', function() {
            isMenuVisible = false;
            setTimeout(function() {
                if (!isMenuVisible) {
                    menuProduct.style.display = 'none';
                }
            }, 200);
        });

        menuProduct.addEventListener('mouseenter', function() {
            isMenuVisible = true;
        });

        menuProduct.addEventListener('mouseleave', function() {
            isMenuVisible = false;
            setTimeout(function() {
                if (!isMenuVisible) {
                    menuProduct.style.display = 'none';
                }
            }, 200);
        });

    }
</script>

<style>
    .listMenuProduct {
        display: none;
        position: absolute;
        width: 220px;
        background-color: #600e00;
        /* border-top: 2px solid black; */
    }

    .listMenuProduct ul li {
        display: flex;
        position: relative;
        margin-left: 40px;
        list-style: none;
        width: 200px;
        font-size: 1.5rem;
        padding-top: 10px;
    }

    .listMenuProduct ul li:last-child {
        margin-bottom: 10px;
    }

    .listMenuProduct ul li a {
        text-decoration: none;
        color: white;
    }

    .menuCategory {
        z-index: 1;
        display: none;
        position: absolute;
        width: 220px;
        background-color: #600e00;
        padding: 10px;
        border: 1px solid #000;
        border-radius: 10px;
        margin-left: 10px;
    }

    .autoLineBreak {
        display: flex;
        flex-wrap: wrap;
    }

    .menuCategoryItem {
        width: 100%;
        list-style: none;
        padding: 5px;
        margin-top: 5px;
        margin-bottom: 5px;
    }

    .menuCategoryItem-style_text a {
        text-decoration: none;
        font-size: 20px;
        color: #fff;
    }
</style>