<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$Whopay = $_SESSION["userId"];

?>
<div id="cart-container">
    <h1>Giỏ hàng của bạn</h1>
    <table id="cart-cart-table">
        <thead>
            <tr>
                <th>Tên sản phẩm</th>
                <th>Số lượng</th>
                <th>Đơn giá</th>
                <th>Xóa sản phẩm</th>
            </tr>
        </thead>
        <tbody>

        </tbody>
    </table>

    <p><span id="totalPrice"></span></p>
    <div id="btn-transactheader"></div>
</div>
<script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://kit.fontawesome.com/44c01e1bca.js" crossorigin="anonymous"></script>

<script>
    var userID = '<?php echo $Whopay; ?>';
    $(document).ready(function() {
        $.ajax({
            type: "POST",
            url: "./template/dbconnection_CART.php",
            dataType: "json",
            data: {
                userID : userID                
            },
            success: function(data) {
                console.log(data);
                var html = "";
                var totalCost = 0;
                for (var i = 0; i < data.length; i++) {
                    var productName = data[i].ProductName;
                    var quantity = data[i].Quan;
                    var price = data[i].CostEach;
                    var totalPrice = price * quantity;
                    totalCost += totalPrice;
                    html += "<tr>";
                    html += "<td>" + productName + "</td>";
                    html += "<td>";
                    html += "<button class='btn-minus' data-product-id='" + data[i].ProductNum + "'>-</button>";
                    html += "<span id='quantity-" + data[i].ProductNum + "'>" + quantity + "</span>";
                    html += "<button class='btn-plus' data-product-id='" + data[i].ProductNum + "'>+</button>";
                    html += "</td>";
                    html += "<td>" + formatNumber(price) + " đ</td>";
                    html += "<td><button class='btn-remove' data-product-id='" + data[i].ProductNum + "'><i class='fa-regular fa-trash-can'></i></button></td>";
                    html += "</tr>";
                }
                $("#cart-cart-table tbody").html(html);
                $("#totalPrice").html("Tổng tiền: " + formatNumber(totalCost) + " đ");
                if(data.length == 0){
                    $("#btn-transactheader").html("<button class='btn-transactheader button-23' disabled action='pay'>Thanh toán</button>")

                }
                else{
                    $("#btn-transactheader").html("<button class='btn-transactheader button-23' action='pay'>Thanh toán</button>")

                }
            }
        });

        function formatNumber(number) {
            return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        }
    });
    //Ajax chỉnh sửa SL sản phẩm
    $(document).on('click', '.btn-plus, .btn-minus', function() {
        var productId = $(this).data('product-id');
        var quantityChange = $(this).hasClass('btn-plus') ? 1 : -1;

        $.ajax({
            type: 'POST',
            url: './template/dbconnection_UPDATE_QUANTITY.php',
            data: {
                productId: productId,
                quantityChange: quantityChange,
            },
            success: function(response) {
                var decoded_json = JSON.parse(response);
                const count = Object.keys(decoded_json).length;
                if (count == 2) {
                    var quantityNew = decoded_json.Quan;
                    var totalPrice = decoded_json.Total;
                    $("#quantity-" + productId).text(quantityNew);
                    $("#totalPrice").text("Tổng tiền: " + parseFloat(totalPrice).toLocaleString('en-US', {
                        useGrouping: true
                    }) + " đ");
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Số lượng sản phẩm không hợp lệ',
                        showConfirmButton: false,
                        timer: 1500
                    });
                }
            }
        });
    });
    //Ajax xóa sản phẩm khỏi cart
    $(document).on('click', '.btn-remove', function() {
        Swal.fire({
            title: 'Bạn muốn bỏ sản phẩm ra khỏi giỏ hàng?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Đúng vậy'
        }).then((result) => {
            if (result.isConfirmed) {
                var productId = $(this).data('product-id');
                $.ajax({
                    type: 'POST',
                    url: './template/dbconnection_CART.php',
                    data: {
                        action: "delete",
                        productId: productId
                    },
                    success: function(response) {
                        console.log(response);
                        location.reload();
                    }
                });
            }
        })
    });
    //Thanh toán
    $(document).on('click', '.btn-transactheader', function() {
        $.ajax({
            type: 'POST',
            url: './template/dbconnection_CART.php',
            data: {
                action: "pay"
            },
            success: function(response) {
                Swal.fire({
                    icon: 'success',
                    title: 'Bạn đã thanh toán thành công',
                    showConfirmButton: false,
                    timer: 1500
                })
                var delayInMilliseconds = 2000; //1 second
                setTimeout(function() {
                    location.reload();
                }, delayInMilliseconds);                
            }
        });

    });
</script>

<style>
    #cart-container {
        max-width: 90%; 
        min-width: 600px;       
        margin: 10px auto;
        margin-left: 300px;
        padding: 1rem;        
        font-weight: bold;
        display: flex;
        flex-direction: column;
        align-items: center;
        color: #961313;
    }
    #cart-container p{
        margin-top: 20px;
        margin-bottom: 20px;
    }

    #cart-cart-table {
        width: 100%;
        border-collapse: collapse; 
    }

    #cart-cart-table th,
    #cart-cart-table td {
        padding: 8px;
        border: 1px solid #ddd;
        text-align: center;
    }

    #cart-cart-table th {
        background-color: #f2f2f2;
    }

    #cart-cart-table td button {
        background-color: #f2f2f2;
        border: none;
        cursor: pointer;
    }

    #cart-cart-table td button:hover {
        background-color: #ddd;
    }

    #cart-cart-table td span {
        margin: 0 10px;
    }
</style>

<script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>