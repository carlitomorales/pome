<?php include('header.php'); ?>
<!DOCTYPE html>
<html lang="en">



	<script type="text/javascript">
		function hideDiv(){ document.getElementById('divLainLain').style.display = 'none'; document.getElementById('IdSubsektorLain').style.display = 'none';} 
		function showDiv(){ document.getElementById('divLainLain').style.display = 'inline'; document.getElementById('IdSubsektorLain').style.display = 'inline'; } 
    </script>


			<!-- content starts -->
			
			<div>
				<ul class="breadcrumb">
					<li>
						<a href="#">Home</a> <span class="divider">/</span>
					</li>
					<li>
						<a href="#">Profile Perusahaan</a>
					</li>
				</ul>
			</div>
	
			<div class="row-fluid">
				<div class="box span12">
					<div class="box-header well" data-original-title>
					  Profile Perusahaan </div>
					<div class="box-content">
	                    <div id="divAlert"></div>
						<form class="form-horizontal" id="idFormAdd" method="post">

							<div class="control-group">
							  <label class="control-label" for="focusedInput2">Nama Perusahaan</label>
							  <div class="controls">
							    <input class="input focused" id="IdNamaPerusahaan" name="IdNamaPerusahaan" type="text">
						      </div>
						    </div>
                            <?php

                            if (is_null($cekinfo)==false){
                            foreach($cekinfo as $rowcek){
                                $idtypeperusaaanvar = $rowcek->idtypeperusahaan;
                                $typeperusaaanvar = $rowcek->typeperusahaan;
                                $idsubsektorvar = $rowcek->idsubsektor;
                                $subsektorvar = $rowcek->subsektor;
                            };}else{
                                $idtypeperusaaanvar = "";
                                $typeperusaaanvar = "";
                                $idsubsektorvar = "";
                                $subsektorvar = "";
                            }

                            ?>

<!--                            <input class="input focused" id="idtypeperusahaan" name="idtypeperusahaan" value="--><?php //echo $idtypeperusaaanvar ?><!--" type="text">-->
<!--                            <input class="input focused" id="typeperusahaan" name="typeperusahaan" value="--><?php //echo $typeperusaaanvar ?><!--" type="text">-->
<!--                            <input class="input focused" id="idsubsektor" name="idsubsektor" value="--><?php //echo $idsubsektorvar ?><!--" type="text">-->
<!--                            <input class="input focused" id="subsektor" name="subsektor" value="--><?php //echo $subsektorvar ?><!--" type="text">-->

                            <?php if((is_null($typeperusaaanvar)== true) and (is_null($subsektorvar)==true)){ ?>
                            <!-- yg lama / user baru -->
							<div class="control-group">
							  <label class="control-label" for="IdTypePerusahaan">Type Perusahaan</label>
							  <div class="controls">
							    <select id="IdTypePerusahaan" name="IdTypePerusahaan" onChange="TypePrshnChange()">
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
						
                            <div class="control-group" id='divSubSektor' style="display:none">
							  <label class="control-label" for="IdSubsektor">Sub Sektor</label>
							  <div class="controls">
                              	<select name="IdSubsektor" id="IdSubsektor">
                                	<option value="" >-- Pilih --</option>                              
                                </select>
						      </div>
						    </div>
                            <script type="text/javascript">
							function TypePrshnChange(){
								var selectValues = document.getElementById('IdTypePerusahaan').value;
									if (selectValues == 0){
										document.getElementById('divLainLain').style.display = 'none';
										document.getElementById('divSubSektor').style.display = 'none';
										//document.getElementById('kota').innerHTML(msg);
									}else{
										document.getElementById('divLainLain').style.display = 'none';
										document.getElementById('divSubSektor').style.display = 'inline';
										var IdTypePerusahaan = selectValues;
										$('#kota_id').attr("disabled",true);
										$.ajax({
												type: "POST",
												url : "<?php echo site_url('Perusahaan/select_subsektor')?>",
												data: {IdTypePerusahaan:IdTypePerusahaan},
												success: function(msg){
													document.getElementById('divSubSektor').innerHTML = msg;
												}
										});
									}
								}
							
						   </script>
							<div class="control-group">
                               <div class="controls"  id="divLainLain" style="display:none" >
							    <input id="IdSubsektorLain" name="IdSubsektorLain"  type="text" class="typeahead" data-provide="typeahead" data-items="4" data-source='[<?php  
									$list = '';
									foreach($data_subsektorlain as $subsektor_lain)
									{
										$list .= '"'.$subsektor_lain->SubsektorLain.'",';
									}
									$list = substr($list,0,strlen($list)-1);
									echo $list;
								?>]'>
						      </div>
						    </div>
                            <!-- yg lama / user baru -->
                            <?php } else { ?>
                            <!-- user lama -->
                                <div class="control-group">
                                    <label class="control-label" for="IdTypePerusahaan">Type Perusahaan</label>
                                    <div class="controls">
                                        <select id="IdTypePerusahaan" name="IdTypePerusahaan" >
<!--                                            <option selected value="">-- Pilih --</option>-->
                                            <?php
                                                echo "<option value='".$idtypeperusaaanvar."'>".$typeperusaaanvar."</option>";
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="control-group" id='divSubSektor' style="display:none">
                                    <label class="control-label" for="IdSubsektor">Sub Sektor</label>
                                    <div class="controls">
                                        <select name="IdSubsektor" id="IdSubsektor">
<!--                                            <option value="" >-- Pilih --</option>-->
                                            <?php
                                            echo "<option value='".$idsubsektorvar."'>".$subsektorvar."</option>";
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <script type="text/javascript">
                                    function TypePrshnChange(){

                                    }

                                </script>
                                <div class="control-group">
                                    <div class="controls"  id="divLainLain" style="display:none" >
                                        <input id="IdSubsektorLain" name="IdSubsektorLain"  type="text" class="typeahead" data-provide="typeahead" data-items="4" data-source='[<?php
                                        $list = '';
                                        foreach($data_subsektorlain as $subsektor_lain)
                                        {
                                            $list .= '"'.$subsektor_lain->SubsektorLain.'",';
                                        }
                                        $list = substr($list,0,strlen($list)-1);
                                        echo $list;
                                        ?>]'>
                                    </div>
                                </div>


                                <!-- user lama -->

                            <?php }  ?>


							<div class="control-group">
							  <label class="control-label" for="alamat">Alamat</label>
							  <div class="controls">
							    <textarea id="IdAlamat" name="IdAlamat" class="autogrow"></textarea>
						      </div>
						    </div>
							<div class="control-group">
							  <label class="control-label" for="IdProvinsi">Provinsi</label>
							  <div class="controls">
								<select name="IdProvinsi" id="IdProvinsi" onChange="ProvChange()" >
							      <option value="" selected>-- Pilih --</option>
                                   <?php
											foreach($option_propinsi as $row){
												//echo "<option value='".$row->id."'>".$row->value."</option>";
												echo "<option value='".$row->propinsi_id."'>".$row->propinsi."</option>";
											}
										?>
							      </select>
						      </div>
						    </div>
							<div class="control-group" id='divKota' style="display:none">
							  <label class="control-label" for="IdKota">Kota/Kab</label>
							  <div class="controls">
                              	<select name="IdKota" id="IdKota">
                                	<option value="" >-- Pilih --</option>                              
                                </select>
						      </div>
						    </div>
                            <script type="text/javascript">
							function ProvChange(){
								var selectValues = document.getElementById('IdProvinsi').value;
									if (selectValues == 0){
										document.getElementById('divKota').style.display = 'none';
										//document.getElementById('kota').innerHTML(msg);
									}else{
										document.getElementById('divKota').style.display = 'inline';
										var propinsi_id = selectValues;
										$('#kota_id').attr("disabled",true);
										$.ajax({
												type: "POST",
												url : "<?php echo site_url('Perusahaan/select_kota')?>",
												data: {propinsi_id:propinsi_id},
												success: function(msg){
													document.getElementById('divKota').innerHTML = msg;
												}
												
										});
										
									}
								}
							
						   </script>
							<div class="control-group">
							  <label class="control-label" for="IdNoTelepon">NoTelepon</label>
							  <div class="controls">
							    <input class="input focused" id="IdNoTelepon" name="IdNoTelepon" type="text" >
						      </div>
						    </div>
							<div class="control-group">
							  <label class="control-label" for="IdKodePos">Kode Pos</label>
							  <div class="controls">
							    <input class="input focused" id="IdKodePos" name="IdKodePos" type="text" >
						      </div>
						    </div>
							<div class="control-group">
							  <label class="control-label" for="IdNoFax">No Faksimile</label>
							  <div class="controls">
							    <input class="input focused" id="IdNoFax" name="IdNoFax" type="text">
						      </div>
						    </div>
							<div class="control-group">
							  <label class="control-label" for="IdThnAwal">Tahun Awal Beroperasi</label>
							  <div class="controls">
							    <!--input class="input-xlarge focused" id="IdThnAwal" name="IdThnAwal" type="text"-->
                                <? function createYears($start_year, $end_year, $id='IdThnAwal', $selected=null)
									{
										/*** the current year ***/
										$selected = is_null($selected) ? date('Y') : $selected;
										/*** range of years ***/
										$r = range($start_year, $end_year);
										/*** create the select ***/
										$select = '<select name="'.$id.'" id="'.$id.'">';
										foreach( $r as $year )
										{
											$select .= "<option value=\"$year\"";
											$select .= ($year==$selected) ? ' selected="selected"' : '';
											$select .= ">$year</option>\n";
										}
										$select .= '</select>';
										return $select;
									}
									echo createYears(1945, 2020, 'IdThnAwal', null);
								?>
						      </div>
						    </div>
							<div class="control-group">
							  <label class="control-label" for="IdJumKar">Jumlah Karyawan</label>
							  <div class="controls">
							    <input class="input-jumlah focused" size="15" id="IdJumKar" name="IdJumKar" type="text" >
                                <input id="IdSesType" type="hidden"  value="<?php echo $this->session->userdata('type_perusahaan'); ?>">
                                <input id="IdSesPer" type="hidden"  value="<?php echo $this->session->userdata('id_perusahaan'); ?>">
						      </div>
							</div>
                       		<div class="form-actions">
								<span class="btn btn-primary" id="save">Simpan</span>
							</div>
						</form>   

				
				</div><!--/span-->

			</div><!--/row-->


	

	</div><!--/.fluid-container-->
			</div><!--/#content.span10-->
				</div><!--/fluid-row-->
<?php include('footer.php'); ?>

<script language="javascript">

			
	$(document).ready(function(){
		
		//if ($("#IdSesType").val() != "")
		//{
			var id_perusahaan = $("#IdSesPer").val();
			var url = "<?php echo base_url();?>Perusahaan/loadForm/"+id_perusahaan;
			$.post(url, '', function(data){
				objResp = $.parseJSON(data);
				rowdata = objResp;
				
				if(rowdata && $("#IdSesType").val() != "0"){
					$("#divAlert").removeClass();
					$("#divAlert").html('');
					$("#IdNamaPerusahaan").val(rowdata.NamaPerusahaan);
		
					var idDrop='';
					if (rowdata.TypePerusahaan == "Bangunan")
					{ idDrop = '2'; } 
					else {idDrop = '1';}
			
					$("#IdTypePerusahaan").val(idDrop);

					$("#IdTypePerusahaan").change(TypePrshnChange());	
					if(rowdata.IdSubsektor != ''){
						var urlddsubsek = "<?php echo base_url();?>Perusahaan/load_dd_subsek/"+rowdata.IdSubsektor;
							$.post(urlddsubsek, '', function(data){
								objResp = $.parseJSON(data);
								rowddsubsek = objResp;
											
								$("#divSubSektor").css('display','inline');
								$("#IdSubsektor").val(rowddsubsek.IdMSubsektor);
								$("#IdSubsektor").attr("selected","selected");
								//alert($("#IdSubsektor").val());
								if ($("#IdSubsektor").val()== 11 || $("#IdSubsektor").val() == 10)
								{
									
									$("#divLainLain").css('display','inline');
									//$("#IdSubsektorLain").css('display','inline');
									$("#IdSubsektorLain").val(rowdata.SubsektorLain);
								}else{
									$("#divLainLain").css('display','none');
									//$("#IdSubsektorLain").css('display','none');
									$("#IdSubsektorLain").val('');
								}
		
							})
							
					}
					

					if(rowdata.SubsektorLain != ''){
						$("#IdSubsektorLain").css('display','inline');
						$("#IdSubsektorLain").val(rowdata.SubsektorLain);
					}else{
						$("#IdSubsektorLain").css('display','none');
						$("#IdSubsektorLain").val('');
					}
										
					$("#IdAlamat").val(rowdata.AlamatPerusahaan);
					

					var urlddprov = "<?php echo base_url();?>Perusahaan/load_dd_prov/"+rowdata.Prov;
					$.post(urlddprov, '', function(data){
						objResp = $.parseJSON(data);
						rowdd = objResp;
						
						$("#IdProvinsi").val(rowdd.propinsi_id);
						
						$("#IdProvinsi").change(ProvChange());															
						if(rowdata.KotaKab != ''){
							var urlddkotkab = "<?php echo base_url();?>Perusahaan/load_dd_kotakab/"+rowdata.KotaKab;
							$.post(urlddkotkab, '', function(data){
								objResp = $.parseJSON(data);
								rowddkot = objResp;
								$temp = rowddkot.kota_id;
								$("#divKota").css('display','inline');
								$("#IdKota").val($temp);
								// $("#IdKota").attr("selected","selected");
								//alert($("#IdKota").val());

							})	

						}

						

					})
					
					$("#IdNoTelepon").val(rowdata.NoTelp);
					$("#IdKodePos").val(rowdata.KodePos);
					$("#IdNoFax").val(rowdata.NoFax);
					$("#IdThnAwal").val(rowdata.ThnAwalOp);
					$("#IdJumKar").val(rowdata.JmlKaryawan);
					
				}
				else{
					var msgnotypeper = "Silahkan isi Informasi Umum berikut.";
					$("#divAlert").removeClass();
					$("#divAlert").addClass('alert alert-error');
					$("#divAlert").html(msgnotypeper);
					
					$("#IdNamaPerusahaan").val(rowdata.NamaPerusahaan);
					$("#IdTypePerusahaan").val('');
					$("#IdTypePerusahaan").change(TypePrshnChange());
										
					//$("#divSubSektor").css('display','inline');
					$("#IdSubsektor").val('');
					$("#IdSubsektorLain").val('');

					$("#IdAlamat").val('');
					$("#IdProvinsi").val('');
					$("#IdProvinsi").change(ProvChange());
												
					$("#divKota").css('display','none');
					$("#IdKota").val('');		
					$("#IdNoTelepon").val('');
					$("#IdNoFax").val('');
					$("#IdThnAwal").val('');
					$("#IdJumKar").val('');
					//$("#id_pemakaian_energi").val('');
				    //$("#id_jenis_peralatan").val('');
				    //$("#jenis_peralatan_lain").val('');
				    //$("#id_jenis_energi").val('');
				    //$("#jenis_energi_lain").val('');
				    //$("#original_unit").val('');
					//$("#konversi").val('');
				    //$("#gjoule").val('');
					//$("#spanSatuan").html(' ');
					//$("#cancelupdate").hide();
					//$("#addrow").html("Tambah Data");
					//$("#jenisperalatanlain").hide();
					//$("#divJenisEnergiLain1").hide();
				}	
		//}
		//)}
		$("#save").click(function(){
			if($("#IdNamaPerusahaan").val() == ''){
				$("#divAlert").removeClass();
				$("#divAlert").addClass('alert alert-error');
				$("#divAlert").html("Nama Perusahaan harus diisi.");
				$("#IdNamaPerusahaan").focus();
				return false;
			}
			if($("#IdTypePerusahaan").val() == ''){
				$("#divAlert").removeClass();
				$("#divAlert").addClass('alert alert-error');
				$("#divAlert").html("Type Perusahaan harus dipilih.");
				$("#IdTypePerusahaan").focus();
				return false;
			}
			if($("#IdSubsektor").val() == ''){
				$("#divAlert").removeClass();
				$("#divAlert").addClass('alert alert-error');
				$("#divAlert").html("Subsektor harus dipilih.");
				$("#IdSubsektor").focus();
				return false;
			}else{
				if($("#IdSubsektor").find("option:selected").text() == 'Lain-Lain'){
					if($("#IdSubsektorLain").val() == ''){
						$("#divAlert").removeClass();
						$("#divAlert").addClass('alert alert-error');
						$("#divAlert").html("Subsektor lain harus diisi.");
						$("#IdSubsektorLain").focus();
						return false;
					}
				}
			}
			if($("#IdProvinsi").val() == ''){
				$("#divAlert").removeClass();
				$("#divAlert").addClass('alert alert-error');
				$("#divAlert").html("Provinsi harus dipilih.");
				$("#IdProvinsi").focus();
				return false;
			}
			if($("#IdKota").val() == ''){
				$("#divAlert").removeClass();
				$("#divAlert").addClass('alert alert-error');
				$("#divAlert").html("Kota/Kabupaten harus dipilih.");
				$("#IdKota").focus();
				return false;
			}
			if($("#IdKodePos").val() == ''){
				$("#divAlert").removeClass();
				$("#divAlert").addClass('alert alert-error');
				$("#divAlert").html("Kode pos harus diisi.");
				$("#IdKodePos").focus();
				return false;
			}
			if($("#IdNoTelepon").val() == ''){
				$("#divAlert").removeClass();
				$("#divAlert").addClass('alert alert-error');
				$("#divAlert").html("No telepon harus diisi.");
				$("#IdNoTelepon").focus();
				return false;
			}
			if($("#IdNoFax").val() == ''){
				$("#divAlert").removeClass();
				$("#divAlert").addClass('alert alert-error');
				$("#divAlert").html("No fax harus diisi.");
				$("#IdNoFax").focus();
				return false;
			}
			if($("#IdAlamat").val() == ''){
				$("#divAlert").removeClass();
				$("#divAlert").addClass('alert alert-error');
				$("#divAlert").html("Alamat harus diisi.");
				$("#IdAlamat").focus();
				return false;
			}
			if($("#IdThnAwal").val() == ''){
				$("#divAlert").removeClass();
				$("#divAlert").addClass('alert alert-error');
				$("#divAlert").html("Tahun awal beroperasi harus dipilih.");
				$("#IdThnAwal").focus();
				return false;
			}
			if($("#IdJumKar").val() == ''){
				$("#divAlert").removeClass();
				$("#divAlert").addClass('alert alert-error');
				$("#divAlert").html("Jumlah karyawan harus diisi.");
				$("#IdJumKar").focus();
				return false;
			}
			var url = "<?php echo base_url();?>Perusahaan/save"; // the script where you handle the form input.
			$.post(url, $("#idFormAdd").serialize(), function(data){
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
			   //oTable.fnDraw();
			   //$("#id_pemakaian_energi").val('');
			   //$("#id_jenis_peralatan").val('');
			   //$("#jenis_peralatan_lain").val('');
			   //$("#id_jenis_energi").val('');
			   //$("#jenis_energi_lain").val('');
			  // $("#original_unit").val('');
			   //$("#konversi").val('');
			   //$("#gjoule").val('');
			   //$("#spanSatuan").html(' ');
				//$("#cancelupdate").hide();
				//$("#addrow").html("Tambah Data");
				//$("#jenisperalatanlain").hide();
				//$("#divJenisEnergiLain1").hide();
			});	

		return false;
		});

		
	});
	})
	//alert(message);
</script>
