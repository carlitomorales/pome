<?php include('header.php'); ?>

			<div>
				<ul class="breadcrumb">
					<li>
                        <a href="<?php echo base_url();?>">Home</a> <span class="divider">/</span>
					</li>
					<li>
						<a href="<?php echo base_url();?>">Dashboard</a>
					</li>
				</ul>
			</div>	
            
            <div class="row-fluid"><!--/span-->
            	<div class="box span8">
                	<div class="box-content">
                    	<h3>Title News 1</h3>
                        <small>12-04-2014 09:32</small>
                        <p>
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus vulputate ut elit eget facilisis. Fusce nec adipiscing nisl, et bibendum ipsum. Vestibulum sed iaculis mauris. Nam iaculis odio a justo aliquam, a varius enim adipiscing. Etiam auctor velit nisl, quis sollicitudin dolor auctor vel. Suspendisse potenti. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Aenean bibendum elit ac pulvinar molestie. Donec justo lacus, pretium sed est id, vulputate convallis felis. Etiam tempor viverra neque, eu vestibulum neque consequat vitae. Vestibulum ullamcorper tincidunt velit eu blandit.
                        </p>
                        <hr>
                        <h3>Title News 2</h3>
                        <small>12-04-2014 08:41</small>
                        <p>
                        Maecenas adipiscing neque sed risus laoreet eleifend. Etiam placerat lectus sit amet tincidunt rutrum. Maecenas urna libero, molestie ac nibh ut, dapibus sodales ligula. Praesent at eros scelerisque turpis vestibulum vestibulum. Vestibulum ullamcorper erat id metus aliquet, et bibendum arcu laoreet. Aenean ut dapibus erat. Nulla ac ligula urna. Nullam porttitor nec mi ac pharetra. Pellentesque interdum est at sapien congue condimentum. Duis vestibulum aliquet sapien eu sollicitudin. Nam fermentum, massa eu pharetra pulvinar, nisi odio dignissim nunc, ullamcorper malesuada orci neque et arcu. Praesent ullamcorper, arcu et suscipit fermentum, elit tellus facilisis metus, et consequat ante elit non nibh.
                        </p>
                        <hr>
                        <h3>Title News 3</h3>
                        <small>11-04-2014 10:23</small>
                        <p>
                        Vestibulum vel cursus orci. Morbi suscipit consequat nisi, varius placerat mi vehicula a. Sed molestie urna elit, id dapibus leo molestie eget. Aliquam a accumsan dolor. Quisque mollis pretium eros in malesuada. Mauris ornare ligula a felis convallis, sed accumsan orci vestibulum. In laoreet tristique hendrerit. Sed commodo magna ipsum, non porttitor sem tempor a. Cras scelerisque justo tellus, eget interdum lorem fermentum sit amet. Sed id feugiat arcu, et tempor ante. Vivamus convallis tortor quis auctor fringilla.
                        </p>
                        <hr>                        
                        <h3>Title News 4</h3>
                        <small>11-04-2014 07:12</small>
                        <p>
                        Praesent dapibus turpis scelerisque urna mattis suscipit. Curabitur nec eleifend diam, ut viverra risus. Suspendisse porta dui eu lectus elementum blandit. Maecenas scelerisque, quam sagittis ornare ultrices, ligula eros volutpat augue, ac dapibus magna lorem ac urna. Suspendisse mauris lorem, tempor eget quam ac, sollicitudin hendrerit ligula. Nulla sed arcu condimentum, pulvinar nisl sollicitudin, hendrerit nisl. Suspendisse tincidunt viverra eros. Praesent ornare ac nulla quis mollis. Aliquam viverra consequat ipsum, eget semper nunc adipiscing quis. Etiam ac lorem risus. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Aenean ultricies quam quis lacus vulputate sollicitudin. Praesent nec congue metus, sit amet ullamcorper nisi.
                        </p>
                        <hr>
                    </div>
                </div>
                
                <div class="box span4">
                	
<?php
	if($islogin == false){
?>
					<div class="center login-box">
                    	<div class="alert alert-info">
							<?php echo $message; ?>
                        </div>
                        <form class="form-horizontal" action="<? echo base_url() ?>login/authorize" method="post">
                            <fieldset>
                                <div class="input-prepend" title="Username" data-rel="tooltip">
                                    <span class="add-on"><i class="icon-user"></i></span><input autofocus class="input-large span10" name="username" id="username" type="text" value="" />
                                </div>
                                <div class="clearfix"></div>
    
                                <div class="input-prepend" title="Password" data-rel="tooltip">
                                    <span class="add-on"><i class="icon-lock"></i></span><input class="input-large span10" name="password" id="password" type="password" value="" />
                                </div>
                                <div class="clearfix"></div>
    
                                <div class="input-prepend">
                                <label class="remember" for="remember"><input type="checkbox" id="remember" name="remember" value="1" />Remember me</label>
                                </div>
                                <div class="clearfix"></div>
    
                                <p class="center span5">
                                <button type="submit" class="btn btn-primary">Login</button>
                                </p>
                            </fieldset>
                        </form>
					</div>
                    </div>
<?php
	}else{
?>
					<div class="box-header well" data-original-title>
						<h2><i class="icon-list"></i> Input Laporan</h2>
					</div>
					<div class="box-content">
                    	<ul class="dashboard-list">
							<li>
                            	<span class="icon icon-color icon-check"></span>
								<a href="#">                              
									Informasi Umum Perusahaan                                    
								</a>
							</li>
                            <li>
                            	<span class="icon icon-color icon-check"></span>
								<a href="#">                              
									Organisasi Manajemen Energi                                    
								</a>
							</li>
                            <li>
								<span class="icon icon-color icon-close"></span> 
								<a href="#">                             
									Jumlah Produksi                                    
								</a>
							</li>
                            <li>
								<span class="icon icon-color icon-close"></span> 
								<a href="#">                            
									Jumlah Pemakaian Energi                                    
								</a>
							</li>
                            <li>
								<span class="icon icon-color icon-close"></span> 
								<a href="#">                             
									Konsumsi Energi Spesifik                                  
								</a>
							</li>
                            <li>
                            	<span class="icon icon-color icon-check"></span>
								<a href="<?php echo base_url();?>peralatanpemanfaat">                               
									Peralatan Pemanfaat Energi Utama                                    
								</a>
							</li>
                            <li>
								<span class="icon icon-color icon-close"></span>   
								<a href="<?php echo base_url();?>kegiatankonservasi">                            
									Kegiatan Konservasi Energi                                    
								</a>
							</li>
                            <li>
								<span class="icon icon-color icon-close"></span> 
								<a href="<?php echo base_url();?>rencanakonservasi">                           
									Rencana Kegiatan Konservasi Energi                                    
								</a>
							</li>
                            <li>
                            	<span class="icon icon-color icon-check"></span>
								<a href="<?php echo base_url();?>auditenergi">                       
									Audit Energi Peralatan Pemanfaat Energi Utama                                    
								</a>
							</li>
                        </ul>
                    </div>
<?php
	}
?>
                    
                </div>
            </div> 
       
<?php include('footer.php'); ?>
