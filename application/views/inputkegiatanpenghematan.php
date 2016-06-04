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
						<a href="#">Input Master Data Kegiatan</a>
                    </li>
				</ul>
			</div>
			
			<div class="row-fluid">	
                <div class="box span12">
					<div class="box-header well" data-original-title>
						<h2>List Jenis Kegiatan</h2>
					</div>
					<div class="box-content">
					        <table class="table table-striped table-bordered bootstrap-datatable" id="datatable1">
                                  <thead>
                                      <tr>
                                          <th>Jenis Kegiatan</th>                                          
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
						<h2>Input Jenis Kegiatan</h2>
					</div>
					<div class="box-content">
                    	<div id="divAlert"></div>
                    	<form id="frmAdd" class="form-horizontal" method="post">
                            <div class="control-group">
                                    <label class="control-label" for="jenis_kegiatan">Jenis Kegiatan </label>
                                    <div class="controls">
                                      <input class="input-xlarge focused" id="jenis_kegiatan" type="text" name="jenis_kegiatan">
                                       <input type="hidden" id="id_kegiatan" name="id_kegiatan" />
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
		
	$(document).ready(function(){
		
		oTable = $("#datatable1").dataTable({
			"aaSorting":[[2,"desc"]],
			"bDestroy":true,
			"bFilter":true,
			"bPaginate":true,
			"bInfo":true,
			"bProcessing": true,
			"bServerSide": true,
			"sAjaxSource": "<?php echo base_url();?>kegiatanpenghematan/listkegiatan",
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
						return '<span class="btn btn-mini btn-primary btnedit" id="'+obj.aData[1]+'">Edit</span>&nbsp;<span class="btn btn-mini btn-warning btndelete" id="'+obj.aData[1]+'">Delete</span>&nbsp;';
					}
				}
			]
		});
		$(".btnedit").live('click', function(){
			$("#divAlert").removeClass();
			$("#divAlert").html('');
			var id = $(this).attr('id');
			var url = "<?php echo base_url();?>kegiatanpenghematan/getDetail/"+id; // the script where you handle the form input.
			$.post(url, '', function(data){
				objResp = $.parseJSON(data);
				rowdata = objResp[0];
				if(rowdata){
					$("#id_kegiatan").val(rowdata.id_kegiatan);
					$("#jenis_kegiatan").val(rowdata.jenis_kegiatan);					
					$("#cancelupdate").show();
					$("#addrow").html("Simpan Data");
				}else{
					$("#id_kegiatan").val('');
				    $("#jenis_kegiatan").val('');
				    
				    $("#cancelupdate").hide();
					$("#addrow").html("Tambah Data");
				}
			});
			return false;
		});
		
		$("#addrow").click(function(){
			if($("#jenis_kegiatan").val() == ''){
				$("#divAlert").removeClass();
				$("#divAlert").addClass('alert alert-error');
				$("#divAlert").html("Jenis Kegiatan harus diisi.");
				$("#jenis_kegiatan").focus();
				return false;
			}
			
			var url = "<?php echo base_url();?>kegiatanpenghematan/save"; // the script where you handle the form input.
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
				$("#id_kegiatan").val('');
				$("#jenis_kegiatan").val('');
				
				$("#cancelupdate").hide();
				$("#addrow").html("Tambah Data");			
			});	
			return false;
		});
		
		$("#cancelupdate").click(function(){
			$("#id_kegiatan").val('');
			$("#jenis_kegiatan").val('');
			
			$("#cancelupdate").hide();
			$("#addrow").html("Tambah Data");
		});
		
		$(".btndelete").live('click', function(){
			$("#divAlert").removeClass();
			$("#divAlert").html('');
			id = $(this).attr('id');
			conf = confirm("Hapus data jenis kegiatan ini?");
			if(conf){
				var url = "<?php echo base_url();?>kegiatanpenghematan/hapus/"+id; // the script where you handle the form input.
				$.post(url, '', function(data){
				   oTable.fnDraw();
				   $("#id_kegiatan").val('');
				   $("#jenis_kegiatan").val('');
				   
				   $("#cancelupdate").hide();
				   $("#addrow").html("Tambah Data");
				});	
				return false;
			}
		});

	});	
    </script>