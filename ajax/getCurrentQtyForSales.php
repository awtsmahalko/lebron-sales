<?php
include '../core/config.php';
$id = $_POST['barcode'];
$prod_id = getProdIdByCode($id);
echo getCurrentQty($prod_id);
?>