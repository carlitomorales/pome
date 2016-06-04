<?php include('header.php'); ?>


			<div>
				<ul class="breadcrumb">
					<li>
						<a href="<?php echo base_url();?>dashboard">Home</a> <span class="divider">/</span>
					</li>
					<li>
						<a href="<?php echo base_url();?>user/registration">Registrasi</a> <span class="divider">/</span>
					</li>
					<li>
						<a href="<?php echo base_url();?>user/change_email_perusahaan">Ganti Email Perusahaan</a> <span class="divider">/</span>
					</li>
					
				</ul>
			</div>
			
			<div class="row-fluid sortable">	
			
				<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2><span class="icon icon-color icon-user"></span> Ganti Email Perusahaan</h2>
						<div class="box-icon">
							
						</div>
					</div>
					<div class="box-content">
						<form id="formadd" class="form-horizontal" action="<?php echo base_url();?>user/add_save_change_email" method="post">
				<fieldset>
				<div class="control-group">
					<label class="control-label" for="user_name">Nama Perusahaan </label>
						<div class="controls">
							<input type="text" class="span6" id="real_name" name="user_name" value="<?php echo $real_name;?>" disabled="disabled" />				
							
						</div>
						
					<label class="control-label" for="new_email_perusahaan">Email Perusahaan Baru </label>
						<div class="controls">
							<input type="text" class="span6" id="new_email_perusahaan" name="new_email_perusahaan" />
						</div>
						</div>

						<input type="hidden" name="old_email" id="old_email" value="<?php echo $old_email;?>"
						</div>
						<input type="hidden" name="user_name" id="user_name" value="<?php echo $user_name;?>"
				</fieldset> 
						<div class="form-actions">
						  <button type="submit" class="btn btn-primary">Save</button>
						  <button type="reset" class="btn" onClick="document.location='<?php echo base_url();?>user/change_password'">Cancel</button>
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
				new_email_perusahaan:{required:true}
				
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