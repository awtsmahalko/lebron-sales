<?php
include '../core/config.php';
	$user_id = $_POST['id'];
	$user_status = $_POST['status'];

	$query = mysql_query("UPDATE `tbl_user` SET `user_status` = '$user_status' WHERE `user_id` = '$user_id'");
	if($query){
		echo "Account Successfully Updated";
	}else{
		echo "Error while saving product!";
	}
?>