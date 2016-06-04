<?php include('header.php'); ?>


			<div>
				<ul class="breadcrumb">
					<li>
						<a href="<?php echo base_url();?>dashboard">Home</a> <span class="divider">/</span>
					</li>
					<li>
						<a href="<?php echo base_url();?>user/detailperusahaan">Detail Perusahaan</a> <span class="divider">/</span>
					</li>
					
				</ul>
			</div>
			
			
				<div class="row-fluid sortable">		
				<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2><span class="icon icon-color icon-user"></span> Detail Perusahaan</h2>
						<div class="box-icon">
							
						</div>
					</div>
					
					<div class="box-content">
						<div align="right">
							<button class="btn btn-primary" onClick="document.location='<?php 
								echo base_url().'user/inbox';
							?>'">Inbox</button>
						</div>
						<p>
					
					<!-- <div align="right">
					  	<button class="btn btn-small btn-primary" onClick="document.location='<?php echo base_url();?>user/add'">New User</button>
					  </div>-->
						<table class="table table-striped table-bordered bootstrap-datatable" id="datatable">
						  <thead>
							  <tr>
								  
								  <th>Nama Perusahaan</th>
								  <th>Pelaporan Tahun</th>
								  <th>Step 1</th>
								  <th>Step 2</th>
								  <th>Step 3</th>
								  <th>Step 4</th>
								  <th>Step 5</th>
								  <th>Step 6</th>
								  <th>Step 7</th>
								  <th>Step 8</th>
								  <th>Step Akhir</th>
								  <th width="15%">Action</th>
								  
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
			"sAjaxSource": "<?php echo base_url();?>user/get_listdetailperusahaan",
			"sServerMethod" : "POST",
			"sDom": "<'row-fluid'<'span6'l><'span6'f>r>t<'row-fluid'<'span12'i><'span12 center'p>>",
			"sPaginationType": "bootstrap",
			"oLanguage": {
				"sLengthMenu": "_MENU_ records per page"
			},
			"aoColumnDefs":[
				{
					"aTargets":[2],
					"sType":"string",
					"fnRender": function(obj){
						if (obj.aData[2] == '1'){
								status = '<span class="label label-success">Sudah</span>';
						}else{
								status = '<span class="label label-important">Belum</span>';
						}
						return status;
					}
				},
				{
					"aTargets":[3],
					"sType":"string",
					"fnRender": function(obj){
						if (obj.aData[3] == '1'){
								status = '<span class="label label-success">Sudah</span>';
						}else{
								status = '<span class="label label-important">Belum</span>';
						}
						return status;
					}
				},
				{
					"aTargets":[4],
					"sType":"string",
					"fnRender": function(obj){
						if (obj.aData[4] == '1'){
								status = '<span class="label label-success">Sudah</span>';
						}else{
								status = '<span class="label label-important">Belum</span>';
						}
						return status;
					}
				},
				{
					"aTargets":[5],
					"sType":"string",
					"fnRender": function(obj){
						if (obj.aData[5] == '1'){
								status = '<span class="label label-success">Sudah</span>';
						}else{
								status = '<span class="label label-important">Belum</span>';
						}
						return status;
					}
				},
				{
					"aTargets":[6],
					"sType":"string",
					"fnRender": function(obj){
						if (obj.aData[6] == '1'){
								status = '<span class="label label-success">Sudah</span>';
						}else{
								status = '<span class="label label-important">Belum</span>';
						}
						return status;
					}
				},
				{
					"aTargets":[7],
					"sType":"string",
					"fnRender": function(obj){
						if (obj.aData[7] == '1'){
								status = '<span class="label label-success">Sudah</span>';
						}else{
								status = '<span class="label label-important">Belum</span>';
						}
						return status;
					}
				},
				{
					"aTargets":[8],
					"sType":"string",
					"fnRender": function(obj){
						if (obj.aData[8] == '1'){
								status = '<span class="label label-success">Sudah</span>';
						}else{
								status = '<span class="label label-important">Belum</span>';
						}
						return status;
					}
				},
				{
					"aTargets":[9],
					"sType":"string",
					"fnRender": function(obj){
						if (obj.aData[9] == '1'){
								status = '<span class="label label-success">Sudah</span>';
						}else{
								status = '<span class="label label-important">Belum</span>';
						}
						return status;
					}
				},
				{
					"aTargets":[10],
					"sType":"string",
					"fnRender": function(obj){
						if (obj.aData[10] == '1'){
								status = '<span class="label label-success">Sudah</span>';
						}else{
								status = '<span class="label label-important">Belum</span>';
						}
						return status;
					}
				},
				{
					"aTargets":[11],
					"fnRender": function(obj){
						return '<span class="btn btn-mini btn-primary btnedit" id="'+'idp='+obj.aData[11]+'&tahun='+obj.aData[1]+'">Data</span>&nbsp;<span class="btn btn-mini btn-warning btnpesan" id="'+'idp='+obj.aData[11]+'">Pesan</span>';
						
					}
				}
				
				
			]
		}).columnFilter;
	});
	$(".btnedit").live('click', function(){
			
			var id = $(this).attr('id');
			window.open("<?php echo base_url();?>lihatlaporan?"+id); // the script where you handle the form input.
			
			
		});
	$(".btnpesan").live('click', function(){
			
			var id = $(this).attr('id');
			window.location.replace("<?php echo base_url();?>user/kirimpesan?"+id); // the script where you handle the form input.
			
			
		});
	function confirmdel(id){
		var j = confirm("Delete this user?");
		if(j){
			document.location = '<?php echo base_url();?>user/delete/'+id;
		}
	}
</script>