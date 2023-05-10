<div id="product-detail-container">
	<div class="left">
		<img id="product-detail-container-previewImage" src="" alt="Product Image">
	</div>
	<div class="right">
		<p>Mã sản phẩm: <span id="product-detail-container-productID"></span></p>
		<h2><span id="product-detail-container-productName"></span></h2>
		<p>Loại rượu: <span id="product-detail-container-productCategory"></span></p>
		<h3 id="product-detail-container-productPrice"></h3>
		<!-- <p>Số lượng:<span id="product-detail-container-productQuantity"></span></p>
		<br> -->
		<!-- <button>Add to Cart</button> -->
		<form id="add-to-cart-form">
			<input type="hidden" name="product_id" value="123">
			<button type="button" id="minus-button" onclick="minus1()"><i class="fa-solid fa-minus"></i></button>
			<input type="number" name="quantity" id="producQuantityToBuy" value="1" min="1">
			<button type="button" id="plus-button" onclick="plus1()"><i class="fa-solid fa-plus"></i></button>
			<button type="button" id="product-detail-container-add-to-cart-btn"></i> Thêm vào giỏ hàng</button>
		</form>
	</div>
	<div class="bottom">
		<p id="description">Mô tả: <span id="product-detail-container-productDescription"> </span></p>
	</div>

</div>

<script src="https://kit.fontawesome.com/44c01e1bca.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
	console.log('Run');
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
				$('#product-detail-container-productDescription').html(productInfo[0].Descript);
				$('#product-detail-container-productCategory').html(productInfo[0].CatName);
				$('#product-detail-container-previewImage').attr('src', productInfo[0].ImageSource);
				$('input[name="quantity"]').attr('max', productInfo[0].Quan);
			}
		})
	});
	


	$('#product-detail-container-add-to-cart-btn').on('click',  function() {
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
					if(response.indexOf("SL") >= 0)	{
						Swal.fire({
						icon: 'error',
						title: 'Số lượng không hợp lệ',						
						})						
					}		
					else {
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

<style>
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
</style>
