<?php include('header.php'); ?>
<div>
    <ul class="breadcrumb">
        <li>
            <a href="<?php echo base_url(); ?>">Home</a> <span class="divider">/</span>
        </li>
        <li>
            <a href="#">Input Laporan</a>
        </li>
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
                                echo "5";
                                break;
                            case 2:
                                echo "5";
                                break;
                        } ?></i>
                    <h5>Peralatan Pemanfaat Energi Utama</h5>
                             <span><?php $type = $this->session->userdata('type_perusahaan');
                                 switch ($type) {
                                     case 1:
                                         echo "5 dari 8";
                                         break;
                                     case 2:
                                         echo "5 dari 8";
                                         break;
                                 } ?></span>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row-fluid">
    <div class="box span12">
        <div class="box-header well" data-original-title>
            <h2>List Peralatan Pemanfaat Energi Utama</h2>

            <div class="box-icon">
                <h2>Tahun <?php echo date("Y") - 1; ?></h2>
            </div>
        </div>
        <div class="box-content">
            <table class="table table-striped table-bordered bootstrap-datatable" id="datatable1">
                <thead>
                <tr>
                    <th rowspan="2" width="25%">Jenis Peralatan</th>
                    <th rowspan="2" width="25%">Jenis Energi</th>
                    <th colspan="3" style="text-align:center">Pemakaian Energi</th>
                    <th rowspan="2" width="15%">Actions</th>
                </tr>
                <tr>
                    <th>Original Unit</th>
                    <th>GJoule</th>
                    <th>Persentase</th>
                </tr>
                </thead>
                <tfoot>
                <tr>
                    <th colspan="3" style="text-align:Right">Total:</th>
                    <th colspan="1"></th>
                    <th colspan="2"></th>
                </tr>
                </tfoot>
            </table>
            <p style="font-size:18px"><b>Total pemakaian energi untuk satu atau lebih peralatan harus mencapai minimal
                    60%.</b></p>
            <span id="textket" style="font-size:18px; display:none;"> Harap input peralatan lain</span>
        </div>
    </div>
</div>
<div class="row-fluid">
    <div class="box span12">
        <div class="box-header well" data-original-title>
            <h2>Input Peralatan Pemanfaat Energi Utama</h2>

            <div class="box-icon">
                <h2>Tahun <?php echo date("Y") - 1; ?></h2>
            </div>
        </div>
        <div class="box-content">
            <div id="divAlert"></div>
            <form id="frmAdd" class="form-horizontal" action="" method="post">
                <div class="control-group">
                    <label class="control-label" for="id_jenis_peralatan">Jenis Peralatan Pemanfaat Energi Utama</label>

                    <div class="controls">
                        <select name="id_jenis_peralatan" id="id_jenis_peralatan">
                            <option value="">-- Pilih --</option>
                            <?php
                            foreach ($jenisperalatan as $row) {
                                echo '<option value="' . $row->IdJenisPeralatan . '">' . $row->JenisPeralatan . '</option>';
                            }
                            ?>
                        </select>
                        <input type="hidden" id="id_peralatan_pemanfaat_energi" name="id_peralatan_pemanfaat_energi"/>
                    </div>
                </div>
                <div class="control-group" id="jenisperalatanlain" >
                    <label class="control-label" for="jenis_peralatan_lain">Detail Jenis Peralatan</label>

                    <div class="controls">
                        <input id="jenis_peralatan_lain" name="jenis_peralatan_lain" type="text" class="typeahead"
                               data-provide="typeahead" data-items="4" data-source='[<?php
                        $list = '';
                        foreach ($jenisperalatanlain as $peralatanlain) {
                            $list .= '"' . $peralatanlain->jenis_peralatan_lain . '",';
                        }
                        $list = substr($list, 0, strlen($list) - 1);
                        echo $list;
                        ?>]'>
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label" for="id_jenis_energi">Jenis Energi</label>

                    <div class="controls">
                        <select name="id_jenis_energi" id="id_jenis_energi">
                            <option selected value="">-- Pilih --</option>
                            <?php
                            foreach ($data_jenisenergi as $row) {
                                echo '<option value="' . $row->id_jenis_energi_detail . '">' . $row->detail_jenis_energi . ' (' . $row->JenisEnergi . ')' . "</option>";
                            }

                            ?>
                        </select>
                    </div>
                </div>
                <div class="control-group" id="divJenisEnergiLain1" style="display:none">
                    <label class="control-label" for="jenis_energi_lain">Jenis Energi Lain</label>

                    <div class="controls">
                        <input id="jenis_energi_lain" name="jenis_energi_lain" type="text" class="typeahead"
                               data-provide="typeahead" data-items="4" data-source='[<?php
                        $list = '';
                        foreach ($data_jenisenergi1 as $energilain) {
                            $list .= '"' . $energilain->jenis_energi_lain . '",';
                        }
                        $list = substr($list, 0, strlen($list) - 1);
                        echo $list;
                        ?>]'>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="original_unit">Jumlah Pemakaian Energi (Original Unit)</label>

                    <div class="controls">
                        <div class="input-append">
                            <input class="input-small focused" id="original_unit" name="original_unit" type="text"><span
                                class="add-on" id="spanSatuan"> </span>
                            <input type="hidden" class="input-small focused" id="original_unit_detail"
                                   name="original_unit_detail" type="text">
                            <input type="hidden" class="input-small focused" id="original_unit_detail_peralatan"
                                   name="original_unit_detail_peralatan" type="text">
                            <input type="hidden" class="input-small focused" id="original_unit_sisa"
                                   name="original_unit_sisa" type="text" readonly>
                        </div>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-labelsubmini" for="konversi">Konversi</label>

                    <div class="controls">
                        <input class="input-small focused" id="konversi" name="konversi" type="text" readonly>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-labelsubmini" for="gjoule">GJoule</label>

                    <div class="controls">
                        <input class="input-small focused" id="gjoule" name="gjoule" type="text" readonly>
                        <input id="IdTotalPersen" name="IdTotalPersen" type="hidden">
                    </div>
                </div>
                <div class="form-actions">
                    <span class="btn btn-primary" id="addrow">Tambah Data</span>
                    <span class="btn btn-primary" id="cancelupdate" style="display:none">Batalkan</span>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="row-fluid">
    <div class="box span12">
        <div class="box-content">

            <span class="btn btn-primary" onClick="document.location='<?php echo base_url(); ?>konsumsienergispesifik'">Previous</span>

            <span id="btnext" class="btn btn-primary"
                  onClick="document.location='<?php echo base_url(); ?>kegiatankonservasinew'"
                  style="float:right; display:none; ">Next</span>
            <span id="btnext1" class="btn " style="float:right; display:none; ">Next</span>

        </div>
    </div>
</div>
<?php include('footer.php'); ?>

<script type="text/javascript">
var oTable;
var satuan;
var persen_energi;
$(document).ready(function () {
    if ("<?php echo $this->session->userdata('persentase_energi')?>" >= 60) {
        $("#btnext").show();
        $("#btnext1").hide();
        $("#textket").hide();
    } else {
        $("#btnext").hide();
        $("#btnext1").show();
        $("#btnext1").show();
    }

    oTable = $("#datatable1").dataTable({
        "fnFooterCallback": function (nRow, aaData, iStart, iEnd, aiDisplay) {
            iTotalGJoule = parseFloat(0);
            iTotalPersen = parseFloat(0);
            for (var i = 0; i < aaData.length; i++) {
                iTotalGJoule += parseFloat(aaData[i][3].replace(/,/g, "").replace("", "") * 1);
                iTotalPersen += parseFloat(aaData[i][4].replace(/,/g, "").replace("%", "") * 1);

            }

            /* Calculate the market share for browsers on this page */

            /* Modify the footer row to match what we want */
            var nCells = nRow.getElementsByTagName('th');
            nCells[1].innerHTML = formatCurrency(parseFloat(iTotalGJoule), 2);
            nCells[2].innerHTML = parseFloat(iTotalPersen) + ' %';
            $("#IdTotalPersen").val('');
            $("#IdTotalPersen").val(parseFloat(iTotalPersen));
            if (parseFloat(iTotalPersen) >= 60) {
                persen_energi = "ok";
                $("#btnext").show();
                $("#btnext1").hide();
                $("#textket").hide();
            } else {
                persen_energi = "no";
                $("#btnext").hide();
                $("#btnext1").show();
                $("#textket").show();
            }

            //nRow.innerHTML = "<th colspan="+"1"+" style="+"text-align:Right"+">Total:</th><th>"+parseFloat(iPageMarket)+"</th>";
        },
        "aaSorting": [[0, "desc"]],
        "bDestroy": true,
        "bFilter": false,
        "bPaginate": false,
        "bInfo": false,
        "bProcessing": true,
        "bServerSide": true,
        "sAjaxSource": "<?php echo base_url();?>peralatanpemanfaat/listperalatanpemanfaatenergi",
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
                    if (obj.aData[1] != null || obj.aData[1] != "") {
                        return '<div align="left">' + obj.aData[0] + '&nbsp;(' + obj.aData[1] + ')</div>';
                    }  else {
                        return '<div align="left">' + obj.aData[0] + '</div>';
                    }

                }
            },
            {
                "aTargets": [1],
                "fnRender": function (obj) {
                    return '<div align="left">' + obj.aData[2] + '&nbsp;(' + obj.aData[3] + ')</div>';
                }
            },
            {
                "aTargets": [2],
                "fnRender": function (obj) {
                    var satuan = '';
                    if (obj.aData[8] == null) {
                        satuan;
                    } else {
                        satuan = obj.aData[8];
                    }
                    return '<div align="left">' + formatCurrency(obj.aData[5], 0) + '&nbsp;' + satuan + '</div>';
                }
            },
            {
                "aTargets": [3],
                "fnRender": function (obj) {
                    return formatCurrency(obj.aData[6], 0); // '<div align="right">'+formatCurrency(obj.aData[6],0)+'</div>';
                }
            },
            {
                "aTargets": [4],
                "fnRender": function (obj) {
                    return formatCurrency(obj.aData[9], 2) + ' %';
                }
            },
            {
                "aTargets": [5],
                "fnRender": function (obj) {
                    return '<span class="btn btn-mini btn-primary btnedit" id="' + obj.aData[7] + '">Edit</span>&nbsp;<span class="btn btn-mini btn-warning btndelete" id="' + obj.aData[7] + '">Delete</span>&nbsp;';
                }
            }
        ]
    });

//    $('#id_jenis_peralatan').live('change', function () {
//        $("#divAlert").removeClass();
//        $("#divAlert").html('');
//        if ($("#id_jenis_peralatan").find("option:selected").text() == 'Lain-Lain') {
//            $("#jenisperalatanlain").show();
//        } else {
//            $("#jenisperalatanlain").hide();
//        }
//    });

    $('#id_jenis_energi').live('change', function () {
        $("#original_unit").val('');
        if ($("#id_jenis_energi").find("option:selected").text() == 'Lain-Lain') {
            $("#divJenisEnergiLain1").show();
        } else {
            $("#divJenisEnergiLain1").hide();
        }
        var id = $("#id_jenis_energi").find("option:selected").val();
        var url = "<?php echo base_url();?>peralatanpemanfaat/getSatuanJenisEnergi/" + id;
        $.post(url, '', function (data) {
            objResp = $.parseJSON(data);
            rowdata = objResp[0];
            if (rowdata) {
                satuan = rowdata.Satuan;
                $("#spanSatuan").html(' ' + rowdata.Satuan);
            } else {
                $("#spanSatuan").html(' ');
            }
        });
        var url = "<?php echo base_url();?>peralatanpemanfaat/getOriginalUnitPeralatan/" + id;
        $.post(url, '', function (data) {
            objResp = $.parseJSON(data);
            rowdata = objResp[0];
            if (rowdata) {
                $("#original_unit_detail_peralatan").val(rowdata.original_unit);
            } else {
                $("#original_unit_detail_peralatan").val('');
            }
        });
        var url = "<?php echo base_url();?>peralatanpemanfaat/getKonversi/" + id;
        $.post(url, '', function (data) {
            objResp = $.parseJSON(data);
            rowdata = objResp[0];
            if (rowdata) {
                $("#konversi").val(rowdata.konversi);
                $("#original_unit_detail").val(rowdata.original_unit);
            } else {
                $("#konversi").val('');
                $("#original_unit_detail").val('');
            }
        });
    });

    $("#konversi").live('change', function () {
        $("#divAlert").removeClass();
        $("#divAlert").html('');
        orgunit = parseFloat($("#original_unit").val());
        konversi = parseFloat($(this).val());
        gjoule = orgunit * konversi;
        if (!isNaN(gjoule)) {
            $("#gjoule").val(gjoule);
        }
    });

    $("#original_unit").live('change', function () {
        $("#divAlert").removeClass();
        $("#divAlert").html('');
        if ($("#original_unit_detail_peralatan").val() == '') {
            orgunitsisa = parseFloat($("#original_unit_detail").val());

        } else {
            orgunitdetail = parseFloat($("#original_unit_detail").val());
            orgunitalat = parseFloat($("#original_unit_detail_peralatan").val());
            orgunitsisa = orgunitdetail - orgunitalat;

        }
        if (parseFloat($(this).val()) > orgunitsisa) {
            $("#divAlert").removeClass();
            $("#divAlert").addClass('alert alert-error');
            $("#divAlert").html("Jumlah Pemakaian Energi melebihi total energi. Energi yang tersisa pada jenis Energi ini adalah " + orgunitsisa + " " + satuan);
            $("#original_unit").focus();
            $("#original_unit").val('');
            return false;
        } else {
            orgunit = parseFloat($(this).val());
            konversi = parseFloat($("#konversi").val());
            gjoule = orgunit * konversi;
            if (!isNaN(gjoule)) {
                $("#gjoule").val(gjoule);
            }
        }

    });

    $(".btnedit").live('click', function () {
        var id = $(this).attr('id');
        var idenergi;
        var idpemanfaat;
        var url = "<?php echo base_url();?>peralatanpemanfaat/getDetail/" + id; // the script where you handle the form input.
        $.post(url, '', function (data) {
            objResp = $.parseJSON(data);
            rowdata = objResp[0];
            if (rowdata) {
                idenergi = rowdata.id_jenis_energi_detail;
                idpemanfaat = rowdata.id_peralatan_pemanfaat_energi;
                $("#id_peralatan_pemanfaat_energi").val(rowdata.id_peralatan_pemanfaat_energi);
                $("#id_jenis_peralatan").val(rowdata.id_jenis_peralatan);
                $("#jenis_peralatan_lain").val(rowdata.jenis_peralatan_lain);
                $("#id_jenis_energi").val(rowdata.id_jenis_energi_detail);
                $("#jenis_energi_lain").val(rowdata.jenis_energi_lain);
                $("#original_unit").val(rowdata.original_unit);
                $("#konversi").val(rowdata.konversi);
                $("#gjoule").val(rowdata.gjoule);
                $("#spanSatuan").html(' ' + rowdata.Satuan);
                $("#cancelupdate").show();

                $("#addrow").html("Simpan Data");

                if (rowdata.jenis_energi_lain != '') {
                    $("#divJenisEnergiLain1").show();
                } else {
                    $("#divJenisEnergiLain1").hide();
                }
            } else {
                $("#id_peralatan_pemanfaat_energi").val('');
                $("#id_jenis_peralatan").val('');
                $("#jenis_peralatan_lain").val('');
                $("#id_jenis_energi").val('');
                $("#jenis_energi_lain").val('');
                $("#original_unit").val('');
                $("#konversi").val('');
                $("#gjoule").val('');
                $("#spanSatuan").html(' ');
                $("#cancelupdate").hide();
                $("#addrow").html("Tambah Data");
                $("#jenisperalatanlain").hide();
                $("#divJenisEnergiLain1").hide();
            }
            var url = "<?php echo base_url();?>peralatanpemanfaat/getOriginalUnitPeralatanEdit/?energi=" + idenergi + "&alat=" + idpemanfaat;
            $.post(url, '', function (data) {
                objResp = $.parseJSON(data);
                rowdata = objResp[0];
                if (rowdata) {
                    $("#original_unit_detail_peralatan").val(rowdata.original_unit);
                } else {
                    $("#original_unit_detail_peralatan").val('');
                }
            });
            var url = "<?php echo base_url();?>peralatanpemanfaat/getKonversi/" + idenergi;
            $.post(url, '', function (data) {
                objResp = $.parseJSON(data);
                rowdata = objResp[0];
                if (rowdata) {
                    $("#original_unit_detail").val(rowdata.original_unit);
                } else {
                    $("#original_unit_detail").val('');
                }
            });
            $("#divAlert").removeClass();
            $("#divAlert").html('');
            return false;
        });


    });


    $("#addrow").click(function () {
        $("#divAlert").removeClass();
        $("#divAlert").html('');
        if ($("#id_jenis_peralatan").val() == '') {
            $("#divAlert").removeClass();
            $("#divAlert").addClass('alert alert-error');
            $("#divAlert").html("Jenis peralatan harus dipilih.");
            $("#id_jenis_peralatan").focus();
            return false;
        } else {
            if ($("#id_jenis_peralatan").find("option:selected").text() == 'Lain-Lain') {
                if ($("#jenis_peralatan_lain").val() == '') {
                    $("#divAlert").removeClass();
                    $("#divAlert").addClass('alert alert-error');
                    $("#divAlert").html("Jenis peralatan lain harus diisi.");
                    $("#jenis_peralatan_lain").focus();
                    return false;
                }
            }
        }
        if ($("#id_jenis_energi").val() == '') {
            $("#divAlert").removeClass();
            $("#divAlert").addClass('alert alert-error');
            $("#divAlert").html("Jenis energi harus dipilih.");
            $("#id_jenis_energi").focus();
            return false;
        } else {
            if ($("#id_jenis_energi").find("option:selected").text() == 'Lain-Lain') {
                if ($("#jenis_energi_lain").val() == '') {
                    $("#divAlert").removeClass();
                    $("#divAlert").addClass('alert alert-error');
                    $("#divAlert").html("Jenis energi lain harus diisi.");
                    $("#jenis_energi_lain").focus();
                    return false;
                }
            }
        }
        if ($("#original_unit").val() == '') {
            $("#divAlert").removeClass();
            $("#divAlert").addClass('alert alert-error');
            $("#divAlert").html("Jumlah pemakaian energi harus diisi.");
            $("#original_unit").focus();
            return false;
        }
        if (!$.isNumeric($("#original_unit").val())) {
            $("#divAlert").removeClass();
            $("#divAlert").addClass('alert alert-error');
            $("#divAlert").html("Jumlah pemakaian energi harus numerik.");
            $("#original_unit").focus();
            return false;
        }
        if ($("#konversi").val() == '') {
            $("#divAlert").removeClass();
            $("#divAlert").addClass('alert alert-error');
            $("#divAlert").html("Konversi harus diisi.");
            $("#konversi").focus();
            return false;
        }
        var url = "<?php echo base_url();?>peralatanpemanfaat/saveperalatanpemanfaatenergi"; // the script where you handle the form input.
        $.post(url, $("#frmAdd").serialize(), function (data) {
            resp = $.parseJSON(data);
            if (resp.status == "success") {
                $("#divAlert").removeClass();
                $("#divAlert").addClass('alert alert-success');
                $("#divAlert").html(resp.msg);
            } else {
                $("#divAlert").removeClass();
                $("#divAlert").addClass('alert alert-error');
                $("#divAlert").html(resp.msg);
            }


            oTable.fnDraw();
            $("#id_peralatan_pemanfaat_energi").val('');
            $("#id_jenis_peralatan").val('');
            $("#jenis_peralatan_lain").val('');
            $("#id_jenis_energi").val('');
            $("#jenis_energi_lain").val('');
            $("#original_unit").val('');
            $("#original_unit_detail").val('');
            $("#original_unit_detail_peralatan").val('');
            $("#original_unit_sisa").val('');
            $("#konversi").val('');
            $("#gjoule").val('');
            $("#spanSatuan").html(' ');
            $("#cancelupdate").hide();
            $("#addrow").html("Tambah Data");
            $("#jenisperalatanlain").hide();
            $("#divJenisEnergiLain1").hide();

        });
        return false;
    });

    $("#cancelupdate").click(function () {
        $("#id_peralatan_pemanfaat_energi").val('');
        $("#id_jenis_peralatan").val('');
        $("#jenis_peralatan_lain").val('');
        $("#id_jenis_energi").val('');
        $("#jenis_energi_lain").val('');
        $("#original_unit").val('');
        $("#original_unit_detail").val('');
        $("#original_unit_detail_peralatan").val('');
        $("#original_unit_sisa").val('');
        $("#konversi").val('');
        $("#gjoule").val('');
        $("#spanSatuan").html(' ');
        $("#cancelupdate").hide();
        $("#addrow").html("Tambah Data");
        $("#jenisperalatanlain").hide();
        $("#divJenisEnergiLain1").hide();
        $("#divAlert").removeClass();
        $("#divAlert").html('');
    });

    $(".btndelete").live('click', function () {
        id = $(this).attr('id');
        conf = confirm("Hapus data peralatan pemanfaat energi ini?");
        if (conf) {
            var url = "<?php echo base_url();?>peralatanpemanfaat/hapus/" + id; // the script where you handle the form input.
            $.post(url, '', function (data) {
                oTable.fnDraw();
                $("#id_peralatan_pemanfaat_energi").val('');
                $("#id_jenis_peralatan").val('');
                $("#jenis_peralatan_lain").val('');
                $("#id_jenis_energi").val('');
                $("#jenis_energi_lain").val('');
                $("#original_unit").val('');
                $("#original_unit_detail").val('');
                $("#original_unit_detail_peralatan").val('');
                $("#original_unit_sisa").val('');
                $("#konversi").val('');
                $("#gjoule").val('');
                $("#spanSatuan").html(' ');
                $("#cancelupdate").hide();
                $("#addrow").html("Tambah Data");
                $("#jenisperalatanlain").hide();
                $("#divJenisEnergiLain1").hide();
            });
            $("#divAlert").removeClass();
            $("#divAlert").html('');
            return false;
        }
    });
});
</script>