<div class="row-fluid">
	<div class="box span12">
    	<div class="box-content">
        <?php
			if($kegiatan){
				foreach($kegiatan as $row){
					$title = $row['title'];
					$start = $row['start_date'];
					$desc = $row['description'];
		?>
        	<h3><?php echo $title;?></h3>
            <small><?php echo $start;?></small>
            <p>
            <?php echo $desc;?>
            </p>
            <hr>
        <?php
				}
			}else{
		?>
        	<p>Tidak ada kegiatan pada tanggal terpilih.</p>
        <?php		
			}
		?>        	
        </div>
    </div>
</div>