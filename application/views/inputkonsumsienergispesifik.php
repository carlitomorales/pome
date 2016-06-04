<?php include('header.php'); ?>
			<div>
				<ul class="breadcrumb">
					<li>
						<a href="#">Home</a> <span class="divider">/</span>
					</li>
					<li>
						<a href="#">Input Laporan</a>
                    </li>
				</ul>
			</div>
			
			<div class="row-fluid"><!--/span-->
            	<div class="box span12">
                	<div class="box-content">
                    	<div id="form-wizard-4" class="step">
                           <div class="step-title">
                             <i><?php $type=$this->session->userdata('type_perusahaan');
							 switch ($type){
								 case 1:
								 echo "4";
								 break;
								 case 2:
								 echo "4";
								 break;
								 } ?></i>
                             <h5>Konsumsi Energi Spesifik</h5>
                             <span><?php $type=$this->session->userdata('type_perusahaan');
							 switch ($type){
								 case 1:
								 echo "4 dari 8";
								 break;
								 case 2:
								 echo "4 dari 8";
								 break;
								 } ?></span>
                           </div>
                        </div>
                    </div>
                </div>
            </div>
            
			<div class="row-fluid">	
                <div class="box span12">
					<div class="box-header well" data-original-title>
						<h2>List Konsumsi Energi Spesifik</h2>
						<div class="box-icon">
                        	<h2>Tahun <?php echo date("Y")-1;?></h2>
						</div>
					</div>
					<div class="box-content">
                    	<table class="table table-striped table-bordered bootstrap-datatable" id="datatable1">
                              <thead>
                                  <tr>
                                      <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                      <th>Satuan</th>
                                      <th>Tahun Sebelumnya</th>
                                      <th>Tahun <?php echo date("Y")-1;?></th>
                                      <th>Persentase Pertumbuhan</th>
                                  </tr>
                              </thead>  
                          </table> 
                          <input id="type_perusahaan" name="type_perusahaan" type="hidden"  value="<?php echo $this->session->userdata('type_perusahaan'); ?>">
                    </div>
                </div>
             </div>
             <div class="row-fluid">
                <div class="box span12">
                	<div class="box-content">
                    	<span class="btn btn-primary" onClick="document.location='<?php echo base_url();?>pemakaianenergi'">Previous</span>
						<span class="btn btn-primary" onClick="document.location='<?php echo base_url();?>peralatanpemanfaat'" style="float:right">Next</span>
                    </div>
                </div>
              </div>
<?php include('footer.php'); ?>

	<script type="text/javascript">
	var oTable;
		
	$(document).ready(function(){
		var url="";
		if($("#type_perusahaan").val()=="1")
		{
			url="<?php echo base_url();?>konsumsienergispesifik/listkonsumsienergispesifik";
		}
		if($("#type_perusahaan").val()=="2")
		{
			url="<?php echo base_url();?>konsumsienergispesifik/listkonsumsienergispesifikbang";
		}
		oTable = $("#datatable1").dataTable({
			"bSort":false,
			"bDestroy":true,
			"bFilter":false,
			"bPaginate":false,
			"bInfo":false,
			"bProcessing": true,
			"bServerSide": true,
			"sAjaxSource": url,
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
						var ret="";
						if(obj.aData[2]==0)
						{ret="-";} else {ret=formatCurrency(obj.aData[2],2);}
						return ret;
					}
				},
				{
					"aTargets":[3],
					"fnRender": function(obj){
						return formatCurrency(obj.aData[3],2);
					}
				},
				{
					"aTargets":[4],
					"fnRender": function(obj){
						return formatCurrency(obj.aData[4],2)+"%";
					}
				}
				
			]
		});
		
		
	});	
    </script>