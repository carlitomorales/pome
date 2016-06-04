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
                </div>
       		</div>
<?php include('footer.php'); ?>
<script language="javascript">
	$(document).ready(function(){
		var date = new Date();
		var d = date.getDate();
		var m = date.getMonth();
		var y = date.getFullYear();	
				
		var objCalendar = $("#kalender").fullCalendar({
			header:{
				left:'prev,next,today',
				center:'',
				right:'title'
			},
			editable:false,
			eventSources:[{
				url: '<?php echo base_url();?>home/getevents',
				color:'purple',
				textColor:'yellow'
			}],
			eventClick:function(calEvent, jsEvent, view){
				var date = calEvent.start;
				url = '<?php echo base_url();?>home/listeventsbydate/'+date.toYMD();
				$.post(url, '', function(data){
					formatteddate = $.datepicker.formatDate('dd M yy', date);
					data = '<div class="box-header well" data-original-title><h2>Kalender Kegiatan '+formatteddate+'</h2></div><div class="box-content">' + data + '</div>';
					$("#boxnews").html(data);
				});
			}
		});
		
		$("#setupEvent").live('click', function(){
			url = '<?php echo base_url();?>home/add_event';
			$.post(url, '', function(data){
				$("#boxnews").html(data);
			});
		});
		
		(function() {
			Date.prototype.toYMD = Date_toYMD;
			function Date_toYMD() {
				var year, month, day;
				year = String(this.getFullYear());
				month = String(this.getMonth() + 1);
				if (month.length == 1) {
					month = "0" + month;
				}
				day = String(this.getDate());
				if (day.length == 1) {
					day = "0" + day;
				}
				return year + "-" + month + "-" + day;
			}
		})();
	});
</script>