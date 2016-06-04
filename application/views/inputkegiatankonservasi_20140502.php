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
                    	<form id="frmAdd" class="form-horizontal" action="" method="post">
                            <div class="control-group">
							  <label class="control-label" for="kegiatan">Kegiatan</label>
							  <div class="controls">
                              	<input type="text" class="input-large" id="kegiatan" name="kegiatan" />
                                <input type="hidden" id="id_kegiatan_konservasi" name="id_kegiatan_konservasi" />
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
									<input id="target_emisi" name="target_emisi" class="input-small" type="text"><span class="add-on">tCO<sub>2</sub></span>
							  </div>
                              <div class="input-append">
									<input id="target_emisi_persen" name="target_emisi_persen" class="input-small" type="text"><span class="add-on">%</span>
							  </div>
                            </div>
                          </div>
                           <div class="control-group">
                            <label class="control-label" for="realisasi_emisi">Realisasi Emisi</label>
                            <div class="controls">
                              <div class="input-append">
									<input id="realisasi_emisi" name="realisasi_emisi" class="input-small" type="text"><span class="add-on">tCO<sub>2</sub></span>
							  </div>
                              <div class="input-append">
									<input id="realisasi_emisi_persen" name="realisasi_emisi_persen" class="input-small" type="text"><span class="add-on">%</span>
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
					"aTargets":[10],
					"fnRender": function(obj){
						return '<nobr><span class="btn btn-mini btn-primary btnedit" id="'+obj.aData[10]+'">Edit</span>&nbsp;<span class="btn btn-mini btn-warning btndelete" id="'+obj.aData[10]+'">Delete</span>&nbsp;</nobr>';
					}
				},
				{
					"aTargets":[1],
					"fnRender": function(obj){
						return '<div align="right">'+obj.aData[1]+'</div>';
					}
				},
				{
					"aTargets":[2],
					"fnRender": function(obj){
						return '<div align="right">'+obj.aData[2]+'</div>';
					}
				},
				{
					"aTargets":[3],
					"fnRender": function(obj){
						return '<div align="right">'+obj.aData[3]+'</div>';
					}
				},
				{
					"aTargets":[4],
					"fnRender": function(obj){
						return '<div align="right">'+obj.aData[4]+'</div>';
					}
				},
				{
					"aTargets":[5],
					"fnRender": function(obj){
						return '<div align="right">'+obj.aData[5]+'</div>';
					}
				},
				{
					"aTargets":[6],
					"fnRender": function(obj){
						return '<div align="right">'+obj.aData[6]+'</div>';
					}
				},
				{
					"aTargets":[7],
					"fnRender": function(obj){
						return '<div align="right">'+obj.aData[7]+'</div>';
					}
				},
				{
					"aTargets":[8],
					"fnRender": function(obj){
						return '<div align="right">'+obj.aData[8]+'</div>';
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
					$("#id_kegiatan_konservasi").val(rowdata.id_kegiatan_konservasi);
					$("#kegiatan").val(rowdata.kegiatan);
					$("#target_gjoule").val(rowdata.target_gjoule);
					$("#target_persen").val(rowdata.target_persen);
					$("#realisasi_gjoule").val(rowdata.realisasi_gjoule);
					$("#realisasi_persen").val(rowdata.realisasi_persen);
					$("#target_emisi").val(rowdata.target_emisi);
					$("#target_emisi_persen").val(rowdata.target_emisi_persen);
					$("#realisasi_emisi").val(rowdata.realisasi_emisi);
					$("#realisasi_emisi_persen").val(rowdata.realisasi_emisi_persen);
					$("#keterangan").val(rowdata.keterangan);
					$("#cancelupdate").show();
					$("#addrow").html("Simpan Data");
				}else{
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
				}
			});
			return false;
		});
		
		$("#addrow").click(function(){
			var url = "<?php echo base_url();?>kegiatankonservasi/save"; // the script where you handle the form input.
			$.post(url, $("#frmAdd").serialize(), function(data){
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
			return false;
		});
		
		$("#cancelupdate").click(function(){
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
		
		$(".btndelete").live('click', function(){
			id = $(this).attr('id');
			conf = confirm("Hapus data kegiatan konservasi energi ini?");
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
				return false;
			}
		});
	});	
    </script>