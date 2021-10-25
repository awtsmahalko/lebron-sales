<?php
$num = $_POST['num'];
$barcode = $_POST['barcode'];
$count = 1;
while($count <= $num){
?>
<img alt="<?php echo $barcode?>" src="barcode.php?codetype=Code39&size=40&text=<?php echo $barcode?>&print=true" />
<?php $count++; } ?>