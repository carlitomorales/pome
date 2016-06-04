<?php include('header.php'); ?>
			<div>
				<ul class="breadcrumb">
					<li>
						<a href="#">Home</a> <span class="divider">/</span>
					</li>
					<li>
						<a href="#">Master Data</a> <span class="divider">/</span>
                    </li>
                    <li>
						<a href="#">Input Master Data Jenis Peralatan</a>
                    </li>
				</ul>
			</div>
			
			<div class="row-fluid">	
                <div class="box span12">
					<div class="box-header well" data-original-title>
						<h2>List Jenis Peralatan</h2>
					</div>
					<div class="box-content">
					        <table class="table table-striped table-bordered bootstrap-datatable" id="datatable1">
                                  <thead>
                                      <tr>
                                          <th>Jenis Peralatan</th>
                                          <th>Type Perusahaan</th>
                                          <th>Actions</th>
                                      </tr>
                                  </thead>
                                  
                              </table>
                          
                    </div>
                </div>
             </div>
            <div class="row-fluid">
            	<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2>Input Jenis Peralatan</h2>
					</div>
					<div class="box-content">
                    	<div id="divAlert"></div>
                    	<form id="frmAdd" class="form-horizontal" method="post">
                        <div class="control-group" id='divSubSektor'>
                                      <label class="control-label" for="type_perusahaan">Type Perusahaan</label>
                                          <div class="controls">
                                                <select id="type_perusahaan" name="type_perusahaan">
                                	<option selected value="">-- Pilih --</option>
							      		<?php
								  			
											foreach($data_type_perusahaan as $row){
												//echo "<option value='".$row->id."'>".$row->value."</option>";
												echo "<option value='".$row->IdMTypePerusahaan."'>".$row->TypePerusahaan."</option>";
											}
										?>
                                </select>
                                          </div>
                            </div>
                                                                               	
                            <div class="control-group">
                                    <label class="control-label" for="jenis_peralatan">Jenis Peralatan</label>
                                    <div class="controls">
                                      <input class="input-xlarge focused" id="jenis_peralatan" type="text" name="jenis_peralatan">
                                       <input type="hidden" id="id_jenis_peralatan" name="id_jenis_peralatan" />
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
             <div class="row-fluid">
                <div class="box span12">
                	<div class="box-content">
                    	<span class="btn btn-primary" onClick="document.location='<?php echo base_url();?>orgenergi'">Previous</span>
						<span class="btn btn-primary" onClick="document.location='<?php echo base_url();?>pemakaianenergi'" style="float:right">Next</span>
                    </div>
                </div>
              </div>
<?php include('footer.php'); ?>

	<script type="text/javascript">
	var oTable;
		
	$(document).ready(function(){
		
		oTable = $("#datatable1").dataTable({
			"aaSorting":[[2,"desc"]],
			"bDestroy":true,
			"bFilter":true,
			"bPaginate":true,
			"bInfo":true,
			"bProcessing": true,
			"bServerSide": true,
			"sAjaxSource": "<?php echo base_url();?>jenisperalatan/listjenisperalatan",
			"sServerMethod" : "POST",
			"sDom": "<'row-fluid'<'span6'l><'span6'f>r>t<'row-fluid'<'span12'i><'span12 center'p>>",
			"sPaginationType": "bootstrap",
			"oLanguage": {
				"sLengthMenu": "_MENU_ records per page"
			},
			"aoColumnDefs":[
				{
					"aTargets":[1],
					"fnRender": function(obj){
						return obj.aData[1];
					}
				},
				{
					"aTargets":[2],
					"fnRender": function(obj){
						return '<span class="btn btn-mini btn-primary btnedit" id="'+obj.aData[2]+'">Edit</span>&nbsp;<span class="btn btn-mini btn-warning btndelete" id="'+obj.aData[2]+'">Delete</span>&nbsp;';
					}
				}
			]
		});
		
		$(".btnedit").live('click', function(){
			$("#divAlert").removeClass();
			$("#divAlert").html('');
			var id = $(this).attr('id');
			var url = "<?php echo base_url();?>jenisperalatan/getDetail/"+id; // the script where you handle the form input.
			$.post(url, '', function(data){
				objResp = $.parseJSON(data);
				rowdata = objResp[0];
				if(rowdata){
					$("#id_jenis_peralatan").val(rowdata.IdJenisPeralatan);
					$("#jenis_peralatan").val(rowdata.JenisPeralatan);
					$("#type_perusahaan").val(rowdata.IdTypePerusahaan);
					$("#cancelupdate").show();
					$("#addrow").html("Simpan Data");
				}else{
					$("#id_jenis_peralatan").val('');
				    $("#jenis_peralatan").val('');
				    $("#type_perusahaan").val('');
				    $("#cancelupdate").hide();
					$("#addrow").html("Tambah Data");
				}
			});
			return false;
		});
		
		$("#addrow").click(function(){
			if($("#jenis_peralatan").val() == ''){
				$("#divAlert").removeClass();
				$("#divAlert").addClass('alert alert-error');
				$("#divAlert").html("Jenis peralatan harus diisi.");
				$("#jenis_peralatan").focus();
				return false;
			}
			if($("#type_perusahaan").val() == ''){
				$("#divAlert").removeClass();
				$("#divAlert").addClass('alert alert-error');
				$("#divAlert").html("Type Perusahaan harus dipilih.");
				$("#type_perusahaan").focus();
				return false;
			}
			var url = "<?php echo base_url();?>jenisperalatan/save"; // the script where you handle the form input.
			$.post(url, $("#frmAdd").serialize(), function(data){
			   resp = $.parseJSON(data);
				if(resp.status == "success"){
					$("#divAlert").removeClass();
					$("#divAlert").addClass('alert alert-success');
					$("#divAlert").html(resp.msg);
				}else{
					$("#divAlert").removeClass();
					$("#divAlert").addClass('alert alert-error');
					$("#divAlert").html(resp.msg);
				}
			   oTable.fnDraw();
				$("#id_jenis_peralatan").val('');
				$("#jenis_peralatan").val('');
				$("#type_perusahaan").val('');
				$("#cancelupdate").hide();
				$("#addrow").html("Tambah Data");			
			});	
			return false;
		});
		
		$("#cancelupdate").click(function(){
			$("#id_jenis_peralatan").val('');
			$("#jenis_peralatan").val('');
			$("#type_perusahaan").val('');
			$("#cancelupdate").hide();
			$("#addrow").html("Tambah Data");
		});
		
		$(".btndelete").live('click', function(){
			$("#divAlert").removeClass();
			$("#divAlert").html('');
			id = $(this).attr('id');
			conf = confirm("Hapus data jenis peralatan ini?");
			if(conf){
				var url = "<?php echo base_url();?>jenisperalatan/hapus/"+id; // the script where you handle the form input.
				$.post(url, '', function(data){
				   oTable.fnDraw();
				   $("#id_jenis_peralatan").val('');
				   $("#jenis_peralatan").val('');
				   $("#type_perusahaan").val('');
				   $("#cancelupdate").hide();
				   $("#addrow").html("Tambah Data");
				});	
				return false;
			}
		});

	});	
    </script>