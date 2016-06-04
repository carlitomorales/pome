<?php include('header.php'); ?>

			<div>
				<ul class="breadcrumb">
					<li>
						<a href="<?php echo base_url();?>">Home</a> <span class="divider">/</span>
					</li>
					<li>
						<a href="<?php echo base_url();?>chartrencana">Statistik Rencana Konservasi Energi</a>
					</li>
				</ul>
			</div>
			
			<div class="row-fluid sortable">		
				<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2><span class="icon icon-color icon-clipboard"></span>Statistik Rencana Konservasi Energi (Filter)</h2>
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
                                        <select id="tahun" name="tahun">
                                       	<?php
											for($i=date("Y")-5;$i<=date("Y");$i++){
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
                            <span class="btn btn-primary" id="submitfilter">Generate Chart</span>
                        </div>
                        </form> 
                    </div>
                </div>
            </div>
            
            <div class="row-fluid sortable">		
				<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2><span class="icon icon-color icon-clipboard"></span>Statistik Rencana Konservasi Energi (Chart)</h2>
					</div>
					<div class="box-content">
                    	<div class="row-fluid">
                    		<div class="span12" id="chartdiv" style="height:500px;"></div>
                        </div>
                        <!--
                        <div class="row-fluid">
                        	<div class="span12" id="legenddiv" style="height:100px;"></div>
                        </div>
                        -->
                    </div>
                </div>
            </div>
    
<?php include('footer.php'); ?>

<script language="javascript">
	var oTable;
	$(document).ready(function(){
		$("#submitfilter").live('click', function(){
			if($("#tipe_perusahaan").val() == ""){
				alert('Tipe perusahaan harus dipilih');
				$("#tipe_perusahaan").focus();
				return false;
			}
			generateChart();
		});
		
		$('#tipe_perusahaan').chainSelect('#sub_sektor','<?php echo base_url();?>chartrencana/getcombosubsektor',
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
	var selected;
	
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
	
	var chartData = [{"jenisperalatan":"none","persen":0,subs:[{"jenisperalatan":"none","persen":0}]}];
	var chartColors = ["#FF0033", "#339933", "#3366CC", "#FF9900", "#999966", "#993399", "#FF6666", "#0D8ECF", "#0D52D1", "#2A0CD0", "#8A0CCF", "#CD0D74", "#754DEB", "#DDDDDD", "#999999", "#333333", "#000000", "#57032A", "#CA9726", "#990000", "#4B0C25"];
	
	AmCharts.ready(function(){
		chart = new AmCharts.AmPieChart();
		chart.pathToImages = "http://www.amcharts.com/lib/images/";
		chart.dataProvider = chartData;
		chart.titleField = "jenisperalatan";
		chart.valueField = "persen";
		chart.precision = 2;
		chart.pulledField = "pulled";
		chart.colorField  = "color";
		
		chart.addTitle("Klik peralatan untuk melihat rencana yang akan dilakukan ");		
		
		legend = new AmCharts.AmLegend();
		legend.align = "left";
		legend.markerType = "circle";
		legend.position = "right";
		legend.valueAlign = "right";
		legend.valueWidth = 170;
		//chart.balloonText = "[[title]]<br><span style='font-size:14px'><b>[[value]]</b> ([[percents]]%)</span>";
		chart.addLegend(legend);
		
		chart.addListener("clickSlice", function (event) {
			if (event.dataItem.dataContext.id != undefined) {
				selected = event.dataItem.dataContext.id;
			}
			else {
				selected = undefined;
			}
			chart.dataProvider = generateChartData();
			chart.validateData();
		});
		
		chart.write("chartdiv");
	});
	
	function generateChartData () {
		var results = [];
		for (var i = 0; i < chartData.length; i++) {
			if (i == selected) {
				for (var x = 0; x < chartData[i].subs.length; x++) {
					results.push({
						jenisperalatan: chartData[i].subs[x].jenisperalatan,
						persen: chartData[i].subs[x].persen,
						color: chartData[i].color,
						pulled: true
					});
				}
			}
			else {
				results.push({
					jenisperalatan: chartData[i].jenisperalatan,
					persen: chartData[i].persen,
					color: chartData[i].color,
					id: i
				});
			}
		}
		return results;
	}
	
	function generateChart(){
		var tahun = $("#tahun").val();
		var subsektor =  $("#sub_sektor").val();
		var tipeperusahaan =  $("#tipe_perusahaan").val();
		chartData = AmCharts.loadJSON('<?php echo base_url();?>chartrencana/getpiedata?tahun='+tahun+'&sub_sektor='+subsektor+'&tipe_perusahaan='+tipeperusahaan);
		chart.dataProvider = chartData;
		chart.validateData();
	}
</script>