<?php
include '../core/config.php';
	$prod_id = $_POST['prod_id'];
	$cost = $_POST['cost'];
	$qty = $_POST['qty'];
	$date = $_POST['date'];
	$date = date("Y-m-d", strtotime($date));
	$status = 1;

	$newCost = averageCost($prod_id,$qty,$cost);

	$query = mysql_query("INSERT INTO `tbl_receive` (`prod_id`, `cost`, `qty`, `date`, `rec_status`) VALUES ('$prod_id', '$cost', '$qty', '$date', '$status')");
	if($query){
		mysql_query("UPDATE tbl_product SET cost='$newCost' WHERE prod_id = $prod_id");
		echo 1;
	}else{
		echo "Error while saving product!";
	}
?>