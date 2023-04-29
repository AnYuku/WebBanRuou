
<div
    style="
        display: flex;
        flex-direction: row;
    "
>
    <div
        style="
            flex: 1;
        "
    >
        <div id="content_left_client_all_product">
            <form name="filter" >
            <div class="content_left_client_all_product_title_style content_left_client_all_product_title_box">
                <Text>Bộ lọc tìm kiếm:</Text>
            </div>
            <div class="content_left_client_all_product_text_style content_left_client_all_product_box_style ">
                <div class="content_left_client_all_product_checkbox_view">
                    <input id="filter_by_price" type="checkbox" value="no">
                </div>
                <div class="content_left_client_all_product_filter_view">
                    <Text>Giá:</Text>
                    <input
                        id="content_left_client_all_product_input_min"
                        type="number"
                        name="min"
                        style="
                            width: 35%;
                            font-size: 13px;
                            padding: 2px;
                        "    
                    />
                    <Text>đ ~</Text>
                    <input
                        id="content_left_client_all_product_input_max"
                        type="number"
                        name="max"
                        style="
                            width: 35%;
                            font-size: 13px;
                            padding: 2px;
                        "    
                    />
                    <Text>đ</Text>
                </div>
            </div>
            <div class="content_left_client_all_product_text_style content_left_client_all_product_box_style">
                <div class="content_left_client_all_product_checkbox_view">
                    <input id="filter_by_price_asd" type="checkbox" value="no">
                </div>
                <div class="content_left_client_all_product_filter_view">
                    <Text>Giá tăng dần</Text>
                </div>
            </div>
            <div class="content_left_client_all_product_text_style content_left_client_all_product_box_style">
                <div class="content_left_client_all_product_checkbox_view">
                    <input id="filter_by_price_des" type="checkbox" value="no">
                </div>
                <div class="content_left_client_all_product_filter_view">
                    <Text>Giá giảm dần</Text>
                </div>
            </div>
            <div class="content_left_client_all_product_text_style content_left_client_all_product_box_style">
                <div class="content_left_client_all_product_checkbox_view">
                    <input id="filter_by_new"  type="checkbox" value="no">
                </div>
                <div class="content_left_client_all_product_filter_view">
                    <Text>Mới nhất</Text>
                </div>
            </div>
            <div class="content_left_client_all_product_text_style content_left_client_all_product_box_style">
                <div class="content_left_client_all_product_checkbox_view">
                    <input id="filter_by_old" type="checkbox" value="no">
                </div>
                <div class="content_left_client_all_product_filter_view">
                    <Text>Cũ nhất</Text>
                </div>
            </div>
            <div class="content_left_client_all_product_text_style content_left_client_all_product_box_style">
                <div id="client_product_search_btn" class="client_product_left_box_btn_style">
                    <button>Lọc</button>
                </div>
            </div>

            </form>
        </div>
    </div>
    <div
        style="
            flex: 3;
        "
    >
        <div id="content_mid_client_all_product">
            <!-- Thanh tìm kiếm -->
            <div id="content_mid_client_all_product_search_bar_view">
                <form name="search" >
                <input
                    placeholder="Search..."
                    type="search"
                    name="search"
                    id="client_product_search_bar"

                />
                </form>
            </div>
            <!-- Bảng Products -->
            <div id="client_products_view">
                <div id="client_products_table">

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
    </div>
</div>

<script>

    //======================================= NEW WORLD ===================================================
    $(document).ready(function() {
        // Lấy giá trị của tham số "search" từ URL

// Khi người dùng submit form tìm kiếm
        // Lấy giá trị của tham số "search" từ URL
        const urlParams = new URLSearchParams(window.location.search);
        let searchValue = urlParams.get('search');
        let maxValue = urlParams.get('max');
        let minValue = urlParams.get('min');
        maxValue = maxValue ? maxValue.trim() : '';
        minValue = minValue ? minValue.trim() : '';
        searchValue = searchValue ? searchValue.trim() : '';



        // Khi người dùng submit form tìm kiếm
        document.querySelector('form[name="search"]').addEventListener('submit', function(event) {
            event.preventDefault();
            var searchValue = document.querySelector('#client_product_search_bar').value;
            // Thêm tham số "search" vào URL
            var url1 = window.location.href.split('?')[0]; // Lấy phần trước dấu ? trong URL
            url1 += '?chon=t&id=sanpham&search=' + searchValue;
            window.location.href = url1;
        });

        document.querySelector('form[name="filter"]').addEventListener('submit', function(event) {

            event.preventDefault();
            // Lấy giá trị của checkbox filter_by_price
            const filterByPriceCheckbox = document.querySelector('#filter_by_price');
            const isFilterByPrice = filterByPriceCheckbox.checked;

            // Lấy giá trị của input min và max
            const minPrice = document.querySelector('#content_left_client_all_product_input_min').value;
            const maxPrice = document.querySelector('#content_left_client_all_product_input_max').value;

            var url1 = window.location.href.split('?')[0]; // Lấy phần trước dấu ? trong URL
            url1 += '?chon=t&id=sanpham';

            // Nếu checkbox filter_by_price được chọn thì thêm tham số min và max vào URL
            if (isFilterByPrice &&(minPrice !== '' || maxPrice !== '')) {
                // url1 += '&min=' + encodeURIComponent(minPrice) + '&max=' + encodeURIComponent(maxPrice);
                if (minPrice !== '') {
                    url1 += '&min=' + encodeURIComponent(minPrice) + '&';
                }
                if (maxPrice !== '') {
                    url1 += '&max=' + encodeURIComponent(maxPrice) ;
                }
            }
            window.location.href = url1;
        });
        // Chọn API phù hợp dựa trên giá trị của tham số "search" và trạng thái của checkbox filter_by_price
        let apiUrl = 'https://vodkashopcrisapp.azurewebsites.net/api/Product/GetAllProducts';
        if (searchValue !== null && searchValue !== '') {
            apiUrl = 'https://vodkashopcrisapp.azurewebsites.net/api/Product/FilterProductByName/' + encodeURIComponent(searchValue);
        }else if (minValue !== '' || maxValue !== ''){
            apiUrl = 'https://vodkashopcrisapp.azurewebsites.net/api/Product/FilterProductByPrice?';
            if (minValue !== '') {
                apiUrl += 'minPrice=' + encodeURIComponent(minValue) + '&';
            }
            if (maxValue !== '') {
                apiUrl += 'maxPrice=' + encodeURIComponent(maxValue) ;
            }
        }

        $.ajax({
            url: apiUrl,
            dataType: "json",
            success: function(result) {
                document.querySelector("#client_products_table").innerHTML = "";
                if(result.length > 0) {
                    $.each(result, function(i, item) {
                        const price = parseInt(item.price, 10);
                        const formattedNumber = price.toLocaleString('vi-VN');
                        const productItem = `

                            <div class="client_product_item" id="${item.productNum}">
                            <a href="./template/content/productDetail.php?id=${item.productNum}">
                            <input type="hidden" name="ma" value="${item.productNum}">
                                <img src=${item.imageSource} alt="image product"/>
                                <div class="client_product_item_text_view">
                                    <Text>${item.productName}</Text>
                                    <Text>${formattedNumber}đ</Text>
                                </div>
                            </a>
                            </div>

                        `;
                        $('#client_products_table').append(productItem);
                    });

                }
                else {
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
    });
</script>