<?php
include '../core/config.php';
	$sales_number = $_POST['delivery_id'];
	$fetch = mysql_fetch_array(mysql_query("SELECT sum(amount) FROM tbl_sales_detail WHERE sales_number='$sales_number'"));
	
	echo $fetch[0];