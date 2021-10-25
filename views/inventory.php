<?php if($_SESSION['user_type'] == 0 ) {?>
<div id="page-wrapper">
	<div class='content'>
		<div class="row">
			<div class="btn-group btn-small" role="group">
				<button class="btn btn-default" onClick="window.location='index.php'" style="font-size: 11px; padding: 5px; color: maroon;"><strong><span class="fa fa-angle-double-left"></span> Dashboard </strong></button>
				<button class="btn btn-default disabled" style="font-size: 11px; padding: 5px;">Reports</button>
				<button class="btn btn-default disabled" style="font-size: 11px; padding: 5px;">Inventory Balance</button>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-12">
				<h4 class="page-header animated flipInX" style="border: 5px solid #286090;border-top: none;border-bottom: none;border-right: none;padding: 5px;color: #286090;">
					<span class="fa fa-cubes"></span> Inventory Balance
				</h4>
			</div>
		</div>
		<div class="row">
            <div class="col-lg-12">
				<h6 class="card-title text-bold">
					<div class="input-group col-sm-8" style="">
						<span class="input-group-addon"><strong> Product Type: </strong></span>
						<select class="form-control" id="prod_type">
							<option value="">Select type:</option>
							<?php
							$getCat = mysql_query("SELECT * FROM tbl_product_category");
							while($getrowCat=mysql_fetch_assoc($getCat)){
							?>
							<option value="<?php echo $getrowCat['prod_cat_id']?>"><?php echo $getrowCat['cat_name']?></option>
							<?php } ?>
						</select>
						<button class="btn btn-primary" type="button" onclick="generate_inventory_report()" id="btn_details"><span class="fa fa-check-circle"></span> Generate Report</button>
						<button class="btn btn-success" type="button" onClick="printDiv('inventory_balance');"><span class="fa fa-print"></span> Print Report</button>
					</div>
                </h6>
				<div id="inventory_data">
				</div>
			</div>
		</div>
	</div>
</div>
<?php } else{ ?>
	<script> window.location="index.php?page=restrict"; </script>
<?php } ?>
<script>
function generate_inventory_report(){
	var prod_type = $("#prod_type").val();
	
	$("#btn_details").prop('disabled',true);

	$("#btn_details").html("<span class='fa fa-spinner'></span> Loading ... ");

		$.ajax({
			type:"POST",
			url:"ajax/inventory_balance.php",
			data:{
				prod_type: prod_type
			},
			success: function(data){
				$("#inventory_data").html(data);
				$("#btn_details").html("<span class='fa fa-check-circle'></span> Generate Report");
				$("#btn_details").prop('disabled',false);
			}
		});
}
function printDiv(inventory_balance){
	var printContents = document.getElementById(inventory_balance).innerHTML;
	var originalContents = document.body.innerHTML;
	document.body.innerHTML = printContents;
	window.print();
	document.body.innerHTML = originalContents;
   }

</script>