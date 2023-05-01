<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>


<?php
    require("./template/dbconnection_STATISTICS_OF_PRODUCTS _SOLD.php");
    require("./template/dbconnection_Doanh_Thu.php");

    
?>
<form action="" method="post">
    <div class="search_time">
        <div class="date_time">
            <label class="from_date" for="from_date">Từ ngày</label>
            <input type="date" name="from_date" id="from_date">
            <label class="to_date" for="to_date">-Đến ngày</label>
            <input type="date" name="to_date" id="to_date">
            <select>
                <option value="chon">--Chọn--</option>
                <option value="7ngay">7 ngày qua</option>
                <option value="1thang">1 tháng qua</option>
                <option value="365ngay">365 ngày qua</option>
            </select>
        </div>
        <div>
            <input type="submit" value="Lọc kết quả">
        </div>
    </div>
</form>
<div class="chart">
    <canvas id="myChart_column" style="width:100%;max-width:600px"></canvas>
    <canvas id="myChart" style="width:100%;max-width:600px"></canvas>
</div>


<script>


var barColor = [
  "#b91d47",
  "#00aba9",
  "#2b5797",
  "#e8c3b9",
  "#1e7145"
];

new Chart("myChart", {
  type: "doughnut",
  data: {
    labels: <?php echo json_encode($CatName); ?>,
    datasets: [{
      backgroundColor: barColor,
      data:<?php echo json_encode($total_sold); ?>
    }]
  },
  options: {
    title: {
      display: true,
      text: "Thống kê số lượng đã bán"
    }
  }
});





// var xValues = ["Italy", "France", "Spain", "USA", "Argentina"];
// var yValues = [55, 49, 44, 24, 15];
var barColors = ["red", "green","blue","orange","brown"];

new Chart("myChart_column", {
  type: "bar",
  data: {
    labels:
    <?php echo json_encode($ngay) ?>,
    datasets: [{
      backgroundColor: barColors,
      data: <?php 
            echo json_encode($doanh_thu);
       ?>
    }]
  },
  options: {
    legend: {display: false},
    title: {
      display: true,
      text: "Thống kê doanh thu đã bán"
    }
  }
});

</script>
<style>
    .chart{
        display: flex;
        flex-direction: row;
    }
    .search_time{
        padding: 50px;  
    }
    .search_time .date_time {
        padding-bottom: 10px;
    }
    .search_time .date_time .to_date{
        margin-left: 20px;
    }
    .search_time .date_time select{
        margin-left: 20px;
    }
</style>
