<?php include('header.php'); ?>

			<div>
				<ul class="breadcrumb">
					<li>
						<a href="<?php echo base_url();?>">Home</a> <span class="divider">/</span>
					</li>
					<li>
						<a href="<?php echo base_url();?>reportpemakaianenergiadmin">Rekapitulasi Pemakaian Energi</a>
					</li>
				</ul>
			</div>
			
			<div class="row-fluid sortable">		
				<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2><span class="icon icon-color icon-clipboard"></span>Rekapitulasi Pemakaian Energi (Filter)</h2>
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
                                        <select id="tahun" name="tahun">
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
						<h2><span class="icon icon-color icon-clipboard"></span>Rekapitulasi Pemakaian Energi (Result)</h2>
					</div>
					<div class="box-content">
                    	<table class="table table-striped table-bordered bootstrap-datatable" id="datatable">
						  <thead>
							  <tr>
								  
								  <th rowspan="2" valign="middle">No</th>
								  <th rowspan="2" valign="middle">Nama Perusahaan</th>
								  <th colspan="2">Listrik PLN</th>
								  <th colspan="2">BBM</th>
								  <th colspan="2">Gas</th>
                                  <th colspan="2">Batu Bara</th>
                                  <th rowspan="2" valign="middle" bgcolor="#EDF8FE">Lainnya (Gjoule)</th>
                                  <th rowspan="2" valign="middle">Total</th>
							  </tr>
							  <tr>
							    <th>GWh</th>
							    <th>GJoule</th>
							    <th>KiloLiter</th>
							    <th>GJoule</th>
							    <th>MSCF</th>
							    <th>GJoule</th>
                                <th>Ton</th>
							    <th>GJoule</th>
						    </tr>
						  </thead>  
					  </table>
                    </div>
                </div>
            </div>
            </div>
            
   
    
<?php include('footer.php'); ?>

<script language="javascript">
	var oTable;
	$(document).ready(function(){
		oTable = $("#datatable").dataTable({
			"aaSorting":[[0,"asc"]],
			"bDestroy":true,
			"bFilter":false,
			"bProcessing": true,
			"bServerSide": true,
			"sAjaxSource": "<?php echo base_url();?>reportpemakaianenergiadmin/get_list",
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
							iframe.src = '<?php echo base_url();?>reportpemakaianenergiadmin/exportexcel?nama_perusahaan='+namaperusahaan+'&tahun='+tahun+'&tipe_perusahaan='+tipeperusahaan+'&sub_sektor='+subsektor;
							document.body.appendChild( iframe );
						},
						"sButtonText": "Export To Excel"
					}
				]
			}
		});
		
		$('<div class="clearfix">&nbsp;</div>').insertAfter('div.DTTT');
		
		$("#submitfilter").live('click', function(){
			oTable.fnDraw();
			generateChart();
			generateChartStack();
		});
		
		$('#tipe_perusahaan').chainSelect('#sub_sektor','<?php echo base_url();?>reportpemakaianenergiadmin/getcombosubsektor',
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
	});	
	
	var chart;
	var legend;
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
	
	var chartData = [{"jenisenergi":"none","gjoule":0}];
	var chartColors = ["#FF0033", "#339933", "#3366CC", "#FF9900", "#999966", "#993399", "#FF6666", "#0D8ECF", "#0D52D1", "#2A0CD0", "#8A0CCF", "#CD0D74", "#754DEB", "#DDDDDD", "#999999", "#333333", "#000000", "#57032A", "#CA9726", "#990000", "#4B0C25"];
	
	AmCharts.ready(function(){
		chart = new AmCharts.AmPieChart();
		chart.pathToImages = "http://www.amcharts.com/lib/images/";
		chart.dataProvider = chartData;
		chart.titleField = "jenisenergi";
		chart.valueField = "gjoule";
		chart.colors = chartColors;
		chart.precision = 2;
		
		
		legend = new AmCharts.AmLegend();
		legend.align = "center";
		legend.markerType = "circle";
		chart.balloonText = "[[title]]<br><span style='font-size:14px'><b>[[value]]</b> ([[percents]]%)</span>";
		chart.addLegend(legend);
		
		chart.write("chartdiv");
		
		// SERIAL CHART
		chartstack = new AmCharts.AmSerialChart();
		chartstack.dataProvider = [];
		chartstack.categoryField = "tahun";
		chartstack.plotAreaBorderAlpha = 0.2;
		chartstack.precision = 2;

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
		
		<?php
		$i = 0;
		foreach($jenisenergi as $rjenisenergi){
			$currjenisenergi = $rjenisenergi['JenisEnergi'];
		?>
		
		graph = new AmCharts.AmGraph();
		graph.title = "<?php echo $currjenisenergi;?>";
		graph.labelText = "[[value]]";
		graph.valueField = "<?php echo $currjenisenergi;?>";
		graph.type = "column";
		graph.lineAlpha = 0;
		graph.fillAlphas = 1;
		graph.balloonText = "<span style='color:#555555;'>[[category]]</span><br><span style='font-size:14px'>[[title]]:<b>[[value]]</b></span>";
		graph.fillColors = chartColors[<?php echo $i;?>];
		chartstack.addGraph(graph);
		
		<?php
			$i++;
		}
		?>
		
		var legendstack = new AmCharts.AmLegend();
		legendstack.borderAlpha = 0.2;
		legendstack.horizontalGap = 10;
		chartstack.addLegend(legendstack);
		
		chartstack.write("chartstackdiv");
	});
	
	function generateChart(){
		var tahun = $("#tahun").val();
		var subsektor =  $("#sub_sektor").val();
		var tipeperusahaan =  $("#tipe_perusahaan").val();
		chartData = AmCharts.loadJSON('<?php echo base_url();?>reportpemakaianenergiadmin/getpiedata?tahun='+tahun+'&sub_sektor='+subsektor+'&tipe_perusahaan='+tipeperusahaan);
		chart.dataProvider = chartData;
		chart.validateData();
	}
	
	function generateChartStack(){
		var subsektor =  $("#sub_sektor").val();
		var tipeperusahaan =  $("#tipe_perusahaan").val();
		chartData = AmCharts.loadJSON('<?php echo base_url();?>reportpemakaianenergiadmin/getlinedata?sub_sektor='+subsektor+'&tipe_perusahaan='+tipeperusahaan);
		chartstack.dataProvider = chartData;
		chartstack.validateData();
	}
</script>