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
						<a href="#">Report Master Data Jenis Energi</a>
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
                                          <th>Satuan</th>
                                          <th>Actions</th>
                                      </tr>
                                  </thead>
                                  
                              </table>
                          
                    </div>
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
			"bFilter":true,
			"bPaginate":true,
			"bInfo":true,
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
					"aTargets":[1],
					"fnRender": function(obj){
						return obj.aData[1];
					}
				},
				{
					"aTargets":[2],
					"fnRender": function(obj){
						return '<span class="btn btn-mini btn-primary btnedit" id="'+obj.aData[2]+'">Edit</span>&nbsp;<span class="btn btn-mini btn-warning btndelete" id="'+obj.aData[2]+'">Delete</span>&nbsp;';
					}
				}
			]
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
					$("#id_jenis_energi").val(rowdata.IdJenisEnergi);
					$("#jenis_energi").val(rowdata.JenisEnergi);
					$("#satuan").val(rowdata.Satuan);
					$("#cancelupdate").show();
					$("#addrow").html("Simpan Data");
				}else{
					$("#id_jenis_energi").val('');
				    $("#jenis_energi").val('');
				    $("#satuan").val('');
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
				$("#id_jenis_energi").val('');
				$("#jenis_energi").val('');
				$("#satuan").val('');
				$("#cancelupdate").hide();
				$("#addrow").html("Tambah Data");			
			});	
			return false;
		});
		
		$("#cancelupdate").click(function(){
			$("#id_jenis_energi").val('');
			$("#jenis_energi").val('');
			$("#satuan").val('');
			$("#cancelupdate").hide();
			$("#addrow").html("Tambah Data");
		});
		
		$(".btndelete").live('click', function(){
			$("#divAlert").removeClass();
			$("#divAlert").html('');
			id = $(this).attr('id');
			conf = confirm("Hapus data jenis energi ini?");
			if(conf){
				var url = "<?php echo base_url();?>jenisenergi/hapus/"+id; // the script where you handle the form input.
				$.post(url, '', function(data){
				   oTable.fnDraw();
				   $("#id_jenis_energi").val('');
				   $("#jenis_energi").val('');
				   $("#satuan").val('');
				   $("#cancelupdate").hide();
				   $("#addrow").html("Tambah Data");
				});	
				return false;
			}
		});
		
		var tableTools = new $.fn.dataTable.TableTools( oTable, {
			"buttons": [{
		            "sExtends": "download",
		            "sButtonText": "Download CSV",
		            "sUrl": "/generate_csv.php"
		          }]
			
		} );
		
		$( tableTools.fnContainer() ).insertBefore('div.dataTables_wrapper');
		
		$('<div class="clearfix">&nbsp;</div>').insertAfter('div.DTTT');
		
		$("#submitfilter").live('click', function(){
			oTable.fnDraw();
		});

	});	
    </script>