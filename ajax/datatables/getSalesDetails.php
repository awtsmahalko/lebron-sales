<?php
include '../../core/config.php';
$delivery_id = $_POST['delivery_id'];

$result = mysql_query("SELECT * from tbl_sales_detail where sales_number='$delivery_id' order by sales_detail_id DESC") or die (mysql_error());
$count = 1;
$response['data'] = array();
	while($row = mysql_fetch_array($result)){
		
		$list = array();
		
		$list['id'] = $row['sales_detail_id'];
		$list['count'] = $count++;
		$list['check'] = "<input type='checkbox' value='".$row['sales_detail_id']."'>";
		$list['item'] = getProdNameDescById($row['prod_id']);
		$list['qty'] = $row['qty'];
		$list['price'] = $row['price'];
		$list['discount'] = $row['discount'];
		$list['amount'] = number_format($row['amount'],2);
		array_push($response['data'],$list);
	}
	
	echo json_encode($response);
?>