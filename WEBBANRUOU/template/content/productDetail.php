<style>
	.productDetail-MainView {
		width: 100%;
		min-height: 100%;
		display: flex;
		flex-direction: column;
		align-items: center;
		justify-content: flex-start;
		background-color: #f4f4f4;
	}

	.productDetail-View {
		width: 70%;
		min-width: 800px;
		display: flex;
		flex-direction: column;
		margin-top: 20px;
	}

	.glass_effect {
		padding: 20px;
		background: linear-gradient(to bottom, rgba(255, 255, 255, 0.7), rgba(255, 255, 255, 0.3));
		backdrop-filter: blur(10px);
		box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
		border-radius: 10px;
	}

	.productDetail-View-Top {
		width: 100%;
		height: 100%;
		display: flex;
		flex-direction: row;
		align-items: center;
	}

	.productDetail-View-Top-Right {
		width: 100%;
		padding-left: 20px;
		padding-right: 20px;
	}

	.productDetail-View-Top-Line1 {
		width: 100%;
		padding: 5px;
	}

	.productDetail-View-Top-Line1 a {
		font-size: 30px;
		font-weight: bold;
		color: #000;
	}

	.productDetail-View-Top-Line2 {
		width: 100%;
		padding: 5px;
	}

	.productDetail-View-Top-Line2 a {
		font-size: 26px;
		color: #000;
	}

	.productDetail-View-Top-Line3 {
		width: 100%;
		padding: 5px;
		margin-top: 40px;
		display: flex;
		flex-direction: row;
		align-items: center;
		justify-content: flex-end;
	}

	.productDetail-View-Top-Line3 a {
		font-size: 26px;
		color: #000;
		font-weight: bold;
	}

	.productDetail-View-Top-Line4 {
		width: 100%;
		padding: 5px;
		display: flex;
		flex-direction: row;
		align-items: center;
		justify-content: flex-end;
	}

	.productDetail-View-Top-Line4 div {
		margin: 10px;
	}

	.Line4_Minus_Plus button {
		padding: 5px 7px;
		background-color: #ccc;
		border: none;
		cursor: pointer;
		border: 1px solid #000;
		border-radius: 50px;
	}

	.Line4 input[type="number"] {
		width: 50px;
		padding: 5px;
		border-radius: 5px;
		font-size: 20px;
	}

	.Line4 input[type="number"]::-webkit-inner-spin-button,
	.Line4 input[type="number"]::-webkit-outer-spin-button {
		-webkit-appearance: none;
		margin: 0;
	}

	.Line4 input[type="number"]::-moz-number-spin-box {
		-moz-appearance: textfield;
	}

	.Line4 input[type="number"] {
		-moz-appearance: textfield;
	}

	.productDetail-View-Top-Line5 {
		width: 100%;
		padding: 5px;
		margin-top: 20px;
		display: flex;
		flex-direction: row;
		align-items: center;
		justify-content: flex-end;
	}

	.productDetail-View-Top-Line5 button {
		width: 250px;
		padding: 15px 10px;
		background-color: #ccc;
		border: none;
		cursor: pointer;
		border-radius: 5px;
		font-size: 20px;
		font-weight: bold;
	}

	.productDetail-View-Bottom {
		width: 100%;
		margin-top: 20px;
		display: flex;
		flex-direction: column;
	}

	.productDetail-View-Bottom div:first-child a {
		font-size: 20px;
		font-weight: bold;
	}

	.normalText {
		margin-top: 10px;
		padding: 10px;
		min-height: 3em;
		background-color: white;
	}

	.normalText a {
		font-size: 18px;
	}

	.autoBreakLine {
		width: 100%;
		word-wrap: break-word;
		overflow-wrap: break-word;
	}

	.borderText {
		border: 1px solid #000;
		border-radius: 5px;
	}

	.imageBox {
		width: 320px;
		height: 100%;
		display: flex;
		align-items: center;
		justify-content: center;
		border: 1px solid #000;
		margin-right: 10px;
	}

	.imageBox img {
		width: 300px;
		height: 350px;
	}
</style>

<div class="productDetail-MainView">
	<div id="product-detail-container" class="productDetail-View glass_effect">
		<div class="productDetail-View-Top">
			<div class="left imageBox">
				<img id="product-detail-container-previewImage" src="" alt="Product Image">
			</div>
			<div class="productDetail-View-Top-Right glass_effect">
				<!-- <p>Mã sản phẩm: <span id="product-detail-container-productID"></span></p> -->
				<div class="productDetail-View-Top-Line1">
					<a><span id="product-detail-container-productName"></span></a>
				</div>
				<div class="productDetail-View-Top-Line2">
					<a>Thuộc loại: <span id="product-detail-container-productCategory"></span></a>
				</div>
				<div class="productDetail-View-Top-Line3">
					<a>Giá:&nbsp;</a>
					<a id="product-detail-container-productPrice"></a>
				</div>
				<!-- <p>Số lượng:<span id="product-detail-container-productQuantity"></span></p>
		<br> -->
				<!-- <button>Add to Cart</button> -->
				<div class="productDetail-View-Top-Line4">
					<input type="hidden" name="product_id" value="123">
					<div class="Line4_Minus_Plus">
						<button type="button" id="minus-button" onclick="minus1()"><i class="fa-solid fa-minus"></i></button>
					</div>
					<div class="Line4">
						<input type="number" name="quantity" id="producQuantityToBuy" value="1" min="1">
					</div>
					<div class="Line4_Minus_Plus">
						<button type="button" id="plus-button" onclick="plus1()"><i class="fa-solid fa-plus"></i></button>
					</div>
				</div>
				<div class="productDetail-View-Top-Line5">
					<button type="button" id="product-detail-container-add-to-cart-btn"></i> Thêm vào giỏ hàng</button>
				</div>
			</div>
		</div>
		<div class="productDetail-View-Bottom">
			<div>
				<a id="description">Mô tả:&nbsp;</a>
			</div>
			<div class="autoBreakLine normalText borderText">
				<a id="product-detail-container-productDescription"></a>
			</div>
		</div>
	</div>
</div>

<script src="https://kit.fontawesome.com/44c01e1bca.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
	// Nhấn + - để thay đổi giá trị số lượng	
	var quantityInput = document.querySelector('input[name="quantity"]');

	function plus1() {
		event.preventDefault();
		quantityInput.value = parseInt(quantityInput.value) + 1;
	};

	function minus1() {
		event.preventDefault();
		if (parseInt(quantityInput.value) > 1) {
			quantityInput.value = parseInt(quantityInput.value) - 1;
		}
	};
	let productId = 0;
	try {
		const productIdString = <?php echo json_encode($_GET['productId']); ?>;
		productId = productIdString;
	} catch (e) {
		console.log(e);
	};
	$(document).ready(function() {
		$.ajax({
			url: "./template/dbconnection_PRODUCT_DETAIL.php",
			type: "GET",
			data: {
				productId: productId
			},
			dataType: "json",
			success: function(response) {
				// Giải mã dữ liệu JSON trả về từ server				
				var productInfo = response;
				var priceFormatted = Number(productInfo[0].Price).toLocaleString("vi-VN") + " VND";
				$('#product-detail-container-productID').html(productInfo[0].ProductNum);
				$('#product-detail-container-productName').html(productInfo[0].ProductName);
				$('#product-detail-container-productPrice').html(priceFormatted);
				$('#product-detail-container-productQuantity').html(productInfo[0].Quan);
				if (productInfo[0].Descript.length == 0) {
					$('#product-detail-container-productDescription').html("Hiện không có mô tả về sản phẩm này");
				} else {
					$('#product-detail-container-productDescription').html(productInfo[0].Descript);
				}
				$('#product-detail-container-productCategory').html(productInfo[0].CatName);
				$('#product-detail-container-previewImage').attr('src', productInfo[0].ImageSource);
				$('input[name="quantity"]').attr('max', productInfo[0].Quan);
			}
		})
	});



	$('#product-detail-container-add-to-cart-btn').on('click', function() {
		<?php
		// Kiểm tra xem SESSION $userId đã được đặt hay chưa
		$isLoggedIn = isset($_SESSION['userId']) ? true : false;
		?>
		var isLoggedIn = <?php echo $isLoggedIn ? 'true' : 'false'; ?>;
		if (isLoggedIn) {
			let productDataToCart = {
				productId: productId,
				productQuantity: $('#producQuantityToBuy').val()
			}
			console.log(productDataToCart);
			$.ajax({
				url: './template/dbconnection_Product_To_Cart.php',
				type: 'POST',
				data: {
					productDataToCart: JSON.stringify(
						productDataToCart
					)
				},
				success: function(response) {
					console.log(response);
					if (response.indexOf("SL") >= 0) {
						Swal.fire({
							icon: 'error',
							title: 'Số lượng không hợp lệ',
						})
					} else {
						Swal.fire({
							icon: 'success',
							title: 'Sản phẩm đã được thêm vào giỏ hàng',
							showConfirmButton: false,
							timer: 1500
						})
					}
				},
				error: function(xhr, status, error) {
					var errorMessage = xhr.status + ': ' + xhr.statusText
					alert('Có lỗi khi gửi dữ liệu tới API. ' + errorMessage);
				}
			})
		} else {
			Swal.fire('Bạn cần đăng nhập trước khi thêm sản phẩm vào giỏ hàng');
		}
	});
</script>

<!-- <style>
	#product-detail-container {
		background-color: rgba(217, 217, 217, 0.5);
		max-width: 60%;
		margin: 10px auto;
		padding: 1rem;
		font-weight: bold;
		display: grid;
		grid-template-columns: 1fr 1.5fr;
		grid-gap: 20px;
		flex-direction: column;
		font-family: Verdana, sans-serif;
		/* min-height:90vh;		 */
	}

	#product-detail-container .left {
		width: 100%;

	}

	#product-detail-container .left img {
		width: 100%;
		height: auto;
		max-width: 500px;

	}

	#product-detail-container .right {
		flex: 70%;
		padding: 0 20px;
	}

	#product-detail-container .bottom {
		grid-column: 1 / span 2;
		display: block;
		min-height: 40vh;
	}

	#product-detail-container h2 {
		color: #961313;
	}

	#product-detail-container h3 {
		color: #961313;
	}

	#product-detail-container p {
		font-size: 12px;
	}

	#product-detail-container input[type=number]::-webkit-inner-spin-button,
	input[type=number]::-webkit-outer-spin-button {
		-webkit-appearance: none;
	}

	#product-detail-container input[type=number] {
		width: 50px;
		text-align: center;
	}

	#product-detail-container #product-detail-container-add-to-cart-btn {
		display: block;
		margin: 20px 0px;
		background-color: #961313;
		border-radius: 20px;
		border: none;
		color: white;
		padding: 10px;
		font-weight: bold;
	}

	#product-detail-container #product-detail-container-add-to-cart-btn:hover {
		cursor: pointer;
		background-color: #cc1919;
	}

	#product-detail-container #plus-button {
		background-color: #961313;
		color: white;
		border-top-right-radius: 20px;
		border-bottom-right-radius: 20px;
		border: none;
		padding: 7.5px 10px;
	}

	#product-detail-container #minus-button {
		background-color: #961313;
		color: white;
		border-top-left-radius: 20px;
		border-bottom-left-radius: 20px;
		border: none;
		padding: 7.5px 10px;
	}

	#product-detail-container #add-to-cart-form input[type=number] {
		padding: 5px;
	}
</style> -->