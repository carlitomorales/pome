<?php include('header.php'); ?>

			<div>
				<ul class="breadcrumb">
					<li>
						<a href="<?php echo base_url();?>">Home</a> <span class="divider">/</span>
					</li>
					<li>
						<a href="<?php echo base_url();?>chartrencanaefesiensi">Chart Rencana Efesiensi Energi</a>
					</li>
				</ul>
			</div>
			
			<div class="row-fluid sortable">		
				<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2><span class="icon icon-color icon-image"></span> Chart Rencana Kegiatan Efesiensi Energi (Filter)</h2>
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
	                                      <label class="control-label" for="tahun">Jenis Peralatan</label>
	                                      <div class="controls">
	                                        <select id="jenisperalatan" name="jenisperalatan">
	                                       	<?php
												foreach($jenisperalatan as $row){
											?>
	                                            <option value="<?php echo $row->JenisPeralatan;?>"><?php echo $row->JenisPeralatan;?></option>
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
                                      <label class="control-label" for="tahun">Tahun</label>
                                      <div class="controls">
                                        <select id="tahun" name="tahun">
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
                                &nbsp;
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
						<h2><span class="icon icon-color icon-image"></span> Chart Rencana Kegiatan Efesiensi Energi</h2>
					</div>
					<div class="box-content" align="center">
                    	<div id="chartdiv" style="width:100%; height:400px;"></div>
                    </div>
                </div>
            </div>
    
<?php include('footer.php'); ?>

<script language="javascript">
	$(document).ready(function(){
		$("#submitfilter").live('click', function(){
			generateChart();
		});
	});	
	
	var chart;
	var legend;
	
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
	
	var chartData = [{"jenis_kegiatan":"none","frekuensi":0}];
	
	AmCharts.ready(function(){
		chart = new AmCharts.AmPieChart();
		chart.pathToImages = "http://www.amcharts.com/lib/images/";
		chart.dataProvider = chartData;
		chart.titleField = "jenis_kegiatan";
		chart.valueField = "frekuensi";
		
		legend = new AmCharts.AmLegend();
		legend.align = "center";
		legend.markerType = "circle";
		chart.balloonText = "[[title]]<br><span style='font-size:14px'><b>[[value]]</b> ([[percents]]%)</span>";
		chart.addLegend(legend);
		
		chart.write("chartdiv");
	});
	
	function generateChart(){
		var jenisperalatan = $("#jenisperalatan").val();
		var tahun = $("#tahun").val();
		chartData = AmCharts.loadJSON('<?php echo base_url();?>chartrencanaefesiensi/getpiedata?jenisperalatan='+jenisperalatan+'&tahun='+tahun);
		chart.dataProvider = chartData;
		chart.validateData();
	}
</script>