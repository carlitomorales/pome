<?php include('header.php'); ?>
<?php
	if($berita){
		foreach($berita as $row){
			$title = $row['title'];
			$detail = $row['detail'];
		}
	}else{
		$title = '';
		$detail = '';
	}
?>
			<div>
				<ul class="breadcrumb">
					<li>
                        <a href="<?php echo base_url();?>">Home</a>
					</li>
				</ul>
			</div>	
            
            <div class="row-fluid"><!--/span-->
            	<div class="box span8" id="boxnews">
                	<div class="box-content">
                    	<h1><?php echo $title;?></h1>
                        <p>
                		<?php echo urldecode($detail);?>
                        </p>
                	</div>
                </div>
                <div class="span4">
                	<?php include('login_calendar.php');?>
                </div>
       		</div>
<?php include('footer.php'); ?>