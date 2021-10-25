<form action='' method='POST' id='addProd_form'>				
	<div class="modal fade" id="addProd_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					Add New Class
				</div>
				<div class="modal-body">
                    <fieldset class="content-group">
						<div class="form-group row">
                            <div class="col-md-3">
                                <label class="control-label col-form-label">Product</label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" name="prod_name" class="form-control" placeholder="Product Name" required>
                            </div>
                        </div>
						<div class="form-group row">
                            <div class="col-md-3">
                                <label class="control-label col-form-label">Description</label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" name="prod_desc" class="form-control" placeholder="Product Description" >
                            </div>
                        </div>
						<div class="form-group row">
                            <div class="col-md-3">
                                <label class="control-label col-form-label">Category</label>
                            </div>
                            <div class="col-md-9">
                                <select class="form-control select2" name="prod_cat_id" required>
									<option value='' >--Please Select--</option>
									<?php
									$fetch_cat = mysql_query("SELECT * FROM tbl_product_category");
									while($row_cat = mysql_fetch_array($fetch_cat)){
									?>
									<option value='<?php echo $row_cat['prod_cat_id']; ?>' ><?php echo $row_cat['cat_name']; ?></option>
									<?php } ?>
								</select>
                            </div>
                        </div>
						<div class="form-group row">
                            <div class="col-md-3">
                                <label class="control-label col-form-label">Price</label>
                            </div>
                            <div class="col-md-9">
                                <input type="number" name="price" class="form-control" placeholder="Price" step='0.1' required>
                            </div>
                        </div>
                    </fieldset>
				</div>
				<div class="clearfix"></div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary" name="submit" id="submit" onclick=""><span class="fa fa-plus-circle"></span> ADD</button>
					<button type="button" class="btn btn-danger" data-dismiss="modal"><span class="fa fa-times-circle"></span> CANCEL</button>
				</div>
			</div>
		</div>
	</div>
</form>
<form action='' method='POST' id='updateProduct_form'>				
	<div class="modal fade" id="updateProduct_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					Update Product
				</div>
				<div class="modal-body">
					<input type="hidden" id="hidden_u_prod_id" name="u_prod_id" class="form-control">
                    <fieldset class="content-group">
						<div class="form-group row">
                            <div class="col-md-3">
                                <label class="control-label col-form-label">Barcode</label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" id="u_barcode" class="form-control" placeholder="Product Name" readonly>
                            </div>
                        </div>
						<div class="form-group row">
                            <div class="col-md-3">
                                <label class="control-label col-form-label">Product</label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" id="u_prod_name" name="u_prod_name" class="form-control" required>
                            </div>
                        </div>
						<div class="form-group row">
                            <div class="col-md-3">
                                <label class="control-label col-form-label">Description</label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" id="u_prod_desc"  name="u_prod_desc" class="form-control" placeholder="Product Description" >
                            </div>
                        </div>
						<div class="form-group row">
                            <div class="col-md-3">
                                <label class="control-label col-form-label">Category</label>
                            </div>
                            <div class="col-md-9">
                                <select class="form-control" id="u_prod_cat_id" name="u_prod_cat_id" required>
									<?php
									$fetch_cat = mysql_query("SELECT * FROM tbl_product_category");
									while($row_cat = mysql_fetch_array($fetch_cat)){
									?>
									<option value='<?php echo $row_cat['prod_cat_id']; ?>' ><?php echo $row_cat['cat_name']; ?></option>
									<?php } ?>
								</select>
                            </div>
                        </div>
						<div class="form-group row">
                            <div class="col-md-3">
                                <label class="control-label col-form-label">Cost</label>
                            </div>
                            <div class="col-md-9">
                                <input type="number" id="u_cost" readonly name="u_cost" class="form-control" placeholder="Cost">
                            </div>
                        </div>
						<div class="form-group row">
                            <div class="col-md-3">
                                <label class="control-label col-form-label">Price</label>
                            </div>
                            <div class="col-md-9">
                                <input type="number" id="u_price" name="u_price" class="form-control" placeholder="Price" step='0.1' required>
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