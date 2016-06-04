
<?php include('header.php'); ?>


			<div>
				<ul class="breadcrumb">
					<li>
						<a href="<?php echo base_url();?>dashboard">Home</a> <span class="divider">/</span>
					</li>
					<li>
						<a href="<?php echo base_url();?>user/inbox">Inbox</a> <span class="divider">/</span>
					</li>
					
				</ul>
			</div>


<div class="row-fluid sortable">
    <div class="box col-md-4">
        <div class="box-inner homepage-box">
            <div class="box-header well">
                <h2><i class="glyphicon glyphicon-th"></i> Inbox</h2>
                
            </div>
            <div class="box-content">
                <ul class="nav nav-tabs" id="myTab">
                    <li><a href="#info">Inbox Normal</a></li>
                    <li><a href="#custom">Inbox Notifikasi</a></li>
                    <li class="active"><a href="#messages">Kirim Pesan</a></li>
                </ul>
                <div id="myTabContent" class="tab-content">
                    <div class="tab-pane active" id="info">
                        <div class="box-content">
							
							<div>
								<table class="table table-striped table-bordered bootstrap-datatable" id="datatable">
									  <thead>
										  <tr>

											  <th>Dari</th>
											  <th>Pesan&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
											  <th>Waktu Pengiriman</th>
											  <th>Action</th>

										  </tr>
									  </thead>
								</table>
							</div>
						</div>
                    </div>
                    <div class="tab-pane" id="custom">
                        <div class="box-content">
							
							<div>
								<table class="table table-striped table-bordered bootstrap-datatable" id="datatable1">
									  <thead>
										  <tr>

											  <th>Dari</th>
											  <th>Pesan&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
											  <th>Waktu Pengiriman</th>
											  <th>Action</th>

										  </tr>
									  </thead>
								</table>
							</div>
						</div>
                    </div>
					<div class="tab-pane" id="messages">
						<div class="box-content">
							<form id="formadd" class="form-horizontal" action="<?php echo base_url();?>user/add_kirim_pesan" method="post"  enctype='multipart/form-data' >
							<fieldset>
							<?php if ($this->session->userdata('privilege_id')=='2' ) {?>
							<div class="control-group">
								  <label class="control-label" for="kegiatan">Template Pesan</label>
								  <div class="controls">
									<select name="template" id="template" onChange="TypeTempChange()">
										  <option selected value="default">Tanpa Template</option>
										  <option  value="template1">Template Konfirmasi</option>
									</select>
									<script type="text/javascript">
									function TypeTempChange(){
										var selectValues = document.getElementById('template').value;
										if (selectValues == 'default'){
											$('#dvtoperusahaan').show();
											$('#dvtoperusahaansinlge').hide();	
										}else{
											$('#dvtoperusahaansinlge').show();
											$('#dvtoperusahaan').hide();	
										}
									};
								   </script>
								  </div>
							</div>
							<?php }?>
							<div class="control-group">
								<label class="control-label" for="user_name">Kirim ke </label>
								<?php if ($this->session->userdata('privilege_id')!=='2' ) {?>
								<div class="controls">
									<input type="text" class="span6" id="real_namep" name="real_namep" value="<?php echo $real_namep;?>" disabled="disabled" />				
									<input type="hidden" id="usernamep" name="usernamep" value="<?php echo $usernamep;?>"  />
									<input type="hidden" id="idp" name="idp" value="<?php echo $idp;?>"  />									
								</div>
								<?php } else { ?>
								<div class="controls" id="dvtoperusahaan" >
									<select class="span6" style="width: 406px;" id="toperusahaan" name="toperusahaan[]" multiple data-rel="chosen">
										<?php
								  			foreach($allperusahaan as $rowall){
												//echo "<option value='".$row->id."'>".$row->value."</option>";
												echo "<option value='".$rowall->IdPerusahaan."'>".$rowall->user_name." (".$rowall->NamaPerusahaan.")</option>";
											}
										?>
									</select>
								</div>
								<div class="controls" style="display:none" id="dvtoperusahaansinlge" >
									<select class="span6" id="toperusahaansinlge" name="toperusahaansinlge"  style="width: 406px;" data-rel="chosen">
										<?php
								  			foreach($allperusahaan as $rowall){
												//echo "<option value='".$row->id."'>".$row->value."</option>";
												echo "<option value='".$rowall->IdPerusahaan."'>".$rowall->user_name." (".$rowall->NamaPerusahaan.")</option>";
											}
										?>
									</select>
									<input type="hidden" id="usernamep" name="usernamep" value="<?php echo $usernamep;?>"  />					
								</div>
								<?php }?>
							</div>
							
							<div class="control-group">
								<label class="control-label" for="new_email_perusahaan">Judul</label> 
								<div class="controls">
									<input type="text" class="span6" id="judul_pesan" name="judul_pesan" style="width: 406px;" value="<?php echo $subjectp;?>" />
								</div>
								
								
							</div>
					
							<div class="control-group">
								<label class="control-label" for="new_email_perusahaan">Isi Pesan</label>
								<div class="controls">
									 <textarea style="height: 241px; width: 406px;" id="isi_pesan" name="isi_pesan" class="autogrow"></textarea>
								</div>
							</div>
							
							 <div class="control-group">
							    <label class="control-label" for="fileRingkas">File Attach (max 4MB)</label>
							    <div class="controls">
							      <input class="input-file uniform_on" id="fileRingkas" type="file" name="fileRingkas">
                                  <span id="spanFile"></span>
						        </div>
						    </div>

							<div class="control-group">		
									<div class="control-label">
									  <button type="submit" class="btn btn-primary">Kirim</button>
									</div>	
							</div>				
							</form>   
						</div>
                    </div>
                </div>
            </div>
        </div>
    </div>


				
				



					
				

			
    
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
			"sAjaxSource": "<?php echo base_url();?>user/get_listinbox",
			"sServerMethod" : "POST",
			"sDom": "<'row-fluid'<'span6'l><'span6'f>r>t<'row-fluid'<'span12'i><'span12 center'p>>",
			"sPaginationType": "bootstrap",
			"oLanguage": {
				"sLengthMenu": "_MENU_ records per page"
			},
			"aoColumnDefs":[
			
				{
					"aTargets":[3],
					"fnRender": function(obj){
						return '<span class="btn btn-mini btn-primary btnpesan" id="'+obj.aData[3]+'">Baca Pesan</span>';
						
					}
				}
				
				
			]
		}).columnFilter;
		
		$("#datatable1").dataTable({
			"aaSorting":[[0,"desc"]],
			"bDestroy":true,
			"bProcessing": true,
			"bServerSide": true,
			"sAjaxSource": "<?php echo base_url();?>user/get_listinbox_notif",
			"sServerMethod" : "POST",
			"sDom": "<'row-fluid'<'span6'l><'span6'f>r>t<'row-fluid'<'span12'i><'span12 center'p>>",
			"sPaginationType": "bootstrap",
			"oLanguage": {
				"sLengthMenu": "_MENU_ records per page"
			},
			"aoColumnDefs":[
			
				{
					"aTargets":[3],
					"fnRender": function(obj){
						return '<span class="btn btn-mini btn-primary btnpesan" id="'+obj.aData[3]+'">Baca Pesan</span>';
						
					}
				}
				
				
			]
		}).columnFilter;
		
		$("#datatablekirim").dataTable({
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
		
		$("#submit").click(function(){
			$.ajaxFileUpload({
				url: "<?php echo base_url();?>User/add_kirim_pesan",
				secureuri: false,
				fileElementId: 'fileRingkas',
				dataType: 'json',
				data: {
					'judul_pesan': $("#judul_pesan").val(),
					'isi_pesan': $("#isi_pesan").val(),
					'keterangan_audit':$("#keterangan_audit").val()
				},
				success: function(data, status){
					//console.log(data.status);
					if(data.status != 'error'){
					   $("#divAlert").removeClass();
					   $("#divAlert").addClass('alert alert-success');
					   $("#divAlert").html(data.msg);
					   oTable.fnDraw();
					   $("#judul_pesan").val('');					   
					   $("#isi_pesan").val('');
					   $("#fileRingkas").val('');
					   $("#spanFile").html('');
					   $("#cancelupdate").hide();
					   
					}else{
					   $("#divAlert").removeClass();
					   $("#divAlert").addClass('alert alert-error');
					   $("#divAlert").html(data.msg);
					   oTable.fnDraw();
					}
				},
				error: function(xhr, textStatus, errorThrown){
				   //console.log(errorThrown);
				}
			});
		});
		
	});
	
	
	
	$(".btnpesan").live('click', function(){
			
			var id = $(this).attr('id');
			window.location.replace("<?php echo base_url();?>user/bacainbox?id="+id); // the script where you handle the form input.
			
			
		});
	function confirmdel(id){
		var j = confirm("Delete this user?");
		if(j){
			document.location = '<?php echo base_url();?>user/delete/'+id;
		}
	}
</script>