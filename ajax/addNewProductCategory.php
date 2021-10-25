<?php
include '../core/config.php';
	$cat_name = clean($_POST['cat_name']);
	$cat_desc = clean($_POST['cat_desc']);
	$cat_status = 1;
	
	$check_dup = mysql_fetch_array(mysql_query("SELECT count(prod_cat_id) FROM tbl_product_category WHERE cat_name='$cat_name'"));
	if($check_dup[0] > 0){
		echo "Category already exist!";
	}else{
		$query = mysql_query("INSERT INTO `tbl_product_category` (`prod_cat_id`, `cat_name`, `cat_desc`, `cat_status`) VALUES (NULL, '$cat_name', '$cat_desc', '$cat_status')");
			if($query){
				echo 1;
			}else{
				echo "Error while saving category!";
			}
	}
?>