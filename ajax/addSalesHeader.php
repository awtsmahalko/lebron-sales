<?php
include '../core/config.php';
$sales_number = $_POST['delivery_number'];
$date = date('Y-m-d',strtotime($_POST['date']));
$customer = $_POST['customer_id'];
$remarks = $_POST['remarks'];
$cashier = $_SESSION['account_id'];
$date_added = date('Y-m-d H:i:s');
$query = mysql_query("INSERT INTO `tbl_sales_header` (`sales_header_id`, `sales_number`, `customer`, `sales_date`, `remark`, `date_added`, `user_id`, `sales_status`) VALUES (NULL, '$sales_number', '$customer', '$date', '$remarks', '$date_added', '$cashier', '0')");
if($query){
	echo 1;
}else{
	echo "Error while saving!";
}
?>