
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


  
