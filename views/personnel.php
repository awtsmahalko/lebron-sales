<?php if($_SESSION['user_type'] == 0 ) {?>
<div id="page-wrapper">
	<div class='content'>
		<div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-block">
						<div class='pull-right'>
							<button role="" type="button" class="btn btn-primary" data-toggle="modal" data-target="#addPersonnel_modal"> <span class="fa fa-plus-circle"></span> Add</button>
							<button type="button" class="btn btn-danger" id="btn_delete" onclick="deletePersonnel()"> <span class="fa fa-trash"></span> Delete</button>
						</div>
                        <h6 class="card-title text-bold">Personnel</h6>
                        <p class="content-group">
							View and monitor personnels
                        </p>
						<table class="display datatable table table-stripped" cellspacing="0" width="100%" id="dt_class">
							<thead>
								<tr>
									<th><input type="checkbox" name="" onchange="checkAll(this)"></th>
									<th>#</th>
									<th>Personnel</th>
									<th>Address</th>
									<th>Birthdate</th>
									<th>User Type</th>
									<th>Status</th>
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
<?php include 'modals/modal_personnel.php'; ?>
<?php } else{ ?>
	<script> window.location="index.php?page=restrict"; </script>
<?php } ?>
<script>
$(document).ready(function (){
getAllClass();
});
function getAllClass(){
	$("#dt_class").DataTable().destroy();
	$("#dt_class").DataTable({
		"processing":true,
		"responsive": true,
		"ajax":"ajax/datatables/getAllPersonnel.php",
		"columns":[
			{
				"data":"check"
			},
			{
				"data":"count"
			},
			{
				"data":"personnel"
			},
			{
				"data":"address"
			},
			{
				"data":"bdate"
			},
			{
				"data":"type"
			},
			{
				"data":"status"
			},
			{
				"data":"action"
			}
		]
	});
}
$('#addPersonnel_form').submit(function(e){
	e.preventDefault();

	$("#submit").prop('disabled', true);
	$("#submit").html("<span class='fa fa-spinner'></span> Submitting ...");
	$.ajax({
		type:"POST",
		url:"ajax/addPersonnel.php",
		data:$('#addPersonnel_form').serialize(),
		success: function(data){
			if(data == 1){
			}else{
				alert(data);
			}
			$("#addPersonnel_modal").modal('hide');
			$("#submit").prop('disabled', false);
			$("#submit").html("<span class='fa fa-plus-circle'></span> ADD");
			$("#dt_class").DataTable().destroy();
			getAllClass();
			$('#addPersonnel_form').each(function(){
			this.reset();
			})
		}
	});
});
function updatePersonnel(id){
	$.post("ajax/getPersonnelDetails.php",{
		id: id
	},
	function (data,status){
		var o = JSON.parse(data);
		$("#update_personnel_id").val(o.personnel_id);
		$("#update_personnel_name").val(o.personnel_name);
		$("#update_personnel_address").val(o.personnel_address);
		$("#update_personnel_bdate").val(o.personnel_bdate);
	});
	$("#updatePersonnel_modal").modal('show');
}
$('#updatePersonnel_form').submit(function(e){
	e.preventDefault();

	$("#u_submit").prop('disabled', true);
	$("#u_submit").html("<span class='fa fa-spinner'></span> Updating ...");
	$.ajax({
		type:"POST",
		url:"ajax/updatePersonnel.php",
		data:$('#updatePersonnel_form').serialize(),
		success: function(data){
			alert(data);
			$("#updatePersonnel_modal").modal('hide');
			$("#u_submit").prop('disabled', false);
			$("#u_submit").html("<span class='fa fa-check-circle'></span> UPDATE");
			$("#dt_class").DataTable().destroy();
			getAllClass();
			$('#updatePersonnel_form').each(function(){
			this.reset();
			})
		}
	});
});
function deletePersonnel(){
	var checkedValues = $('input:checkbox:checked').map(function() {
		return this.value;
	}).get();
	
	id = [];

	if(checkedValues == ""){
		alert("Please Check Personnel to delete!");
	}else{
		var retVal = confirm("Are you sure to delete?");
		if( retVal == true ){
			$("#btn_delete").prop('disabled', true);
			$("#btn_delete").html("<span class='fa fa-spin fa-spinner'></span> Loading ...");
			$.post("ajax/deletePersonnel.php", {
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