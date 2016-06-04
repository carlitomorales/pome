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
                    	<div id="form-wizard-2" class="step">
                           <div class="step-title">
                             <i>2</i>
                             <h5>Jenis Produksi</h5>
                             <span>2 dari 8</span>
                           </div>
                        </div>
                    </div>
                </div>
            </div>
            
			<div class="row-fluid">	
                <div class="box span12">
					<div class="box-header well" data-original-title>
						<h2>List Jenis Produksi</h2>
						<div class="box-icon">
                        	<h2>Tahun <?php echo date("Y")-1;?></h2>
						</div>
					</div>
					<div class="box-content">
					        <table class="table table-striped table-bordered bootstrap-datatable" id="datatable1">
                                  <thead>
                                      <tr>
                                      	  <th>Subsektor</th>
                                          <th>Jenis Produksi</th>
                                          <th>Jumlah (<?php	foreach($data_satuan_produksi as $row){	echo $row->nama_satuan_produksi;}?>)</th>
										  <th>Actions</th>
                                      </tr>
                                  </thead>
                                   <tfoot>
                                        <tr>
                                            <th colspan="2" style="text-align:Right">Total:</th>
                                            <th colspan="5"></th>
                                        </tr>
                                   </tfoot>  
                              </table>
                          
                    </div>
                </div>
             </div>
            <div class="row-fluid">
            	<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2>Input Jenis Produksi</h2>
						<div class="box-icon">
                        	<h2>Tahun <?php echo date("Y")-1;?></h2>
						</div>
					</div>
					<div class="box-content">
                    	<div id="divAlert"></div>
                    	<form id="frmAdd" class="form-horizontal" method="post">
                        <div class="control-group" id='divSubSektor'>
                                      <label class="control-label" for="idSubsektor">Sub Sektor</label>
                                          <div class="controls">
                                                <select name="IdSubsektor" id="IdSubsektor" disabled>
                                                     <?php
													 		
                                                         echo "<option value='".$option_subsektor['IdMSubsektor']."' onClick=javascript:showDiv();>".$option_subsektor['NamaSubsektor']."</option>";
                                                   ?>                             
                                                </select>
                                          </div>
                            </div>
                            <div class="control-group">
                                    <label class="control-label" for="IdJnsProduksi">Jenis Produksi</label>
                                    <div class="controls">
                                      <input class="input focused" id="jenis_produksi" type="text" name="jenis_produksi">
                                       <input type="hidden" id="id_jenis_produksi" name="id_jenis_produksi" />
                                    </div>
                            </div>
                            <div class="control-group">
                                    <label class="control-label" for="IdSatuan">Satuan</label>
                                    <div class="controls">
                                     <select name="satuan" id="satuan" >
										
							      		<?php
											foreach($data_satuan_produksi as $row){
												//echo "<option value='".$row->id."'>".$row->value."</option>";
												echo "<option value='".$row->nama_satuan_produksi."'>".$row->nama_satuan_produksi."</option>";
											}
										?>
									 </select>
                                    </div>
                            </div>
                                                    	
                            
                                  <div class="control-group">
                                    <label class="control-label" for="IdJumlah">Jumlah</label>
                                    <div class="controls">
                                      <input class="input focused" id="jumlah" type="text" name="jumlah">
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
			"fnFooterCallback": function (nRow, aaData, iStart, iEnd, aiDisplay) {
					iTotalMarket = parseInt(0);
					for ( var i=0 ; i<aaData.length ; i++ )
					{
						//alert(aaData[i][1]);
						iTotalMarket += parseInt(aaData[i][2].replace(/,/g, "").replace("ton","")*1);
					
					}
					
					/* Calculate the market share for browsers on this page */
					
					/* Modify the footer row to match what we want */
					var nCells = nRow.getElementsByTagName('th');
					nCells[1].innerHTML=formatCurrency(parseFloat(iTotalMarket),2);
					//nRow.innerHTML = "<th colspan="+"1"+" style="+"text-align:Right"+">Total:</th><th>"+parseFloat(iPageMarket)+"</th>";		
			},
			"aaSorting":[[4,"desc"]],
			"bDestroy":true,
			"bFilter":false,
			"bPaginate":false,
			"bInfo":false,
			"bProcessing": true,
			"bServerSide": true,
			"sAjaxSource": "<?php echo base_url();?>jenisproduksi/listjenisproduksi",
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
						return formatCurrency(obj.aData[2],2);
					}
				},
				{
					"aTargets":[3],
					"fnRender": function(obj){
						return '<span class="btn btn-mini btn-primary btnedit" id="'+obj.aData[4]+'">Edit</span>&nbsp;<span class="btn btn-mini btn-warning btndelete" id="'+obj.aData[4]+'">Delete</span>&nbsp;';
					}
				}
			]
		});
		
		$('#id_jenis_produksi').live('change', function(){
			var id = $("#id_jenis_produksi").find("option:selected").val();
			
		});
		
		$('#id_jenis_produksi').live('change', function(){
			if($("#id_jenis_produksi").find("option:selected").text() == 'Lain-Lain'){
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
			$("#divAlert").removeClass();
			$("#divAlert").html('');
			var id = $(this).attr('id');
			var url = "<?php echo base_url();?>jenisproduksi/getDetail/"+id; // the script where you handle the form input.
			$.post(url, '', function(data){
				objResp = $.parseJSON(data);
				rowdata = objResp[0];
				if(rowdata){
					$("#id_jenis_produksi").val(rowdata.id_jenis_produksi);
					$("#jenis_produksi").val(rowdata.jenis_produksi);
					$("#satuan").val(rowdata.satuan);
					$("#jumlah").val(rowdata.jumlah);
					$("#cancelupdate").show();
					$("#addrow").html("Simpan Data");
				}else{
					$("#id_jenis_produksi").val('');
				    $("#jenis_produksi").val('');
				    $("#satuan").val('');
				    $("#jumlah").val('');
				    $("#cancelupdate").hide();
					$("#addrow").html("Tambah Data");
				}
			});
			return false;
		});
		
		$("#addrow").click(function(){
			if($("#jenis_produksi").val() == ''){
				$("#divAlert").removeClass();
				$("#divAlert").addClass('alert alert-error');
				$("#divAlert").html("Jenis produksi harus diisi.");
				$("#jenis_produksi").focus();
				return false;
			}
			if($("#jumlah").val() == ''){
				$("#divAlert").removeClass();
				$("#divAlert").addClass('alert alert-error');
				$("#divAlert").html("Jumlah produksi harus diisi.");
				$("#jumlah").focus();
				return false;
			}
			if(!$.isNumeric($("#jumlah").val()))
			{
				$("#divAlert").removeClass();
				$("#divAlert").addClass('alert alert-error');
				$("#divAlert").html("Jumlah produksi harus numerik.");
				$("#jumlah").focus();
				return false;					
			}
			var url = "<?php echo base_url();?>jenisproduksi/save"; // the script where you handle the form input.
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
				$("#id_jenis_produksi").val('');
				$("#jenis_produksi").val('');
				$("#satuan").val('');
				$("#jumlah").val('');
				$("#cancelupdate").hide();
				$("#addrow").html("Tambah Data");			
			});	
			return false;
		});
		
		$("#cancelupdate").click(function(){
			$("#id_jenis_produksi").val('');
			$("#jenis_produksi").val('');
			$("#satuan").val('');
			$("#jumlah").val('');
			$("#cancelupdate").hide();
			$("#addrow").html("Tambah Data");
		});
		
		$(".btndelete").live('click', function(){
			$("#divAlert").removeClass();
			$("#divAlert").html('');
			id = $(this).attr('id');
			conf = confirm("Hapus data jenis produksi ini?");
			if(conf){
				var url = "<?php echo base_url();?>jenisproduksi/hapus/"+id; // the script where you handle the form input.
				$.post(url, '', function(data){
				   oTable.fnDraw();
				   $("#id_jenis_produksi").val('');
				   $("#jenis_produksi").val('');
				   $("#satuan").val('');
				   $("#jumlah").val('');
				   $("#cancelupdate").hide();
				   $("#addrow").html("Tambah Data");
				});	
				return false;
			}
		});

	});	
    </script>