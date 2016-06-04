<div class="control-group" id='divKota'>
		  <label class="control-label" for="kota">Kota/Kab</label>
			  <div class="controls">
                   	<select name="IdKota" id="IdKota">
                      	<option value="" >-- Pilih --</option> 
                        <?php
								   
									foreach($option_kota as $rowKota){
												//echo "<option value='".$row->id."'>".$row->value."</option>";
												echo "<option value='".$rowKota->kota_id."'>".$rowKota->kota_kabupaten."</option>";
											}
								
																				
						?>                             
                    </select>
		      </div>
</div>
                            
