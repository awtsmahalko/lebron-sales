<?php
$sales_number = $_GET['id'];
$sales_header = mysql_fetch_array(mysql_query("SELECT * FROM tbl_sales_header WHERE sales_number='$sales_number'"));
if($sales_header['sales_status'] == 1){
	$disabled = "disabled";
	$text_stat = "FINISHED";
	$color = "green";
	$fa = "fa-check-circle";
}else{
	$disabled = "";
	$text_stat = "SAVED";
	$color = "red";
	$fa = "fa-bookmark-o";
}
?>
<div id="page-wrapper">
	<div class='content'>
		<div class="row">
			<div class="btn-group btn-small" role="group">
				<button class="btn btn-default" onClick="window.location='index.php?page=sales'" style="font-size: 11px; padding: 5px; color: maroon;"><strong><span class="fa fa-angle-double-left"></span> Sales Entries</strong></button>
				<button class="btn btn-default disabled" style="font-size: 11px; padding: 5px;">View Sales</button>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-12">
				<h4 class="page-header animated flipInX" style="border: 5px solid #286090;border-top: none;border-bottom: none;border-right: none;padding: 5px;color: #286090;"><span class="fa fa-area-chart"></span> Sales || &nbsp; <span class='fa <?php echo $fa; ?>' style= 'color: <?php echo $color; ?>;'>  <?php echo $text_stat; ?></span> </h4>
			</div>
		</div>
		
	<div class="row">
		<div class="col-sm-4" style="padding: 10px;">
			<div class="col-sm-12" style="border: 1px solid #ccc; padding: 7px; border-radius: 3px">
				<form id="frm_add_dr" action="" method="POST">
					<div class="input-group" style="padding: 4px;">
						<span class="input-group-addon" id="basic-addon1"><strong>Delivery No.: <span style="color:red;">*</span></strong></span>
						<input type="text" class="form-control" value="<?php echo $sales_number; ?>" readonly required id="dr_number" aria-describedby="basic-addon1" name="delivery_number">
					</div>
					<div class="input-group" style="padding: 4px;">
						<span class="input-group-addon" id="basic-addon1"><strong>Date: <span style="color:red;">*</span></strong></span>
						<input type='text' readonly class="form-control" name="date" id="date" value="<?php echo $sales_header['sales_date']; ?>" required>
					</div>
					<div class="input-group" style="padding: 4px;">
						<span class="input-group-addon" id="basic-addon1"><strong>Customer: <span style="color:red;">*</span></strong></span>
						<input type='text' readonly class="form-control" name="customer_id" id="customer_id" value="<?php echo $sales_header['customer']; ?>"required>
					</div>
					
					<div class="input-group" style="padding: 4px;">
						<span class="input-group-addon" id="basic-addon1"><strong>Remarks: </strong></span>
						<textarea class="form-control" readonly name="remarks" id="remarks" value="<?php echo $sales_header['remark']; ?>"></textarea>
					</div>
				<div class="input-group" style="padding: 4px;">
					<span class="input-group-addon" id="basic-addon1"><strong>Encoded By: </strong></span>
					<input type='text' class="form-control" name="cashier" value='<?php echo getEncoderName($sales_header['user_id'])?>' readonly>
				</div>
				</form>
			</div>
		</div>
		<div class="col-sm-8" style="padding:10px;" id="dr_add_details_container">
		  <form id="frm_add_dr_details" action="" method="POST">
		  <input type="hidden" id="delivery_id" value='<?php echo $sales_number; ?>' name="dr_number">
			<div class="col-sm-12" style="border: 1px solid #ccc; padding: 7px; border-radius: 3px;">
				<div class="col-sm-6" style="padding: 4px;float:left;">
					<div style="padding: 6px;">
						<strong><span style="color: #607d8b;">Current Quantity:</span> <font color='green'><span id="current_qty"></span></font></strong>
					</div>
				</div>
				<div class="col-sm-6" style="padding: 4px;float:right;">
					<div style="padding: 6px;">
						<strong><span style="color: #607d8b;">Current Cost :</span> <font color='green'><span id="current_cost"></span></font></strong>
					</div>
				</div>
			<div class="col-sm-6" style="padding: 4px;float:left;">
				<div class="input-group">
					<span class="input-group-addon"><strong>Barcode: </strong></span>
					<input type='text' <?php echo $disabled; ?> style='text-transform:uppercase' class="form-control" name="barcode" id='barcode' onkeyup='getProduct()' required>
				</div>
			</div>
				<div class="col-sm-6" style="padding: 4px; float:right;">
					<div class="input-group">
					<span class="input-group-addon"><strong>Item: <span style="color:red;">*</span></strong></span>
						<input type='text' <?php echo $disabled; ?> class="form-control" name="product" required id='product' value='' readonly>
					</div>
				</div>
				<div class="col-sm-6" style="padding: 4px; float:right;">
					<div class="input-group">
					<span class="input-group-addon"><strong>Description: <span style="color:red;">*</span></strong></span>
						<textarea class="form-control" name="description" id='description' readonly>
						</textarea>
					</div>
				</div>
				<div class="col-sm-6" style="padding: 4px;float:left;">
					<div class="input-group">
						<span class="input-group-addon" id="basic-addon1"><strong>Qty: <span style="color:red;">*</span></strong></span>
						<input type="number" <?php echo $disabled; ?> min="0" class="form-control" id="qty" aria-describedby="basic-addon1" name="qty" step="0.01" required/>
					</div>
				</div>
				<div class="col-sm-6" style="padding: 4px;float:right">
					<div class="input-group">
						<span class="input-group-addon" id="basic-addon1"><strong>Price: <span style="color:red;">*</span></strong></span>
						<input type="number" min="0" class="form-control" readonly id="price" aria-describedby="basic-addon1" name="price" step="0.01" required/>
					</div>
				</div>
				<div class="col-sm-6" style="padding: 4px;">
					<div class="input-group">
						<span class="input-group-addon" id="basic-addon1"><strong>Discount (%): </strong></span>
						<input type="number" <?php echo $disabled; ?> class="form-control" id="discount" aria-describedby="basic-addon1" name="discount" value='0' step='0.1' required/>
					</div>
				</div>
				</hr>
				<div class="input-group spaceMe" style='margin-left:85%'>
					<div class="btn-group" role="group" aria-label="...">
						<button type="submit" <?php echo $disabled; ?> id="btn_add" class="btn btn-sm btn-primary"><span class="fa fa-plus-circle"></span> Add Details</button>
					</div>
				</div>
			</div>
			</form>
		  </div>
	</div>

	<hr/>

	<div class="row"  id="sale_details_container" style="padding: 10px;">
	  <div class="col-sm-12" style="border: 1px solid #ccc; padding: 7px; border-radius: 3px;">
		<?php if($sales_header['sales_status'] != 1){?>
		<div class="btn-group pull-right" role="group" style="padding: 4px;margin-bottom: 10px;">
			<button type='button' class="btn btn-sm btn-success" onclick='finish_delivery()' id="btn_fin" data-toggle="tooltip" title="Finish Delivery"><span class="fa fa-check-circle"></span> Finish Delivery </button>
			<button type="button" class="btn btn-sm btn-danger" onclick="checkbox_Salesdetails()" id="btn_del" data-toggle="tooltip" title="Delete Checked"><span class="fa fa-trash"></span> Delete</button>
		</div>
		<?php } ?>
		<br>
			<table id="dt_delivery" class="table table-bordered table-striped" style="font-size:12px;width:100%;">
				<thead>
					<tr>
						<th style=" width:10px;text-align:center;background-color:#e3e3e3; border-bottom:1px solid #aaa;"><input type="checkbox" onchange="checkAll(this)"></th>
						<th style=" width:10px;text-align:center;background-color:#e3e3e3; border-bottom:1px solid #aaa;">#</th>
						<th style="text-align:center;background-color:#e3e3e3; border-bottom:1px solid #aaa;">ITEM</th>
						<th style="text-align:center;background-color:#e3e3e3; border-bottom:1px solid #aaa;">QTY</th>
						<th style="text-align:center;background-color:#e3e3e3; border-bottom:1px solid #aaa;">PRICE</th>
						<th style="text-align:center;background-color:#e3e3e3; border-bottom:1px solid #aaa;">DISCOUNT(%)</th>
						<th style="text-align:center;background-color:#e3e3e3; border-bottom:1px solid #aaa;">AMOUNT</th>
					</tr>
				</thead>
			 <tbody>
			</tbody>
			<tfoot>
				<tr style="background-color:#B9F6CA;color:#424242;font-size:12px;">
					<td colspan="6" style="text-align:right;">Total:</td>
					<td colspan="1">&#x20B1;&nbsp;<strong><span id="totalDR"></span></strong></td>
				</tr>
			</tfoot>
		   </table>
		</div>
	  </div>
	</div>
</div>
<input type="hidden" id='txt_module'>
<script>
function getProduct(){ // updated 11/16/2017

	var id = $('#barcode').val();
		$.ajax({
			url:"ajax/getProductByBarcode.php",
			type:"POST",
			data:{
				id:id
			},
			success: function(data){
				var o = JSON.parse(data);
				$("#product").val(o.prod_name);
				$("#description").val(o.prod_desc);
				$("#price").val(o.price);
				getCurrentQty();
				getCurrentCost();
			}
		});
}
function getCurrentQty(){
	var barcode = $('#barcode').val();
	$.ajax({
		type: "POST",
		url: "ajax/getCurrentQtyForSales.php",
		data:{
			barcode:barcode
		},
		success: function(data){
			$("#current_qty").html(data);
		}
	});
}

function getCurrentCost(){
	var barcode = $('#barcode').val();
	$.ajax({
		type: "POST",
		url: "ajax/getCostForSale.php",
		data:{
			barcode:barcode
		},
		success: function(data){
			$("#current_cost").html(data);
		}
	});
}

$('#frm_add_dr').submit(function(e){
	e.preventDefault();

	var dr_number =	$("#dr_number").val();

	if(dr_number == ""){
		alert("No Delivery Number! Please refresh the page.");
		window.location.reload();

	}else{
		$('#dr_add_details_container').fadeIn();

		$("#btn_add_dr").prop('disabled',true);
		$("#btn_add_dr").html("<span class='fa fa-spin fa-spinner'></span> Loading ...");

			$.ajax({
			type: "POST",
			url: "ajax/addSalesHeader.php",
			data: $('#frm_add_dr').serialize(),
			success: function(data){
				if(data == 1){
					$("#btn_add_dr").hide();
				}else{
					alert(data);
				}
				$('#btn_add_dr').prop('disabled',true);
				$("#btn_add_dr").html("<span class='fa fa-plus-circle'></span>  Add Sale");
				
			}
		}); 
	}
	$('#customer_id').prop('disabled',true);
	$('#date').prop('disabled',true);
	$('#remarks').prop('disabled',true);
});

$('#frm_add_dr_details').submit(function(e){
	e.preventDefault();
	$("#btn_add").prop('disabled',true);
	$("#btn_add").html("<span class='fa fa-spin fa-spinner'></span> Loading ...");
	$.ajax({
		type: "POST",
		url: "ajax/addSalesDetails.php",
		data: $('#frm_add_dr_details').serialize(),
		success: function(data){
		if(data == 2){
			alert("Product don't have enough quantity. ");
		}else if(data == 1){
			getDR_details();
		}else{
			alert(data);
		}
			$("#btn_add").prop('disabled',false);
			$("#btn_add").html("<span class='fa fa-plus-circle'></span> Add Details");
			$("#sale_details_container").fadeIn();
		}
		
	});
				$("#product").val("");
				$("#description").val("");
				$("#price").val("");
				$("#barcode").val("");
				$("#qty").val("");
				$("#discount").val("0");
				$("#current_qty").html("");
				$("#current_cost").html("");
});

function computeTotalDR(){
	
	var delivery_id = $("#delivery_id").val();
	
	$.ajax({
		type:"POST",
		url:"ajax/computeTotalSalesDetails.php",
		data: {
			delivery_id:delivery_id
		},
		success: function(data){
			$("#totalDR").html(data);
		}
	});
}
function finish_delivery(){

	$("#btn_fin").prop("disabled",true);
	$("#btn_fin").html("<span class='fa fa-spin fa-spinner'></span> Loading...");
	var delivery_id = $("#delivery_id").val();
	var dr_date = $('#date').val();
	
	$.ajax({
		type:"POST",
		url:"ajax/finishSales.php",
		data:{
			delivery_id:delivery_id,
			dr_date: dr_date
		},
		success: function(data){
			if(data == 1){
				window.location = 'index.php?page=sales';
			}else if(data == 2){
				alert("Cannot Finish! No Delivery Details found.")
				
			}else{
				//failed_query();
				alert(data);
			}
			$("#btn_fin").prop("disabled",false);
			$("#btn_fin").html("<span class='fa fa-check-circle'></span> Finish Stock Transfer");
		}
	});
}

function getDR_details(){
	$("#dt_delivery").DataTable().destroy();
	var delivery_id = $("#delivery_id").val();
	$("#dt_delivery").dataTable({
		"processing":true,
		"ajax":{
			"type":"POST",
			"url":"ajax/datatables/getSalesDetails.php",
			"dataSrc":"data",
			"data":{
				delivery_id:delivery_id
			}
		},
		"columns":[
		{
			"data":"check"
		},
		{
			"data":"count"
		},
		{
			"data":"item"
		},
		{
			"data":"qty"
		},
		{
			"data":"price"
		},
		{
			"data":"discount"
		},
		{
			"data":"amount"
		}
		]
	});
}

function checkbox_Salesdetails(){
	var checkedValues = $('input:checkbox:checked').map(function() {
		return this.value;
	}).get();
	
	id = [];

	if(checkedValues == ""){
		alert("Please Check Sales Details to delete!");
	}else{
		var retVal = confirm("Are you sure to delete?");
		if( retVal == true ){
			$("#btn_del").prop("disabled",true);
			$("#btn_del").html("<span class='fa fa-spin fa-spinner'></span> Loading ... ");
				$.post("ajax/deleteSalesDetails.php", {
					id: checkedValues
				},
				function (data, status) {
					if(data == 1){
						//success_delete();
						var table = $('#dt_delivery').DataTable();
						table.destroy();
						getDR_details();
					}else{
						//failed_query();
					}
					$("#btn_del").prop("disabled",false);
					$("#btn_del").html("<span class='fa fa-trash-o'></span> Delete");
				});
			return true;
			}
		else{

		}

	}
}
$(document).ready(function(){
	getDR_details();
	computeTotalDR();
	//splitme();
});

</script>