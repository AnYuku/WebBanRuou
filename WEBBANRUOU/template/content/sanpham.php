<button type="button" onclick="chuyentrang()">ABC</button>
<script>
    function chuyentrang() {
        var productId = "P00001";
        window.location.href = `productDetail.php?productId=${productId}`;
    }
</script>