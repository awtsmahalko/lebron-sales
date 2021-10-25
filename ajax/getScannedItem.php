<?php
include '../core/config.php';

$fetch = mysql_fetch_array(mysql_query("SELECT barcode FROM tbl_scan WHERE user_id='".$_SESSION['user_id']."'"));
echo $fetch[0];