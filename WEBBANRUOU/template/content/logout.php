<?php
session_start();
unset($_SESSION['logged_in']);
session_destroy();
// include("./template/content/login.php");
header("Location: ../../index.php", true, 301);
exit();

?>

<script>
    sessionStorage.removeItem("codeExecuted");
</script>