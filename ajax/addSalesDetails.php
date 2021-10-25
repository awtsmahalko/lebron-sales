<?php
include '../core/config.php';
$prod_id = getProdIdByCode($_POST['barcode']);
$price = getProdPrice($prod_id);
$sales_number = $_POST['dr_number'];
$qty = $_POST['qty'];
$discount = $_POST['discount'];

$discount_price = $price * ($discount/100);
$cost = getProdCost($prod_id);

$current_qty = getCurrentQty($prod_id);
$amount = $qty * ( $price - $discount_price);
if($current_qty >= $qty){
	$check_dup = mysql_fetch_array(mysql_query("SELECT count(sales_detail_id),qty,amount FROM tbl_sales_detail WHERE sales_number = '$sales_number' AND prod_id = '$prod_id'"));
	if($check_dup[0] > 0){
		$com_qty = $check_dup[1] + $qty;
		$new_amt = $check_dup[2] + $amount;
		if($current_qty >= $com_qty){
			$query = mysql_query("UPDATE tbl_sales_detail SET qty = '$com_qty', discount = '$discount', amount = '$new_amt' WHERE sales_number = '$sales_number' AND prod_id = '$prod_id'");
			if($query){
				echo 1;
			}else{
				echo "Error while saving!";
			}
		}else{
			echo 2;
		}
	}else{
		$query = mysql_query("INSERT INTO `tbl_sales_detail` (`sales_detail_id`, `sales_number`, `prod_id`, `cost`, `qty`, `price`, `discount`, `amount`, `status`) VALUES (NULL, '$sales_number', '$prod_id', '$cost', '$qty', '$price', '$discount', '$amount', '0')");
		if($query){
			echo 1;
		}else{
			echo "Error while saving!";
		}
	}
}else{
	echo 2;
}
deleteScannedItems();
?>