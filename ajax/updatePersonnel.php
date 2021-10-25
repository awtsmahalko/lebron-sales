<?php
include '../core/config.php';
	$personnel_name = clean($_POST['update_personnel_name']);
	//$user_type = $_POST['update_user_type'];
	$personnel_address = $_POST['update_personnel_address'];
	$personnel_bdate = date("Y-m-d",strtotime($_POST['update_personnel_bdate']));
	$personnel_id = $_POST['update_personnel_id'];

	$query = mysql_query("UPDATE `tbl_personnel` SET `personnel_name` = '$personnel_name', `personnel_address`='$personnel_address', `personnel_bdate`='$personnel_bdate' WHERE `personnel_id` = '$personnel_id'");
	if($query){
		echo "Personnel Successfully Updated";
	}else{
		echo "Error while saving product!";
	}
?>