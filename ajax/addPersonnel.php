<?php
include '../core/config.php';
	$personnel_name = clean($_POST['personnel_name']);
	$personnel_address = clean($_POST['personnel_address']);
	$personnel_bdate = date("Y-m-d",strtotime($_POST['personnel_bdate']));
	$personnel_type = $_POST['user_type'];
	$username = $_POST['username'];
	$password = md5($_POST['password']);
	$personnel_status = 1;
	$date_added = date("Y-m-d H:i:s");
	$query = mysql_query("INSERT INTO `tbl_personnel` (`personnel_id`, `personnel_name`, `personnel_address`, `personnel_bdate`, `personnel_type`, `personnel_status`) VALUES (NULL, '$personnel_name', '$personnel_address', '$personnel_bdate', '$personnel_type', '$personnel_status')");
	$account_id = mysql_insert_id();
		if($query){
			echo 1;
			mysql_query("INSERT INTO `tbl_user` (`user_id`, `username`, `password`, `user_type`, `account_id`, `user_status`, `date_added`) VALUES (NULL, '$username', '$password', '$personnel_type', '$account_id', '1', '$date_added')");
		}else{
			echo "Error while saving product!";
		}
?>