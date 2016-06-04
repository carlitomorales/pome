<?php include('header.php'); ?>


			<div>
				<ul class="breadcrumb">
					<li>
						<a href="<?php echo base_url();?>dashboard">Home</a> <span class="divider">/</span>
					</li>
					<li>
						<a href="<?php echo base_url();?>user/registration">Registration</a> <span class="divider">/</span>
					</li>
					
				</ul>
			</div>
			
			<div class="row-fluid sortable">	
			
				<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2><span class="icon icon-color icon-user"></span> Add New User</h2>
						
					</div>
					<div class="box-content">
						<form id="formadd" class="form-horizontal" action="<?php echo base_url();?>user/add_save/" method="post">
						<fieldset>
							
							<div class="control-group">
							  <label class="control-label" for="user_name">User Name </label>
							  <div class="controls">
								<input type="text" class="span6" id="user_name" name="user_name" />
							  </div>
							</div>
							<!--<div class="control-group">
							  <label class="control-label" for="pasword">Password </label>
							  <div class="controls">
								<input type="password" class="span6" id="pasword" name="pasword" />
							  </div>
							</div>
							<div class="control-group">
							  <label class="control-label" for="confirm_pasword">Confirm Password </label>
							  <div class="controls">
								<input type="password" class="span6" id="confirm_pasword" name="confirm_pasword" />
							  </div>
							</div>-->
							<div class="control-group">
							  <label class="control-label" for="real_name">Nama Perusahaan </label>
							  <div class="controls">
								<input type="text" class="span6" id="real_name" name="real_name" />
							  </div>
							</div>
							<div class="control-group">
							  <label class="control-label" for="email_perusahaan">Email Perusahaan </label>
							  <div class="controls">
								<input type="text" class="span6" id="email_perusahaan" name="email_perusahaan" />
							  </div>
							</div>
							<div class="control-group">
							  <label class="control-label" for="privilege_id">Privilege </label>
							  <div class="controls">
								<select id="privilege_id" name="privilege_id" data-rel="chosen">
									<option value="">- Select -</option>
								<?php
									foreach($privilege as $row){
										echo '<option value="'.$row['privilege_id'].'">'.$row['privilege_name'].'</option>';
									}
								?>
								  </select>
							  </div>
							</div>
						</fieldset> 
						<div class="form-actions">
						  <button type="submit" class="btn btn-primary">Save</button>
						  <button type="reset" class="btn" onClick="document.location='<?php echo base_url();?>user/add'">Cancel</button>
						</div>
						</form>   
					</div>
				</div><!--/span-->
			
			</div><!--/row-->
    
				<div class="row-fluid sortable">		
				<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2><span class="icon icon-color icon-user"></span> User Account</h2>
						<div class="box-icon">
							
						</div>
					</div>
					<div class="box-content">
					 <!-- <div align="right">
					  	<button class="btn btn-small btn-primary" onClick="document.location='<?php echo base_url();?>user/add'">New User</button>
					  </div>-->
						<table class="table table-striped table-bordered bootstrap-datatable" id="datatable">
						  <thead>
							  <tr>
								  <th>User Name</th>
								  <th>Nama Perusahaan</th>
								  <th>Email Perusahaan</th>
								  <th>Last Login</th>
								  <th>Privilege</th>
								  <th>Active</th>
								  <th>Actions</th>
							  </tr>
						  </thead>  
					  </table>     
					</div>
				</div><!--/span-->
			
			</div><!--/row-->
    
<?php include('footer.php'); ?>

<script type="text/javascript">
	$(document).ready(function(){
		$('#formadd').validate({
			rules:{
				user_name:{required:true},
				password:{required:true},
				confirm_password:{required:true, equalTo: "#password"},
				real_name:{required:true},
				privilege_id:{required:true}
			}
		});
	});
		$(document).ready(function(){
		$("#datatable").dataTable({
			"aaSorting":[[0,"desc"]],
			"bDestroy":true,
			"bProcessing": true,
			"bServerSide": true,
			"sAjaxSource": "<?php echo base_url();?>user/get_list",
			"sServerMethod" : "POST",
			"sDom": "<'row-fluid'<'span6'l><'span6'f>r>t<'row-fluid'<'span12'i><'span12 center'p>>",
			"sPaginationType": "bootstrap",
			"oLanguage": {
				"sLengthMenu": "_MENU_ records per page"
			},
			"aoColumnDefs":[
				{
					"aTargets":[5],
					"sType":"string",
					"fnRender": function(obj){
						switch(obj.aData[5]){
							case '0':
								status = '<span class="label label-important">No</span>';
							break;
							case '1':
								status = '<span class="label label-success">Yes</span>';
							break;
						}
						return status;
					}
				}
			]
		});
	});
	
	function confirmdel(id){
		var j = confirm("Delete this user?");
		if(j){
			document.location = '<?php echo base_url();?>user/delete/'+id;
		}
	}
</script>