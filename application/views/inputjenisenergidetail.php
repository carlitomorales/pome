<?php include('header.php'); ?>
			<div>
				<ul class="breadcrumb">
					<li>
						<a href="#">Home</a> <span class="divider">/</span>
					</li>
					<li>
						<a href="#">Master Data</a> <span class="divider">/</span>
                    </li>
                    <li>
						<a href="<?php echo base_url();?>jenisenergi">Input Master Data Jenis Energi</a>
                    </li>
				</ul>
			</div>
			
			<div class="row-fluid">	
                <div class="box span12">
					<div class="box-header well" data-original-title>
						<h2>List Jenis energi</h2>
					</div>
					<div class="box-content">
					        <table class="table table-striped table-bordered bootstrap-datatable" id="datatable1">
                                  <thead>
                                      <tr>
                                          <th>Jenis Energi</th>
                                          <th>Detail Jenis Energi</th>
										  <th>Faktor Emisi</th>
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
						<h2>Input Jenis Energi</h2>
					</div>
					<div class="box-content">
                    	<div id="divAlert"></div>
                    	<form id="frmAdd" class="form-horizontal" method="post">                                                                                                  	
                            <div class="control-group">
                                    <label class="control-label" for="jenis_energi">Detail Jenis Energi</label>
                                    <div class="controls">
                                      <input class="input-xlarge focused" id="detail_jenis_energi" type="text" name="detail_jenis_energi">
									  <input type="hidden" class="input-xlarge focused" id="id_jenis_energi_detail" type="text" name="id_jenis_energi_detail">
									  <input type="hidden" class="input-xlarge focused" id="id_jenis_energi" type="text" name="id_jenis_energi">
                                    </div>
                            </div>
                             <div class="control-group">
                                    <label class="control-label" for="faktor_emisi">Faktor Emisi</label>
                                    <div class="controls">
                                      <input class="input-xlarge focused" id="faktor_emisi" type="text" name="faktor_emisi">
                                       
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
                
                </div>
              </div>
<?php include('footer.php'); ?>

	<script type="text/javascript">
	var oTable;
	$("#id_jenis_energi").val('<?php echo $this->data['id_jenisenergi']?>');	
	$(document).ready(function(){
		
		oTable = $("#datatable1").dataTable({
			"aaSorting":[[0,"asc"]],
			"bDestroy":true,
			"bFilter":true,
			"bPaginate":true,
			"bInfo":true,
			"bProcessing": true,
			"bServerSide": true,
			"sAjaxSource": "<?php echo base_url();?>jenisenergi/listdetailjenisenergi?id=<?php echo $this->data['id_jenisenergi']?>",
			"sServerMethod" : "POST",
			"sDom": "<'row-fluid'<'span6'l><'span6'f>r>t<'row-fluid'<'span12'i><'span12 center'p>>",
			"sPaginationType": "bootstrap",
			"oLanguage": {
				"sLengthMenu": "_MENU_ records per page"
			},
			"aoColumnDefs":[
				
				{
					"aTargets":[3],
					"fnRender": function(obj){
						return ' <span class="btn btn-mini btn-primary btnedit" id="'+obj.aData[3]+'">Edit</span>&nbsp;<span class="btn btn-mini btn-warning btndelete" id="'+obj.aData[3]+'">Delete</span>&nbsp;';
					}
				}
			]
		});
		
		$(".btnedit").live('click', function(){
			$("#divAlert").removeClass();
			$("#divAlert").html('');
			var id = $(this).attr('id');
			var url = "<?php echo base_url();?>jenisenergi/getDetailenergi/"+id; // the script where you handle the form input.
			$.post(url, '', function(data){
				objResp = $.parseJSON(data);
				rowdata = objResp[0];
				if(rowdata){
					$("#id_jenis_energi_detail").val(rowdata.id_jenis_energi_detail);
					$("#detail_jenis_energi").val(rowdata.detail_jenis_energi);
					$("#faktor_emisi").val(rowdata.faktor_emisi);
					$("#cancelupdate").show();
					$("#addrow").html("Simpan Data");
				}else{
					$("#id_jenis_energi_detail").val('');
				    $("#detail_jenis_energi").val('');
				    $("#faktor_emisi").val('');
				    $("#cancelupdate").hide();
					$("#addrow").html("Tambah Data");
				}
			});
			return false;
		});
		
		$("#addrow").click(function(){
			if($("#jenis_energi").val() == ''){
				$("#divAlert").removeClass();
				$("#divAlert").addClass('alert alert-error');
				$("#divAlert").html("Jenis Energi harus diisi.");
				$("#jenis_energi").focus();
				return false;
			}
			if($("#satuann").val() == ''){
				$("#divAlert").removeClass();
				$("#divAlert").addClass('alert alert-error');
				$("#divAlert").html("satuan harus diisi.");
				$("#satuan").focus();
				return false;
			}
			var url = "<?php echo base_url();?>jenisenergi/savedetail"; // the script where you handle the form input.
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
				$("#id_jenis_energi_detail").val('');
				$("#detail_jenis_energi").val('');
				$("#faktor_emisi").val('');
				$("#cancelupdate").hide();
				$("#addrow").html("Tambah Data");			
			});	
			return false;
		});
		
		$("#cancelupdate").click(function(){
			$("#id_jenis_energi_detail").val('');
			$("#detail_jenis_energi").val('');
			$("#faktor_emisi").val('');
			$("#cancelupdate").hide();
			$("#addrow").html("Tambah Data");
		});
		
		$(".btndelete").live('click', function(){
			$("#divAlert").removeClass();
			$("#divAlert").html('');
			id = $(this).attr('id');
			conf = confirm("Hapus data jenis energi ini?");
			if(conf){
				var url = "<?php echo base_url();?>jenisenergi/hapusdetail/"+id; // the script where you handle the form input.
				$.post(url, '', function(data){
				   oTable.fnDraw();
				   $("#id_jenis_energi_detail").val('');
					$("#faktor_emisi").val('');
					$("#detail_jenis_energi").val('');
				   $("#cancelupdate").hide();
				   $("#addrow").html("Tambah Data");
				});	
				return false;
			}
		});

	});	
    </script>