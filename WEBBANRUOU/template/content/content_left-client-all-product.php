<div id="content_left_client_all_product">
    <div class="content_left_client_all_product_title_style content_left_client_all_product_title_box">
        <Text>Bộ lọc tìm kiếm:</Text>
    </div>
    <div class="content_left_client_all_product_text_style content_left_client_all_product_box_style ">
        <div class="content_left_client_all_product_checkbox_view">
            <input type="checkbox" value="no">
        </div>
        <div class="content_left_client_all_product_filter_view">
            <Text>Giá:</Text>
            <input
                id="content_left_client_all_product_input_min"
                type="number"
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
            <input type="checkbox" value="no">
        </div>
        <div class="content_left_client_all_product_filter_view">
            <Text>Giá tăng dần</Text>
        </div>
    </div>
    <div class="content_left_client_all_product_text_style content_left_client_all_product_box_style">
        <div class="content_left_client_all_product_checkbox_view">
            <input type="checkbox" value="no">
        </div>
        <div class="content_left_client_all_product_filter_view">
            <Text>Giá giảm dần</Text>
        </div>
    </div>
    <div class="content_left_client_all_product_text_style content_left_client_all_product_box_style">
        <div class="content_left_client_all_product_checkbox_view">
            <input type="checkbox" value="no">
        </div>
        <div class="content_left_client_all_product_filter_view">
            <Text>Mới nhất</Text>
        </div>
    </div>
    <div class="content_left_client_all_product_text_style content_left_client_all_product_box_style">
        <div class="content_left_client_all_product_checkbox_view">
            <input type="checkbox" value="no">
        </div>
        <div class="content_left_client_all_product_filter_view">
            <Text>Cũ nhất</Text>
        </div>
    </div>
    <div class="content_left_client_all_product_text_style content_left_client_all_product_box_style">
        <div id="client_product_search_btn" class="client_product_left_box_btn_style">
            <button>Tìm kiếm</button>
        </div>
    </div>
    <div class="content_left_client_all_product_text_style content_left_client_all_product_box_style">
        <div id="client_product_clear_btn" class="client_product_left_box_btn_style">
            <button>Làm mới</button>
        </div>
    </div>
</div>

<script>
    // Get references to the number input fields and search button
    const number1 = document.getElementById("content_left_client_all_product_input_min");
    const number2 = document.getElementById("content_left_client_all_product_input_max");
    const searchBtn = document.getElementById("client_product_search_btn");
    const clearBtn = document.getElementById("client_product_clear_btn");

    // Add event listener to the search button
    searchBtn.addEventListener("click", function() {
        if (Number(number1.value) > Number(number2.value)) {
            alert("Input min is greater than input max");
        } else {  
            
            const min = Number(number1.value);
            const max = Number(number2.value);
            $.ajax({
                url: "./template/content/content_mid-client-all-product.php",
                type: "POST",
                data: {
                    minPriceSearching: min,
                    maxPriceSearching: max
                },
                dataType: "json",
                success: function(result) {
                    console.log('send success');
                    console.log('result: ', result);                    
                }
            });
        }
    });

    // Add event listener to the clear button
    clearBtn.addEventListener("click", function() {
        document.getElementById("content_left_client_all_product_input_min").value = "";
        document.getElementById("content_left_client_all_product_input_max").value = "";
    });
</script>