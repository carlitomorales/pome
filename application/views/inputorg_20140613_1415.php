<?php include('header.php'); ?>
			<div>
				<ul class="breadcrumb">
					<li>
						<a href="#">Home</a> <span class="divider">/</span>
					</li>
					<li>
						<a href="#">Input Laporan</a>
                    </li>
				</ul>
			</div>
			
			<div class="row-fluid sortable"><!--/span-->
            	<div class="box span12">
                	<div class="box-content">
                    	<div id="form-wizard-1" class="step">
                           <div class="step-title">
                             <i>1</i>
                             <h5>Organisasi Manajemen Energi</h5>
                             <span><?php $type=$this->session->userdata('type_perusahaan');
							 switch ($type){
								 case 1:
								 echo "1 dari 8";
								 break;
								 case 2:
								 echo "1 dari 8";
								 break;
								 } ?></span>
                           </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row-fluid sortable">
            	<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2>Input Organisasi Manajemen Energi</h2>
												<div class="box-icon">
                        	<h2>Tahun <?php echo date("Y")-1;?></h2>
						</div>
						<div class="box-icon">
						</div>
					</div>
					<div class="box-content">
                    	<form id="frmAdd" class="form-horizontal" action="<?php if($this->data['idnya'] ==''){echo base_url()."orgenergi/save";}else{echo base_url()."orgenergi/edit";} ?>" method="post" enctype="multipart/form-data" >                        	
                            <div class="control-group">
							    <label class="control-label">Ada/Tidak Organisasi Manajemen Energi</label>
							    <div class="controls">
							      <label class="radio" id="IdOrgManajEnergi">
							        <input type="radio" name="OrgManajEnergi" id="optionsRadios3" <?php echo $this->data['adaorganisasi']; ?> >
							        Ada</label>
							      <div style="clear:both"></div>
							      <label class="radio">
							        <input type="radio" name="OrgManajEnergi" id="optionsRadios3" <?php echo $this->data['tidakadaorganisasi']; ?> >
							        Tidak </label>
						        </div>
						      </div>
							  <div class="control-group">
							    <label class="control-label" for="fileInput2">Pilih File (.pdf only) <br>
							      <dfn>*) Jika ada, lampirkan Struktur Organisasi dan/ atau Surat Keputusan Pembentukan</dfn></label>
							    <div class="controls">
							      <input class="input-file uniform_on" id="IdFileOrg" type="file" name="FileOrg"><?php if($this->data['pathfile'] !=''){ ?> | <a href="uploads/<?php echo $this->data['pathfile']; ?>"><?php echo $this->data['pathfile']; ?></a><?php } ?>
						        </div>
						      </div>
							  <div class="control-group">
							    <label class="control-label">Manajer Energi</label>
							    <div class="controls">
							      <label class="radio" id="IdManajEnergi">
							        <input type="radio" name="ManajEnergi" id="optionsRadios5" <?php echo $this->data['adamanager']; ?> >
							        Ada</label>
							      <div style="clear:both"></div>
							      <label class="radio">
							        <input type="radio" name="ManajEnergi" id="optionsRadios5" <?php echo $this->data['tidakadamanager']; ?> >
							        Tidak </label>
						        </div>
						      </div>
							  <div class="control-group">
							    <label class="control-label" for="IdNamaManaj">Nama Manajer Energi</label>
							    <div class="controls">
							      <input class="input-xlarge focused" id="IdNamaManaj" type="text" name="NamaManaj" value="<?php echo $this->data['namamanager']; ?>" >
						        </div>
						      </div>
							  <div class="control-group">
							    <label class="control-label" for="IdEmailManaj">Email Manajer Energi</label>
							    <div class="controls">
							      <input class="input-xlarge focused" id="IdEmailManaj" type="text" name="EmailManaj" value="<?php echo $this->data['emailmanager']; ?>">
						        </div>
						      </div>
							  <div class="control-group">
							    <label class="control-label" for="IdNoManaj">No Telp / HP Manajer Energi</label>
							    <div class="controls">
							      <input class="input-xlarge focused" id="IdNoManaj" type="text" name="NoManaj" value="<?php echo $this->data['notelepon']; ?>" >
						        </div>
						      </div>
							  <div class="control-group">
							    <label class="control-label" for="IdNoSertifikat">No Sertifikat</label>
							    <div class="controls">
							      <input class="input-xlarge focused" id="IdNoSertifikat" type="text" name="NoSertifikat" value="<?php echo $this->data['nosertifikat']; ?>" >
						        </div>
						      </div>
						      
							  <div class="control-group">
							    <label class="control-label" for="fileInput2">Pilih File (.pdf only) <br>
							      <dfn>*) Jika ada, lampirkan Sertifikat</dfn></label>
							    <div class="controls">
							      <input class="input-file uniform_on" id="IdFileOrgSertifikat" type="file" name="FileSertifikat"><?php if($this->data['pathfilesertifikat'] !=''){ ?> | <a href="uploads/<?php echo $this->data['pathfilesertifikat']; ?>"><?php echo $this->data['pathfilesertifikat']; ?></a><?php } ?>
						        </div>
						      </div>							 					      
						      
                              <div class="form-actions">
                                 	<!-- <span class="btn btn-primary" id="addrow">Tambah Data</span> -->
                                 	                                <input type="hidden" name="idnya" value="<?php echo $this->data['idnya']; ?>" />
                                 	                                <input type="hidden" name="thefileorg" value="<?php echo $this->data['pathfile']; ?>" />
                                 	                                <input type="hidden" name="thefilesertifikat" value="<?php echo $this->data['pathfilesertifikat']; ?>" />
																	<input id="next" class="btn btn-primary" type="submit" value="Simpan" />
                                    <span class="btn btn-primary" id="cancelupdate" style="display:none">Batalkan</span>
                              </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="row-fluid sortable">
                <div class="box span12">
                	<div class="box-content">
                    	<span class="btn btn-primary" onClick="document.location='<?php $type=$this->session->userdata('type_perusahaan');
							 switch ($type){
								 case 1:
								 echo base_url()."jenisproduksi";
								 break;
								 case 2:
								 echo base_url()."luasbangunan";
								 break;
								 } ?>'" style="float:right">Next</span>

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
						return '<div align="right">'+obj.aData[4]+'&nbsp;'+obj.aData[7]+'</div>';
					}
				},
				{
					"aTargets":[3],
					"fnRender": function(obj){
						return '<div align="right">'+obj.aData[5]+'</div>';
					}
				},
				{
					"aTargets":[4],
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
		});
		
		$("#konversi").live('change', function(){
			orgunit = parseFloat($("#original_unit").val());
			konversi = parseFloat($(this).val());
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
			   oTable.fnDraw();
			   $("#id_peralatan_pemanfaat_energi").val('');
			   $("#id_jenis_peralatan").val('');
			   $("#jenis_peralatan_lain").val('');
			   $("#id_jenis_energi").val('');
			   $("#jenis_energi_lain").val('');
			   $("#original_unit").val('');
			   $("#konversi").val('');
			   $("#gjoule").val('');
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
    
    