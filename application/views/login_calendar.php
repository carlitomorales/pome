<?php
	if(!isset($message)){
		$message = 'Silakan login untuk mengisi laporan.';
	}
?>
<?php
	if(!$islogin){
?>
<div class="row-fluid">                
                        <div class="box span12">
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
                    </div>
<?php
	}
	$iskalender = true;
?>
                    <div class="row-fluid">
                        <div class="box span12">
                            <div class="box-header well" data-original-title>
                                <h2><i class="icon-calendar"></i> Kalender Kegiatan</h2>
                            </div>
                            <div class="box-content">
                                <div id="kalender"></div>
                                <div class="clearfix"></div>
                            <?php
                                if($this->session->userdata('privilege_id') == 2){
                            ?>
                                <div align="center" style="margin:10px"><span class="btn btn-primary" id="setupEvent">Tambah Kegiatan</span></div>
                            <?php
                                }
                            ?>
                            </div>
                        </div>
                    </div>