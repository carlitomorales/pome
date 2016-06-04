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
                             <h5>Input Kebijakan dan Organisasi Manajemen Energi</h5>
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
						<h2>Input Kebijakan dan Organisasi Manajemen Energi</h2>
												<div class="box-icon">
                        	<h2>Tahun <?php echo date("Y")-1;?></h2>
						</div>
						<div class="box-icon">
						</div>
					</div>
					<div class="box-content">
					<span><?php echo $this->data['msgupload'];?></span>
					<?php if($this->session->userdata('msgorgen') != '') {?>
					<div id="divAlert" class="alert alert-success"><?php echo $this->session->userdata('msgorgen'); ?></div>
					<?php } $this->session->set_userdata('msgorgen','');?>
                    	<form id="frmAdd" class="form-horizontal" action="<?php if($this->data['idnya'] ==''){echo base_url()."orgenergi/save";}else{echo base_url()."orgenergi/edit";} ?>" method="post" enctype="multipart/form-data" >                        	
                            <div class="control-group">
							    <label class="control-label">ada/tidak Kebijakan Efisiensi Energi Perusahaan</label>
							    <div class="controls">
							      <label class="radio" id="IdkebijakanEnergi">
							        <input type="radio" name="KebijakanEnergi" id="optionsRadioskbjk1" <?php echo $this->data['adakebijakan']; ?> >
							        Ada</label>
							      <div style="clear:both"></div>
							      <label class="radio">
							        <input type="radio" name="KebijakanEnergi" id="optionsRadioskbjk2" <?php echo $this->data['tidakadakebijakan']; ?> >
							        Tidak </label>
						        </div>
						      </div>
                              
                              <div class="control-group" id="upKebijakanEnergi" <?php if($this->data['kebijakanenergi'] == '0') echo " style='display:none;'"?> >
							    <label class="control-label" for="fileInput2">Pilih File (.pdf only max 4MB) <br>
							      <dfn>*) Jika ada, lampirkan dokumen Kebijakan Efisiensi Energi Perusahaan</dfn></label>
							    <div class="controls">
							      <input class="input-file uniform_on" id="IdFileKebijakan" type="file" name="FileKebijakan"><?php if($this->data['pathfilekebijakan'] !=''){ ?> | <a href="uploads/<?php echo $this->data['pathfilekebijakan']; ?>"><?php echo $this->data['pathfilekebijakan']; ?></a><?php } ?>
						        </div>
						      </div>
							 
							  <div class="control-group" >
							    <label class="control-label">Ada/Tidak Organisasi Manajemen Energi</label>
							    <div class="controls">
							      <label class="radio" id="IdOrgManajEnergi">
							        <input type="radio" name="OrgManajEnergi" id="optionsRadios31" <?php echo $this->data['adaorganisasi']; ?> >
							        Ada</label>
							      <div style="clear:both"></div>
							      <label class="radio">
							        <input type="radio" name="OrgManajEnergi" id="optionsRadios32" <?php echo $this->data['tidakadaorganisasi']; ?> >
							        Tidak </label>
						        </div>
						      </div>
							  
							   <div class="control-group" id="upOrgManajEnergi" <?php if($this->data['orgmgmntenergi'] == '0') echo " style='display:none;'"?>>
							    <label class="control-label" for="fileInput2">Pilih File (.pdf only max 4MB) <br>
							      <dfn>*) Jika ada, lampirkan Struktur Organisasi dan/ atau Surat Keputusan Pembentukan</dfn></label>
							    <div class="controls">
							      <input class="input-file uniform_on" id="IdFileOrg" type="file" name="FileOrg"><?php if($this->data['pathfile'] !=''){ ?> | <a href="uploads/<?php echo $this->data['pathfile']; ?>"><?php echo $this->data['pathfile']; ?></a><?php } ?>
						        </div>
						      </div>
							  
							  <div class="control-group">
                                  <label class="control-labelsubmini">Manajer Energi Bersertifikat</label>
							  </div>

<!--                            <div class="control-group">-->
<!--                                <label class="control-label" for="IdNamaStaffManaj">Nama Staff Manajer Energi</label>-->
<!--                                <div class="controls">-->
<!--                                    <input class="input-xlarge focused" id="IdNamaStaffManaj" type="text" name="NamaStaffManaj" value="--><?php //echo $this->data['namastaffmanager']; ?><!--" >-->
<!--                                </div>-->
<!--                            </div>-->
<!---->
<!--                            <div class="control-group">-->
<!--                                <label class="control-label" for="IdNamaSPVManaj">Nama Supervisor Manajer Energi</label>-->
<!--                                <div class="controls">-->
<!--                                    <input class="input-xlarge focused" id="IdNamaSPVManaj" type="text" name="NamaSPVManaj" value="--><?php //echo $this->data['namaspvmanager']; ?><!--" >-->
<!--                                </div>-->
<!--                            </div>-->

                            <div class="control-group">
                                <label class="control-label" for="IdJabatanManajerEnergi">Jabatan Manajer Energi</label>
                                <div class="controls">
                                    <select id="IdJabatanManajerEnergi" name="IdJabatanManajerEnergi" >

                                        <?php
                                        if (is_null($jabatanmanajerenergi)==true){
                                            echo "<option selected value=''>-- Pilih --</option>";
                                        } else {
                                            echo "<option value=''>-- Pilih --</option>";
                                        }

                                        foreach($data_jabatanmanajerenergi as $row){
                                            //echo "<option value='".$row->id."'>".$row->value."</option>";
                                            if ($row->IdMJabatanManajerEnergi == $jabatanmanajerenergi){
                                                echo "<option selected value='".$row->IdMJabatanManajerEnergi."'>".$row->JabatanManajerEnergi."</option>";
                                            } else {
                                                echo "<option value='" . $row->IdMJabatanManajerEnergi . "'>" . $row->JabatanManajerEnergi . "</option>";
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>



                            <div class="control-group"> 
                                <label class="control-label" for="IdNamaManaj">Nama Manajer Energi</label>
                                <div class="controls">
                                    <input class="input-xlarge focused" id="IdNamaManaj" type="text" name="NamaManaj" value="<?php echo $this->data['namamanager']; ?>" >
                                </div>
                            </div>
<!---->
<!--                            <div class="control-group">-->
<!--                                <label class="control-label" for="IdNamaGenManaj">Nama General Manajer Energi</label>-->
<!--                                <div class="controls">-->
<!--                                    <input class="input-xlarge focused" id="IdNamaGenManaj" type="text" name="NamaGenManaj" value="--><?php //echo $this->data['namagenmanager']; ?><!--" >-->
<!--                                </div>-->
<!--                            </div>-->

                            <div class="control-group">
                                <label class="control-label" for="IdDetailJab">Detail Jabatan</label>
                                <div class="controls">
                                    <textarea class="input-xlarge focused" id="IdDetailJab" type="text" name="DetailJab" ><?php echo $this->data['detailjabatan']; ?></textarea>
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
							    <label class="control-label">Manajer Energi Bersertifikasi</label>
							    <div class="controls">
							      <label class="radio" id="IdManajEnergi">
							        <input type="radio" value="1" name="ManajEnergi" id="optionsRadios5" <?php echo $this->data['adamanager']; ?> >
							        Ya</label>
							      <div style="clear:both"></div>
							      <label class="radio">
							        <input type="radio" value="0" name="ManajEnergi" id="optionsRadios5" <?php echo $this->data['tidakadamanager']; ?> >
							        Tidak </label>
						        </div>
						      </div>


							  <div class="control-group">
							    <label class="control-label" for="IdNoSertifikat">No Sertifikat</label>
							    <div class="controls">
							      <input class="input-xlarge focused" id="IdNoSertifikat" type="text" name="NoSertifikat" value="<?php echo $this->data['nosertifikat']; ?>" >
						        </div>
						      </div>
						      
							  <div class="control-group">
							    <label class="control-label" for="fileInput2">Pilih File (.pdf only max 4MB) <br>
							      <dfn>*) Jika ada, lampirkan Sertifikat</dfn></label>
							    <div class="controls">
							      <input class="input-file uniform_on" id="IdFileOrgSertifikat" type="file" name="FileSertifikat"><?php if($this->data['pathfilesertifikat'] !=''){ ?> | <a href="uploads/<?php echo $this->data['pathfilesertifikat']; ?>"><?php echo $this->data['pathfilesertifikat']; ?></a><?php } ?>
						        </div>
						      </div>							 					      
						      
                              <div class="form-actions">
                                 	<!-- <span class="btn btn-primary" id="addrow">Tambah Data</span> -->
                                 	                                <input type="hidden" name="idnya" value="<?php echo $this->data['idnya']; ?>" />
                                 	                                <input type="hidden" name="thefileorg" value="<?php echo $this->data['pathfile']; ?>" />
																	<input type="hidden" name="thefilekbjk" value="<?php echo $this->data['pathfilekebijakan']; ?>" />
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
				<div class="row-fluid">
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
             </div>
<?php include('footer.php'); ?>

	<script type="text/javascript">
	var oTable;
	
	$(document).ready(function(){
		$("input[name=KebijakanEnergi]:radio").change(function () {
			
			if ($("#optionsRadioskbjk1").attr("checked")) {
				$('#upKebijakanEnergi').show();
			}else{
				$('#upKebijakanEnergi').hide();
			}
		});
		$("input[name=OrgManajEnergi]:radio").change(function () {
			
			if ($("#optionsRadios31").attr("checked")) {
				$('#upOrgManajEnergi').show();
			}else{
				$('#upOrgManajEnergi').hide();
			}
		});
		$('#frmAdd').validate({			
			rules:{
			
				NamaManaj:{required: function(element) {return $('input[name="ManajEnergi"]:checked').val() == '1';}},
				EmailManaj:{required: function(element) {return $('input[name="ManajEnergi"]:checked').val() == '1';}},
				NoManaj:{number:true, required: function(element) {return $('input[name="ManajEnergi"]:checked').val() == '1';}},
				NoSertifikat:{required: function(element) {return $('input[name="ManajEnergi"]:checked').val() == '1';}}
			
			}			
		});
	});
	
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
    
    