<?php include('header.php'); ?>

			<div>
				<ul class="breadcrumb">
					<li>
						<a href="<?php echo base_url();?>">Home</a> <span class="divider">/</span>
					</li>
					<li>
						<a href="<?php echo base_url();?>reportauditenergiadmin">Rekapitulasi Audit Energi</a>
					</li>
				</ul>
			</div>
			
			<div class="row-fluid sortable">		
				<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2><span class="icon icon-color icon-clipboard"></span>Rekapitulasi  Audit Energi (Filter)</h2>
					</div>
					<div class="box-content">
                    	<div id="divAlert"></div>
                        <form id="frmAdd" class="form-horizontal" action="" method="post">
                        <div class="row-fluid sortable">
                        	<div class="span6">
                            	<div class="box-content">
                                    <div class="control-group">
                                      <label class="control-label" for="start_date">Nama Perusahaan</label>
                                      <div class="controls">
                                        <input type="text" class="input-large" name="nama_perusahaan" id="nama_perusahaan" />
                                      </div>
                                    </div>
                                    <div class="control-group">
                                      <label class="control-label" for="tahun">Tahun</label>
                                      <div class="controls">
                                        <select id="tahun" name="tahun[]" multiple data-rel="chosen">
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
                                </div>
                            </div>
                            <div class="span6">
                            	<div class="box-content">
                                	<div class="control-group">
                                      <label class="control-label" for="tipe_perusahaan">Tipe Perusahaan</label>
                                      <div class="controls">
                                        <select id="tipe_perusahaan" name="tipe_perusahaan">
                                        	<option value="">- Pilih -</option>
                                            <option value="1">Industri</option>
                                            <option value="2">Gedung/Bangunan</option>
                                          </select>
                                      </div>
                                    </div>
                                    <div class="control-group">
                                      <label class="control-label" for="sub_sektor">Sub Sektor</label>
                                      <div class="controls">
                                        <select id="sub_sektor" name="sub_sektor"></select>
                                      </div>
                                    </div>
                                </div>
                            </div>
                        </div>  
                        <div class="form-actions">
                            <span class="btn btn-primary" id="submitfilter">Search</span>
                        </div>
                        </form> 
                    </div>
                </div>
            </div>
            
            <div class="row-fluid sortable">		
				<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2><span class="icon icon-color icon-clipboard"></span>Rekapitulasi  Audit Energi (Result)</h2>
					</div>
					<div class="box-content" id="dataplaceholder">
                    	<table class="table table-striped table-bordered bootstrap-datatable" id="datatable"></table>
                    </div>
                </div>
            </div>
    
<?php include('footer.php'); ?>

<script language="javascript">
	$(document).ready(function(){			
		$('#tipe_perusahaan').chainSelect('#sub_sektor','<?php echo base_url();?>reportauditenergiadmin/getcombosubsektor',
		{ 
			before:function (target) //before request hide the target combobox and display the loading message
			{ 
				$("#loading").css("display","block");
				$(target).css("display","none");
			},
			after:function (target) //after request show the target combobox and hide the loading message
			{ 
				$("#loading").css("display","none");
				$(target).css("display","inline");
			}
		});
		$("#submitfilter").live('click', function(){
			populateTable();
		});
	});
	
	function populateTable(){
		var aryColTableChecked = $("#tahun").val();
		var objTable = '<table class="table table-striped table-bordered bootstrap-datatable" id="datatable"><thead><th>No</th><th>Nama Perusahaan</th>';
		for (var i=0; i < aryColTableChecked.length; i++ ) {
		  objTable += '<th>' + aryColTableChecked[i] + '</th>';
		};
		objTable += '</thead></table>';	
		
		$('#datatable').remove();    
		$('#dataplaceholder').html(objTable);
		
		var oTable = $("#datatable").dataTable({
			"aaSorting":[[0,"asc"]],
			"bDestroy":true,
			"bFilter":false,
			"bProcessing": true,
			"bServerSide": true,
			"sAjaxSource": "<?php echo base_url();?>reportauditenergiadmin/get_list",
			"sServerMethod" : "POST",
			"fnServerParams": function(aoData){
				aoData.push({"name":"nama_perusahaan", "value":$("#nama_perusahaan").val()});
				aoData.push({"name":"tahun", "value":$("#tahun").val()});
				aoData.push({"name":"tipe_perusahaan", "value":$("#tipe_perusahaan").val()});
				aoData.push({"name":"sub_sektor", "value":$("#sub_sektor").val()});
			},
			"sDom": "T<'row-fluid'<'span6'l><'span6'f>r>t<'row-fluid'<'span12'i><'span12 center'p>>",
			"sPaginationType": "bootstrap",
			"iDisplayLength": 100,
			"oLanguage": {
				"sLengthMenu": "_MENU_ records per page"
			},
			"oTableTools": {
				"aButtons": [
				{
					"sExtends":"ajax",
					"fnClick": function(){
						var namaperusahaan = $("#nama_perusahaan").val();
						var tahun = $("#tahun").val();
						var tipeperusahaan =  $("#tipe_perusahaan").val();
						var subsektor =  $("#sub_sektor").val();
						var iframe = document.createElement('iframe');
						iframe.style.height = "0px";
						iframe.style.width = "0px";
						iframe.src = '<?php echo base_url();?>reportauditenergiadmin/exportexcel?nama_perusahaan='+namaperusahaan+'&tahun='+tahun+'&tipe_perusahaan='+tipeperusahaan+'&sub_sektor='+subsektor;
						document.body.appendChild( iframe );
					},
					"sButtonText": "Export To Excel"
				}
				]
			}
		});
		
		$('<div class="clearfix">&nbsp;</div>').insertAfter('div.DTTT');
	}
</script>