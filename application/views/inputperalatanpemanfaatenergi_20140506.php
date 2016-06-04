<?php include('header.php'); ?>
			<div>
				<ul class="breadcrumb">
					<li>
						<a href="<?php echo base_url();?>">Home</a> <span class="divider">/</span>
					</li>
					<li>
						<a href="#">Input Laporan</a>
                    </li>
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
								 echo "5";
								 break;
								 case 2:
								 echo "5";
								 break;
								 } ?></i>
                             <h5>Peralatan Pemanfaat Energi Utama</h5>
                             <span><?php $type=$this->session->userdata('type_perusahaan');
							 switch ($type){
								 case 1:
								 echo "5 dari 8";
								 break;
								 case 2:
								 echo "5 dari 8";
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
						<h2>List Peralatan Pemanfaat Energi Utama</h2>
						<div class="box-icon">
                        	<h2>Tahun <?php echo date("Y")-1;?></h2>
						</div>
					</div>
					<div class="box-content">
                    	<table class="table table-striped table-bordered bootstrap-datatable" id="datatable1">
                              <thead>
                                  <tr>
                                      <th>Jenis Peralatan</th>
                                      <th>Jenis Energi</th>
                                      <th>Original Unit</th>
                                      <th>GJoule</th>
                                      <th>Persentase Pemakaian Energi</th>
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
						<h2>Input Peralatan Pemanfaat Energi Utama</h2>
						<div class="box-icon">
                        	<h2>Tahun <?php echo date("Y")-1;?></h2>
						</div>
					</div>
					<div class="box-content">
                    	<div id="divAlert"></div>
                    	<form id="frmAdd" class="form-horizontal" action="" method="post">                        	
                            <div class="control-group">
							  <label class="control-label" for="id_jenis_peralatan">Jenis Peralatan Pemanfaat Energi Utama</label>
							  <div class="controls">
							    <select name="id_jenis_peralatan" id="id_jenis_peralatan">
                                	<option value="">-- Pilih --</option>
                                    <?php
									foreach($jenisperalatan as $row){
										echo '<option value="'.$row->IdJenisPeralatan.'">'.$row->JenisPeralatan.'</option>';
									}
									?>
                                </select>
                                <input type="hidden" id="id_peralatan_pemanfaat_energi" name="id_peralatan_pemanfaat_energi" />
						      </div>
						    </div>
                            <div class="control-group" id="jenisperalatanlain" style="display:none">
							  <label class="control-label" for="jenis_peralatan_lain">Jenis Peralatan Lain</label>
							  <div class="controls">
							    <input id="jenis_peralatan_lain" name="jenis_peralatan_lain"  type="text" class="typeahead" data-provide="typeahead" data-items="4" data-source='[<?php  
									$list = '';
									foreach($jenisperalatanlain as $peralatanlain)
									{
										$list .= '"'.$peralatanlain->jenis_peralatan_lain.'",';
									}
									$list = substr($list,0,strlen($list)-1);
									echo $list;
								?>]'>
						      </div>
						    </div>
                            <div class="control-group">
                                <label class="control-label" for="id_jenis_energi">Jenis Energi</label>
                                <div class="controls">
                                      <select name="id_jenis_energi" id="id_jenis_energi">
                                          <option selected value="">-- Pilih --</option>
                                            <?php
                                                    foreach($data_jenisenergi as $row){
                                                        echo '<option value="'.$row->IdJenisEnergi.'">'.$row->JenisEnergi."</option>";		
                                                    }
                                                    
                                                ?>
                                        </select>
                                 </div>
                             </div>
                             <div class="control-group" id="divJenisEnergiLain1" style="display:none">
                              <label class="control-label" for="jenis_energi_lain">Jenis Energi Lain</label>
							  <div class="controls">
							    <input id="jenis_energi_lain" name="jenis_energi_lain"  type="text" class="typeahead" data-provide="typeahead" data-items="4" data-source='[<?php  
									$list = '';
									foreach($data_jenisenergi1 as $energilain)
									{
										$list .= '"'.$energilain->jenis_energi_lain.'",';
									}
									$list = substr($list,0,strlen($list)-1);
									echo $list;
								?>]'>
                              </div>
						     </div>
                             <div class="control-group">
                                	<label class="control-label" for="original_unit">Jumlah Pemakaian Energi (Original Unit)</label>
                                    <div class="controls">
                                      <div class="input-append">
                                      	<input class="input-small focused" id="original_unit" name="original_unit" type="text"><span class="add-on" id="spanSatuan"> </span>
                                      </div>
                                    </div>
                              </div>
                             <div class="control-group">
                                	<label class="control-label" for="konversi">Konversi</label>
                                    <div class="controls">
                                      <input class="input-small focused" id="konversi" name="konversi" type="text">
                                    </div>
                              </div>
                              <div class="control-group">
                                    <label class="control-label" for="gjoule">GJoule</label>
                                    <div class="controls">
                                      <input class="input-small focused" id="gjoule" name="gjoule" type="text" readonly>
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
                    	<span class="btn btn-primary" onClick="document.location='<?php echo base_url();?>konsumsienergispesifik'">Previous</span>
						<span class="btn btn-primary" onClick="document.location='<?php echo base_url();?>kegiatankonservasi'" style="float:right">Next</span>
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
			"sAjaxSource": "<?php echo base_url();?>peralatanpemanfaat/listperalatanpemanfaatenergi",
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
						return obj.aData[2];
					}
				},
				{
					"aTargets":[2],
					"fnRender": function(obj){
						var satuan='';
						if(obj.aData[7] == null){satuan;}else{satuan=obj.aData[7];}
						return '<div align="right">'+formatCurrency(obj.aData[4],2)+'&nbsp;'+satuan+'</div>';
					}
				},
				{
					"aTargets":[3],
					"fnRender": function(obj){
						return '<div align="right">'+formatCurrency(obj.aData[5],2)+'</div>';
					}
				},
				{
					"aTargets":[4],
					"fnRender": function(obj){
						return '<div align="right">'+formatCurrency(obj.aData[8],2)+'%</div>';
					}
				},
				{
					"aTargets":[5],
					"fnRender": function(obj){
						return '<span class="btn btn-mini btn-primary btnedit" id="'+obj.aData[6]+'">Edit</span>&nbsp;<span class="btn btn-mini btn-warning btndelete" id="'+obj.aData[6]+'">Delete</span>&nbsp;';
					}
				}
			]
		});
		
		$('#id_jenis_peralatan').live('change', function(){
			if($("#id_jenis_peralatan").find("option:selected").text() == 'Lain-Lain'){
				$("#jenisperalatanlain").show();
			}else{
				$("#jenisperalatanlain").hide();
			}
		});
		
		$('#id_jenis_energi').live('change', function(){
			if($("#id_jenis_energi").find("option:selected").text() == 'Lain-Lain'){
				$("#divJenisEnergiLain1").show();
			}else{
				$("#divJenisEnergiLain1").hide();
			}
			var id = $("#id_jenis_energi").find("option:selected").val();
			var url = "<?php echo base_url();?>peralatanpemanfaat/getSatuanJenisEnergi/"+id;
			$.post(url, '', function(data){
				objResp = $.parseJSON(data);
				rowdata = objResp[0];
				if(rowdata){
					$("#spanSatuan").html(' '+rowdata.Satuan);
				}else{
					$("#spanSatuan").html(' ');
				}
			});
		});
		
		$("#konversi").live('change', function(){
			orgunit = parseFloat($("#original_unit").val());
			konversi = parseFloat($(this).val());
			gjoule = orgunit * konversi;
			$("#gjoule").val(gjoule);
		});
		
		$("#original_unit").live('change', function(){
			orgunit = parseFloat($(this).val());
			konversi = parseFloat($("#konversi").val());
			gjoule = orgunit * konversi;
			$("#gjoule").val(gjoule);
		});
		
		$(".btnedit").live('click', function(){
			var id = $(this).attr('id');
			var url = "<?php echo base_url();?>peralatanpemanfaat/getDetail/"+id; // the script where you handle the form input.
			$.post(url, '', function(data){
				objResp = $.parseJSON(data);
				rowdata = objResp[0];
				if(rowdata){
					$("#id_peralatan_pemanfaat_energi").val(rowdata.id_peralatan_pemanfaat_energi);
					$("#id_jenis_peralatan").val(rowdata.id_jenis_peralatan);
					$("#jenis_peralatan_lain").val(rowdata.jenis_peralatan_lain);
					$("#id_jenis_energi").val(rowdata.id_jenis_energi);
					$("#jenis_energi_lain").val(rowdata.jenis_energi_lain);
					$("#original_unit").val(rowdata.original_unit);
					$("#konversi").val(rowdata.konversi);
					$("#gjoule").val(rowdata.gjoule);
					$("#spanSatuan").html(' '+rowdata.Satuan);
					$("#cancelupdate").show();
					$("#addrow").html("Simpan Data");
					if(rowdata.jenis_peralatan_lain != ''){
						$("#jenisperalatanlain").show();
					}else{
						$("#jenisperalatanlain").hide();
					}
					if(rowdata.jenis_energi_lain != ''){
						$("#divJenisEnergiLain1").show();
					}else{
						$("#divJenisEnergiLain1").hide();
					}
				}else{
					$("#id_peralatan_pemanfaat_energi").val('');
				    $("#id_jenis_peralatan").val('');
				    $("#jenis_peralatan_lain").val('');
				    $("#id_jenis_energi").val('');
				    $("#jenis_energi_lain").val('');
				    $("#original_unit").val('');
					$("#konversi").val('');
				    $("#gjoule").val('');
					$("#spanSatuan").html(' ');
					$("#cancelupdate").hide();
					$("#addrow").html("Tambah Data");
					$("#jenisperalatanlain").hide();
					$("#divJenisEnergiLain1").hide();
				}
			});
			return false;
		});
		
		$("#addrow").click(function(){
			var url = "<?php echo base_url();?>peralatanpemanfaat/saveperalatanpemanfaatenergi"; // the script where you handle the form input.
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
			   $("#id_peralatan_pemanfaat_energi").val('');
			   $("#id_jenis_peralatan").val('');
			   $("#jenis_peralatan_lain").val('');
			   $("#id_jenis_energi").val('');
			   $("#jenis_energi_lain").val('');
			   $("#original_unit").val('');
			   $("#konversi").val('');
			   $("#gjoule").val('');
			   $("#spanSatuan").html(' ');
				$("#cancelupdate").hide();
				$("#addrow").html("Tambah Data");
				$("#jenisperalatanlain").hide();
				$("#divJenisEnergiLain1").hide();
			});	
			return false;
		});
		
		$("#cancelupdate").click(function(){
			$("#id_peralatan_pemanfaat_energi").val('');
		    $("#id_jenis_peralatan").val('');
		    $("#jenis_peralatan_lain").val('');
		    $("#id_jenis_energi").val('');
		    $("#jenis_energi_lain").val('');
		    $("#original_unit").val('');
			$("#konversi").val('');
		    $("#gjoule").val('');
			$("#spanSatuan").html(' ');
			$("#cancelupdate").hide();
			$("#addrow").html("Tambah Data");
			$("#jenisperalatanlain").hide();
			$("#divJenisEnergiLain1").hide();
		});
		
		$(".btndelete").live('click', function(){
			id = $(this).attr('id');
			conf = confirm("Hapus data peralatan pemanfaat energi ini?");
			if(conf){
				var url = "<?php echo base_url();?>peralatanpemanfaat/hapus/"+id; // the script where you handle the form input.
				$.post(url, '', function(data){
				   oTable.fnDraw();
				   $("#id_peralatan_pemanfaat_energi").val('');
				   $("#id_jenis_peralatan").val('');
				   $("#jenis_peralatan_lain").val('');
				   $("#id_jenis_energi").val('');
				   $("#jenis_energi_lain").val('');
				   $("#original_unit").val('');
				   $("#konversi").val('');
				   $("#gjoule").val('');
				   $("#spanSatuan").html(' ');
				   $("#cancelupdate").hide();
				   $("#addrow").html("Tambah Data");
					$("#jenisperalatanlain").hide();
					$("#divJenisEnergiLain1").hide();
				});	
				return false;
			}
		});
	});	
    </script>