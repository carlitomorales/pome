<?php include('header.php'); ?>

			<div>
				<ul class="breadcrumb">
					<li>
						<a href="<?php echo base_url();?>">Home</a> <span class="divider">/</span>
					</li>
					<li>
						<a href="<?php echo base_url();?>chartkonsumsienergispesifiknew">Konsumsi Energi Spesifik</a>
					</li>
				</ul>
			</div>
			
			<div class="row-fluid sortable">		
				<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2><span class="icon icon-color icon-image"></span> Konsumsi Energi Spesifik (Filter)</h2>
					</div>
					<div class="box-content">
                    	<div id="divAlert"></div>
                        <form id="frmAdd" class="form-horizontal" action="" method="post">
                        <div class="row-fluid sortable">
                        	<div class="span6">
                            	<div class="box-content">
                            	<div class="control-group" id='divSubSektor'>
                                      <label class="control-label" for="idSubsektor">Sub Sektor</label>
                                          <div class="controls">
                                                <select name="IdSubsektor" id="IdSubsektor" disabled>
                                                     <?php
													 		
                                                         echo "<option value='".$option_subsektor['IdMSubsektor']."' onClick=javascript:showDiv();>".$option_subsektor['NamaSubsektor']."</option>";
                                                   ?>                             
                                                </select>
                                          </div>
                            </div>
                                    <div class="control-group">
                                      <label class="control-label" for="tahun">Tahun</label>
                                      <div class="controls">
                                        <select id="tahun" name="tahun" >
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
                                
                                </div>
                            </div>
                        </div>  
                        <div class="form-actions">
                            <span class="btn btn-primary" id="submitfilter">Submit</span>
                        </div>
                        </form> 
                    </div>
                </div>
            </div>
            
            <div class="row-fluid sortable">		
				<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2><span class="icon icon-color icon-image"></span> Chart Konsumsi Energi Spesifik</h2>
					</div>
					<div class="box-content" align="center">
                        <div id="chartstackdiv" style="width:100%; height:400px;"></div>
                    </div>
                </div>
            </div>
    
<?php include('footer.php'); ?>

<script language="javascript">
	$(document).ready(function(){
		$("#submitfilter").live('click', function(){
			generateChartStack();
		});
	});	
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
		chartstack.categoryField = "Nilai Konsumsi Energi Spesifik";
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
		
		//<?php
		//$jeniskonsspsfik = array("Paling Efisien","Rata-Rata","Tidak Efisien","Energi Spesifik Perusahaan");

		//foreach ($jeniskonsspsfik as $value) {
		//  $currjenisenergi=$value;
		
		//?>
		
		graph = new AmCharts.AmGraph();
		graph.title = "Nilai Konsumsi Energi Spesifik";
		graph.labelText = "[[value]]";
		graph.valueField = "nilai";
		graph.type = "column";
		graph.lineAlpha = 0;
		graph.fillAlphas = 1;
		graph.balloonText = "<span style='color:#555555;'>[[category]]</span><br><span style='font-size:14px'>[[title]]:<b>[[value]] </b></span>";
		chartstack.addGraph(graph);
		
		//<?php
		//}
		//?>
		
		var legendstack = new AmCharts.AmLegend();
		legendstack.borderAlpha = 0.2;
		legendstack.horizontalGap = 10;
		chartstack.addLegend(legendstack);
		
		chartstack.write("chartstackdiv");
	});
	
	function generateChartStack(){
		var tahun =  $("#tahun").val();
		chartData = AmCharts.loadJSON('<?php echo base_url();?>chartkonsumsienergispesifiknew/getlinedata?tahun='+tahun);
		chartstack.dataProvider = chartData;
		chartstack.validateData();
	}
</script>