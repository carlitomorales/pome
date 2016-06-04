<?php include('header.php'); ?>


			<div>
				<ul class="breadcrumb">
					<li>
						<a href="<?php echo base_url();?>dashboard">Home</a> <span class="divider">/</span>
					</li>
					<li>
						<a href="<?php echo base_url();?>privilege">Privilege</a> <span class="divider">/</span>
					</li>
					<li>
						<a href="#">Add</a>
					</li>
				</ul>
			</div>
			
			<div class="row-fluid sortable">		
				<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2><span class="icon icon-color icon-key"></span> Add New Privilege</h2>
						<div class="box-icon">

						</div>
					</div>
					<div class="box-content">
						<form id="formadd" class="form-horizontal" action="<?php echo base_url();?>privilege/add_save/" method="post">
						<fieldset>
							<legend>Privilege Detail</legend>
							<div class="control-group">
							  <label class="control-label" for="privilege_name">Privilege Name </label>
							  <div class="controls">
								<input type="text" class="span6" id="privilege_name" name="privilege_name" />
							  </div>
							</div>
						</fieldset> 
						<div class="form-actions">
						  <button type="submit" class="btn btn-primary">Save</button>
						  <button type="reset" class="btn" onClick="document.location='<?php echo base_url();?>privilege/add'">Cancel</button>
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
				privilege_name:{required:true}
			}
		});
	});
</script>