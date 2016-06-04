<?php include('header.php'); ?>


			<div>
				<ul class="breadcrumb">
					<li>
						<a href="<?php echo base_url();?>dashboard">Home</a> <span class="divider">/</span>
					</li>
					
					
				</ul>
			</div>
			
			<div class="row-fluid sortable">	
			
				<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2><span class="icon icon-color icon-user"></span> Kirim Pesan</h2>
						<div class="box-icon">
							
						</div>
					</div>
					<div class="box-content">
						<form id="formadd" class="form-horizontal" action="<?php echo base_url();?>user/add_kirim_pesan?idp=<?php echo $idp;?>" method="post">
				<fieldset>
				<div class="control-group">
					<label class="control-label" for="user_name">Nama Perusahaan </label>
						<div class="controls">
							<input type="text" class="span6" id="real_namep" name="real_namep" value="<?php echo $real_namep;?>" disabled="disabled" />				
							<input type="hidden" id="usernamep" name="usernamep" value="<?php echo $usernamep;?>"  />					
						</div>
				</div>
				<?php if ($this->session->userdata('privilege_id')=='2' ) {?>
				 <div class="control-group">
					  <label class="control-label" for="kegiatan">Template Pesan</label>
					  <div class="controls">
						<select name="template" id="template">
							  <option selected value="default">Tanpa Template</option>
							  <option  value="template1">Template Konfirmasi</option>
						</select>
					  </div>
				</div>
				<?php }?>
				<div class="control-group">
					<label class="control-label" for="new_email_perusahaan">Judul</label> 
					<div class="controls">
						<input type="text" class="span6" id="judul_pesan" name="judul_pesan" value="<?php echo $subjectp;?>" />
					</div>
					
				</div>
				
				<div class="control-group">
					<label class="control-label" for="new_email_perusahaan">Isi Pesan</label>
					<div class="controls">
						 <textarea style="height: 241px; width: 406px;" id="isi_pesan" name="isi_pesan" class="autogrow"></textarea>
					</div>
				</div>

				<div class="control-group">		
						<div class="control-label">
						  <button type="submit" class="btn btn-primary">Kirim</button>
						</div>	
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