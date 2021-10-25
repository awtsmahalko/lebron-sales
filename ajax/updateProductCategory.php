<?php
include '../core/config.php';
	$cat_name = clean($_POST['u_cat_name']);
	$prod_cat_id = $_POST['u_prod_cat_id'];
	$cat_desc = clean($_POST['u_cat_desc']);
	$cat_status = 1;
	
	$query = mysql_query("UPDATE `tbl_product_category` SET `cat_name`='$cat_name', `cat_desc`='$cat_desc' WHERE `prod_cat_id` = '$prod_cat_id'");
	if($query){
		echo "Category Successfully Updated!";
	}else{
		echo "Error while saving category!";
	}
?>