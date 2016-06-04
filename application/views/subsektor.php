<div class="control-group" id='divSubSektor'>
		  <label class="control-label" for="idSubsektor">Sub Sektor</label>
			  <div class="controls">
                   	<select name="IdSubsektor" id="IdSubsektor">
                      	<option value="" >-- Pilih --</option> 
                        <?php
								   	foreach($option_subsektor as $rowsubsektor){
												if ($rowsubsektor->NamaSubsektor=='Lain-Lain')
												{
													echo "<option value='".$rowsubsektor->IdMSubsektor."' onClick=javascript:showDiv();>".$rowsubsektor->NamaSubsektor."</option>";		
												}
												else
												{
												//echo "<option value='".$row->id."'>".$row->value."</option>";
													echo "<option value='".$rowsubsektor->IdMSubsektor."' onClick=javascript:hideDiv();>".$rowsubsektor->NamaSubsektor."</option>";
												}
											}
									
																				
						?>                             
                    </select>
		      </div>
</div>