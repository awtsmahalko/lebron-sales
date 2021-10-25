<?php
include '../core/config.php';
	$prod_name = clean($_POST['prod_name']);
	$prod_cat_id = $_POST['prod_cat_id'];
	$prod_desc = clean($_POST['prod_desc']);
	$price = $_POST['price'];
	$prod_status = 1;
	
	$barcode = strtoupper(substr($prod_name,0,2))."".date("His");

	$check_dup = mysql_fetch_array(mysql_query("SELECT count(prod_id) FROM tbl_product WHERE prod_name='$prod_name' AND prod_desc = '$prod_desc'"));
	if($check_dup[0] > 0){
		echo "Product Name already exist!";
	}else{
		$query = mysql_query("INSERT INTO `tbl_product` (`prod_id`, `barcode`, `prod_cat_id`, `prod_name`, `prod_desc`, `prod_img`, `price`, `prod_status`) VALUES (NULL, '$barcode', '$prod_cat_id', '$prod_name', '$prod_desc', 'default.png', '$price', '$prod_status')");
			if($query){
				echo 1;
			}else{
				echo "Error while saving product!";
			}
	}
?>