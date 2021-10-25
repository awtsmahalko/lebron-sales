<?php if($_SESSION['user_type'] == 0 ) {?>
<div id="page-wrapper">
	<div class='content'>
		<div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-block">
                        <h6 class="card-title text-bold">Account</h6>
                        <p class="content-group">
							View and monitor account
                        </p>
						<table class="display datatable table table-stripped" cellspacing="0" width="100%" id="dt_class">
							<thead>
								<tr>
									<th>#</th>
									<th>Personnel</th>
									<th>Username</th>
									<th>Password</th>
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
		"ajax":"ajax/datatables/getAllAccount.php",
		"columns":[
			{
				"data":"count"
			},
			{
				"data":"personnel"
			},
			{
				"data":"username"
			},
			{
				"data":"password"
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
function deactivateAccount(id){
	var x = confirm("Are you sure to deactivate Account?");
	if(x == true){
		$.post("ajax/updateAccountStatus.php",{
			id:id,
			status:0
		},function (data,status){
			$("#dt_class").DataTable().destroy();
			getAllClass();
		});
	}
}
function activateAccount(id){
	var x = confirm("Are you sure to activate Account?");
	if(x == true){
		$.post("ajax/updateAccountStatus.php",{
			id:id,
			status:1
		},function (data,status){
			$("#dt_class").DataTable().destroy();
			getAllClass();
		});
	}
}
</script>