<div id="page-wrapper">
	<div class='content'>
		<div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-block">
						<div class='pull-right'>
							<button role="" type="button" class="btn btn-primary" onclick="window.location='index.php?page=add-sales'"> <span class="fa fa-plus-circle"></span> Add</button>
							<button type="button" class="btn btn-danger" id="btn_delete" onclick="deleteSales()"> <span class="fa fa-trash"></span> Delete</button>
						</div>
                        <h6 class="card-title text-bold">Sales</h6>
                        <p class="content-group">
							Add, view and monitor Sales
                        </p>
						<table class="display datatable table table-stripped" cellspacing="0" width="100%" id="dt_class">
							<thead>
								<tr>
									<th><input type="checkbox" name="" onchange="checkAll(this)"></th>
									<th>#</th>
									<th>Detail</th>
									<th>Sales Number</th>
									<th>Date</th>
									<th>Customer</th>
									<th>Cashier</th>
									<th>Item(s)</th>
									<th>Amount</th>
									<th>Remark</th>
									<th>Status</th>
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
<script>
$(document).ready(function (){
getAllClass();
});
function getProduct(){
	var cat = $('#prod_cat_id').val();
	$.post("ajax/getProductByCat.php",{
		cat:cat
	}, function (data, status){
		$("#prod_id").html(data);
	}
	);
}
function getAllClass(){
	$("#dt_class").DataTable().destroy();
	$("#dt_class").DataTable({
		"processing":true,
		"responsive": true,
		"ajax":"ajax/datatables/getAllSales.php",
		"columns":[
			{
				"data":"check"
			},
			{
				"data":"count"
			},
			{
				"data":"detail"
			},
			{
				"data":"number"
			},
			{
				"data":"date"
			},
			{
				"data":"cust"
			},
			{
				"data":"cashier"
			},
			{
				"data":"item"
			},
			{
				"data":"amount"
			},
			{
				"data":"remark"
			},
			{
				"data":"status"
			}
		]
	});
}
$('#addReceive_form').submit(function(e){
	e.preventDefault();

	$("#submit").prop('disabled', true);
	$("#submit").html("<span class='fa fa-spinner'></span> Submitting ...");
	$.ajax({
		type:"POST",
		url:"ajax/receiveItems.php",
		data:$('#addReceive_form').serialize(),
		success: function(data){
			if(data == 1){
			}else{
				alert(data);
			}
			$("#addReceive_modal").modal('hide');
			$("#submit").prop('disabled', false);
			$("#submit").html("<span class='fa fa-plus-circle'></span> ADD");
			$("#dt_class").DataTable().destroy();
			getAllClass();
			$('#addReceive_form').each(function(){
			this.reset();
			})
		}
	});
});
$('#updateClass_form').submit(function(e){
	e.preventDefault();

	$("#u_submit").prop('disabled', true);
	$("#u_submit").html("<span class='fa fa-spinner'></span> Updating ...");
	$.ajax({
		type:"POST",
		url:"ajax/fac_updateClass.php",
		data:$('#updateClass_form').serialize(),
		success: function(data){
			alert(data);
			$("#updateClass_modal").modal('hide');
			$("#u_submit").prop('disabled', false);
			$("#u_submit").html("<span class='fa fa-check-circle'></span> UPDATE");
			$("#dt_class").DataTable().destroy();
			getAllClass();
			$('#updateClass_form').each(function(){
			this.reset();
			})
		}
	});
});
function updateClassModal(id){
	$.post("ajax/fac_getClassDetails.php",{
		id:id
	}, function (data, status){
		var o = JSON.parse(data);
		$("#u_class_code").val(o.class_code);
		$("#u_subject").val(o.subject);
		$("#u_section").val(o.section);
		$("#u_semester").val(o.semester);
		$("#u_year").val(o.year);
	}
	);
	$("#hidden_class_id").val(id);
	$("#updateClass_modal").modal('show');
}
function deleteSales(){
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
			$.post("ajax/deleteSales.php", {
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
</script>