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
                    <button>Tìm kiếm</button>
                </div>
            </div>
            <div class="content_left_client_all_product_text_style content_left_client_all_product_box_style">
                <div id="client_product_clear_btn" class="client_product_left_box_btn_style">
                    <button>Làm mới</button>
                </div>
            </div>
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
    </div>
</div>

<script>
    let filterSeleted = "";
    const searchBtn = document.getElementById("client_product_search_btn");
    const clearBtn = document.getElementById("client_product_clear_btn");

    // Add event listeners to all checkboxes
    document.getElementById('filter_by_price').addEventListener('change', handleCheckboxChange);
    document.getElementById('filter_by_price_asd').addEventListener('change', handleCheckboxChange);
    document.getElementById('filter_by_price_des').addEventListener('change', handleCheckboxChange);
    document.getElementById('filter_by_new').addEventListener('change', handleCheckboxChange);
    document.getElementById('filter_by_old').addEventListener('change', handleCheckboxChange);

    // Function to handle checkbox change event
    function handleCheckboxChange(event) {
        const checkbox = event.target;
        const isChecked = checkbox.checked;
        const inputId = checkbox.id;
        
        if (isChecked) {
            // Tạm thời chỉ cho check 1 input. Nhiều input có thời gian xử lí sau
            const checkboxes = document.querySelectorAll('input[type="checkbox"]');
            checkboxes.forEach((cb) => {
                if (cb !== checkbox) {
                    cb.checked = false;
                }
            });
            //console.log(`Input ${inputId} -> checked`);
        } else {
            //console.log(`Input ${inputId} -> unchecked`);
        }
    }

    function unsetAllFilters() {
        const checkboxes = document.querySelectorAll('input[type="checkbox"]');
            checkboxes.forEach((cb) => {
                cb.checked = false;
            });
    }

    // Add event listener to the check button
    document.getElementById('client_product_search_btn').addEventListener('click', handleSearchButtonClick);
    document.getElementById('client_product_clear_btn').addEventListener('click', handleResetButtonClick);

    function handleResetButtonClick() {
        unsetAllFilters();
        loadData({ page: 1});
        pageSelected = 1;
        total_pages = total_pages_products;
    }

    // Function to handle check button click event
    function handleSearchButtonClick() {
        const checkboxes = document.querySelectorAll('input[type="checkbox"]');
        checkboxes.forEach((checkbox) => {
            if (checkbox.checked) {
                switch(checkbox.id) {
                    case 'filter_by_price':
                        const min = document.getElementById("content_left_client_all_product_input_min").value;
                        const max = document.getElementById("content_left_client_all_product_input_max").value;
                        if (parseInt(max) < parseInt(min)) {
                            alert("Giá trị của max phải lớn hơn giá trị của min");
                        }
                        let signal = true;
                        let contentData = {};
                        if(min == "" && max == "") {
                            alert("Giá trị nhập vào trống")
                            signal = false;
                        }
                        if(signal) {
                            if(min != "" && max == "") {
                                // Chỉ có min
                                loadDataByIsPrice({ page: 1, priceMin: min});
                                contentData = {
                                    priceMin: min
                                }
                            } else  if (min == "" && max != "") {
                                // Chỉ có max
                                loadDataByIsPrice({ page: 1, priceMax: max});
                                contentData = {
                                    priceMax: max
                                }
                            } else {
                                // Chỉ có min và max
                                loadDataByIsPrice({ page: 1, priceMin: min, priceMax: max});
                                contentData = {
                                    priceMin: min,
                                    priceMax: max
                                }
                            }
                            filterSeleted = checkbox.id;
                            $.ajax({
                                url: "./template/db_GET_Total_Page_Product_By_Price.php",
                                type: "GET",
                                data: contentData,
                                dataType: "json",
                                success: function(result) {
                                    total_pages_products_by_price = result;
                                    total_pages = result;
                                },
                                error: function(xhr, status, error) {
                                    alert(status);
                                    console.log(xhr.responseText);
                                }
                            });
                        }
                        break;
                    case 'filter_by_price_asd':
                        loadDataByIsAscending({ page: 1, isAscending: 1});
                        filterSeleted = checkbox.id;
                        pageSelected = 1;
                        break;
                    case 'filter_by_price_des':
                        loadDataByIsAscending({ page: 1, isAscending: 0});
                        filterSeleted = checkbox.id;
                        pageSelected = 1;
                        break;
                    case 'filter_by_new':
                        alert("Tính năng này chưa có");
                        break;
                    case 'filter_by_old':
                        alert('Tính năng này chưa có');
                        break;
                }
            }
        });
    }

    function loadDataByIsPrice({ page, priceMin = null, priceMax = null }) {
        let contentData = {};
        if(priceMin !== null && priceMax == null) {
            contentData = { 
                page: page, 
                priceMin: priceMin 
            };
        } else if(priceMax !== null && priceMin == null) {
            contentData = { 
                page: page, 
                priceMax: priceMax 
            };
        } else {
            contentData = { 
                page: page,
                priceMin: priceMin,
                priceMax: priceMax 
            };
        }
        $.ajax({
            url: "./template/dbconnection_GET_PRODUCT_BY_PAGE.php",
            type: "GET",
            data: contentData,
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
    }

    function loadDataByIsAscending({ page, isAscending }) {
        $.ajax({
            url: "./template/dbconnection_GET_PRODUCT_BY_PAGE.php",
            type: "GET",
            data: { page: page, isAscending: isAscending },
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
    }
    // ===========================================================================================================================================================
    // Khởi tạo các chức năng nút phân trang
    let total_pages_products_by_price = 0;
    let total_pages_result = 0;
    let total_pages_products = 0;
    let total_pages = 0;
    let pageSelected = 0;
    $(document).ready(function() {
        $.ajax({
            url: "./template/dbconnection_GET_TOTAL_PAGE.php",
            type: "GET",
            data: {},
            dataType: "json",
            success: function(result) {
                total_pages = result;
                total_pages_products = result;
                pageSelected = 1;

                // Hiển thị số trang
                document.getElementById("pageSelected").innerHTML = 0;

                // 1 -- Xử lí prevPageBtn click - min pages
                document.getElementById("prevPageBtn").addEventListener("click", function() {
                    $('html, body').animate({ scrollTop: 0 }, 'slow');
                    var searchKey = document.getElementById("client_product_search_bar").value;
                    pageSelected = 1;
                    document.getElementById("pageSelected").innerHTML = pageSelected;
                    if(searchKey !== "") {
                        loadSearchResult({ page: pageSelected, searchKey: searchKey});
                    } else if (filterSeleted !== "") {
                        if(filterSeleted == "filter_by_price_asd") {
                            loadDataByIsAscending({ page: pageSelected, isAscending: 1});
                        }
                        if(filterSeleted == "filter_by_price_des") {
                            loadDataByIsAscending({ page: pageSelected, isAscending: 0});
                        }
                        if(filterSeleted == "filter_by_price") {
                            const min = document.getElementById("content_left_client_all_product_input_min").value;
                            const max = document.getElementById("content_left_client_all_product_input_max").value;
                            if(min != "" && max == "") {
                                loadDataByIsPrice({ page: pageSelected, priceMin: min});
                            } else  if (min == "" && max != "") {
                                loadDataByIsPrice({ page: pageSelected, priceMax: max});
                            } else {
                                loadDataByIsPrice({ page: pageSelected, priceMin: min, priceMax: max});
                            }
                        }
                    } else {
                        loadData({page: pageSelected});
                    }
                });

                // 2 -- Xử lí prevBtn click - giảm 1 - tối thiểu min pages
                document.getElementById("prevBtn").addEventListener("click", function() {
                    $('html, body').animate({ scrollTop: 0 }, 'slow');
                    var searchKey = document.getElementById("client_product_search_bar").value;
                    if (pageSelected > 1) {
                        pageSelected--;
                        document.getElementById("pageSelected").innerHTML = pageSelected;
                    if(searchKey !== "") {
                        loadSearchResult({ page: pageSelected, searchKey: searchKey});
                    } else if (filterSeleted !== "") {
                        if(filterSeleted == "filter_by_price_asd") {
                            loadDataByIsAscending({ page: pageSelected, isAscending: 1});
                        }
                        if(filterSeleted == "filter_by_price_des") {
                            loadDataByIsAscending({ page: pageSelected, isAscending: 0});
                        }
                        if(filterSeleted == "filter_by_price") {
                            const min = document.getElementById("content_left_client_all_product_input_min").value;
                            const max = document.getElementById("content_left_client_all_product_input_max").value;
                            if(min != "" && max == "") {
                                loadDataByIsPrice({ page: pageSelected, priceMin: min});
                            } else  if (min == "" && max != "") {
                                loadDataByIsPrice({ page: pageSelected, priceMax: max});
                            } else {
                                loadDataByIsPrice({ page: pageSelected, priceMin: min, priceMax: max});
                            }
                        }
                    } else {
                        loadData({page: pageSelected});
                    }
                }
                });

                // 3 -- Xử lí nextBtn click - tăng 1 - tối đa max pages
                document.getElementById("nextBtn").addEventListener("click", function() {
                    $('html, body').animate({ scrollTop: 0 }, 'slow');
                    if (pageSelected < total_pages) {
                        var searchKey = document.getElementById("client_product_search_bar").value;
                        pageSelected++;
                        document.getElementById("pageSelected").innerHTML = pageSelected;
                        if(searchKey !== "") {
                            loadSearchResult({ page: pageSelected, searchKey: searchKey});
                        } else if (filterSeleted !== "") {
                            if(filterSeleted == "filter_by_price_asd") {
                                loadDataByIsAscending({ page: pageSelected, isAscending: 1});
                            }
                            if(filterSeleted == "filter_by_price_des") {
                                loadDataByIsAscending({ page: pageSelected, isAscending: 0});
                            }
                            if(filterSeleted == "filter_by_price") {
                                const min = document.getElementById("content_left_client_all_product_input_min").value;
                                const max = document.getElementById("content_left_client_all_product_input_max").value;
                                if(min != "" && max == "") {
                                    loadDataByIsPrice({ page: pageSelected, priceMin: min});
                                } else  if (min == "" && max != "") {
                                    loadDataByIsPrice({ page: pageSelected, priceMax: max});
                                } else {
                                    loadDataByIsPrice({ page: pageSelected, priceMin: min, priceMax: max});
                                }
                            }
                        } else {
                            loadData({page: pageSelected});
                        }
                    }
                });

                // 4 -- Xử lí nextPageBtn click - max pages
                document.getElementById("nextPageBtn").addEventListener("click", function() {
                    $('html, body').animate({ scrollTop: 0 }, 'slow');
                    var searchKey = document.getElementById("client_product_search_bar").value;
                    pageSelected = total_pages;
                    document.getElementById("pageSelected").innerHTML = pageSelected;
                    if(searchKey !== "") {
                        loadSearchResult({ page: pageSelected, searchKey: searchKey});
                    } else if (filterSeleted !== "") {
                        if(filterSeleted == "filter_by_price_asd") {
                            loadDataByIsAscending({ page: pageSelected, isAscending: 1});
                        }
                        if(filterSeleted == "filter_by_price_des") {
                            loadDataByIsAscending({ page: pageSelected, isAscending: 0});
                        }
                        if(filterSeleted == "filter_by_price") {
                            const min = document.getElementById("content_left_client_all_product_input_min").value;
                            const max = document.getElementById("content_left_client_all_product_input_max").value;
                            if(min != "" && max == "") {
                                loadDataByIsPrice({ page: pageSelected, priceMin: min});
                            } else  if (min == "" && max != "") {
                                loadDataByIsPrice({ page: pageSelected, priceMax: max});
                            } else {
                                loadDataByIsPrice({ page: pageSelected, priceMin: min, priceMax: max});
                            }
                        }
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
            unsetAllFilters();
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
</script>