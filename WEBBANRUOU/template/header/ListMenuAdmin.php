<div class="listMenuAdmin" id="listMenuAdmin">
    <ul>
        <li>
            <img src="./image/male_user_32px.png" alt="" srcset="">
            <a class="account_management" href="index.php?user=admin&data=account_management">Quản lí tài khoản</a>
        </li>
        <li>
            <img src="./image/Magnetic Card_32px.png" alt="" srcset="">
            <a class="payment_management" href="index.php?user=admin&data=payment_management">Quản lí thanh toán</a>
        </li>
        <li>
            <img src="./image/product_30px.png" alt="" srcset="">
            <a class="product_management" href="index.php?user=admin&data=product_management">Quản lí sản phẩm</a>
        </li>
        <li>
            <img src="./image/tax_32px.png" alt="" srcset="">
            <a class="tax_administration" href="index.php?user=admin&data=tax_administration">Quản lí thuế</a>
        </li>
        <li>
            <img src="./image/tax_32px.png" alt="" srcset="">
            <a class="tax_administration" href="index.php?user=admin&data=tax_administration">Thống kê sản phẩm đã bán</a>
        </li>
        <li>
            <img src="./image/tax_32px.png" alt="" srcset="">
            <a class="tax_administration" href="index.php?user=admin&data=tax_administration">Thống kê sản phẩm các đơn hàng</a>
        </li>
        <li>
            <img src="./image/tax_32px.png" alt="" srcset="">
            <a class="tax_administration" href="index.php?user=admin&data=tax_administration">Xác nhận đơn hàng</a>
        </li>
    </ul>
</div>
<script>
    
// Hover list menu admin
var mennuHoverAdmin = document.querySelector('.menuheader');
var menuAdmin = document.querySelector('.listMenuAdmin');
var isMenuVisible = false;

if (typeof mennuHoverAdmin !== 'undefined' && mennuHoverAdmin !== null) {
  // mennuHoverAdmin đã được định nghĩa và có giá trị
  mennuHoverAdmin.addEventListener('mouseenter', function() {
    menuAdmin.style.display = 'block';
    isMenuVisible = true;
  });
  
  mennuHoverAdmin.addEventListener('mouseleave', function() {
    isMenuVisible = false;
    setTimeout(function() {
      if (!isMenuVisible) {
        menuAdmin.style.display = 'none';
      }
    }, 200);
  });
  
  menuAdmin.addEventListener('mouseenter', function() {
    isMenuVisible = true;
  });
  
  menuAdmin.addEventListener('mouseleave', function() {
    isMenuVisible = false;
    setTimeout(function() {
      if (!isMenuVisible) {
        menuAdmin.style.display = 'none';
      }
    }, 200);
  });

}
</script>


