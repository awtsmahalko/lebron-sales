<?php
include '../../core/config.php';
	$result = mysql_query("SELECT * FROM tbl_sales_header") or die (mysql_error());
	$count = 1;
	$response['data'] = array();
	while($row = mysql_fetch_array($result)){
		$list = array();
		if($row['sales_status'] == 1){
			$list['check'] = "";
			$status = "<font color='green'>Finished</font>";
		}else{
			$list['check'] = "<input type='checkbox' value='".$row['sales_header_id']."'>";
			$status = "<font color='red'>Saved</font>";
		}
		$list['count'] = $count;
		$list['detail'] = "<button style='cursor:pointer' onclick='window.location = \"index.php?page=view-sales&id=".$row['sales_number']."\"'><span class='fa fa-list'></span></button>";
		$list['number'] = $row['sales_number'];
		$list['cust'] = $row['customer'];
		$list['cashier'] = getEncoderName($row['user_id']);
		$list['date'] = date("M d, Y", strtotime($row['sales_date']));
		$list['remark'] = $row['remark'];
		$list['item'] = getDetailsItem($row['sales_number']);
		$list['amount'] = getDetailsAmount($row['sales_number']);
		$list['status'] = $status;
		array_push($response['data'], $list);
	$count++;
	}
	echo json_encode($response);
?>