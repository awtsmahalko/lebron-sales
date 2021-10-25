<?php
include '../../core/config.php';
	$result = mysql_query("SELECT * FROM tbl_receive") or die (mysql_error());
	$count = 1;
	$response['data'] = array();
	while($row = mysql_fetch_array($result)){
		$list = array();
		$list['check'] = "<input type='checkbox' value='".$row['rec_id']."'>";
		$list['count'] = $count;
		$list['prod'] = getProdNameDescById($row['prod_id']);
		$list['cat'] = getCategoryByProd($row['prod_id']);
		$list['cost'] = number_format($row['cost'],2);
		$list['qty'] = $row['qty'];
		$list['date'] = date("M d, Y", strtotime($row['date']));
		$list['action'] = "<button class='btn btn-sm btn-success'><span class='fa fa-edit'></span></button>";
		array_push($response['data'], $list);
	$count++;
	}
	echo json_encode($response);
?>