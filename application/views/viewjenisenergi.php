<?php include('header.php'); ?>
			<div>
				<ul class="breadcrumb">
					<li>
						<a href="#">Home</a> <span class="divider">/</span>
					</li>
					<li>
						<a href="#">Jenis Energi</a>
                    </li>
				</ul>
			</div>
			
            
			<div class="row-fluid">	
                <div class="box span12">
					<div class="box-header well" data-original-title>
						<h2>List Jenis Energi</h2>
						
					</div>
					<div class="box-content">
					        <table class="table table-striped table-bordered bootstrap-datatable" id="datatable1">
                                  <thead>
                                      <tr>
                                          <th>Jenis Energi</th>
                                          <th>Satuan</th>
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
                                    <label class="control-label" for="IdJnsEnergi">Jenis Energi</label>
                                    <div class="controls">
                                      <input class="input-xlarge focused" id="jenis_energi" type="text" name="jenis_energi">
                                       <input type="hidden" id="idjenisenergi" name="idjenisenergi" />
                                    </div>
                                  </div>
                                  
                          <div class="control-group">
                                    <label class="control-label" for="Idsatuan">Satuan</label>
                                    <div class="controls">
                                      <input class="input-xlarge focused" id="satuan" type="text" name="satuan">
                                     
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
		
		oTable = $("#datatable1").dataTable({
			
			"aaSorting":[[2,"asc"]],
			"bDestroy":true,
			"bFilter":false,
			"bPaginate":false,
			"bInfo":false,
			"bProcessing": true,
			"bServerSide": true,
			"sAjaxSource": "<?php echo base_url();?>jenisenergi/listjenisenergi",
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
						return '<span class="btn btn-mini btn-primary btnedit" id="'+obj.aData[2]+'">Edit</span>&nbsp;<span class="btn btn-mini btn-warning btndelete" id="'+obj.aData[2]+'">Delete</span>&nbsp;';
					}
				}
			]
		});
		
		$('#idjenisenergi').live('change', function(){
			var id = $("#idjenisenergi").find("option:selected").val();
			
		});
		
		$('#idjenisenergi').live('change', function(){
			if($("#idjenisenergi").find("option:selected").text() == 'Lain-Lain'){
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
			var url = "<?php echo base_url();?>jenisenergi/getDetail/"+id; // the script where you handle the form input.
			$.post(url, '', function(data){
				objResp = $.parseJSON(data);
				rowdata = objResp[0];
				if(rowdata){
					$("#idjenisenergi").val(rowdata.idjenisenergi);
					$("#jenis_energi").val(rowdata.jenisenergi);
					$("#satuan").val(rowdata.satuan);
					$("#cancelupdate").show();
					$("#addrow").html("Simpan Data");
				}else{
					$("#idjenisenergi").val('');
				   	$("#jenis_energi").val('');
				   	$("#satuan").val('');
				    	$("#cancelupdate").hide();
					$("#addrow").html("Tambah Data");
				}
			});
			return false;
		});
		
		$("#addrow").click(function(){
			var val=$('#frmAdd').validate({
				rules:{
					jenis_produksi:{required:true},
					jumlah:{required:true},
					satuan:{required:true}			
				}
			}).form();
			
			if(val){
				var url = "<?php echo base_url();?>jenisenergi/save"; // the script where you handle the form input.
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
					$("#idjenisenergi").val('');
				  	$("#jenis_energi").val('');
				   	$("#satuan").val('');
					$("#cancelupdate").hide();
					$("#addrow").html("Tambah Data");			
				});	
			}
			return false;
		});
		
		$("#cancelupdate").click(function(){
			$("#idjenisenergi").val('');
			$("#jenis_energi").val('');
			$("#satuan").val('');
			$("#jumlah").val('');
			$("#cancelupdate").hide();
			$("#addrow").html("Tambah Data");
		});
		
		$(".btndelete").live('click', function(){
			$("#divAlert").removeClass();
			$("#divAlert").html('');
			id = $(this).attr('id');
			conf = confirm("Hapus data jenis Energi ini?");
			if(conf){
				var url = "<?php echo base_url();?>jenisenergi/hapus/"+id; // the script where you handle the form input.
				$.post(url, '', function(data){
				   oTable.fnDraw();
				   $("#idjenisenergi").val('');
				   $("#jenis_energi").val('');
				   $("#satuan").val('');				  
				   $("#cancelupdate").hide();
				   $("#addrow").html("Tambah Data");
				});	
				return false;
			}
		});

	});	
    </script>