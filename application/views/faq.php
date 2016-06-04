<?php include('header.php'); ?>

			<div>
				<ul class="breadcrumb">
					<li>
                        <a href="<?php echo base_url();?>">Home</a> / <a href="<?php echo base_url();?>home/faq">FAQ</a>
					</li>
				</ul>
			</div>	
            
            <div class="row-fluid"><!--/span-->
            	<div class="box span8" id="boxnews">
                </div>
                <div class="span4">
                	<?php include('login_calendar.php');?>
                </div>
       		</div>
<?php include('footer.php'); ?>
<script language="javascript">
	$(document).ready(function(){
		loadFAQ();
	});
	
	function loadFAQ(){
		url = '<?php echo base_url();?>home/faq_list';
		$.post(url, '', function(data){
			$("#boxnews").html(data);
		});
	}
</script>