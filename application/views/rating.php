<?php include('header.php'); ?>
			<div>
				<ul class="breadcrumb">
					<li>
						<a href="#">Home</a> <span class="divider">/</span>
					</li>
					<li>
						<a href="#">Rating</a>
                    </li>
				</ul>
			</div>
			<div class="row-fluid">	
                <div class="box span12">
					<div class="box-header well" data-original-title>
						<h2>List Rating</h2>
					</div>
					<div class="box-content">
                    	<div class="row-fluid">
                        	<form id="frmFilter" name="frmFilter" method="post" action="" class="form-horizontal">
                            	<div class="control-group">
                                  <label class="control-label" for="tahun">Tahun</label>
                                  <div class="controls">
                                    <select id="filtertahun" name="filtertahun" >
                                        <?php
                                            for($i=date("Y")-4;$i<=date("Y");$i++){
                                        ?>
                                            <option value="<?php echo $i;?>"><?php echo $i;?></option>
                                        <?php
                                            }
                                        ?>
                                      </select>
                                  </div>
                                </div>
                                <div class="form-actions">
                                  <span class="btn btn-primary" id="submitfilter">Search</span>
                                </div>
                            </form>
                        </div>
                        <div class="row-fluid" style="overflow:scroll">
					        <table class="table table-striped table-bordered bootstrap-datatable" id="datatable1">
                                  <thead>
                                      <tr>
                                          <th rowspan="2">Tahun</th>
                                          <th rowspan="2">Tgl Lapor</th>
                                          <th rowspan="2">Nama Perusahaan</th>
                                          <th rowspan="2">Alamat</th>
                                          <th rowspan="2">Sub Sektor</th>
                                          <th rowspan="2">Jumlah Produksi (Ton)</th>
                                          <th rowspan="2">Pemakaian Energi (GJoule)</th>
                                          <th rowspan="2">Konsumsi Energi Spesifik (GJoule/Ton)</th>
                                          <th rowspan="2">Penghematan Energi (GJoule)</th>
                                          <th colspan="8">Manajemen Energi</th>
                                          <th rowspan="2">Rating</th>
                                          <th rowspan="2">Action</th>
                                      </tr>
                                      <tr>
                                        <th>Organisasi Manajemen Energi</th>
                                        <th>Manajer Energi</th>
                                        <th>Nama Manajer Energi</th>
                                        <th>Manajer Energi Bersertifikat</th>
                                        <th>No. Sertifikat Manajer Energi</th>
                                        <th>Program Konservasi Energi</th>
                                        <th>Melaksanakan Audit Energi</th>
                                        <th>Melaksanakan Rekomendasi Audit Energi</th>
                                      </tr>
                                  </thead>
                                  
                              </table>
                          </div>
                    </div>
                </div>
             </div>
            <div class="row-fluid">
            	<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2>Input Rating</h2>
					</div>
					<div class="box-content">
                    	<div id="divAlert"></div>
                    	<form id="frmAdd" class="form-horizontal" method="post">             
                                                                               	
                            	<div class="control-group">
                                    <label class="control-label" for="tahun_view">Tahun</label>
                                    <div class="controls">
                                      <input class="input-xlarge disabled" id="tahun_view" type="text" name="tahun_view" disabled>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label" for="nama_perusahaan">Nama Perusahaan</label>
                                    <div class="controls">
                                      <input class="input-xlarge disabled" id="nama_perusahaan" type="text" name="nama_perusahaan" disabled>
                                      <input type="hidden" id="id_perusahaan" name="id_perusahaan">
                                      <input type="hidden" id="tahun" name="tahun">
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label" for="rating">Rating</label>
                                    <div class="controls">
                                      <select id="rating" name="rating">
                                      	<option value="">-Pilih-</option>
                                        <option value="0">Merah</option>
                                        <option value="1">Kuning</option>
                                        <option value="2">Hijau</option>
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
<?php include('footer.php'); ?>

	<script type="text/javascript">
	var oTable;
		
	$(document).ready(function(){
		
		$("#cancelupdate").hide();
		$("#addrow").hide();
		
		$("#submitfilter").live('click', function(){
			populateTable();
			$("#tahun").val('');
			$("#tahun_view").val('');
			$("#id_perusahaan").val('');
			$("#nama_perusahaan").val('');
			$("#rating").val('');				
			$("#cancelupdate").hide();
			$("#addrow").hide();
		});
		
		function populateTable(){
			var tahun = $("#filtertahun").val();
			oTable = $("#datatable1").dataTable({
				"aaSorting":[[0,"desc"]],
				"bDestroy":true,
				"bFilter":true,
				"bPaginate":true,
				"bInfo":true,
				"bProcessing": true,
				"bServerSide": true,
				"sAjaxSource": "<?php echo base_url();?>rating/listrating/"+tahun,
				"sServerMethod" : "POST",
				"sDom": "T<'row-fluid'<'span6'l><'span6'f>r>t<'row-fluid'<'span12'i><'span12 center'p>>",
				"sPaginationType": "bootstrap",
				"oLanguage": {
					"sLengthMenu": "_MENU_ records per page"
				},
				"scrollX":true,
				"aoColumnDefs":[
					{
						"aTargets":[9],
						"fnRender": function(obj){
							if(obj.aData[9]==1){
								return '<span align="center">Ada</span>';
							}else{
								return '<span align="center">Tidak</span>';
							}
						}
					},
					{
						"aTargets":[10],
						"fnRender": function(obj){
							if(obj.aData[10]==1){
								return '<span align="center">Ada</span>';
							}else{
								return '<span align="center">Tidak</span>';
							}
						}
					},
					{
						"aTargets":[12],
						"fnRender": function(obj){
							if(obj.aData[12]==1){
								return '<span align="center">Ada</span>';
							}else{
								return '<span align="center">Tidak</span>';
							}
						}
					},
					{
						"aTargets":[14],
						"fnRender": function(obj){
							if(obj.aData[14]==1){
								return '<span align="center">Ada</span>';
							}else{
								return '<span align="center">Tidak</span>';
							}
						}
					},
					{
						"aTargets":[15],
						"fnRender": function(obj){
							if(obj.aData[15]==1){
								return '<span align="center">Ada</span>';
							}else{
								return '<span align="center">Tidak</span>';
							}
						}
					},
					{
						"aTargets":[16],
						"fnRender": function(obj){
							if(obj.aData[16]==1){
								return '<span align="center">Ada</span>';
							}else{
								return '<span align="center">Tidak</span>';
							}
						}
					},
					{
						"aTargets":[17],
						"fnRender": function(obj){
							if(obj.aData[17]==0){
								return 'Merah';
							}else if(obj.aData[17]==1){
								return 'Kuning';
							}else if(obj.aData[17]==2){
								return 'Hijau';
							}
						}
					},
					{
						"aTargets":[18],
						"fnRender": function(obj){
							return '<span class="btn btn-mini btn-primary btnedit" id="'+obj.aData[0]+'|'+obj.aData[18]+'">Edit</span>&nbsp;';
						}
					}
				],
				"fnRowCallback": function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
					if ( aData[17] == "Merah" )
					{
						$('td', nRow).css('background-color', '#eddbe3');
					}
					else if ( aData[17] == "Kuning" )
					{
						$('td', nRow).css('background-color', '#FFFF66');
					}
					else if ( aData[17] == "Hijau" )
					{
						$('td', nRow).css('background-color', '#ccddbb');
					}
				},
				"oTableTools": {
					"aButtons": [
					{
						"sExtends":"ajax",
						"fnClick": function(){
							var iframe = document.createElement('iframe');
							iframe.style.height = "0px";
							iframe.style.width = "0px";
							iframe.src = '<?php echo base_url();?>rating/exportexcel/'+tahun;
							document.body.appendChild( iframe );
						},
						"sButtonText": "Export To Excel"
					}
					]
				}
			});
			$('<div class="clearfix">&nbsp;</div>').insertAfter('div.DTTT');
		}
		
		$(".btnedit").live('click', function(){
			$("#divAlert").removeClass();
			$("#divAlert").html('');
			var strId = $(this).attr('id');
			var arrId = strId.split('|');
			var tahun = arrId[0];
			var idPerusahaan = arrId[1];
			var url = "<?php echo base_url();?>rating/getDetail/"+idPerusahaan+"/"+tahun; // the script where you handle the form input.
			$.post(url, '', function(data){
				objResp = $.parseJSON(data);
				rowdata = objResp[0];
				if(rowdata){
					$("#tahun").val(rowdata.tahun);
					$("#tahun_view").val(rowdata.tahun);
					$("#id_perusahaan").val(rowdata.IdPerusahaan);
					$("#nama_perusahaan").val(rowdata.NamaPerusahaan);
					$("#rating").val(rowdata.rating);
					$("#cancelupdate").show();
					$("#addrow").html("Simpan Data");
					$("#addrow").show();
				}else{
					$("#tahun").val(rowdata.tahun);
					$("#tahun_view").val(rowdata.tahun);
					$("#id_perusahaan").val(rowdata.IdPerusahaan);
					$("#nama_perusahaan").val(rowdata.NamaPerusahaan);
					$("#rating").val(rowdata.rating);
					$("#cancelupdate").hide();
					$("#addrow").hide();
				}
			});
			return false;
		});
		
		$("#addrow").click(function(){
			if($("#rating").val() == ''){
				$("#divAlert").removeClass();
				$("#divAlert").addClass('alert alert-error');
				$("#divAlert").html("Rating harus diisi.");
				$("#subsektor").focus();
				return false;
			}
			
			var url = "<?php echo base_url();?>rating/save"; // the script where you handle the form input.
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
				$("#tahun").val('');
				$("#tahun_view").val('');
				$("#id_perusahaan").val('');
				$("#nama_perusahaan").val('');
				$("#rating").val('');			
				$("#cancelupdate").hide();
				$("#addrow").hide();			
			});	
			return false;
		});
		
		$("#cancelupdate").click(function(){
			$("#tahun").val('');
			$("#tahun_view").val('');
			$("#id_perusahaan").val('');
			$("#nama_perusahaan").val('');
			$("#rating").val('');				
			$("#cancelupdate").hide();
			$("#addrow").hide();
		});

	});	
    </script>