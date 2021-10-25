<?php
function countCashierEncode($id){
	$fetch = mysql_fetch_array(mysql_query("SELECT count(user_id) FROM tbl_sales_header WHERE user_id = $id "));
	return $fetch[0];
}
function countCatProd($id){
	$count = mysql_fetch_array(mysql_query("SELECT count(prod_id) FROM tbl_product WHERE prod_cat_id = $id "));
	return $count[0];
}

//Start Delete Functions
function deletePersonnel($id){
	$count = countCashierEncode($id);
	if($count > 0){
		$query = mysql_query("UPDATE tbl_personnel SET personnel_status = 2 WHERE personnel_id = $id");
	}else{
		$query = mysql_query("DELETE FROM tbl_personnel WHERE personnel_id = $id");
	}
	if($query){
		mysql_query("DELETE FROM tbl_user WHERE account_id = $id");
	}
}
function deleteProduct($id){
	$img = getProdImg($id);
	$receive = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM `tbl_receive` WHERE prod_id='$id'"));
	$sales = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM `tbl_sales_detail` WHERE prod_id='$id'"));
	$exist = $receive[0] + $sales[0];
	if($exist > 0){
	}else{
		mysql_query("DELETE FROM tbl_product WHERE prod_id='$id'");
		if($img != "upload/default.png"){
			unlink("../".$img);
		}
	}
}
function deleteSales($id){
	$fetch_sales = mysql_fetch_array(mysql_query("SELECT * FROM tbl_sales_header WHERE sales_header_id = '$id'"));
	if($fetch_sales['sales_status'] == 1){
	}else{
		mysql_query("DELETE FROM tbl_sales_detail WHERE sales_number = '".$fetch_sales['sales_number']."'");
		mysql_query("DELETE FROM tbl_sales_header WHERE sales_number = '".$fetch_sales['sales_number']."'");
	}
}
function deleteReceive($id){
	mysql_query("DELETE FROM tbl_receive WHERE rec_id='$id'");
}
function deleteProductCategory($id){
	$count = countCatProd($id);
	if($count > 0){
	}else{
		mysql_query("DELETE FROM tbl_product_category WHERE prod_cat_id='$id'");
	}
}
function deleteScannedItems(){
	mysql_query("DELETE FROM tbl_scan WHERE user_id='".$_SESSION['user_id']."'");
}
//End Delete Functions

//Start GET functions
function getForwardProfit(){
	$date = date("Y-m-d");
	$fetch_h = mysql_query("SELECT sales_number FROM tbl_sales_header WHERE sales_date < '$date' AND sales_status = 1");
	$ini_profit = 0;
	while($row_h = mysql_fetch_array($fetch_h)){
		$ini_profit += getSalesNumberCost($row_h[0]);
	}
	$profit = getForwardSales() - $ini_profit;
	return $profit;
}
function getTodayProfit(){
	$date = date("Y-m-d");
	$fetch_h = mysql_query("SELECT sales_number FROM tbl_sales_header WHERE sales_date='$date' AND sales_status = 1");
	$ini_profit = 0;
	while($row_h = mysql_fetch_array($fetch_h)){
		$ini_profit += getSalesNumberCost($row_h[0]);
	}
	$profit = getTodaySales() - $ini_profit;
	return $profit;
}
function getSalesNumberCost($number){
	$fetch = mysql_query("SELECT * FROM tbl_sales_detail WHERE sales_number = '$number'");
	$amount = 0;
	while($row = mysql_fetch_array($fetch)){
		$row_d = mysql_fetch_array(mysql_query("SELECT * FROM tbl_sales_detail WHERE sales_detail_id = '".$row['sales_detail_id']."'"));
		$prod_cost = $row_d['cost'] * $row_d['qty'];
		$amount += $prod_cost;
	}
	return $amount;
}
function getForwardSales(){
	$date = date("Y-m-d");
	$fetch_h = mysql_query("SELECT sales_number FROM tbl_sales_header WHERE sales_date < '$date' AND sales_status = 1");
	$sales = 0;
	while($row_h = mysql_fetch_array($fetch_h)){
		$detail = mysql_fetch_array(mysql_query("SELECT sum(amount) FROM tbl_sales_detail WHERE sales_number = '".$row_h[0]."'"));
		$sales += $detail[0];
	}
	return $sales;
}
function getTodaySales(){
	$date = date("Y-m-d");
	$fetch_h = mysql_query("SELECT sales_number FROM tbl_sales_header WHERE sales_date='$date' AND sales_status = 1");
	$sales = 0;
	while($row_h = mysql_fetch_array($fetch_h)){
		$detail = mysql_fetch_array(mysql_query("SELECT sum(amount) FROM tbl_sales_detail WHERE sales_number = '".$row_h[0]."'"));
		$sales += $detail[0];
	}
	return $sales;
}
function getCategory($id){
	$count = mysql_fetch_array(mysql_query("SELECT cat_name FROM tbl_product_category WHERE prod_cat_id = $id "));
	return $count[0];
}
function getCategIdByProd($id){
	$count = mysql_fetch_array(mysql_query("SELECT prod_cat_id FROM tbl_product WHERE prod_id = $id "));
	return $count[0];
}
function getCategoryByProd($id){
	$prod_cat_id = getCategIdByProd($id);
	$count = mysql_fetch_array(mysql_query("SELECT cat_name FROM tbl_product_category WHERE prod_cat_id = $prod_cat_id "));
	return $count[0];
}
function getProdNameDescByCode($id){
	$fetch = mysql_fetch_array(mysql_query("SELECT prod_name,prod_desc FROM tbl_product WHERE barcode = '$id' "));
	if($fetch[1] != ''){
		$desc = " (".$fetch[1].")";
	}else{
		$desc = "";
	}
	return $fetch[0]."".$desc;
}
function getProdIdByCode($id){
	$fetch = mysql_fetch_array(mysql_query("SELECT prod_id FROM tbl_product WHERE barcode = '$id' "));
	return $fetch[0];
}
function getProdNameDescById($id){
	$fetch = mysql_fetch_array(mysql_query("SELECT prod_name,prod_desc FROM tbl_product WHERE prod_id = '$id' "));
	if($fetch[1] != ''){
		$desc = " (".$fetch[1].")";
	}else{
		$desc = "";
	}
	return $fetch[0]."".$desc;
}
function getProdPrice($id){
	$fetch = mysql_fetch_array(mysql_query("SELECT price FROM tbl_product WHERE prod_id = '$id'"));
	return $fetch[0];
}
function getProdCost($id){
	$fetch = mysql_fetch_array(mysql_query("SELECT cost FROM tbl_product WHERE prod_id = '$id'"));
	return $fetch[0];
}
function getCurrentQty($prod){
	$fetch_inv = mysql_fetch_array(mysql_query("SELECT sum(qty) FROM tbl_receive WHERE prod_id = '$prod'"));
	$fetch_sales = mysql_fetch_array(mysql_query("SELECT sum(qty) FROM tbl_sales_detail WHERE prod_id = '$prod' AND status = 1"));
	return $fetch_inv[0] - $fetch_sales[0];
}
function averageCost($prod,$qty,$cost){
	$oldCost = getProdCost($prod);
	$oldQty = getCurrentQty($prod);

	$oldAmt = $oldCost * $oldQty;
	$newAmt = $qty * $cost;
	$totalQty = $oldQty + $qty;
	$totalAmount = $oldAmt + $newAmt;
	
	$averageCost = $totalAmount / $totalQty;
	return $averageCost;
}
function getDetailsItem($num){
	$fetch = mysql_fetch_array(mysql_query("SELECT COUNT(sales_detail_id) FROM tbl_sales_detail WHERE sales_number = '$num'"));
	return $fetch[0];
}
function getDetailsAmount($num){
	$fetch = mysql_fetch_array(mysql_query("SELECT SUM(amount) FROM tbl_sales_detail WHERE sales_number = '$num'"));
	return $fetch[0];
}
function getEncoderName($id){
	$fetch = mysql_fetch_array(mysql_query("SELECT personnel_name FROM tbl_personnel WHERE personnel_id = '$id'"));
	return $fetch[0];
}
function getProdImg($id){
	$fetch = mysql_fetch_array(mysql_query("SELECT prod_img FROM tbl_product WHERE prod_id = '$id'"));
	return "upload/".$fetch[0];
}
function deletePhoto($img){
	if($img != "upload/default.png"){
		unlink("../".$img);
	}
}
//End GET functions

?>