<?php include('header.php'); ?>


			<div>
				<ul class="breadcrumb">
					<li>
						<a href="<?php echo base_url();?>dashboard">Home</a> <span class="divider">/</span>
					</li>
					<li>
						<a href="<?php echo base_url();?>privilege">Privileges</a> <span class="divider">/</span>
					</li>
					<li>
						<a href="#">List</a>
					</li>
				</ul>
			</div>
			
			<div class="row-fluid sortable">		
				<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2><span class="icon icon-color icon-key"></span> Privileges</h2>
						<div class="box-icon">

						</div>
					</div>
					<div class="box-content">
					  <div align="right">
					  	<button class="btn btn-small btn-primary" onClick="document.location='<?php echo base_url();?>privilege/add'">New Privilege</button>
					  </div>
						<table class="table table-striped table-bordered bootstrap-datatable" id="datatable">
						  <thead>
							  <tr>
								  <th>Privilege Name</th>
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
		$("#datatable").dataTable({
			"aaSorting":[[0,"desc"]],
			"bDestroy":true,
			"bProcessing": true,
			"bServerSide": true,
			"sAjaxSource": "<?php echo base_url();?>privilege/get_list",
			"sServerMethod" : "POST",
			"sDom": "<'row-fluid'<'span6'l><'span6'f>r>t<'row-fluid'<'span12'i><'span12 center'p>>",
			"sPaginationType": "bootstrap",
			"oLanguage": {
				"sLengthMenu": "_MENU_ records per page"
			},
			"aoColumnDefs":[
				{
					"aTargets":[1],
					"sType":"string",
					"fnRender": function(obj){
						switch(obj.aData[1]){
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