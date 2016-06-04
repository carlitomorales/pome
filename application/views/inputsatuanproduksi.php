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
						<a href="#">Input Master Data Satuan Produksi</a>
                    </li>
				</ul>
			</div>
			
			<div class="row-fluid">	
                <div class="box span12">
					<div class="box-header well" data-original-title>
						<h2>List Satuan Produksi</h2>
					</div>
					<div class="box-content">
					        <table class="table table-striped table-bordered bootstrap-datatable" id="datatable1">
                                  <thead>
                                      <tr>
                                          <th>Satuan Produksi</th>
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
						<h2>Input Satuan Produksi</h2>
					</div>
					<div class="box-content">
                    	<div id="divAlert"></div>
                    	<form id="frmAdd" class="form-horizontal" method="post">
                        
                                                                               	
                            <div class="control-group">
                                    <label class="control-label" for="satuan_produksi">Satuan Produksi</label>
                                    <div class="controls">
                                      <input class="input-xlarge focused" id="satuan_produksi" type="text" name="satuan_produksi">
                                       <input type="hidden" id="id_satuan_produksi" name="id_satuan_produksi" />
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
			"aaSorting":[[2,"desc"]],
			"bDestroy":true,
			"bFilter":true,
			"bPaginate":true,
			"bInfo":true,
			"bProcessing": true,
			"bServerSide": true,
			"sAjaxSource": "<?php echo base_url();?>satuanproduksi/listsatuanproduksi",
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
						return '<span class="btn btn-mini btn-warning btndelete" id="'+obj.aData[1]+'">Delete</span>&nbsp;';
					}
				}
			]
		});
		
		$(".btnedit").live('click', function(){
			$("#divAlert").removeClass();
			$("#divAlert").html('');
			var id = $(this).attr('id');
			var url = "<?php echo base_url();?>satuanproduksi/getDetail/"+id; // the script where you handle the form input.
			$.post(url, '', function(data){
				objResp = $.parseJSON(data);
				rowdata = objResp[0];
				if(rowdata){
					$("#id_satuan_produksi").val(rowdata.id_satuan_produksi);
					$("#satuan_produksi").val(rowdata.nama_satuan_produksi);
					$("#cancelupdate").show();
					$("#addrow").html("Simpan Data");
				}else{
					$("#id_satuan_produksi").val(rowdata.id_satuan_produksi);
					$("#satuan_produksi").val(rowdata.nama_satuan_produksi);
					$("#cancelupdate").hide();
					$("#addrow").html("Tambah Data");
				}
			});
			return false;
		});
		
		$("#addrow").click(function(){
			if($("#subsektor").val() == ''){
				$("#divAlert").removeClass();
				$("#divAlert").addClass('alert alert-error');
				$("#divAlert").html("Satuan Produksi harus diisi.");
				$("#subsektor").focus();
				return false;
			}
			
			var url = "<?php echo base_url();?>satuanproduksi/save"; // the script where you handle the form input.
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
				$("#satuan_produksi").val('');
				$("#id_satuan_produksi").val('');				
				$("#cancelupdate").hide();
				$("#addrow").html("Tambah Data");			
			});	
			return false;
		});
		
		$("#cancelupdate").click(function(){
			$("#satuan_produksi").val('');
			$("#id_satuan_produksi").val('');				
			$("#cancelupdate").hide();
			$("#addrow").html("Tambah Data");
		});
		
		$(".btndelete").live('click', function(){
			$("#divAlert").removeClass();
			$("#divAlert").html('');
			id = $(this).attr('id');
			conf = confirm("Hapus data subsektor ini?");
			if(conf){
				var url = "<?php echo base_url();?>satuanproduksi/hapus/"+id; // the script where you handle the form input.
				$.post(url, '', function(data){
				   oTable.fnDraw();
				   $("#satuan_produksi").val('');
					$("#id_satuan_produksi").val('');				
					$("#cancelupdate").hide();
				   $("#addrow").html("Tambah Data");
				});	
				return false;
			}
		});

	});	
    </script>