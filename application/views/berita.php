                	<div class="box-content">
                    <?php
						if($this->session->userdata('username') != ''){
							$sql = "SELECT `status` FROM t_statussubmit WHERE IdPerusahaan=".$this->session->userdata('id_perusahaan')." AND tahun=YEAR(NOW())-1";
							$query = $this->db->query($sql);
							$regulasi=$query->result_array();
							$statusLapor = 0;
							foreach($regulasi as $row){
								$statusLapor = $row['status'];
							}
							$tahunLapor = date("Y")-1;
							if($this->session->userdata('privilege_id') == '2'){
								$welcomeMsg = '<h3 align="center">Selamat datang Administrator.</h3>';
							}else{
								switch($statusLapor){
									case 0:
										$welcomeMsg = '<h3 align="center">Status pelaporan tahun '.$tahunLapor.': <span class="red">BELUM MELAPORKAN.</span><br>Mohon segera melakukan input laporan manajemen energi.</h3>';
										break;
									case 1:
										$welcomeMsg = '<h3 align="center">Status pelaporan tahun '.$tahunLapor.': <span class="yellow">SEDANG DIVERIFIKASI.</span><br>Terima kasih telah menyampaikan laporan manajemen energi.</h3>';
										break;
									case 2:
										$welcomeMsg = '<h3 align="center">Status pelaporan tahun '.$tahunLapor.': <span class="green">SUDAH MELAPORKAN.</span><br>Terima kasih telah menyampaikan laporan manajemen energi.</h3>';
										break;
									case 3:
										$welcomeMsg = '<h3 align="center">Status pelaporan tahun '.$tahunLapor.': <span class="red">DITOLAK.</span><br>Mohon segera melakukan perbaikan input laporan manajemen energi.</h3>';
										break;
								}
							}
					?>
                    	<?php echo '<p>'.$welcomeMsg.'</p>';?>
                    <?php
						}else{
							foreach($berita as $row){
					?>
                    	<h3 style="clear:both"><a href="<?php echo base_url();?>home/detailberita/<?php echo $row['news_id'];?>"><?php echo $row['title'];?></a></h3>
                        <div style="float:left; width:120px;">
                        <?php
							if(strlen($row['thumbnail']) > 0){
								echo '<img src="'.base_url().'uploads/news/'.$row['thumbnail'].'" class="thumbnail" />';	
							}
						?>
                        </div>
                        <div style="margin-left:135px;">
	                        <i><?php echo date('d M Y',strtotime($row['publish_date']));?></i><br/>
	                        <span>
	                        <?php echo $row['sinopsis'];?>
	                        </span>
                        </div>
                        <hr style="clear:both">
                     <?php
							}
						}
					?>
                    </div>
                    <script language="javascript">
			$(document).ready(function(){
				$.each($(".thumbnail"), function(){
					pjg = $(this).width();
					tgi = $(this).height();
					if(pjg > 100){
						setTimeout(function(){
							console.log("Panjang: " + pjg);
						},1000);
						$(this).width(100);
					}
				});
			});
		</script>