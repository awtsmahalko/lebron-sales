<?php if($_SESSION['user_type'] == 0 ) {?>
<div id="page-wrapper">
	<div class='content'>
		<div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-block">
						<div class='pull-right'>
							<button role="" type="button" class="btn btn-primary" data-toggle="modal" data-target="#addCat_modal"> <span class="fa fa-plus-circle"></span> Add</button>
							<button type="button" class="btn btn-danger" id="btn_delete" onclick="deleteProductCategory()"> <span class="fa fa-trash"></span> Delete</button>
						</div>
                        <h6 class="card-title text-bold">Product Category</h6>
                        <p class="content-group">
							Add new product category, update information
                        </p>
						<table class="table table-stripped" cellspacing="0" width="100%" id="dt_cat">
							<thead>
								<tr>
									<th><input type="checkbox" name="" onchange="checkAll(this)"></th>
									<th>#</th>
									<th>Category</th>
									<th>Description</th>
									<th>Products</th>
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
<?php include 'modals/modal_category.php'; ?>
<?php } else{ ?>
	<script> window.location="index.php?page=restrict"; </script>
<?php } ?>
<script>
$(document).ready(function (){
getAllCat();
});
function getAllCat(){
	$("#dt_cat").DataTable().destroy();
	$("#dt_cat").DataTable({
		"processing":true,
		"responsive": true,
		"ajax":"ajax/datatables/getAllProductCategory.php",
		"columns":[
			{
				"data":"check"
			},
			{
				"data":"count"
			},
			{
				"data":"name"
			},
			{
				"data":"desc"
			},
			{
				"data":"prod"
			},
			{
				"data":"action"
			}
		]
	});
}
$('#addCat_form').submit(function(e){
	e.preventDefault();

	$("#submit").prop('disabled', true);
	$("#submit").html("<span class='fa fa-spinner'></span> Submitting ...");
	$.ajax({
		type:"POST",
		url:"ajax/addNewProductCategory.php",
		data:$('#addCat_form').serialize(),
		success: function(data){
			if(data == 1){
			}else{
				alert(data);
			}
			$("#addCat_modal").modal('hide');
			$("#submit").prop('disabled', false);
			$("#submit").html("<span class='fa fa-plus-circle'></span> ADD");
			$("#dt_cat").DataTable().destroy();
			getAllCat();
			$('#addCat_form').each(function(){
			this.reset();
			})
		}
	});
});
$('#updateProductCategory_form').submit(function(e){
	e.preventDefault();

	$("#u_submit").prop('disabled', true);
	$("#u_submit").html("<span class='fa fa-spinner'></span> Updating ...");
	$.ajax({
		type:"POST",
		url:"ajax/updateProductCategory.php",
		data:$('#updateProductCategory_form').serialize(),
		success: function(data){
			alert(data);
			$("#updateProductCategory_modal").modal('hide');
			$("#u_submit").prop('disabled', false);
			$("#u_submit").html("<span class='fa fa-check-circle'></span> UPDATE");
			$("#dt_cat").DataTable().destroy();
			getAllCat();
			$('#updateProductCategory_form').each(function(){
			this.reset();
			})
		}
	});
});
function updateProductCategory(id){
	$.post("ajax/getProductCategoryDetails.php",{
		id:id
	}, function (data, status){
		var o = JSON.parse(data);
		$("#u_cat_name").val(o.cat_name);
		$("#u_cat_desc").val(o.cat_desc);
	}
	);
	$("#hidden_u_prod_cat_id").val(id);
	$("#updateProductCategory_modal").modal('show');
}
function deleteProductCategory(){
	var checkedValues = $('input:checkbox:checked').map(function() {
		return this.value;
	}).get();
	
	id = [];

	if(checkedValues == ""){
		alert("Please Check Product Category to delete!");
	}else{
		var retVal = confirm("Are you sure to delete?");
		if( retVal == true ){
			$("#btn_delete").prop('disabled', true);
			$("#btn_delete").html("<span class='fa fa-spin fa-spinner'></span> Loading ...");
			$.post("ajax/deleteProductCategory.php", {
					id: checkedValues
				},
				function (data, status) {
					//alert(data);
					$("#dt_cat").DataTable().destroy();
					getAllCat();
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
</script>