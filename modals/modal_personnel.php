<form action='' method='POST' id='addPersonnel_form'>				
	<div class="modal fade" id="addPersonnel_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					Add new personnel
				</div>
				<div class="modal-body">
                    <fieldset class="content-group">
						<div class="form-group row">
                            <div class="col-md-3">
                                <label class="control-label col-form-label">Personnel Type</label>
                            </div>
                            <div class="col-md-9">
                                <select class="form-control" id="user_type" name="user_type" onchange='' required>
									<option value='' >--Please Select--</option>
									<option value='1' >Cashier</option>
									<option value='0' >Admin</option>
								</select>
                            </div>
                        </div>
						<div class="form-group row">
                            <div class="col-md-3">
                                <label class="control-label col-form-label">Name</label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" class="form-control" placeholder="Firstname Middlename Lastname" id="personnel_name" name="personnel_name" required>
                            </div>
                        </div>
						<div class="form-group row">
                            <div class="col-md-3">
                                <label class="control-label col-form-label">Address</label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" class="form-control" placeholder="Address" id="personnel_address" name="personnel_address" required>
                            </div>
                        </div>
						<div class="form-group row">
                            <div class="col-md-3">
                                <label class="control-label col-form-label">Birthdate</label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" class="form-control pickadate" id="personnel_bdate" name="personnel_bdate" required>
                            </div>
                        </div>
						<div class="form-group row">
                            <div class="col-md-3">
                                <label class="control-label col-form-label">Username</label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" class="form-control" placeholder="username" id="username" name="username" required>
                            </div>
                        </div>
						<div class="form-group row">
                            <div class="col-md-3">
                                <label class="control-label col-form-label">Password</label>
                            </div>
                            <div class="col-md-9">
                                <input type="password" class="form-control" placeholder="password" id="password" name="password" required>
                            </div>
                        </div>
                    </fieldset>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary" name="submit" id="submit" onclick=""><span class="fa fa-plus-circle"></span> ADD</button>
					<button type="button" class="btn btn-danger" data-dismiss="modal"><span class="fa fa-times-circle"></span> CANCEL</button>
				</div>
			</div>
		</div>
	</div>
</form>
<form action='' method='POST' id='updatePersonnel_form'>				
	<div class="modal fade" id="updatePersonnel_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					Update personnel
				</div>
				<div class="modal-body">
                    <fieldset class="content-group">
						<input type='hidden' id='update_personnel_id' name='update_personnel_id'>
						<div class="form-group row">
                            <div class="col-md-3">
                                <label class="control-label col-form-label">Name</label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" class="form-control" placeholder="Firstname Middlename Lastname" id="update_personnel_name" name="update_personnel_name" required>
                            </div>
                        </div>
						<div class="form-group row">
                            <div class="col-md-3">
                                <label class="control-label col-form-label">Address</label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" class="form-control" placeholder="Address" id="update_personnel_address" name="update_personnel_address" required>
                            </div>
                        </div>
						<div class="form-group row">
                            <div class="col-md-3">
                                <label class="control-label col-form-label">Birthdate</label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" class="form-control pickadate" id="update_personnel_bdate" name="update_personnel_bdate" required>
                            </div>
                        </div>
                    </fieldset>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary" name="submit" id="u_submit" onclick=""><span class="fa fa-edit"></span> UPDATE</button>
					<button type="button" class="btn btn-danger" data-dismiss="modal"><span class="fa fa-times-circle"></span> CANCEL</button>
				</div>
			</div>
		</div>
	</div>
</form>