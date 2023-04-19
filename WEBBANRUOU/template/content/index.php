<?php
echo 'Day la trang chu';
if (isset($_GET['user']) && $_GET['user'] === 'admin') {
  echo 'Tôi là admin';
}
if (isset($_GET['user']) && $_GET['user'] === 'client') {
    echo 'Tôi là khách hàng';
  }
?>