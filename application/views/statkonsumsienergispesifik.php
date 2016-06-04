<?php include('header.php'); ?>

			<div>
				<ul class="breadcrumb">
					<li>
						<a href="<?php echo base_url();?>">Home</a> <span class="divider">/</span>
					</li>
					<li>
						<a href="<?php echo base_url();?>statkonsumsienergispesifik">Statistik Konsumsi Energi Spesifik</a>
					</li>
				</ul>
			</div>
			
			<div class="row-fluid sortable">		
				<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2><span class="icon icon-color icon-clipboard"></span>Statistik Konsumsi Energi Spesifik (Filter)</h2>
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
                            <span class="btn btn-primary" id="submitfilter">Search</span>
                        </div>
                        </form> 
                    </div>
                </div>
            </div>
            
       
            
           
            <div class="row-fluid sortable">		
				<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2><span class="icon icon-color icon-image"></span>Statistik Konsumsi Energi Spesifik</h2>
					</div>
					<div class="box-content" align="center">
                        <div id="chartdiv" style="width:100%; height:400px;"></div>
                    </div>
                </div>
            </div>
           
<?php include('footer.php'); ?>

<script language="javascript">
	$(document).ready(function(){			
		$('#tipe_perusahaan').chainSelect('#sub_sektor','<?php echo base_url();?>statkonsumsienergispesifik/getcombosubsektor',
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
			generateChartStack();
			//populateTable();
		});
	});
	
	
	
	var chart ;
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
	var chartData = [{"tahun":"none","Tidak Efisien":0,"Rata-Rata":0,"Paling Efisien":0}];
	
	chart = AmCharts.makeChart("chartdiv", {
    			"type": "serial",
    			"theme": "light",
    			"legend": {
        			"useGraphSettings": true
    				},
    			"dataProvider": chartData,
    "valueAxes": [{
        "integersOnly": true,
        "reversed": false,
        "axisAlpha": 0,
        "dashLength": 5,
        "gridCount": 10,
        "position": "left",
        "title": "Konsumsi Energi Spesifik"
    }],
    "startDuration": 0.5,
    "graphs": [{
        "balloonText": "Tidak Efisien: [[value]]",
        "bullet": "round",
        "title": "Tidak Efisien",
        "valueField": "Tidak Efisien",
		"fillAlphas": 0
    }, {
        "balloonText": "Rata - Rata: [[value]]",
        "bullet": "round",
        "title": "Rata - Rata",
        "valueField": "Rata-Rata",
		"fillAlphas": 0
    }, {
        "balloonText": "Paling Efisien: [[value]]",
        "bullet": "round",
        "title": "Paling Efisien",
        "valueField": "Paling Efisien",
		"fillAlphas": 0
    }],
    "chartCursor": {
        "cursorAlpha": 100,
        "zoomable": false
    },
    "categoryField": "tahun",
    "categoryAxis": {
        "gridPosition": "start",
        "axisAlpha": 0,
        "fillAlpha": 0,
        "fillColor": "#000000",
        "gridAlpha": 0,
        "position": "bottom"
    },
    "export": {
    	"enabled": true,
        "position": "bottom-right"
     }
});

	
	function generateChartStack(){
		//var namaperusahaan = $("#nama_perusahaan").val();
		var tahun = $("#tahun").val();
		var tipeperusahaan =  $("#tipe_perusahaan").val();
		var subsektor =  $("#sub_sektor").val();
		chartData = AmCharts.loadJSON('<?php echo base_url();?>statkonsumsienergispesifik/getlinedata?tahun='+tahun+'&tipe_perusahaan='+tipeperusahaan+'&sub_sektor='+subsektor);
		chart.dataProvider = chartData;
		chart.validateData();
	}
</script>