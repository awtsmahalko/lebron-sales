<form action='' method='POST' id='addReceive_form'>				
	<div class="modal fade" id="addReceive_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					Receive new items
				</div>
				<div class="modal-body">
                    <fieldset class="content-group">
						<div class="form-group row">
                            <div class="col-md-3">
                                <label class="control-label col-form-label">Category</label>
                            </div>
                            <div class="col-md-9">
                                <select class="form-control" id="prod_cat_id" name="prod_cat_id" onchange='getProduct()' required>
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
                                <label class="control-label col-form-label">Product</label>
                            </div>
                            <div class="col-md-9">
                                <select class="form-control" id="prod_id" name="prod_id" required>
									<option value='' >--Please Select--</option>
								</select>
                            </div>
                        </div>
						<div class="form-group row">
                            <div class="col-md-3">
                                <label class="control-label col-form-label">Cost</label>
                            </div>
                            <div class="col-md-9">
                                <input type="number" name="cost" class="form-control" placeholder="Cost" step='0.1'>
                            </div>
                        </div>
						<div class="form-group row">
                            <div class="col-md-3">
                                <label class="control-label col-form-label">Quantity</label>
                            </div>
                            <div class="col-md-9">
                                <input type="number" name="qty" class="form-control" placeholder="Quantity" >
                            </div>
                        </div>
						<div class="form-group row">
                            <div class="col-md-3">
                                <label class="control-label col-form-label">Date</label>
                            </div>
                            <div class="col-md-9">
                                <input type="date" name="date" class="form-control" placeholder="date" >
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