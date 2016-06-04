<?php include('header.php'); ?>
<div>
    <ul class="breadcrumb">
        <li>
            <a href="<?php echo base_url(); ?>">Home</a> <span class="divider">/</span>
        </li>
        <li>
            <a href="#">Input Laporan</a></li>
    </ul>
</div>
<div class="row-fluid"><!--/span-->
    <div class="box span12">
        <div class="box-content">
            <div id="form-wizard-5" class="step">
                <div class="step-title">
                    <i><?php $type = $this->session->userdata('type_perusahaan');
                        switch ($type) {
                            case 1:
                                echo "8";
                                break;
                            case 2:
                                echo "8";
                                break;
                        } ?></i>
                    <h5>Audit Energi Pada Peralatan Pemanfaat Energi Utama</h5>
                             <span><?php $type = $this->session->userdata('type_perusahaan');
                                 switch ($type) {
                                     case 1:
                                         echo "8 dari 8";
                                         break;
                                     case 2:
                                         echo "8 dari 8";
                                         break;
                                 } ?></span>
                </div>
            </div>
        </div>
    </div>
</div>
<?php

if (is_null($newaudit) == true) {
    $_SESSION["t_audit"] = 'i';
} else {
    $_SESSION["t_audit"] = $newaudit->id_audit;
  }?>
<input type="hidden" class="input-small focused" id="t_audit" name="t_audit" type="text" value="<?php echo $_SESSION["t_audit"]; ?>">

<div class="row-fluid">
<div class="box span12">
<div class="box-header well" data-original-title>
    <h2>Input Audit Energi Pada Peralatan Pemanfaat Energi Utama</h2>

    <div class="box-icon">
        <h2>Tahun <?php echo date("Y") - 1; ?></h2>
    </div>
</div>
<div class="box-content">
<div id="divAlert"></div>
<form id="frmAdd" class="form-horizontal" action="" method="post">

<div class="control-group">
    <label class="control-label" for="status_audit">Melaksanakan Audit Energi</label>

    <div class="controls">
        <select name="status_audit" id="status_audit">
            <option value="">-- Pilih --</option>
            <?php if (is_null($newaudit) == true) { ?>
                <option value="1">Sudah</option>
                <option value="0">Belum</option>
            <?php } elseif ($newaudit->status_audit == '1') { ?>
                <option selected='selected' value="1">Sudah</option>
                <option value="0">Belum</option>
            <?php } elseif ($newaudit->status_audit == '0') { ?>
                <option value="1">Sudah</option>
                <option selected='selected' value="0">Belum</option>
            <?php } else { ?>
                <option value="1">Sudah</option>
                <option value="0">Belum</option>
            <?php } ?>

        </select>
    </div>
</div>
<div class="control-group">
    <label class="control-label" for="ruanglingkup">Ruang Lingkup Audit Energi</label>

    <div class="controls">
        <select id="ruanglingkup" name="ruanglingkup" multiple="multiple">

            <?php
            if (is_null($newaudit) == true) {
//                                $_SESSION["t_audit"] ='i';
                foreach ($newjenisperalatan as $row) {
                    echo "<option value='" . $row->id_peralatan_pemanfaat_energi . "'>" . $row->jenis_peralatan . " " . $row->jenis_peralatan_lain . "</option>";
                }
            } else {
                $array = explode(',', $newaudit->id_peralatan_pemanfaat_energi);
//                                $_SESSION["t_audit"] = $newaudit->id_audit;
                foreach ($newjenisperalatan as $row) {
                    $is_select = false;
                    foreach ($array as $array1) {
                        if ($row->id_peralatan_pemanfaat_energi == $array1) {
                            echo "<option value='" . $row->id_peralatan_pemanfaat_energi . "' selected='selected'>" . $row->jenis_peralatan . " " . $row->jenis_peralatan_lain . "</option>";
                            $is_select = true;
                            break;
                        }
                    }
                    if ($is_select == false) {
                        echo "<option value='" . $row->id_peralatan_pemanfaat_energi . "' >" . $row->jenis_peralatan . " " . $row->jenis_peralatan_lain . "</option>";
                    }
                }
            }
            ?>

        </select>
    </div>


</div>


<div class="control-group">
    <label class="control-label" for="level_audit">Level Audit Energi</label>

    <div class="controls">
        <select name="level_audit" id="level_audit">
            <option value="">-- Pilih --</option>
            <?php if (is_null($newaudit) == true) { ?>
                <option value="1">Level 1</option>
                <option value="2">Level 2</option>
                <option value="3">Level 3</option>
            <?php } elseif ($newaudit->level_audit == '1') { ?>
                <option selected='selected' value="1">Level 1</option>
                <option value="2">Level 2</option>
                <option value="3">Level 3</option>
            <?php } elseif ($newaudit->level_audit == '2') { ?>
                <option value="1">Level 1</option>
                <option selected='selected' value="2">Level 2</option>
                <option value="3">Level 3</option>
            <?php } elseif ($newaudit->level_audit == '3') { ?>
                <option value="1">Level 1</option>
                <option value="2">Level 2</option>
                <option selected='selected' value="3">Level 3</option>
            <?php } else { ?>
                <option value="1">Level 1</option>
                <option value="2">Level 2</option>
                <option value="3">Level 3</option>
            <?php } ?>

        </select>
    </div>
</div>

<div class="control-group">
    <label class="control-label" for="waktu_audit">Waktu Pelaksanaan</label>


    <div class="controls">
        <select name="waktu_bulan_audit" id="waktu_bulan_audit">
            <option value="">-- Bulan --</option>
            <?php if (is_null($newaudit) == false) {
                if ($newaudit->bulan_pelaksanaan == "1") {
                    ?>
                    <option selected='selected' value="1">Januari</option>
                <?php } else { ?>
                    <option value="1">Januari</option>
                <?php
                }
                if ($newaudit->bulan_pelaksanaan == "2") {
                    ?>
                    <option selected='selected' value="2">Februari</option>
                <?php } else { ?>
                    <option value="2">Februari</option>
                <?php
                }
                if ($newaudit->bulan_pelaksanaan == "3") {
                    ?>
                    <option selected='selected' value="3">Maret</option>
                <?php } else { ?>
                    <option value="3">Maret</option>
                <?php
                }
                if ($newaudit->bulan_pelaksanaan == "4") {
                    ?>
                    <option selected='selected' value="4">April</option>
                <?php } else { ?>
                    <option value="4">April</option>
                <?php
                }
                if ($newaudit->bulan_pelaksanaan == "5") {
                    ?>
                    <option selected='selected' value="5">Mei</option>
                <?php } else { ?>
                    <option selected='selected' value="5">Mei</option>
                <?php
                }
                if ($newaudit->bulan_pelaksanaan == "6") {
                    ?>
                    <option selected='selected' value="6">Juni</option>
                <?php } else { ?>
                    <option value="6">Juni</option>
                <?php
                }
                if ($newaudit->bulan_pelaksanaan == "7") {
                    ?>
                    <option selected='selected' value="7">Juli</option>
                <?php } else { ?>
                    <option value="7">Juli</option>
                <?php
                }
                if ($newaudit->bulan_pelaksanaan == "8") {
                    ?>
                    <option selected='selected' value="8">Agustus</option>
                <?php } else { ?>
                    <option value="8">Agustus</option>
                <?php
                }
                if ($newaudit->bulan_pelaksanaan == "9") {
                    ?>
                    <option selected='selected' value="9">September</option>
                <?php } else { ?>
                    <option value="9">September</option>
                <?php
                }
                if ($newaudit->bulan_pelaksanaan == "10") {
                    ?>
                    <option selected='selected' value="10">Oktober</option>
                <?php } else { ?>
                    <option value="10">Oktober</option>
                <?php
                }
                if ($newaudit->bulan_pelaksanaan == "11") {
                    ?>
                    <option selected='selected' value="11">Nopember</option>
                <?php } else { ?>
                    <option value="11">Nopember</option>
                <?php
                }
                if ($newaudit->bulan_pelaksanaan == "12") {
                    ?>
                    <option selected='selected' value="12">Desember</option>
                <?php } else { ?>
                    <option value="12">Desember</option>
                <?php
                }
            } else {
                ?>
                <option value="1">Januari</option>
                <option value="2">Februari</option>
                <option value="3">Maret</option>
                <option value="4">April</option>
                <option value="5">Mei</option>
                <option value="6">Juni</option>
                <option value="7">Juli</option>
                <option value="8">Agustus</option>
                <option value="9">September</option>
                <option value="10">Oktober</option>
                <option value="11">Nopember</option>
                <option value="12">Desember</option>
            <?php } ?>
        </select>

        <select name="waktu_tahun_audit" id="waktu_tahun_audit">
            <option value="">-- Tahun --</option>
            <?php $atahun = '';
            if (is_null($newaudit) == false) {
                $atahun = $newaudit->tahun_pelaksanaan;
            }
            for ($i = date("Y") - 15; $i <= date("Y"); $i++) {
                if ($i == $atahun) {
                    ?>
                    <option selected='selected' value="<?php echo $i; ?>"><?php echo $i; ?></option>
                <?php
                } else {
                    ?>
                    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                <?php
                }
            }
            ?>
        </select>
    </div>
</div>
<div class="control-group">
    <label class="control-label" for="nama_auditor">Nama Auditor Energi Bersertifikat</label>

    <div class="controls">
        <input class="input focused" id="nama_auditor" type="text" name="nama_auditor"
               value="<?php if (is_null($newaudit) != true) {
                   echo $newaudit->nama_auditor;
               } ?>">
    </div>
</div>
<div class="control-group">
    <label class="control-label" for="nomor_sertifikat">Nomor Sertifikat Auditor Energi</label>

    <div class="controls">
        <input class="input focused" id="nomor_sertifikat" type="text" name="nomor_sertifikat"
               value="<?php if (is_null($newaudit) != true) {
                   echo $newaudit->no_sertifikat_auditor;
               } ?>">
    </div>
</div>
<div class="control-group">
    <label class="control-label" for="keterangan_audit">Keterangan</label>

    <div class="controls">
        <textarea class="autogrow" id="keterangan_audit" name="keterangan_audit"><?php if (is_null($newaudit) != true) {
                echo $newaudit->keterangan;
            } ?></textarea>
    </div>
</div>
<div class="control-group">
    <label class="control-label" for="fileRingkas">File Ringkasan Eksekutif Audit Energi (.pdf only max
        4MB)</label>

    <div class="controls">
        <input class="input-file uniform_on" id="fileRingkas" type="file" name="fileRingkas">
        <span id="spanFile"></span>
        <?php if (is_null($newaudit) == false) {
            if (strlen($newaudit->file_audit)>0){?>
        <br>Uploaded file: <a href="<?php echo base_url()."uploads/audit/".$newaudit->file_audit;?>" target="_blank">View File</a>
        <?php }}?>
    </div>
</div>

<div class="form-actions">
    <span class="btn btn-primary" id="addrow">Simpan Data</span>
    <span class="btn btn-primary" id="cancelupdate" style="display:none">Batalkan</span>
</div>
</form>
</div>
</div>
</div>
<div class="row-fluid">
    <div class="box span12">
        <div class="box-header well" data-original-title>
            <h2>List Rekomendasi Hasil Audit Energi</h2>

            <div class="box-icon">
                <h2>Tahun <?php echo date("Y") - 1; ?></h2>
            </div>
        </div>
        <div class="box-content">
            <table class="table table-striped table-bordered bootstrap-datatable" id="datatable2">
                <thead>
                <tr>
                    <th style="text-align:center">Jenis Peralatan</th>
                    <th style="text-align:center">Rekomendasi</th>
                    <th style="text-align:center">Potensi Penghematan (GJoule)</th>
                    <th style="text-align:center">Jenis Rekomendasi</th>
                    <th style="text-align:center">Rencana Implementasi</th>
                    <th style="text-align:center">Actions</th>
                </tr>
                </thead>
            </table>

        </div>
    </div>
</div>
<div class="row-fluid">
    <div class="box span12">
        <div class="box-header well" data-original-title>
            <h2>Input Rekomendasi Hasil Audit Energi</h2>

            <div class="box-icon">
                <h2>Tahun <?php echo date("Y") - 1; ?></h2>
            </div>
        </div>
        <div class="box-content">
            <div id="divAlert1"></div>
            <form id="frmAdd1" class="form-horizontal" method="post">
                <div class="control-group">
                    <label class="control-label" for="id_peralatan">Jenis Peralatan Pemanfaat Energi Utama</label>

                    <div class="controls">
                        <select name="id_peralatan" id="id_peralatan">
                            <option selected value="">-- Pilih --</option>
                            <?php
                            foreach ($data_peralatan as $row) {
                                echo '<option value="' . $row->id_peralatan_pemanfaat_energi . '">' . $row->JenisPeralatan . " ".$row->jenis_peralatan_lain." ( " . $row->JenisEnergi . " - " . $row->detail_jenis_energi . " )" . "</option>";
                            }
                            ?>
                        </select>


                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="rekomendasi">Rekomendasi</label>

                    <div class="controls">
                        <textarea id="rekomendasi" name="rekomendasi" class="autogrow"></textarea>
                    </div>
                </div>
                <div class="input-append">
                    <input type="hidden" class="input-small focused" id="id_rekomendasi_audit"
                           name="id_rekomendasi_audit" type="text">
                </div>
                <div class="control-group">
                    <label class="control-label" for="potensi_hemat">Potensi Penghematan (Gjoule)</label>

                    <div class="controls">
                        <input class="input focused" id="potensi_hemat" type="text" name="potensi_hemat">
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="jenis_rekomendasi">Jenis Rekomendasi</label>

                    <div class="controls">
                        <select name="jenis_rekomendasi" id="jenis_rekomendasi">
                            <option value="">-- Pilih --</option>
                            <option value="Tanpa Investasi">Tanpa Investasi</option>
                            <option value="Investasi Rendah">Investasi Rendah</option>
                            <option value="Investasi Menengah">Investasi Menengah</option>
                            <option value="Investasi Tinggi">Investasi Tinggi</option>
                        </select>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="rencana_implemen">Rencana Implementasi Tahun ke-</label>

                    <div class="controls">
                        <select name="rencana_implemen" id="rencana_implemen">
                            <option value="">-- Pilih --</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                        </select>
                    </div>
                </div>

                <div class="form-actions">
                    <span class="btn btn-primary" id="addrow1">Tambah Data</span>
                    <span class="btn btn-primary" id="cancelupdate1" style="display:none">Batalkan</span>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="row-fluid">
    <div class="box span12">
        <div class="box-content">
            <span class="btn btn-primary" onClick="document.location='<?php echo base_url(); ?>rencanakonservasinew'">Previous</span>
            <span class="btn btn-primary" onClick="document.location='<?php echo base_url(); ?>lihatlaporan'"
                  style="float:right">Submit</span>
        </div>
    </div>
</div>
<?php include('footer.php'); ?>

<script type="text/javascript">
var oTable;


$(document).ready(function () {


    $('#ruanglingkup').multiselect({
        inheritClass: true,
        includeSelectAllOption: true,
        nonSelectedText: 'pilih ruang lingkup peralatan!',
        allSelectedText: 'telah memilih semua'
//            optionLabel: function(element) {
//                return '(' + $(element).val() + ') ' + $(element).html()  ;
//            }
    });


    oTable = $("#datatable1").dataTable({
        "aaSorting": [[0, "desc"]],
        "bDestroy": true,
        "bFilter": false,
        "bPaginate": false,
        "bInfo": false,
        "bProcessing": true,
        "bServerSide": true,
        "sAjaxSource": "<?php echo base_url();?>auditenerginew/get_list",
        "sServerMethod": "POST",
        "sDom": "<'row-fluid'<'span6'l><'span6'f>r>t<'row-fluid'<'span12'i><'span12 center'p>>",
        "sPaginationType": "bootstrap",
        "oLanguage": {
            "sLengthMenu": "_MENU_ records per page"
        },
        "aoColumnDefs": [
            {
                "aTargets": [0],
                "fnRender": function (obj) {
                    if (obj.aData[1] != '') {
                        return obj.aData[0] + " (" + obj.aData[1] + ")";
                    }
                    else {
                        return obj.aData[0]
                    }

                }
            },
            {

                "aTargets": [1],
                "fnRender": function (obj) {
                    if (obj.aData[2] == 1) {
                        return "Sudah";
                    } else {
                        return "Belum";
                    }
                }
            },
            {
                "aTargets": [2],
                "fnRender": function (obj) {
                    return obj.aData[3];
                }
            },
            {
                "aTargets": [3],
                "fnRender": function (obj) {
                    if (obj.aData[4]) {
                        return '<a href="<?php echo base_url();?>uploads/audit/' + obj.aData[4] + '" target="_blank">View file</a>';
                    } else {
                        return '-';
                    }
                }
            },
            {
                "aTargets": [4],
                "fnRender": function (obj) {
                    return '<span class="btn btn-mini btn-primary btnedit" id="' + obj.aData[5] + '">Edit</span>';
                }
            }
        ]
    });




    $("#addrow").click(function () {
        $.ajaxFileUpload({
            url: "<?php echo base_url();?>auditenerginew/save",
            secureuri: false,
            fileElementId: 'fileRingkas',
            dataType: 'json',
            data: {
                'id_audit': $("#t_audit").val(),
                'status_audit': $("#status_audit").val(),
                'id_peralatan_pemanfaat_energi': $("#ruanglingkup").val(),
                'level_audit': $("#level_audit").val(),
                'keterangan_audit': $("#keterangan_audit").val(),
                'bulan_pelaksanaan': $("#waktu_bulan_audit").val(),
                'tahun_pelaksanaan': $("#waktu_tahun_audit").val(),
                'nama_auditor': $("#nama_auditor").val(),
                'nomor_sertifikat': $("#nomor_sertifikat").val()

            },
            success: function (data, status) {
                //console.log(data.status);

                if (data.status != 'error') {
                    $("#divAlert").removeClass();
                    $("#divAlert").addClass('alert alert-success');
                    $("#divAlert").html(data.msg);
                    location.reload();
                } else {
                    $("#divAlert").removeClass();
                    $("#divAlert").addClass('alert alert-error');
                    $("#divAlert").html(data.msg);

                }
            },
            error: function (xhr, textStatus, errorThrown) {
                //console.log(errorThrown);
            }
        });
    });

    $("#cancelupdate").click(function () {
        $("#id_peralatan_pemanfaat_energi").val('');
        $("#id_jenis_peralatan").val('');
        $("#nama_jenis_peralatan").html('');
        $("#jenis_peralatan_lain").val('');
        $("#status_audit").val('');
        $("#level_audit").val('');
        $("#keterangan_audit").val('');

        $("#lingkup_audit").val('');
        $("#waktu_bulan_audit").val('');
        $("#waktu_tahun_audit").val('');
        $("#nama_auditor").val('');
        $("#nomor_sertifikat").val('');


        $("#fileRingkas").val('');
        $("#spanFile").html('');
        $("#cancelupdate").hide();
        $("#addrow").hide();
        $("#jenisperalatanlain").hide();
        $("#divAlert").removeClass();
        $("#divAlert").html('');
    });

    //rekomendasi_audit
    oTable1 = $("#datatable2").dataTable({

        "aaSorting": [[3, "desc"]],
        "bDestroy": true,
        "bFilter": false,
        "bPaginate": false,
        "bInfo": false,
        "bProcessing": true,
        "bServerSide": true,
        "sAjaxSource": "<?php echo base_url();?>auditenerginew/get_list_rekomendasi",
        "sServerMethod": "POST",
        "sDom": "<'row-fluid'<'span6'l><'span6'f>r>t<'row-fluid'<'span12'i><'span12 center'p>>",
        "sPaginationType": "bootstrap",
        "oLanguage": {
            "sLengthMenu": "_MENU_ records per page"
        },
        "aoColumnDefs": [
            {
                "aTargets": [0],
                "fnRender": function (obj) {
                    return obj.aData[0] + " (" + obj.aData[6] + ")";
                }
            },
            {
                "aTargets": [1],
                "fnRender": function (obj) {
                    return obj.aData[2];
                }
            },
            {
                "aTargets": [2],
                "fnRender": function (obj) {
                    return obj.aData[3];
                }
            },
            {
                "aTargets": [3],
                "fnRender": function (obj) {
                    return obj.aData[4];
                }
            },
            {
                "aTargets": [4],
                "fnRender": function (obj) {
                    return obj.aData[5];
                }
            },
            {
                "aTargets": [5],
                "fnRender": function (obj) {
                    return '<span class="btn btn-mini btn-primary btneditRekomendasi" id="' + obj.aData[7] + '">Edit</span>&nbsp;<span class="btn btn-mini btn-warning btndeleteRekomendasi" id="' + obj.aData[7] + '">Delete</span>&nbsp;';
                }
            }
        ]
    });


    $(".btneditRekomendasi").live('click', function () {
        $("#divAlert1").removeClass();
        $("#divAlert1").html('');
        var id = $(this).attr('id');
        var url = "<?php echo base_url();?>auditenerginew/getDetailRekomendasi/" + id; // the script where you handle the form input.
        $.post(url, '', function (data) {
            objResp = $.parseJSON(data);
            rowdata = objResp[0];
            if (rowdata) {
                $("#id_rekomendasi_audit").val(rowdata.id_rekomendasi_audit);
                $("#id_peralatan").val(rowdata.id_peralatan_pemanfaat_energi);
                $("#rekomendasi").val(rowdata.rekomendasi);
                $("#potensi_hemat").val(rowdata.potensi_penghematan);
                $("#jenis_rekomendasi").val(rowdata.jenis_rekomendasi);
                $("#rencana_implemen").val(rowdata.rencana_implementasi);
                $("#cancelupdate1").show();
                $("#addrow1").html("Simpan Data");
            } else {
                $("#id_rekomendasi_audit").val('');
                $("#id_peralatan").val('');
                $("#rekomendasi").val('');
                $("#potensi_hemat").val('');
                $("#jenis_rekomendasi").val('');
                $("#rencana_implemen").val('');
                $("#cancelupdate1").hide();
                $("#addrow1").html("Tambah Data");
            }
        });
        return false;
    });

    $("#addrow1").click(function () {
        if ($("#rekomendasi").val() == '') {
            $("#divAlert1").removeClass();
            $("#divAlert1").addClass('alert alert-error');
            $("#divAlert1").html("Rekomendasi harus diisi.");
            $("#id_kegiatan_lain").focus();
            return false;
        }
        if ($("#potensi_hemat").val() == '') {
            $("#divAlert1").removeClass();
            $("#divAlert1").addClass('alert alert-error');
            $("#divAlert1").html("Potensi penghematan harus diisi.");
            $("#detail_kegiatan_lain").focus();
            return false;
        }
        var url = "<?php echo base_url();?>auditenerginew/saveRekomendasi"; // the script where you handle the form input.
        $.post(url, $("#frmAdd1").serialize(), function (data) {
            resp = $.parseJSON(data);
            if (resp.status == "success") {
                $("#divAlert1").removeClass();
                $("#divAlert1").addClass('alert alert-success');
                $("#divAlert1").html(resp.msg);
            } else {
                $("#divAlert1").removeClass();
                $("#divAlert1").addClass('alert alert-error');
                $("#divAlert1").html(resp.msg);
            }
            oTable1.fnDraw();

            $("#id_rekomendasi_audit").val('');
            $("#id_peralatan").val('');
            $("#rekomendasi").val('');
            $("#potensi_hemat").val('');
            $("#jenis_rekomendasi").val('');
            $("#rencana_implemen").val('');
            $("#cancelupdate1").hide();
            $("#addrow1").html("Tambah Data");
        });
        return false;
    });

    $("#cancelupdate1").click(function () {
        $("#id_rekomendasi_audit").val('');
        $("#id_peralatan").val('');
        $("#rekomendasi").val('');
        $("#potensi_hemat").val('');
        $("#jenis_rekomendasi").val('');
        $("#rencana_implemen").val('');
        $("#cancelupdate1").hide();
        $("#addrow1").html("Tambah Data");
    });
    $('#id_kegiatan_lain').live('change', function () {
        $("#jenis_kegiatan_lain").val($("#id_kegiatan_lain").find("option:selected").text());
    });


    $(".btndeleteRekomendasi").live('click', function () {
        $("#divAlert1").removeClass();
        $("#divAlert1").html('');
        id = $(this).attr('id');
        conf1 = confirm("Hapus data rekomendasi audit ini?");
        if (conf1) {
            var url = "<?php echo base_url();?>auditenergi/hapusRekomendasi/" + id; // the script where you handle the form input.
            $.post(url, '', function (data) {
                oTable1.fnDraw();
                $("#id_rekomendasi_audit").val('');
                $("#id_peralatan").val('');
                $("#rekomendasi").val('');
                $("#potensi_hemat").val('');
                $("#jenis_rekomendasi").val('');
                $("#rencana_implemen").val('');
                $("#cancelupdate1").hide();
                $("#addrow1").html("Tambah Data");
            });
            return false;
        }
    });

});
</script>