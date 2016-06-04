	<div class="box-header well" data-original-title>
        <h2><i class="icon-calendar"></i> Tambah Kegiatan</h2>
    </div>
    <div class="box-content">
        <div id="divAlert"></div>
        <form id="frmAdd" class="form-horizontal" action="" method="post">
            <div class="control-group">
              <label class="control-label" for="kegiatan">Tanggal</label>
              <div class="controls">
                <input type="text" class="input-medium" id="tanggal" name="tanggal" />
              </div>
            </div>
            <div class="control-group">
              <label class="control-label" for="kegiatan">Subyek Kegiatan</label>
              <div class="controls">
                <input type="text" class="input-medium" id="title" name="title" />
              </div>
            </div>
            <div class="control-group">
              <label class="control-label" for="kegiatan">Deskripsi Kegiatan</label>
              <div class="controls">
                <textarea name="description" id="description" class="autogrow"></textarea>
              </div>
            </div>
            <div class="form-actions">
                <span class="btn btn-primary" id="addrow">Simpan Data</span>
                <span class="btn btn-primary" id="cancelupdate">Batalkan</span>
            </div>
        </form>
    </div>
<script language="javascript">
	$(document).ready(function(){
		$("#addrow").live('click', function(){
			if($("#tanggal").val() == ''){
				$("#divAlert").removeClass();
				$("#divAlert").addClass("alert alert-error");
				$("#divAlert").html("Tanggal belum diisi");
				return false;
			}
			if($("#title").val() == ''){
				$("#divAlert").removeClass();
				$("#divAlert").addClass("alert alert-error");
				$("#divAlert").html("Subyek kegiatan belum diisi");
				return false;
			}
			if($("#description").val() == ''){
				$("#divAlert").removeClass();
				$("#divAlert").addClass("alert alert-error");
				$("#divAlert").html("Deskripsi kegiatan belum diisi");
				return false;
			}
			var url = "<?php echo base_url();?>home/save_event"; // the script where you handle the form input.
			$.post(url, $("#frmAdd").serialize(), function(data){
				resp = $.parseJSON(data);
				if(resp.status == "success"){
					$("#divAlert").removeClass();
				   	$("#divAlert").addClass('alert alert-success');
				   	$("#divAlert").html(resp.msg);
					$("#tanggal").val('');
					$("#title").val('');
					$("#description").val('');
				}else{
					$("#divAlert").removeClass();
				   	$("#divAlert").addClass('alert alert-error');
				   	$("#divAlert").html(resp.msg);
				}
				$("#kalender").fullCalendar('refetchEvents');
			});
		});
		$("#cancelupdate").live('click', function(){
			//$("#dialogKegiatan").dialog('close');
			loadBerita();
		});
		$("#tanggal").datepicker({
			dateFormat: "yy-mm-dd"
		});
	});
</script>