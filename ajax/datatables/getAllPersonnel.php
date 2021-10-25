<?php
include '../../core/config.php';
	$result = mysql_query("SELECT * FROM tbl_personnel WHERE personnel_id != '1' AND personnel_status != 2") or die (mysql_error());
	$count = 1;
	$response['data'] = array();
	while($row = mysql_fetch_array($result)){
		$list = array();
		if($row['personnel_status'] == 1){
			$status = "<font color='green'>Active</font>";
			//$action ="<button class='btn btn-sm btn-danger'><span class='fa fa-edit'></span> Deactivate</button>";
		}else{
			$status = "<font color='red'>Inactive</font>";
			//$action ="<button class='btn btn-sm btn-primary'><span class='fa fa-edit'></span> Activate</button>";
		}
		if($row['personnel_type'] == 0){
			$type = "Admin";
		}else{
			$type = "Cashier";
		}
		$update ="<button class='btn btn-sm btn-success' onclick='updatePersonnel(".$row['personnel_id'].")'><span class='fa fa-edit'></span></button>";
		$list['check'] = "<input type='checkbox' value='".$row['personnel_id']."'>";
		$list['count'] = $count;
		$list['personnel'] = $row['personnel_name'];
		$list['address'] = $row['personnel_address'];
		$list['bdate'] = date("M d, Y",strtotime($row['personnel_bdate']));
		$list['type'] = $type;
		$list['status'] = $status;
		$list['action'] = $update;
		array_push($response['data'], $list);
	$count++;
	}
	echo json_encode($response);
?>