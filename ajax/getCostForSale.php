<?php
include '../core/config.php';
$id = $_POST['barcode'];
$prod_id = getProdIdByCode($id);
echo getProdCost($prod_id);
?>