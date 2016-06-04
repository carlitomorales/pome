<?php include('header.php'); ?>
<?php
	if($product){
		foreach($product as $rowproduct){
			$product_id = $rowproduct['product_id'];
			$product_name = $rowproduct['product_name'];
			$product_code = $rowproduct['product_code'];
			$category_id = $rowproduct['category_id'];
			$description = $rowproduct['description'];
			$uom = $rowproduct['uom'];
			$length = $rowproduct['length'];
			$width = $rowproduct['width'];
			$height = $rowproduct['height'];
			$weight = $rowproduct['weight'];
			$remarks = $rowproduct['remarks'];
			$is_material = $rowproduct['is_material'];
			$active = $rowproduct['active'];
			$last_vendor_id = $rowproduct['last_vendor_id'];
			$vendor_product_id = $rowproduct['vendor_product_id'];
			$reorder_qty = $rowproduct['reorder_qty'];
			$default_location_id = $rowproduct['default_location_id'];
		}
	}else{
		$product_id = '';
		$product_name = '';
		$product_code = '';
		$category_id = '';
		$description = '';
		$uom = '';
		$length = '';
		$width = '';
		$height = '';
		$weight = '';
		$remarks = '';
		$is_material = '';
		$active = '';
		$last_vendor_id = '';
		$vendor_product_id = '';
		$reorder_qty = '';
		$default_location_id = '';
	}
?>
			<div>
				<ul class="breadcrumb">
					<li>
						<a href="<?php echo base_url();?>dashboard">Home</a> <span class="divider">/</span>
					</li>
					<li>
						<a href="<?php echo base_url();?>product">Product</a> <span class="divider">/</span>
					</li>
					<li>
						<a href="#">Edit</a>
					</li>
				</ul>
			</div>
			
			<div class="row-fluid sortable">		
				<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2><span class="icon icon-color icon-inbox"></span> Edit Product</h2>
						<div class="box-icon">
							<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
							<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
						</div>
					</div>
					<div class="box-content">
						<form id="formadd" class="form-horizontal" action="<?php echo base_url();?>product/edit_save/" method="post">
						<fieldset>
							<legend>Product Detail</legend>
							<div class="control-group">
							  <label class="control-label" for="product_code">Code </label>
							  <div class="controls">
								<input type="text" class="span6" id="product_code" name="product_code" value="<?php echo $product_code;?>" />
								<input type="hidden" id="product_id" name="product_id" value="<?php echo $product_id;?>" />
							  </div>
							</div>
							<div class="control-group">
							  <label class="control-label" for="product_name">Name </label>
							  <div class="controls">
								<input type="text" class="span6" id="product_name" name="product_name" value="<?php echo $product_name;?>" />
							  </div>
							</div>
							<div class="control-group">
							  <label class="control-label" for="category_id">Category </label>
							  <div class="controls">
								<select id="category_id" name="category_id" data-rel="chosen">
									<option value="">- Select -</option>
								<?php
									foreach($category as $row){
										echo '<option value="'.$row['category_id'].'"';
										if($category_id == $row['category_id']){echo ' selected ';}
										echo '>'.$row['category_name'].'</option>';
									}
								?>
								  </select>
							  </div>
							</div>
							<div class="control-group">
							  <label class="control-label" for="description">Description </label>
							  <div class="controls">
								<textarea id="description" name="description" class="autogrow"><?php echo $description;?></textarea>
							  </div>
							</div>
							<div class="control-group">
							  <label class="control-label" for="uom">Unit Of Measurement (UOM) </label>
							  <div class="controls">
								<input type="text" class="span6" id="uom" name="uom" value="<?php echo $uom;?>" />
							  </div>
							</div>
							<div class="control-group">
							  <label class="control-label" for="default_location_id">Warehouse </label>
							  <div class="controls">
								<select id="default_location_id" name="default_location_id" data-rel="chosen">
									<option value="">- Select -</option>
								<?php
									foreach($warehouse as $row){
										echo '<option value="'.$row['warehouse_id'].'"';
										if($default_location_id == $row['warehouse_id']){echo ' selected ';}
										echo '>'.$row['warehouse_name'].'</option>';
									}
								?>
								  </select>
							  </div>
							</div>							
							<div class="control-group">
							  <label class="control-label" for="is_material">Is Material </label>
							  <div class="controls">
								<select id="is_material" name="is_material" data-rel="chosen">
									<option value="">- Select -</option>
									<option value="1" <?php if($is_material == 1){echo " selected ";}?>>Yes</option>
									<option value="0" <?php if($is_material == 0){echo " selected ";}?>>No</option>
								  </select>
							  </div>
							</div>							
							<div class="control-group">
							  <label class="control-label" for="active">Active </label>
							  <div class="controls">
								<select id="active" name="active" data-rel="chosen">
									<option value="">- Select -</option>
									<option value="1" <?php if($active == 1){echo " selected ";}?>>Yes</option>
									<option value="0" <?php if($active == 0){echo " selected ";}?>>No</option>
								  </select>
							  </div>
							</div>
							<div class="control-group">
							  <label class="control-label" for="remarks">Remarks </label>
							  <div class="controls">
								<textarea id="remarks" name="remarks" class="autogrow"><?php echo $remarks;?></textarea>
							  </div>
							</div>
						</fieldset> 
						<fieldset>
							<legend>Measurements</legend>							
							<div class="control-group">
							  <label class="control-label" for="length">Length </label>
							  <div class="controls">
								<input type="text" class="span6" id="length" name="length" value="<?php echo $length;?>" />
							  </div>
							</div>
							<div class="control-group">
							  <label class="control-label" for="width">Width </label>
							  <div class="controls">
								<input type="text" class="span6" id="width" name="width" value="<?php echo $width;?>" />
							  </div>
							</div>
							<div class="control-group">
							  <label class="control-label" for="height">Height </label>
							  <div class="controls">
								<input type="text" class="span6" id="height" name="height" value="<?php echo $height;?>" />
							  </div>
							</div>
							<div class="control-group">
							  <label class="control-label" for="weight">Weight </label>
							  <div class="controls">
								<input type="text" class="span6" id="weight" name="weight" value="<?php echo $weight;?>" />
							  </div>
							</div>
						</fieldset>
						<fieldset>
							<legend>Vendor Info</legend>	
							<div class="control-group">
							  <label class="control-label" for="last_vendor_id">Vendor </label>
							  <div class="controls">
								<select id="last_vendor_id" name="last_vendor_id" data-rel="chosen">
									<option value="">- Select -</option>
								<?php
									foreach($vendor as $row){
										echo '<option value="'.$row['vendor_id'].'"';
										if($last_vendor_id == $row['vendor_id']){echo ' selected ';}
										echo '>'.$row['vendor_name'].'</option>';
									}
								?>
								  </select>
							  </div>
							</div>
							<div class="control-group">
							  <label class="control-label" for="vendor_product_id">Vendor Product ID </label>
							  <div class="controls">
								<input type="text" class="span6" id="vendor_product_id" name="vendor_product_id" value="<?php echo $vendor_product_id;?>" />
							  </div>
							</div>
							<div class="control-group">
							  <label class="control-label" for="reorder_qty">Reorder Qty </label>
							  <div class="controls">
								<input type="text" class="span6" id="reorder_qty" name="reorder_qty" value="<?php echo $reorder_qty;?>" />
							  </div>
							</div>
						</fieldset>
						<fieldset>
							<legend>Price Info</legend>	
							<table class="table">
								<thead>
									<tr>
										<th>Price Scheme</th>
										<th>Currency</th>
										<th>Price</th>
									</tr>
								</thead>
								<tbody>
								<?php
									foreach($pricescheme as $row){
										$price_scheme_id = $row['price_scheme_id'];
										$price_scheme_name = $row['price_scheme_name'];
										$currency = $row['currency_code'];
										$price = $row['price'];
								?>
									<tr>
										<td><?php echo $price_scheme_name;?>
											<input type="hidden" name="price_scheme_id[]" value="<?Php echo $price_scheme_id;?>" />
										</td>
										<td><?php echo $currency;?></td>
										<td><input type="text" class="input-medium" id="price_<?php echo $price_scheme_id;?>" name="price_<?php echo $price_scheme_id;?>" value="<?php echo $price;?>" /></td>
									</tr>
								<?php
									}
								?>
								</tbody>
							</table>
						</fieldset>
						<div class="form-actions">
						  <button type="submit" class="btn btn-primary">Save</button>
						  <button type="reset" class="btn" onClick="document.location='<?php echo base_url();?>product/add'">Cancel</button>
						</div>
						</form>   
					</div>
				</div><!--/span-->
			
			</div><!--/row-->
    
<?php include('footer.php'); ?>

<script language="javascript">
	$(document).ready(function(){
		$('#formadd').validate({
			rules:{
				product_code:{required:true},
				product_name:{required:true},
				description:{required:true},
				default_location_id:{required:true},
			<?php
				$i=0;
				foreach($pricescheme as $row){
					$price_scheme_id = $row['price_scheme_id'];
			?>
				price_<?php echo $price_scheme_id;?>:{required:true, min:0}
			<?php
					$i += 1;
					if($i < count($pricescheme)){echo ",";}
				}
			?>
			}
		});
	});
</script>