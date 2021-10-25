<?php
include '../../core/config.php';
	$result = mysql_query("SELECT * FROM `tbl_product_category`") or die (mysql_error());
	$count = 1;
	$response['data'] = array();
	while($row = mysql_fetch_array($result)){
		$list = array();

		$list['check'] = "<input type='checkbox' value='".$row['prod_cat_id']."'>";
		$list['count'] = $count;
		$list['name'] = $row['cat_name'];
		$list['desc'] = $row['cat_desc'];
		$list['prod'] = countCatProd($row['prod_cat_id']);
		$list['action'] = "<button class='btn btn-sm btn-success' onclick='updateProductCategory(".$row['prod_cat_id'].")'><span class='fa fa-edit'></span></button>";
		array_push($response['data'], $list);
	$count++;
	}
	echo json_encode($response);
?>