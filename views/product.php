<style>
.upload-button {
    padding: 4px;
    border: 1px solid black;
    border-radius: 5px;
    display: block;
	width:200px;
}

.profile-pic {
    max-width: 200px;
    max-height: 200px;
    display: block;
}

.file-upload {
    display: none;
}
</style>
<?php if($_SESSION['user_type'] == 0 ) {?>
<div id="page-wrapper">
	<div class='content'>
		<div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-block">
						<div class='pull-right'>
							<button role="" type="button" class="btn btn-primary" data-toggle="modal" data-target="#addProd_modal"> <span class="fa fa-plus-circle"></span> Add</button>
							<button type="button" class="btn btn-danger" id="btn_delete" onclick="deleteProduct()"> <span class="fa fa-trash"></span> Delete</button>
						</div>
                        <h6 class="card-title text-bold">Product</h6>
                        <p class="content-group">
							Add new product, update information and price, print barcodes
                        </p>
						<table class="display datatable table table-stripped" cellspacing="0" width="100%" id="dt_class">
							<thead>
								<tr>
									<th><input type="checkbox" name="" onchange="checkAll(this)"></th>
									<th>#</th>
									<th>Image</th>
									<th>Barcode</th>
									<th>Product</th>
									<th>Description</th>
									<th>Category</th>
									<th>Qty</th>
									<th>Cost</th>
									<th>Price</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php include 'modals/modal_product.php'; ?>
<?php include 'modals/modal_product_photo.php'; ?>
<?php } else{ ?>
	<script> window.location="index.php?page=restrict"; </script>
<?php } ?>
<script>
$(document).ready(function (){
getAllClass();
imgUpload();
});
function imgUpload(){

    
    var readURL = function(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('.profile-pic').attr('src', e.target.result);
            }
    
            reader.readAsDataURL(input.files[0]);
        }
    }
    

    $(".file-upload").on('change', function(){
        readURL(this);
    });
    
    $(".upload-button").on('click', function() {
       $(".file-upload").click();
    });
}
function getAllClass(){
	$("#dt_class").DataTable().destroy();
	$("#dt_class").DataTable({
		"processing":true,
		"responsive": true,
		"ajax":"ajax/datatables/getAllProduct.php",
		"columns":[
			{
				"data":"check"
			},
			{
				"data":"count"
			},
			{
				"data":"img"
			},
			{
				"data":"code"
			},
			{
				"data":"name"
			},
			{
				"data":"desc"
			},
			{
				"data":"category"
			},
			{
				"data":"qty"
			},
			{
				"data":"cost"
			},
			{
				"data":"price"
			},
			{
				"data":"action"
			}
		]
	});
}
$('#addProd_form').submit(function(e){
	e.preventDefault();

	$("#submit").prop('disabled', true);
	$("#submit").html("<span class='fa fa-spinner'></span> Submitting ...");
	$.ajax({
		type:"POST",
		url:"ajax/addNewProduct.php",
		data:$('#addProd_form').serialize(),
		success: function(data){
			if(data == 1){
			}else{
				alert(data);
			}
			$("#addProd_modal").modal('hide');
			$("#submit").prop('disabled', false);
			$("#submit").html("<span class='fa fa-plus-circle'></span> ADD");
			$("#dt_class").DataTable().destroy();
			getAllClass();
			$('#addProd_form').each(function(){
			this.reset();
			})
		}
	});
});
$('#updateProduct_form').submit(function(e){
	e.preventDefault();

	$("#u_submit").prop('disabled', true);
	$("#u_submit").html("<span class='fa fa-spinner'></span> Updating ...");
	$.ajax({
		type:"POST",
		url:"ajax/updateProduct.php",
		data:$('#updateProduct_form').serialize(),
		success: function(data){
			alert(data);
			$("#updateProduct_modal").modal('hide');
			$("#u_submit").prop('disabled', false);
			$("#u_submit").html("<span class='fa fa-check-circle'></span> UPDATE");
			$("#dt_class").DataTable().destroy();
			getAllClass();
			$('#updateProduct_form').each(function(){
			this.reset();
			})
		}
	});
});
function updateProduct(id){
	$.post("ajax/getProductDetails.php",{
		id:id
	}, function (data, status){
		var o = JSON.parse(data);
		$("#u_barcode").val(o.barcode);
		$("#u_prod_name").val(o.prod_name);
		$("#u_prod_desc").val(o.prod_desc);
		$("#u_prod_cat_id").val(o.prod_cat_id);
		$("#u_cost").val(o.cost);
		$("#u_price").val(o.price);
	}
	);
	$("#hidden_u_prod_id").val(id);
	$("#updateProduct_modal").modal('show');
}
function deleteProduct(){
	var checkedValues = $('input:checkbox:checked').map(function() {
		return this.value;
	}).get();
	
	id = [];

	if(checkedValues == ""){
		alert("Please Check Product to delete!");
	}else{
		var retVal = confirm("Are you sure to delete?");
		if( retVal == true ){
			$("#btn_delete").prop('disabled', true);
			$("#btn_delete").html("<span class='fa fa-spin fa-spinner'></span> Loading ...");
			$.post("ajax/deleteProduct.php", {
					id: checkedValues
				},
				function (data, status) {
					//alert(data);
					$("#dt_class").DataTable().destroy();
					getAllClass();
					$("#btn_delete").prop("disabled",false);
					$("#btn_delete").html("<span class='fa fa-trash-o'></span> Delete");
				}
			);
			return true;
			}
		else{

		}

	}
}
function updateProdImg(id){
	getProductPhoto(id);
	$.post("ajax/getProductDetails.php",{
		id:id
	}, function (data, status){
		var o = JSON.parse(data);
		$("#photo_prod_name").html(o.prod_name+" ("+o.prod_desc+")");
	}
	);
	$("#updateProdImg_modal").modal('show');
}
$("#updateProdImg_form").on('submit',(function(e) {
	e.preventDefault();

	$("#upload_submit").prop('disabled', true);
	$("#upload_submit").html("<span class='fa fa-spinner'></span> Updating ...");
	$.ajax({
		type:"POST",
		url:"ajax/upload_ProductPhoto.php",
		data: new FormData(this),
		contentType: false,
    	cache: false,
		processData:false,
		success: function(data){
			alert(data);
			$("#updateProdImg_modal").modal('hide');
			$("#upload_submit").prop('disabled', false);
			$("#upload_submit").html("<span class='fa fa-check-circle'></span> UPDATE");
			$("#dt_class").DataTable().destroy();
			getAllClass();
			$('#updateProdImg_form').each(function(){
			this.reset();
			})
		}
	});
}));
function getProductPhoto(id){
	$.post("ajax/sessionProdId.php",
	{
		id:id
	},
	function (data, status){
		$(".profile-pic").attr("src",""+data);
		$("#prod_id").val(id);
	}
	);
}
</script>