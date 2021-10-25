<option value=''>--Please Select--</option>
<?php
include '../core/config.php';
$prod_cat_id = $_POST['cat'];
$fetch = mysql_query("SELECT * FROM tbl_product WHERE prod_cat_id = $prod_cat_id");
while($row = mysql_fetch_array($fetch)){
if($row['prod_desc'] != ''){
	$desc = " (".$row['prod_desc'].")";
}else{
	$desc = "";
}
?>
<option value='<?php echo $row['prod_id'];?>'><?php echo $row['prod_name']."".$desc;?></option>
<?php } ?>