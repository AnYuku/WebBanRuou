

//change page admin
// $(document).ready(function(){
//   $('#loginphp').click(function(e) {
//   e.preventDefault();
//   var bien = 'dangnhap';
//   $.ajax({
//       url: './template/content/conTentChangeLogin.php',
//       type: "GET",
//       data: 'id='+bien,
//       success: function(reponse){
//           $('#main').html(reponse);
//       }
//   });
// });
// });
//change page centent
// $(document).ready(function(){
//     $('#changePageProduct').click(function(e) {
//     e.preventDefault();
//     var bien = 'client';
//     $.ajax({
//         url: './template/content/conTentChangeClient.php',
//         type: "GET",
//         data: 'id ='+bien,
//         success: function(reponse){
//             $('#main').html(reponse);
//             // console.log(reponse);
//         }
//     });
// });
// });
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

// Hover list menu user
var mennuHoverUser = document.querySelector('.link_user_hover');
var menuUser = document.querySelector('.listMenuUser');

mennuHoverUser.addEventListener('mouseenter', function() {
    menuUser.style.display = 'block';
    isMenuVisible = true;
  });
  
  mennuHoverUser.addEventListener('mouseleave', function() {
    isMenuVisible = false;
    setTimeout(function() {
      if (!isMenuVisible) {
        menuUser.style.display = 'none';
      }
    }, 200);
  });
  
  menuUser.addEventListener('mouseenter', function() {
    isMenuVisible = true;
  });
  
  menuUser.addEventListener('mouseleave', function() {
    isMenuVisible = false;
    setTimeout(function() {
      if (!isMenuVisible) {
        menuUser.style.display = 'none';
      }
    }, 200);
  });

// Hover list menu admin
var mennuHoverAdmin = document.querySelector('.menuadmin');
var menuAdmin = document.querySelector('.listMenuAdmin');

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

  
