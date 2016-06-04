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
			
			<div class="row-fluid"><!--/span-->
            	<div class="box span12">
                	<div class="box-content">
                    	<div id="form-wizard-3" class="step">
                           <div class="step-title">
                             <i><?php $type=$this->session->userdata('type_perusahaan');
							 switch ($type){
								 case 1:
								 echo "3";
								 break;
								 case 2:
								 echo "3";
								 break;
								 } ?></i>
                             <h5>Pemakaian Energi</h5>
                             <span><?php $type=$this->session->userdata('type_perusahaan');
							 switch ($type){
								 case 1:
								 echo "3 dari 8";
								 break;
								 case 2:
								 echo "3 dari 8";
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
						<h2>List Pemakaian Energi</h2>
						<div class="box-icon">
                        	<h2>Tahun <?php echo date("Y")-1;?></h2>
						</div>
					</div>
					<div class="box-content">
                    	<table class="table table-bordered bootstrap-datatable" id="datatable1">
                              <thead>
                                  <tr>
                                      <th>Jenis Energi</th>
									  <th>Detail Jenis Energi</th>
                                      <th>Original Unit</th>
                                      <th >GJoule</th>
									  <th >Emisi (TCO2)</th>
                                      <th >Actions</th>
                                  </tr>
								   <tfoot>
                                        <tr>
                                            <th colspan="3" style="text-align:Right">Total :</th>
                                            <th colspan="1" style="text-align:left"></th>
											<th colspan="1" style="text-align:left"></th>
											<th colspan="1" style="text-align:left"></th>
											 
                                        </tr>
										<tr>
                                            <th colspan="3" style="text-align:Right">TOE :</th>
                                            <th colspan="3" style="text-align:left"></th>
                                        </tr>
					
                                   </tfoot>  
                              </thead>  
                          </table> 
                    </div>
                </div>
             </div>
             <div class="row-fluid">
            	<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2>Input Pemakaian Energi</h2>
						<div class="box-icon">
                       		<h2>Tahun <?php echo date("Y")-1;?></h2>
						</div>
					</div>
					<div class="box-content">
                    	<div id="divAlert"></div>
                    	<form id="frmAdd" class="form-horizontal" method="post">                        	
                            
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
                                        <input type="hidden" id="id_pemakaian_energi" name="id_pemakaian_energi" />
                                 </div>
                             </div>
							
							 <div class="control-group" id='divJenisEnergiDetail' style="display:none">
							  <label class="control-label" for="jenis_energi_detail">Detail Jenis Energi</label>
							  <div class="controls">
                              	<select name="jenis_energi_detail" id="jenis_energi_detail">
                                	<option value="" >-- Pilih --</option>     
																	
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
                                      <input class="input-small focused" id="original_unit" name="original_unit" type="text"><span class="add-on" id="spanSatuan"> </span><span> (* khusus untuk jenis energi yang di input adalah jenis energi sebagai bahan bakar (fuel), bukan sebagai bahan baku</span> 
                                     </div>
                                    </div>
									
                              </div>
                             <div class="control-group">
                                	<label class="control-label" for="konversi">Konversi</label>
                                    <div class="controls">
                                      <input class="input-small focused" id="konversi" name="konversi" type="text">
                                      <a href="#" class="btn btn-warning" data-rel="popover" data-content="Perhitungan konversi dari original unit ke GJoule disesuaikan
dengan nilai kalor dari masing-masing jenis energi.
Contoh faktor konversi : <br>
1 GWh listrik = 3600 GJoule;<br>
1 KiloLiter Minyak Diesel = 37.90 GJoule;<br>
1 Ton batubara = 24,53 GJoule;<br>
1 MSCF Gas = 1.03 GJoule;" title="Konversi">?</a>
                                    </div>
                              </div>
                              <div class="control-group">
                                    <label class="control-label" for="gjoule">GJoule</label>
                                    <div class="controls">
                                      <input class="input-small focused" id="gjoule" name="gjoule" type="text" readonly>
                                    </div>
                              </div>
                              <div class="form-actions">
                                 	<span class="btn btn-primary" id="addrow" type="submit">Tambah Data</span>
                                    <span class="btn btn-primary" id="cancelupdate" style="display:none">Batalkan</span>
                              </div>
                        </form>
                    </div>
                </div>
            </div>
             <div class="row-fluid">
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
								 } ?>'">Previous</span>
						<span class="btn btn-primary" onClick="document.location='<?php echo base_url();?>konsumsienergispesifik'" style="float:right">Next</span>
                    </div>
                </div>
              </div>
<?php include('footer.php'); ?>

	<script type="text/javascript">
	var oTable;
		
	$(document).ready(function(){
		
		oTable = $("#datatable1").dataTable({
		"fnFooterCallback": function (nRow, aaData, iStart, iEnd, aiDisplay) {
					iTotalGJoule = parseInt(0);
					iTotalTOE = parseInt(0);
					iTotalEmisi = parseInt(0);
					for ( var i=0 ; i<aaData.length ; i++ )
					{
						iTotalGJoule += parseInt(aaData[i][3].replace(/,/g, ""));	
						iTotalEmisi += parseInt(aaData[i][4].replace(/,/g, ""));	
					}
					
					/* Calculate the market share for browsers on this page */
					iTotalTOE = iTotalGJoule/41,868;
					/* Modify the footer row to match what we want */
					
					var nCells = nRow.getElementsByTagName('th');
					nCells[1].innerHTML=formatCurrency(parseFloat(iTotalGJoule),0);
					nCells[2].innerHTML=formatCurrency(parseFloat(iTotalEmisi),2);
					var secondRow = $(nRow).next()[0]; 
					var nCells1 = secondRow.getElementsByTagName('th'); 
					nCells1[1].innerHTML=formatCurrency(parseFloat(iTotalTOE),0);
					//var thirdRow = $(nRow).next()[1]; 
					//var nCells2 = thirdRow.getElementsByTagName('th'); 
					//nCells2[1].innerHTML=formatCurrency(parseFloat(iTotalEmisi),2);
					//nRow.innerHTML = "<th colspan="+"1"+" style="+"text-align:Right"+">Total:</th><th>"+parseFloat(iPageMarket)+"</th>";		
			},
			"aaSorting":[[5,"desc"]],
			"bDestroy":true,
			"bFilter":false,
			"bPaginate":false,
			"bInfo":false,
			"bProcessing": true,
			"bServerSide": true,
			"sAjaxSource": "<?php echo base_url();?>pemakaianenergi/listpemakaianenergi",
			"sServerMethod" : "POST",
			"sDom": "<'row-fluid'<'span6'l><'span6'f>r>t<'row-fluid'<'span12'i><'span12 center'p>>",
			"sPaginationType": "bootstrap",
			"oLanguage": {
				"sLengthMenu": "_MENU_ records per page"
			},
			"aoColumnDefs":[
				{
					"aTargets":[2],
					"fnRender": function(obj){
						var satuan='';
						if(obj.aData[6] == null){satuan;}else{satuan=obj.aData[6];}
						return '<div align="right">'+formatCurrency(obj.aData[3],2)+'&nbsp;'+satuan+'</div>';
					}
				},
				{
					sClass: "alignRight",
					"aTargets":[3],
					"fnRender": function(obj){
						return formatCurrency(obj.aData[4],0) ; //'<div align="right">'+formatCurrency(obj.aData[4],0)+'</div>';
					}
				},
				{
					sClass: "alignRight",
					"aTargets":[4],
					"fnRender": function(obj){
						return formatCurrency(obj.aData[7]*obj.aData[4],2) ; //'<div align="right">'+formatCurrency(obj.aData[4],0)+'</div>';
					}
				},
				{
					"aTargets":[5],
					"fnRender": function(obj){
						return '<span class="btn btn-mini btn-primary btnedit" id="'+obj.aData[5]+'">Edit</span>&nbsp;<span class="btn btn-mini btn-warning btndelete" id="'+obj.aData[5]+'">Delete</span>&nbsp;';
					}
				}
			]
		});
		
		$('#id_jenis_peralatan').live('change', function(){
			$("#divAlert").removeClass();
			$("#divAlert").html('');
			if($("#id_jenis_peralatan").find("option:selected").text() == 'Lain-Lain'){
				$("#jenisperalatanlain").show();
			}else{
				$("#jenisperalatanlain").hide();
			}
		});
		
		$('#id_jenis_energi').live('change', function(){
			$("#divAlert").removeClass();
			$("#divAlert").html('');
			if($("#id_jenis_energi").find("option:selected").text() == 'Lain-Lain'){
				$("#divJenisEnergiLain1").show();
				$("#divJenisEnergiDetail").hide();
			}else{
				$("#divJenisEnergiLain1").hide();
				$("#divJenisEnergiDetail").show();				
			}
			
			var id = $("#id_jenis_energi").find("option:selected").val();
			var url = "<?php echo base_url();?>pemakaianenergi/getSatuanJenisEnergi/"+id;
			$.post(url, '', function(data){
				objResp = $.parseJSON(data);
				rowdata = objResp[0];
				if(rowdata.Satuan != null && rowdata){
					$("#spanSatuan").html(' '+rowdata.Satuan);
				}else{
					$("#spanSatuan").html(' ');
				}
			});
			 
			var IdJenisEnergi = id;
			//$('#jenis_energi_detail').attr("disabled",true);
			$.ajax({
					type: "POST",
					url : "<?php echo site_url('pemakaianenergi/select_energi_detail')?>",
					data: {IdJenisEnergi:IdJenisEnergi},
					success: function(msg){
						document.getElementById('divJenisEnergiDetail').innerHTML = msg;
					}
					
			});
				
		});
		
		$("#konversi").live('change', function(){
			$("#divAlert").removeClass();
			$("#divAlert").html('');
			orgunit = parseFloat($("#original_unit").val());
			konversi = parseFloat($(this).val());
			gjoule = orgunit * konversi;
			
			if (!isNaN(gjoule))
			{$("#gjoule").val(gjoule); }
		});
		
		$("#original_unit").live('change', function(){
			$("#divAlert").removeClass();
			$("#divAlert").html('');
			orgunit = parseFloat($(this).val());
			konversi = parseFloat($("#konversi").val());
			gjoule = orgunit * konversi;
			if (!isNaN(gjoule))
			{ $("#gjoule").val(gjoule); }
		});
		
		$(".btnedit").live('click', function(){
			$("#divAlert").removeClass();
			$("#divAlert").html('');
			var id = $(this).attr('id');
			var url = "<?php echo base_url();?>pemakaianenergi/getDetail/"+id; // the script where you handle the form input.
			$.post(url, '', function(data){
				objResp = $.parseJSON(data);
				rowdata = objResp[0];
				if(rowdata){
					$("#id_pemakaian_energi").val(rowdata.id_pemakaian_energi);
					$("#id_jenis_peralatan").val(rowdata.id_jenis_peralatan);
					$("#jenis_peralatan_lain").val(rowdata.jenis_peralatan_lain);
					$("#id_jenis_energi").val(rowdata.id_jenis_energi);
					//$("#jenis_energi_detail").val(rowdata.id_jenis_energi_detail);
					$("#jenis_energi_lain").val(rowdata.jenis_energi_lain);
					$("#original_unit").val(rowdata.original_unit);
					$("#konversi").val(rowdata.konversi);
					$("#gjoule").val(rowdata.gjoule);
					$("#spanSatuan").html(' '+rowdata.Satuan);
					$("#cancelupdate").show();
					$("#addrow").html("Simpan Data");
					if(rowdata.id_jenis_energi_detail != ''){
						$("#divJenisEnergiDetail").show();
						var IdJenisEnergiDetail = rowdata.id_jenis_energi_detail;
						$.ajax({
								type: "POST",
								url : "<?php echo site_url('pemakaianenergi/select_energi_detail')?>",
								data: {IdJenisEnergi:rowdata.id_jenis_energi},
								success: function(msg){
									document.getElementById('divJenisEnergiDetail').innerHTML = msg;
								}
								
						});
						var urlddenergidetail = "<?php echo base_url();?>pemakaianenergi/load_dd_energidetail/"+IdJenisEnergiDetail;
							$.post(urlddenergidetail, '', function(data){
								objResp = $.parseJSON(data);
								rowddenergdet = objResp;
								$("#jenis_energi_detail").val(rowddenergdet.id_jenis_energi_detail);
								$("#jenis_energi_detail").attr("selected","selected");

							})
						//$('#jenis_energi_detail').attr("disabled",true);
						//$.ajax({
								//type: "POST",
								//url : "<?php echo site_url('pemakaianenergi/select_energi_detail')?>",
								//data: {IdJenisEnergi:IdJenisEnergi},
								//success: function(msg){
									//document.getElementById('divJenisEnergiDetail').innerHTML = msg;
								//}
								
						//});
						//$("#jenis_energi_detail").val(rowdata.id_jenis_energi_detail);
						//$("#jenis_energi_detail").attr("selected","selected");
						//alert($('#jenis_energi_detail').val());
						
					}else{
						$("#divJenisEnergiDetail").hide();
					}
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
					$("#id_pemakaian_energi").val('');
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
					$("#jenis_energi_detail").val('');
					$("#divJenisEnergiDetail").hide();
				}
			});
			return false;
		});
		
		$("#addrow").click(function(){
			if($("#id_jenis_energi").val() == ''){
				$("#divAlert").removeClass();
				$("#divAlert").addClass('alert alert-error');
				$("#divAlert").html("Jenis energi harus dipilih.");
				$("#id_jenis_energi").focus();
				return false;
			}else{
				if($("#id_jenis_energi").find("option:selected").text() == 'Lain-Lain'){
					if($("#jenis_energi_lain").val() == ''){
						$("#divAlert").removeClass();
						$("#divAlert").addClass('alert alert-error');
						$("#divAlert").html("Jenis energi lain harus diisi.");
						$("#jenis_energi_lain").focus();
						return false;
					}
				}
			}
			if($("#original_unit").val() == ''){
				$("#divAlert").removeClass();
				$("#divAlert").addClass('alert alert-error');
				$("#divAlert").html("Jumlah pemakaian energi harus diisi.");
				$("#original_unit").focus();
				return false;
			}

			if(!$.isNumeric($("#original_unit").val()))
			{
				$("#divAlert").removeClass();
				$("#divAlert").addClass('alert alert-error');
				$("#divAlert").html("Jumlah pemakaian energi harus numerik.");
				$("#original_unit").focus();
				return false;					
			}
			if($("#konversi").val() == ''){
				$("#divAlert").removeClass();
				$("#divAlert").addClass('alert alert-error');
				$("#divAlert").html("Konversi harus diisi.");
				$("#konversi").focus();
				return false;
			}
			if(!$.isNumeric($("#konversi").val()))
			{
				$("#divAlert").removeClass();
				$("#divAlert").addClass('alert alert-error');
				$("#divAlert").html("Konversi harus numerik.");
				$("#konversi").focus();
				return false;					
			}
			var url = "<?php echo base_url();?>pemakaianenergi/save"; // the script where you handle the form input.
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
			   $("#id_pemakaian_energi").val('');
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
				$("#divJenisEnergiDetail").hide();
			});	
		return false;
	});


		$("#cancelupdate").click(function(){
			$("#id_pemakaian_energi").val('');
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
			$("#jenis_energi_detail").val('');
			$("#divJenisEnergiDetail").hide();
		});
		
		$(".btndelete").live('click', function(){
			$("#divAlert").removeClass();
			$("#divAlert").html('');
			id = $(this).attr('id');
			conf = confirm("Hapus data pemakaian energi ini?");
			if(conf){
				var url = "<?php echo base_url();?>pemakaianenergi/hapus/"+id; // the script where you handle the form input.
				$.post(url, '', function(data){
					oTable.fnDraw();
				   
				   $("#id_pemakaian_energi").val('');
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
					$("#jenis_energi_detail").val('');
					$("#divJenisEnergiDetail").hide();
					
					resp = $.parseJSON(data);
					alert(resp.msg);
				});	
				return false;
			}
		});
	});	
    </script>