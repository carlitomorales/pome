<?php include('header.php'); ?>
			<div>
				<ul class="breadcrumb">
					<li>
						<a href="<?php echo base_url();?>">Home</a> <span class="divider">/</span>
					</li>
					<li>
						<a href="#">Input Laporan</a></li>
				</ul>
			</div>
            
            <div class="row-fluid"><!--/span-->
            	<div class="box span12">
                	<div class="box-content">
                    	<div id="form-wizard-5" class="step">
                           <div class="step-title">
                             <i><?php $type=$this->session->userdata('type_perusahaan');
							 switch ($type){
								 case 1:
								 echo "6";
								 break;
								 case 2:
								 echo "6";
								 break;
								 } ?></i>
                             <h5>Kegiatan Efisiensi Energi</h5>
                             <span><?php $type=$this->session->userdata('type_perusahaan');
							 switch ($type){
								 case 1:
								 echo "6 dari 8";
								 break;
								 case 2:
								 echo "6 dari 8";
								 break;
								 } ?></span>
                           </div>
                        </div>
                    </div>
                </div>
            </div>
            
            
             <div class="row-fluid">
            	<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2>List Kegiatan Efisiensi Energi</h2>
						<div class="box-icon">
                        	Tahun <?php echo date("Y")-1;?>
						</div>
					</div>
					<div class="box-content">
                      <table class="table table-striped table-bordered bootstrap-datatable" id="datatable1">
                          <thead>
                              <tr>
								  <th rowspan="2" align="center">Peralatan</th>
                                  <th rowspan="2" align="center">Kegiatan</th>
                                  <th colspan="2" align="center">Target Penghematan Energi</th>
                                  <th colspan="2" align="center">Realisasi Penghematan yang Diperoleh</th>
                                  <th colspan="2" align="center">Target Emisi</th>
                                  <th colspan="2" align="center">Realisasi Emisi</th>
                                  <th rowspan="2" align="center">Keterangan</th>
                                  <th rowspan="2" align="center">Actions</th>
                              </tr>
                              <tr>
                                <th align="center">GJoule</th>
                                <th align="center">%</th>
                                <th align="center">GJoule</th>
                                <th align="center">%</th>
                                <th align="center">tCO<sub>2</sub></th>
                                <th align="center">%</th>
                                <th align="center">tCO<sub>2</sub></th>
                                <th align="center">%</th>
                            </tr>
                          </thead>  
                      </table> 
                    </div>
                 </div>
              </div>
            <div class="row-fluid">
            	<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2>Input Kegiatan Efisiensi Energi</h2>
						<div class="box-icon">
                        	Tahun <?php echo date("Y")-1;?>
						</div>
					</div>
					<div class="box-content">
                    	<div id="divAlert"></div>
                    	<form id="frmAdd" class="form-horizontal" action="" method="post">
							<div class="control-group">
                                <label class="control-label" for="id_peralatan">Peralatan Pengguna Energi</label>
                                <div class="controls">
                                      <select name="id_peralatan" id="id_peralatan">
                                          <option selected value="">-- Pilih --</option>
                                            <?php
                                                    foreach($data_peralatan as $row){
                                                        echo '<option value="'.$row->id_peralatan_pemanfaat_energi.'">'.$row->JenisPeralatan." ( ".$row->JenisEnergi." - ".$row->detail_jenis_energi." )"."</option>";		
                                                    }                                                    
                                                ?>
                                        </select>
										
										
                                 </div>
                             </div>
                            <div class="control-group">
							  <label class="control-label" for="kegiatan">Kegiatan</label>
							  <div class="controls">
                              	<select name="id_kegiatan" id="id_kegiatan">
                                          <option selected value="">-- Pilih --</option>
                                            <?php
                                                    foreach($data_kegiatan as $row){
                                                        echo '<option value="'.$row->id_kegiatan.'">'.$row->jenis_kegiatan."</option>";		
                                                    }                                                   
                                                ?>
                                        </select>
										
                                <input type="hidden" id="id_kegiatan_konservasi" name="id_kegiatan_konservasi" />
						      </div>
						    </div>
							 <div class="control-group"id='divketerangan' style="display:none">
							  <label class="control-label" for="detail_kegiatan">Detail Kegiatan</label>
							  <div class="controls">
								<input  id="detail_kegiatan" name="detail_kegiatan" />
							  </div>
						    </div>
                          <div class="control-group">
                            <label class="control-label" for="target_gjoule">Target Penghematan Energi</label>
                            <div class="controls">
                              <div class="input-append">
									<input id="target_gjoule" name="target_gjoule" class="input-small" type="text"><span class="add-on">GJoule</span>
							  </div>
                              <div class="input-append">
									<input id="target_persen" name="target_persen" class="input-small" type="text"><span class="add-on">%</span>
							  </div>
                              <p class="help-block">*) Dibandingkan dengan pemakaian energi pada system peralatan pemanfaat energi sebelumnya.</p>
                            </div>
                          </div>
                           <div class="control-group">
                            <label class="control-label" for="realisasi_gjoule">Realisasi Penghematan yang Diperoleh</label>
                            <div class="controls">
                              <div class="input-append">
									<input id="realisasi_gjoule" name="realisasi_gjoule" class="input-small" type="text"><span class="add-on">GJoule</span>
							  </div>
                              <div class="input-append">
									<input id="realisasi_persen" name="realisasi_persen" class="input-small" type="text"><span class="add-on">%</span>
							  </div>
                                    <p class="help-block">*) Dibandingkan dengan pemakaian energi pada system peralatan pemanfaat energi sebelumnya.</p>
                            </div>
                           </div>  
                           <div class="control-group">
                            <label class="control-label" for="target_emisi">Target Emisi</label>
                            <div class="controls">
                              <div class="input-append">
									<input id="target_emisi" name="target_emisi" class="input-small" type="text" readonly><span class="add-on">tCO<sub>2</sub></span>
							  </div>
                              <div class="input-append">
									<input  type="hidden" id="target_emisi_persen" name="target_emisi_persen" class="input-small" type="text">
							  </div>
                            </div>
                          </div>
                           <div class="control-group">
                            <label class="control-label" for="realisasi_emisi">Realisasi Emisi</label>
                            <div class="controls">
                              <div class="input-append">
									<input id="realisasi_emisi" name="realisasi_emisi" class="input-small" type="text" readonly><span class="add-on">tCO<sub>2</sub></span>
							  </div>
                              <div class="input-append">
									<input type="hidden"  id="realisasi_emisi_persen" name="realisasi_emisi_persen" class="input-small" type="text">
									<input type="hidden" class="input-small focused" id="faktor_emisi" name="faktor_emisi" type="text" >
									<input type="hidden" class="input-small focused" id="jenis_peralatan" name="jenis_peralatan" type="text" >
									<input type="hidden" class="input-small focused" id="jenis_energi" name="jenis_energi" type="text" >
									<input type="hidden" class="input-small focused" id="detail_jenis_energi" name="detail_jenis_energi" type="text" >
									<input type="hidden" class="input-small focused" id="konversi" name="konversi" type="text" >
									<input type="hidden" class="input-small focused" id="jenis_kegiatan" name="jenis_kegiatan" type="text" >
									
					
							  </div>
                            </div>
                           </div>  
                           <div class="control-group">
							  <label class="control-label" for="textarea2">Keterangan (Hambatan, dll)</label>
							  <div class="controls">
								<textarea class="autogrow" id="keterangan" name="keterangan" rows="3"></textarea>
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
                    	<span class="btn btn-primary" onClick="document.location='<?php echo base_url();?>peralatanpemanfaat'">Previous</span>
						<span class="btn btn-primary" onClick="document.location='<?php echo base_url();?>rencanakonservasi'" style="float:right">Next</span>
                    </div>
                </div>
             </div>
<?php include('footer.php'); ?>

	<script type="text/javascript">
	var oTable;
		
	$(document).ready(function(){
		
		oTable = $("#datatable1").dataTable({
			"aaSorting":[[0,"desc"]],
			"bDestroy":true,
			"bFilter":false,
			"bPaginate":false,
			"bInfo":false,
			"bProcessing": true,
			"bServerSide": true,
			"sAjaxSource": "<?php echo base_url();?>kegiatankonservasi/get_list",
			"sServerMethod" : "POST",
			"sDom": "<'row-fluid'<'span6'l><'span6'f>r>t<'row-fluid'<'span12'i><'span12 center'p>>",
			"sPaginationType": "bootstrap",
			"oLanguage": {
				"sLengthMenu": "_MENU_ records per page"
			},
			"aoColumnDefs":[
				{
					"aTargets":[11],
					"fnRender": function(obj){
						return '<nobr><span class="btn btn-mini btn-primary btnedit" id="'+obj.aData[17]+'">Edit</span>&nbsp;<span class="btn btn-mini btn-warning btndelete" id="'+obj.aData[17]+'">Delete</span>&nbsp;</nobr>';
					}
				},
				{
					"aTargets":[0],
					"fnRender": function(obj){
						return '<div align="right">'+obj.aData[14]+' </br> ('+obj.aData[11]+' - '+obj.aData[12]+')</div>';
					}
				},
				{
					"aTargets":[1],
					"fnRender": function(obj){
						return '<div align="right">'+obj.aData[15]+' - '+obj.aData[16]+' </div>';
					}
				},
				{
					"aTargets":[10],
					"fnRender": function(obj){
						return '<div align="right">'+obj.aData[10]+'</div>';
					}
				}					
			]
		});
		
		$(".btnedit").live('click', function(){
			var id = $(this).attr('id');
			var url = "<?php echo base_url();?>kegiatankonservasi/getDetail/"+id; // the script where you handle the form input.
			$.post(url, '', function(data){
				objResp = $.parseJSON(data);
				rowdata = objResp[0];
				if(rowdata){
					if(rowdata.jenis_kegiatan == 'Lain-Lain'){
						$("#divketerangan").show();
					}
					$("#id_kegiatan_konservasi").val(rowdata.id_kegiatan_konservasi);
					$("#id_peralatan").val(rowdata.id_peralatan_pemanfaat_energi);
					$("#kegiatan").val(rowdata.kegiatan);
					$("#id_kegiatan").val(rowdata.kegiatan);
					$("#jenis_kegiatan").val(rowdata.jenis_kegiatan);
					$("#detail_kegiatan").val(rowdata.detail_kegiatan); 
					$("#target_gjoule").val(rowdata.target_gjoule);
					$("#target_persen").val(rowdata.target_persen);
					$("#realisasi_gjoule").val(rowdata.realisasi_gjoule);
					$("#realisasi_persen").val(rowdata.realisasi_persen);
					$("#target_emisi").val(rowdata.target_emisi);
					$("#target_emisi_persen").val(rowdata.target_emisi_persen);
					$("#realisasi_emisi").val(rowdata.realisasi_emisi);
					$("#realisasi_emisi_persen").val(rowdata.realisasi_emisi_persen);
					$("#keterangan").val(rowdata.keterangan);
					$("#faktor_emisi").val(rowdata.faktor_emisi);
					$("#jenis_peralatan").val(rowdata.JenisPeralatan);
					$("#jenis_energi").val(rowdata.JenisEnergi);
					$("#detail_jenis_energi").val(rowdata.detail_jenis_energi);
					$("#konversi").val(rowdata.konversi);
					$("#cancelupdate").show();
					$("#addrow").html("Simpan Data");
				}else{
					$("#id_kegiatan_konservasi").val('');
					$("#id_peralatan").val('');
				    $("#kegiatan").val('');
					$("#id_kegiatan").val('');
					$("#jenis_kegiatan").val('');
					$("#detail_kegiatan").val('');				
				    $("#target_gjoule").val('');
				    $("#target_persen").val('');
				    $("#realisasi_gjoule").val('');
				    $("#realisasi_persen").val('');
					$("#target_emisi").val('');
					$("#target_emisi_persen").val('');
					$("#realisasi_emisi").val('');
					$("#realisasi_emisi_persen").val('');
				    $("#keterangan").val('');
					$("#faktor_emisi").val('');
					$("#jenis_peralatan").val('');
					$("#jenis_energi").val('');
					$("#detail_jenis_energi").val('');
					$("#konversi").val('');
					$("#cancelupdate").hide();
					$("#addrow").html("Tambah Data");
				}
				$("#divAlert").removeClass();
				$("#divAlert").html('');
			});
			return false;
		});
		
		$("#addrow").click(function(){
		
		
			if($("#faktor_emisi").val() == ''){
				$("#divAlert").removeClass();
				$("#divAlert").addClass('alert alert-error');
				$("#divAlert").html("faktor emisi tidak ditemukan, harap ulangi kembali.");
				$("#faktor_emisi").focus();
				return false;
			}
			if($("#jenis_peralatan").val() == ''){
				$("#divAlert").removeClass();
				$("#divAlert").addClass('alert alert-error');
				$("#divAlert").html("jenis peralatan tidak ditemukan, harap ulangi kembali.");
				$("#jenis_peralatan").focus();
				return false;
			}
			if($("#jenis_energi").val() == ''){
				$("#divAlert").removeClass();
				$("#divAlert").addClass('alert alert-error');
				$("#divAlert").html("jenis energi tidak ditemukan, harap ulangi kembali.");
				$("#jenis_energi").focus();
				return false;
			}
			if($("#detail_jenis_energi").val() == ''){
				$("#divAlert").removeClass();
				$("#divAlert").addClass('alert alert-error');
				$("#divAlert").html("detail jenis energi  tidak ditemukan, harap ulangi kembali.");
				$("#detail_jenis_energi").focus();
				return false;
			}
			if($("#konversi").val() == ''){
				$("#divAlert").removeClass();
				$("#divAlert").addClass('alert alert-error');
				$("#divAlert").html("konversi tidak ditemukan, harap ulangi kembali.");
				$("#konversi").focus();
				return false;
			}
			
			if($("#kegiatan").val() == ''){
				$("#divAlert").removeClass();
				$("#divAlert").addClass('alert alert-error');
				$("#divAlert").html("Kegiatan harus diisi.");
				$("#kegiatan").focus();
				return false;
			}
			if($("#target_gjoule").val() == ''){
				$("#divAlert").removeClass();
				$("#divAlert").addClass('alert alert-error');
				$("#divAlert").html("Target (GJoule) harus diisi.");
				$("#target_gjoule").focus();
				return false;
			}
			if($("#target_persen").val() == ''){
				$("#divAlert").removeClass();
				$("#divAlert").addClass('alert alert-error');
				$("#divAlert").html("Target (%) harus diisi.");
				$("#target_persen").focus();
				return false;
			}
			if($("#realisasi_gjoule").val() == ''){
				$("#divAlert").removeClass();
				$("#divAlert").addClass('alert alert-error');
				$("#divAlert").html("Realisasi (GJoule) harus diisi.");
				$("#realisasi_gjoule").focus();
				return false;
			}
			if($("#realisasi_persen").val() == ''){
				$("#divAlert").removeClass();
				$("#divAlert").addClass('alert alert-error');
				$("#divAlert").html("Realisasi (%) harus diisi.");
				$("#realisasi_persen").focus();
				return false;
			}
			if($("#target_emisi").val() == ''){
				$("#divAlert").removeClass();
				$("#divAlert").addClass('alert alert-error');
				$("#divAlert").html("Target emisi (tCO2) harus diisi.");
				$("#target_emisi").focus();
				return false;
			}
			if($("#target_emisi_persen").val() == ''){
				$("#divAlert").removeClass();
				$("#divAlert").addClass('alert alert-error');
				$("#divAlert").html("Target emisi (%) harus diisi.");
				$("#target_emisi_persen").focus();
				return false;
			}
			if($("#realisasi_emisi").val() == ''){
				$("#divAlert").removeClass();
				$("#divAlert").addClass('alert alert-error');
				$("#divAlert").html("Realisasi emisi (tCO2) harus diisi.");
				$("#realisasi_emisi").focus();
				return false;
			}
			if($("#realisasi_emisi_persen").val() == ''){
				$("#divAlert").removeClass();
				$("#divAlert").addClass('alert alert-error');
				$("#divAlert").html("Realisasi emisi (%) harus diisi.");
				$("#realisasi_emisi_persen").focus();
				return false;
			}
			if($("#keterangan").val() == ''){
				$("#divAlert").removeClass();
				$("#divAlert").addClass('alert alert-error');
				$("#divAlert").html("Keterangan harus diisi.");
				$("#keterangan").focus();
				return false;
			}
			var url = "<?php echo base_url();?>kegiatankonservasi/save"; // the script where you handle the form input.
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
			    $("#id_kegiatan_konservasi").val('');
				$("#id_peralatan").val('');
				$("#kegiatan").val('');
				$("#id_kegiatan").val('');				
				$("#jenis_kegiatan").val('');
				$("#detail_kegiatan").val('');	
				$("#target_gjoule").val('');
				$("#target_persen").val('');
				$("#realisasi_gjoule").val('');
				$("#realisasi_persen").val('');
				$("#target_emisi").val('');
				$("#target_emisi_persen").val('');
				$("#realisasi_emisi").val('');
				$("#realisasi_emisi_persen").val('');
				$("#keterangan").val('');
				$("#faktor_emisi").val('');
				$("#jenis_peralatan").val('');
				$("#jenis_energi").val('');
				$("#detail_jenis_energi").val('');
				$("#konversi").val('');
				$("#cancelupdate").hide();
				$("#addrow").html("Tambah Data");
			});	
			return false;
		});
		
		$("#cancelupdate").click(function(){
			$("#id_kegiatan_konservasi").val('');
			$("#id_peralatan").val('');
			$("#kegiatan").val('');
			$("#id_kegiatan").val('');			
			$("#jenis_kegiatan").val('');
			$("#detail_kegiatan").val('');	
			$("#target_gjoule").val('');
			$("#target_persen").val('');
			$("#realisasi_gjoule").val('');
			$("#realisasi_persen").val('');
			$("#target_emisi").val('');
			$("#target_emisi_persen").val('');
			$("#realisasi_emisi").val('');
			$("#realisasi_emisi_persen").val('');
			$("#keterangan").val('');
			$("#faktor_emisi").val('');
			$("#jenis_peralatan").val('');
			$("#jenis_energi").val('');
			$("#detail_jenis_energi").val('');
			$("#konversi").val('');
			$("#cancelupdate").hide();
			$("#addrow").html("Tambah Data");
			$("#divAlert").removeClass();
			$("#divAlert").html('');
		});
		$('#id_kegiatan').live('change',function(){
			if($("#id_kegiatan").find("option:selected").text() == 'Lain-Lain'){
				$("#divketerangan").show();		
				$("#jenis_kegiatan").val($("#id_kegiatan").find("option:selected").text());
								
			}else{
				$("#divketerangan").hide();								
				$("#jenis_kegiatan").val($("#id_kegiatan").find("option:selected").text());
				
			}
		});
		$('#id_peralatan').live('change', function(){
			$("#faktor_emisi").val('');
			var id = $("#id_peralatan").find("option:selected").val();
			var url = "<?php echo base_url();?>kegiatankonservasi/getFaktorEmisi/"+id;
			var faktor_emisi;
			var jenis_peralatan;
			var jenis_energi;
			var detail_jenis_energi;
			var konversi;
			
			$.post(url, '', function(data){
				objResp = $.parseJSON(data);
				rowdata = objResp[0];
				if(rowdata){				
					faktor_emisi = rowdata.faktor_emisi;				
					$("#faktor_emisi").val(rowdata.faktor_emisi);
					$("#jenis_peralatan").val(rowdata.JenisPeralatan);
					$("#jenis_energi").val(rowdata.JenisEnergi);
					$("#detail_jenis_energi").val(rowdata.detail_jenis_energi);
					$("#konversi").val(rowdata.konversi);
					
					var realisasi_gjoule = parseFloat($("#realisasi_gjoule").val());
					var target_gjoule = parseFloat($("#target_gjoule").val());
					var realisasi_emisi = realisasi_gjoule * faktor_emisi;
					var target_emisi = target_gjoule * faktor_emisi;
					$("#target_emisi").val(target_emisi);
					$("#realisasi_emisi").val(realisasi_emisi);
				}else{
					$("#faktor_emisi").val('');
				}
			}); 
		});
		$('#realisasi_gjoule').live('change', function(){
			faktor_emisi = parseFloat($("#faktor_emisi").val());
			realisasi_gjoule = parseFloat($("#realisasi_gjoule").val());
			realisasi_emisi = realisasi_gjoule * faktor_emisi;
			$("#realisasi_emisi").val(realisasi_emisi);
			
		});
		$('#target_gjoule').live('change', function(){
			faktor_emisi = parseFloat($("#faktor_emisi").val());
			target_gjoule = parseFloat($("#target_gjoule").val());
			target_emisi = target_gjoule * faktor_emisi;
			$("#target_emisi").val(target_emisi);
			
		});
		$('#realisasi_persen').live('change', function(){			
			$("#realisasi_emisi_persen").val($("#realisasi_persen").val());
		});
		$('#target_persen').live('change', function(){			
			$("#target_emisi_persen").val($("#target_persen").val());
		});
		
		$(".btndelete").live('click', function(){
			id = $(this).attr('id');
			conf = confirm("Hapus data kegiatan efesiensi energi ini?");
			if(conf){
				var url = "<?php echo base_url();?>kegiatankonservasi/hapus/"+id; // the script where you handle the form input.
				$.post(url, '', function(data){
				   oTable.fnDraw();
				    $("#id_kegiatan_konservasi").val('');
				    $("#kegiatan").val('');
				    $("#target_gjoule").val('');
				    $("#target_persen").val('');
				    $("#realisasi_gjoule").val('');
				    $("#realisasi_persen").val('');
					$("#target_emisi").val('');
					$("#target_emisi_persen").val('');
					$("#realisasi_emisi").val('');
					$("#realisasi_emisi_persen").val('');
				    $("#keterangan").val('');
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