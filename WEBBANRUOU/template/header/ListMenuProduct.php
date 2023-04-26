<div class="listMenuProduct" id="listMenuProduct">
    <ul id="list_Menu_Product_Table">

    </ul>
</div>
<script>
    $(document).ready(function() {
            $.ajax({
                url: "./template/dbconnection_GET.php",
                type: "GET",
                data: { table_name: "category" },
                dataType: "json",
                success: function(result) {
                    console.log(result);
                    $.each(result, function(i, item) {
                        $("#list_Menu_Product_Table").append("<li><a href='index.php?chon=t&id=sanpham&data=product_by_cat&CatId="+item.CatId+"'>"+item.CatName+"</a></li>")
                    });

                }
            });
        });


// hover list menu product
var mennuHoverProduct = document.querySelector('.menuheader');
var menuProduct = document.querySelector('.listMenuProduct');

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

