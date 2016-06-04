<?php include('header.php'); ?>
			<div>
				<ul class="breadcrumb">
					<li>
						<a href="<?php echo base_url();?>">Home</a> <span class="divider">/</span>
					</li>
					<li>
						<a href="#">Input FAQ</a></li>
				</ul>
			</div>
            
            <div class="row-fluid">
            	<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2>List FAQ</h2>
						<div class="box-icon">
                        	&nbsp;
						</div>
					</div>
					<div class="box-content">
                    	<table class="table table-striped table-bordered bootstrap-datatable" id="datatable1">
                          <thead>
                              <tr>
                                  <th align="center">Question</th>
                                  <th align="center">Answer</th>
                                  <th align="center">Create By</th>
                                  <th align="center">Create Date</th>
                                  <th align="center">Update By</th>
                                  <th align="center">Update Date</th>
                                  <th align="center">Action</th>
                              </tr>
                          </thead>  
                      </table>
                    </div>
                </div>
             </div>
            <div class="row-fluid">
            	<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2>Input FAQ</h2>
						<div class="box-icon">
                        	&nbsp;
						</div>
					</div>
					<div class="box-content">
                    	<div id="divAlert"></div>
                    	<form id="frmAdd" class="form-horizontal" action="" method="post">
                            <div class="control-group">
							  <label class="control-label" for="question">Question</label>
							  <div class="controls">
                              	<input type="text" class="input-xlarge" id="question" name="question" maxlength="500" />
                                <input type="hidden" id="faq_id" name="faq_id" />
						      </div>
						    </div>
                           <div class="control-group">
							  <label class="control-label" for="answer">Answer</label>
							  <div class="controls">
								<textarea class="autogrow" id="answer" name="answer"></textarea>
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
			"aaSorting":[[0,"desc"]],
			"bDestroy":true,
			"bFilter":true,
			"bPaginate":true,
			"bInfo":true,
			"bProcessing": true,
			"bServerSide": true,
			"sAjaxSource": "<?php echo base_url();?>inputfaq/get_list",
			"sServerMethod" : "POST",
			"sDom": "<'row-fluid'<'span6'l><'span6'f>r>t<'row-fluid'<'span12'i><'span12 center'p>>",
			"sPaginationType": "bootstrap",
			"oLanguage": {
				"sLengthMenu": "_MENU_ records per page"
			},
			"aoColumnDefs":[
				{
					"aTargets":[6],
					"fnRender": function(obj){
						return '<span class="btn btn-mini btn-primary btnedit" id="'+obj.aData[6]+'">Edit</span>&nbsp;<span class="btn btn-mini btn-warning btndelete" id="'+obj.aData[6]+'">Delete</span>&nbsp;';
					}
				}
			]
		});
		
		$(".btnedit").live('click', function(){
			var id = $(this).attr('id');
			var url = "<?php echo base_url();?>inputfaq/getDetail/"+id; // the script where you handle the form input.
			$.post(url, '', function(data){
				objResp = $.parseJSON(data);
				rowdata = objResp[0];
				if(rowdata){
					$("#faq_id").val(rowdata.faq_id);
					$("#question").val(rowdata.question);
					$("#answer").val(rowdata.answer);
					$("#cancelupdate").show();
					$("#addrow").html("Simpan Data");
				}else{
					$("#faq_id").val('');
					$("#question").val('');
					$("#answer").val('');
					$("#cancelupdate").hide();
					$("#addrow").html("Tambah Data");
				}
				$("#divAlert").removeClass();
				$("#divAlert").html('');
			});
			return false;
		});
		
		$("#addrow").click(function(){
			if($("#question").val() == ''){
				$("#divAlert").removeClass();
				$("#divAlert").addClass('alert alert-error');
				$("#divAlert").html("Question harus diisi.");
				$("#title").focus();
				return false;
			}
			if($("#answer").val() == ''){
				$("#divAlert").removeClass();
				$("#divAlert").addClass('alert alert-error');
				$("#divAlert").html("Answer harus diisi.");
				$("#publish_date").focus();
				return false;
			}
			var url = "<?php echo base_url();?>inputfaq/save"; // the script where you handle the form input.
			$.post(url, $("#frmAdd").serialize(), function(data){
				resp = $.parseJSON(data);
				if(resp.status == "success"){
					$("#divAlert").removeClass();
				   	$("#divAlert").addClass('alert alert-success');
				   	$("#divAlert").html(resp.msg);
					$("#question").val('');
					$("#answer").val('');
				}else{
					$("#divAlert").removeClass();
				   	$("#divAlert").addClass('alert alert-error');
				   	$("#divAlert").html(resp.msg);
				}
				oTable.fnDraw();
			});
		});
		
		$("#cancelupdate").click(function(){
			$("#faq_id").val('');
			$("#question").val('');
			$("#answer").val('');
			$("#cancelupdate").hide();
			$("#addrow").html("Tambah Data");
			$("#divAlert").removeClass();
			$("#divAlert").html('');
		});
		
		$(".btndelete").live('click', function(){
			id = $(this).attr('id');
			conf = confirm("Hapus berita ini?");
			if(conf){
				var url = "<?php echo base_url();?>inputfaq/hapus/"+id; // the script where you handle the form input.
				$.post(url, '', function(data){
				   oTable.fnDraw();
				    $("#faq_id").val('');
					$("#question").val('');
					$("#answer").val('');
					$("#cancelupdate").hide();
					$("#addrow").html("Tambah Data");
				});	
				$("#divAlert").removeClass();
				$("#divAlert").html('');
				return false;
			}
		});
	});	
    </script>