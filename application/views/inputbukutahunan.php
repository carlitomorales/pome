<?php include('header.php'); ?>
			<div>
				<ul class="breadcrumb">
					<li>
						<a href="<?php echo base_url();?>">Home</a> <span class="divider">/</span>
					</li>
					<li>
						<a href="#">Input Buku Tahunan</a></li>
				</ul>
			</div>
            
            <div class="row-fluid">
            	<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2>List Buku Tahunan</h2>
						<div class="box-icon">
                        	&nbsp;
						</div>
					</div>
					<div class="box-content">
                    	<table class="table table-striped table-bordered bootstrap-datatable" id="datatable1">
                          <thead>
                              <tr>
                                  <th align="center">Nama Buku Tahunan</th>
                                  <th align="center">Create By</th>
                                  <th align="center">Create Date</th>
                                  <th align="center">Update By</th>
                                  <th align="center">Update Date</th>
                                  <th align="center">Action</th>
                              </tr>
                          </thead>  
                      </table>
                    </div>
                </div>
             </div>
            <div class="row-fluid">
            	<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2>Input Buku Tahunan</h2>
						<div class="box-icon">
                        	&nbsp;
						</div>
					</div>
					<div class="box-content">
                    	<div id="divAlert"></div>
                    	<form id="frmAdd" class="form-horizontal" action="" method="post">
                            <div class="control-group">
							  <label class="control-label" for="nama_bukutahunan">Nama Buku Tahunan</label>
							  <div class="controls">
                              	<input type="text" class="input-xlarge" id="nama_bukutahunan" name="nama_bukutahunan" maxlength="100" />
                                <input type="hidden" id="id_bukutahunan" name="id_bukutahunan" />
						      </div>
						    </div>
                            
                          
                          <div class="control-group">
                            <label class="control-label" for="thumbnail">File Buku Tahunan</label>
                            <div class="controls">
                              <input class="input-file uniform_on" id="thumbnail" type="file" name="thumbnail">
                              <span id="spanthumbnail"></span>
                            </div>
                          </div>
                          
                          <div class="form-actions">
                          	<span class="btn btn-primary" id="addrow">Tambah Data</span>
                            <span class="btn btn-primary" id="cancelupdate" style="display:none">Batalkan</span>
                          </div>
                       </form>
                    </div>
                 </div>
             </div>
<?php include('footer.php'); ?>

	<script type="text/javascript">
	var oTable;
	var oEditor;
		
	$(document).ready(function(){
		//oEditor = $("#detail").cleditor()[0];
		oTable = $("#datatable1").dataTable({
			"aaSorting":[[0,"desc"]],
			"bDestroy":true,
			"bFilter":true,
			"bPaginate":true,
			"bInfo":true,
			"bProcessing": true,
			"bServerSide": true,
			"sAjaxSource": "<?php echo base_url();?>inputbukutahunan/get_list",
			"sServerMethod" : "POST",
			"sDom": "<'row-fluid'<'span6'l><'span6'f>r>t<'row-fluid'<'span12'i><'span12 center'p>>",
			"sPaginationType": "bootstrap",
			"oLanguage": {
				"sLengthMenu": "_MENU_ records per page"
			},
			"aoColumnDefs":[
				{
					"aTargets":[5],
					"fnRender": function(obj){
						return '<span class="btn btn-mini btn-primary btnedit" id="'+obj.aData[5]+'">Edit</span>&nbsp;<span class="btn btn-mini btn-warning btndelete" id="'+obj.aData[5]+'">Delete</span>&nbsp;';
					}
				}
			]
		});
		
		$(".btnedit").live('click', function(){
			var id = $(this).attr('id');
			var url = "<?php echo base_url();?>inputbukutahunan/getDetail/"+id; // the script where you handle the form input.
			$.post(url, '', function(data){
				objResp = $.parseJSON(data);
				rowdata = objResp[0];
				if(rowdata){
					$("#id_bukutahunan").val(rowdata.id_bukutahunan);
					$("#nama_bukutahunan").val(rowdata.nama_bukutahunan);
					if(rowdata.file_bukutahunan){
						if(rowdata.file_bukutahunan.length > 0){
							$("#spanthumbnail").html('<br>Uploaded file: <a href="<?php echo base_url();?>uploads/doc/'+rowdata.file_bukutahunan+'" target="_blank">View File</a>');
						}else{
							$("#spanthumbnail").html('');
						}
					}else{
						$("#spanthumbnail").html('');
					}	
					$("#cancelupdate").show();
					$("#addrow").html("Simpan Data");
				}else{
					$("#id_bukutahunan").val('');
					$("#nama_bukutahunan").val('');
					$("#spanthumbnail").html('');
					$("#thumbnail").val('');
					$("#cancelupdate").hide();
					$("#addrow").html("Tambah Data");
				}
				$("#divAlert").removeClass();
				$("#divAlert").html('');
			});
			return false;
		});
		
		$("#addrow").click(function(){
			if($("#nama_bukutahunan").val() == ''){
				$("#divAlert").removeClass();
				$("#divAlert").addClass('alert alert-error');
				$("#divAlert").html("Nama Buku Tahunan harus diisi.");
				$("#title").focus();
				return false;
			}
			$.ajaxFileUpload({
				url: "<?php echo base_url();?>inputbukutahunan/save",
				secureuri: false,
				fileElementId: 'thumbnail',
				dataType: 'json',
				data: {
					"id_bukutahunan": $("#id_bukutahunan").val(),
					"nama_bukutahunan": $("#nama_bukutahunan").val()
				},
				success: function(data, status){
					if(data.status != 'error'){

					   $("#divAlert").removeClass();
					   $("#divAlert").addClass('alert alert-success');
					   $("#divAlert").html(data.msg);
					   oTable.fnDraw();
					   $("#id_bukutahunan").val('');
						$("#nama_bukutahunan").val('');
						$("#spanthumbnail").html('');
						$("#thumbnail").val('');
						$("#cancelupdate").hide();
						$("#addrow").html("Tambah Data");
					}else{
					   $("#divAlert").removeClass();
					   $("#divAlert").addClass('alert alert-error');
					   $("#divAlert").html(data.msg);
					   oTable.fnDraw();
					   $("#spanthumbnail").html('');
                                           $("#thumbnail").val('');
					}
				},
				error: function(xhr, textStatus, errorThrown){
				   //console.log(errorThrown);
				}
			});
			return false;
		});
		
		$("#cancelupdate").click(function(){
			$("#id_bukutahunan").val('');
			$("#nama_bukutahunan").val('');
			$("#spanthumbnail").html('');
			$("#thumbnail").val('');
			$("#cancelupdate").hide();
			$("#addrow").html("Tambah Data");
			$("#divAlert").removeClass();
			$("#divAlert").html('');
		});
		
		$(".btndelete").live('click', function(){
			id = $(this).attr('id');
			conf = confirm("Hapus buku tahunan ini?");
			if(conf){
				var url = "<?php echo base_url();?>inputbukutahunan/hapus/"+id; // the script where you handle the form input.
				$.post(url, '', function(data){
				   oTable.fnDraw();
				    $("#id_bukutahunan").val('');
					$("#nama_bukutahunan").val('');
					$("#spanthumbnail").html('');
					$("#thumbnail").val('');
					$("#cancelupdate").hide();
					$("#addrow").html("Tambah Data");
				});	
				$("#divAlert").removeClass();
				$("#divAlert").html('');
				return false;
			}
		});
	});	
    </script>