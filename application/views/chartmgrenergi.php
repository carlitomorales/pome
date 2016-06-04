<?php include('header.php'); ?>

			<div>
				<ul class="breadcrumb">
					<li>
						<a href="<?php echo base_url();?>">Home</a> <span class="divider">/</span>
					</li>
					<li>
						<a href="<?php echo base_url();?>chartmgrenergi">Perusahaan Yang Sudah Memiliki Manager Energi</a>
					</li>
				</ul>
			</div>
			
			<div class="row-fluid sortable">		
				<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2><span class="icon icon-color icon-clipboard"></span>Perusahaan Yang Sudah Memiliki Manager Energi (Filter)</h2>
					</div>
					<div class="box-content">
                    	<div id="divAlert"></div>
                        <form id="frmAdd" class="form-horizontal" action="" method="post">
                        <div class="row-fluid sortable">
                        	<div class="span6">
                            	<div class="box-content">
                                    
                                    <div class="control-group">
                                      <label class="control-label" for="tahun">Tahun</label>
                                      <div class="controls">
                                      
                                        <select id="tahun" name="tahun[]" multiple data-rel="chosen">
                                            <?php
												for($i=date("Y")-5;$i<=date("Y")+5;$i++){
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
                                        	<option value="">- Semua -</option>
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
						<h2><span class="icon icon-color icon-image"></span> Chart Perusahaan Yang Sudah Memiliki Manager Energi</h2>
					</div>
					<div class="box-content" align="center">
                        <div id="chartstackdiv" style="width:100%; height:400px;"></div>
                    </div>
                </div>
            </div>
             
    
<?php include('footer.php'); ?>

<script language="javascript">
	$(document).ready(function(){	
	oTable = $("#datatable").dataTable({
			"aaSorting":[[0,"desc"]],
			"bDestroy":true,
			"bFilter":false,
			"bProcessing": true,
			"bServerSide": true,
			"sAjaxSource": "<?php echo base_url();?>reportmgrenergi/get_list",
			"sServerMethod" : "POST",
			"fnServerParams": function(aoData){
				aoData.push({"name":"nama_perusahaan", "value":$("#nama_perusahaan").val()});
				aoData.push({"name":"tahun", "value":$("#tahun").val()});
				aoData.push({"name":"tipe_perusahaan", "value":$("#tipe_perusahaan").val()});
				aoData.push({"name":"sub_sektor", "value":$("#sub_sektor").val()});
			},
			"fnRowCallback": function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
			       var index = iDisplayIndex +1;
			       $('td:eq(0)',nRow).html(index);
			       return nRow;
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
							iframe.src = '<?php echo base_url();?>reportmgrenergi/exportexcel?nama_perusahaan='+namaperusahaan+'&tahun='+tahun+'&tipe_perusahaan='+tipeperusahaan+'&sub_sektor='+subsektor;
							document.body.appendChild( iframe );
						},
						"sButtonText": "Export To Excel"
					}
				]
			}
		});
	
		
		$('<div class="clearfix">&nbsp;</div>').insertAfter('div.DTTT');
				
		$('#tipe_perusahaan').chainSelect('#sub_sektor','<?php echo base_url();?>reportsudahlapor/getcombosubsektor',
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
			//oTable.fnDraw();
			generateChartStack();
			//populateTable();
			
		});
	});
	
	function populateTable(){
		$('#datatable').remove();    
		$('#dataplaceholder').html('<table class="table table-striped table-bordered bootstrap-datatable" id="datatable"></table>');
		var aryColTableChecked = $("#tahun").val();
		var aryJSONColTable = [];
		var j = 0;
		aryJSONColTable.push({"sTitle": "No", "mDataProp":j});
		aryJSONColTable.push({"sTitle": "Nama Perusahaan", "mDataProp":j});
		aryJSONColTable.push({"sTitle": "Nama Manager Energi", "mDataProp":j+1});
		aryJSONColTable.push({"sTitle": "No Telp", "mDataProp":j+2});
		aryJSONColTable.push({"sTitle": "Email", "mDataProp":j+3});
		j++;
		for (var i=0; i < aryColTableChecked.length; i++ ) {
		  aryJSONColTable.push({"sTitle": aryColTableChecked[i], "mDataProp":j+3});
		  j++;
		};
		
		console.log(aryJSONColTable);
		  
		var oTable = $("#datatable").dataTable({
			"aaSorting":[[0,"asc"]],
			"bDestroy":true,
			"bFilter":false,
			"bProcessing": true,
			"bServerSide": true,
			"sAjaxSource": "<?php echo base_url();?>reportmgrenergi/get_list",
			"sServerMethod" : "POST",
			"fnServerParams": function(aoData){
				aoData.push({"name":"nama_perusahaan", "value":$("#nama_perusahaan").val()});
				aoData.push({"name":"tahun", "value":$("#tahun").val()});
				aoData.push({"name":"tipe_perusahaan", "value":$("#tipe_perusahaan").val()});
				aoData.push({"name":"sub_sektor", "value":$("#sub_sektor").val()});
			},
			"fnRowCallback": function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
			       var index = iDisplayIndex +1;
			       $('td:eq(0)',nRow).html(index);
			       return nRow;
			},
			"sDom": "T<'row-fluid'<'span6'l><'span6'f>r>t<'row-fluid'<'span12'i><'span12 center'p>>",
			"sPaginationType": "bootstrap",
			"iDisplayLength": 100,
			"oLanguage": {
				"sLengthMenu": "_MENU_ records per page"
			},
			"aoColumns": aryJSONColTable,
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
						iframe.src = '<?php echo base_url();?>reportmgrenergi/exportexcel?nama_perusahaan='+namaperusahaan+'&tahun='+tahun+'&tipe_perusahaan='+tipeperusahaan+'&sub_sektor='+subsektor;
						document.body.appendChild( iframe );
					},
					"sButtonText": "Export To Excel"
				}
				]
			}
		});
		
		$('<div class="clearfix">&nbsp;</div>').insertAfter('div.DTTT');
	}
	
	var legendstack;
	var chartstack;
	var graph;
	
	AmCharts.loadJSON = function(url) {
	  // create the request
	  if (window.XMLHttpRequest) {
		// IE7+, Firefox, Chrome, Opera, Safari
		var request = new XMLHttpRequest();
	  } else {
		// code for IE6, IE5
		var request = new ActiveXObject('Microsoft.XMLHTTP');
	  }
	
	  // load it
	  // the last "false" parameter ensures that our code will wait before the
	  // data is loaded
	  request.open('GET', url, false);
	  request.send();
	
	  // parse adn return the output
	  return eval(request.responseText);
	};
	
	AmCharts.ready(function(){		
		// SERIAL CHART
		chartstack = new AmCharts.AmSerialChart();
		chartstack.dataProvider = [];
		chartstack.categoryField = "tahun";
		chartstack.plotAreaBorderAlpha = 0.2;

		// AXES
		// category
		var categoryAxis = chartstack.categoryAxis;
		categoryAxis.gridAlpha = 0.1;
		categoryAxis.axisAlpha = 0;
		categoryAxis.gridPosition = "start";

		// value
		var valueAxis = new AmCharts.ValueAxis();
		valueAxis.stackType = "regular";
		valueAxis.gridAlpha = 0.1;
		valueAxis.axisAlpha = 0;
		chartstack.addValueAxis(valueAxis);
		
		graph = new AmCharts.AmGraph();
		graph.title = "Sudah Memiliki Manajer Energi";
		graph.labelText = "[[value]]";
		graph.valueField = "Sudah";
		graph.type = "column";
		graph.lineAlpha = 0;
		graph.fillAlphas = 1;
		graph.balloonText = "<span style='color:#555555;'>[[category]]</span><br><span style='font-size:14px'>[[title]]:<b>[[value]]</b></span>";
		chartstack.addGraph(graph);
		
		graph = new AmCharts.AmGraph();
		graph.title = "Belum Memiliki Manajer Energi";
		graph.labelText = "[[value]]";
		graph.valueField = "Belum";
		graph.type = "column";
		graph.lineAlpha = 0;
		graph.fillAlphas = 1;
		graph.balloonText = "<span style='color:#555555;'>[[category]]</span><br><span style='font-size:14px'>[[title]]:<b>[[value]]</b></span>";
		chartstack.addGraph(graph);
		
		var legendstack = new AmCharts.AmLegend();
		legendstack.borderAlpha = 0.2;
		legendstack.horizontalGap = 10;
		chartstack.addLegend(legendstack);
		
		chartstack.write("chartstackdiv");
	});
	
	function generateChartStack(){
		var namaperusahaan = $("#nama_perusahaan").val();
		var tahun = $("#tahun").val();
		var tipeperusahaan =  $("#tipe_perusahaan").val();
		var subsektor =  $("#sub_sektor").val();
		chartData = AmCharts.loadJSON('<?php echo base_url();?>chartmgrenergi/getlinedata?nama_perusahaan='+namaperusahaan+'&tahun='+tahun+'&tipe_perusahaan='+tipeperusahaan+'&sub_sektor='+subsektor);
		chartstack.dataProvider = chartData;
		chartstack.validateData();
	}
</script>