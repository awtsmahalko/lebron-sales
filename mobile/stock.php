<?php
include 'config.php';
function getCurrentQty($prod){
	$fetch_inv = mysql_fetch_array(mysql_query("SELECT sum(qty) FROM tbl_receive WHERE prod_id = '$prod'"));
	$fetch_sales = mysql_fetch_array(mysql_query("SELECT sum(qty) FROM tbl_sales_detail WHERE prod_id = '$prod' AND status = 1"));
	return $fetch_inv[0] - $fetch_sales[0];
}
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
						<?php
							$fetch = mysql_query("SELECT * FROM tbl_product");
							while($row = mysql_fetch_array($fetch)){
						?>
							<div class="col-lg-3 col-xs-6">
								<div class="widget-overview bg-primary-2">
									<div class="inner">
									<p style='float:right;align:right;word-wrap:break-word'>
										Prod : <i><?php echo $row['prod_name']; ?></i><br>
										Desc: <i><?php echo substr($row['prod_desc'],0,13); ?></i><br>
										Cost: <i><?php echo $row['cost']; ?></i><br>
										SRP: <i><?php echo $row['price']; ?></i><br>
										Qty: <i><?php echo getCurrentQty($row['prod_id']); ?></i><br>
									</p>
										<h2><img src='../upload/<?php echo $row['prod_img']; ?>' style='border-radius: 50%;' width='120px' height='120px'></h2>
									</div>

									<div class="details bg-primary-3">
										<span>View Details <i class="fa fa-arrow-right"></i></span>
									</div>
								</div>
							</div>
						<?php } ?>
                    </div>
                </div>
            </div>
            <!-- /PAGE CONTENT -->
        </div>
    </div>
</body>

</html>