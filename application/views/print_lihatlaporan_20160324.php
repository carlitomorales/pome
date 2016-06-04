<head>
    <!--
        Charisma v1.0.0

        Copyright 2012 Muhammad Usman
        Licensed under the Apache License v2.0
        http://www.apache.org/licenses/LICENSE-2.0

        http://usman.it
        http://twitter.com/halalit_usman
    -->
    <meta content="utf-8" http-equiv="encoding">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Charisma, a fully featured, responsive, HTML5, Bootstrap admin template.">
    <meta name="author" content="Muhammad Usman">

    <!-- The styles -->
    <link id="bs-css" href="<? echo base_url() ?>css/bootstrap-classic.css" rel="stylesheet">
    <style type="text/css">
        body {
            padding-bottom: 40px;
        }

        .sidebar-nav {
            padding: 9px 0;
        }
    </style>
    <link href="<? echo base_url() ?>css/bootstrap-responsive.css" rel="stylesheet">
    <link href="<? echo base_url() ?>css/charisma-app.css" rel="stylesheet">
    <link href="<? echo base_url() ?>css/jquery-ui-1.8.21.custom.css" rel="stylesheet">
    <link href='<? echo base_url() ?>css/fullcalendar.css' rel='stylesheet'>
    <link href='<? echo base_url() ?>css/fullcalendar.print.css' rel='stylesheet' media='print'>
    <link href='<? echo base_url() ?>css/chosen.css' rel='stylesheet'>
    <link href='<? echo base_url() ?>css/uniform.default.css' rel='stylesheet'>
    <link href='<? echo base_url() ?>css/colorbox.css' rel='stylesheet'>
    <link href='<? echo base_url() ?>css/jquery.cleditor.css' rel='stylesheet'>
    <link href='<? echo base_url() ?>css/jquery.noty.css' rel='stylesheet'>
    <link href='<? echo base_url() ?>css/noty_theme_default.css' rel='stylesheet'>
    <link href='<? echo base_url() ?>css/elfinder.min.css' rel='stylesheet'>
    <link href='<? echo base_url() ?>css/elfinder.theme.css' rel='stylesheet'>
    <link href='<? echo base_url() ?>css/jquery.iphone.toggle.css' rel='stylesheet'>
    <link href='<? echo base_url() ?>css/opa-icons.css' rel='stylesheet'>
    <link href='<? echo base_url() ?>css/uploadify.css' rel='stylesheet'>
    <link href='<? echo base_url() ?>css/datatables.custom.css' rel='stylesheet'>
    <link href='<? echo base_url() ?>css/dataTables.tableTools.css' rel='stylesheet'>

    <!-- The HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- The fav icon -->
    <link rel="shortcut icon" href="<? echo base_url() ?>img/faviconebtke.ico">
    <div class="navbar">
        <div>
            <div class="container-fluid">
                <a class="brand"> <img src="<? echo base_url() ?>img/logoprint.png"/> <span></span></a>
            </div>
        </div>
    </div>
</head>

<title>Pelaporan_Manajemen_Energi_<?php $a = str_replace(".", "_", $this->data['nama_perusahaanp']);
    echo str_replace(" ", "_", $a); ?>_tahun_<?php echo $this->data['tahunp'] ?> </title>
<h3>Pelaporan Tahun <?php echo $this->data['tahunp'] ?></h3>
</br>
<div id="dvInformasiUmum" class="row-fluid sortable">

    <table class="table table-striped table-bordered bootstrap-datatable" id="datatableinfoumum">
        <thead>
        <tr>
            <th colspan="3" style="text-align:Center">Informasi Umum</th>
        </tr>
        <tr>
            <th>Nama Perusahaan</th>
            <th>:</th>
            <th><?php echo $this->data['nama_perusahaanp']; ?></th>
        </tr>
        <tr>
            <th>Type Perusahaan</th>
            <th>:</th>
            <th><?php echo $this->data['type_perusahaanp']; ?></th>
        </tr>
        <tr>
            <th>Sub Sektor</th>
            <th>:</th>
            <th><?php echo $this->data['NamaSubsektorp']; ?></th>
        </tr>
        <tr>
            <th>Alamat Perusahaan</th>
            <th>:</th>
            <th><?php echo $this->data['alamat_perusahaanp']; ?></th>
        </tr>
        <tr>
            <th>Provinsi</th>
            <th>:</th>
            <th><?php echo $this->data['provp']; ?></th>
        </tr>
        <tr>
            <th>Kota / Kabupaten</th>
            <th>:</th>
            <th><?php echo $this->data['kotakabp']; ?></th>
        </tr>

        <tr>
            <th>No Telepon</th>
            <th>:</th>
            <th><?php echo $this->data['NoTelpp']; ?></th>
        </tr>

        <tr>
            <th>No Faximili</th>
            <th>:</th>
            <th><?php echo $this->data['NoFaxp']; ?></th>
        </tr>

        <tr>
            <th>Tahun Awal Beroperasi</th>
            <th>:</th>
            <th><?php echo $this->data['ThnAwalOpp']; ?></th>
        </tr>

        <tr>
            <th>Jumlah Karyawan</th>
            <th>:</th>
            <th><?php echo $this->data['JmlKaryawanp']; ?></th>
        </tr>
        </thead>
    </table>

    </form    >

</div>

<div id="dvOrganisasiManagementEnergi" class="row-fluid sortable">
    <table class="table table-striped table-bordered bootstrap-datatable" id="datatableinfoumum">

        <thead>
        <tr>
            <th colspan="3" style="text-align:Center">Organisasi Management Energi</th>
        </tr>
        <tr>
            <th>Ada/tidak Kebijakan Efisiensi Energi Perusahaan</th>
            <th>:</th>
            <th><?php echo $this->data['kebijakan']; ?></th>
        </tr>
        <tr>
            <th>Ada/Tidak Organisasi Manajemen Energi</th>
            <th>:</th>
            <th><?php echo $this->data['organisasi']; ?></th>
        </tr>

        <tr>
            <th>Ada/tidak Manager Energi</th>
            <th>:</th>
            <th><?php echo $this->data['manager']; ?></th>
        </tr>
        <tr>
            <th>Jabatan Manajer Energi</th>
            <th>:</th>
            <th><?php echo $this->data['jabatanmanagerp']; ?></th>
        </tr>
        <tr>
            <th>Nama Manajer Energi</th>
            <th>:</th>
            <th><?php echo $this->data['namamanagerp']; ?></th>
        </tr>
        <tr>
            <th>Detail Jabatan Manajer Energi</th>
            <th>:</th>
            <th><?php echo $this->data['detailjabatanmanagerp']; ?></th>
        </tr>
        <tr>
            <th>Email Manajer Energi</th>
            <th>:</th>
            <th><?php echo $this->data['emailmanagerp']; ?></th>
        </tr>
        <tr>
            <th>No Telp / HP Manajer Energi</th>
            <th>:</th>
            <th><?php echo $this->data['noteleponp']; ?></th>
        </tr>
        <tr>
            <th>No Sertifikat</th>
            <th>:</th>
            <th><?php echo $this->data['nosertifikatp']; ?></th>
        </tr>
        </thead>
    </table>
    </form>

</div>

<?php if ($this->data['type_perusahaanp'] == "Industri") { ?>
    <div id="dvJenisProduksi" class="row-fluid">
        <table class="table table-striped table-bordered bootstrap-datatable" id="datatableJP">

            <thead>
            <tr>
                <th colspan="3" style="text-align:Center">Jenis Produksi</th>
            </tr>

            <tr>
                <th>Subsektor</th>
                <th>Jenis Produksi</th>
                <th>Jumlah</th>

            </tr>
            <?php
            foreach ($tbjenisproduksi as $row) {
                echo "<tr>";
                echo "<th>" . $row->NamaSubsektor . "</th>";
                echo "<th>" . $row->jenis_produksi . "</th>";
                echo "<th>" . $row->jumlah . " " . $row->satuan . "</th>";
                echo "</tr>";
            }?>
            <tr>

                <th colspan="2" style="text-align:Right">Total :</th>
                <?php
                foreach ($tbjenisproduksi as $row) {
                    echo "<th>" . $row->total . "</th>";
                }?>


            </tr>
            </thead>
            <!-- <tfoot>
                  <tr>
                      <th colspan="1" style="text-align:Right">Total:</th>
                      <th colspan="4"></th>
                  </tr>
             </tfoot>  -->

        </table>

    </div>
<?php } elseif ($this->data['type_perusahaanp'] == "Bangunan") { ?>
    <div id="dvLuasBangunan" class="row-fluid">

        <table class="table table-striped table-bordered bootstrap-datatable" id="datatableLB">

            <thead>
            <tr>
                <th colspan="3" style="text-align:Center">Luas Bangunan</th>
            </tr>
            <tr>
                <th>Subsektor</th>
                <th>Nama Bagunan</th>
                <th>Luas Bangunan</th>

            </tr>
            <?php
            foreach ($tbluasbangunan as $row) {
                echo "<tr>";
                echo "<th>" . $row->NamaSubsektor . "</th>";
                echo "<th>" . $row->nama_bangunan . "</th>";
                echo "<th>" . $row->luas_bangunan . " M2</th>";
                echo "</tr>";
            }?>
            </thead>
            <!--<tfoot>
                      <tr>
                          <th colspan="2" style="text-align:Right">Total:</th>
                          <th colspan="5"></th>
                      </tr>
            </tfoot>   -->
        </table>
    </div>
    </div>
    </div>
<?php } ?>
<div id="dvPemakaianEnergi" class="row-fluid">
    <table class="table table-bordered bootstrap-datatable" id="datatablePE">

        <thead>
        <tr>
            <th colspan="5" style="text-align:Center">Pemakaian Energi</th>
        </tr>
        <tr>
            <th>Jenis Energi</th>
            <th>Detail Jenis Energi</th>
            <th>Original Unit</th>
            <th>GJoule</th>
            <th>Emisi (TCO2)</th>
        </tr>
        <?php
        foreach ($tbpemakaianenergi as $row) {
            echo "<tr>";
            echo "<th>" . $row->JenisEnergi . "</th>";
            echo "<th>" . $row->detail_jenis_energi . "</th>";
            echo "<th>" . $row->original_unit . " " . $row->Satuan . "</th>";
            echo "<th>" . $row->gjoule . "</th>";
            echo "<th>" . $row->emisi . "</th>";
            echo "</tr>";
        }?>
        <tr>
            <th colspan="3" style="text-align:Right">Total :</th>
            <?php
            foreach ($tbpemakaianenergitotal as $row) {
                echo "<th>" . $row->totalgjoule . "</th>";
                echo "<th>" . $row->totalemisi . "</th>";
            }?>
        </tr>
        </thead>

    </table>
</div>

<div id="dvKonsumsiEnergiSpesifik" class="row-fluid">
    <table class="table table-striped table-bordered bootstrap-datatable" id="datatableKE">

        <thead>
        <tr>
            <th colspan="5" style="text-align:Center">Konsumsi Energi Spesifik</th>
        </tr>
        <tr>
            <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
            <th>Satuan</th>
            <th>Tahun Sebelumnya</th>
            <th>Tahun <?php echo date("Y") - 1; ?></th>
            <th>Persentase Pertumbuhan</th>
        </tr>
        <?php

        foreach ($tbakonsumsienergispesifik as $row) {
            echo "<tr>";
            echo "<th>" . $row->keterangan . "</th>";
            echo "<th>" . $row->satuan . "</th>";
            echo "<th>" . $row->tahun_sebelum . "</th>";
            echo "<th>" . $row->tahun_ini . "</th>";
            echo "<th>" . $row->pertumbuhan . " %</th>";
            echo "</tr>";
        }?>
        </thead>
    </table>
    <input id="type_perusahaan" name="type_perusahaan" type="hidden"
           value="<?php echo $this->session->userdata('type_perusahaanp'); ?>">
    <input id="type_perusahaan" name="type_perusahaan" type="hidden"
           value="<?php echo $this->session->userdata('type_perusahaanp'); ?>">
</div>

<div id="dvPeralatanPemanfaatEnergiUtama" class="row-fluid">
    <table class="table table-striped table-bordered bootstrap-datatable" id="datatablePU">

        <thead>
        <tr>
            <th colspan="5" style="text-align:Center">Peralatan Pemanfaat Energi Utama</th>
        </tr>

        <tr>
            <th>Jenis Peralatan</th>
            <th>Jenis Energi</th>
            <th>Original Unit</th>
            <th>GJoule</th>
            <th>Persentase Pemakaian Energi</th>
        </tr>
        <?php
        foreach ($tbperalatanpemanfaatenergi as $row) {
            echo "<tr>";
            echo "<th>" . $row->jenis_peralatan . " (" . $row->jenis_peralatan_lain . ")</th>";
            echo "<th>" . $row->detail_jenis_energi . " (" . $row->JenisEnergi . ")</th>";
            echo "<th>" . $row->original_unit . " " . $row->Satuan . "</th>";
            echo "<th>" . $row->gjoule . "</th>";
            echo "<th>" . $row->persentase . " %</th>";
            echo "</tr>";
        }?>
        <tr>
            <th colspan="3" style="text-align:Right">Total :</th>
            <?php
            foreach ($tbperalatanpemanfaatenergitotal as $row) {
                echo "<th>" . $row->totalgjoule . "</th>";
                echo "<th>" . $row->totalpersentase . " %</th>";
            }?>
        </tr>
        </thead>
    </table>
</div>

<div id="dvKegiatanEfisiensiEnergi" class="row-fluid">
    <table class="table table-striped table-bordered bootstrap-datatable" id="datatableKEE">

        <thead>
        <tr>
            <th colspan="7" style="text-align:Center">Kegiatan Efisiensi Energi Pada Peralatan Pengguna Energi Utama
            </th>
        </tr>

        <tr>
            <th rowspan="2" style="text-align:center">Peralatan</th>
            <th rowspan="2" style="text-align:center">Kegiatan</th>
            <th rowspan="2" style="text-align:center">Detail Kegiatan</th>
            <th colspan="3" style="text-align:center">Penghematan yang Diperoleh</th>
            <th rowspan="2" style="text-align:center">Keterangan</th>
        </tr>
        <tr>
            <th style="text-align:center">GJoule</th>
            <th style="text-align:center">%</th>
            <th style="text-align:center">Emisi (tCO<sub>2</sub>)</th>
        </tr>
        <?php
        foreach ($tbkegiatankonservasi as $row) {
            echo "<tr>";
            echo "<th>" . $row->JenisPeralatan . " (" . $row->detail_jenis_energi . " - " . $row->JenisEnergi . ")</th>";
            echo "<th>" . $row->jenis_kegiatan . "</th>";
            echo "<th>" . $row->detail_kegiatan . "</th>";
            echo "<th>" . $row->realisasi_gjoule . "</th>";
            echo "<th>" . $row->realisasi_persen . " %</th>";
            echo "<th>" . $row->realisasi_emisi . "</th>";
            echo "<th>" . $row->keterangan . "</th>";
            echo "</tr>";
        }?>
        </thead>
    </table>
</div>


<div id="dvKegiatanEfisiensiLain" class="row-fluid">
    <table class="table table-striped table-bordered bootstrap-datatable" id="datatableKEL">

        <thead>
        <tr>
            <th colspan="2" style="text-align:Center">Kegiatan Efisiensi Lain</th>
        </tr>
        <tr>
            <th>Kegiatan</th>
            <th>Detail Kegiatan</th>
        </tr>
        <?php
        foreach ($tbkegiatankonservasilain as $row) {
            echo "<tr>";
            echo "<th>" . $row->jenis_kegiatan . "</th>";
            echo "<th>" . $row->detail_kegiatan . "</th>";
            echo "</tr>";
        }?>
        </thead>
    </table>

</div>

<div id="dvRencanaKegiatanEfisiensiEnergi" class="row-fluid">
    <table class="table table-striped table-bordered bootstrap-datatable" id="datatableRKE">

        <thead>
        <tr>
            <th colspan="7" style="text-align:Center">Rencana Kegiatan Efisiensi Energi Pada Peralatan Pengguna Energi
                Utama
            </th>
        </tr>
        <tr>
            <th rowspan="2" style="text-align:center">Peralatan</th>
            <th rowspan="2" style="text-align:center">Kegiatan</th>
            <th rowspan="2" style="text-align:center">Detail Kegiatan</th>
            <th colspan="3" style="text-align:center">Target Penurunan yang Diperoleh</th>
            <th rowspan="2" style="text-align:center">Keterangan</th>

        </tr>
        <tr>
            <th style="text-align:center">GJoule</th>
            <th style="text-align:center">%</th>
            <th style="text-align:center">Emisi (tCO<sub>2</sub>)</th>
        </tr>
        <?php
        foreach ($tbrencanakonservasi as $row) {
            echo "<tr>";
            echo "<th>" . $row->JenisPeralatan . " (" . $row->detail_jenis_energi . " - " . $row->JenisEnergi . ")</th>";
            echo "<th>" . $row->jenis_kegiatan . "</th>";
            echo "<th>" . $row->detail_kegiatan . "</th>";
            echo "<th>" . $row->target_gjoule . "</th>";
            echo "<th>" . $row->target_persen . " %</th>";
            echo "<th>" . $row->target_emisi . "</th>";
            echo "<th>" . $row->keterangan . "</th>";
            echo "</tr>";
        }?>
        </thead>
    </table>
</div>

<div id="dvRencanaKegiatanEfisiensiLain" class="row-fluid">
    <table class="table table-striped table-bordered bootstrap-datatable" id="datatableRKL">

        <thead>
        <tr>
            <th colspan="2" style="text-align:Center">Rencana Kegiatan Efisiensi Lain</th>
        </tr>
        <tr>
            <th>Kegiatan</th>
            <th>Detail Kegiatan</th>
        </tr>
        <?php
        foreach ($tbrencanakonservasilain as $row) {
            echo "<tr>";
            echo "<th>" . $row->jenis_kegiatan . "</th>";
            echo "<th>" . $row->detail_kegiatan . "</th>";
            echo "</tr>";
        }?>
        </thead>
    </table>

</div>

<div class="row-fluid">
    <table class="table table-striped table-bordered bootstrap-datatable" id="datatableAUA">

        <thead>
        <tr>
            <th colspan="4" style="text-align:Center">Audit Energi Pada Peralatan Pemanfaat Energi Utama</th>
        </tr>
        <tr>
            <th>Jenis Peralatan</th>
                    <th>Status</th>
					<th>Ruang Lingkup</th>			
					<th>Bulan-Tahun Pelaksanaan</th>
					<th>Nama Auditor</th>
					<th>No Sertifikat</th>
                    <th>Keterangan</th>
                    <th>File Audit</th>

        </tr>
        <?php
        foreach ($tbaudit1 as $row) {
            if ($row->status_audit == '1') {
                $statusa = "Sudah";
            } else {
                $statusa = "Belum";
            }
			if ($row->ruang_lingkup != '') {
						if ($row->ruang_lingkup == 'Seluruh'){
							$ruang_lingkup = 'Seluruh peralatan pemanfaat energi utama' ;
						}else {
							$ruang_lingkup = 'Sebagian peralatan pemanfaat energi utama' ;
						}                        
			} else {
				$ruang_lingkup = " - ";
			}
			if ($row->bulan_pelaksanaan != '' or $row->tahun_pelaksanaan != '') {
				$bulan_tahun_pelaksanaan = $row->bulan_pelaksanaan.'-'.$row->tahun_pelaksanaan;
			} else {
				$bulan_tahun_pelaksanaan = " - ";
			}
			if ($row->nama_auditor != '') {
				$nama_auditor = $row->nama_auditor;
			} else {
				$nama_auditor = " - ";
			}
			if ($row->no_sertifikat != '') {
				$no_sertifikat = $row->no_sertifikat;
			} else {
				$no_sertifikat = " - ";
			}
            if ($row->keterangan_audit != '') {
                $ket = $row->keterangan_audit;
            } else {
                $ket = " - ";
            }
            if ($row->file_audit != '') {
                $file = '<a href="http://aplikasi.ebtke.esdm.go.id/pome/uploads/audit/' . $row->file_audit . '" target="_blank">View file</a>';
            } else {
                $file = " - ";
            }
            echo "<tr>";
            echo "<th>" . $row->jenis_peralatan . "</th>";
            echo "<th>" . $statusa . "</th>";
			echo "<th>" . $ruang_lingkup . "</th>";
			echo "<th>" . $bulan_tahun_pelaksanaan . "</th>";
			echo "<th>" . $nama_auditor . "</th>";
			echo "<th>" . $no_sertifikat . "</th>";
            echo "<th>" . $ket . "</th>";
            echo "<th>" . $file . "</th>";
            echo "</tr>";
        }?>
        </thead>
    </table>
</div>
<div class="row-fluid">
    <table class="table table-striped table-bordered bootstrap-datatable" id="datatableRAUA">

        <thead>
        <tr>
            <th colspan="4" style="text-align:Center">Rekomendasi Hasil Audit Energi</th>
        </tr>
        <tr>
            <th>Jenis Peralatan</th>
            <th>Rekomendasi</th>
            <th>Potensi Penghematan (Gjoule)</th>
            <th>Jenis Rekomendasi</th>
            <th>Rencana Implementasi Tahun ke-</th>

        </tr>
        <?php
        foreach ($tbraudit as $row) {

            echo "<tr>";
            echo "<th>" . $row->jenis_peralatan . "</th>";
            echo "<th>" . $row->rekomendasi . "</th>";
            echo "<th>" . $row->potensi_penghematan . "</th>";
            echo "<th>" . $row->jenis_peralatan . "</th>";
            echo "<th>" . $row->rencana_implementasi . "</th>";
            echo "</tr>";
        }?>
        </thead>
    </table>
</div>

<script type="text/javascript">

    window.print();

    window.onfocus = function () {
        window.history.back();
    }


</script>
	