<form  enctype="multipart/form-data" action='' method='POST' id='updateProdImg_form'>				
	<div class="modal fade" id="updateProdImg_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					Update Product Photo <font color='green' style='float:left;' id='photo_prod_name'></font>
				</div>
				<div class="modal-body">
					<center>
						<img class="profile-pic" src='' style='display:block;' width='200px' height='200px'>
						<input type='hidden' id='prod_id' name='prod_id'>
						<div class="upload-button btn btn-default fa fa-camera"> Upload Image</div>
						<input class="file-upload" type="file" accept="image/*" name="fileToUpload" id="fileToUpload">
					</center>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary" name="submit" id="upload_submit" onclick=""><span class="fa fa-edit"></span> UPDATE</button>
					<button type="button" class="btn btn-danger" data-dismiss="modal"><span class="fa fa-times-circle"></span> CANCEL</button>
				</div>
			</div>
		</div>
	</div>
</form>