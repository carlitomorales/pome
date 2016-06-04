<?php include('header.php'); ?>
<!DOCTYPE html>
<html lang="en">
	<script type="text/javascript">
		function hideDiv(){ document.getElementById('divJenisEnergiLain').style.display = 'none'; } 
		function showDiv(){ document.getElementById('divJenisEnergiLain').style.display = 'inline'; } 
		function hideDiv1(){ document.getElementById('divJenisEnergiLain1').style.display = 'none'; } 
		function showDiv1(){ document.getElementById('divJenisEnergiLain1').style.display = 'inline'; } 
    </script>

			

			<div>
				<ul class="breadcrumb">
					<li>
						<a href="#">Home</a> <span class="divider">/</span>
					</li>
					<li>
						<a href="#">Input Laporan Manajemen Energi Industrial</a></li>
				</ul>
			</div>
			
<div class="row-fluid sortable">		
				<div class="box span12">
					<div class="box-header well" data-original-title>
						<div class="box-icon">
							<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
							<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
						</div>
					</div>
					<div class="box-content">
						<form id="form-wizard" class="form-horizontal" action="<?php echo base_url();?>TrxIndustri/add_save3" method="post" >	
                        <div id="form-wizard-1" class="step">
							<div class="step-title">
							 <i>3</i>
                                 <h5>Pemakaian Energi</h5>
								 <span>3 dari 7</span>
							   </div>
                               <div class="control-group">
                               </div>
                            	<div class="control-group">
                                    <label class="control-label" for="IdJnsEnergi">Jenis Energi</label>
                                    <div class="controls">
                                      <select name="JnsEnergi" id="IdJnsEnergi" onChange="ChangeJnsEnergi()">
							      <option selected value="">-- Pilih --</option>
							        <?php
											foreach($data_jenisenergi as $row){
												if ($row->JenisEnergi=='Lain-Lain')
												{
													echo "<option value='".$row->IdJenisEnergi."' onClick=javascript:showDiv();>".$row->JenisEnergi."</option>";		
												}
												else
												{
													echo "<option value='".$row->IdJenisEnergi."' onClick=javascript:hideDiv();>".$row->JenisEnergi."</option>";
												}
											}
											
										?>
                                </select>
                                    </div>
                                   </div>
                                   <script type="text/javascript">
										function ChangeJnsEnergi(){
											var selectValues = document.getElementById('IdJnsEnergi').value;
												if (selectValues == 0 || selectValues == 5){
													document.getElementById('divOrgUnit0').style.display = 'inline';
													document.getElementById('divOrgUnit1').style.display = 'none';
													document.getElementById('divOrgUnit2').style.display = 'none';
													document.getElementById('divOrgUnit3').style.display = 'none';
													document.getElementById('divOrgUnit4').style.display = 'none';
												}
												if (selectValues == 1){
													document.getElementById('divOrgUnit0').style.display = 'none';
													document.getElementById('divOrgUnit1').style.display = 'inline';
													document.getElementById('divOrgUnit2').style.display = 'none';
													document.getElementById('divOrgUnit3').style.display = 'none';
													document.getElementById('divOrgUnit4').style.display = 'none';
												}
												if (selectValues == 2){
													document.getElementById('divOrgUnit0').style.display = 'none';
													document.getElementById('divOrgUnit1').style.display = 'none';
													document.getElementById('divOrgUnit2').style.display = 'inline';
													document.getElementById('divOrgUnit3').style.display = 'none';
													document.getElementById('divOrgUnit4').style.display = 'none';
												}
												if (selectValues == 3){
													document.getElementById('divOrgUnit0').style.display = 'none';
													document.getElementById('divOrgUnit1').style.display = 'none';
													document.getElementById('divOrgUnit2').style.display = 'none';
													document.getElementById('divOrgUnit3').style.display = 'inline';
													document.getElementById('divOrgUnit4').style.display = 'none';
												}
												if (selectValues == 4){
													document.getElementById('divOrgUnit0').style.display = 'none';								
													document.getElementById('divOrgUnit1').style.display = 'none';
													document.getElementById('divOrgUnit2').style.display = 'none';
													document.getElementById('divOrgUnit3').style.display = 'none';
													document.getElementById('divOrgUnit4').style.display = 'inline';
												}
											}
										
									   </script>

                                  <div class="control-group">
							  <div class="controls" id="divJenisEnergiLain" style="display:none">
							    <input id="IdJenisEnergiLain" name="IdJenisEnergiLain"  type="text" class="typeahead" >
						      </div>
						    </div>
                                 <div class="control-group" id="divOrgUnit0" style="display:inline">
                                    <label class="control-label" for="original_unit">Jumlah Pemakaian Energi (Original Unit)</label>
                                    <div class="controls">
                                      <input class="input-xlarge focused" id="original_unit" name="original_unit" type="text">  
                                    </div>
                                  </div>
                                  <div class="control-group" id="divOrgUnit1" style="display:none">
                                    <label class="control-label" for="original_unit">Jumlah Pemakaian Energi (Original Unit)</label>
                                    <div class="controls">
                                      <input class="input-xlarge focused" id="original_unit" name="original_unit" type="text">&nbsp;Ton  
                                    </div>
                                  </div>
                                  <div class="control-group" id="divOrgUnit2" style="display:none">
                                    <label class="control-label" for="original_unit">Jumlah Pemakaian Energi (Original Unit)</label>
                                    <div class="controls">
                                      <input class="input-xlarge focused" id="original_unit" name="original_unit" type="text">&nbsp;Liter  
                                    </div>
                                  </div>
                                 <div class="control-group" id="divOrgUnit3" style="display:none">
                                    <label class="control-label" for="original_unit">Jumlah Pemakaian Energi (Original Unit)</label>
                                    <div class="controls">
                                      <input class="input-xlarge focused" id="original_unit" name="original_unit" type="text">&nbsp;MSCF  
                                    </div>
                                  </div>
                                 <div class="control-group" id="divOrgUnit4" style="display:none">
                                    <label class="control-label" for="original_unit">Jumlah Pemakaian Energi (Original Unit)</label>
                                    <div class="controls">
                                      <input class="input-xlarge focused" id="original_unit" name="original_unit" type="text">&nbsp;GWh  
                                    </div>
                                  </div>
                                  <div class="control-group">
                                    <label class="control-label" for="IdJmlhGJoule">(GJoule)</label>
                                    <div class="controls">
                                      <input class="input-xlarge focused" id="IdJmlhGJoule" type="text" name="JmlhGJoule" >
                                    </div>
                                    <!-- <span class="btn btn-primary">Tambah</span> -->
                             <!--  <table class="table">
                                <thead>
                                  <tr>
                                    <th>Jenis Energi</th>
                                    <th>Jumlah (Original Unit)</th>
                                    <th>Jumlah (GJoule)</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <tr>
                                    <td>&nbsp;</td>
                                    <td class="center">&nbsp;</td>
                                    <td class="center">&nbsp;</td>
                                  </tr>
                                  <tr>
                                    <td>&nbsp;</td>
                                    <td class="center">&nbsp;</td>
                                    <td class="center">&nbsp;</td>
                                  </tr>
                                  <tr>
                                    <td>&nbsp;</td>
                                    <td class="center">&nbsp;</td>
                                    <td class="center">&nbsp;</td>
                                  </tr>
                                </tbody>
                              </table> -->

									<div class="form-actions">
								<input id="back" class="btn btn-primary" type="reset" value="Back" />
								<input id="next" class="btn btn-primary" type="submit" value="Next" />
								<div id="status"></div>

                                  </div>
                             </div>
                             </div>
                             


<?php include('footer.php'); ?>
