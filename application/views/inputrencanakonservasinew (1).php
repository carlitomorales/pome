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
								 echo "7";
								 break;
								 case 2:
								 echo "7";
								 break;
								 } ?></i>
                             <h5>Rencana Kegiatan Efisiensi Energi</h5>
                             <span><?php $type=$this->session->userdata('type_perusahaan');
							 switch ($type){
								 case 1:
								 echo "7 dari 8";
								 break;
								 case 2:
								 echo "7 dari 8";
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
						<h2>List Rencana Kegiatan Efisiensi Energi Pada Peralatan Pengguna Energi Utama</h2>
						<div class="box-icon">
                        	Tahun <?php echo date("Y");?>
						</div>
					</div>
					<div class="box-content">
                      <table class="table table-striped table-bordered bootstrap-datatable" id="datatable1">
                          <thead>
                              <tr>
								  <th rowspan="2" style="text-align:center">Peralatan</th>
                                  <th rowspan="2" style="text-align:center">Kegiatan</th>
								  <th rowspan="2" style="text-align:center">Detail Kegiatan</th>
                                  <th colspan="2" style="text-align:center">Target Penurunan yang Diperoleh</th>   
                                  <th rowspan="2" style="text-align:center">Emisi (tCO<sub>2</sub>)</th>                               
                                  <th rowspan="2" style="text-align:center">Keterangan</th>
                                  <th rowspan="2" style="text-align:center">Actions</th>
                              </tr>
                              <tr>
                                <th style="text-align:center">GJoule</th>
                                <th style="text-align:center">%</th>
                                
                              </tr>
                          </thead>  
                      </table> 
                    </div>
                 </div>
              </div>
            <div class="row-fluid">
            	<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2>Input Rencana Kegiatan Efisiensi Energi Pada Peralatan Pengguna Energi Utama</h2>
						<div class="box-icon">
                        	Tahun <?php echo date("Y");?>
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
							 <div class="control-group">
							  <label class="control-label" for="detail_kegiatan">Detail Kegiatan</label>
							  <div class="controls">
		                           <textarea id="detail_kegiatan" name="detail_kegiatan" class="autogrow"></textarea>
							  </div>
						    </div>

                           <div class="control-group">
                            <label class="control-label" for="realisasi_gjoule">Target Penurunan yang Diperoleh *)</label>
                            <div class="controls">
                              <div class="input-append">
									<input id="realisasi_gjoule" name="realisasi_gjoule" class="input-small" type="text"><span class="add-on">GJoule</span>
							  </div>
                              <div class="input-append">
									<input id="realisasi_persen" name="realisasi_persen" class="input-small" type="text" readonly><span class="add-on">%</span>   *) Dibandingkan dengan pemakaian energi pada system peralatan pemanfaat energi sebelumnya.
							  </div>
                                  
                            </div>
                           </div>  
                           
                           <div class="control-group">
                            <label class="control-label" for="realisasi_emisi">Target Penurunan Emisi</label>
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
                                    <input type="hidden" class="input-small focused" id="gjoule_peralatan" name="gjoule_peralatan" type="text" >
									
					
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
					<div class="box-header well" data-original-title>
						<h2>List Rencana Kegiatan Efisiensi Lain</h2>
						<div class="box-icon">
                        	<h2>Tahun <?php echo date("Y");?></h2>
						</div>
					</div>
					<div class="box-content">
					        <table class="table table-striped table-bordered bootstrap-datatable" id="datatable2">
                                  <thead>
                                      <tr>
                                      	  <th style="text-align:center">Kegiatan</th>
                                          <th style="text-align:center">Detail Kegiatan</th>
                                          <th style="text-align:center">Actions</th>
                                      </tr>
                                  </thead>
                              </table>
                          
                    </div>
                </div>
             </div>
            <div class="row-fluid">
            	<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2>Input Rencana Kegiatan Efisiensi Lain</h2>
						<div class="box-icon">
                        	<h2>Tahun <?php echo date("Y");?></h2>
						</div>
					</div>
					<div class="box-content">
                    	<div id="divAlert1"></div>
                    	<form id="frmAdd1" class="form-horizontal" method="post">
                         <div class="control-group">
							  <label class="control-label" for="kegiatan">Kegiatan Lain</label>
							  <div class="controls">
                              	<select name="id_kegiatan_lain" id="id_kegiatan_lain">
                                          <option selected value="">-- Pilih --</option>
                                            <?php
                                                    foreach($data_kegiatan_lain as $row){
                                                        echo '<option value="'.$row->id_kegiatan.'">'.$row->jenis_kegiatan."</option>";		
                                                    }                                                   
                                                ?>
                                        </select>
										
                                <input type="hidden" id="id_kegiatan_konservasi_lain" name="id_kegiatan_konservasi_lain" />
						      </div>
						    </div>
							 <div class="control-group">
							  <label class="control-label" for="detail_kegiatan_lain">Detail Kegiatan</label>
							  <div class="controls">
		                           <textarea id="detail_kegiatan_lain" name="detail_kegiatan_lain" class="autogrow"></textarea>
							  </div>
						    </div>
                            <div class="input-append">
									<input type="hidden" class="input-small focused" id="jenis_kegiatan_lain" name="jenis_kegiatan_lain" type="text" >
							  </div>
                                  
                              <div class="form-actions">
                                 	<span class="btn btn-primary" id="addrow1">Tambah Data</span>
                                 	<span class="btn btn-primary" id="cancelupdate1" style="display:none">Batalkan</span>
                              </div>
                        </form>
                    </div>
                </div>
            </div>  
             <div class="row-fluid">
                <div class="box span12">
                	<div class="box-content">
                    	<span class="btn btn-primary" onClick="document.location='<?php echo base_url();?>kegiatankonservasinew'">Previous</span>
						<span class="btn btn-primary" onClick="document.location='<?php echo base_url();?>auditenergi'" style="float:right">Next</span>
                    </div>
                </div>
             </div>
<?php include('footer.php'); ?>

	<script type="text/javascript">
	var oTable;
	var oTable1;
		
	$(document).ready(function(){
		
		oTable = $("#datatable1").dataTable({
			"aaSorting":[[0,"desc"]],
			"bDestroy":true,
			"bFilter":false,
			"bPaginate":false,
			"bInfo":false,
			"bProcessing": true,
			"bServerSide": true,
			"sAjaxSource": "<?php echo base_url();?>rencanakonservasinew/get_list",
			"sServerMethod" : "POST",
			"sDom": "<'row-fluid'<'span6'l><'span6'f>r>t<'row-fluid'<'span12'i><'span12 center'p>>",
			"sPaginationType": "bootstrap",
			"oLanguage": {
				"sLengthMenu": "_MENU_ records per page"
			},
			"aoColumnDefs":[
				{
					"aTargets":[7],
					"fnRender": function(obj){
						return '<nobr><span class="btn btn-mini btn-primary btnedit" id="'+obj.aData[13]+'">Edit</span>&nbsp;<span class="btn btn-mini btn-warning btndelete" id="'+obj.aData[13]+'">Delete</span>&nbsp;</nobr>';
					}
				},
				{
					"aTargets":[0],
					"fnRender": function(obj){
						return '<div align="left">'+obj.aData[8]+' </br> ('+obj.aData[9]+' - '+obj.aData[10]+')</div>';
					}
				}					
			]
		});
		
		$(".btnedit").live('click', function(){
			var id = $(this).attr('id');
			var url = "<?php echo base_url();?>rencanakonservasinew/getDetail/"+id; // the script where you handle the form input.
			var id_peralatan ;
			$.post(url, '', function(data){
				objResp = $.parseJSON(data);
				rowdata = objResp[0];
				if(rowdata){
					//if(rowdata.jenis_kegiatan == 'Lain-Lain'){
						//$("#divketerangan").show();
					//}
					
					$("#id_kegiatan_konservasi").val(rowdata.id_rencana_konservasi);			
					$("#id_peralatan").val(rowdata.id_peralatan_pemanfaat_energi);
					$("#kegiatan").val(rowdata.kegiatan);
					$("#id_kegiatan").val(rowdata.kegiatan);
					$("#jenis_kegiatan").val(rowdata.jenis_kegiatan);
					$("#detail_kegiatan").val(rowdata.detail_kegiatan); 
					$("#realisasi_gjoule").val(rowdata.target_gjoule);
					$("#realisasi_persen").val(rowdata.target_persen);
					$("#realisasi_emisi").val(rowdata.target_emisi);
					$("#realisasi_emisi_persen").val(rowdata.target_emisi_persen);
					$("#keterangan").val(rowdata.keterangan);
					$("#faktor_emisi").val(rowdata.faktor_emisi);
					$("#jenis_peralatan").val(rowdata.JenisPeralatan);
					$("#jenis_energi").val(rowdata.JenisEnergi);
					$("#detail_jenis_energi").val(rowdata.detail_jenis_energi);
					$("#konversi").val(rowdata.konversi);
					
					var urlFE = "<?php echo base_url();?>rencanakonservasinew/getFaktorEmisi/"+rowdata.id_peralatan_pemanfaat_energi;
					$.post(urlFE, '', function(dataFE){
						objRespFE = $.parseJSON(dataFE);
						rowdataFE = objRespFE[0];
						if(rowdataFE){									
							$("#gjoule_peralatan").val(rowdataFE.gjoule);
							}else{$("#gjoule_peralatan").val('');}
							});
					
					$("#cancelupdate").show();
					$("#addrow").html("Simpan Data");
				}else{
					$("#id_kegiatan_konservasi").val('');
					$("#id_peralatan").val('');
				    $("#kegiatan").val('');
					$("#id_kegiatan").val('');
					$("#jenis_kegiatan").val('');
					$("#detail_kegiatan").val('');				
				    $("#realisasi_gjoule").val('');
				    $("#realisasi_persen").val('');
					$("#realisasi_emisi").val('');
					$("#realisasi_emisi_persen").val('');
				    $("#keterangan").val('');
					$("#faktor_emisi").val('');
					$("#gjoule_peralatan").val('');
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
			if($("#detail_kegiatan").val() == ''){
				$("#divAlert").removeClass();
				$("#divAlert").addClass('alert alert-error');
				$("#divAlert").html("Detail Kegiatan harus diisi.");
				$("#detail_kegiatan").focus();
				return false;
			}
			if($("#realisasi_gjoule").val() == ''){
				$("#divAlert").removeClass();
				$("#divAlert").addClass('alert alert-error');
				$("#divAlert").html("Target (GJoule) harus diisi.");
				$("#realisasi_gjoule").focus();
				return false;
			}
			if(!$.isNumeric($("#realisasi_gjoule").val()))
			{
				$("#divAlert").removeClass();
				$("#divAlert").addClass('alert alert-error');
				$("#divAlert").html("Target (Gjoule) harus numerik.");
				$("#realisasi_gjoule").focus();
				return false;					
			}
			if($("#realisasi_persen").val() == ''){
				$("#divAlert").removeClass();
				$("#divAlert").addClass('alert alert-error');
				$("#divAlert").html("Target (%) harus diisi.");
				$("#realisasi_persen").focus();
				return false;
			}
			if($("#realisasi_emisi").val() == ''){
				$("#divAlert").removeClass();
				$("#divAlert").addClass('alert alert-error');
				$("#divAlert").html("Target emisi (tCO2) harus diisi.");
				$("#realisasi_emisi").focus();
				return false;
			}
			if($("#realisasi_emisi_persen").val() == ''){
				$("#divAlert").removeClass();
				$("#divAlert").addClass('alert alert-error');
				$("#divAlert").html("Target emisi (%) harus diisi.");
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
			var url = "<?php echo base_url();?>rencanakonservasinew/save"; // the script where you handle the form input.
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
				$("#realisasi_gjoule").val('');
				$("#realisasi_persen").val('');
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
			$("#realisasi_gjoule").val('');
			$("#realisasi_persen").val('');
			$("#realisasi_emisi").val('');
			$("#realisasi_emisi_persen").val('');
			$("#keterangan").val('');
			$("#faktor_emisi").val('');
			$("#gjoule_peralatan").val('');
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
			$("#jenis_kegiatan").val($("#id_kegiatan").find("option:selected").text());
			//if($("#id_kegiatan").find("option:selected").text() == 'Lain-Lain'){
				//$("#divketerangan").show();		
				//$("#jenis_kegiatan").val($("#id_kegiatan").find("option:selected").text());
								
			//}else{
				//$("#divketerangan").hide();								
				//$("#jenis_kegiatan").val($("#id_kegiatan").find("option:selected").text());
				
			//}
		});
		$('#id_peralatan').live('change', function(){
			$("#faktor_emisi").val('');
			var id = $("#id_peralatan").find("option:selected").val();
			var url = "<?php echo base_url();?>rencanakonservasinew/getFaktorEmisi/"+id;
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
					var realisasi_emisi = realisasi_gjoule * faktor_emisi;
					if (!isNaN(realisasi_emisi))
					{ $("#realisasi_emisi").val(realisasi_emisi); }
					$("#gjoule_peralatan").val(rowdata.gjoule);
					
					
				}else{
					$("#faktor_emisi").val('');
					$("#gjoule_peralatan").val('');
				}
			}); 
		});
		$('#realisasi_gjoule').live('change', function(){
			faktor_emisi = parseFloat($("#faktor_emisi").val());
			realisasi_gjoule = parseFloat($("#realisasi_gjoule").val());
			realisasi_emisi = realisasi_gjoule * faktor_emisi;
			if (!isNaN(realisasi_emisi))
			{ $("#realisasi_emisi").val(realisasi_emisi); }
			var gjouleperalatan = parseFloat($("#gjoule_peralatan").val());
			var realisasi_persen = (realisasi_gjoule/gjouleperalatan) * 100;
			if (!isNaN(realisasi_persen))
			{ $("#realisasi_persen").val(realisasi_persen); }
			$("#realisasi_emisi_persen").val($("#realisasi_persen").val());
			
		});
		
		//$('#realisasi_persen').live('change', function(){			
			//$("#realisasi_emisi_persen").val($("#realisasi_persen").val());
		//});
		
		
		$(".btndelete").live('click', function(){
			id = $(this).attr('id');
			conf = confirm("Hapus data rencana efesiensi energi ini?");
			if(conf){
				var url = "<?php echo base_url();?>rencanakonservasinew/hapus/"+id; // the script where you handle the form input.
				$.post(url, '', function(data){
				   oTable.fnDraw();
				    $("#id_kegiatan_konservasi").val('');
				    $("#kegiatan").val('');
				    $("#realisasi_gjoule").val('');
				    $("#realisasi_persen").val('');
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
		//kegiatan_lain
		oTable1 = $("#datatable2").dataTable({
			
			"aaSorting":[[3,"desc"]],
			"bDestroy":true,
			"bFilter":false,
			"bPaginate":false,
			"bInfo":false,
			"bProcessing": true,
			"bServerSide": true,
			"sAjaxSource": "<?php echo base_url();?>rencanakonservasinew/get_list_lain",
			"sServerMethod" : "POST",
			"sDom": "<'row-fluid'<'span6'l><'span6'f>r>t<'row-fluid'<'span12'i><'span12 center'p>>",
			"sPaginationType": "bootstrap",
			"oLanguage": {
				"sLengthMenu": "_MENU_ records per page"
			},
			"aoColumnDefs":[
				{
					"aTargets":[0],
					"fnRender": function(obj){
						return obj.aData[1];
					}
				},
				{
					"aTargets":[1],
					"fnRender": function(obj){
						return obj.aData[2];
					}
				},
				{
					"aTargets":[2],
					"fnRender": function(obj){
						return '<span class="btn btn-mini btn-primary btneditLain" id="'+obj.aData[3]+'">Edit</span>&nbsp;<span class="btn btn-mini btn-warning btndeleteLain" id="'+obj.aData[3]+'">Delete</span>&nbsp;';
					}
				}
			]
		});

		
		$(".btneditLain").live('click', function(){
			$("#divAlert1").removeClass();
			$("#divAlert1").html('');
			var id = $(this).attr('id');
			var url = "<?php echo base_url();?>rencanakonservasinew/getDetailLain/"+id; // the script where you handle the form input.
			$.post(url, '', function(data){
				objResp = $.parseJSON(data);
				rowdata = objResp[0];
				if(rowdata){
					$("#id_kegiatan_konservasi_lain").val(rowdata.id_rencana_konservasi_lain);
					$("#id_kegiatan_lain").val(rowdata.kegiatan);
					$("#jenis_kegiatan_lain").val(rowdata.jenis_kegiatan);
					$("#detail_kegiatan_lain").val(rowdata.detail_kegiatan);
					$("#cancelupdate1").show();
					$("#addrow1").html("Simpan Data");
				}else{
					$("#id_kegiatan_konservasi_lain").val('');
				    $("#id_kegiatan_lain").val('');
					$("#jenis_kegiatan_lain").val('');
				    $("#detail_kegiatan_lain").val('');
				    $("#cancelupdate1").hide();
					$("#addrow1").html("Tambah Data");
				}
			});
			return false;
		});
		
		$("#addrow1").click(function(){
			if($("#id_kegiatan_lain").val() == ''){
				$("#divAlert1").removeClass();
				$("#divAlert1").addClass('alert alert-error');
				$("#divAlert1").html("Kegiatan lain harus diisi.");
				$("#id_kegiatan_lain").focus();
				return false;
			}
			if($("#detail_kegiatan_lain").val() == ''){
				$("#divAlert1").removeClass();
				$("#divAlert1").addClass('alert alert-error');
				$("#divAlert1").html("Detail kegiatan lain harus diisi.");
				$("#detail_kegiatan_lain").focus();
				return false;
			}
			var url = "<?php echo base_url();?>rencanakonservasinew/saveLain"; // the script where you handle the form input.
			$.post(url, $("#frmAdd1").serialize(), function(data){
			   resp = $.parseJSON(data);
				if(resp.status == "success"){
					$("#divAlert1").removeClass();
					$("#divAlert1").addClass('alert alert-success');
					$("#divAlert1").html(resp.msg);
				}else{
					$("#divAlert1").removeClass();
					$("#divAlert1").addClass('alert alert-error');
					$("#divAlert1").html(resp.msg);
				}
			   oTable1.fnDraw();
				$("#id_kegiatan_konservasi_lain").val('');
				$("#id_kegiatan_lain").val('');
				$("#jenis_kegiatan_lain").val('');
				$("#detail_kegiatan_lain").val('');
				$("#cancelupdate1").hide();
				$("#addrow1").html("Tambah Data");			
			});	
			return false;
		});
		
		$("#cancelupdate1").click(function(){
			$("#id_kegiatan_konservasi_lain").val('');
			$("#id_kegiatan_lain").val('');
			$("#jenis_kegiatan_lain").val('');
			$("#detail_kegiatan_lain").val('');
			$("#cancelupdate1").hide();
			$("#addrow1").html("Tambah Data");
		});
		$('#id_kegiatan_lain').live('change',function(){
			$("#jenis_kegiatan_lain").val($("#id_kegiatan_lain").find("option:selected").text());
		});
		
		
		$(".btndeleteLain").live('click', function(){
			$("#divAlert1").removeClass();
			$("#divAlert1").html('');
			id = $(this).attr('id');
			conf1 = confirm("Hapus data rencana efisiensi lain ini?");
			if(conf1){
				var url = "<?php echo base_url();?>rencanakonservasinew/hapusLain/"+id; // the script where you handle the form input.
				$.post(url, '', function(data){
				   oTable1.fnDraw();
				   $("#id_kegiatan_konservasi_lain").val('');
				   $("#id_kegiatan_lain").val('');
				   $("#jenis_kegiatan_lain").val('');
				   $("#detail_kegiatan_lain").val('');
				   $("#cancelupdate1").hide();
				   $("#addrow1").html("Tambah Data");
				});	
				return false;
			}
		});
	});	
    </script>