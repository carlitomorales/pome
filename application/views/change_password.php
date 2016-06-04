<?php include('header.php'); ?>


			<div>
				<ul class="breadcrumb">
					<li>
						<a href="<?php echo base_url();?>dashboard">Home</a> <span class="divider">/</span>
					</li>
					<li>
						<a href="<?php echo base_url();?>setting/change_password">Ganti Password</a> <span class="divider">/</span>
					</li>
					
				</ul>
			</div>
			
			<div class="row-fluid sortable">	
			
				<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2><span class="icon icon-color icon-user"></span> Ganti Password</h2>
						<div class="box-icon">
							
						</div>
					</div>
					<div class="box-content">
						<form id="formadd" class="form-horizontal" action="<?php echo base_url();?>setting/change_password_save/" method="post">
						<fieldset>
							
							<div class="control-group">
							  <label class="control-label" for="user_name">User Name </label>
							  <div class="controls">
								<input type="text" class="span6" id="user_name" name="user_name" value="<?php echo $user;?>" disabled="disabled" />
							  </div>
							</div>
							<div class="control-group">
							  <label class="control-label" for="old_password">Password Sekarang</label>
							  <div class="controls">
								<input type="password" class="span6" id="old_password" name="old_password" />
								<span><?php echo $message;?></span>
								
							  </div>
							  
							</div>
							<div class="control-group">
							  <label class="control-label" for="password">Password Baru</label>
							  <div class="controls">
								<input type="password" class="span6" id="password" name="password" />
							  </div>
							</div>
							<div class="control-group">
							  <label class="control-label" for="confirm_password">Ulang Password Baru</label>
							  <div class="controls">
								<input type="password" class="span6" id="confirm_password" name="confirm_password" />
							  </div>
							</div>
							<div class="controls">
							<input type="hidden" name="user_name" id="user_name" value="<?php echo $user;?>"
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
    
				
    
<?php include('footer.php'); ?>

<script language="javascript">
	$(document).ready(function(){
		$('#formadd').validate({
			rules:{
				user_name:{required:true},
				old_password:{required:true},
				password:{required:true},
				confirm_password:{required:true, equalTo: "#password"},
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
		var j = confirm("reset password this user?");
		if(j){
			document.location = '<?php echo base_url();?>user/reset/'+id;
		}
	}
</script>