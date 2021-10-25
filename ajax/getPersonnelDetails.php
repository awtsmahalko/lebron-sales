<?php
include '../core/config.php';
if(isset($_POST["id"]) && isset($_POST["id"]) != ""){
	$id = $_POST['id'];
	
	$query = "SELECT * FROM tbl_personnel WHERE personnel_id = '$id'";
	$result = mysql_query($query) or die(mysql_error());
	$response = array();
	
	if(mysql_num_rows($result) > 0){
		while ($row = mysql_fetch_assoc($result)) {
            $response = $row;
		}
	}else
    {
        $response['status'] = 200;
        $response['message'] = "Data not found!";
    }
    echo json_encode($response);
}
?>