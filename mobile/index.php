<?php
include 'config.php';
function getForwardProfit(){
	$date = date("Y-m-d");
	$fetch_h = mysql_query("SELECT sales_number FROM tbl_sales_header WHERE sales_date < '$date' AND sales_status = 1");
	$ini_profit = 0;
	while($row_h = mysql_fetch_array($fetch_h)){
		$ini_profit += getSalesNumberCost($row_h[0]);
	}
	$profit = getForwardSales() - $ini_profit;
	return $profit;
}
function getTodayProfit(){
	$date = date("Y-m-d");
	$fetch_h = mysql_query("SELECT sales_number FROM tbl_sales_header WHERE sales_date='$date' AND sales_status = 1");
	$ini_profit = 0;
	while($row_h = mysql_fetch_array($fetch_h)){
		$ini_profit += getSalesNumberCost($row_h[0]);
	}
	$profit = getTodaySales() - $ini_profit;
	return $profit;
}
function getSalesNumberCost($number){
	$fetch = mysql_query("SELECT * FROM tbl_sales_detail WHERE sales_number = '$number'");
	$amount = 0;
	while($row = mysql_fetch_array($fetch)){
		$row_d = mysql_fetch_array(mysql_query("SELECT * FROM tbl_sales_detail WHERE sales_detail_id = '".$row['sales_detail_id']."'"));
		$prod_cost = getProdCost($row_d['prod_id']) * $row_d['qty'];
		$amount += $prod_cost;
	}
	return $amount;
}
function getForwardSales(){
	$date = date("Y-m-d");
	$fetch_h = mysql_query("SELECT sales_number FROM tbl_sales_header WHERE sales_date < '$date' AND sales_status = 1");
	$sales = 0;
	while($row_h = mysql_fetch_array($fetch_h)){
		$detail = mysql_fetch_array(mysql_query("SELECT sum(amount) FROM tbl_sales_detail WHERE sales_number = '".$row_h[0]."'"));
		$sales += $detail[0];
	}
	return $sales;
}
function getTodaySales(){
	$date = date("Y-m-d");
	$fetch_h = mysql_query("SELECT sales_number FROM tbl_sales_header WHERE sales_date='$date' AND sales_status = 1");
	$sales = 0;
	while($row_h = mysql_fetch_array($fetch_h)){
		$detail = mysql_fetch_array(mysql_query("SELECT sum(amount) FROM tbl_sales_detail WHERE sales_number = '".$row_h[0]."'"));
		$sales += $detail[0];
	}
	return $sales;
}
function getProdCost($id){
	$fetch = mysql_fetch_array(mysql_query("SELECT cost FROM tbl_product WHERE prod_id = '$id'"));
	return $fetch[0];
}
?>
<!DOCTYPE HTML>
<html>

<head>
    <title>Sales</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE-Edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600,800" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700" rel="stylesheet">

    <!-- PAGE LEVEL STYLESHEETS -->
    <link rel="stylesheet" href="../lib/css/jquery.dataTables.min.css">
    <!-- /PAGE LEVEL STYLESHEETS -->
    <!-- PAGE LEVEL STYLESHEETS -->
    <link rel="stylesheet" href="../lib/css/classic.css">
    <link rel="stylesheet" href="../lib/css/classic.date.css">
    <!-- /PAGE LEVEL STYLESHEETS -->
    <!-- DEFAULT STYLESHEETS -->
    <link rel="stylesheet" href="../assets/css/bootstrap.css">
    <link rel="stylesheet" href="../assets/css/core.css">
    <link rel="stylesheet" href="../assets/css/components.css">
    <link rel="stylesheet" href="../assets/icons/fontawesome/styles.min.css">
    <!-- /DEFAULT STYLESHEETS -->

    <script type="text/javascript" src="../lib/js/jquery.min.js"></script>
    <script type="text/javascript" src="../lib/js/tether.min.js"></script>
    <script type="text/javascript" src="../lib/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="../assets/js/app.min.js"></script>

    <!-- PAGE LEVEL SCRIPTS -->
    <script type="text/javascript" src="../lib/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="../assets/js/pages_datatables.min.js"></script>
    <script type="text/javascript" src="../lib/js/picker.js"></script>
    <script type="text/javascript" src="../lib/js/picker.date.js"></script>
    <script type="text/javascript" src="../assets/js/pickers_date.min.js"></script>
</head>

<body>
    <!-- NAVBAR -->
    <nav class="navbar navbar-toggleable-md">
        <a class="navbar-brand logo" href="#">
            <img src="../assets/img/logo1.png">
        </a>
    </nav>
    <!-- /NAVBAR -->

    <div class="page-container">
        <div class="page-content">
            <!-- inject:SIDEBAR -->

            <!-- inject:/SIDEBAR -->

            <!-- PAGE CONTENT -->
    <link rel="stylesheet" href="../lib/css/chartist.min.css">
    <script type="text/javascript" src="../lib/js/chartist.min.js"></script>
			<div class="content-wrapper">
                <div class="content">
                    <div class="row">
                        <div class="col-md-12">
                            <h3 class="page-title">Libron <small>Sales Monitoring System</small></h3>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-3 col-xs-6">
                            <div class="widget-overview bg-primary-1">
                                <div class="inner">
                                    <h2>&#x20B1;&nbsp;<?php echo number_format(getTodaySales(),2); ?></h2>
                                    <p>Sales Today</p>
                                </div>

                                <div class="icon">
                                    <i>&#x20B1;</i>
                                </div>

                                <div class="details bg-primary-3">
                                    <span>View Details <i class="fa fa-arrow-right"></i></span>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3 col-xs-6">
                            <div class="widget-overview bg-info-1">
                                <div class="inner">
                                    <h2>&#x20B1;&nbsp;<?php echo number_format(getTodayProfit(),2); ?></h2>
                                    <p>Profit Today</p>
                                </div>

                                <div class="icon">
                                    <i class="fa fa-money"></i>
                                </div>

                                <div class="details bg-primary-3">
                                    <span>View Details <i class="fa fa-arrow-right"></i></span>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3 col-xs-6">
                            <div class="widget-overview bg-success-1">
                                <div class="inner">
                                    <h2>&#x20B1;&nbsp;<?php echo number_format(getForwardSales(),2); ?></h2>
                                    <p>Sales Forwarded</p>
                                </div>

                                <div class="icon">
                                    <i>&#x20B1;</i>
                                </div>

                                <div class="details bg-primary-3">
                                    <span>View Details <i class="fa fa-arrow-right"></i></span>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3 col-xs-6">
                            <div class="widget-overview bg-danger-1">
                                <div class="inner">
                                    <h2>&#x20B1;&nbsp;<?php echo number_format(getForwardProfit(),2); ?></h2>
                                    <p>Profit Forwarded</p>
                                </div>

                                <div class="icon">
                                    <i class="fa fa-money"></i>
                                </div>

                                <div class="details bg-primary-3">
                                    <span>View Details <i class="fa fa-arrow-right"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row margin-top-10">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-block">
                                    <h5 class="card-title">Annual Sales Overview</h5>
										Legend : <badge class="badge badge-primary" width='5px'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</badge> Sales
										<badge style='background-color: #65a6cc;' width='5px'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</badge> Profit
                                </div>
                                <div class="ct-chart-dashboard height-250 ct-chart-blue"></div>
                            </div>
                        </div>
					</div>
                </div>
            </div>
    <script type="text/javascript">
        $(function() {
            // Dashboard Sales Chart
            // ------------------------------------------------------------------

            var dataMain = {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                series: [
                    [5, 4, 3, 7, 5, 10, 3, 4, 8, 10, 6, 8],
                    [3, 2, 9, 5, 4, 6, 4, 6, 7, 8, 7, 4]
                ]
            };

            var optionsMain = {
                seriesBarDistance: 10
            };

            var responsiveOptionsMain = [
                ['screen and (max-width: 640px)', {
                    seriesBarDistance: 5,
                    axisX: {
                        labelInterpolationFnc: function (value) {
                            return value[0];
                        }
                    }
                }]
            ];
            var chart = new Chartist.Bar('.ct-chart-dashboard', dataMain, optionsMain, responsiveOptionsMain);
        });
    </script>
            <!-- /PAGE CONTENT -->
        </div>
    </div>
</body>

</html>