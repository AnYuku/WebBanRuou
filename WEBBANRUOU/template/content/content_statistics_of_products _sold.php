<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js"></script>

<div class="main_view_chart">
    <div>
        <a>
            Thống kê
        </a>
    </div>
    <div class="view_chart">
        <canvas id="myChart1"></canvas>
        <div class="view_chart_center">
            <a>
                Thống kế doanh thu theo quý
            </a>
        </div>
    </div>
    <div class="view_chart">
        <canvas id="myChart2"></canvas>
        <div class="view_chart_center">
            <a>
                Thống kê số lượng đơn hàng trong quý
            </a>
        </div>
    </div>
    <div class="view_chart">
        <div class="view_chart_left">
            <select id="quarterSelect_myChart3"></select>
            <select id="yearSelect_myChart3"></select>
        </div>
        <canvas id="myChart3"></canvas>
        <div class="view_chart_center">
            <a>
                Thống kê sản phẩm đã bán
            </a>
        </div>
    </div>
</div>

<script>
    const dataQuy = ["Quý 1", "Quý 2", "Quý 3", "Quý 4"];
    let allDataCountOrder = [];
    let allProduct = [];
    var currentYear = new Date().getFullYear();
    let yearChart3 = 2023;
    let quarterChart3 = 1;
    var myChart1 = "";
    var myChart2 = "";
    var myChart3 = "";

    function formatTimeToTimeSQL(time) {
        const date = new Date(time);
        const year = date.getFullYear();
        const month = String(date.getMonth() + 1).padStart(2, '0');
        const day = String(date.getDate()).padStart(2, '0');
        const formattedDate = `${year}-${month}-${day} 00:00:00.000000`;
        return formattedDate;
    }

    function formatTimeToTimeDisplay(time) {

    }

    function formatQuarterToNumber(quarter) {
        let match = quarter.match(/\d+/);
        let quarterNum = parseInt(match[0]);
        return quarterNum;
    }

    // Lấy ngày cuối cùng
    function getLastDayOfMonth(year, month) {
        let nextMonth = new Date(year, month + 1, 1);
        let lastDay = new Date(nextMonth - 1);
        return lastDay.getDate();
    }

    // Lấy tháng đầu + cuối của Qúy
    function getRange(input) {
        const start = (input - 1) * 3;
        const end = start + 2;
        return {
            firstMonth: start,
            lastMonth: end,
        };
    }

    // Lấy khoảng thời gian của quý - Example: 
    function getQuarterTime(year, quarter) {
        const time = getRange(quarter);
        const day = {
            firstDay: 1,
            lastDay: getLastDayOfMonth(year, time.lastMonth)
        }
        var startTime = new Date(year, time.firstMonth, day.firstDay);
        var endTime = new Date(year, time.lastMonth, day.lastDay);
        return {
            timeStart: formatTimeToTimeSQL(startTime),
            timeEnd: formatTimeToTimeSQL(endTime)
        };
    }

    function getTransactIdByTime(time) {
        return new Promise(function(resolve, reject) {
            $.ajax({
                url: "./template/db_GET_TransactHeaderByTime.php",
                type: "GET",
                data: {
                    Start: time.timeStart,
                    End: time.timeEnd
                },
                dataType: "json",
                success: function(result) {
                    resolve(result);
                },
                error: function(xhr, status, error) {
                    reject(error);
                }
            });
        });
    }

    function getProductByProductNum(productNum) {
        let result = {};
        for (let i = 0; i < allProduct.length; i++) {
            if (allProduct[i].ProductNum === productNum) {
                result = {
                    ProductName: allProduct[i].ProductName,
                    ImageSource: allProduct[i].ImageSource
                };
                break;
            }
        }
        return result;
    }

    function getAllTransactDetailByTransId(id, allTransDetails) {
        const transid1 = id.trim();
        let result = [];
        allTransDetails.forEach((item) => {
            const transid2 = item.TransactId;
            if (transid1 === transid2) {
                result.push(item);
            }
        });
        return result;
    }

    function initDataProduct() {
        return new Promise(function(resolve, reject) {
            $.ajax({
                url: "./template/dbconnection_GET.php",
                type: "GET",
                data: {
                    table_name: "product"
                },
                dataType: "json",
                success: function(resultProduct) {
                    resolve(resultProduct);
                },
                error: function(xhr, status, error) {
                    reject(error);
                }
            });
        });
    };

    function initDataTransDetails() {
        return new Promise(function(resolve, reject) {
            $.ajax({
                url: "./template/dbconnection_GET.php",
                type: "GET",
                data: {
                    table_name: "transactdetail"
                },
                dataType: "json",
                success: function(result) {
                    resolve(result);
                },
                error: function(xhr, status, error) {
                    reject(error);
                }
            });
        });
    };

    function getDataChart3(list) {
        let data = [];
        list.forEach((header) => {
            data.push(header.Details);
        });

        const result = {};

        data.forEach((row) => {
            row.forEach((item) => {
                const ProductName = item.ProductName;
                const Quan = item.Quan;
                if (!result[ProductName]) {
                    result[ProductName] = Number(Quan);
                } else {
                    result[ProductName] += Number(Quan);
                }
            });
        });

        const uniqueProducts = Object.keys(result).map((key) => ({
            ProductName: key,
            Quan: result[key].toString(),
        })) || [];
        return uniqueProducts;
    }

    function initDataChar2(year) {
        return new Promise(function(resolve, reject) {
            getTransactIdByTime(getQuarterTime(year, 1))
                .then(function(resultTransactId1) {
                    getTransactIdByTime(getQuarterTime(year, 2))
                        .then(function(resultTransactId2) {
                            getTransactIdByTime(getQuarterTime(year, 3))
                                .then(function(resultTransactId3) {
                                    getTransactIdByTime(getQuarterTime(year, 4))
                                        .then(function(resultTransactId4) {
                                            const count1 = resultTransactId1.length;
                                            const count2 = resultTransactId2.length;
                                            const count3 = resultTransactId3.length;
                                            const count4 = resultTransactId4.length;
                                            resolve([count1, count2, count3, count4]);
                                        })
                                        .catch(function(error) {
                                            reject(error);
                                        });
                                })
                                .catch(function(error) {
                                    reject(error);
                                });
                        })
                        .catch(function(error) {
                            reject(error);
                        });
                })
                .catch(function(error) {
                    reject(error);
                });
        });
    };

    function initDataChar3(year, quarter) {
        return new Promise(function(resolve, reject) {
            getTransactIdByTime(getQuarterTime(year, quarter))
                .then(function(resultTransactId) {
                    resolve(resultTransactId);
                })
                .catch(function(error) {
                    reject(error);
                })
        });
    }

    function makeTransparentAndDarker(color) {
        const r = parseInt(color.slice(1, 3), 16);
        const g = parseInt(color.slice(3, 5), 16);
        const b = parseInt(color.slice(5, 7), 16);
        const alpha = 0.5;
        const darkerFactor = 0.8;

        const newR = Math.floor(r * darkerFactor);
        const newG = Math.floor(g * darkerFactor);
        const newB = Math.floor(b * darkerFactor);

        const newColor = `rgba(${newR}, ${newG}, ${newB}, ${alpha})`;
        return newColor;
    }



    const year = 2023;

    const exampleData = ['January', 'February', 'March', 'April', 'May', 'June', 'July'];
    const exampleData1 = [12, 19, 3, 5, 2, 3, 15];

    const data2 = [0, 0, 0, 0];

    var data = [
        [75, 80, 85, 90],
        [60, 70, 80, 90],
        [65, 75, 85, 95],
        [50, 55, 60, 65],
        [70, 80, 90, 100],
        [55, 65, 75, 85],
        [80, 85, 90, 95],
        [65, 75, 85, 95],
        [50, 60, 70, 80],
        [70, 80, 90, 100]
    ];
    var labels = ['Product A', 'Product B', 'Product C', 'Product D', 'Product E', 'Product F', 'Product G', 'Product H', 'Product I', 'Product J'];
    var colors = {
        borderColor: [
            '#2ecc71',
            '#3498db',
            '#9b59b6',
            '#34495e',
            '#f1c40f',
            '#e67e22',
            '#e74c3c',
            '#95a5a6',
            '#16a085',
            '#27ae60'
        ],
        backgroundColor: [
            makeTransparentAndDarker('#2ecc71'),
            makeTransparentAndDarker('#2d6da3'),
            makeTransparentAndDarker('#7e549e'),
            makeTransparentAndDarker('#2c3e50'),
            makeTransparentAndDarker('#c7a00e'),
            makeTransparentAndDarker('#ad610f'),
            makeTransparentAndDarker('#a53729'),
            makeTransparentAndDarker('#7f8c8d'),
            makeTransparentAndDarker('#0d7b54'),
            makeTransparentAndDarker('#1f8e43')
        ]
    };

    var colorChuThich = {
        borderColor: '#000',
        backgroundColor: '#fff'
    }

    function destroyChart(chart) {
        if (chart) {
            chart.destroy();
        }
    }

    function initChart1(labelData, dataset) {
        var ctx = document.getElementById('myChart1').getContext('2d');
        myChart1 = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labelData,
                datasets: [{
                    label: 'Số tiền (VND)',
                    data: dataset,
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    }

    function initChart2(labelData, dataset) {
        var ctx = document.getElementById('myChart2').getContext('2d');
        myChart2 = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labelData,
                datasets: [{
                    label: 'Số lượng đơn hàng',
                    data: dataset,
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    };

    function initChart3(dataQuy, data) {
        var ctx = document.getElementById("myChart3").getContext("2d");

        myChart3 = new Chart(ctx, {
            type: "horizontalBar",
            data: {
                labels: data.map(function(d) {
                    return d.ProductName;
                }),
                datasets: [{
                    label: "Số lượng",
                    data: data.map(function(d) {
                        return d.Quan;
                    }),
                    backgroundColor: colors.backgroundColor,
                    borderColor: colors.borderColor,
                    borderWidth: 2,
                }, ],
            },
            options: {
                scales: {
                    xAxes: [{
                        ticks: {
                            beginAtZero: true,
                        },
                    }, ],
                },
            },
        });
    };

    function initSelectYears() {
        var years = [];
        for (var i = currentYear; i >= 2000; i--) {
            years.push(i);
        }

        var yearSelect = document.getElementById("yearSelect_myChart3");
        var quarterSelect = document.getElementById("quarterSelect_myChart3");

        // Thêm lựa chọn vào box
        for (var i = 0; i < years.length; i++) {
            var option = document.createElement("option");
            option.text = years[i];
            yearSelect.add(option);
        }
        for (var i = 0; i < dataQuy.length; i++) {
            var option = document.createElement("option");
            option.text = dataQuy[i];
            quarterSelect.add(option);
        }

        // Thêm chức năng khi thay đổi lựa chọn

        function changeChart3() {
            var yearSelect = document.getElementById("yearSelect_myChart3").value;
            var quarterSelect = document.getElementById("quarterSelect_myChart3").value;
            yearChart3 = yearSelect;
            quarterChart3 = formatQuarterToNumber(quarterSelect);
            destroyChart(myChart1);
            destroyChart(myChart2);
            destroyChart(myChart3);
            loadView();
        }

        yearSelect.addEventListener("change", (event) => {
            event.preventDefault();
            changeChart3();
        });
        quarterSelect.addEventListener("change", (event) => {
            event.preventDefault();
            changeChart3();
        });
    }

    function loadView() {
        initDataProduct()
            .then(function(resultAllProduct) {
                allProduct = resultAllProduct;
                initDataTransDetails()
                    .then(function(allTransDetails) {
                        initChart1(exampleData, exampleData1);
                        initDataChar2(year)
                            .then(function(data) {
                                initChart2(dataQuy, data);
                            })
                            .catch(function(error) {
                                alert(error);
                            });

                        initDataChar3(yearChart3, quarterChart3)
                            .then(function(data) {
                                const customData = data.map((item) => {
                                    const listDetail = getAllTransactDetailByTransId(item.TransactId, allTransDetails);
                                    const customListDetail = listDetail.map((detail) => {
                                        const productInfo = getProductByProductNum(detail.ProductNum);
                                        return {
                                            ...detail,
                                            ...productInfo
                                        }
                                    });
                                    return {
                                        TransactId: item.TransactId,
                                        Details: customListDetail
                                    }
                                });
                                const dataChart = getDataChart3(customData);
                                if (dataChart.length === 0) {
                                    const data0 = [{
                                        ProductName: "Không có",
                                        Quan: 1
                                    }];
                                    initChart3([], data0);
                                } else {
                                    initChart3([], dataChart);
                                }
                            })
                            .catch(function(error) {
                                alert(error);
                            });
                    })
                    .catch(function(error) {
                        alert(error);
                    });
            })
            .catch(function(error) {
                alert(error);
            });
    }

    // Những thứ sẽ khởi tạo đầu tiên
    initSelectYears();
    loadView();
</script>