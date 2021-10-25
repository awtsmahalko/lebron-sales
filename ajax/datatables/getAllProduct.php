<?php
include '../../core/config.php';
	$result = mysql_query("SELECT * FROM tbl_product") or die (mysql_error());
	$count = 1;
	$response['data'] = array();
	while($row = mysql_fetch_array($result)){
		$list = array();
		$list['check'] = "<input type='checkbox' value='".$row['prod_id']."'>";
		$list['count'] = $count;
		$list['category'] = getCategory($row['prod_cat_id']);
		$list['qty'] = getCurrentQty($row['prod_id']);
		$list['img'] = "<img src='".getProdImg($row['prod_id'])."' width='30px' height='30px' onclick='updateProdImg(".$row['prod_id'].")' style='cursor:pointer'>";
		$list['code'] = "<a href='index.php?page=barcode&code=".$row['barcode']."' title='".$row['barcode']."' target='_blank'>".$row['barcode']."</a>";
		$list['name'] = $row['prod_name'];
		$list['desc'] = $row['prod_desc'];
		$list['cost'] = $row['cost'];
		$list['price'] = $row['price'];
		$list['action'] = "<button class='btn btn-sm btn-success' onclick='updateProduct(".$row['prod_id'].")'><span class='fa fa-edit'></span></button>";
		array_push($response['data'], $list);
	$count++;
	}
	echo json_encode($response);
?>