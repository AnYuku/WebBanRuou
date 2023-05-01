<?php
    // if (isset($_POST['minPriceSearching']) && isset($_POST['maxPriceSearching'])) {        
    //     $minPriceSearching = $_POST['minPriceSearching'];  
    //     $maxPriceSearching = $_POST['maxPriceSearching']; 
    //     echo json_encode(true);       
    // }
    // else{
    //     $minPriceSearching = 0;  
    //     $maxPriceSearching = 0; 
    //     echo json_encode(false);  
    // }
    
?>
<script>
    console.log(<?php echo $maxPriceSearching; ?>);
</script>

<div id="content_mid_client_all_product">
    <!-- Thanh tìm kiếm -->
    <div id="content_mid_client_all_product_search_bar_view">
        <input
            placeholder="Nhập tên sản phẩm..."
            type="text"
            id="client_product_search_bar"
            onkeyup="searchString()"
        />
    </div>
    <!-- Bảng Products -->
    <div id="client_products_view">
        <div id="client_products_table">
            <div class="client_product_empty_product_message_view">
                <Text class="client_product_empty_product_message_text_style">Hiện đang không có sản phẩm nào.</Text>
            </div>
        </div>
    </div>
    <!-- Thanh phân trang -->
    <div id="path_to_another_page_view">
        <button id="prevPageBtn">&laquo;</button>
        <button id="prevBtn">&lt;</button>
        <button id="pageSelected"></button>
        <button id="nextBtn">&gt;</button>
        <button id="nextPageBtn">&raquo;</button>
    </div>
</div>

<script>
    // Khởi tạo các chức năng nút phân trang
    let total_pages_result = 0;
    let total_pages = 0;
    $(document).ready(function() {
        $.ajax({
            url: "./template/dbconnection_GET_TOTAL_PAGE.php",
            type: "GET",
            data: {},
            dataType: "json",
            success: function(result) {
                total_pages = result;
                var pageSelected = 1;

                // Hiển thị số trang
                document.getElementById("pageSelected").innerHTML = 0;

                // Xử lí prevPageBtn click - min pages
                document.getElementById("prevPageBtn").addEventListener("click", function() {
                    var searchKey = document.getElementById("client_product_search_bar").value;
                    pageSelected = 1;
                    document.getElementById("pageSelected").innerHTML = pageSelected;
                    if(searchKey !== "") {
                        loadSearchResult({ page: pageSelected, searchKey: searchKey});
                    } else {
                        loadData({page: pageSelected});
                    }
                });

                // Xử lí prevBtn click - giảm 1 - tối thiểu min pages
                document.getElementById("prevBtn").addEventListener("click", function() {
                    var searchKey = document.getElementById("client_product_search_bar").value;
                    if (pageSelected > 1) {
                        pageSelected--;
                        document.getElementById("pageSelected").innerHTML = pageSelected;
                    if(searchKey !== "") {
                        loadSearchResult({ page: pageSelected, searchKey: searchKey});
                    } else {
                        loadData({page: pageSelected});
                    }
                }
                });

                // Xử lí nextBtn click - tăng 1 - tối đa max pages
                document.getElementById("nextBtn").addEventListener("click", function() {
                if (pageSelected < total_pages) {
                    var searchKey = document.getElementById("client_product_search_bar").value;
                    pageSelected++;
                    document.getElementById("pageSelected").innerHTML = pageSelected;
                    if(searchKey !== "") {
                        loadSearchResult({ page: pageSelected, searchKey: searchKey});
                    } else {
                        loadData({page: pageSelected});
                    }
                }
                });

                // Xử lí nextPageBtn click - max pages
                document.getElementById("nextPageBtn").addEventListener("click", function() {
                    var searchKey = document.getElementById("client_product_search_bar").value;
                    pageSelected = total_pages;
                    document.getElementById("pageSelected").innerHTML = pageSelected;
                    if(searchKey !== "") {
                        loadSearchResult({ page: pageSelected, searchKey: searchKey});
                    } else {
                        loadData({page: pageSelected});
                    }
                });
            }
        });
    });

    function loadData({page}) {
        // product Item component
        const productItem = `
            <div class="client_product_item">
                <img src=item.ImageSource alt="image product"/>
                <div>
                    <Text>item.ProductName</Text>
                    <Text>item.Price</Text>
                </div>
            </div>`;
        $(document).ready(function() {
            $.ajax({
                url: "./template/dbconnection_GET_PRODUCT_BY_PAGE.php",
                type: "GET",
                data: { page: page },
                dataType: "json",
                success: function(result) {
                    document.querySelector("#client_products_table").innerHTML = "";
                    if(result.length > 0) {
                        $.each(result, function(i, item) {
                            const price = parseInt(item.Price, 10);
                            const formattedNumber = price.toLocaleString('vi-VN');
                            const productItem = `
                                <div class="client_product_item" id="${item.ProductNum}">
                                    <img src=${item.ImageSource} alt="image product"/>
                                    <div class="client_product_item_text_view">
                                        <Text>${item.ProductName}</Text>
                                        <Text>${formattedNumber}đ</Text>
                                    </div>
                                </div>
                            `;
                            $('#client_products_table').append(productItem);
                        });
                        if(page == 1) {
                            document.getElementById("pageSelected").innerHTML = 1;
                        }
                    }
                }
            });
        });
    };
    // Auto khi vào trang load page 1 đầu tiên
    loadData({page: 1});

    function loadSearchResult({searchKey, page}) {
        $.ajax({
            url: "./template/dbconnection_GET_SEARCH_Product_BY_ProductName.php",
            type: "GET",
            data: {
                page: page,
                searchKey: searchKey
            },
            dataType: "json",
            success: function(result) {
                document.querySelector("#client_products_table").innerHTML = "";
                if(result.length > 0) {
                    $.each(result, function(i, item) {
                        const price = parseInt(item.Price, 10);
                        const formattedNumber = price.toLocaleString('vi-VN');
                        const productItem = `
                            <div class="client_product_item" id="${item.ProductNum}">
                                <img src=${item.ImageSource} alt="image product"/>
                                <div class="client_product_item_text_view">
                                    <Text>${item.ProductName}</Text>
                                    <Text>${formattedNumber}đ</Text>
                                </div>
                            </div>
                        `;
                        $('#client_products_table').append(productItem);
                    });
                } else {
                    const content = `
                        <div class="client_product_empty_product_message_view">
                            <Text class="client_product_empty_product_message_text_style">Hiện đang không có sản phẩm nào có tên gọi như vậy.</Text>
                        </div>
                    `;
                    $('#client_products_table').append(content);
                    document.getElementById("pageSelected").innerHTML = 0;
                }
            }
        });
    }

    function searchString() {
        var searchKey = document.getElementById("client_product_search_bar").value;
        var pageSelected = 1;
        document.getElementById("pageSelected").innerHTML = pageSelected;
        if(searchKey !== ""){
            // Chuỗi không trống -> hiển thị sản phẩm có tên bao gồm chuỗi đã nhập 
            $.ajax({
                url: "./template/dbconnection_GET_TOTAL_PAGE_RESULT_SEARCH.php",
                type: "GET",
                data: { searchKey: searchKey },
                dataType: "json",
                success: function(totalPages) {
                    total_pages = totalPages;
                    loadSearchResult({ searchKey: searchKey, page: 1 });
                }
            });
        } else {
            // Chuỗi trống -> hiển thị toàn bộ sản phẩm
            $.ajax({
                url: "./template/dbconnection_GET_TOTAL_PAGE.php",
                type: "GET",
                data: {},
                dataType: "json",
                success: function(result) {
                    total_pages = result;
                }
            });
            loadData({page: pageSelected});
        }
    }

    // Define the minPriceSearching variable and set its initial value

</script>