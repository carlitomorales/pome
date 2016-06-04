<?php include('header.php'); ?>
<!DOCTYPE html>
<html lang="en">
	<script type="text/javascript">
		function hideDiv(){ document.getElementById('divJenisEnergiLain').style.display = 'none'; } 
		function showDiv(){ document.getElementById('divJenisEnergiLain').style.display = 'inline'; } 
		function hideDiv1(){ document.getElementById('divJenisEnergiLain1').style.display = 'none'; } 
		function showDiv1(){ document.getElementById('divJenisEnergiLain1').style.display = 'inline'; } 
    </script>

<div id="content" class="span10">
			<!-- content starts -->
			

			<div>
				<ul class="breadcrumb">
					<li>
						<a href="#">Home</a> <span class="divider">/</span>
					</li>
					<li>
						<a href="#">Input Laporan Manajemen Energi Komersial</a></li>
				</ul>
			</div>
			
			<div class="row-fluid sortable"><!--/span-->

			</div><!--/row-->


						<form id="form-wizard" class="form-horizontal row-fluid well">
                        <div id="form-wizard-1" class="step">
							<div class="step-title">
								<i>1</i>
                                <h5>Organisasi Manajemen Energi</h5>
								<span>1 dari 6</span>
							</div>
                             <div class="control-group">
                            </div>
                            <div class="control-group">
							    <label class="control-label">Organisasi Manajemen Energi</label>
							    <div class="controls">
							      <label class="radio" id="IdOrgManajEnergi">
							        <input type="radio" name="optionsRadios3" id="optionsRadios3" value="option1" checked>
							        Ada</label>
							      <div style="clear:both"></div>
							      <label class="radio">
							        <input type="radio" name="optionsRadios3" id="optionsRadios4" value="option2">
							        Tidak </label>
						        </div>
						      </div>
							  <div class="control-group">
							    <label class="control-label" for="fileInput2">Pilih File<br>
							      <dfn>*) Jika ada, lampirkan Struktur Organisasi dan/ atau Surat Keputusan Pembentukan</dfn></label>
							    <div class="controls">
							      <input class="input-file uniform_on" id="IdFileOrg" type="file">
						        </div>
						      </div>
							  <div class="control-group">
							    <label class="control-label">Manajer Energi</label>
							    <div class="controls">
							      <label class="radio" id="IdManajEnergi">
							        <input type="radio" name="ManajEnergi" id="optionsRadios5" value="1" checked >
							        Ada</label>
							      <div style="clear:both"></div>
							      <label class="radio">
							        <input type="radio" name="ManajEnergi" id="optionsRadios6" value="0">
							        Tidak </label>
						        </div>
						      </div>
							  <div class="control-group">
							    <label class="control-label" for="IdNamaManaj">Nama Manajer Energi</label>
							    <div class="controls">
							      <input class="input-xlarge focused" id="IdNamaManaj" type="text">
						        </div>
						      </div>
							  <div class="control-group">
							    <label class="control-label" for="IdEmailManaj">Email Manajer Energi</label>
							    <div class="controls">
							      <input class="input-xlarge focused" id="IdEmailManaj" type="text">
						        </div>
						      </div>
							  <div class="control-group">
							    <label class="control-label" for="IdNoManaj">No Telp / HP Manajer Energi</label>
							    <div class="controls">
							      <input class="input-xlarge focused" id="IdNoManaj" type="text">
						        </div>
						      </div>
							  <div class="control-group">
							    <label class="control-label" for="IdNoSertifikat">No Sertifikat</label>
							    <div class="controls">
							      <input class="input-xlarge focused" id="IdNoSertifikat" type="text">
						        </div>
						      </div>
                             </div>
                             
                             <div id="form-wizard-2" class="step">
							   <div class="step-title">
								 <i>2</i>
                                 <h5>Pemakaian Energi</h5>
								 <span>2 dari 6</span>
							   </div>
                                <div class="control-group">
                            </div>
                            	<div class="control-group">
                                    <label class="control-label" for="IdJnsEnergi">Jenis Energi</label>
                                    <div class="controls">
                                      <select name="IdJnsEnergi" id="IdJnsEnergi">
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
                                  <div class="control-group">
							  <div class="controls" id="divJenisEnergiLain" style="display:none">
							    <input id="IdJenisEnergiLain" name="IdJenisEnergiLain"  type="text" class="typeahead" data-provide="typeahead" data-items="4" data-source='["Alabama","Alaska","Arizona","Arkansas","California","Colorado","Connecticut","Delaware","Florida","Georgia","Hawaii","Idaho","Illinois","Indiana","Iowa","Kansas","Kentucky","Louisiana","Maine","Maryland","Massachusetts","Michigan","Minnesota","Mississippi","Missouri","Montana","Nebraska","Nevada","New Hampshire","New Jersey","New Mexico","New York","North Dakota","North Carolina","Ohio","Oklahoma","Oregon","Pennsylvania","Rhode Island","South Carolina","South Dakota","Tennessee","Texas","Utah","Vermont","Virginia","Washington","West Virginia","Wisconsin","Wyoming"]'>
						      </div>
						    </div>
                                  <div class="control-group">
                                    <label class="control-label" for="IdJmlhOriginalUnit">Jumlah Pemakaian Energi (Original Unit)</label>
                                    <div class="controls">
                                      <input class="input-xlarge focused" id="IdJmlhOriginalUnit" type="text">
                                    </div>
                                  </div>
                                  <div class="control-group">
                                    <label class="control-label" for="IdJmlhGJoule">(GJoule)</label>
                                    <div class="controls">
                                      <input class="input-xlarge focused" id="IdJmlhGJoule" type="text">
                                    </div>
                                    <span class="btn btn-primary">Tambah</span>
                              <table class="table">
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
                              </table>
                                  </div>
                             </div>
                             <div id="form-wizard-3" class="step">
							   <div class="step-title">
								 <i>3</i>
                                 <h5>Konsumsi Energi Spesifik</h5>
								 <span>3 dari 6</span>
							   </div>
                                <div class="control-group">
                            </div>
                               <div class="control-group">
							  <label class="control-label" for="IdPemakaianEnergi">Pemakaian Energi (GJoule)</label>
							  <div class="controls">
							    <input class="input-xlarge focused" id="IdPemakaianEnergi" type="text">
						      </div>
						      </div>
                              <div class="control-group">
							  <label class="control-label" for="IdLuas">Luas Lantai (m2)</label>
							  <div class="controls">
							    <input class="input-xlarge focused" id="IdLuas" type="text">
                                 <label><dfn>*) merupakan luas lantai untuk aktivitas kerja, <br> tidak termasuk tempat parkir, dll </dfn></label>
						      </div>
						      </div>
                                  
                                
                                  <div class="control-group">
                                    <label class="control-label" for="IdKnsumsiEnergi">Konsumsi Energi Spesifik</label>
                                    <div class="controls">
                                      <input class="input-xlarge focused" id="IdKnsumsiEnergi" type="text">
                                     
                                    </div>
                                  </div>
                                  <div class="control-group">
                                    
                                   
                                    <div class="control-group">
							    
							    <div class="controls">
							      
						        </div>
						      </div>
                              
                              
                                    <span class="btn btn-primary">Tambah</span>
                              <table class="table">
                                <thead>
                                  <tr>
                                    <th>Jenis Peralatan Pemanfaat Energi Utama</th>
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
                                    <td class="center">&nbsp;</td>
                                  </tr>
                                  <tr>
                                    <td>&nbsp;</td>
                                    <td class="center">&nbsp;</td>
                                    <td class="center">&nbsp;</td>
                                    <td class="center">&nbsp;</td>
                                  </tr>
                                  <tr>
                                    <td>&nbsp;</td>
                                    <td class="center">&nbsp;</td>
                                    <td class="center">&nbsp;</td>
                                    <td class="center">&nbsp;</td>
                                  </tr>
                                  <tr>
                                    <td>&nbsp;</td>
                                    <td class="center">&nbsp;</td>
                                    <td class="center">&nbsp;</td>
                                    <td class="center">&nbsp;</td>
                                  </tr>
                                </tbody>
                              </table>
                                </div>
                            </div>
                             <div id="form-wizard-4" class="step">
							   <div class="step-title">
								 <i>4</i>
                                 <h5>Peralatan Pemanfaat Energi Utama</h5>
								 <span>4 dari 6</span>
							   </div>
                                <div class="control-group">
                            </div>
                            	<div class="control-group">
							  <label class="control-label" for="IdJnsPralatan">Jenis Peralatan Pemanfaat Energi Utama</label>
							  <div class="controls">
							    <input class="input-xlarge focused" id="IdJnsPralatan" type="text">
						      </div>
						    </div>
                                  <div class="control-group">
                                    <label class="control-label" for="IdJnsEnergi1">Jenis Energi</label>
                                    <div class="controls">
                                      <select name="IdJnsEnergi" id="IdJnsEnergi1">
							      <option selected value="">-- Pilih --</option>
							        <?php
											foreach($data_jenisenergi as $row){
												if ($row->JenisEnergi=='Lain-Lain')
												{
													echo "<option value='".$row->IdJenisEnergi."' onClick=javascript:showDiv1();>".$row->JenisEnergi."</option>";		
												}
												else
												{
													echo "<option value='".$row->IdJenisEnergi."' onClick=javascript:hideDiv1();>".$row->JenisEnergi."</option>";
												}
											}
											
										?>
                                </select>
                                    </div>
                                   </div>
                                  <div class="control-group">
							  <div class="controls" id="divJenisEnergiLain1" style="display:none">
							    <input id="IdJenisEnergiLain1" name="IdJenisEnergiLain1"  type="text" class="typeahead" data-provide="typeahead" data-items="4" data-source='["Alabama","Alaska","Arizona","Arkansas","California","Colorado","Connecticut","Delaware","Florida","Georgia","Hawaii","Idaho","Illinois","Indiana","Iowa","Kansas","Kentucky","Louisiana","Maine","Maryland","Massachusetts","Michigan","Minnesota","Mississippi","Missouri","Montana","Nebraska","Nevada","New Hampshire","New Jersey","New Mexico","New York","North Dakota","North Carolina","Ohio","Oklahoma","Oregon","Pennsylvania","Rhode Island","South Carolina","South Dakota","Tennessee","Texas","Utah","Vermont","Virginia","Washington","West Virginia","Wisconsin","Wyoming"]'>
						      </div>
						    </div>
                                  <div class="control-group">
                                    <label class="control-label" for="IdJmlhPmakaianEnergi">Jumlah Pemakaian Energi (Original Unit)</label>
                                    <div class="controls">
                                      <input class="input-xlarge focused" id="IdJmlhPmakaianEnergi" type="text">
                                    </div>
                                  </div>
                                  <div class="control-group">
                                    <label class="control-label" for="IdGJoule">(GJoule)</label>
                                    <div class="controls">
                                      <input class="input-xlarge focused" id="IdGJoule" type="text">
                                    </div>
                                    <div class="control-group">
							    <label class="control-label">Status Audit</label>
							    <div class="controls">
							      <label class="radio" id="StatusAudit">
							        <input type="radio" name="StatusAudit" id="optionsRadios3" value="1" checked="">
							        Sudah</label>
							      <div style="clear:both"></div>
							      <label class="radio">
							        <input type="radio" name="StatusAudit" id="optionsRadios4" value="0">
							        Belum </label>
						        </div>
						      </div>
                              <div class="control-group">
							    <label class="control-label" for="IdFileAudit">Pilih File<br>
							      <dfn>*) Jika sudah dilaksanakan, melampirkan rekomendasi hasil audit energi</dfn></label>
							    <div class="controls">
							      <input class="input-file uniform_on" id="IdFileAudit" type="file">
						        </div>
						      </div>
                              <div class="control-group">
							  <label class="control-label" for="IdKeterangan1">Keterangan <br>  <dfn>*)Nama, No Sertifikat Auditor, Waktu Pelaksanaan</dfn></label>
							  <div class="controls">
							    <textarea id="IdKeterangan1" name="IdKeterangan1" class="autogrow"></textarea>
						      </div>
						    </div>
                                    <span class="btn btn-primary">Tambah</span>
                              <table class="table">
                                <thead>
                                  <tr>
                                    <th>Jenis Peralatan Pemanfaat Energi Utama</th>
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
                                    <td class="center">&nbsp;</td>
                                  </tr>
                                  <tr>
                                    <td>&nbsp;</td>
                                    <td class="center">&nbsp;</td>
                                    <td class="center">&nbsp;</td>
                                    <td class="center">&nbsp;</td>
                                  </tr>
                                  <tr>
                                    <td>&nbsp;</td>
                                    <td class="center">&nbsp;</td>
                                    <td class="center">&nbsp;</td>
                                    <td class="center">&nbsp;</td>
                                  </tr>
                                  <tr>
                                    <td>&nbsp;</td>
                                    <td class="center">&nbsp;</td>
                                    <td class="center">&nbsp;</td>
                                    <td class="center">&nbsp;</td>
                                  </tr>
                                </tbody>
                              </table>
                                </div>
                             </div>
                             <div id="form-wizard-5" class="step">
							  <div class="step-title">
                              	<i>5</i>
								<h5>Kegiatan Konservasi Energi Yang Telah Dilakukan</h5>
								<span>5 dari 6</span>
							  </div>
                               <div class="control-group">
                            </div>
                            	<div class="control-group">
							  <label class="control-label" for="IdKegiatan">Kegiatan</label>
							  <div class="controls">
							    <input class="input-xlarge focused" id="IdKegiatan" type="text">
						      </div>
						    </div>
                                  
                                  <div class="control-group">
                                    <label class="control-label" for="IdTargetHematPersen">Target Penghematan (%)</label>
                                    <div class="controls">
                                      <input class="input-xlarge focused" id="IdTargetHematPersen" type="text">
                                    </div>
                                  </div>
                                  <div class="control-group">
                                    <label class="control-label" for="IdTargetHematGJoule">(GJoule)</label>
                                    <div class="controls">
                                      <input class="input-xlarge focused" id="IdTargetHematGJoule" type="text">
                                    </div>
                                    </div>
                                    
                            
                            <div class="control-group">
							  <label class="control-label" for="IdRealisasiPersen">Realisasi (%)</label>
							  <div class="controls">
							    <input class="input-xlarge focused" id="IdRealisasiPersen" type="text">
						      </div>
						    </div>
                            <div class="control-group">
							  <label class="control-label" for="IdRealisasiGJoule">(GJoule)</label>
							  <div class="controls">
							    <input class="input-xlarge focused" id="focusedInput12" type="text">
						      </div>
						    </div>
                          
                              <div class="control-group">
							  <label class="control-label" for="IdKeterangan2">Keterangan </label>
							  <div class="controls">
							    <textarea id="IdKeterangan2" name="IdKeterangan2" class="autogrow"></textarea>
						      </div>
						    </div>
                                    <span class="btn btn-primary">Tambah</span>
                              <table class="table">
                                <thead>
                                  <tr>
                                    <th>Kegiatan</th>
                                    <th>Target Penghematan (%)</th>
                                    <th>Target Penghematan (GJoule)</th>
                                    <th>Realisasi (%)</th>
                                    <th>Realisasi (GJoule)</th>
                                    <th>Keterangan</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <tr>
                                    <td>&nbsp;</td>
                                    <td class="center">&nbsp;</td>
                                    <td class="center">&nbsp;</td>
                                    <td class="center">&nbsp;</td>
                                    <td class="center">&nbsp;</td>
                                    <td class="center">&nbsp;</td>
                                  </tr>
                                  <tr>
                                    <td>&nbsp;</td>
                                    <td class="center">&nbsp;</td>
                                    <td class="center">&nbsp;</td>
                                    <td class="center">&nbsp;</td>
                                    <td class="center">&nbsp;</td>
                                    <td class="center">&nbsp;</td>
                                  </tr>
                                  <tr>
                                    <td>&nbsp;</td>
                                    <td class="center">&nbsp;</td>
                                    <td class="center">&nbsp;</td>
                                    <td class="center">&nbsp;</td>
                                    <td class="center">&nbsp;</td>
                                    <td class="center">&nbsp;</td>
                                  </tr>
                                  <tr>
                                    <td>&nbsp;</td>
                                    <td class="center">&nbsp;</td>
                                    <td class="center">&nbsp;</td>
                                    <td class="center">&nbsp;</td>
                                    <td class="center">&nbsp;</td>
                                    <td class="center">&nbsp;</td>
                                  </tr>
                                </tbody>
                              </table>
                                </div>
                               <div id="form-wizard-6" class="step">
							   <div class="step-title">
                               	 <i>6</i>
								 <h5>Rencana Kegiatan Konservasi</h5>
								 <span>6 dari 6</span>
							   </div>
                                <div class="control-group">
                            </div>
                            	<div class="control-group">
							  <label class="control-label" for="IdKeg">Kegiatan</label>
							  <div class="controls">
							    <input class="input-xlarge focused" id="IdKeg" type="text">
						      </div>
						    </div>
                                  
                                  <div class="control-group">
                                    <label class="control-label" for="IdHematKonservasiPersen">Target Penghematan (%)</label>
                                    <div class="controls">
                                      <input class="input-xlarge focused" id="IdHematKonservasiPersen" type="text">
                                    </div>
                                  </div>
                                  <div class="control-group">
                                    <label class="control-label" for="IdHematKonservasiGJoule">(GJoule)</label>
                                    <div class="controls">
                                      <input class="input-xlarge focused" id="IdHematKonservasiGJoule" type="text">
                                    </div>
                                    </div>
                                                               
                                                    
                              <div class="control-group">
							  <label class="control-label" for="IdKeterangan3">Keterangan </label>
							  <div class="controls">
							    <textarea id="IdKeterangan3" name="IdKeterangan3" class="autogrow"></textarea>
						      </div>
						    </div>
                                    <span class="btn btn-primary">Tambah</span>
                              <table class="table">
                                <thead>
                                  <tr>
                                    <th>Kegiatan</th>
                                    <th>Target Penghematan (%)</th>
                                    <th>Target Penghematan (GJoule)</th>
                                    <th>Keterangan</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <tr>
                                    <td>&nbsp;</td>
                                    <td class="center">&nbsp;</td>
                                    <td class="center">&nbsp;</td>
                                    <td class="center">&nbsp;</td>
                                   
                                  </tr>
                                  <tr>
                                    <td>&nbsp;</td>
                                    <td class="center">&nbsp;</td>
                                    <td class="center">&nbsp;</td>
                                    <td class="center">&nbsp;</td>
                                  
                                  </tr>
                                  <tr>
                                    <td>&nbsp;</td>
                                    <td class="center">&nbsp;</td>
                                    <td class="center">&nbsp;</td>
                                    <td class="center">&nbsp;</td>

                                  </tr>
                                  <tr>
                                    <td>&nbsp;</td>
                                    <td class="center">&nbsp;</td>
                                    <td class="center">&nbsp;</td>
                                    <td class="center">&nbsp;</td>

                                  </tr>
                                </tbody>
                              </table>
                                
                                </div>
                           <div class="form-actions">
								<input id="back" class="btn btn-primary" type="reset" value="Back" />
								<input id="next" class="btn btn-primary" type="submit" value="Next" />
								<div id="status"></div>
						   </div>
						   <div id="submitted"></div>
                         </form>
             </div>
                         


<?php include('footer.php'); ?>
