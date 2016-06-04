<?php include('header.php'); ?>
<!DOCTYPE html>
<html lang="en">
	<script type="text/javascript">
		function hideDiv(){ document.getElementById('divJenisEnergiLain').style.display = 'none'; } 
		function showDiv(){ document.getElementById('divJenisEnergiLain').style.display = 'inline'; } 
		function hideDiv1(){ document.getElementById('divJenisEnergiLain1').style.display = 'none'; } 
		function showDiv1(){ document.getElementById('divJenisEnergiLain1').style.display = 'inline'; } 
		
	$(document).ready(function(){		
		$(".dellink").live("click",function() {
			$(this).parent().parent().remove();
			return false;
		});
	});
				
	function addrow()
	{
		var kegiatan = $("#kegiatan").val();
		var targetgjoule = $("#targetgjoule").val();
		var targetpersen = $("#targetpersen").val();
		var realisasigjoule = $("#realisasigjoule").val();
		var realisasipersen = $("#realisasipersen").val();
		var keterangan = $("#keterangan").val();
		$(".table > tbody:last").after('<tr><td>'+kegiatan+'</td><td>'+targetgjoule+'</td><td>'+targetpersen+'</td><td>'+realisasigjoule+'</td><td>'+realisasipersen+'</td><td>'+keterangan+'</td><td><a class="editlink" style="cursor:pointer">Edit</a> | <a class="dellink" style="cursor:pointer">Del</a></td></tr>');
	}
    </script>

<div id="content" class="span10">
			<!-- content starts -->
			

			<div>
				<ul class="breadcrumb">
					<li>
						<a href="#">Home</a> <span class="divider">/</span>
					</li>
					<li>
						<a href="#">Input Laporan</a></li>
				</ul>
			</div>
			
			<div class="row-fluid sortable"><!--/span-->

			</div><!--/row-->


						<form id="form-wizard" class="form-horizontal row-fluid well" action="<?php echo base_url();?>ManajemenEnergi/step7">
                             <div id="form-wizard-5" class="step">
							   <div class="step-title">
								 <i>6</i>
                                 <h5>Kegiatan Konservasi Energi Yang Telah Dilakukan</h5>
								 <span>6 dari 8</span>
							   </div>
                                <div class="control-group">
                            </div>
                            <div class="control-group">
							  <label class="control-label" for="kegiatan">Kegiatan</label>
							  <div class="controls">
							    <input class="input-xlarge focused" id="kegiatan" name="kegiatan" type="text">
						      </div>
						    </div>
						  <div class="control-group">
							<label class="control-label" for="targetgjoule">Target Penghematan</label>
							<div class="controls">
							  <input class="input-small" id="targetgjoule" name="targetgjoule" type="text">(GJoule)
							  <input class="input-small" id="targetpersen" name="targetpersen" type="text">(%)
							</div>
						  </div>
						  <div class="control-group">
							<label class="control-label" for="realisasigjoule">Realisasi Penghematan</label>
							<div class="controls">
							  <input class="input-small" id="realisasigjoule" name="realisasigjoule" type="text">(GJoule)
							  <input class="input-small" id="realisasipersen" name="realisasipersen" type="text">(%)
							</div>
						  </div>
						  <div class="control-group">
							<label class="control-label" for="keterangan">Keterangan (Hambatan, dll)</label>
							<div class="controls">
							  <textarea id="keterangan" name="keterangan" class="autogrow"></textarea>
							</div>
						  </div>									
                                    <span class="btn btn-primary" onClick="addrow()">Tambah</span>							
									<p>
                              <table class="table" id="tableenergi">
                                <thead>
                                  <tr>
                                    <th rowspan="2" valign="top">Kegiatan</th>
                                    <th colspan="2" align="center">Target</th>
                                    <th colspan="2" align="center">Realisasi</th>
                                    <th rowspan="2" valign="top">Keterangan</th>
									<th rowspan="2">&nbsp;</th>
                                  </tr>
                                  <tr>
                                    <th>(GJoule)</th>
                                    <th>(%)</th>
                                    <th>(GJoule)</th>
                                    <th>(%)</th>
                                  </tr>
                                </thead>
                                <tbody>
                                </tbody>
                              </table>
							  	</p>
                             </div>
                           <div class="form-actions">
								<input class="btn btn-primary" type="reset" value="Back" />
								<input class="btn btn-primary" type="submit" value="Next" />
								<div id="status"></div>
						   </div>
						   <div id="submitted"></div>
                         </form>
             </div>
<?php include('footer.php'); ?>
