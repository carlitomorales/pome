		<?php if(!isset($no_visible_elements) || !$no_visible_elements)	{ ?>
			<!-- content ends -->
			</div><!--/#content.span10-->
		<?php } ?>
		</div><!--/fluid-row-->
		<?php if(!isset($no_visible_elements) || !$no_visible_elements)	{ ?>
		
		<hr>

		<div class="modal hide fade" id="myModal">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">×</button>
				<h3>Settings</h3>
			</div>
			<div class="modal-body">
				<p>Here settings can be configured...</p>
			</div>
			<div class="modal-footer">
				<a href="#" class="btn" data-dismiss="modal">Close</a>
				<a href="#" class="btn btn-primary">Save changes</a>
			</div>
		</div>
		
		<div style="position: fixed; z-index: 100001; top: 0; left: 0;height: 100%;width: 100%; background: rgba( 255, 255, 255, 0 ) url('<? echo base_url() ?>img/ajax-loaders/ajax-loader.gif') 50% 50% no-repeat;display:none;" id="loading">
		</div>

		<footer>
			<p class="pull-left">&copy; <?php echo date('Y') ?> <a href="http://www.esdm.go.id" target="_blank">Kementerian Energi dan Sumber Daya Mineral</a></p>
			<p class="pull-right">
			<strong>Contact Us:</strong><br/>
			Phone: 021-31924572<br/>
			Email: subdit_dka(at)yahoo.co.id<br/>manajemen.energi(at)ebtke.esdm.go.id
			</p>
		</footer>
		<?php } ?>

	</div><!--/.fluid-container-->

	<!-- external javascript
	================================================== -->
	<!-- Placed at the end of the document so the pages load faster -->

	<!-- jQuery -->
	<script src="<? echo base_url() ?>js/jquery-1.7.2.min.js"></script>
	<!-- jQuery UI -->
	<script src="<? echo base_url() ?>js/jquery-ui-1.8.21.custom.min.js"></script>
	<!-- transition / effect library -->
	<script src="<? echo base_url() ?>js/bootstrap-transition.js"></script>
	<!-- alert enhancer library -->
	<script src="<? echo base_url() ?>js/bootstrap-alert.js"></script>
	<!-- modal / dialog library -->
	<script src="<? echo base_url() ?>js/bootstrap-modal.js"></script>
	<!-- custom dropdown library -->
	<script src="<? echo base_url() ?>js/bootstrap-dropdown.js"></script>
	<!-- scrolspy library -->
	<script src="<? echo base_url() ?>js/bootstrap-scrollspy.js"></script>
	<!-- library for creating tabs -->
	<script src="<? echo base_url() ?>js/bootstrap-tab.js"></script>
	<!-- library for advanced tooltip -->
	<script src="<? echo base_url() ?>js/bootstrap-tooltip.js"></script>
	<!-- popover effect library -->
	<script src="<? echo base_url() ?>js/bootstrap-popover.js"></script>
	<!-- button enhancer library -->
	<script src="<? echo base_url() ?>js/bootstrap-button.js"></script>
	<!-- accordion library (optional, not used in demo) -->
	<script src="<? echo base_url() ?>js/bootstrap-collapse.js"></script>
	<!-- carousel slideshow library (optional, not used in demo) -->
	<script src="<? echo base_url() ?>js/bootstrap-carousel.js"></script>
	<!-- autocomplete library -->
	<script src="<? echo base_url() ?>js/bootstrap-typeahead.js"></script>
	<!-- tour library -->
	<script src="<? echo base_url() ?>js/bootstrap-tour.js"></script>
	<!-- library for cookie management -->
	<script src="<? echo base_url() ?>js/jquery.cookie.js"></script>
	<!-- calander plugin -->
	<script src='<? echo base_url() ?>js/fullcalendar.min.js'></script>
	<!-- data table plugin -->
	<script src='<? echo base_url() ?>js/jquery.dataTables.min.js'></script>
	<script src='<? echo base_url() ?>js/dataTables.bootstrap.js'></script>
	<script src='<? echo base_url() ?>js/dataTables.tableTools.js'></script>
	

	<!-- chart libraries start -->
	<script src="<? echo base_url() ?>js/excanvas.js"></script>
	<script src="<? echo base_url() ?>js/jquery.flot.min.js"></script>
	<script src="<? echo base_url() ?>js/jquery.flot.pie.min.js"></script>
	<script src="<? echo base_url() ?>js/jquery.flot.stack.js"></script>
	<script src="<? echo base_url() ?>js/jquery.flot.resize.min.js"></script>
	<!-- chart libraries end -->

	<!-- select or dropdown enhancer -->
	<script src="<? echo base_url() ?>js/jquery.chosen.min.js"></script>
	<!-- checkbox, radio, and file input styler -->
	<script src="<? echo base_url() ?>js/jquery.uniform.min.js"></script>
	<!-- plugin for gallery image view -->
	<script src="<? echo base_url() ?>js/jquery.colorbox.min.js"></script>
	<!-- rich text editor library -->
	<script src="<? echo base_url() ?>js/jquery.cleditor.min.js"></script>
	<script src="<? echo base_url() ?>js/cleditor-imageupload-plugin.js"></script>

	<!-- notification plugin -->
	<script src="<? echo base_url() ?>js/jquery.noty.js"></script>
	<!-- file manager library -->
	<script src="<? echo base_url() ?>js/jquery.elfinder.min.js"></script>
	<!-- star rating plugin -->
	<script src="<? echo base_url() ?>js/jquery.raty.min.js"></script>
	<!-- for iOS style toggle switch -->
	<script src="<? echo base_url() ?>js/jquery.iphone.toggle.js"></script>
	<!-- autogrowing textarea plugin -->
	<script src="<? echo base_url() ?>js/jquery.autogrow-textarea.js"></script>
	<!-- multiple file upload plugin -->
	<script src="<? echo base_url() ?>js/jquery.uploadify-3.1.min.js"></script>
	<!-- history.js for cross-browser state change on ajax -->
	<script src="<? echo base_url() ?>js/jquery.history.js"></script>
	<!-- application script for Charisma demo -->
	<script src="<? echo base_url() ?>js/charisma.js"></script>
	<!-- application script for from validation -->
	<script src="<? echo base_url() ?>js/validate.js"></script>	
    <script src="<? echo base_url() ?>js/messagevalidator.js"></script>	
    <!-- Wizzard -->
    <script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.wizard.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>js/maruti.wizard.js"></script>
    <!-- Ajax File Uploader-->
    <script src="<? echo base_url() ?>js/ajaxfileupload.js"></script>	
        
    <!-- script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.steps.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.steps.min.js"></script -->	
    
	<script src="<? echo base_url() ?>js/jquery.chainedSelects.js"></script>	
    	<script src="<? echo base_url() ?>js/dataTables.bootstrap.js"></script>	
    	<script src="<? echo base_url() ?>js/dataTables.tableTools.js"></script>	
    	<script src="<? echo base_url() ?>amcharts/amcharts.js"></script>	
	<script src="<? echo base_url() ?>amcharts/pie.js"></script>
    	<script src="<? echo base_url() ?>amcharts/serial.js"></script>
        <script src="<? echo base_url() ?>js/multiple-select.js"></script>
    	<script language="javascript">
    	$(document).on({
    		ajaxStart: function() { $("#loading").show(); },
     		ajaxStop: function() { $("#loading").hide(); }
    	});
    	</script>
<?php
	if(isset($iskalender)){
		if($iskalender){
?>
        
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
<?php
		}
	}
?>

</body>
</html>