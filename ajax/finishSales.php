<?php
include '../core/config.php';
	$sales_number = clean($_POST['delivery_id']);
	$status = 1;

	$check_details = mysql_fetch_array(mysql_query("SELECT count(sales_detail_id) FROM tbl_sales_detail WHERE sales_number='$sales_number'"));
	if($check_details[0] > 0){
		$fetch_prod = mysql_query("SELECT * FROM tbl_sales_detail WHERE sales_number='$sales_number'");
		$checker_all_finish = 0;
		while($row_prod = mysql_fetch_array($fetch_prod)){
			$prod_id = $row_prod['prod_id'];
			$qty = $row_prod['qty'];
			$current_qty = getCurrentQty($prod_id);
			if($current_qty >= $qty){
				$checker_all_finish += 0;
			}else{
				$checker_all_finish += 1;
			}
		}
		if($checker_all_finish > 0){
			echo "Cannot Finish Delivery! Insufficient quantity";
		}else{
			mysql_query("UPDATE tbl_sales_detail SET status=1 WHERE sales_number='$sales_number'");
			$query = mysql_query("UPDATE tbl_sales_header SET sales_status=1 WHERE sales_number='$sales_number'");
			if($query){
				echo 1;
			}else{
				echo "Error while saving product!";
			}
		}
	}else{
		echo 2;
	}
?>