<?php 

include 'config.php';

$username= $_POST['username'];
$password= md5($_POST['password']);

$response = array();
/*
$query_user = mysqli_query($con,"SELECT * FROM `tbl_user` WHERE `username`='$username' and password = '$password'");
$count = mysqli_num_rows($query_user);
if($count>0){
$fetch_user = mysqli_fetch_array($query_user);
	$response['response']="login success";
	$response['status']="1";
	$response['user_id']=$fetch_user['user_id'];
}else{
	$response['response']="login failed";
	$response['status']="0";
}
*/
$query_user = mysql_query("SELECT * FROM `tbl_user` WHERE `username`='$username' AND password = '$password' AND `user_status` !=0");
$count = mysql_num_rows($query_user);
if($count > 0 ){
$fetch_user = mysql_fetch_array($query_user);
	$response['response']="login success";
	$response['status']="1";
	$response['user_id']=$fetch_user['user_id'];
}else{
	$response['response']="login failed";
	$response['status']="0";
}
echo json_encode($response);
?>