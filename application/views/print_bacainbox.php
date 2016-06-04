

<title>Pesan_dari_<?php $dari;?>_subject_<?php echo $judulpesan."_".date('d/m/Y'); ?> </title>
			<div class="row-fluid sortable">		
				<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2><span class="icon icon-color icon-user "></span> Dari : <?php  echo $dari; ?> | Subject : <?php  echo $judulpesan; ?></h2>
						<div class="box-icon">
							
						</div>
					</div>
					<div class="box-content">
						<div class="control-group">
							<?php  echo $isipesan; ?>
						</div>
						<div class="control-group">
                                  <?php if($attach !=''){ ?>
								  <label class="control-label1" for="attach">File Attach : </label> <a href="<?php echo base_url();?>uploads/pesan/<?php echo $attach; ?>" download ><?php echo $attach; ?></a><?php } ?>
						        
							</div>
						<!--<div class="control-group">
							<span class="btn btn-primary" onClick="document.location='<?php //echo base_url();?>user/kirimpesan?rply=<?php //echo$nopesan; ?>'">Reply</span>
						</div>-->
						
					</div><!--/span-->
			
				</div><!--/row-->
			</div>
			
    

<script type="text/javascript">
	window.print();
        
	window.onfocus=function(){ window.history.back();}
</script>