<?php
include 'config.php';

$user_id = $_REQUEST['user_id'];
$barcode = $_REQUEST['barcode'];

$response = array();

$barcode_query = mysql_query("SELECT * from tbl_product prod,tbl_user user where prod.barcode = '$barcode' and user.user_id = '$user_id'");
$count_barcode = mysql_num_rows($barcode_query);
if($count_barcode>0){
	
	$delete_query ="DELETE from tbl_scan where user_id = '$user_id'";
	
	if(mysql_query($delete_query)){
	
		$insert_query = "INSERT INTO `tbl_scan` (`scan_id`, `barcode`, `user_id`) VALUES (NULL, '$barcode', '$user_id')";
	
		if(mysql_query($insert_query)){
	
			$get_scanned_detail_query = mysql_query("SELECT * from tbl_product where barcode = '$barcode'");
			$fetch_details = mysql_fetch_array($get_scanned_detail_query);
	
			$response['status'] = "1";
			$response['barcode'] = $fetch_details['barcode'];
			$response['prod_name'] = $fetch_details['prod_name']; 
			$response['prod_desc'] = $fetch_details['prod_desc'];
			$response['prod_img'] = $fetch_details['prod_img'];
			$response['price'] = number_format($fetch_details['price'],2);
	
		}else{
			$response['status'] = "0";
		}

	}else{
		$response['status'] = "0";
	}
}else{
	$response['status'] = "0";
}
echo json_encode($response);
?>
