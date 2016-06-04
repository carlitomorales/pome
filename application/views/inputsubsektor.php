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
						<a href="#">Input Master Data Subsektor</a>
                    </li>
				</ul>
			</div>
			
			<div class="row-fluid">	
                <div class="box span12">
					<div class="box-header well" data-original-title>
						<h2>List Subsektor</h2>
					</div>
					<div class="box-content">
					        <table class="table table-striped table-bordered bootstrap-datatable" id="datatable1">
                                  <thead>
                                      <tr>
                                          <th>Subsektor</th>
										  <th>Satuan Produksi</th>
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
						<h2>Input Subsektor</h2>
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
                                    <label class="control-label" for="jenis_peralatan">Subsektor</label>
                                    <div class="controls">
                                      <input class="input-xlarge focused" id="subsektor" type="text" name="subsektor">
                                       <input type="hidden" id="id_subsektor" name="id_subsektor" />
                                    </div>
                                  </div>
								  
							<div class="control-group" id='divSubSektor'>
                                <label class="control-label" for="satuan_produksi">Satuan Produksi</label>
                                          <div class="controls">
                                <select id="satuan_produksi" name="satuan_produksi">
                                	<option selected value="">-- Pilih --</option>
							      		<?php
											foreach($data_satuan_produksi as $row){
												//echo "<option value='".$row->id."'>".$row->value."</option>";
												echo "<option value='".$row->id_satuan_produksi."'>".$row->nama_satuan_produksi."</option>";
											}
										?>
                                </select>
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
			"aaSorting":[[3,"desc"]],
			"bDestroy":true,
			"bFilter":true,
			"bPaginate":true,
			"bInfo":true,
			"bProcessing": true,
			"bServerSide": true,
			"sAjaxSource": "<?php echo base_url();?>subsektor/listsubsektor",
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
						return '<span class="btn btn-mini btn-primary btnedit" id="'+obj.aData[3]+'">Edit</span>&nbsp;<span class="btn btn-mini btn-warning btndelete" id="'+obj.aData[3]+'">Delete</span>&nbsp;';
					}
				}
			]
		});
		
		$(".btnedit").live('click', function(){
			$("#divAlert").removeClass();
			$("#divAlert").html('');
			var id = $(this).attr('id');
			var url = "<?php echo base_url();?>subsektor/getDetail/"+id; // the script where you handle the form input.
			$.post(url, '', function(data){
				objResp = $.parseJSON(data);
				rowdata = objResp[0];
				if(rowdata){
					$("#id_subsektor").val(rowdata.IdMSubsektor);
					$("#subsektor").val(rowdata.NamaSubsektor);
					$("#satuan_produksi").val(rowdata.id_satuan_produksi);
					$("#type_perusahaan").val(rowdata.MTypePerusahaan_IdMTypePerusahaan);
					$("#cancelupdate").show();
					$("#addrow").html("Simpan Data");
				}else{
					$("#id_subsektor").val('');
				    $("#subsektor").val('');
					$("#satuan_produksi").val('');
				    $("#type_perusahaan").val('');
				    $("#cancelupdate").hide();
					$("#addrow").html("Tambah Data");
				}
			});
			return false;
		});
		
		$("#addrow").click(function(){
			if($("#subsektor").val() == ''){
				$("#divAlert").removeClass();
				$("#divAlert").addClass('alert alert-error');
				$("#divAlert").html("Subsektor harus diisi.");
				$("#subsektor").focus();
				return false;
			}
			if($("#type_perusahaan").val() == ''){
				$("#divAlert").removeClass();
				$("#divAlert").addClass('alert alert-error');
				$("#divAlert").html("Type Perusahaan harus dipilih.");
				$("#type_perusahaan").focus();
				return false;
			}
			var url = "<?php echo base_url();?>subsektor/save"; // the script where you handle the form input.
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
				$("#id_subsektor").val('');
				$("#subsektor").val('');
				$("#satuan_produksi").val('');
				$("#type_perusahaan").val('');
				$("#cancelupdate").hide();
				$("#addrow").html("Tambah Data");			
			});	
			return false;
		});
		
		$("#cancelupdate").click(function(){
			$("#id_subsektor").val('');
			$("#subsektor").val('');
			$("#satuan_produksi").val('');
			$("#type_perusahaan").val('');
			$("#cancelupdate").hide();
			$("#addrow").html("Tambah Data");
		});
		
		$(".btndelete").live('click', function(){
			$("#divAlert").removeClass();
			$("#divAlert").html('');
			id = $(this).attr('id');
			conf = confirm("Hapus data subsektor ini?");
			if(conf){
				var url = "<?php echo base_url();?>subsektor/hapus/"+id; // the script where you handle the form input.
				$.post(url, '', function(data){
				   oTable.fnDraw();
				   $("#id_subsektor").val('');
				   $("#subsektor").val('');
				   $("#satuan_produksi").val('');
				   $("#type_perusahaan").val('');
				   $("#cancelupdate").hide();
				   $("#addrow").html("Tambah Data");
				});	
				return false;
			}
		});

	});	
    </script>