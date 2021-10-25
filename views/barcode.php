<?php if($_SESSION['user_type'] == 0 ) {
$barcode = $_GET['code'];
?>
<div id="page-wrapper">
	<div class='content'>
		<div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-block">
						<span class="input-group col-md-4 pull-right">
							<span class="input-group-addon">PCS:</span>
							<input type="number" name="num" id="num" value="30" class="form-control" onkeyup="changeNumber();">
							<div class='pull-right'>
								<button type="button" class="btn btn-primary" id="btn_primary" onclick="printDiv('barcode')"> <span class="fa fa-print"></span> Print</button>
							</div>
						</span>
                        <h6 class="card-title text-bold">Barcode <font color='green'> >>  <?php echo getProdNameDescByCode($barcode);?></font></h6>
						<p class="content-group">
						&nbsp;
                        </p>
						<div class='col-md-12' id='barcode'>
							<?php
							$count = 1;
							while($count <= 30){
							?>
							<img alt="<?php echo $barcode?>" src="barcode.php?codetype=Code39&size=40&text=<?php echo $barcode?>&print=true" />
							<?php $count++; } ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php include 'modals/modal_product.php'; ?>
<?php } else{ ?>
	<script> window.location="index.php?page=restrict"; </script>
<?php } ?>
<script>
function printDiv(container){
	var printContents = document.getElementById(container).innerHTML;
	var originalContents = document.body.innerHTML;
	document.body.innerHTML = printContents;
	window.print();
	document.body.innerHTML = originalContents;
}
function changeNumber(){
	var num = $("#num").val();
	$.post("ajax/loadBarcode.php",{
		barcode: "<?php echo $barcode ?>",
		num : num
	},function(data,status){
		$("#barcode").html(data);
	});
}
</script>