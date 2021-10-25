<?php
include '../core/config.php';
	$prod_name = clean($_POST['u_prod_name']);
	$prod_id = $_POST['u_prod_id'];
	$prod_cat_id = $_POST['u_prod_cat_id'];
	$prod_desc = clean($_POST['u_prod_desc']);
	$price = $_POST['u_price'];

	$query = mysql_query("UPDATE `tbl_product` SET `prod_cat_id` = '$prod_cat_id', `prod_name`='$prod_name', `prod_desc`='$prod_desc', `price`='$price' WHERE `prod_id` = '$prod_id'");
	if($query){
		echo "Product Successfully Updated";
	}else{
		echo "Error while saving product!";
	}
?>