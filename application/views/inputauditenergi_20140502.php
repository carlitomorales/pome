<?php include('header.php'); ?>
			<div>
				<ul class="breadcrumb">
					<li>
						<a href="#">Home</a> <span class="divider">/</span>
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
								 echo "8";
								 break;
								 case 2:
								 echo "8";
								 break;
								 } ?></i>
                             <h5>Audit Energi Pada Peralatan Pemanfaat Energi Utama</h5>
                             <span><?php $type=$this->session->userdata('type_perusahaan');
							 switch ($type){
								 case 1:
								 echo "8 dari 8";
								 break;
								 case 2:
								 echo "8 dari 8";
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
						<h2>List Audit Energi Pada Peralatan Pemanfaat Energi Utama</h2>
						<div class="box-icon">
						</div>
					</div>
					<div class="box-content">
                    	<table class="table table-striped table-bordered bootstrap-datatable" id="datatable1">
                              <thead>
                                  <tr>
                                      <th>Jenis Peralatan</th>
                                      <th>Status</th>
                                      <th>Keterangan</th>
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
						<h2>Input Audit Energi Pada Peralatan Pemanfaat Energi Utama</h2>
						<div class="box-icon">
						</div>
					</div>
					<div class="box-content">
                    	<form id="frmAdd" class="form-horizontal" action="" method="post">
                            <div class="control-group">
							  <label class="control-label" for="id_jenis_peralatan">Jenis Peralatan Pemanfaat Energi Utama</label>
							  <div class="controls">
                              	<span class="input-large uneditable-input" id="nama_jenis_peralatan"></span>
							    <input type="hidden" name="id_jenis_peralatan" id="id_jenis_peralatan" />
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
								?>]' disabled>
						      </div>
						    </div>
                                  <div class="control-group">
                                    <label class="control-label" for="status_audit">Status</label>
                                    <div class="controls">
                                      <select name="status_audit" id="status_audit">
                                      	<option value="">-- Pilih --</option>
                                        <option value="1">Sudah</option>
                                        <option value="0">Belum</option>
                                      </select>
                                    </div>
                                  </div>
                                  <div class="control-group">
                                    <label class="control-label" for="keterangan_audit">Keterangan (Nama dan Nomor Sertifikat Auditor Energi, Waktu Pelaksanaan, dll)</label>
                                    <div class="controls">
                                      <textarea class="autogrow" id="keterangan_audit" name="keterangan_audit"></textarea>
                                    </div>
                                </div>
                                
                           <div class="form-actions">
                           		<span class="btn btn-primary" id="addrow" style="display:none">Simpan Data</span>
                                <span class="btn btn-primary" id="cancelupdate" style="display:none">Batalkan</span>
						   </div>
                         </form>
                    </div>
                </div>
            </div>
             <div class="row-fluid">
                <div class="box span12">
                	<div class="box-content">
                    	<span class="btn btn-primary" onClick="document.location='<?php echo base_url();?>rencanakonservasi'">Previous</span>
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
			"sAjaxSource": "<?php echo base_url();?>auditenergi/get_list",
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
					 	if(obj.aData[2]==1){
							return "Sudah";
						}else{
							return "Belum";
						}
					}
				},
				{
					"aTargets":[2],
					"fnRender": function(obj){
					 	return obj.aData[3];
					}
				},
				{
					"aTargets":[3],
					"fnRender": function(obj){
						return '<span class="btn btn-mini btn-primary btnedit" id="'+obj.aData[4]+'">Edit</span>';
					}
				}
			]
		});
		
		$(".btnedit").live('click', function(){
			var id = $(this).attr('id');
			var url = "<?php echo base_url();?>auditenergi/getDetail/"+id; // the script where you handle the form input.
			$.post(url, '', function(data){
				objResp = $.parseJSON(data);
				rowdata = objResp[0];
				if(rowdata){
					$("#id_peralatan_pemanfaat_energi").val(rowdata.id_peralatan_pemanfaat_energi);
					$("#id_jenis_peralatan").val(rowdata.id_jenis_peralatan);
					$("#nama_jenis_peralatan").html(rowdata.JenisPeralatan);
					$("#jenis_peralatan_lain").val(rowdata.jenis_peralatan_lain);
					$("#status_audit").val(rowdata.status_audit);
					$("#keterangan_audit").val(rowdata.keterangan_audit);
					$("#cancelupdate").show();
					$("#addrow").show();
					if(rowdata.jenis_peralatan_lain != ''){
						$("#jenisperalatanlain").show();
					}else{
						$("#jenisperalatanlain").hide();
					}
				}else{
					$("#id_peralatan_pemanfaat_energi").val('');
				    $("#id_jenis_peralatan").val('');
					$("#nama_jenis_peralatan").html('');
				    $("#jenis_peralatan_lain").val('');
				    $("#status_audit").val('');
				    $("#keterangan_audit").val('');
					$("#cancelupdate").hide();
					$("#addrow").hide();
					$("#jenisperalatanlain").hide();
				}
			});
			return false;
		});
		
		$("#addrow").click(function(){
			var url = "<?php echo base_url();?>auditenergi/save"; // the script where you handle the form input.
			$.post(url, $("#frmAdd").serialize(), function(data){
			   oTable.fnDraw();
			   $("#id_peralatan_pemanfaat_energi").val('');
			   $("#id_jenis_peralatan").val('');
			   $("#nama_jenis_peralatan").html('');
			   $("#jenis_peralatan_lain").val('');
			   $("#status_audit").val('');
			   $("#keterangan_audit").val('');
				$("#cancelupdate").hide();
				$("#addrow").hide();
				$("#jenisperalatanlain").hide();
			});	
			return false;
		});
		
		$("#cancelupdate").click(function(){
			$("#id_peralatan_pemanfaat_energi").val('');
		    $("#id_jenis_peralatan").val('');
			$("#nama_jenis_peralatan").html('');
		    $("#jenis_peralatan_lain").val('');
		    $("#status_audit").val('');
		    $("#keterangan_audit").val('');
			$("#cancelupdate").hide();
			$("#addrow").hide();
			$("#jenisperalatanlain").hide();
		});
		
	});	
    </script>