<?php include('header.php'); ?>

			<div>
				<ul class="breadcrumb">
					<li>
						<a href="<?php echo base_url();?>">Home</a> <span class="divider">/</span>
					</li>
					<li>
						<a href="<?php echo base_url();?>reportpemakaianenergiadmin">Status Pelaporan Per Sub Sektor</a>
					</li>
				</ul>
			</div>
			
			<div class="row-fluid sortable">		
				<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2><span class="icon icon-color icon-clipboard"></span>Status Pelaporan Per Sub Sektor (Filter)</h2>
					</div>
					<div class="box-content">
                    	<div id="divAlert"></div>
                        <form id="frmAdd" class="form-horizontal" action="" method="post">
                        <div class="row-fluid sortable">
                        	<div class="span12">
                            	<div class="box-content">
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
                                    <div class="control-group">
                                      <label class="control-label" for="tipe_perusahaan">Tipe Perusahaan</label>
                                      <div class="controls">
                                        <select id="tipe_perusahaan" name="tipe_perusahaan">
                                        	<option value="">-Pilih-</option>
                                            <option value="1">Industri</option>
                                            <option value="2">Gedung/Bangunan</option>
                                          </select>
                                      </div>
                                    </div>
                                    <div class="control-group">
                                      <label class="control-label" for="sub_sektor">Sub Sektor</label>
                                      <div class="controls">
                                        <select id="sub_sektor" name="sub_sektor" multiple="multiple">
                                          </select>
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
						<h2><span class="icon icon-color icon-clipboard"></span>Status Pelaporan Per Sub Sektor (Chart)</h2>
					</div>
					<div class="box-content">
                    	<div class="row-fluid">
                    		<div class="span12" id="chartdiv" style="height:500px;"></div>
                        </div>
                    </div>
                </div>
            </div>
    
<?php include('footer.php'); ?>

<script language="javascript">
	var oTable;
	$(document).ready(function(){
		$("#submitfilter").live('click', function(){
			generateChart();
		});
		
		$("#sub_sektor").multipleSelect({
			placeholder: "Pilih sub sektor"
		});
		
		$('#tipe_perusahaan').chainSelect('#sub_sektor','<?php echo base_url();?>chartpenghematanenergi/getcombosubsektor',
		{ 
			before:function (target) //before request hide the target combobox and display the loading message
			{ 
				$("#loading").css("display","block");
				$(target).css("display","none");
			},
			after:function (target) //after request show the target combobox and hide the loading message
			{ 
				$("#loading").css("display","none");
				$(target).multipleSelect("refresh");
				$(target).multipleSelect("uncheckAll");
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
	
	var chartData = [{"subsektor":"none","jmlperusahaan":0,"jmlperusahaan":0}];
	var chartColors = ["#FF0033", "#339933", "#3366CC", "#FF9900", "#999966", "#993399", "#FF6666", "#0D8ECF", "#0D52D1", "#2A0CD0", "#8A0CCF", "#CD0D74", "#754DEB", "#DDDDDD", "#999999", "#333333", "#000000", "#57032A", "#CA9726", "#990000", "#4B0C25"];
	
	chart = AmCharts.makeChart("chartdiv", {
		"theme": "light",
		"type": "serial",
		"dataProvider": chartData,
		"valueAxes": [{
			"stackType": "3d",
			"unit": "",
			"position": "left",
			"title": "Jumlah Perusahaan",
		}],
		"startDuration": 1,
		"graphs": [{
			"balloonText": "Perusahaan [[category]] sudah melaporkan: <b>[[value]]</b>",
			"fillAlphas": 0.9,
			"lineAlpha": 0.2,
			"title": "Jumlah yang melaporkan",
			"type": "column",
			"valueField": "jmllapor",
			"labelText":"[[value]]"
		},{
			"balloonText": "Perusahaan [[category]]: <b>[[value]]</b>",
			"fillAlphas": 0.9,
			"lineAlpha": 0.2,
			"title": "Jumlah Perusahaan",
			"type": "column",
			"valueField": "jmlperusahaan",
			"labelText":"[[value]]"
		}],
		"plotAreaFillAlphas": 0.1,
		"depth3D": 60,
		"angle": 30,
		"categoryField": "subsektor",
		"categoryAxis": {
			"gridPosition": "start",
			"labelRotation":45
		},
		"export": {
			"enabled": true
		},
		"legend": {
			"position":"bottom",
			"align":"center"
		}
	});
	
	function generateChart(){
		var tahun = $("#tahun").val();
		var tipeperusahaan =  $("#tipe_perusahaan").val();
		var subsektor = $("#sub_sektor").val();
		chartData = AmCharts.loadJSON('<?php echo base_url();?>chartstatuspersubsektor/getpiedata?tahun='+tahun+'&tipe_perusahaan='+tipeperusahaan+'&sub_sektor='+subsektor);
		chart.dataProvider = chartData;
		chart.validateData();
	}
</script>