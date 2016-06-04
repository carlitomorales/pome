    
    <div class="box-content">
		<?php
			if($status){
				if($status == 'error'){
		?>
        	<div class="alert alert-error"><?php echo $msg;?></div>
        <?php
				}else{
		?>
        	<div class="alert alert-success"><?php echo $msg;?></div>
        <?php
				}
			}
			if($kegiatan){
				foreach($kegiatan as $row){
					$id = $row['events_id'];
					$title = $row['title'];
					$start = $row['start_date'];
					$desc = $row['description'];
					$startdate = strtotime($start);
					$startview = date("d M Y", $startdate);
		?>
        	<h3><?php echo $title;?></h3>
            <small><?php echo $startview;?></small>
            <p>
            <?php echo $desc;?>
            </p>
        <?php
					if($this->session->userdata('privilege_id') == 2){						
		?>
        	<span class="btn btn-primary" onclick="editEvent('<?php echo $id;?>')">Edit</span>
            <span class="btn btn-primary" onclick="deleteEvent('<?php echo $id;?>')">Delete</span>
        <?php
					}
		?>
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
<script language="javascript">	
	function editEvent(id){
		url = '<?php echo base_url();?>home/edit_event/'+id;
	   $.post(url, '', function(data){
		   $("#boxnews").html(data);
	   });
	}
	
	function deleteEvent(id){
		url = '<?php echo base_url();?>home/delete_event/'+id;
	   $.post(url, '', function(data){
		   $("#boxnews").html(data);
		   $("#kalender").fullCalendar('refetchEvents');
	   });
	}
</script>