<?php include('header.php'); ?>


			<div>
				<ul class="breadcrumb">
					<li>
						<a href="<?php echo base_url();?>dashboard">Home</a> <span class="divider">/</span>
					</li>
					<li>
						<a href="<?php echo base_url();?>user/inbox">Inbox</a> <span class="divider">/</span>
					</li>
					
				</ul>
			</div>
			
			
			<div class="row-fluid sortable">		
				<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2><span class="icon icon-color icon-user"></span> <?php  echo $judulpesan; ?></h2>
						<div class="box-icon">
							
						</div>
					</div>
					<div class="box-content">
						<div class="control-group">
							<?php  echo $isipesan; ?>
						</div>
						<!--<div class="control-group">
							<span class="btn btn-primary" onClick="document.location='<?php //echo base_url();?>user/kirimpesan?rply=<?php //echo$nopesan; ?>'">Reply</span>
						</div>-->
						<div class="control-group">
							<span class="btn btn-primary" onClick="document.location='<?php echo base_url();?>user/printpesan?id=<?php echo$nopesan; ?>'">Print</span>
						</div>
					</div><!--/span-->
			
				</div><!--/row-->
			</div>
			
    
<?php include('footer.php'); ?>

<script type="text/javascript">
	
</script>