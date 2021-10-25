<form action='' method='POST' id='addCat_form'>				
	<div class="modal fade" id="addCat_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					Add New Category
				</div>
				<div class="modal-body">
                    <fieldset class="content-group">
						<div class="form-group row">
                            <div class="col-md-3">
                                <label class="control-label col-form-label">Category</label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" name="cat_name" class="form-control" placeholder="Category Name" required>
                            </div>
                        </div>
						<div class="form-group row">
                            <div class="col-md-3">
                                <label class="control-label col-form-label">Description</label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" name="cat_desc" class="form-control" placeholder="Category Description" >
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
<form action='' method='POST' id='updateProductCategory_form'>				
	<div class="modal fade" id="updateProductCategory_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					Update Category
				</div>
				<div class="modal-body">
					<input type="hidden" id="hidden_u_prod_cat_id" name="u_prod_cat_id" class="form-control">
                    <fieldset class="content-group">
						<div class="form-group row">
                            <div class="col-md-3">
                                <label class="control-label col-form-label">Category</label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" id="u_cat_name" name="u_cat_name" class="form-control" placeholder="Product Name" required>
                            </div>
                        </div>
						<div class="form-group row">
                            <div class="col-md-3">
                                <label class="control-label col-form-label">Description</label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" id="u_cat_desc" name="u_cat_desc" class="form-control" placeholder="Product Description" >
                            </div>
                        </div>
                    </fieldset>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary" name="u_submit" id="u_submit" onclick=""><span class="fa fa-edit"></span> UPDATE</button>
					<button type="button" class="btn btn-danger" data-dismiss="modal"><span class="fa fa-times-circle"></span> CANCEL</button>
				</div>
			</div>
		</div>
	</div>
</form>