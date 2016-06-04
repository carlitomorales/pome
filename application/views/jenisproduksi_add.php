<?php include('header.php'); ?>


			<div>
				<ul class="breadcrumb">
					<li>
						<a href="<?php echo base_url();?>dashboard">Home</a> <span class="divider">/</span>
					</li>
					<li>
						<a href="<?php echo base_url();?>jenisproduksi">Master Data Jenis Produksi</a> <span class="divider">/</span>
					</li>
					<li>
						<a href="#">Add</a>
					</li>
				</ul>
			</div>
			
			<div class="row-fluid sortable">	
			
				<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2><span class="icon icon-color icon-user"></span> Add New Jenis Produksi</h2>
						<div class="box-icon">
							<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
							<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
						</div>
					</div>
					<div class="box-content">
						<form id="formadd" class="form-horizontal" action="<?php echo base_url();?>jenisproduksi/add_save/" method="post">
						<fieldset>
							<legend>List Jenis Produksi</legend>
							<div class="control-group">
							  <label class="control-label" for="jenis_energi">Jenis Energi </label>
							  <div class="controls">
								<input type="text" class="span6" id="jenis_energi" name="jenis_energi" />
							  </div>
							</div>
							<div class="control-group">
							  <label class="control-label" for="satuan">Satuan </label>
							  <div class="controls">
								<input type="satuan" class="span6" id="satuan" name="satuan" />
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
							<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
							<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
						</div>
					</div>
					<div class="box-content">
					  <div align="right">
					  	<button class="btn btn-small btn-primary" onClick="document.location='<?php echo base_url();?>user/add'">New User</button>
					  </div>
						<table class="table table-striped table-bordered bootstrap-datatable" id="datatable">
						  <thead>
							  <tr>
								  <th>User Name</th>
								  <th>Display Name</th>
								  <th>Privilege</th>
								  <th>Last Login</th>
								  <th>Active</th>
								  <th>Actions</th>
							  </tr>
						  </thead>  
					  </table>     
					</div>
				</div><!--/span-->
			
			</div><!--/row-->
    
<?php include('footer.php'); ?>

<script language="javascript">
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
					"aTargets":[4],
					"sType":"string",
					"fnRender": function(obj){
						switch(obj.aData[4]){
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