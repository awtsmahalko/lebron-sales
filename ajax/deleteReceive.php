<?php
include '../core/config.php';
$id = $_POST['id'];
foreach($id as $id){
	deleteReceive($id);
}
?>