                	
                    <div class="box-header well" data-original-title>
						<h2><span class="icon icon-messages"></span> FAQ</h2>
					</div>
                    <div class="box-content">
                    <?php
						foreach($faq as $row){
					?>
                    	<h3 style="clear:both"><?php echo $row['question'];?></a></h3>
                        <p>
	                        <?php echo $row['answer'];?>
                        </p>
                        <hr style="clear:both">
                    <?php
						}
					?>
                    </div>