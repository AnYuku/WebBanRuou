<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js"></script>

<div class="main_view_chart">
    <div class="trangPhanTich_line1">
        <div class="view_chart_line_3">
            <div class="border_View">
                <div class="title-Phantich">
                    <a>Phân tích cửa hàng</a>
                </div>
                <div>
                    <div></div>
                    <div class="text_view-trangPhanTich">
                        <img src="././image/product_208px.png" alt="Image description" class="icon-trangPhanTich">
                        <a>Tổng số lượng sản phẩm hiện có:&nbsp;</a>
                        <a id="TongSoLuongSanPham">0</a>
                    </div>
                    <div class="text_view-trangPhanTich">
                        <img src="././image/Sales Performance Balance_500px.png" alt="Image description" class="icon-trangPhanTich">
                        <a>Doanh thu quý này:&nbsp;</a>
                        <a id="DoanhThuQuyNay">0</a>
                        <a>&nbsp;VND</a>
                    </div>
                    <div class="text_view-trangPhanTich">
                        <img src="././image/Deliver Food_144px.png" alt="Image description" class="icon-trangPhanTich">
                        <a>Số lượng đơn hàng đã giao:&nbsp;</a>
                        <a id="SoLuongDonHangDaGiao">0</a>
                    </div>
                    <div class="text_view-trangPhanTich">
                        <img src="././image/cancel_subscription_512px.png" alt="Image description" class="icon-trangPhanTich">
                        <a>Số lượng đơn hàng đã hủy:&nbsp;</a>
                        <a id="SoLuongDonHangDaHuy">0</a>
                    </div>
                </div>
                <div class="line"></div>
                <div class="title-Phantich">
                    <a>Phân tích tài khoản</a>
                </div>
                <div>
                    <div></div>
                    <div class="text_view-trangPhanTich">
                        <img src="././image/user_shield_512px.png" alt="Image description" class="icon-trangPhanTich">
                        <div>
                            <div>
                                <a>Số lượng tài khoản admin đang hoạt động:&nbsp;</a>
                                <a id="TotalAdminActive">0</a>
                            </div>
                            <div>
                                <a>Số lượng tài khoản admin bị vô hiệu hóa:&nbsp;</a>
                                <a id="TotalAdminInactive">0</a>
                            </div>
                        </div>
                    </div>
                    <div class="text_view-trangPhanTich">
                        <img src="././image/male_user_480px.png" alt="Image description" class="icon-trangPhanTich">
                        <div>
                            <div>
                                <a>Số lượng tài khoản client đang hoạt động:&nbsp;</a>
                                <a id="TotalClientActive">0</a>
                            </div>
                            <div>
                                <a>Số lượng tài khoản client bị vô hiệu hóa:&nbsp;</a>
                                <a id="TotalClientInactive">0</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="bieuDoView">
        <div class="bieuDoView-title">
            <a>Biểu đồ phân tích cửa hàng</a>
        </div>
        <div class="view_chart_line_1">
            <div class="view_chart view_chart_line_1_marginLeft">
                <div class="view_chart_left">
                    <select id="yearSelect_myChart1" class="my-select"></select>
                </div>
                <canvas id="myChart1"></canvas>
                <div class="view_chart_center">
                    <a>
                        Thống kế doanh thu theo quý
                    </a>
                </div>
            </div>
            <div class="view_chart">
                <div class="    ">
                    <select id="yearSelect_myChart2" class="my-select"></select>
                </div>
                <canvas id="myChart2"></canvas>
                <div class="view_chart_center">
                    <a>
                        Thống kê số lượng đơn hàng trong quý
                    </a>
                </div>
            </div>
        </div>
        <div class="view_chart_line_1">
            <div class="view_chart_1 view_chart_line_1_marginLeft">
                <div class="view_chart_left">
                    <select id="quarterSelect_myChart3" class="my-select"></select>
                    <select id="yearSelect_myChart3" class="my-select"></select>
                </div>
                <canvas id="myChart3"></canvas>
                <div class="view_chart_center">
                    <a>
                        Thống kê sản phẩm đã bán
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    const dataQuy = ["Quý 1", "Quý 2", "Quý 3", "Quý 4"];
    let allDataCountOrder = [];
    let allProduct = [];
    var currentYear = new Date().getFullYear();
    let yearChart1 = currentYear;
    let yearChart2 = currentYear;
    let yearChart3 = currentYear;
    let quarterChart3 = 1;
    var myChart1 = "";
    var myChart2 = "";
    var myChart3 = "";

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
    };

    function toCurrency(totalCash) {
        return new Intl.NumberFormat('en-US').format(totalCash);
    };

    function formatNumberDisplay(number) {
        return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ' ');
    };

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
    };

    function getDoanhThuByTime(time) {
        return new Promise(function(resolve, reject) {
            $.ajax({
                url: "./template/db_GET_doanhThuByTime.php",
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

    function initDataChar1(year) {
        return new Promise(function(resolve, reject) {
            getDoanhThuByTime(getQuarterTime(year, 1))
                .then(function(totalDoanhThu1) {
                    getDoanhThuByTime(getQuarterTime(year, 2))
                        .then(function(totalDoanhThu2) {
                            getDoanhThuByTime(getQuarterTime(year, 3))
                                .then(function(totalDoanhThu3) {
                                    getDoanhThuByTime(getQuarterTime(year, 4))
                                        .then(function(totalDoanhThu4) {
                                            let total1 = 0;
                                            let total2 = 0;
                                            let total3 = 0;
                                            let total4 = 0;

                                            if (totalDoanhThu1 !== null) {
                                                total1 = totalDoanhThu1.SumTotal;
                                            }
                                            if (totalDoanhThu2 !== null) {
                                                total2 = totalDoanhThu2.SumTotal;
                                            }
                                            if (totalDoanhThu3 !== null) {
                                                total3 = totalDoanhThu3.SumTotal;
                                            }
                                            if (totalDoanhThu4 !== null) {
                                                total4 = totalDoanhThu4.SumTotal;
                                            }

                                            resolve([
                                                total1,
                                                total2,
                                                total3,
                                                total4
                                            ]);
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

        var yearSelect1 = document.getElementById("yearSelect_myChart1");
        var yearSelect2 = document.getElementById("yearSelect_myChart2");
        var yearSelect3 = document.getElementById("yearSelect_myChart3");
        var quarterSelect3 = document.getElementById("quarterSelect_myChart3");

        // Thêm lựa chọn vào box
        for (var i = 0; i < years.length; i++) {
            var option = document.createElement("option");
            option.text = years[i];
            yearSelect1.add(option);
        }
        for (var i = 0; i < years.length; i++) {
            var option = document.createElement("option");
            option.text = years[i];
            yearSelect2.add(option);
        }
        for (var i = 0; i < years.length; i++) {
            var option = document.createElement("option");
            option.text = years[i];
            yearSelect3.add(option);
        }
        for (var i = 0; i < dataQuy.length; i++) {
            var option = document.createElement("option");
            option.text = dataQuy[i];
            quarterSelect3.add(option);
        }

        // Thêm chức năng khi thay đổi lựa chọn

        function changeChart() {
            var yearSelect1 = document.getElementById("yearSelect_myChart1").value;
            var yearSelect2 = document.getElementById("yearSelect_myChart2").value;
            var yearSelect3 = document.getElementById("yearSelect_myChart3").value;
            var quarterSelect3 = document.getElementById("quarterSelect_myChart3").value;
            yearChart1 = yearSelect1;
            yearChart2 = yearSelect2;
            yearChart3 = yearSelect3;
            quarterChart3 = formatQuarterToNumber(quarterSelect3);
            destroyChart(myChart1);
            destroyChart(myChart2);
            destroyChart(myChart3);
            loadView();
        }

        yearSelect1.addEventListener("change", (event) => {
            event.preventDefault();
            changeChart();
        });

        yearSelect2.addEventListener("change", (event) => {
            event.preventDefault();
            changeChart();
        });

        yearSelect3.addEventListener("change", (event) => {
            event.preventDefault();
            changeChart();
        });
        quarterSelect3.addEventListener("change", (event) => {
            event.preventDefault();
            changeChart();
        });
    }

    function loadView() {
        initDataProduct()
            .then(function(resultAllProduct) {
                allProduct = resultAllProduct;
                initDataTransDetails()
                    .then(function(allTransDetails) {
                        initDataChar1(yearChart1)
                            .then(function(dataChart1) {
                                initChart1(dataQuy, dataChart1);
                            })
                            .catch(function(error) {
                                alert(error);
                            });

                        initDataChar2(yearChart2)
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
    };

    function getCurrentTime() {
        const currentTime = new Date();

        const year = currentTime.getFullYear();
        const month = String(currentTime.getMonth() + 1).padStart(2, '0');
        const day = String(currentTime.getDate()).padStart(2, '0');
        const hours = String(currentTime.getHours()).padStart(2, '0');
        const minutes = String(currentTime.getMinutes()).padStart(2, '0');
        const seconds = String(currentTime.getSeconds()).padStart(2, '0');
        const milliseconds = String(currentTime.getMilliseconds()).padStart(6, '0');

        const formattedTime = `${year}-${month}-${day} ${hours}:${minutes}:${seconds}.${milliseconds}`;
        return {
            Day: day,
            Month: month,
            Year: year,
            TimeSql: formattedTime
        };
    };

    function checkTimeInWhichQuarter(inputTime) {
        const year = inputTime.Year;
        const TimeQuy1 = getQuarterTime(year, 1);
        const TimeQuy2 = getQuarterTime(year, 2);
        const TimeQuy3 = getQuarterTime(year, 3);
        const TimeQuy4 = getQuarterTime(year, 4);

        function checkTimeBelongsToQuarter(time) {
            const quarters = [{
                    quarter: 1,
                    timeStart: TimeQuy1.timeStart,
                    timeEnd: TimeQuy1.timeEnd
                },
                {
                    quarter: 2,
                    timeStart: TimeQuy2.timeStart,
                    timeEnd: TimeQuy2.timeEnd
                },
                {
                    quarter: 3,
                    timeStart: TimeQuy3.timeStart,
                    timeEnd: TimeQuy3.timeEnd
                },
                {
                    quarter: 4,
                    timeStart: TimeQuy4.timeStart,
                    timeEnd: TimeQuy4.timeEnd
                }
            ];

            const inputTime = new Date(time);

            for (const quarter of quarters) {
                const startTime = new Date(quarter.timeStart);
                const endTime = new Date(quarter.timeEnd);

                if (inputTime >= startTime && inputTime <= endTime) {
                    return quarter.quarter;
                }
            }

            return null; // Return null if the time doesn't belong to any quarter
        };
        const quarterNumber = checkTimeBelongsToQuarter(inputTime.TimeSql);
        switch (quarterNumber) {
            case 1:
                return TimeQuy1;
                break;
            case 2:
                return TimeQuy2;
                break;
            case 3:
                return TimeQuy3;
                break;
            case 4:
                return TimeQuy4;
                break;
        };
    }

    function loadDataPhanTich() {
        return new Promise(function(resolve, reject) {
            const ThoiGianQuyHienTai = checkTimeInWhichQuarter(getCurrentTime());
            $.ajax({
                url: "./template/db_GET_thongtinphantich.php",
                type: "GET",
                data: {
                    Quy_TimeStart: ThoiGianQuyHienTai.timeStart,
                    Quy_TimeEnd: ThoiGianQuyHienTai.timeEnd
                },
                dataType: "json",
                success: function(result) {
                    resolve(result);
                },
                error: function(xhr, status, error) {
                    reject(error);
                }
            });
        })
    };

    loadDataPhanTich()
        .then(function(data) {
            // Get data
            const TotalProduct = data[0].TotalNumProduct;
            const TotalDoanhThu = data[1].TotalDoanhThu;
            const TotalOrderConfirm = data[2].TotalOrderConfirm;
            const TotalOrderCancel = data[3].TotalOrderCancel;
            const TotalAdminActive = data[4].TotalAdminActive;
            const TotalAdminInactive = data[5].TotalAdminInactive;
            const TotalClientActive = data[6].TotalClientActive;
            const TotalClientInactive = data[7].TotalClientInactive;
            // Set data
            const TongSoLuongSanPham = document.getElementById('TongSoLuongSanPham');
            TongSoLuongSanPham.textContent = formatNumberDisplay(TotalProduct);
            const DoanhThuQuyNay = document.getElementById('DoanhThuQuyNay');
            DoanhThuQuyNay.textContent = toCurrency(TotalDoanhThu);
            const SoLuongDonHangDaGiao = document.getElementById('SoLuongDonHangDaGiao');
            SoLuongDonHangDaGiao.textContent = formatNumberDisplay(TotalOrderConfirm);
            const SoLuongDonHangDaHuy = document.getElementById('SoLuongDonHangDaHuy');
            SoLuongDonHangDaHuy.textContent = formatNumberDisplay(TotalOrderCancel);
            const TotalAdminActiveText = document.getElementById('TotalAdminActive');
            TotalAdminActiveText.textContent = formatNumberDisplay(TotalAdminActive);
            const TotalAdminInactiveText = document.getElementById('TotalAdminInactive');
            TotalAdminInactiveText.textContent = formatNumberDisplay(TotalAdminInactive);
            const TotalClientActiveText = document.getElementById('TotalClientActive');
            TotalClientActiveText.textContent = formatNumberDisplay(TotalClientActive);
            const TotalClientInactiveText = document.getElementById('TotalClientInactive');
            TotalClientInactiveText.textContent = formatNumberDisplay(TotalClientInactive);
        })
        .catch(function(error) {
            console.log('error: ', error);
        });;

    // Những thứ sẽ khởi tạo đầu tiên
    initSelectYears();
    loadView();
</script>