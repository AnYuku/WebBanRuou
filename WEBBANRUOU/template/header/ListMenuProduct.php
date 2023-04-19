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

</script>

