<?php include('header.php'); ?>
<div>
    <ul class="breadcrumb">
        <li>
            <a href="<?php echo base_url(); ?>">Home</a> <span class="divider">/</span>
        </li>
        <li>
            <a href="#">Lihat Laporan</a></li>
    </ul>
</div>
<div id="dvisilaporan">
<div id="dvInformasiUmum" class="row-fluid sortable">
    <div class="box span12">
        <div class="box-header well" data-original-title>
            <h2>Informasi Umum</h2>

            <div class="box-icon">

            </div>
        </div>
        <div class="box-content">
            <div class="row-fluid">
                <div class="span2">Nama Perusahaan</div>
                <div class="span10">
                    : <?php echo $this->data['nama_perusahaanp']; ?>
                </div>
            </div>

            <div class="row-fluid">
                <div class="span2">Type Perusahaan</div>
                <div class="span10">
                    : <?php echo $this->data['type_perusahaanp']; ?>
                </div>
            </div>

            <div class="row-fluid">
                <div class="span2">Sub Sektor</div>
                <div class="span10">
                    : <?php echo $this->data['NamaSubsektorp']; ?>
                </div>
            </div>

            <div class="row-fluid">
                <div class="span2">Alamat Perusahaan</div>
                <div class="span10">
                    : <?php echo $this->data['alamat_perusahaanp']; ?>
                </div>
            </div>

            <div class="row-fluid">
                <div class="span2">Provinsi</div>
                <div class="span10">
                    : <?php echo $this->data['provp']; ?>
                </div>
            </div>

            <div class="row-fluid">
                <div class="span2">Kota / Kabupaten</div>
                <div class="span10">
                    : <?php echo $this->data['kotakabp']; ?>
                </div>
            </div>

            <div class="row-fluid">
                <div class="span2">No Telepon</div>
                <div class="span10">
                    : <?php echo $this->data['NoTelpp']; ?>
                </div>
            </div>

            <div class="row-fluid">
                <div class="span2">No Faximili</div>
                <div class="span10">
                    : <?php echo $this->data['NoFaxp']; ?>
                </div>
            </div>

            <div class="row-fluid">
                <div class="span2">Tahun Awal Beroperasi</div>
                <div class="span10">
                    : <?php echo $this->data['ThnAwalOpp']; ?>
                </div>
            </div>

            <div class="row-fluid">
                <div class="span2">Jumlah Karyawan</div>
                <div class="span10">
                    : <?php echo $this->data['JmlKaryawanp']; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="dvOrganisasiManagementEnergi" class="row-fluid sortable">
    <div class="box span12">
        <div class="box-header well" data-original-title>
            <h2>Organisasi Management Energi</h2>

            <div class="box-icon">

            </div>
        </div>
        <div class="box-content">
            <div class="row-fluid">
                <div class="span2">Ada/tidak Kebijakan Efisiensi Energi Perusahaan</div>
                <div class="span10">
                    : <?php echo $this->data['kebijakan']; ?>
                </div>
            </div>
            <div class="row-fluid">
                <div class="span12">&nbsp;</div>
            </div>
            <div class="row-fluid">
                <div class="span2">File Kebijakan Efisiensi Energi Perusahaan</div>
                <div class="span10">
                    : <?php if ($this->data['pathfilekebijakanp'] != '') { ?>  <a
                        href="uploads/<?php echo $this->data['pathfilekebijakanp']; ?>"><?php echo $this->data['pathfilekebijakanp']; ?></a><?php } ?>
                </div>
            </div>
            <div class="row-fluid">
                <div class="span12">&nbsp;</div>
            </div>
            <div class="row-fluid">
                <div class="span2">Ada/Tidak Organisasi Manajemen Energi</div>
                <div class="span10">
                    : <?php echo $this->data['organisasi']; ?>
                </div>
            </div>
            <div class="row-fluid">
                <div class="span12">&nbsp;</div>
            </div>
            <div class="row-fluid">
                <div class="span2">File Struktur Organisasi, Surat Keputusan Pembentukan</div>
                <div class="span10">
                    : <?php if ($this->data['pathfilep'] != '') { ?>  <a
                        href="uploads/<?php echo $this->data['pathfilep']; ?>"><?php echo $this->data['pathfilep']; ?></a><?php } ?>
                </div>
            </div>
            <div class="row-fluid">
                <div class="span12">&nbsp;</div>
            </div>

            <div class="row-fluid">
                <div class="span2">Ada/tidak Manager Energi</div>
                <div class="span10">
                    : <?php echo $this->data['manager']; ?>
                </div>
            </div>

            <div class="row-fluid">
                <div class="span2">Jabatan Manajer Energi</div>
                <div class="span10">
                    : <?php echo $this->data['jabatanmanagerp']; ?>
                </div>
            </div>
            <div class="row-fluid">
                <div class="span2">Nama Manajer Energi</div>
                <div class="span10">
                    : <?php echo $this->data['namamanagerp']; ?>
                </div>
            </div>
            <div class="row-fluid">
                <div class="span2">Detail Jabatan Manajer Energi</div>
                <div class="span10">
                    : <?php echo $this->data['detailjabatanmanagerp']; ?>
                </div>
            </div>
            <div class="row-fluid">
                <div class="span2">Email Manajer Energi</div>
                <div class="span10">
                    :  <?php echo $this->data['emailmanagerp']; ?>
                </div>
            </div>
            <div class="row-fluid">
                <div class="span2">No Telp / HP Manajer Energi</div>
                <div class="span10">
                    :  <?php echo $this->data['noteleponp']; ?>
                </div>
            </div>
            <div class="row-fluid">
                <div class="span2">No Sertifikat</div>
                <div class="span10">
                    :  <?php echo $this->data['nosertifikatp']; ?>
                </div>
            </div>
            <div class="row-fluid">
                <div class="span2">File lampirkan Sertifikat</div>
                <div class="span10">
                    :  <?php if ($this->data['pathfilesertifikatp'] != '') { ?>  <a
                        href="uploads/<?php echo $this->data['pathfilesertifikatp']; ?>"><?php echo $this->data['pathfilesertifikatp']; ?></a><?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php if ($this->data['type_perusahaanp'] == "Industri") { ?>
    <div id="dvJenisProduksi" class="row-fluid">
        <div class="box span12">
            <div class="box-header well" data-original-title>
                <h2>Jenis Produksi</h2>

                <div class="box-icon">

                </div>
            </div>
            <div class="box-content">
                <table class="table table-striped table-bordered bootstrap-datatable" id="datatableJP">
                    <thead>
                    <tr>
                        <th>Subsektor</th>
                        <th>Jenis Produksi</th>
                        <th>Jumlah</th>

                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th colspan="2" style="text-align:Right">Total:</th>
                        <th colspan="3"></th>
                    </tr>
                    </tfoot>
                </table>

            </div>
        </div>
    </div>
<?php } elseif ($this->data['type_perusahaanp'] == "Bangunan") { ?>
    <div id="dvLuasBangunan" class="row-fluid">
        <div class="box span12">
            <div class="box-header well" data-original-title>
                <h2>Luas Bangunan</h2>

                <div class="box-icon">

                </div>
            </div>
            <div class="box-content">
                <table class="table table-striped table-bordered bootstrap-datatable" id="datatableLB">
                    <thead>
                    <tr>
                        <th>Subsektor</th>
                        <th>Nama Bagunan</th>
                        <th>Luas Bangunan</th>

                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th colspan="2" style="text-align:Right">Total:</th>
                        <th colspan="5"></th>
                    </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
<?php } ?>
<div id="dvPemakaianEnergi" class="row-fluid">
    <div class="box span12">
        <div class="box-header well" data-original-title>
            <h2>Pemakaian Energi</h2>

            <div class="box-icon">

            </div>
        </div>
        <div class="box-content">
            <table class="table table-bordered bootstrap-datatable" id="datatablePE">
                <thead>
                <tr>
                    <th>Jenis Energi</th>
                    <th>Detail Jenis Energi</th>
                    <th>Original Unit</th>
                    <th>GJoule</th>
                    <th>Emisi (TCO2)</th>

                </tr>
                </thead>
                <tfoot>
                <tr>
                    <th colspan="3" style="text-align:Right">Total :</th>
                    <th colspan="1" style="text-align:left"></th>
                    <th colspan="1" style="text-align:left"></th>


                </tr>
                <tr>
                    <th colspan="3" style="text-align:Right">TOE :</th>
                    <th colspan="2" style="text-align:left"></th>
                </tr>

                </tfoot>
            </table>
        </div>
    </div>
</div>

<div id="dvKonsumsiEnergiSpesifik" class="row-fluid">
    <div class="box span12">
        <div class="box-header well" data-original-title>
            <h2>Konsumsi Energi Spesifik</h2>

            <div class="box-icon">

            </div>
        </div>
        <div class="box-content">
            <table class="table table-striped table-bordered bootstrap-datatable" id="datatableKE">
                <thead>
                <tr>
                    <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                    <th>Satuan</th>
                    <th>Tahun Sebelumnya</th>
                    <th>Tahun <?php echo date("Y") - 1; ?></th>
                    <th>Persentase Pertumbuhan</th>
                </tr>
                </thead>
            </table>
            <input id="type_perusahaan" name="type_perusahaan" type="hidden"
                   value="<?php echo $this->session->userdata('type_perusahaanp'); ?>">
        </div>
    </div>
    <input id="type_perusahaan" name="type_perusahaan" type="hidden"
           value="<?php echo $this->session->userdata('type_perusahaanp'); ?>">
</div>

<div id="dvPeralatanPemanfaatEnergiUtama" class="row-fluid">
    <div class="box span12">
        <div class="box-header well" data-original-title>
            <h2>Peralatan Pemanfaat Energi Utama</h2>

            <div class="box-icon">

            </div>
        </div>
        <div class="box-content">
            <table class="table table-striped table-bordered bootstrap-datatable" id="datatablePU">
                <thead>
                <tr>
                    <th rowspan="2" style="text-align:center" width="30%">Jenis Peralatan</th>
                    <th rowspan="2" style="text-align:center" width="30%">Jenis Energi</th>
                    <th colspan="3" style="text-align:center" width="30%">Pemakaian Energi</th>
                </tr>
                <tr>
                    <th style="text-align:center">Original Unit</th>
                    <th style="text-align:center">GJoule</th>
                    <th style="text-align:center">Persentase</th>
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
        </div>
    </div>
</div>

<div id="dvKegiatanEfisiensiEnergi" class="row-fluid">
    <div class="box span12">
        <div class="box-header well" data-original-title>
            <h2>Kegiatan Efisiensi Energi Pada Peralatan Pengguna Energi Utama</h2>

            <div class="box-icon">

            </div>
        </div>
        <div class="box-content">
            <table class="table table-striped table-bordered bootstrap-datatable" id="datatableKEE">
                <thead>
                <tr>
                    <th rowspan="2" style="text-align:center">Peralatan</th>
                    <th rowspan="2" style="text-align:center">Kegiatan</th>
                    <th rowspan="2" style="text-align:center">Detail Kegiatan</th>
                    <th colspan="3" width="20%" style="text-align:center">Penghematan yang Diperoleh</th>
                    <th rowspan="2" style="text-align:center">Keterangan</th>
                </tr>
                <tr>
                    <th style="text-align:center">GJoule</th>
                    <th style="text-align:center">%</th>
                    <th style="text-align:center">Emisi (tCO<sub>2</sub>)</th>
                </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

<div id="dvKegiatanEfisiensiLain" class="row-fluid">
    <div class="box span12">
        <div class="box-header well" data-original-title>
            <h2>Kegiatan Efisiensi Lain</h2>

            <div class="box-icon">

            </div>
        </div>
        <div class="box-content">
            <table class="table table-striped table-bordered bootstrap-datatable" id="datatableKEL">
                <thead>
                <tr>
                    <th>Kegiatan</th>
                    <th>Detail Kegiatan</th>
                </tr>
                </thead>
            </table>

        </div>
    </div>
</div>

<div id="dvRencanaKegiatanEfisiensiEnergi" class="row-fluid">
    <div class="box span12">
        <div class="box-header well" data-original-title>
            <h2>Rencana Kegiatan Efisiensi Energi Pada Peralatan Pengguna Energi Utama</h2>

            <div class="box-icon">

            </div>
        </div>
        <div class="box-content">
            <table class="table table-striped table-bordered bootstrap-datatable" id="datatableRKE">
                <thead>
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
                </thead>
            </table>
        </div>
    </div>
</div>

<div id="dvRencanaKegiatanEfisiensiLain" class="row-fluid">
    <div class="box span12">
        <div class="box-header well" data-original-title>
            <h2>Rencana Kegiatan Efisiensi Lain</h2>

            <div class="box-icon">

            </div>
        </div>
        <div class="box-content">
            <table class="table table-striped table-bordered bootstrap-datatable" id="datatableRKL">
                <thead>
                <tr>
                    <th>Kegiatan</th>
                    <th>Detail Kegiatan</th>
                </tr>
                </thead>
            </table>

        </div>
    </div>
</div>

<div class="row-fluid">
    <div class="box span12">
        <div class="box-header well" data-original-title>
            <h2>Audit Energi Pada Peralatan Pemanfaat Energi Utama</h2>

            <div class="box-icon">

            </div>
        </div>
        <div class="box-content">
            <table class="table table-striped table-bordered bootstrap-datatable" id="datatableAUA">
                <thead>
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
                </thead>
            </table>
        </div>
    </div>
</div>
<div class="row-fluid">
    <div class="box span12">
        <div class="box-header well" data-original-title>
            <h2>Rekomendasi Hasil Audit Energi</h2>

            <div class="box-icon">

            </div>
        </div>
        <div class="box-content">
            <table class="table table-striped table-bordered bootstrap-datatable" id="datatableRAUA">
                <thead>
                <tr>
                    <th>Jenis Peralatan</th>
                    <th>Rekomendasi</th>
                    <th>Potensi Penghematan (Gjoule)</th>
                    <th>Jenis Rekomendasi</th>
                    <th>Rencana Implementasi Tahun ke-</th>

                </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
</div>


<div class="row-fluid">
    <div class="box span12">
        <div class="box-content">

            <?php if ($this->session->userdata('privilege_id') != '2') { ?>

                <?php if ($statusp == $this->config->item('status_3')) { ?>
                    <span>Status pelaporan tahun 2014: <?php echo $statusp; ?>. Mohon segera melakukan perbaikan input
                laporan manajemen energi.  </span></p></br>
                <?php } ?>

                <span>Terima kasih telah mengisi laporan managemen energi tahunan, kami akan mengirimkan konfirmasi laporan melalui email max 3 hari kerja </span></p></br>

                <?php if (($statusp == $this->config->item('status_0')) or ($statusp == $this->config->item('status_3'))) { ?>
                    <span class="btn btn-primary"
                          onClick="document.location='<?php echo base_url(); ?>lihatlaporan/savesubmit'"
                          style="float:center">Submit</span>
                <?php } ?>
            <?php } ?>

            <?php if ($this->session->userdata('privilege_id') == '2') { ?>
                <span>Status Perusahaan ini adalah : <?php echo $statusp; ?> </span></p></br>
                <?php if ($statusp == $this->config->item('status_1')) { ?>
                    <span type="hidden" class="btn btn-primary"
                          onClick="verifikasi()"
                          style="float:center" id="btnverifikasi">Verifikasi</span>&nbsp;
                <?php } ?>
                <script type="text/javascript">
                    function verifikasi() {
                        document.getElementById('btnverifikasi').style.display = 'none';
                        document.getElementById('btnterima').style.display = 'inline';
                        document.getElementById('btntolak').style.display = 'inline';
                    }

                </script>

                <span style="display:none" type="hidden" class="btn btn-success" id="btnterima" name="btnterima"
                      onClick="document.location='<?php echo base_url(); ?>lihatlaporan/statusp?statusp=2&idp=<?php echo $this->data['idp']; ?>&tahun=<?php echo $this->data['tahunp']; ?>'"
                      style="float:center">Diterima</span>&nbsp;
                <span style="display:none" type="hidden" class="btn btn-danger" id="btntolak" name="btnterima"
                      onClick="document.location='<?php echo base_url(); ?>lihatlaporan/statusp?statusp=3&idp=<?php echo $this->data['idp']; ?>&tahun=<?php echo $this->data['tahunp']; ?>'"
                      style="float:center">Ditolak</span>&nbsp;
                <span type="hidden" class="btn btn-primary"
                      onClick="document.location='<?php echo base_url(); ?>lihatlaporan/print2pdf?print=pdf&idp=<?php echo $this->data['idp']; ?>&tahun=<?php echo $this->data['tahunp']; ?>'"
                      style="float:center">Print</span>

                <span type="hidden" class="btn btn-primary"
                      onClick="document.location='<?php echo base_url(); ?>lihatlaporan/print2pdf?print=xls&idp=<?php echo $this->data['idp']; ?>&tahun=<?php echo $this->data['tahunp']; ?>'"
                      style="float:center">Print to xls</span>

            <?php } elseif ($this->session->userdata('privilege_id') == '3') { ?>

                <span type="hidden" class="btn btn-primary"
                      onClick="document.location='<?php echo base_url(); ?>lihatlaporan/print2pdf?print=pdf'"
                      style="float:center">Print</span>

            <?php } ?>
        </div>
    </div>
</div>
<?php include('footer.php'); ?>

<script type="text/javascript">
var oTableJP;
var oTablePE;
var oTableKE;
var oTablePU;
var oTable;
var idp = (<?php echo $this->data['idp']; ?>);
var tahunp = (<?php echo $this->data['tahunp'] ;?>);



$(document).ready(function () {



    oTableJP = $("#datatableJP").dataTable({
        "fnFooterCallback": function (nRow, aaData, iStart, iEnd, aiDisplay) {
            iTotalMarket = parseFloat(0);
            for (var i = 0; i < aaData.length; i++) {
                //alert(aaData[i][1]);
                iTotalMarket += parseFloat(aaData[i][2].replace(/,/g, "").replace("ton", "") * 1);

            }

            /* Calculate the market share for browsers on this page */

            /* Modify the footer row to match what we want */
            var nCells = nRow.getElementsByTagName('th');
            nCells[1].innerHTML = formatCurrency(parseFloat(iTotalMarket), 0) + " ";
            //nRow.innerHTML = "<th colspan="+"1"+" style="+"text-align:Right"+">Total:</th><th>"+parseFloat(iPageMarket)+"</th>";
        },
        "aaSorting": [[4, "desc"]],
        "bDestroy": true,
        "bFilter": false,
        "bPaginate": false,
        "bInfo": false,
        "bProcessing": true,
        "bServerSide": true,
        "sAjaxSource": "<?php echo base_url();?>lihatlaporan/listjenisproduksi?idp=" + idp + "&tahunp=" + tahunp,
        "sServerMethod": "POST",
        "sDom": "<'row-fluid'<'span6'l><'span6'f>r>t<'row-fluid'<'span12'i><'span12 center'p>>",
        "sPaginationType": "bootstrap",
        "oLanguage": {
            "sLengthMenu": "_MENU_ records per page"
        },
        "aoColumnDefs": [
            {
                "aTargets": [1],
                "fnRender": function (obj) {
                    return obj.aData[1];
                }
            },
            {
                "aTargets": [2],
                "fnRender": function (obj) {
                    return formatCurrency(obj.aData[2], 0) + '';
                }
            }
        ]
    });


    oTableLB = $("#datatableLB").dataTable({
        "fnFooterCallback": function (nRow, aaData, iStart, iEnd, aiDisplay) {
            iTotalMarket = parseInt(0);
            for (var i = 0; i < aaData.length; i++) {
                iTotalMarket += parseInt(aaData[i][2].replace(/,/g, "").replace('m2', "") * 1);
            }

            /* Calculate the market share for browsers on this page */

            /* Modify the footer row to match what we want */
            var nCells = nRow.getElementsByTagName('th');
            nCells[1].innerHTML = formatCurrency(parseFloat(iTotalMarket), 2) + " m2";
            //nRow.innerHTML = "<th colspan="+"1"+" style="+"text-align:Right"+">Total:</th><th>"+parseFloat(iPageMarket)+"</th>";
        },
        "aaSorting": [[0, "desc"]],
        "bDestroy": true,
        "bFilter": false,
        "bPaginate": false,
        "bInfo": false,
        "bProcessing": true,
        "bServerSide": true,
        "sAjaxSource": "<?php echo base_url();?>lihatlaporan/listluasbangunan?idp=" + idp + "&tahunp=" + tahunp,
        "sServerMethod": "POST",
        "sDom": "<'row-fluid'<'span6'l><'span6'f>r>t<'row-fluid'<'span12'i><'span12 center'p>>",
        "sPaginationType": "bootstrap",
        "oLanguage": {
            "sLengthMenu": "_MENU_ records per page"
        },
        "aoColumnDefs": [
            {
                "aTargets": [1],
                "fnRender": function (obj) {
                    return obj.aData[1];
                }
            },
            {
                "aTargets": [2],
                "fnRender": function (obj) {
                    return formatCurrency(obj.aData[2], 2) + ' m2';
                }
            }
        ]
    });

    var gjoulePE = parseFloat(0);
    oTablePE = $("#datatablePE").dataTable({
        "fnFooterCallback": function (nRow, aaData, iStart, iEnd, aiDisplay) {
            iTotalGJoule = parseFloat(0);
            iTotalTOE = parseFloat(0);
            iTotalEmisi = parseFloat(0);
            for (var i = 0; i < aaData.length; i++) {
                iTotalGJoule += parseFloat(aaData[i][3].replace(/,/g, ""));
                iTotalEmisi += parseFloat(aaData[i][4].replace(/,/g, ""));
            }
            gjoulePE = iTotalGJoule;
            /* Calculate the market share for browsers on this page */
            iTotalTOE = iTotalGJoule / 41, 868;
            /* Modify the footer row to match what we want */

            var nCells = nRow.getElementsByTagName('th');
            nCells[1].innerHTML = formatCurrency(parseFloat(iTotalGJoule), 0);
            nCells[2].innerHTML = formatCurrency(parseFloat(iTotalEmisi), 2);
            var secondRow = $(nRow).next()[0];
            var nCells1 = secondRow.getElementsByTagName('th');
            nCells1[1].innerHTML = formatCurrency(parseFloat(iTotalTOE), 0);
            //var thirdRow = $(nRow).next()[1];
            //var nCells2 = thirdRow.getElementsByTagName('th');
            //nCells2[1].innerHTML=formatCurrency(parseFloat(iTotalEmisi),2);
            //nRow.innerHTML = "<th colspan="+"1"+" style="+"text-align:Right"+">Total:</th><th>"+parseFloat(iPageMarket)+"</th>";
        },
        "aaSorting": [[5, "desc"]],
        "bDestroy": true,
        "bFilter": false,
        "bPaginate": false,
        "bInfo": false,
        "bProcessing": true,
        "bServerSide": true,
        "sAjaxSource": "<?php echo base_url();?>lihatlaporan/listpemakaianenergi?idp=" + idp + "&tahunp=" + tahunp,
        "sServerMethod": "POST",
        "sDom": "<'row-fluid'<'span6'l><'span6'f>r>t<'row-fluid'<'span12'i><'span12 center'p>>",
        "sPaginationType": "bootstrap",
        "oLanguage": {
            "sLengthMenu": "_MENU_ records per page"
        },
        "aoColumnDefs": [
            {
                "aTargets": [2],
                "fnRender": function (obj) {
                    var satuan = '';
                    if (obj.aData[6] == null) {
                        satuan;
                    } else {
                        satuan = obj.aData[6];
                    }
                    return '<div align="right">' + formatCurrency(obj.aData[3], 2) + '&nbsp;' + satuan + '</div>';
                }
            },
            {
                sClass: "alignRight",
                "aTargets": [3],
                "fnRender": function (obj) {
                    return formatCurrency(obj.aData[4], 0); //'<div align="right">'+formatCurrency(obj.aData[4],0)+'</div>';
                }
            },
            {
                sClass: "alignRight",
                "aTargets": [4],
                "fnRender": function (obj) {
                    return formatCurrency(obj.aData[7] * obj.aData[4], 2); //'<div align="right">'+formatCurrency(obj.aData[4],0)+'</div>';
                }
            }
        ]
    });


    oTablePU = $("#datatablePU").dataTable({
        "fnFooterCallback": function (nRow, aaData, iStart, iEnd, aiDisplay) {
            iTotalGJoule = parseFloat(0);
            iTotalPersen = parseFloat(0);
            for (var i = 0; i < aaData.length; i++) {
                iTotalGJoule += parseFloat(aaData[i][3].replace(/,/g, "").replace("ton", "") * 1);
                iTotalPersen += parseFloat(aaData[i][4].replace(/,/g, "").replace("%", "") * 1);

            }

            /* Calculate the market share for browsers on this page */

            /* Modify the footer row to match what we want */
            var nCells = nRow.getElementsByTagName('th');

            nCells[1].innerHTML = formatCurrency(parseFloat(iTotalGJoule), 2);

            iTotalPersen = (iTotalGJoule / gjoulePE) * 100;
            nCells[2].innerHTML = formatCurrency(parseFloat(iTotalPersen), 2) + ' %';
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
        "sAjaxSource": "<?php echo base_url();?>lihatlaporan/listperalatanpemanfaatenergi?idp=" + idp + "&tahunp=" + tahunp,
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
                    if (obj.aData[1] != null || obj.aData[1] != "" || obj.aData[1] != " ") {
                        return '<div align="left">' + obj.aData[0] + '&nbsp;(' + obj.aData[1] + ')</div>';
                    }
                    else {
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
            }
        ]
    });

    oTableKEE = $("#datatableKEE").dataTable({
        "aaSorting": [[0, "desc"]],
        "bDestroy": true,
        "bFilter": false,
        "bPaginate": false,
        "bInfo": false,
        "bProcessing": true,
        "bServerSide": true,
        "sAjaxSource": "<?php echo base_url();?>lihatlaporan/listkegiatankonservasi?idp=" + idp + "&tahunp=" + tahunp,
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
                    if (obj.aData[9] == 'Lain-Lain') {
                        return '<div align="left">' + obj.aData[14] + '&nbsp;(' + obj.aData[9] + ') </br> (' + obj.aData[10] + ' - ' + obj.aData[11] + ')</div>';
                    }
                    else {
                        return '<div align="left">' + obj.aData[9] + ' </br> (' + obj.aData[10] + ' - ' + obj.aData[11] + ')</div>';
                    }

                }
            }
        ]
    });

    oTableKEL = $("#datatableKEL").dataTable({

        "aaSorting": [[3, "desc"]],
        "bDestroy": true,
        "bFilter": false,
        "bPaginate": false,
        "bInfo": false,
        "bProcessing": true,
        "bServerSide": true,
        "sAjaxSource": "<?php echo base_url();?>lihatlaporan/listkegiatankonservasilain?idp=" + idp + "&tahunp=" + tahunp,
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
                    return obj.aData[1];
                }
            },
            {
                "aTargets": [1],
                "fnRender": function (obj) {
                    return obj.aData[2];
                }
            }
        ]
    });

    oTableRKE = $("#datatableRKE").dataTable({
        "aaSorting": [[0, "desc"]],
        "bDestroy": true,
        "bFilter": false,
        "bPaginate": false,
        "bInfo": false,
        "bProcessing": true,
        "bServerSide": true,
        "sAjaxSource": "<?php echo base_url();?>lihatlaporan/listrencanakonservasi?idp=" + idp + "&tahunp=" + tahunp,
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
                    return '<div align="left">' + obj.aData[8] + ' </br> (' + obj.aData[9] + ' - ' + obj.aData[10] + ')</div>';
                }
            }
        ]
    });

    oTableRKL = $("#datatableRKL").dataTable({

        "aaSorting": [[3, "desc"]],
        "bDestroy": true,
        "bFilter": false,
        "bPaginate": false,
        "bInfo": false,
        "bProcessing": true,
        "bServerSide": true,
        "sAjaxSource": "<?php echo base_url();?>lihatlaporan/listrencanakonservasilain?idp=" + idp + "&tahunp=" + tahunp,
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
                    return obj.aData[1];
                }
            },
            {
                "aTargets": [1],
                "fnRender": function (obj) {
                    return obj.aData[2];
                }
            }
        ]
    });

    oTableAUA = $("#datatableAUA").dataTable({
        "aaSorting": [[0, "desc"]],
        "bDestroy": true,
        "bFilter": false,
        "bPaginate": false,
        "bInfo": false,
        "bProcessing": true,
        "bServerSide": true,
        "sAjaxSource": "<?php echo base_url();?>lihatlaporan/listaudit?idp=" + idp + "&tahunp=" + tahunp,
        "sServerMethod": "POST",
        "sDom": "<'row-fluid'<'span6'l><'span6'f>r>t<'row-fluid'<'span12'i><'span12 center'p>>",
        "sPaginationType": "bootstrap",
        "oLanguage": {
            "sLengthMenu": "_MENU_ records per page"
        },
        "aoColumnDefs": [
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
                    if(obj.aData[3]){
						if(obj.aData[3] == 'Seluruh') {
							return 'Seluruh peralatan pemanfaat energi utama' ;
						} else {
							return 'Sebagian peralatan pemanfaat energi utama' ;
						}
					} else {
						return '-';
					}
                }
            },
            {
                "aTargets": [3],
                "fnRender": function (obj) {
                    return obj.aData[4]+'-'+obj.aData[5];
                }
            },
			
            {
                "aTargets": [4],
                "fnRender": function (obj) {
                    return obj.aData[6];
                }
            },
			{
                "aTargets": [5],
                "fnRender": function (obj) {
                    return obj.aData[7];
                }
            },
			{
                "aTargets": [6],
                "fnRender": function (obj) {
                    return obj.aData[8];
                }
            },
            {
                "aTargets": [6],
                "fnRender": function (obj) {
                    return obj.aData[8];
                }
            },
            {
                "aTargets": [7],
                "fnRender": function (obj) {
                    if (obj.aData[9]) {
                        return '<a href="<?php echo base_url();?>uploads/audit/' + obj.aData[9] + '" target="_blank">View file</a>';
                    } else {
                        return '-';
                    }
                }
            }
        ]
    });

    oTableRAUA = $("#datatableRAUA").dataTable({
        "aaSorting": [[0, "desc"]],
        "bDestroy": true,
        "bFilter": false,
        "bPaginate": false,
        "bInfo": false,
        "bProcessing": true,
        "bServerSide": true,
        "sAjaxSource": "<?php echo base_url();?>lihatlaporan/listraudit?idp=" + idp + "&tahunp=" + tahunp,
        "sServerMethod": "POST",
        "sDom": "<'row-fluid'<'span6'l><'span6'f>r>t<'row-fluid'<'span12'i><'span12 center'p>>",
        "sPaginationType": "bootstrap",
        "oLanguage": {
            "sLengthMenu": "_MENU_ records per page"
        },
        "aoColumnDefs": [



        ]
    });


    var urlp = "";
    if ("<?php echo $this->data['type_perusahaanp'];?>" == "Industri") {
        urlp = "<?php echo base_url();?>lihatlaporan/listkonsumsienergispesifik?idp=" + idp + "&tahunp=" + tahunp;
    }
    if ("<?php echo $this->data['type_perusahaanp'];?>" == "Bangunan") {
        urlp = "<?php echo base_url();?>lihatlaporan/listkonsumsienergispesifikbang?idp=" + idp + "&tahunp=" + tahunp;
    }
    oTableKE = $("#datatableKE").dataTable({
        "bSort": false,
        "bDestroy": true,
        "bFilter": false,
        "bPaginate": false,
        "bInfo": false,
        "bProcessing": true,
        "bServerSide": true,
        "sAjaxSource": urlp,
        "sServerMethod": "POST",
        "sDom": "<'row-fluid'<'span6'l><'span6'f>r>t<'row-fluid'<'span12'i><'span12 center'p>>",
        "sPaginationType": "bootstrap",
        "oLanguage": {
            "sLengthMenu": "_MENU_ records per page"
        },
        "aoColumnDefs": [
            {
                "aTargets": [1],
                "fnRender": function (obj) {
                    return obj.aData[1];
                }
            },
            {
                "aTargets": [2],
                "fnRender": function (obj) {
                    var ret = "";
                    if (obj.aData[2] == 0) {
                        ret = "-";
                    } else {
                        ret = formatCurrency(obj.aData[2], 2);
                    }
                    return ret;
                }
            },
            {
                "aTargets": [3],
                "fnRender": function (obj) {
                    return formatCurrency(obj.aData[3], 2);
                }
            },
            {
                "aTargets": [4],
                "fnRender": function (obj) {
                    return formatCurrency(obj.aData[4], 2) + "%";
                }
            }

        ]
    });


});
</script>