<?php
include '../core/config.php';
$id = $_POST['id'];
foreach($id as $id){
	$query  = mysql_query("DELETE FROM tbl_sales_detail WHERE sales_detail_id = $id");
}
if($query){
	echo 1;
}else{
	echo 0;
}
?>