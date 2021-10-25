                <div class="card">
                    <div class="card-block"  id="inventory_balance">
						<table class="table table-bordered" width="100%">
							<thead>
								<tr>
									<th>#</th>
									<th>Category</th>
									<th>Product Name</th>
									<th>Description</th>
									<th>Cost</th>
									<th>Qty</th>
									<th>Amount</th>
								</tr>
							</thead>
							<tbody id=''>
							<?php
							include '../core/config.php';
								$prod_cat_id = $_POST['prod_type'];
								$fetch = mysql_query("SELECT * FROM tbl_product WHERE prod_cat_id='$prod_cat_id'");
								$count = 1;
								while($row = mysql_fetch_array($fetch)){
							?>
							<tr>
								<td><?php echo $count; ?></td>
								<td><?php echo getCategory($row['prod_cat_id']); ?></td>
								<td><?php echo $row['prod_name']; ?></td>
								<td><?php echo $row['prod_desc']; ?></td>
								<td><?php echo $row['cost']; ?></td>
								<td><?php echo getCurrentQty($row['prod_id']); ?></td>
								<td><?php echo getCurrentQty($row['prod_id']) * $row['cost']; ?></td>
							</tr>
							<?php $count++; } ?>
							</tbody>
						</table>
					</div>
				</div>