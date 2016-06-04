<div class="control-group" id='divJenisEnergiDetail'>
		  <label class="control-label" for="jenisenergidetail">Detail Jenis Energi</label>
			  <div class="controls">
                   	<select name="jenis_energi_detail" id="jenis_energi_detail">
                      	<option value="" >-- Pilih --</option> 
                        <?php
								   
									foreach($option_jenis_energi_detail as $rowJenisEnergiDetail){
												//echo "<option value='".$row->id."'>".$row->value."</option>";
												echo "<option value='".$rowJenisEnergiDetail->id_jenis_energi_detail."'>".$rowJenisEnergiDetail->detail_jenis_energi."</option>";
											}
																											
						?>                             
                    </select>
		      </div>
</div>
                            
